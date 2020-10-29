<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodewilayah extends Model
{
    protected $table= 'kodewilayah';
    protected $primaryKey = 'idx';
    protected $fillable = ['idx', 'kodewilayah', 'namawilayah'];
    protected $pKeyType = 'bigint';
}
