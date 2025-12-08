<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public static function validateFilm(Request $request, $id = 0){
    $request->validate([
      "content" => "required|string|min:20|max:500",
    ]);
  }

  public static function insertComment(Request $request, $film_id) {
    $data = $request->all();

    $newComment = Comment::create([
      'content' => $data['commentBody'],
      'user_id' => Auth::user()->id,
      'film_id' => $film_id
    ]);

    return $newComment;
  }

  public static function editComment($id, Request $request) {

  }
}
