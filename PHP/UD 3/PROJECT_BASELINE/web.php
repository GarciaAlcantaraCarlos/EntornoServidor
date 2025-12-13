<?php

use App\Models\Entidad;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\EntidadController;
use Illuminate\Validation\ValidationException;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        $entidads = Entidad::all();
        return view('lista-entidads', ['entidads' => $entidads]);
    });

    Route::get('/entidad/detail/{id}', function ($id) {
        $entidad = Entidad::findOrFail($id);
        return view('detalle-entidads', ['entidad' => $entidad]);
    });

});

Route::group(['middleware' => 'role:admin'], function () {

    Route::get('/entidad/create', function () {
        return view('nueva-entidad');
    });

    Route::post('/entidad/create', function (Request $request) {
        try {
            $entidad = EntidadController::insertarEntidad($request);
            $salida = redirect("/entidad/detail/{$entidad->id}");
        } catch (ValidationException $e) {
            $salida = redirect()->back()->withErrors($e->errors())->withInput();
        }

        return $salida;

    });

    Route::get('/entidad/update/{id}', function ($id) {
        $entidad = Entidad::findOrFail($id);
        return view('editar-entidad', ['entidad' => $entidad]);
    });

    Route::post('/entidad/update/{id}', function (Request $request, $id) {
        try {
            $entidad = EntidadController::editarEntidad($request, $id);
            $salida = redirect("/entidad/detail/{$entidad->id}");
        } catch (ValidationException $e) {
            $salida = redirect()->back()->withErrors($e->errors())->withInput();
        }

        return $salida;
    });

});


Auth::routes();