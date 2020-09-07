<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Workout;
use App\WorkoutType;
use App\FoodType;
use App\Food;
use Illuminate\Http\Request;

class SearchWorkoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $workoutTypes = WorkoutType::distinct()->pluck('name');
        $show = false;
        $message = "";

        return view('indexsearch', compact('workoutTypes', 'user', 'show', 'message'));
    }
    
    public function getSearch()
    {
        $user = auth()->user();
        $inputs = request('search-workout');
        $distance = request('search-distance');
        $message = "";
        $emptyCheck = "[]";

        //if only no inputs entered
        if ($inputs == "all" && $distance == null)
        {
            $workoutTypes = WorkoutType::distinct()->pluck('name');
            $show = false;
            $message = "Invalid Search. Please select a search field.";
        }
        //if only distance
        else if ($inputs == "all" && $distance != null)
        {
            $workouts = Workout::sortable()->where('distance', $distance)->get();
            $workoutTypes = WorkoutType::distinct()->pluck('name');
            $show = true;
            if ($workouts != $emptyCheck)
            {
                $message = "Results found for distance $distance.";
            }
            else
            {
                $message = "No Results found for distance $distance. Please search again.";
            }
        }
        //search for workout type and distance
        else if ($inputs != "all" && $distance != null)
        {
            $id = WorkoutType::where('name', $inputs)->get()->pluck('id');
            $workouts = Workout::sortable()->where('workout_type_id', $id)->Where('distance', $distance)->get();
            $workoutTypes = WorkoutType::distinct()->pluck('name');
            $show = true;
            if ($workouts != $emptyCheck)
            {
                $message = "Results found for $inputs where distance is $distance.";
            }
            else 
            {
                $message = "No results found for workout type $inputs where distance is $distance. Please search again.";
            }
        }
        //if only workout type
        else
        {
            $id = WorkoutType::where('name','LIKE', $inputs)->get()->pluck('id');
            $workouts = Workout::sortable()->where('workout_type_id', $id)->get();
            $show = true;
            $workoutTypes = WorkoutType::distinct()->pluck('name');
            $message = "Successful, records found for $inputs."; 
        }

        return view('indexsearch', compact('workouts', 'show', 'workoutTypes', 'message'));
    }
}
