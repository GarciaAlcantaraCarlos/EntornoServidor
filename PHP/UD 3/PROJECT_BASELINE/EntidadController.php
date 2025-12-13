<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidad;

class EntidadController extends Controller
{

    static function validarEntidad(Request $request) {
        $validation = $request->validate([
            'titulo' => 'required|string|max:255',
            'poster' => 'required|url|max:500',
            'anio' => 'required|integer|min:1888',
            'sinopsis' => 'required|string',
            'generos' => 'required|array|min:1',
        ]);
    }

    static function insertarEntidad(Request $request) {
        EntidadController::validarEntidad($request);
        
        $entidad = Entidad::create([
            'titulo' => $request->input('titulo'),
            'poster' => $request->input('poster'),
            'anio' => $request->input('anio'),
            'sinopsis' => $request->input('sinopsis'),
        ]);

        return $entidad;
    }

    static function editarEntidad(Request $request, $id) {
        EntidadController::validarEntidad($request);
        
        $entidad = Entidad::find($id);
        
        $entidad->update([
            'titulo' => $request->input('titulo'),
            'poster' => $request->input('poster'),
            'anio' => $request->input('anio'),
            'sinopsis' => $request->input('sinopsis'),
        ]);

        return $entidad;
    }
}
