<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
	public $incrementing = false;
    
    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}