<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola/{nombre?}', function ($nombre = 'Mundo') {
    return view('hola', ['nombre' => $nombre]);
});

Route::get('/inicio', function ($usuario = 'Paco') {
    return view('inicio', ['usuario' => $usuario]);
});

Route::get('/holaApi/{nombre?}', function ($nombre = 'Mundo') {
    return response()->json([
        'mensaje' => "Hola $nombre!"
    ]);
});
