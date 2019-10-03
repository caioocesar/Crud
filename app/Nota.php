<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
    protected $table = 'notas';

     protected $fillable = [
	 'valor',
	 'aluno_id'
	];

	public function aluno()
    {
        return $this->hasOne('App\Aluno'); //Apontando para seu model endereco
    }
}
