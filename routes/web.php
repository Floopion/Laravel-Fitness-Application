<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/success', function(){
  return view('success');
});

Auth::routes();

Route::get('/', 'WelcomeController@welcome');
Route::get('/home', 'HomeController@index');
Route::get('/stats', 'HomeController@stats');
Route::get('/calendar', 'HomeController@calendar');
Route::get('/recordadd', 'HomeController@recordAdd');
Route::get('/types', 'HomeController@types');

//sprint 5
Route::get('/users', 'FriendshipController@users');

Route::post('/friendship/{id}', 'FriendshipController@friendRequest');
Route::post('/friendshipAccept/{id}', 'FriendshipController@friendAccept');



Route::get('/targets/create', 'TargetController@create');
Route::post('/targets', 'TargetController@store');
Route::delete('/targets/{target}', 'TargetController@destroy');

Route::resource('workout-types', 'WorkoutTypeController');
Route::resource('food-types', 'FoodTypeController');

Route::resource('/workouts', 'WorkoutController');
Route::resource('/moods', 'MoodController');
Route::resource('/weights', 'WeightController');
Route::resource('/sleeps', 'SleepController');
Route::resource('/moods', 'MoodController');
Route::resource('/foods', 'FoodController');
//Route::resource('/searches', 'SearchController');
Route::get('/searches','SearchWorkoutController@index');
Route::post('/searches/post', 'SearchWorkoutController@getSearch');
Route::get('/searches/post', 'SearchWorkoutController@getSearch');

Route::post('/foods', 'RecordController@food');
//Route::post('/sleeps', 'RecordController@sleep');
//Route::post('/weights', 'RecordController@weight');
//Route::post('/workouts', 'RecordController@workout');
