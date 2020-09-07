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
        <div class="card-header">Lifetime Mood Stats</div>

        <div class="card-body success">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <!-- SPRINT 3 Need to change TH for sortable fields-->
                    <th class="sortNames">@sortablelink('date', 'Date')</th>
                    <th class="sortNames">@sortablelink('mood', 'Mood')</th>
                    <!-- SPRINT 3 -->

                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($moods as  $mood)
                    <tr>
                    <th>{{$mood['date']}}</th>  
                    <th>{{$mood['mood']}}</th>
                      <th class="align-middle"><a href="{{url('/moods/' . $mood->id . '/edit')}}" class="btn  btn-success">Edit</a></th>
                      <th><form method="POST" action="{{url('/moods/' . $mood->id)}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <div class="alternate"><button onclick='return confirm("Are you sure?")' type='submit' class='btn btn-danger'>Delete</button></div>
                      </form></th>
                    </tr>

                    

                  @endforeach
                  
                </tbody>
                </tfoot>
              </table>
  
              {!! $moods->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
