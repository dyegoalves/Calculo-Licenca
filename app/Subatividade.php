<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subatividade extends Model
{

    protected $fillable = [
        'codigo' , 'descricao' , 'atividade_id', 'ppd_id',
    ];

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

}
