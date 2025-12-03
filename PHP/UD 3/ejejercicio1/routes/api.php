<?php

use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiControl;

Route::post('/usuario', function (Request $request) {
  ApiControl::validarEmail();
  $nuevoUsuario = Usuario::create([
    'nombre' => $request->input('nombre'),
    'email' => $request->input('email')
  ]);
  return $nuevoUsuario;
});

Route::get('/usuario', function () {
  return Usuario::all();
});

Route::get('/usuario/{id}', function ($id) {
  return Usuario::find($id);
});

Route::put('/usuario/{id}', function (Request $request, $id) {
  $data = $request->all();

  $usuario = Usuario::find($id);
  $usuario->nombre = $data['nombre'];
  $usuario->email = $data['email'];

  return $usuario->save();
});

Route::delete('/usuario/{id}', function ($id) {
  return Usuario::destroy($id);
});
