@extends('layouts.app')

@section('content')
<div class="container">
      @if($message != null)
        <div class="card-body success">
          <div class="alert alert-success">
              {{ $message }}
          </div>
          </div>
      @endif
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Search Records</div>

        <div class="card-body success">
            <div class="col-md-12">
              <div>
                <!--Sprint 4 / 5: Searching-->
                <form id="other-form" action="{{ url('searches/post') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="workout-search">Search Workout Type: </label>
                      <select class="form-control" name="search-workout">
                        <option value="all"></option>
                        @foreach($workoutTypes as $types)
                          <option value="{{$types}}">{{$types}}</option>
                        @endforeach
                      </select>
                      <br>
                      <label for="workout-distance-search">Distance: </label>
                      <input class="form-control" type="text" placeholder="e.g 30" name="search-distance">
                  </div>

                  <div class="form-group bottom-submit">
                    <button type="submit" class="btn btn-primary">Search Workout</button>
                  </div>
                </form>

                <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th class="sortNames">@sortablelink('date', 'Date')</th>
                    <th class="sortNames">@sortablelink('workout_type_id', 'Workout Name')</th>
                    <th class="sortNames">@sortablelink('distance', 'Distance')</th>
                    <th class="sortNames">@sortablelink('duration', 'Duration (Minutes)')</th>
                    <th class="sortNames">@sortablelink('calories', 'Calories')</th>
                  </tr>
                </thead>
                <tbody>
                @if($show)
                    @foreach($workouts as $workout)
                      <tr>
                        <th>{{$workout['date']}}</th>
                        <th>{{$workout->workout_Type['name']}}</th>
                        <th>{{$workout['distance']}}</th>
                        <th>{{$workout['duration']}}</th>
                        <th>{{$workout['calories']}}</th>
                      </tr>
                    @endforeach
                @endif
                </tbody>
                </tfoot>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
