<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Sleep extends Model
{
  use Sortable;

  public $sortable = ['date','minutes'];
  
  protected $fillable = [
    'date', 'minutes', 'user_id'
  ];
  public function user()
    {
        return $this->belongsTo('App\User');
    }
}