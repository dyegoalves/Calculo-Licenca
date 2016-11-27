<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ URL::asset('bt/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('bt/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('bt/js/func.js')}}" type="text/javascript"></script>
    <link href="{{ URL::asset('bt/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css/app.css')}}" rel="stylesheet">
    <title>Login</title>
  </head>
  <body class="corpologin">
    @for($i = 0 ; $i < 2 ; $i++)
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12"></div>
        </div>
      </div>
    </div>
    @endfor
    <div class="section">
      <div class="container">
        <div class="row">

            @if( isset($msgsucesso))
            <div  style="background-color: #f0f0f0" class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sucesso! </strong>{{ $msgsucesso }}
            </div>
            @endif

          {{--IMAGEM--}}
          <div class="col-md-4">
            <img class="img-circle img-responsive" src="{{ URL::asset('img/logo30.png')}}" alt=""/>
          </div>
          {{--FIM DA IMAGEM--}}
          {{--QUADRO DO FORMULARIO--}}
          <div class="col-md-8">
            {{--FORMULARIO DE LOGIN--}}
            <form id="signin" class="" role="form" method="POST" action="{{ url('/login') }}">
              <h1 class="h1-bkgcolor titulo-siscal">SisCal - Sistema de Cálculo da Licença</h1>
              <hr/>
              {{ csrf_field()}}
              <br/>
              <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <span class="input-group-addon"><i class=""><img src="{{URL::asset('img/Users-icon.png')}}" alt=""/></i></span>
                <input placeholder="Digite seu e-mail" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
                <br/>
              <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <span class="input-group-addon"><i class=""><img src="{{URL::asset('img/secrecy-icon.png')}}" alt=""/></i></span>
                <input placeholder="Digite sua senha" id="password" type="password" class="form-control" name="password">
              </div>
              <br/>
              <div class="input-group">
                <button type="submit" class="btn btn-marrom">Entrar</button>
              </div>
                <br/>
              <div class="input-group">
                <a class="btn btn-marrom" href="http://">Perdeu sua senha?</a>
              </div>
              {{-- MENSAGEM DE ERRO --}}
              <br/>
              @if ($errors->has('email'))
              <div id="alerta-login" class=" alert alert-danger">
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
              </div>
              @endif

              @if ($errors->has('password'))
              <div  id="alerta-password" class="alert alert-danger">
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
              </div>
              @endif
            </form>
            {{--FIM FORMULARIO DE LOGIN--}}
          </div>
          {{--FIM QUADRO DO FORMULARIO--}}
        </div>
      </div>
    </div>
    {{--RODAPE --}}
    <div class="footer">
      <div class="container">
        <p>Todos os Direitos reservados {{date("Y")}}. SISCAL (Sistema de Calculo da Licença) -  Desenvolvimento: DLS </p>
      </div>
    </div>
    {{--FIM DO RODAPÉ--}}
  </body>
</html>