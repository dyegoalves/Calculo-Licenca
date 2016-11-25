<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppd extends Model
{
    protected $fillable = [
        'nivel' , 'porte_id'
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function porte()
    {
        return $this->belongsTo(Porte::class);
    }
    public function subatividade()
    {
        return $this->hasMany(Subatividade::class);
    }
    public function tipopreco()
    {
        return $this->hasMany(Tipopreco::class);
    }

}
