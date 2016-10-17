<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{

    protected $fillable = [
        'valor',
        'processo_id',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }


}
