<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

	public $incrementing = false;
    
    public function detail()
    {
        return $this->hasOne('App\Detail');
    }
}