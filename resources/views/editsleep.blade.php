@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit sleep</div>
    <div class="card-body">

      <form action="{{ url('sleeps/' . $sleep->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Sleep Date</label>
          <input type="date" id="date" name="date" class="form-control" value="{{ $sleep->date }}" required>
        </div>
        <div class="form-group">
          <label for="name">Minutes</label>
          <input type="text" id="minutes" name="minutes" class="form-control" value="{{ $sleep->minutes }}" required>
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