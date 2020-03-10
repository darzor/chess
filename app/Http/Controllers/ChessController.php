<?php

namespace App\Http\Controllers;

use App\Events\ChessEvent;
use App\Events\StartEvent;
use App\Game;
use App\User;
use Illuminate\Http\Request;
use App\Sah\Ploca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChessController extends Controller
{


    public function odaberi_suparnika( $notify = null ){

        /**
         *      pogledaj sve igre
         *      koje sam pokrenua ja ili u koje me je netko pozvao
         */
        $zahtjevi1 = Game::where( 'user_id_1', Auth::user()->id )->whereNull('pobjednik')->select(DB::raw('user_id_2 as id') )->get()->toArray();
        $zahtjevi2 = Game::where( 'user_id_2', Auth::user()->id )->whereNull('pobjednik')->select(DB::raw('user_id_1 as id') )->get()->toArray();
        $zahtjevi_ids = array_merge( $zahtjevi1, $zahtjevi2 );

        /**
         *      svi igraci koji postoje u bazi, s kojima nemam zapocetu igru
         */
        $igraci = User::whereNotIn( 'email', [ Auth::user()->email ] )
            ->whereNotIn('id', $zahtjevi_ids )
            ->select('email')->get()->toArray();

        /**
         *      izvuci id-jeve svih korisnika kojima treba poslati obavjest da sam u igri
         *      pošalji obavjesti
         */
        $zahtjevi = User::whereIn( 'id', $zahtjevi_ids )->select('email')->get()->toArray();


        if( $notify )
            foreach ( $zahtjevi_ids as $zahtjev ){
                event( new StartEvent( $zahtjev['id'] ) );
            }

        return response()->json( [
            'igraci' => $igraci,
            'zahtjevi' => $zahtjevi,
            'user_id' => Auth::user()->id,
        ] );
    }

    public function odaberi_igraca(Request $request){

        /**
         *      pokreni novu igru odabranim igracem
         */
        $game = new Game();
        $game->user_id_2 = User::where('email', $request->email )->first()->id;
        $game->user_id_1 = User::where('email', Auth::user()->email )->first()->id;
        $game->save();

        /**
         *  pošalji obavjest odabranom igracu da je može prihvatiti
         */
        event( new StartEvent( $game->user_id_2 ) );

        return response()->json([
            'channel' => $game->user_id_1,
            'game_id' => $game->id,
            'bijeli' => $game->user_id_1,
            'crni' => $game->user_id_2,
        ]);
    }


    public function prihvati_zahtjev ( Request $request ){

        /**
         *      prihvati igru od drugog korisnika
         */
        $user_id_1 = User::where('email', $request->email )->first()->id;
        $user_id_2 = User::where('email', Auth::user()->email )->first()->id;

        $game = Game::where( function ( $q ) use ( $user_id_1 ) {
            $q->where('user_id_1', $user_id_1)
                ->orWhere('user_id_2', $user_id_1);
        } )
            ->where( function ( $q ) use ( $user_id_2 ) {
                $q->where('user_id_1', $user_id_2)
                    ->orWhere('user_id_2', $user_id_2);
            })
        ->first()->toArray();

        return response()->json([
            'channel' => $user_id_2,
            'game_id' => $game['id'],
            'bijeli' => $game['user_id_1'],
            'crni' => $game['user_id_2'],
        ]);
    }


    public function odbij_zahtjev( Request $request ){

        /**
         *      makni zahtjev s popisa
         */
        $user_id_1 = User::where('email', $request->email )->first()->id;
        $user_id_2 = User::where('email', Auth::user()->email )->first()->id;

        $game = Game::where( function ( $q ) use ( $user_id_1 ) {
            $q->where('user_id_1', $user_id_1)
                ->orWhere('user_id_2', $user_id_1);
        } )
            ->where( function ( $q ) use ( $user_id_1 ) {
                $q->where('user_id_2', $user_id_1)
                    ->orWhere('user_id_2', $user_id_1);
            })
            ->delete();


        event( new StartEvent( $user_id_1 ) );

        return $this->odaberi_suparnika( 0 );
    }

    public function nastavi_kasnije(){
        /*
         * TODO:: pošalji naotifikaciju korisniku da nastavite kasnije
         */
    }

    public function zavrsi_igru( Request $request ){

        $game = Game::find( $request->game_id );

        $user_id_1 = $game->user_id_1;
        $user_id_2 = $game->user_id_2;

        event( new StartEvent( $user_id_1 ) );
        event( new StartEvent( $user_id_2 ) );

        return 0;
    }


    public function nova_igra( $id ){

        /**
         *  pokreni igru iz baze
         */

        $igra = Game::find($id);
        $ploca = new Ploca( $igra->user_id_1, $igra->user_id_2 );
        if( $igra->game ){
            $ploca->osvjeziPlocu( $igra->game['ploca'], $igra->game['boja'] );
            $igra->game = $ploca->igra();
        } else {
            $ploca->inicijalnaPloca( );
            $igra->game = $ploca->igra();
            $igra->save();
        }




        $return = $ploca->igra();
        $user = Auth::user()->id;
        $event = ($user == $igra->user_id_1) ? $igra->user_id_2 : $igra->user_id_1;
        event( new ChessEvent( $return, $event, $igra->id ) );
        return response()->json( $return );
    }

    public function povuci_potez( $id, Request $request ){


        /**
         *      povuci potes
         *      spremi u bazu
         *      obavjesti igrace
         */
        $data = $request->all();

        $igra = Game::find($id);
        $ploca = new Ploca( $igra->user_id_1, $igra->user_id_2 );
        $ploca->osvjeziPlocu( $igra->game['ploca'], $igra->game['boja'] );
        $ploca->povuci_potez( $data['figurica']['i'], $data['figurica']['j'], $data['pozicija'][0], $data['pozicija'][1] );

        $igra->game = $ploca->igra();
        $igra->save();

        $return = $igra->game;
        $user = Auth::user()->id;
        $event = ($user == $igra->user_id_1) ? $igra->user_id_2 : $igra->user_id_1;
        event( new ChessEvent( $return, $event, $igra->id ) );
        return response()->json( $return );
    }
}
