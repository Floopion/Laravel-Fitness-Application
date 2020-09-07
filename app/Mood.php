<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Mood extends Model
{
  //SPRINT 3 > Need to add these lines in each Model with different sortable variables in ['']
  use Sortable;

  public $sortable = ['date','mood'];
  //SPRINT 3 >
  
  protected $fillable = [
    'date', 'mood', 'user_id'
  ];
  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
