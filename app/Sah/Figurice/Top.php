<?php


namespace App\Sah\Figurice;


use App\Sah\Figurica\Figurica;

class Top extends Figurica implements FiguricaInterface
{

    public function __construct(string $boja, int $i, int $j)
    {
        $this->ime = 'top';
        parent::__construct( $boja, $i, $j );
    }

    public function dozvoljenePozicije(array $ploca, string $boja)
    {

        $i = $this->i;
        $j = $this->j;
        while( true ){
            $i++;
            if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
                $this->dozvoljeni_potezi[] = [$i, $j];
                break;
            } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
                $this->dozvoljeni_potezi[] = [$i, $j];
            } else {
                break;
            }
        }

        $i = $this->i;
        $j = $this->j;
        while( true ){
            $i--;
            if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
                $this->dozvoljeni_potezi[] = [$i, $j];
                break;
            } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
                $this->dozvoljeni_potezi[] = [$i, $j];
            } else {
                break;
            }
        }

        $i = $this->i;
        $j = $this->j;
        while( true ){
            $j++;
            if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
                $this->dozvoljeni_potezi[] = [$i, $j];
                break;
            } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
                $this->dozvoljeni_potezi[] = [$i, $j];
            } else {
                break;
            }
        }

        $i = $this->i;
        $j = $this->j;
        while( true ){
            $j--;
            if( isset( $ploca[$i][ $j] ) && is_object( $ploca[$i][$j] ) && ($ploca[$i][$j])->figurica()['boja'] != $this->boja ){
                $this->dozvoljeni_potezi[] = [$i, $j];
                break;
            } else if( isset( $ploca[$i][ $j] ) &&  !is_object( $ploca[$i][$j] ) ){
                $this->dozvoljeni_potezi[] = [$i, $j];
            } else {
                break;
            }
        }
    }
}