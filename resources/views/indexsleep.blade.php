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
        <div class="card-header">Lifetime Sleep Stats</div>

        <div class="card-body success">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    
                    <!-- SPRINT 3 -->
                    <th class="sortNames">@sortablelink('date', 'Date')</th>
                    <th class="sortNames">@sortablelink('minutes', 'Minutes')</th>
                    <!-- SPRINT 3 -->

                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sleeps as $sleep)
                    <tr>
                      <th>{{$sleep['date']}}</th>
                      <th>{{$sleep['minutes']}}</th>
                      <th class="align-middle"><a href="{{url('/sleeps/' . $sleep->id . '/edit')}}" class="btn  btn-success">Edit</a></th>
                      <th>
                      <form method="POST" action="{{url('/sleeps/' . $sleep->id)}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <div class="alternate"><button onclick='return confirm("Are you sure?")' type ='submit' class='btn btn-danger'>Delete</button></div>
                      </form>
                      </th>
                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>

              {!! $sleeps->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
  </div>
</div>
@endsection