<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{

	protected $fillable = [
			'valor',
			'processo_id',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function processo()
	{
			return $this->belongsTo(Processo::class);
	}

}
