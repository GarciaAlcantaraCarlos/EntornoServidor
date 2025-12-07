<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Film extends Model
{
  protected $fillable = [
    'poster',
    'title',
    'releaseYear',
    'description'
  ];

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public function genres() {
    return $this->belongsToMany(Genre::class);
  }
}