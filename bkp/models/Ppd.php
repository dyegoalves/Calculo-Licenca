<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppd extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nivel' , 'portes_id'
    ];
}
