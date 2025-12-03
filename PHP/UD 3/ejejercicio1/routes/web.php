<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiControlador;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/edad/{edad?}', function ($edad = 0) {
    return view('edad', ['edad' => $edad]);
});

Route::get('/numeros/{numero?}', function ($cantidad = 10) {
    $controlador = new MiControlador;
    $lista = $controlador->generarLista($cantidad);

    return view('numeros', [
        'lista' => $lista,
        'cantidad' => $cantidad
    ]);
});

