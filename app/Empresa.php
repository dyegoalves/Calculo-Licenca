<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $fillable = [
        'razaoSocial',
        'nomeFantasia',
        'CNPJ',
        'inscEstadual',
        'email',
        'telefone',
        'celular',
        'endereco',
        'numero',
        'complemento',
        'CEP',
        'bairro',
        'cidade',
        'UF',
        'porte_id',

    ];


    //Relacao 1 .. N - Uma empresa pode ter varios processos
    public function processo()
    {
        return $this->hasMany(Processo::class);
    }

    //Relacao 1 .. N - Uma empresa pode ter varios calculo
    public function calculo()
    {
        return $this->hasMany(Calculo::class);
    }

}
