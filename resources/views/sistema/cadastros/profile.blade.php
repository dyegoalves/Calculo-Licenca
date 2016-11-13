@extends('layout.main-admin')
@section('content')

       <div class="col-md-12">
        <h2 class="page-title">Perfil </h2>
        <div class="panel panel-default">
          <div class="panel-heading">Editar foto do perfil de {{ $user->name }} </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/profile') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                <div class="col-md-3">
                  <img class="img img-thumbnail img-responsive" src="{{URL::asset("/upload/avatars/$user->avatar")}}" alt=""/>
                </div>
                <div class="col-md-1">
                  <label for="name" class="control-label">Foto:</label>
                </div>
                <div class="col-md-6">
                  <input  id="profile-button" type="file" class="form-control" name="imagem" value="{{ old('imagem') }}">
                  @if ($errors->has('imagem'))
                  <span class="help-block">
                  <strong>{{$errors->first('imagem')}}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-2 col-md-offset-0">
                  <button type="submit" class=" btn btn-primary ">
                  <i class="fa fa-btn fa-user"></i> Salvar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>


@endsection

