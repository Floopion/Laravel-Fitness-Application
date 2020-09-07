@extends('layouts.app')

@section('content')
<div class="container">
        @if(session()->has('deleted'))
        <div class="card-body success">
          <div class="alert alert-success">
              {{ session()->get('deleted') }}
          </div>
          </div>
          @endif
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Lifetime Workout Stats</div>

        <div class="card-body success">
            <div class="col-md-12">
            <div>
              </div>
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                    <th class="sortNames">@sortablelink('date', 'Date')</th>
                    <th class="sortNames">@sortablelink('workout_type_id', 'Workout Name')</th>
                    <th class="sortNames">@sortablelink('distance', 'Distance')</th>
                    <th class="sortNames">@sortablelink('duration', 'Duration (Minutes)')</th>
                    <th class="sortNames">@sortablelink('calories', 'Calories')</th>

                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($workouts as $workout)
                    <tr>
                    <th>{{$workout['date']}}</th>
                    <th>{{$workout->workout_Type['name']}}</th>
                      <th>{{$workout['distance']}}</th>
                      <th>{{$workout['duration']}}</th>
                      <th>{{$workout['calories']}}</th>

                      <th class="align-middle"><a href="{{url('/workouts/' . $workout->id . '/edit')}}" class="btn  btn-success">Edit</a></th>
                      <th><form method="POST" action="{{url('/workouts/' . $workout->id)}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <div class="alternate"><button onclick='return confirm("Are you sure?")' type='submit' class='btn btn-danger'>Delete</button></div>
                      </form></th>
                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>
              {!! $workouts->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
