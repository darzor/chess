<?php


namespace App\Sah\Figurice;


use App\Sah\Figurica\Figurica;

class Konj extends Figurica implements FiguricaInterface
{

    public function __construct(string $boja, int $i, int $j)
    {
        $this->ime = 'konj';
        parent::__construct( $boja, $i, $j );
    }

    public function dozvoljenePozicije(array $ploca, string $boja)
    {

        if( isset( $ploca[$this->i + 1][ $this->j - 2] ) && ( ( is_object( $ploca[$this->i + 1][ $this->j - 2] ) && ($ploca[$this->i + 1][ $this->j - 2])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i + 1][ $this->j - 2] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i + 1, $this->j -2 ];
        }
        if( isset( $ploca[$this->i + 1][ $this->j + 2] ) && ( ( is_object( $ploca[$this->i + 1][ $this->j + 2] ) && ($ploca[$this->i + 1][ $this->j + 2])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i + 1][ $this->j + 2] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i + 1, $this->j + 2 ];
        }
        if( isset( $ploca[$this->i - 1][ $this->j - 2] ) && ( ( is_object( $ploca[$this->i - 1][ $this->j - 2] ) && ($ploca[$this->i - 1][ $this->j - 2])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i - 1][ $this->j - 2] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i - 1, $this->j - 2 ];
        }
        if( isset( $ploca[$this->i - 1][ $this->j + 2] ) && ( ( is_object( $ploca[$this->i - 1][ $this->j + 2] ) && ($ploca[$this->i - 1][ $this->j + 2])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i - 1][ $this->j + 2] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i - 1, $this->j + 2 ];
        }
        if( isset( $ploca[$this->i + 2][ $this->j - 1] ) && ( ( is_object( $ploca[$this->i + 2][ $this->j - 1] ) && ($ploca[$this->i + 2][ $this->j - 1])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i + 2][ $this->j - 1] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i + 2, $this->j - 1 ];
        }
        if( isset( $ploca[$this->i + 2][ $this->j + 1] ) && ( ( is_object( $ploca[$this->i + 2][ $this->j + 1] ) && ($ploca[$this->i + 2][ $this->j + 1])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i + 2][ $this->j + 1] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i + 2, $this->j + 1 ];
        }
        if( isset( $ploca[$this->i - 2][ $this->j - 1] ) && ( ( is_object( $ploca[$this->i - 2][ $this->j - 1] ) && ($ploca[$this->i - 2][ $this->j - 1])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i - 2][ $this->j - 1] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i - 2, $this->j - 1 ];
        }
        if( isset( $ploca[$this->i - 2][ $this->j + 1] ) && ( ( is_object( $ploca[$this->i - 2][ $this->j + 1] ) && ($ploca[$this->i - 2][ $this->j + 1])->figurica()['boja'] != $this->boja ) || ( !is_object( $ploca[$this->i - 2][ $this->j + 1] ) ) ) ){
            $this->dozvoljeni_potezi[] = [ $this->i - 2, $this->j + 1 ];
        }

    }
}