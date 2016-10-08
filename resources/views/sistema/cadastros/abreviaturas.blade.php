@extends('layout.main-admin')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Cadastro de Abreviaturas</h2>
        <div class="panel panel-default">
          <div class="panel-heading">Formulário - preencha os dados corretamente</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/cadastro-abreviaturas') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('Abreviatura') ? ' has-error' : '' }}">
                <label for="Abreviatura" class="col-md-4 control-label">Abreviatura: </label>
                <div class="col-md-6">
                  <input id="Abreviatura" type="text" class="form-control" name="Abreviatura" value="{{ old('Abreviatura') }}">
                  @if ($errors->has('Abreviatura'))
                  <span class="help-block">
                  <strong>{{ $errors->first('Abreviatura') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('Descricao') ? ' has-error' : '' }}">
                <label for="Descricao" class="col-md-4 control-label">Descricao: </label>
                <div class="col-md-6">
                  <input id="Descricao" type="text" class="form-control" name="Descricao" value="{{ old('Descricao') }}">
                  @if ($errors->has('Descricao'))
                  <span class="help-block">
                  <strong>{{ $errors->first('Descricao') }}</strong>
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
              @if(isset($msg))
              <div id="alerta-abrev" class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                <strong>Sucesso!  </strong>
                <p>{{ $msg }}</p>
              </div>
              @endif
              @if(isset($msgerro))
              <div id="alerta-abrev" class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                <strong>Errro!  </strong>
                <p>{{ $msgerro }}</p>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection