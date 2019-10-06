<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Endereco;
use App\Nota;


class controllerCrud extends Controller
{

    public function cadastrar(Request $request) //CADASTRAR NOVO ALUNO
    {

    	if(!(isset($request))||empty($request->input('nome'))||empty($request->input('cpf'))||empty($request->input('matricula'))||
   			empty($request->input('logradouro'))||empty($request->input('numero'))||empty($request->input('bairro'))||                     //VERIFICAÇÃO CAMPOS VAZIOS
    	 	empty($request->input('nota')))
    	 	{
    	 		return view('welcome')->withMessage('Erro no formulário! (Campo(s) vazio(s))');
    	 	}


		 if(!is_numeric($request->input('numero'))) //VERIFICAÇÃO NUMERO RESIDENCIAL NAO NUMERICO
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (número da residência não numérico)');
		 }
		 if(strlen(json_encode($request->input('numero')))>45) //VERIFICAÇÃO NUMERO RESIDENCIAL MUITO GRANDE
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (número da residência muito grande)');
		 }
		 if(!is_numeric($request->input('matricula'))) //VERIFICAÇÃO MATRICULA NAO NUMERICO
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (número de matrícula não numérico)');
		 }
		 if(strlen(json_encode($request->input('matricula')))>12) //VERIFICAÇÃO MATRICULA MUITO GRANDE
		 {
		 	$a = json_encode(strlen(json_encode($request->input('matricula'))));
		 	return view('welcome')->withMessage('Erro no formulário! (número de matrícula muito grande '.$a.')');
		 }
		 if(strlen(json_encode($request->input('cpf')))>13) //VERIFICAÇÃO CPF MUITO GRANDE
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (número de CPF muito grande)');
		 }
		  if(!is_numeric($request->input('cpf'))) //VERIFICAÇAO CPF NAO NUMERICO
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (CPF não numérico)');
		 }
		 if(strlen(json_encode($request->input('nome')))>255) //VERIFICAÇÃO NOME MUITO GRANDE
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (nome muito grande)');
		 }
		 if(strlen(json_encode($request->input('logradouro')))>255) //VERIFICAÇÃO RUA MUITO GRANDE
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (nome da rua muito grande)');
		 }
		 if(strlen(json_encode($request->input('bairro')))>255) //VERIFICAÇÃO BAIRRO MUITO GRANDE
		 {
		 	return view('welcome')->withMessage('Erro no formulário! (nome do bairro muito grande)');
		 }

		  $array=explode(" ",$request->input('nota')); //VERIFICAÇÃO NOTAS E CALCULO MÉDIA
    	 foreach($array as $num)
    	 {

    	 if(!is_numeric($num) &&!is_float($num))
    	 {
    	 	$a = json_encode($num);
    	 	return view('welcome')->withMessage('Erro no formulário! (nota não numérica '.$a.')');
    	 }

    	 }

		 $soma = 0;
		 $i = 0;
		 foreach($array as $num)
		 {
		 	$soma += $num;
		 	$i++;
		 }


    	$cpf = Aluno::where('cpf', 'LIKE', $request->input('cpf'))->get();            //VERIFICAÇÃO SE JA EXISTE ESSE ALUNO
    	$nome = Aluno::where('nome', 'LIKE', $request->input('nome'))->get();
    	$matricula = Aluno::where('matricula', 'LIKE', $request->input('matricula'))->get();

    	
    	 if(count($cpf)>0 || count($nome)>0 || count($matricula)>0)
    	 {
    	 	return view('welcome')->withMessage('Aluno já cadastrado!');
    	 }

    	 else
    	 {

    	 	

    	 $endereco= new Endereco;  //REGISTRO ENDERECO
		 $endereco->logradouro = $request->input('logradouro') ;
		 $endereco->numero = $request->input('numero') ;
		 $endereco->bairro= $request->input('bairro') ;
		 $endereco->save();
    
		 
    	 $aluno= new Aluno; //REGISTRO ALUNO
		 $aluno->nome = $request->input('nome') ;
		 $aluno->cpf = $request->input('cpf') ;
		 $aluno->matricula= $request->input('matricula') ;
		 $aluno->endereco_id = $endereco->id;
		 $aluno->save();

		 
		 $nota= new Nota;  //REGISTRO NOTA
		 $nota->valor = ($soma/$i);
		 $nota->aluno_id = $aluno->id;
		 $nota->save();

		 return view('welcome')->withMessage('Aluno cadastrado com sucesso!');
		 }
    }



    public function buscar(Request $request) //BUSCAR ALUNO
    {
    	 $opcao = $request->input('opcao_busca');
    	 $pesquisa = $request->input('pesquisa');
    	 $op = 'editar';


    	 if(!(isset($request))||empty($request->input('opcao_busca'))||empty($request->input('pesquisa'))) //VERIFICACAO FORMULARIO VAZIO
    	 {
    	 	 return view('busca')->withMessage('Erro no formulário!');
    	 }
    	 
    	 if(strcmp($opcao,'CPF') == 0)   //OPCAO PESQUISA POR CPF
    	 {
    	 	$aluno = Aluno::where('cpf', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->endereco_id)->get();
    	 		$nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota)->with('option',$op);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Nome') == 0)  //OPCAO PESQUISA POR NOME
    	 {
    	 	$aluno = Aluno::where('nome', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->endereco_id)->get();
    	 	    $nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota)->with('option',$op);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 else if(strcmp($opcao,'Matrícula') == 0)  //OPCAO PESQUISA POR MATRICULA
    	 {
    	 	$aluno = Aluno::where('matricula', 'LIKE', $pesquisa)->get();
    	 	if(count($aluno)>0)
    	 	{
    	 		$endereco = Endereco::where('id', 'LIKE', $aluno->first()->endereco_id)->get();
    	 		$nota = Nota::where('id', 'LIKE', $aluno->first()->id)->get();
    	 		return view('busca')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota)->with('option',$op);
    	 	}
    	 	else return view('busca')->withMessage('Não encontrado!');
    	 }
    	 
    }

    public function operacoes(Request $request)
    {
    	if(strcmp($request->input('botao'),'buscar')==0)
    	{
    		return controllerCrud::buscar($request);
    	}
    	else if(strcmp($request->input('botao'),'editar')==0)
    	{
    		return controllerCrud::update($request);
    	}
    	else if(strcmp($request->input('botao'),'excluir')==0)
    	{
    		return controllerCrud::delete($request);
    	}
    	else
    	{
    		return view('busca')->withMessage('Erro nas operações!');
    	}


    }



     public function update(Request $request) //EDITAR ALUNO
    {
    	 

    	 if(!(isset($request))||empty($request->input('nomeNovo'))||empty($request->input('cpfNovo'))||empty($request->input('matriculaNovo'))||
   			empty($request->input('logradouroNovo'))||empty($request->input('numeroNovo'))||empty($request->input('bairroNovo'))||                     //VERIFICAÇÃO CAMPOS VAZIOS
    	 	empty($request->input('notaNovo')))
    	 	{
    	 		return view('busca')->withMessage('Erro no formulário! (Campo(s) vazio(s))');
    	 	}


		 if(!is_numeric($request->input('numeroNovo'))) //VERIFICAÇÃO NUMERO RESIDENCIAL NAO NUMERICO
		 {
		 	return view('busca')->withMessage('Erro no formulário! (número da residência não numérico)');
		 }
		 if(strlen(json_encode($request->input('numeroNovo')))>45) //VERIFICAÇÃO NUMERO RESIDENCIAL MUITO GRANDE
		 {
		 	return view('busca')->withMessage('Erro no formulário! (número da residência muito grande)');
		 }
		 if(!is_numeric($request->input('matriculaNovo'))) //VERIFICAÇÃO MATRICULA NAO NUMERICO
		 {
		 	return view('busca')->withMessage('Erro no formulário! (número de matrícula não numérico)');
		 }
		 if(strlen(json_encode($request->input('matriculaNovo')))>12) //VERIFICAÇÃO MATRICULA MUITO GRANDE
		 {
		 	$a = json_encode(strlen(json_encode($request->input('matriculaNovo'))));
		 	return view('busca')->withMessage('Erro no formulário! (número de matrícula muito grande '.$a.')');
		 }
		 if(strlen(json_encode($request->input('cpfNovo')))>13) //VERIFICAÇÃO CPF MUITO GRANDE
		 {
		 	$a = json_encode(strlen(json_encode($request->input('cpfNovo'))));
		 	return view('busca')->withMessage('Erro no formulário! (número de CPF muito grande '.$a.')');
		 }
		  if(!is_numeric($request->input('cpfNovo'))) //VERIFICAÇAO CPF NAO NUMERICO
		 {
		 	return view('busca')->withMessage('Erro no formulário! (CPF não numérico)');
		 }
		 if(strlen(json_encode($request->input('nomeNovo')))>255) //VERIFICAÇÃO NOME MUITO GRANDE
		 {
		 	return view('busca')->withMessage('Erro no formulário! (nome muito grande)');
		 }
		 if(strlen(json_encode($request->input('logradouroNovo')))>255) //VERIFICAÇÃO RUA MUITO GRANDE
		 {
		 	return view('busca')->withMessage('Erro no formulário! (nome da rua muito grande)');
		 }
		 if(strlen(json_encode($request->input('bairroNovo')))>255) //VERIFICAÇÃO BAIRRO MUITO GRANDE
		 {
		 	return view('busca')->withMessage('Erro no formulário! (nome do bairro muito grande)');
		 }

		  $array=explode(" ",$request->input('notaNovo')); //VERIFICAÇÃO NOTAS E CALCULO MÉDIA
    	 foreach($array as $num)
    	 {

    	 if(!is_numeric($num) &&!is_float($num))
    	 {
    	 	$a = json_encode($num);
    	 	return view('busca')->withMessage('Erro no formulário! (nota não numérica '.$a.')');
    	 }
		}

		$soma = 0;
		 $i = 0;
		 foreach($array as $num)
		 {
		 	$soma += $num;
		 	$i++;
		 }


		$aluno = Aluno::where('nome', 'LIKE', $request->input('nome'))->where('cpf', 'LIKE', $request->input('cpf'))->where('matricula', 'LIKE', $request->input('matricula'))->get();
		$endereco = Endereco::where('logradouro', 'LIKE', $request->input('logradouro'))->where('numero', 'LIKE', $request->input('numero'))->where('bairro', 'LIKE', $request->input('bairro'))->where('id', 'LIKE', $aluno->first()->endereco_id)->get();
		$nota = Nota::where('aluno_id','LIKE',$aluno->first()->id)->get();


		if(isset($aluno)&&isset($endereco)&&isset($nota))
		{

		$aluno->first()->update(['nome' => $request->input('nomeNovo') , 'cpf' => $request->input('cpfNovo') , 'matricula' => $request->input('matriculaNovo')]);
		$endereco->first()->update(['logradouro' => $request->input('logradouroNovo') , 'numero' => $request->input('numeroNovo') , 'bairro' => $request->input('bairroNovo')]);
		$nota->first()->update(['valor' => ($soma/$i)]);

		return view('busca')->withMessage('Aluno '.$request->input('nomeNovo').' editado com sucesso!')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota)->with('option','editar');

		}

		else
		{
			return view('busca')->withMessage('Erro nos dados!')->with('aluno',$aluno)->with('endereco',$endereco)->with('nota',$nota)->with('option','editar');
		}

		




    	
    }

    public function delete(Request $request) //EXCLUIR ALUNO
    {
    	$aluno = Aluno::where('nome', 'LIKE', $request->input('nome'))->where('cpf', 'LIKE', $request->input('cpf'))->where('matricula', 'LIKE', $request->input('matricula'))->get();
		$endereco = Endereco::where('logradouro', 'LIKE', $request->input('logradouro'))->where('numero', 'LIKE', $request->input('numero'))->where('bairro', 'LIKE', $request->input('bairro'))->where('id', 'LIKE', $aluno->first()->endereco_id)->get();
		$nota = Nota::where('aluno_id','LIKE',$aluno->first()->id)->get();

		if(isset($aluno)&&isset($endereco)&&isset($nota))
		{

		$endereco->first()->delete();
		$nota->first()->delete();
		$aluno->first()->delete();

		return view('busca')->withMessage('Aluno '.$request->input('nome').' excluído com sucesso!');

		}

		else
		{
			return view('busca')->withMessage('Aluno '.$request->input('nome').' não excluído. Motivo: Erro!');
		}

    }



     public function exibeNotas(Request $request) //EXIBIR TODAS AS NOTAS DA TURMA, MELHOR ALUNO, PIOR ALUNO, MEDIA TURMA
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

    	 $lista = collect([]);
    	 $count = 0;
    	 foreach($aluno as $alunos)
    	 {
    	 	$lista->put('nome'.$count,$alunos['nome']);
    	 	$count++;
    	 }

    	 $count = 0;
    	  foreach($nota as $notas)
    	 {
    	 	$lista->put('nota'.$count,$notas['valor']);
    	 	$count++;
    	 }
    	 //dd($lista);

    	 
    	 	 return view('notas')->with('media',$averange)->with('melhorAluno',$melhorAluno)->with('piorAluno',$piorAluno)->with('lista',$lista)->with('count',$count);
    	 }
		 return view('notas')->withMessage('Nenhuma nota encontrada!');
    }


   
}
