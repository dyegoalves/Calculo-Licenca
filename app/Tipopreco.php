<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopreco extends Model
{
    protected $fillable = [
        'LI' ,
        'LP' ,
        'LO' ,
        'ppd_id',
    ];
}
