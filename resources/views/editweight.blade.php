@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Edit workout type</div>
    <div class="card-body">

      <form action="{{ url('weights/' . $weight->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Weight</label>
          <input type="text" id="weight" name="weight" class="form-control" value="{{ $weight->weight }}" required>
        </div>
        <div class="form-group">
          <label for="name">Weight Rating</label>
          <input type="date" id="date" name="date" class="form-control" value="{{ $weight->date }}" required>
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
