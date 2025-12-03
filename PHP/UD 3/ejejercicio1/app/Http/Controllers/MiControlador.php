<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiControlador extends Controller
{
    public function generarLista($limite = 10) {
      $lista = [];

      for ($i=1; $i <= $limite; $i++) { 
        $lista[] = $i;
      }

      return $lista;
    }
}
