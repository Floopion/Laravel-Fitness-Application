<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weight;
use Auth;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();

        // SPRINT 3 > HERE Add Line with paginate(10)
        $weights = Weight::sortable()->paginate(10);
        // SPRINT 3 >

        return view('indexweight', compact('weights', 'user'));
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
        //
        $data = request()->validate([
            'date' => ['required', 'date'],
          ]);
          $temp = request()->validate([
            'other_type' => ['required', 'alpha'],
            'amount' => ['nullable', 'numeric'],
          ]);
          $data['user_id'] = auth()->user()->id;
          $data['weight'] = $request->amount;
          \App\Weight::create($data);
          return redirect('/recordadd')->with('confirm','The record was succesfully added to the database.');
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
        //
        $weight = Weight::find($id);
        return view('editWeight', compact('weight'));
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
        //
        $data = request()->validate([
            'weight' => ['required', 'integer'],
            'date' => ['required'],
        ]);

        $data = Weight::find($id);
        $data->weight = request('weight');
        $data->date = request('date');
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect('/weights')->with('confirm', 'The record was succesfully added to the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Weight::find($id);
        $data->delete();
        return redirect('/weights')->with('deleted', 'The record was succesfully deleted.');
    }
}
