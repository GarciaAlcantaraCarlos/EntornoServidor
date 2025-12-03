<?php

use Illuminate\Support\Facades\Route; // Importamos la clase Route
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Calculadora;
use Illuminate\Http\Request;

Route::get('/hola/{nombre?}', function ($nombre = 'Mundo') {
    return view('hola', ['nombre' => $nombre]);
});

Route::get('/edad/{edad?}', function ($edad = 18) {
    return view('edad', ['edad' => $edad]);
});

Route::get('/numeros/{size}', function ($size) {
    $calculadora = new Calculadora();
    $numeros = $calculadora->obtenerListaNumeros($size);
    
    return view('numeros', [
        'numeros' => $numeros,
        'size' => $size
    ]);
});

// =============================================

Route::get('/registrar-usuario', function () {
    return view('registrar-usuario');
});

Route::post('/registrar-usuario', function (Request $request) {

    $controlador = new UsuarioController();

    try {
        $respuesta = $controlador->insertarUsuario($request);
        $respuesta = redirect("/usuario/$respuesta[id]");
    } catch (ValidationException $e) {
        $respuesta = $e->errors();
    }

    return $respuesta;
});

Route::get('/usuario/{id}', function ($id) {
    
    $controlador = new UsuarioController();

    $respuesta = $controlador->obtenerUsuario($id);

    return view('detalle-usuario', ['respuesta' => $respuesta]);
});