@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Films</div>

        <div class="card-body">
          Poster: {{ $film->poster }} <br>
          Title: {{ $film->title }}<br>
          Description: {{ $film->description }} 
          Release: {{ $film->releaseYear }} <br>
          Creation: {{ $film->created_at }} <br>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
