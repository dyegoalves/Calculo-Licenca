<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'avatar', 'funcao' , 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

		public function processo()
		{
			return $this->hasMany(Processo::class);
		}

}
