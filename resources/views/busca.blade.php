<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRUD</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            form { padding: 0.7cm  }
            footer { font-size: 10px; padding:0.5cm;}
            table { border-color: #d3d3d3 ; }
            body { font-size:15px; border-color: #d3d3d3; }

            
        </style>

    </head>

    <body>



        <br>
        <ul class="nav nav-tabs" >
          <li class="nav-item">

            <a class="nav-link" href="/" align="center">Cadastrar</a>

            
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/busca" align="center" >Busca de aluno</a>
            <form class="form-horizontal" action="/buscar" method="post">
                 {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="pesquisa" placeholder="Buscar" required pattern="[a-zA-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ 0-9]{1,}">
                </div>

                <div class="form-group">
                    <select class="form-control" name="opcao_busca">
                      <option>CPF</option>
                      <option>Nome</option>
                      <option>Matrícula</option>
                    </select>
                     
                </div>
                
                 @if(isset($message))
                  <p> {{ $message }} </p>
                 @endif

                
                 @if(isset($aluno))
                  <table border = "1" class="table table-striped">
                  <tr>
                  <td>
                  @foreach($aluno as $dadosAluno)
                      {{'Nome: '. $dadosAluno['nome']}}<br>
                      {{'CPF: '. $dadosAluno['cpf']}}<br>
                      {{'Matrícula: '. $dadosAluno['matricula']}}<br>
                  @endforeach
                  @endif

                  @if(isset($nota))
                  @foreach($nota as $dadosNota)
                      {{'Nota(média): '. $dadosNota['valor']}}<br>
                  @endforeach
                  @endif

                  @if(isset($endereco))
                  @foreach($endereco as $dadosEnd)
                      {{'Rua: '. $dadosEnd['logradouro']}}<br>
                      {{'Número: '. $dadosEnd['numero']}}<br>
                      {{'Bairro: '. $dadosEnd['bairro']}}<br>
                  @endforeach
                   </td>
                  </tr>

                   </table>
                   <button class="btn btn-warning">Editar</button>
                   <button type="reset" class="btn btn-danger">Excluir</button>
                 @endif
                 

                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="/notas" align="center">Notas</a>
          </li>
        </ul>

       
       
    </body>
</html>
