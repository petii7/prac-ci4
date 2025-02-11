<?php

namespace App\Controllers;

class Mapas extends BaseController
{
    public function mostrarMapas(): string
    {
        return view('mapas');
    }

    public function inferno(): string
    {
        return view('utilidad/inferno');
    }
}