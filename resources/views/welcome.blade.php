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
            body { font-size:12px; border-color: #d3d3d3;   }
             table { border-color: #d3d3d3  }
             footer { font-size: 10px; padding:0.5cm; }
             h4 { padding-left : 0.7cm; }
  

        </style>

    </head>
    
         @guest
            <li class="nav-item" style="list-style-type: none;">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item" style="list-style-type: none;">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown" style="list-style-type: none;">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

    <body>



        <br>
        <ul class="nav nav-tabs">
          <li class="nav-item">

            <a class="nav-link active" href="/" align="center">Cadastrar</a>

            <form name = "cadastro" action = "/cadastro" method="post"  class="form-horizontal">
                {{ csrf_field() }}

              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" maxlength="255">
              </div>

              <div class="form-group">
                <label>CPF (somente números)</label>
                <input type="text" class="form-control" name="cpf" placeholder="12345678910" required pattern="[0-9]{11,11}" maxlength="11">
              </div>
              

              <div class="form-group">
                <label>Matrícula</label>
                <input type="text" class="form-control" name="matricula"  required pattern="[0-9]{1,10}" maxlength="10">
              </div>

              <div class="form-group">
                <label>Notas (separadas por espaço)</label>
                <input type="text" class="form-control" name="nota" placeholder="8.5 9.25 10" required pattern="^(\s*?\d+(\.\d+)?)(\s*\s\s*?\d+(\.\d+)?)*$" maxlength="30">
              </div>

              <div class="form-group">
                <label>Rua</label>
                <input type="text" class="form-control" name="logradouro"  required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" maxlength="255">
              </div>

              <div class="form-group">
                <label>Número</label>
                <input type="text" class="form-control" name="numero"  required  pattern="[0-9]{1,10}" maxlength="45">
              </div>

              <div class="form-group">
                <label>Bairro</label>
                <input type="text" class="form-control" name="bairro"  required pattern="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" maxlength="255" >
              </div>


             
              <button type="submit" class="btn btn-primary">Salvar</button>
              <button type="reset"class="btn btn-secondary" value="Limpar">Limpar</button>
            </form>
            @if(isset($message))
                <h4> {{$message}} </h4>
            @endif
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/busca" align="center" >Busca de aluno</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/notas" align="center">Notas</a>
          </li>
        </ul>

        <footer>
            Por Caio César A. Sampaio, 2019.
        </footer>
       
    </body>
</html>
