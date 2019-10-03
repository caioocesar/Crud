<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class endereco extends Model
{
    protected $table = 'enderecos';

    

     protected $fillable = [
	 'logradouro',
	 'numero',
	 'bairro'
	];

	function aluno(){
   		return $this->belongsTo('App\Aluno');
	}
}
