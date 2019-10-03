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
            form { padding-left: 0.5cm; padding-top: 1cm }
            body { font-size:14px; }
        </style>

    </head>

    <body>



        <br>
        <ul class="nav nav-tabs" >
          <li class="nav-item">

            <a class="nav-link active" href="/" align="center">Cadastrar</a>

            <form name = "cadastro" action = "/cadastro" method="post"  class="form-horizontal">
                {{ csrf_field() }}

              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" required>
              </div>

              <div class="form-group">
                <label>CPF (somente números)</label>
                <input type="text" class="form-control" name="cpf" placeholder="12345678910" required pattern="[0-9]{11}">
              </div>
              

              <div class="form-group">
                <label>Matrícula</label>
                <input type="number" class="form-control" name="matricula"  required>
              </div>

              <div class="form-group">
                <label>Nota</label>
                <input type="number" class="form-control" name="nota"  required>
              </div>

              <div class="form-group">
                <label>Rua</label>
                <input type="text" class="form-control" name="logradouro"  required>
              </div>

              <div class="form-group">
                <label>Número</label>
                <input type="number" class="form-control" name="numero"  required>
              </div>

              <div class="form-group">
                <label>Bairro</label>
                <input type="text" class="form-control" name="bairro"  required>
              </div>


             
              <button type="submit" class="btn btn-primary">Salvar</button>
              <button type="reset"class="btn btn-primary" value="Limpar">Limpar</button>
            </form>
            @if(isset($message))
                <p> {{$message}} </p>
            @endif
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/busca" align="center" >Busca de aluno</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/notas" align="center">Notas</a>
          </li>
        </ul>

        
       
    </body>
</html>