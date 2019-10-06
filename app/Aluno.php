<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aluno extends Model
{
    protected $table = 'aluno';

    protected $primaryKey = "id";
  


    protected $fillable = [
	 'nome',
	 'cpf',
	 'matricula',
	 'endereco_id'
	];

	function endereco(){
   		return $this->hasOne('App/Endereco','endereco_id','id');
	}
}
