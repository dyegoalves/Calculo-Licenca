<?php

namespace App;

use Faker\Provider\en_US\Person;
use Illuminate\Database\Eloquent\Model;

class Tipopreco extends Model
{
    protected $fillable = [
        'LI' ,
        'LP' ,
        'LO' ,
        'ppd_id',
    ];

    public function ppd()
    {
        return $this->belongsTo(Ppd::class);
    }
}
