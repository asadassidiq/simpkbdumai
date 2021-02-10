<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $guarded = [];
 	
 	public function tipe()
    {
    	return $this->hasMany('App\Tipe');
    }
}
