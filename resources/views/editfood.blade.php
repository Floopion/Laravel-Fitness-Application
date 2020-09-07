@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit Meal</div>
    <div class="card-body">

      <form action="{{ url('foods/' . $food->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Date</label>
          <input type="date" id="date" name="date" class="form-control" value="{{ $food->date }}" required>
        </div>
        <div class="form-group">
          <label for="name">Drinks</label>
          <input type="text" id="drinks" name="drinks" class="form-control" value="{{ $food->drinks }}" required>
        </div>
        <div class="form-group">
          <label for="name">Calories</label>
          <input type="text" id="calories" name="calories" class="form-control" value="{{ $food->calories }}" required>
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
