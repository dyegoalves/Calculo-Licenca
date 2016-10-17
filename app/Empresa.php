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
        'fax',
        'endereco',
        'numero',
        'complemento',
        'CEP',
        'bairro',
        'cidade',
        'UF',
    ];


    //Relacao 1 .. N - Uma empresa pode ter varios empreendimentos
    public function empreendimento()
    {
        return $this->hasMany(Empreendimento::class);
    }


}
