@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit Weight Record</div>
    <div class="card-body">

      <form action="{{ url('moods/' . $mood->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Mood</label>
          <input type="text" id="mood" name="mood" class="form-control" value="{{ $mood->mood }}" required>
        </div>
        <div class="form-group">
          <label for="name">Date</label>
          <input type="date" id="date" name="date" class="form-control" value="{{ $mood->date }}" required>
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
