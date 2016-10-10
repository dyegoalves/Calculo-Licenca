<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    public $timestamps = false;
    protected $table = 'processos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'numero',
    ];
    public function empresas()
    {
        return $this->hasOne('App\Empresa', 'id');
    }

}
