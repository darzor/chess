<?php


namespace App\Sah\Figurice;


interface FiguricaInterface
{

    public function __construct( string $boja, int $i, int $j );

    public function dozvoljenePozicije( array $ploca, string $boja  );

    public function figurica();

}