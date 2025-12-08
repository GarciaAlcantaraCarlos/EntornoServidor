<?php

use Illuminate\Support\Facades\Route;

Route::get('/films', function () {
    return 'todas las peliculas';
});

Route::get('/films/{id}', function () {
    return 'una pelicula';
});

Route::post('/films', function () {
    return 'crear pelicula';
});

Route::put('/movies/{id}', function () {
    return 'actualizar película';
});

Route::get('/movies/{id}', function () {
    return 'Eliminar película';
});
