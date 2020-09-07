@extends('layouts.app')

@section('content')
  <?php $friendNum = 0 ?>
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
        <div class="card-header">Users</div>

        <div class="card-body success">
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                   <th class="sortNames">@sortablelink('name', 'Name')</th>
                   <th class="sortNames">@sortablelink('email', 'Email')</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as  $user)
                    <tr>
                      <th>{{$user['name']}}</th>
                      <th>{{$user['email']}}</th>
                      {{csrf_field()}}
                      <th class="align-middle">
                      <form method="POST" action="{{url('/friendship/' . $user->id)}}">
                      {{csrf_field()}}
                      <div class="alternate"><button type ='submit' class="btn  btn-success">Add</button></div></th>
                      </form>


                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>
              {!! $users->appends(\Request::except('page'))->render() !!}
            </div>

            Pending Requests
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                   <th class="sortNames">@sortablelink('name', 'Name')</th>
                   <th class="sortNames">@sortablelink('email', 'Name')</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($friendPendingNames as  $friendPending)
                    <tr>
                      <th>{{$friendPending[0]}}</th>
                      {{csrf_field()}}
                      <th>{{$friendPending[1]}}</th>
                    @if(count($friendsRequestsReceived) > 0)
                      <th>
                        <form method="POST" action="{{url('/friendshipAccept/' . $friendsRequestsReceived[$friendNum]->sender_id)}}">
                          {{csrf_field()}}
                          <div class="alternate"><button type ='submit' class="btn  btn-success">Add</button></div>
                        </form>
                      </th>
                      </tr>
                      <?php $friendNum ++ ?>
                    @endif
                  @endforeach
                </tbody>
                </tfoot>
              </table>
            </div>

            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                   <th class="sortNames">@sortablelink('name', 'User Id')</th>
                   <th class="sortNames">@sortablelink('email', 'User Id')</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($friendsRequestsReceived as  $friendRequest)
                    <tr>
                      <th>{{$friendRequest->sender_id}}</th>
                      <th>{{$friendRequest->recipient_id}}</th>
                      <th>
                      <form method="POST" action="{{url('/friendshipAccept/' . $friendRequest->sender_id)}}">
                      {{csrf_field()}}
                      <div class="alternate"><button type ='submit' class="btn  btn-success">Add</button></div>
                      </form>
                      </th>




                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>
            </div>

            My Friends
            <div class="col-md-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                   <th>Friend</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($friendNames as  $friend)
                    <tr>
                      <th>{{$friend}}</th>
                    </tr>
                  @endforeach
                </tbody>
                </tfoot>
              </table>
            </div>

        </div>
    </div>
  </div>
</div>
@endsection
