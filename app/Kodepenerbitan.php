<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodepenerbitan extends Model
{
	protected $fillable = [ 'id', 'keterangan'];

    public function pendaftaran()
    {
    	return $this->hasMany('App\Pendaftaran');
    }
}
