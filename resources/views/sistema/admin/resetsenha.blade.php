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

                <p> Para solicitar uma nova senha entre em contato com o Administrador do sistema!

                <ul class="nav">
                    <li>Telefones:</li><br/>
                    <li><i class="fa fa-fw"></i> 2127-6710  | 2127-6759</li>
                </ul>
                <hr/>
                <ul class="nav">
                    <li>Nome: Dyego Alves</li>
                    <li><i class="fa fa-fw"></i> E-mail: dyego.santos.alves@gmail.com</li>
                </ul>
                <hr/>

                <ul class="nav">
                    <li>Nome: Lucas Grana</li>
                    <li><i class="fa fa-fw"></i> E-mail: lucasgustavosilvagrana@gmail.com</li>
                </ul>
                <hr/>


                <ul class="nav">
                    <li>Nome: Simone lima</li>
                    <li><i class="fa fa-fw"></i> E-mail: monelima2000@gmail.com</li>
                </ul>
                <hr/>

                <div class="input-group">
                <a href="{{ url("/login") }}"><button type="button" class="btn btn-marrom">Voltar ao Login</button></a>
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