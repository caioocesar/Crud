<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
    protected $table = 'nota';
     protected $primaryKey = "id";

     protected $fillable = [
	 'valor',
	 'aluno_id'
	];

	public function aluno()
    {
        return $this->hasOne('App/Aluno'); 
    }
}
