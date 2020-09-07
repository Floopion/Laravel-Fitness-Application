@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit Workout Record</div>
    <div class="card-body">

      <form action="{{ url('workouts/' . $workout->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label for="name">Date</label>
          <input type="date" id="date" name="date" class="form-control" value="{{ $workout->date }}" required>
        </div>

        <div class="form-group">
          <label for="name">Distance</label>
          <input type="text" id="distance" name="distance" class="form-control" value="{{ $workout->distance }}" required>
        </div>
        
        <div class="form-group">
          <label for="name">Duration</label>
          <input type="text" id="duration" name="duration" class="form-control" value="{{ $workout->duration }}" required>
        </div>
        
        <div class="form-group">
          <label for="name">Calories</label>
          <input type="text" id="calories" name="calories" class="form-control" value="{{ $workout->calories }}" required>
        </div>
        
        
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      @include('errors')
    </div>
  </div>
</div>
@endsection