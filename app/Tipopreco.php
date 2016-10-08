<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopreco extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'precoLI' ,
        'precoLP' ,
        'precoLO' ,
        'ppds_id' ,
    ];

}
