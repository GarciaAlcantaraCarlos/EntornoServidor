@extends('layout')

@section('titulo', 'Creación de usuario')

@section('contenido')
  <h1>{{ $respuesta['nombre'] }}</h1>
  <h4>{{ $respuesta['email'] }}</h4>
@endsection
