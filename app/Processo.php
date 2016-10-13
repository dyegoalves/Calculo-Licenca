<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{

    protected $fillable = [
        'numero',
        'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function calculo()
    {
        return $this->hasMany(Calculo::class);
    }


}
