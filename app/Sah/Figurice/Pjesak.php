<?php


namespace App\Sah\Figurice;


use App\Sah\Figurica\Figurica;

class Pjesak extends Figurica implements FiguricaInterface
{

    public function __construct(string $boja, int $i, int $j)
    {
        $this->ime = 'pjesak';
        parent::__construct( $boja, $i, $j );
    }

    public function dozvoljenePozicije(array $ploca, string $boja)
    {

        if( $this->boja == 'crni' && $boja == $this->boja ){
            if( isset( $ploca[$this->i + 1][$this->j] ) && !$ploca[$this->i + 1][$this->j] )
                $this->dozvoljeni_potezi[] = [ $this->i + 1, $this->j ];

            if( isset( $ploca[$this->i + 1][$this->j + 1] ) && $ploca[$this->i+1][$this->j + 1] && (( $ploca[$this->i+1][$this->j + 1 ] )->figurica()['boja']) == 'bijeli' )
                $this->dozvoljeni_potezi[] = [ $this->i + 1, $this->j + 1 ];

            if( isset( $ploca[$this->i + 1][$this->j - 1 ] ) && $ploca[$this->i+1][$this->j - 1 ]  && ( $ploca[$this->i+1][$this->j - 1 ] )->figurica()['boja'] == 'bijeli' )
                $this->dozvoljeni_potezi[] = [ $this->i + 1, $this->j - 1 ];

            if( $this->i == 1  && !$ploca[$this->i + 1][$this->j] && !$ploca[$this->i + 2][$this->j] )
                $this->dozvoljeni_potezi[] = [ $this->i + 2, $this->j ];

        } else if( $this->boja == 'bijeli' && $boja == $this->boja ) {

            if( isset( $ploca[$this->i - 1][$this->j] )  && !$ploca[$this->i - 1][$this->j] )
                $this->dozvoljeni_potezi[] = [ $this->i - 1, $this->j ];

            if( isset( $ploca[$this->i - 1][$this->j + 1] ) && $ploca[$this->i - 1][$this->j + 1] && ( $ploca[$this->i - 1][$this->j + 1 ] )->figurica()['boja'] == 'crni' )
                $this->dozvoljeni_potezi[] = [ $this->i - 1, $this->j + 1 ];

            if( isset( $ploca[$this->i - 1][$this->j - 1 ] ) && $ploca[$this->i - 1][$this->j - 1 ] && ( $ploca[$this->i - 1][$this->j - 1 ] )->figurica()['boja'] == 'crni' )
                $this->dozvoljeni_potezi[] = [ $this->i - 1, $this->j - 1 ];

            if( $this->i == 6  && !$ploca[$this->i -1 ][$this->j] && !$ploca[$this->i - 2 ][$this->j] )
                $this->dozvoljeni_potezi[] = [ $this->i - 2, $this->j ];
        }

    }
}