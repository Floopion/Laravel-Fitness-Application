<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Auth;
use App\FoodType;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = auth()->user();
        // SPRINT 3 > HERE Add Line with paginate(10)
        $foods = Food::sortable()->paginate(10);
        // SPRINT 3 > COMPLETE
        
      return view('indexfood', compact('foods', 'user'));
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
      $data['food'] = $request->amount;
      \App\Food::create($data);
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
      $food = Food::find($id);
      return view('editFood', compact('food'));
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
      ]);

      $data = Food::find($id);
      $data->food_type_id = request('food');
      $data->date = request('date');
      $data->drinks = request('drinks');
      $data->calories = request('calories');
      $data->user_id = auth()->user()->id;

      $data->save();
      return redirect('/foods')->with('confirm', 'The record was succesfully added to the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Food::find($id);
      $data->delete();
      return redirect('/foods')->with('deleted', 'The record was succesfully deleted.');
    }
}
