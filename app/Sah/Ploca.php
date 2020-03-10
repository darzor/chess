<?php

namespace App\Sah;

use App\Sah\Figurice\Konj;
use App\Sah\Figurice\Kralj;
use App\Sah\Figurice\Kraljica;
use App\Sah\Figurice\Lovac;
use App\Sah\Figurice\Pjesak;
use App\Sah\Figurice\Top;

class Ploca
{


    private $ploca = [];

    private $boja = null;

    private $igrac1;
    private $igrac2;

    public function __construct( $igrac1, $igrac2 )
    {
        $this->igrac1 = $igrac1; // bijeli
        $this->igrac2 = $igrac2; // crni
    }


    /**
     *      postavljanje ploce na pocetku igre
     */
    public function inicijalnaPloca(){

        $this->boja = rand(0, 1) ? 'bijeli' : 'crni';

        $this->ploca =
            [
                [
                    ( new Top( 'crni', 0 , 0 ) ),
                    ( new Konj( 'crni', 0 , 1 ) ),
                    ( new Lovac( 'crni', 0 , 2 ) ),
                    ( new Kraljica( 'crni', 0 , 3 ) ),
                    ( new Kralj( 'crni', 0 , 4 ) ),
                    ( new Lovac( 'crni', 0 , 5 ) ),
                    ( new Konj( 'crni', 0 , 6 ) ),
                    ( new Top( 'crni', 0 , 7 ) )
                ],
                [
                    ( new Pjesak( 'crni', 1 , 0 ) ),
                    ( new Pjesak( 'crni', 1 , 1 ) ),
                    ( new Pjesak( 'crni', 1 , 2 ) ),
                    ( new Pjesak( 'crni', 1 , 3 ) ),
                    ( new Pjesak( 'crni', 1 , 4 ) ),
                    ( new Pjesak( 'crni', 1 , 5 ) ),
                    ( new Pjesak( 'crni', 1 , 6 ) ),
                    ( new Pjesak( 'crni', 1 , 7 ) ),
                ],
                [ [],[],[],[],[],[],[],[] ],
                [ [],[],[],[],[],[],[],[] ],
                [ [],[],[],[],[],[],[],[] ],
                [ [],[],[],[],[],[],[],[] ],
                [
                    ( new Pjesak( 'bijeli', 6 , 0 ) ),
                    ( new Pjesak( 'bijeli', 6 , 1 ) ),
                    ( new Pjesak( 'bijeli', 6 , 2 ) ),
                    ( new Pjesak( 'bijeli', 6 , 3 ) ),
                    ( new Pjesak( 'bijeli', 6 , 4 ) ),
                    ( new Pjesak( 'bijeli', 6 , 5 ) ),
                    ( new Pjesak( 'bijeli', 6 , 6 ) ),
                    ( new Pjesak( 'bijeli', 6 , 7 ) ),
                ],
                [
                    ( new Top( 'bijeli', 7 , 0 ) ),
                    ( new Konj( 'bijeli', 7 , 1 ) ),
                    ( new Lovac( 'bijeli', 7 , 2 ) ),
                    ( new Kraljica( 'bijeli', 7 , 3 ) ),
                    ( new Kralj( 'bijeli', 7 , 4 ) ),
                    ( new Lovac( 'bijeli', 7 , 5 ) ),
                    ( new Konj( 'bijeli', 7 , 6 ) ),
                    ( new Top( 'bijeli', 7 , 7 ) ),
                ],
            ];

        foreach ( $this->ploca as $i => $redak ){
            foreach( $redak as  $j => $figurica ) {
                if( $figurica )
                    ($figurica)->dozvoljenePozicije( $this->ploca, $this->boja );
            }
        }

    }


    /**
     *      postavljanje ploce za vrijeme igre
     */
    public function osvjeziPlocu( array $ploca, string $boja){

        $this->boja = $boja;

        foreach ( $ploca as $i => $redak ){
            foreach( $redak as  $j => $figurica ) {
                if( isset( $figurica['ime'] ) ) {
                    if ($figurica['ime'] == 'top')
                        $this->ploca[$i][$j] = (new Top($figurica['boja'], $i, $j));
                    else if ($figurica['ime'] == 'konj')
                        $this->ploca[$i][$j] = (new Konj($figurica['boja'], $i, $j));
                    else if ($figurica['ime'] == 'lovac')
                        $this->ploca[$i][$j] = (new Lovac($figurica['boja'], $i, $j));
                    else if ($figurica['ime'] == 'kraljica')
                        $this->ploca[$i][$j] = (new Kraljica($figurica['boja'], $i, $j));
                    else if ($figurica['ime'] == 'kralj')
                        $this->ploca[$i][$j] = (new Kralj($figurica['boja'], $i, $j));
                    else if ($figurica['ime'] == 'pjesak')
                        $this->ploca[$i][$j] = (new Pjesak($figurica['boja'], $i, $j));
                }
                else $this->ploca[$i][$j] = [];
            }
        }


    }



    public function povuci_potez( int $i1, int $j1, int $i2, int $j2 ){

        foreach ( $this->ploca as $i => $redak ){
            foreach( $redak as  $j => $figurica ) {
                if( $figurica )
                    ($figurica)->dozvoljenePozicije( $this->ploca, $this->boja );
            }
        }

        $dozvoljene_pozicije = ($this->ploca[$i1][$j1])->getDozvoljenePozicije();

        foreach( $dozvoljene_pozicije as $pozicija ){
            if( $pozicija[0] == $i2 && $pozicija[1] == $j2 ){
                $this->ploca[$i2][$j2] = [];
                $this->ploca[$i2][$j2] = $this->ploca[$i1][$j1];
                $this->ploca[$i1][$j1] = [];
                ($this->ploca[$i2][$j2])->dozvoljenePozicije( $this->ploca, $this->boja);
            }
        }

    }

    public function igra(){

        $pobjednik = $this->boja;
        $this->boja = $this->boja == 'bijeli' ? 'crni' : 'bijeli';

        foreach ( $this->ploca as $i => $redak ){
            foreach( $redak as  $j => $figurica ) {
                if( $figurica )
                    ($figurica)->dozvoljenePozicije( $this->ploca, $this->boja );
            }
        }

        $ploca = [];


        foreach ( $this->ploca as $i => $redak ) {
            $ploca[$i] = [];
            foreach ($redak as $j => $figurica) {
                if ( $this->ploca[$i][$j] ) {
                    $ploca[$i][$j] = ( $this->ploca[$i][$j] )->figurica();
                    if( $ploca[$i][$j]['ime'] == 'kralj' && $ploca[$i][$j]['boja'] == $this->boja )
                        $pobjednik = null;
                } else {
                    $ploca[$i][$j] = [];
                }
            }
        }



        return [
            'ploca' => $ploca,
            'boja' => $this->boja,
            'pobjednik' => $pobjednik,
            'igrac' => $this->boja == 'bijeli' ? $this->igrac1 : $this->igrac2
        ];

    }

    private function gameOver( int $i, int $j ){

        foreach ( $this->ploca as $i => $redak ) {
            $ploca[$i] = [];
            foreach ($redak as $j => $figurica) {
                /**
                 *  TODO::  provjeri da li koja protivnicka figura napada mojeg kralja
                 */
            }
        }
    }


    /**
     *      TODO:: vracanje figurice
     */




}