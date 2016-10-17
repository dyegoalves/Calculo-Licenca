<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{

    protected $fillable = [
        'tamanho'
    ];

    public function empreendimento()
    {
       return $this->hasMany(Empreendimento::class);
    }

    public function ppd()
    {
        return $this->hasMany(Ppd::class);
    }

}
