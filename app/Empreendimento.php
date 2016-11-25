<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empreendimento extends Model
{
    protected $fillable = [
        "basedecalculo01" ,
        "basedecalculo02" ,
        "processo_id" ,
        "empresa_id" ,
        "porte_id" ,
        "atividade_id" ,
        "subatividade_id"
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }
    public function porte()
    {
        return $this->belongsTo(Porte::class);
    }
    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
    public function subatividade()
    {
        return $this->belongsTo(Subatividade::class);
    }

}
