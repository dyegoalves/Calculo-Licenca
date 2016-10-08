<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Atividade extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'descricao'
    ];

    public function subatividades()
    {
        return $this->hasOne('App\Subatividade', 'atividades_id');
    }


}
