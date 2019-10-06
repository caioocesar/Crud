<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class endereco extends Model
{
    protected $table = 'endereco';
     protected $primaryKey = "id";

    

     protected $fillable = [
	 'logradouro',
	 'numero',
	 'bairro'
	];

	function aluno(){
   		return $this->belongsTo('App/Aluno');
	}
}
