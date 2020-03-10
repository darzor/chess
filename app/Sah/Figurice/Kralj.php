<?php


namespace App\Sah\Figurice;


use App\Sah\Figurica\Figurica;

class Kralj extends Figurica
{

    public function __construct(string $boja, int $i, int $j)
    {
        $this->ime = 'kralj';
        parent::__construct( $boja, $i, $j );
    }


    public function dozvoljenePozicije(array $ploca, string $boja)
    {
        $i = $this->i;
        $j = $this->j;
        $i++;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }


        $i = $this->i;
        $j = $this->j;
        $i--;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }

        $i = $this->i;
        $j = $this->j;
        $j++;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }

        $i = $this->i;
        $j = $this->j;
        $j--;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }


        $i = $this->i;
        $j = $this->j;
        $i++;
        $j++;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }

        $i = $this->i;
        $j = $this->j;
        $i--;
        $j++;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
            ;
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }

        $i = $this->i;
        $j = $this->j;
        $i++;
        $j--;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }

        $i = $this->i;
        $j = $this->j;
        $i--;
        $j--;
        if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
            $this->dozvoljeni_potezi[] = [$i, $j];
        }
    }
}