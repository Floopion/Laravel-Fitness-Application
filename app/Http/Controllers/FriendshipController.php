<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FriendshipController extends Controller
{
    //
    public function friendRequest($id)
    {
        $user = auth()->user();
        $recipient = User::find($id);
        $user->befriend($recipient);
        //$user->befriend($id);
        return redirect('/users');
    }

    public function friendAccept($id)
    {
        $user = auth()->user();
        //$id = User::where('name',$name)->pluck('id');
        $sender = User::find($id);

        $user->acceptFriendRequest($sender);
        //$user->befriend($id);
        return redirect('/users');
    }

    //sprint 4 friendships
  public function users()
  {
    $user = auth()->user();
    $users = User::sortable()->paginate(10);
    //
    $friendPendingNames = [];
    $friendsPending = $user->getPendingFriendships();
    foreach($friendsPending as $friend)
    {
       $friendPendingName = User::find($friend)->pluck('name');
       array_push($friendPendingNames,$friendPendingName);
       
    //   //add to an array. and display the array.
    }


    $friendsRequestsReceived = $user->getFriendRequests();
    //gets a list of ids of friends
    $friendNames = [];
    
    $friends = $user->getFriends();
    //
    foreach($friends as $friend)
    {
       $friendName = User::find($friend)->pluck('name');
       array_push($friendNames,$friendName[0]);
       
    //   //add to an array. and display the array.
    }

    return view('indexusers', compact('users', 'user', 'friendsPending', 'friendsRequestsReceived', 'friends', 'friendNames','friendPendingNames'));
  }
    
}

