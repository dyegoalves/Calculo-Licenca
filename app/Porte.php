<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{

    protected $fillable = [
        'tamanho'
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function empreendimento()
    {
       return $this->hasMany(Empreendimento::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ppd()
    {
        return $this->hasMany(Ppd::class);
    }

}
