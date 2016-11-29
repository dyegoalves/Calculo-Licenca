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
  <body class="">

    <div class="section">
      <div class="container">
        <div class="row">
        @for( $i= 0 ; $i < 5 ; $i++)
         <br/>
        @endfor
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Atencao!</div>
                <div class="panel-body">
                    <p>Voce não tem permissão de acesso á esta função!</p>
                <div class="input-group">
                <a href="{{ url("/") }}"><button type="button" class="btn btn-marrom">Voltar ao Menu</button></a>
                </div>
                </div>
            </div>
        </div>
        </div>
       </div>
    </div>

    {{--RODAPE --}}
    <div class="footer">
      <div class="container">
        <p style="color: #000000">Todos os Direitos reservados 2016 - {{date("Y")}}. SISCAL (Sistema de Calculo da Licença) -  Desenvolvimento: DLS </p>
      </div>
    </div>
    {{--FIM DO RODAPÉ--}}
  </body>
</html>