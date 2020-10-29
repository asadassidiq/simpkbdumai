<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identitaskendaraan extends Model
{
    protected $guarded = [];

    public function pendaftaran()
    {
    	return $this->hasMany('App\Pendaftaran');
    }
}
