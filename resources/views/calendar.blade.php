@extends('layouts.app')

@section('head')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js" def></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Calendar</div>
        <a href = "{{ url('/recordadd') }}" style="text-decoration: none"><button id="addButton" type="button" class="btn btn-success" style="margin: 10px auto 0 auto;display: block;">Add new Record</button></a>
        <div class="card-body types">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

  $(document).ready(function() {
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
      // put your options and callbacks here
        eventClick: function(event, jsEvent, view) {
          window.location.href = "{{ url('/workouts') }}" + "/" + event._id + "/edit";
        },
      events : [
          @foreach($workouts as $workout)
        {
          id: {{$workout->id}},
          title : ' {{$workout->workout_type->name . ": " . $workout->duration . " min"}}',
          allDayDefault: true,
          start: '{{ $workout->date }}',
          editable: true,
        },
        @endforeach
      ]
    });
  });
</script>
@endsection
