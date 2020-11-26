<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $guarded = [];
	
    public function identitaskendaraan()
    {
    	return $this->belongsTo('App\Identitaskendaraan', 'identitaskendaraan_id');
    }

    public function kodepenerbitans()
    {
    	return $this->belongsTo('App\Kodepenerbitan');
    }

    public function datakendaraans()
    {
        return $this->belongsTo('App\Datakendaraan');
    }

    public function transaksi(){
        return $this->hasOne('App\Transaksi');
    }
}
