 <!DOCTYPE html>
 <html lang="en" >
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title> {{ session()->has('titulo') ? session("titulo"):'SISCAL'}}</title>
    <link href="{{ URL::asset('bt/css-admin/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/bootstrap-social.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/bootstrap-select.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/fileinput.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('bt/css-admin/style.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="brand clearfix">
      <a style="text-decoration:none;  color: rgb(88, 92, 100) !important ; font-weight: bold ; font-family: Oxygen"
         href="/sistema-inicio"
         class="logo text-info">
         SISCAL v1.0 DLS
      </a>
      <span class="menu-btn"><i class="fa fa-bars"></i></span>
      <ul class="ts-profile-nav">
        <li class="ts-account">
          <a href="#">
            <img  src="{{URL::asset("/upload/avatars/").'/'. Auth::user()->avatar }}" class="ts-avatar hidden-side" alt="">
                Opções
            <i class="fa fa-angle-down hidden-side"></i>
          </a>
          <ul>
               <li><a href="{{ url('/profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
               <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off" aria-hidden="true"></i> Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="ts-main-content">
    <nav class="ts-sidebar">
      <ul class="ts-sidebar-menu">
      <li style="font-size: 15px ; font-family: Lato" class="ts-label text-center"></li>
        <li style="font-size: 18px ; font-family: Oxygen" class="ts-label">Menu do Sistema</li>
        <li style="font-size: 15px ; font-family: Lato" class="ts-label text-center"></li>
        <li>
            <div class="container">
                <h4 style="font-family: Lato">Dados pessoais</h4>
                <hr/>
                <p><strong>Nome:</strong>   <span> {{Auth::user()->name }}</span></p>
                <p><strong>Funcao:</strong> <span> {{Auth::user()->funcao}} </span></p>
                <h4 style="font-family: Lato">Resumo de licenças:</h4><hr/>
                <p><strong>Quantidade na carga: </strong>
                     <span class="label label-default">
                      {{ count(\App\User::find(Auth::user()->id)->processo)}}
                     </span>
                </p>
                <p><strong>Entregues:</strong> <span> Qtd-Entregues </span></p>
                <p><strong>Atrasadas: </strong> <span> Qtd-Atrasadas </span> </p>
            </div>
        </li>
        <li><a href="http://themestruck.com/demo/harmony/blank.html" target="_blank"><i class="fa fa-home"></i>Harmony Admin</a></li>
        <li id="inicio"><a href="{{ url('/sistema-inicio') }}"><i class="fa fa-home"></i>Inicio</a></li>
        <li>
          <a href="#"><i class="fa fa-list"></i>Processos | Calculos</a>
          <ul>
            <li><a href="{{ url('/calculos') }}"><i class="fa fa-calculator"></i>Cadastro e Calculo</a></li>
            <li><a href="{{url("/consultarprocessoindex")}}"><i class="fa fa-clipboard"></i>Consultar processo</a></li>
             <li><a href="{{url("/listartodosprocessos")}}"><i class="fa fa-clipboard"></i>Listar todos os processos</a></li>

          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-book"></i>Cadastros</a>
          <ul>
            <li><a href="{{ url('/cadastro-usuario') }}"><i class="fa fa-users"></i>Usuários</a></li>
          </ul>
        </li>

        <!-- Account from above -->
        <ul class="ts-profile-nav">
          <li class="ts-account">
            <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Opcoes</a>
            <ul>
              <li><a href="{{ url('/profile') }}"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off" aria-hidden="true"></i>Sair</a></li>
            </ul>
          </li>
        </ul>
      </ul>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
            @yield("content")
            <div class="col-md-12">
               <p style="font-family: Oxygen; font-size: 10px">Todos os Direitos reservados 2016 - {{date("Y")}}. SISCAL (Sistema de Calculo da Licença) -  Desenvolvimento: DLS
               </p>
            </div>
         </div>
      </div>
    </div>
	</div>
	<!-- Loading Scripts -->
	<script src="{{URL::asset('bt/js-admin/jquery.min.js')}}"></script>
	<script src="{{URL::asset('bt/js-admin/bootstrap-select.min.js')}}"></script>
	<script src="{{URL::asset('bt/js-admin/bootstrap.min.js')}}" ></script>
	<script src="{{URL::asset('bt/js-admin/jquery.dataTables.min.js')}}" ></script>
	<script src="{{URL::asset('bt/js-admin/dataTables.bootstrap.min.js')}}" ></script>
	<script src="{{URL::asset('bt/js-admin/Chart.min.js')}}"></script>
	<script src="{{URL::asset('bt/js-admin/fileinput.js')}}"></script>
	<script src="{{URL::asset('bt/js-admin/chartData.js')}}"></script>
	<script src="{{URL::asset('bt/js-admin/main.js')}}"></script>
  </body>
</html>