<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Food extends Model
{
    //SPRINT 3 > HERE also + UNCOMMENT line above // use Kyslik\ColumnSortable\Sortable;
    use Sortable;

    public $sortable = ['date','food_type_id', 'drinks', 'calories'];
    //SPRINT 3 > COMPLETE
    
    protected $fillable = [
        'date', 'food_type_id', 'drinks', 'calories', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function food_type()
    {
        return $this->belongsTo('App\FoodType');
    }
}
