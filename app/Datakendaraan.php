<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datakendaraan extends Model
{
    protected $guarded = [];

    public function pendaftaran()
    {
    	return $this->hasOne('App\Pendaftaran');
    }

    public function identitaskendaraan()
    {
    	return $this->belongsTo('App\Identitaskendaraan', 'identitaskendaraan_id');
    }
    
}
