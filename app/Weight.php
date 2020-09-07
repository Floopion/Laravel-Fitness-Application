<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Weight extends Model
{
  //SPRINT 3 > HERE also + UNCOMMENT line above // use Kyslik\ColumnSortable\Sortable;
  use Sortable;
  
  public $sortable = ['date','weight'];
  //SPRINT 3 >
  
  protected $fillable = [
    'date', 'weight', 'user_id'
  ];
  public function user()
    {
        return $this->belongsTo('App\User');
    }
}
