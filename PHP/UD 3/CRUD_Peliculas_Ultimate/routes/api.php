<?php

use App\Http\Controllers\Content\FilmController;
use App\Models\Film;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/film', function () {
  return Film::all()->load('genres');
});

Route::get('/film/{id}', function ($id) {
  return Film::find($id)->load('genres');
});

Route::post('/film', function (Request $request) {
  try{
    $response = FilmController::insertFilm($request);
  } catch (ValidationException $e) {
    $response = "Could not perform insertion";
  }

  return $response;
});

Route::put('/film/{id}', function ($id, Request $request) {
  try{
    $response = FilmController::editFilm($id, $request);
  } catch (ValidationException $e) {
    $response = $e->errors();
  }
});

Route::delete('/film/{id}', function ($id) {
  return Film::destroy($id);
});
