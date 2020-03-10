<?php


namespace App\Sah\Figurica;


use App\Sah\Figurice\FiguricaInterface;

abstract class Figurica implements FiguricaInterface
{

    protected $boja;
    protected $i;
    protected $j;
    protected $ime;
    protected $dozvoljeni_potezi = [];


    public function __construct( string $boja, int  $i, int $j )
    {
        $this->boja = $boja;
        $this->i = $i;
        $this->j = $j;
    }

    public function figurica()
    {
        return [
            'ime' => $this->ime,
            'boja' => $this->boja,
            'i' => $this->i,
            'j' => $this->j,
            'dozvoljeni_potezi' => $this->dozvoljeni_potezi,
        ];
    }

    public function getDozvoljenePozicije(){
        return $this->dozvoljeni_potezi;
    }




}