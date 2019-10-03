<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Endereco;
use App\Nota;


class controllerCrud extends Controller
{

    public function cadastrar(Request $request)
    {
    	 $endereco= new Endereco;
		 $endereco->logradouro = $request->input('logradouro') ;
		 $endereco->numero = $request->input('numero') ;
		 $endereco->bairro= $request->input('bairro') ;
		 $endereco->save();
    
		 
    	 $aluno= new Aluno;
		 $aluno->nome = $request->input('nome') ;
		 $aluno->cpf = $request->input('cpf') ;
		 $aluno->matricula= $request->input('matricula') ;
		 $aluno->endereco_id = $endereco->id;
		 $aluno->save();


		 $nota= new Nota;
		 $nota->valor = $request->input('nota') ;
		 $nota->aluno_id = $aluno->id;
		 $nota->save();

		 return view('welcome')->withMessage('Aluno cadastrado com sucesso!');
    }

    public function buscar(Request $request)
    {
    	 $opcao = $request->input('opcao_busca');
    	 $pesquisa = $request->input('pesquisa');
    	 
    	 
    	 if(strcmp($opcao,'CPF') == 0)
    	 {
    	 	$aluno = Aluno::where('cpf', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		return view('busca')->withDetails($aluno);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Nome') == 0)
    	 {
    	 	$aluno = Aluno::where('nome', '=', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		return view('busca')->withDetails($aluno);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Matrícula') == 0)
    	 {
    	 	$aluno = Aluno::where('matricula', '=', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		return view('busca')->withDetails($aluno);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 
    }

}
