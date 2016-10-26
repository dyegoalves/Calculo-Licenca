<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{

    protected $fillable = [
        'num_processo',
    ];


    public function calculo()
    {
        return $this->hasOne(Calculo::class);
    }

    public function empreendimento()
    {
        return $this->hasOne(Empreendimento::class);
    }


}
