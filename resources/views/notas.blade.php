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
            body { font-size:14px; border-color: #d3d3d3; }
        </style>

    </head>

    <body>



        <br>
        <ul class="nav nav-tabs" >
          <li class="nav-item">

            <a class="nav-link" href="/" align="center">Cadastrar</a>

            
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/busca" align="center" >Busca de aluno</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/notas" align="center">Notas</a>
          </li>
        </ul>
        <br>
  

        @if(isset($message))
            <p> {{$message}} </p> <br>
        @endif

        <table border = "1" class="table table-striped">
        <tr>
          <th>Média da turma</th>
          <th>Melhor da turma</th>
          <th>Pior da turma</th>
        </tr>

        <tr>
        <td>
        @if(isset($media))
           {{$media}} 
        @endif
        </td>
   
        <td>
        @if(isset($melhorAluno))
           {{$melhorAluno->first()->nome}}
        @endif
        </td>
         
        <td>
        @if(isset($piorAluno))
           {{$piorAluno->first()->nome}}
        @endif
        </td>
        </tr>



        </table>
        <p>Alunos:</p>
        <table border="1" class="table table-striped">
        
        <th>Nome</th><th>Nota</th>
        @if(isset($lista)&&isset($count))
        @for($i=0; $i<$count; $i++)
            <tr><td>{{$lista['nome'.$i]}}</td><td>{{$lista['nota'.$i]}}</td><tr>
        @endfor
        @endif

        
      </table>

    </body>
</html>
