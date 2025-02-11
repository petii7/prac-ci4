<?php

namespace App\Controllers;

class Productos extends BaseController{

    public function index(){

        echo "ControladorProductos";

    }

    public function show(){

        return "Detalles del producto";

    }
}