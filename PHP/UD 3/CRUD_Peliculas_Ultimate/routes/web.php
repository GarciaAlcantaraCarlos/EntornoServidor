<?php

use App\Http\Controllers\Content\FilmController;
use App\Http\Controllers\Content\CommentController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# AUTH
Route::get('/login', function() {
  return view('auth/login');
});

Auth::routes();


# CONTENT
Route::get('/{page?}', function ( $page = 1 ) {
  $films = Film::paginate(10, '*', 'page', (int) $page);
  return view('films/list', [ 'films' => $films, 'page' => (int) $page ]);
})->middleware('auth');

Route::get('/film/detail/{id}', function ( $id ) {
  $film = Film::with('comments.user')->findOrFail($id);
  return view('films/detail', [ 'film' => $film ]);
})->middleware('auth');

Route::get('/film/create', function () {
  return view('films/create');
})->middleware('admin');

Route::post('/film/create', function (Request $request) {
  try{
    $newFilm = FilmController::insertFilm($request);
    $response = redirect('/film/detail/' . $newFilm->id);
  } catch (ValidationException $e) {
    $response = back()->withErrors($e->errors());
  }

  return $response;
})->middleware('admin');

Route::get('/film/delete/{id}', function ( $id ) {
  Film::destroy($id);
  return redirect('/');
})->middleware('admin');

Route::post('/comment/create/{film_id}', function ( Request $request, $film_id ) {
  try{
    CommentController::insertComment($request, $film_id);
    $response = redirect('/film/detail/' . $film_id);
  } catch (ValidationException $e) {
    $response = back()->withErrors($e->errors());
  }

  return $response;
})->middleware('auth');

Route::get('/comment/delete/{id}', function ( $id ) {
  Comment::destroy($id);
  return back();
})->middleware('admin');


# DEFAULTS
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
