@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Films</div>

        <div class="card-body">
          <img class="img-fluid rounded-2 mb-4" src="{{ $film->poster }}">
          <h1>{{ $film->title }}</h1>
          Release: {{ $film->releaseYear }} <br>
          Description: {{ $film->description }} <br>
          Creation: {{ $film->created_at }}
        </div>
        
        <div class="card-body">
          <h2>Comments</h2>
          @foreach ($film->comments as $comment)
            <strong>{{ $comment->user->name ?? 'Deleted user'}}</strong><br>
            {{ $comment->content }}<br>
            @if (Auth::user()->role === 'admin')
              <a href="/comment/delete/{{ $comment->id }}"><button class="btn btn-danger btn-sm mt-1">Delete comment</button></a>
            @endif
            <hr>
          @endforeach
          <form action="/comment/create/{{ $film->id }}" method="POST">
            @csrf
            <label class="form-label" for="comment">New comment</label>
            <textarea class="form-control mb-2" name="commentBody" id="comment"></textarea>
            <button class="btn btn-primary" type="submit">Publish comment</button>
          </form>
        </div>

        @if (Auth::user()->role === 'admin')
          <div class="card-footer">
            <a href="/film/delete/{{ $film->id }}">
              <button class="btn btn-danger">Delete film</button>
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
