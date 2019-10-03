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
    	$cpf = Aluno::where('cpf', 'LIKE', $request->input('cpf'))->get();
    	$nome = Aluno::where('nome', 'LIKE', $request->input('nome'))->get();
    	$matricula = Aluno::where('matricula', 'LIKE', $request->input('matricula'))->get();
    	 if(count($cpf)>0 || count($nome)>0 || count($matricula)>0)
    	 {
    	 	return view('welcome')->withMessage('Aluno já cadastrado!');
    	 }
    	 else
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

		 $array=explode(" ",$request->input('nota'));
		 $soma = 0;
		 $i = 0;
		 foreach($array as $num)
		 {
		 	$soma += $num;
		 	$i++;
		 }
		 $nota= new Nota;
		 //$nota->valor = $request->input('nota') ;
		 $nota->valor = ($soma/$i);
		 $nota->aluno_id = $aluno->id;
		 $nota->save();

		 return view('welcome')->withMessage('Aluno cadastrado com sucesso!');
		 }
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
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		$nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Nome') == 0)
    	 {
    	 	$aluno = Aluno::where('nome', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->id)->get();
    	 	    $nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Matrícula') == 0)
    	 {
    	 	$aluno = Aluno::where('matricula', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		$nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 
    }

     public function exibeNotas(Request $request)
    {
    	 $aluno = Aluno::all();
    	 $nota = Nota::all();


    	 if(count($aluno)>0)
    	 {

    	 $averange = $nota->avg('valor');

    	 $maior = $nota->max('valor');
    	 $melhorNota = Nota::where('valor', 'LIKE', $maior)->get();
    	 $melhorAluno = Aluno::where('id', 'LIKE', $melhorNota->first()->id)->get();

    	 $menor = $nota->min('valor');
    	 $piorNota = Nota::where('valor', 'LIKE', $menor)->get();
    	 $piorAluno = Aluno::where('id', 'LIKE', $piorNota->first()->id)->get();

    	 $lista= collect([]);

    	 $aluno->merge($nota);


    	 
    	 	 return view('notas')->with('aluno',$aluno)->with('nota',$nota)->with('media',$averange)->with('melhorAluno',$melhorAluno)->with('piorAluno',$piorAluno)->with('lista',$lista);
    	 }
		 return view('notas')->withMessage('Nenhuma nota encontrada!');
    }

}
