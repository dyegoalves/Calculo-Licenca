@extends('layout.main-admin')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-left page-title">SISCAL: CADASTRO DE ATIVIDADE E SUBATIVIDADE</h2>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">

       <strong>Formulário de Atividade</strong>

       </div>
      <div class="panel-body">

        <form class="form-horizontal"  action="{{url("/atividade")}}" method="POST" role="form">
        <input name="_token" type="hidden"  value="{{ csrf_token() }}">

        <div class="form-group{{ $errors->has('atv_codigo') ? ' has-error' : '' }}">
          <label for="atv_codigo" class="col-md-4 control-label">Codigo da atividade: </label>
          <div class="col-md-6">
            <input id="atv_codigo" type="text" class="form-control" name="atv_codigo" value="{{ old('atv_codigo') }}">
            @if ($errors->has('atv_codigo'))
            <span class="help-block">
            <strong>{{ $errors->first('atv_codigo') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('atv_descricao') ? ' has-error' : '' }}">
          <label for="atv_descricao" class="col-md-4 control-label">Descricao da atividade: </label>
          <div class="col-md-6">
            <input id="atv_descricao" type="text" class="form-control" name="atv_descricao" value="{{ old('atv_descricao') }}">
            @if ($errors->has('atv_descricao'))
            <span class="help-block">
            <strong>{{ $errors->first('atv_descricao') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button name="cad_btn_atv" type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> Registrar
            </button>
          </div>
        </div>

        @if(session('msg'))
              <div id="atv_msgsucess" class="alert alert-success alert-dismissible fade in" role="alert">
               <button  type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
                <strong>Sucesso!  </strong>
                <p>{{ session('msg') }}</p>
              </div>
        @endif

        @if(session('msgerro'))
              <div id="atv_msgerro" class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
                <strong>Erro!  </strong>
                <p>{{ session('msgerro')}}</p>
              </div>
        @endif
        </form>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
      <strong> Formulário de Subatividade</strong>
     </div>

      <div class="panel-body">
        <form class="form-horizontal"  action="{{url("/subatividade")}}" method="POST" role="form">
        <input name="_token" type="hidden"  value="{{ csrf_token() }}">

        <div class="form-group{{ $errors->has('subatv_codigo') ? ' has-error' : '' }}">
          <label for="subatv_codigo" class="col-md-4 control-label">Codigo da subatividade: </label>
          <div class="col-md-6">
            <input id="subatv_codigo" type="text" class="form-control" name="subatv_codigo" value="{{ old('subatv_codigo') }}">
            @if ($errors->has('subatv_codigo'))
            <span class="help-block">
            <strong>{{ $errors->first('subatv_codigo') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('subatv_descricao') ? ' has-error' : '' }}">
          <label for="subatv_descricao" class="col-md-4 control-label">Descricao da subatividade: </label>
          <div class="col-md-6">
            <input id="subatv_descricao" type="text" class="form-control" name="subatv_descricao" value="{{ old('subatv_descricao') }}">
            @if ($errors->has('subatv_descricao'))
            <span class="help-block">
            <strong>{{ $errors->first('subatv_descricao') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="form-group{{ $errors->has('sub_ppd_id') ? ' has-error' : '' }}">
          <label for="sub_ppd_id" class="col-md-4 control-label">PPD: </label>
          <div class="col-md-6">
            <input id="sub_ppd_id" type="text" class="form-control" name="sub_ppd_id" value="{{ old('sub_ppd_id')}}">
            @if ($errors->has('sub_ppd_id'))
            <span class="help-block">
            <strong>{{ $errors->first('sub_ppd_id') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('descricao_atividade') ? ' has-error' : '' }}">
          <label for="descricao_atividade" class="col-md-4 control-label">Atividade relacionada: </label>
          <div class="col-md-6">
            <select name="descricao_atividade" id="descricao_atividade" class="form-control" required="required">
              <option selected value=" "> Escolha a atividade relacionada a subatividade</option>
              @if(isset($descricao_atividade))
              @foreach($descricao_atividade as $atividades )
              <option value="{{$atividades->id}}">{{$atividades->descricao}}</option>
              @endforeach
              @endif
            </select>
            @if ($errors->has('descricao_atividade'))
            <span class="help-block">
            <strong>{{ $errors->first('descricao_atividade') }}</strong>
            </span>
            @endif
          </div>
        </div>



        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i> Registrar
            </button>
          </div>
        </div>

        @if(session('msgsub'))
          <div id="msgsub" class="alert alert-success alert-dismissible fade in" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
            <strong>Sucesso!  </strong>
            <p>{{ session('msgsub') }}</p>
          </div>
        @endif

        @if(session('msgsuberro'))
          <div id="msgsuberro" class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
            <strong>Erro!  </strong>
            <p>{{ session('msgsuberro')}}</p>
          </div>
        @endif

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

