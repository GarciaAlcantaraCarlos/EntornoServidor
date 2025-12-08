@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <form action="" method="POST">
          @csrf
          <div class="card-header">New film</div>

          <div class="card-body">
            <div class="mb-2">
              <label class="form-label" for="title">Title</label>
              <input class="form-control" type="text" name="title" id="title">
            </div>

            <div class="mb-2">
              <label class="form-label" for="releaseYear">Relesase year</label>
              <input class="form-control" type="number" name="releaseYear" id="releaseYear">
            </div>

            <div class="mb-2">
              <label class="form-label" for="poster">Link to poster</label>
              <input class="form-control" type="text" name="poster" id="poster">
            </div>

            <div>
              <p class="fs-6">Genre</p>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="1">Action</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="2">Comedy</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="3">Drama</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="4">Horror</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="5">Sci-Fi</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="6">Fantasy</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="7">Documentary</label>
              <label class="form-check-label me-3"><input class="form-check-input" type="checkbox" name="genres[]" value="8">Romance</label>
            </div>

            <div class="mb-2">
              <label class="form-label mt-4" for="description">Description</label>
              <textarea class="form-control" name="description" id="description"></textarea>
            </div>
          </div>

          <div class="card-footer"> 
            <button type="submit" class="btn btn-primary">Create film</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
