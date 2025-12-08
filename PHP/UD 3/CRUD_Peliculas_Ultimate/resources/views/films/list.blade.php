@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Films</div>

        <div class="card-body">
          @foreach ( $films as $film )
            <img class="w-25 mb-1" src="{{ $film->poster }}"><br>
            <a class="fs-4" href="/film/detail/{{ $film->id }}">{{ $film->title }}</a> <br>
            Description: {{ $film->description }} 
            <hr>
          @endforeach
        </div>

        <div class="card-footer d-flex justify-content-center align-center">
          @if ($page > 1)
            <a href="/{{ $page - 1 }}"><button class="btn btn-primary mx-5">&lt;- Prev</button></a>
          @endif
          <span class="d-flex align-self-center">Page {{ $page }}</span>
          <a href="/{{ $page + 1 }}"><button class="btn btn-primary mx-5">Next -&gt;</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection