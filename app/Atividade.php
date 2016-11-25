<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = [
        'codigo', 'descricao'
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function subatividade()
    {
        return $this->hasMany(Subatividade::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function empreendimento()
    {
        return $this->hasOne(Empreendimento::class);
    }

}
