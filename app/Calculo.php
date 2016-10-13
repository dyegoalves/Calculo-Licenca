<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{

    protected $fillable = [
        'valor',
        'processo_id',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }


}
