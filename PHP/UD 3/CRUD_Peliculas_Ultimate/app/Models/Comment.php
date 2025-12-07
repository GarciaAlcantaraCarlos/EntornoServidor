<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['content', 'user_id', 'film_id'];

  public function film() {
    return $this->belongsTo(Film::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}