<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = [
        'codigo', 'descricao'
    ];


    public function subatividade()
    {
        return $this->hasMany(Subatividade::class);
    }


}
