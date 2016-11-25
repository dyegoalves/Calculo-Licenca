<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subatividade extends Model
{
    protected $fillable = [
        'codigo' , 'descricao' , 'atividade_id', 'ppd_id',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
    public function empreendimento()
    {
        return $this->hasOne(Empreendimento::class);
    }
    public function ppd()
    {
        return $this->belongsTo(Ppd::class);
    }

}
