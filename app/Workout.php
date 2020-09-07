<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Workout extends Model
{

  use Sortable;

  public $sortable = ['date', 'workout_type_id', 'distance', 'duration', 'calories'];

    protected $fillable = [
        'date', 'workout_type_id', 'distance', 'duration', 'calories', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function workout_type()
    {
        return $this->belongsTo('App\WorkoutType');
    }
}
