<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mood;
use Auth;

class MoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        
        //SPRINT 3 >
        $moods = Mood::sortable()->paginate(10);
        //SPRINT 3 >

        return view('indexmood', compact('moods', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'date' => ['required', 'date'],
        ]);
        $temp = request()->validate([
            'other_type' => ['required', 'alpha'],
            'amount' => ['nullable', 'integer', 'between:1,10'],
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['mood'] = $request->amount;
        \App\Mood::create($data);
        return redirect('/recordadd')->with('confirm', 'The record was succesfully added to the database.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mood = Mood::find($id);
        return view('editMood', compact('mood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'mood' => ['required', 'integer', 'between:1,10'],
            'date' => ['required'],
        ]);

        $data = Mood::find($id);
        $data->mood = request('mood');
        $data->date = request('date');
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect('/moods')->with('confirm', 'The record was succesfully added to the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mood::find($id);
        $data->delete();
        return redirect('/moods')->with('deleted', 'The record was succesfully deleted.');
    }
}
