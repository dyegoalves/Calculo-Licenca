<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Processo extends Model
{

    protected $fillable = [
        "num_processo", "situacao" , "user_id"
    ];

    public function calculo()
    {
        return $this->hasOne(Calculo::class);
    }

    public function empreendimento()
    {
        return $this->hasOne(Empreendimento::class);
    }

		public function user()
		{
			return $this->belongsTo(User::class);
		}

}
