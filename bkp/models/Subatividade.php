<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subatividade extends Model
{
    public $timestamps = false;

    public  $tables = "subatividades";

    protected $fillable = [
        'codigo' ,
        'descricao' ,
        'atividades_id',
        'ppd_id',
    ];

    public function atividades()
    {
        return $this->belongsTo('App\Atividade', 'id');
    }

}
