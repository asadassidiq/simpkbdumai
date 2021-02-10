<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $guarded = [];

    public function merek()
    {
        return $this->belongsTo('App\Merek');
    }
}
