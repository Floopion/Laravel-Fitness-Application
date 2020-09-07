<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workout;
use Auth;
use Illuminate\Validation\Rule;
use App\WorkoutType;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $workouts = Workout::sortable()->paginate(10);

        return view('indexworkout', compact('workouts', 'user'));
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
      'workout_type_id' => ['required', 'integer', Rule::in(WorkoutType::all()->pluck('id'))],
      'distance' => ['nullable', 'integer'],
      'calories' => ['required', 'integer'],
    ]);
    $temp = request()->validate([
      'duration-hh' => ['nullable','integer'],
      'duration-mm' => ['required', 'integer', 'between:0,60'],
    ]);
    $data['user_id'] = auth()->user()->id;
    $data['duration'] = $temp['duration-hh'] * 60 + $temp['duration-mm'];
    if ($request->denomination != 'calories') {
      $data['calories'] = round($data['calories'] / 4,184);
    }
    if(!$data['distance']) {
      $data['distance'] = 0;
    }
    Workout::create($data);
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
        $workout = Workout::find($id);
        return view('editworkout', compact('workout'));
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
        /*$data = request()->validate([
            'date' => ['required', 'date'],
            'distance' => ['nullable', 'integer'],
            'calories' => ['required', 'integer'],
          ]);*/

        $data = Workout::find($id);
        $data->date = request('date');
        //$data->workout_type_id = request('workout_type_id');
        $data->distance = request('distance');
        $data->duration = request('duration');
        $data->calories = request('calories');
        $data->user_id = auth()->user()->id;

        $data->save();
        return redirect('/workouts')->with('confirm', 'The record was succesfully added to the database.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Workout::find($id);
        $data->delete();
        return redirect('/workouts')->with('deleted', 'The record was succesfully deleted.');
    }
}
