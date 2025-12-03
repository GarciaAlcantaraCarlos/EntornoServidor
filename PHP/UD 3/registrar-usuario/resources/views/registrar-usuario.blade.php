@extends('layout')

@section('titulo', 'Creación de usuario')

@section('contenido')
  <h1>Nuevo usuario</h1>  
  <form action="./registrar-usuario" method="POST">
    @csrf
    <label>Nombre: <input type="text" name="nombre" id="nombre"></label>
    <label>Email: <input type="email" name="email" id="email"></label>
    <input type="submit" value="Registrar">
  </form>
@endsection
