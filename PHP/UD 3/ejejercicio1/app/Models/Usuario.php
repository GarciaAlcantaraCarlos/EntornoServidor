<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nombre', 'email'];

    // Usuario::create(['nombre' => 'Juan', 'email' => 'ex@am.ple']);
}
