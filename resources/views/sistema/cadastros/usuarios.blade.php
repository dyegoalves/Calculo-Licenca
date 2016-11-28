@extends('layout.main-admin')

@section('content')

<div class="col-md-12">

<h2 class="page-title">SISCAL: Cadastro de Usuário</h2>

<div class="panel panel-default">
<div class="panel-heading">Formulário - preencha os dados corretamente</div>
<div class="panel-body">
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
<label for="name" class="col-md-4 control-label">Nome: </label>

<div class="col-md-6">
    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<label for="email" class="col-md-4 control-label">Endereco de E-mail</label>

<div class="col-md-6">
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
</div>


<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<label for="password" class="col-md-4 control-label">Senha</label>

<div class="col-md-6">
    <input id="password" type="password" class="form-control" name="password">

    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
<label for="password-confirm" class="col-md-4 control-label">Confirme sua senha</label>

<div class="col-md-6">
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group{{ $errors->has('funcao') ? ' has-error' : '' }}">
<label for="funcao" class="col-md-4 control-label">Funcao: </label>
<?php
    $funcao = [ " " => "Escolha a funcao" , 'Administrador' => 'Administrador', 'Gerente'=> 'Gerente' , 'Secretaria' => 'Secretaria', 'Analista' => 'Analista'  ]
?>

<div class="col-md-6">

   {{ Form::select('funcao', $funcao , null , ['class' => 'form-control'] )}}

    @if ($errors->has('funcao'))
        <span class="help-block">
            <strong>{{ $errors->first('funcao') }}</strong>
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
</form>
</div>
</div>
</div>

@endsection
