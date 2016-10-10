<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tamanho'
    ];
}
