<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class FilmController extends Controller
{
  public static function validateFilm(Request $request){
    $request->validate([
      "poster" => "required|string|url|max:255",
      "title" => "required|string|min:3|max:255",
      "releaseYear" => "required|integer|min:1900|max:2040",
      "genres" => "required|array|min:1",
      "genres.*" => "integer|min:1|max:8|exists:genres,id|distinct",
      "synopsis" => "required|string|min:25|max:2048"
    ]);
  }

    public static function insertFilm(Request $request) {
    FilmController::validateFilm($request);
    
    $data = $request->all();

    $newFilm = Film::create([
      'title' => $data['title'],
      'releaseYear' => $data['releaseYear'],
      'poster' => $data['poster'],
      'description' => $data['description'],
    ]);

    $newFilm->genres()->sync($data['genres']);

    return $newFilm;
  }

  public static function editFilm($id, Request $request) {
    FilmController::validateFilm($request);

    $data = $request->all();
    $film = Film::find($id);

    if ($film) {
      $film->title = $data['title'];
      $film->poster = $data['poster'];
      $film->releaseYear = $data['releaseYear'];
      $film->description = $data['description'];
      $film->genres()->sync($data['genres']);

      $film->save();
    }

    return $film;
  }
}
