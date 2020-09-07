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
        <div class="card-header">Lifetime Food Stats</div>

        <div class="card-body success">
            <div class="col-md-12">
            <div>
            </div>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    
                   <!-- SPRINT 3 Need to change TH for sortable fields-->
                   <th class="sortNames">@sortablelink('date', 'Date')</th>
                   <th class="sortNames">@sortablelink('food_type_id', 'Food Name')</th>
                   <th class="sortNames">@sortablelink('drinks', 'Drinks')</th>
                   <th class="sortNames">@sortablelink('calories', 'Calories')</th>
                  <!-- SPRINT 3 COMPLETE-->

                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($foods as  $food)
                    <tr>
                      <th>{{$food['date']}}</th>  
                      <th>{{$food->food_Type['name']}}</th>
                      <th>{{$food['drinks']}}</th>
                      <th>{{$food['calories']}}</th>
                      <th class="align-middle"><a href="{{url('/foods/' . $food->id . '/edit')}}" class="btn  btn-success">Edit</a></th>
                      <th><form method="POST" action="{{url('/foods/' . $food->id)}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <div class="alternate"><button onclick='return confirm("Are you sure?")' type='submit' class='btn btn-danger'>Delete</button></div>
                      </form></th>
                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>
              {!! $foods->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
