<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('films/list');
})->middleware('auth');


# AUTH
Route::get('/login', function() {
    return view('auth/login');
});

Auth::routes();


# CONTENT
Route::get('/film/detail/{id}', function ( $id ) {
    return view('films/detail', [ 'id' => $id ]);
})->middleware('auth');

Route::get('/film/create', function () {
    return view('films/create');
})->middleware('admin');

Route::get('/film/delete/{id}', function ( $id ) {
    return view('films/delete', [ 'id' => $id ]);
})->middleware('admin');

Route::get('/comment/create/{film_id}', function ( $film_id ) {
    return view('comments/create', [ 'film_id' => $film_id ]);
})->middleware('auth');

Route::get('/comment/delete/{id}', function ( $id ) {
    return view('comments/delete', [ 'id' => $id ]);
})->middleware('admin');


# DEFAULTS
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
