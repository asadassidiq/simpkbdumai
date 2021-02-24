<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftranOld extends Model
{
    protected $table= 'pendaftaraan';
    protected $primaryKey = 'idx';
    protected $pKeyType = 'bigint';
    public $timestamps = false;
}
