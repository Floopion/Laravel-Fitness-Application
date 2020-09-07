<?php

namespace App\Http\Controllers;

use App\Sleep;
use Illuminate\Http\Request;
use Auth;

class SleepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $sleeps = Sleep::sortable()->paginate(10);

        return view('indexsleep', compact('sleeps', 'user'));
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
            'amount' => ['nullable', 'numeric'],
          ]);
          $data['user_id'] = auth()->user()->id;
          $data['minutes'] = $request->amount;
          \App\Sleep::create($data);
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
        $sleep = Sleep::find($id);
        return view('editsleep', compact('sleep'));
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
            'date' => ['required'],
            'amount' => ['nullable', 'numeric'],
        ]);

        $data = Sleep::find($id);
        $data->date = request('date');
        $data->minutes = request('minutes');
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect('/sleeps')->with('confirm', 'The record was succesfully added to the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sleep::find($id);
        $data->delete();
        return redirect('/sleeps')->with('deleted', 'The record was succesfully deleted.');
    }
}
