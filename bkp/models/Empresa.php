<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Empresa extends Model
{
    //Timestamps False
    public $timestamps = false;

    //Nome da tabela.
    protected $table   = 'empresas';

    //Fillable massing
    protected $fillable = [
        'cnpjcpf', 'nome', 'nomefantasia' , 'endereco' , 'telefone' , 'email', 'atividades_id' , 'subatividades_id', 'portes_id' , 'processos_id'
    ];

    public function processos()
    {
        return $this->belongsTo('App\Processo','processos_id', 'id');
    }

    public function atividades()
    {
        return $this->belongsTo('App\Atividade','atividades_id', 'id');
    }

}
