@extends('layout.main-admin')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-title">Calculo da licenca</h2>
        <div class="panel panel-default">
          <div class="panel-heading">Formulário - Calculo da licenca</div>
          <div class="panel-body">
            <form  class="form-horizontal" action="{{url("/processo")}}" method="post" role="form">
            <h4 class="panel panel-default" style="padding: 10px">  Processo</h4>
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('num_processo') ? ' has-error' : '' }}">
              <label for="num_processo" class="col-md-2 control-label">Numero: </label>
              <div class="col-md-4">
                <input id="num_processo" type="text" class="form-control input-sm" name="num_processo" value="{{ old('num_processo') }}">
                @if ($errors->has('num_processo'))
                <span class="help-block">
                <strong>{{ $errors->first('num_processo') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <hr/>
            <h4 class="panel panel-default " style="padding: 10px">Dados da Empresa</h4>
            {{--Inicio do 1º conteiner de inputs--}}
            <div class="container">
              {{--Tipo pessoa--}}
              <div class="form-group">
                <div class="col-sm-10 form-group">
                  <label  class="col-sm-2 ">Tipo de Pessoa <br></label>  
                  <div class=" radio radio-info radio-inline">
                    <input value="1" type="radio" id="inlineRadio1"  name="escolhatipo" >
                    <label for="inlineRadio1">Pessoa Juridica?</label>
                           <input value="2" type="radio" id="inlineRadio2"  name="escolhatipo" checked>
                    <label for="inlineRadio2">Pessoa Fisíca?</label>
                  </div>
                </div>
              </div>
              {{--Fim do Tipo pessoa--}}
              <div class="row">
                {{--Input Razao Nome completo--}}
                <div class="col-md-6">
                  <div class="col-md-12 form-group{{ $errors->has('nomecompleto') ? ' has-error' : '' }}">
                    <label for="nomecompleto" >Nome Completo *</label>
                    <input id="nomecompleto" type="text" class=" form-control input-sm" name="nomecompleto" value="{{ old('nomecompleto') }}">
                    @if ($errors->has('nomecompleto'))
                    <span class="help-block">
                    <strong>{{ $errors->first('nomecompleto') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{--Fim Input Nome Completo--}}

                {{--Input CPF--}}
                <div class="col-md-3">
                <div class=" col-md-12 form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf" >CPF *</label>
                <input id="cpf" type="text" class=" form-control input-sm" name="cpf" value="{{ old('cpf') }}">
                @if ($errors->has('cpf'))
                <span class="help-block">
                <strong>{{ $errors->first('cpf') }}</strong>
                </span>
                @endif
                </div>
                </div>
                {{-- fim Input CPF--}}

                {{--Input RG--}}
                <div class="col-md-3">
                  <div class="col-md-12 form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                    <label for="rg" >RG *</label>
                    <input id="rg" type="text" class=" form-control input-sm" name="rg" value="{{ old('rg') }}">
                    @if ($errors->has('rg'))
                    <span class="help-block">
                    <strong>{{ $errors->first('rg') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input RG--}}


              </div>
            </div>
            {{-- fim Inicio do conteiner inputs--}}

            {{--Inicio do 2º conteiner de inputs--}}
            <div class="container">
              <div class="row">
                {{--Input Email--}}
                <div class="col-md-5">
                  <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" >Email * </label>
                    <input id="email" type="text" class=" form-control input-sm" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{--Fim Input Email--}}
                {{--Input Nome Telefone--}}
                <div class="col-md-2">
                  <div class="col-md-12 form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                    <label for="telefone" >Telefone *</label>
                    <input id="telefone" type="text" class=" form-control input-sm" name="telefone" value="{{ old('telefone') }}">
                    @if ($errors->has('telefone'))
                    <span class="help-block">
                    <strong>{{ $errors->first('telefone') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input Nome Telefone--}}
                {{--Input Celular--}}
                <div class="col-md-2">
                  <div class=" col-md-12 form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    <label for="celular" >Celular *</label>
                    <input id="celular" type="text" class=" form-control input-sm" name="celular" value="{{ old('celular') }}">
                    @if ($errors->has('celular'))
                    <span class="help-block">
                    <strong>{{ $errors->first('celular') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input celular--}}
                {{--Input Fax--}}
                <div class="col-md-3">
                  <div class=" col-md-12 form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                    <label for="fax" >Fax </label>
                    <input id="fax" type="text" class=" form-control input-sm" name="fax" value="{{ old('fax') }}">
                    @if ($errors->has('fax'))
                    <span class="help-block">
                    <strong>{{ $errors->first('fax') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input fax--}}
              </div>
            </div>
            {{-- fim Inicio do conteiner inputs--}}

            {{--Inicio do 3º conteiner inputs--}}
            <div class="container">
              <div class="row">
                {{--Input Endereco--}}
                <div class="col-md-6">
                  <div class="col-md-12 form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                    <label for="endereco" >Endereco da Empresa *</label>
                    <input id="endereco" type="text" class=" form-control input-sm" name="endereco" value="{{ old('endereco') }}">
                    @if ($errors->has('endereco'))
                    <span class="help-block">
                    <strong>{{ $errors->first('endereco') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{--Fim Input Endereco--}}
                {{--Input numero do empredimento--}}
                <div class="col-md-2">
                  <div class=" col-md-12 form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                    <label for="numero" >Numero *</label>
                    <input id="numero" type="text" class=" form-control input-sm" name="numero" value="{{ old('numero') }}">
                    @if ($errors->has('numero'))
                    <span class="help-block">
                    <strong>{{ $errors->first('numero') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input  numero do empredimento--}}
                {{--Input Complemento--}}
                <div class="col-md-4">
                  <div class=" col-md-12 form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                    <label for="complemento" >Complemento </label>
                    <input id="complemento" type="text" class=" form-control input-sm" name="complemento" value="{{ old('complemento') }}">
                    @if ($errors->has('complemento'))
                    <span class="help-block">
                    <strong>{{ $errors->first('complemento') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input Complemento--}}
              </div>
            </div>
            {{-- fim Inicio do 4º conteiner inputs--}}
            {{--Inicio do conteiner inputs--}}
            <div class="container">
              <div class="row">
                {{--Input CEP--}}
                <div class="col-md-3">
                  <div class="col-md-12 form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                    <label for="cep" >CEP *</label>
                    <input id="cep" type="text" class=" form-control input-sm" name="cep" value="{{ old('cep') }}">
                    @if ($errors->has('cep'))
                    <span class="help-block">
                    <strong>{{ $errors->first('cep') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{--Fim Input CEP--}}
                {{--Input Bairro--}}
                <div class="col-md-3">
                  <div class="col-md-12 form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                    <label for="bairro" >Bairro *</label>
                    <input id="bairro" type="text" class=" form-control input-sm" name="bairro" value="{{ old('bairro') }}">
                    @if ($errors->has('bairro'))
                    <span class="help-block">
                    <strong>{{ $errors->first('bairro') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input Bairro--}}
                {{--Input Estados--}}
                <div class="col-md-3">
                  <div class=" col-md-12 form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                    <label for="estado" >Estado *</label>
                    <input id="estado" type="text" class=" form-control input-sm" name="estado" value="{{ old('estado') }}">
                    @if ($errors->has('estado'))
                    <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input Estado--}}

                {{--Input Municipio--}}
                <div class="col-md-3">
                  <div class=" col-md-12 form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                    <label for="municipio" >Municipio *</label>
                    <input id="municipio" type="text" class=" form-control input-sm" name="municipio" value="{{ old('municipio') }}">
                    @if ($errors->has('municipio'))
                    <span class="help-block">
                    <strong>{{ $errors->first('municipio') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                {{-- fim Input municipio--}}
              </div>
            </div>
            {{-- fim Inicio do conteiner inputs--}}
            <hr/>

            <h4  class="panel panel-default " style="padding: 10px">   Dados do Empreendimento e Calculos Lei No 3.785/2012 * </h4>
            <div class="form-group{{ $errors->has('atividade') ? ' has-error' : '' }}">
              <label for="atividade" class="col-md-2 control-label">Atividade: </label>
              <div class="col-md-5">
                <select  name="atividade" id="atividade" class="form-control input-sm">
                  <option selected value=" "></option>
                  @if(isset($atividade))
                  @foreach($atividade as $atv)
                  <option value="{{ $atv->id}}">{{ $atv->descricao}}</option>
                  @endforeach
                  @endif
                </select>
                @if ($errors->has('atividade'))
                <span class="help-block">
                <strong>{{ $errors->first('atividade') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('subatividade') ? ' has-error' : '' }}">
              <label for="subatividade" class="col-md-2 control-label">Subatividade: </label>
              <div class="col-md-10">
                {{--Dados obtidos por meio  de requisicao ajax main.js--}}

                <select id ='subatividade' name="subatividade"  class="form-control input-sm"></select>
                @if ($errors->has('subatividade'))
                <span class="help-block">
                <strong>{{ $errors->first('subatividade') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('areaultiu') ? ' has-error' : '' }}">
              <label for="areaultiu" class="col-md-2 control-label">Area util: </label>
              <div class="col-md-4">
                <input id="areaultiu" type="text" class="form-control input-sm" name="areaultiu" value="{{ old('areaultiu') }}">
                @if ($errors->has('areaultiu'))
                <span class="help-block">
                <strong>{{ $errors->first('areaultiu') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('numerodeempregados') ? ' has-error' : '' }}">
              <label for="numerodeempregados" class="col-md-2 control-label">Nº de empregados: </label>
              <div class="col-md-4">
                <input id="numerodeempregados" type="text" class="form-control input-sm" name="numerodeempregados" value="{{ old('numerodeempregados') }}">
                @if ($errors->has('numerodeempregados'))
                <span class="help-block">
                <strong>{{ $errors->first('numerodeempregados') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('tipopreco') ? ' has-error' : '' }}">
              <label for="tipopreco" class="col-md-2 control-label">Tipo da lincenca: </label>
              <div class="col-md-1">
                <select  name="tipopreco" id="inputID" class="form-control input-sm">
                  <option selected value=""> </option>
                  <option value=""> LP </option>
                  <option value=""> LI </option>
                  <option value=""> LO </option>
                </select>
                @if ($errors->has('tipopreco'))
                <span class="help-block">
                <strong>{{ $errors->first('tipopreco') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('portedaempresa') ? ' has-error' : '' }}">
              <label for="portedaempresa" class="col-md-2 control-label">Porte da empresa: </label>
              <div class="col-md-4">
                <input readonly id="portedaempresa" type="text" class="form-control input-sm" name="portedaempresa" value="{{ old('portedaempresa') }}">
                @if ($errors->has('portedaempresa'))
                <span class="help-block">
                <strong>{{ $errors->first('portedaempresa') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('ppd') ? ' has-error' : '' }}">
              <label for="ppd" class="col-md-2 control-label">PPD: </label>
              <div class="col-md-4">
                <input readonly id="ppd" type="text" class="form-control input-sm" name="ppd" value="{{ old('ppd') }}">
                @if ($errors->has('ppd'))
                <span class="help-block">
                <strong>{{ $errors->first('ppd') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('valordalicenca') ? ' has-error' : '' }}">
              <label for="valordalicenca" class="col-md-2 control-label">Valor da licenca: </label>
              <div class="col-md-4">
                <input readonly id="valordalicenca" type="text" class="form-control input-sm" name="valordalicenca" value="{{ old('valordalicenca') }}">
                @if ($errors->has('valordalicenca'))
                <span class="help-block">
                <strong>{{ $errors->first('valordalicenca') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('btncalcular') ? ' has-error' : '' }}">
              <label for="btncalcular" class="col-md-2 control-label"></label>
              <div class="col-md-4">
                <button  name="btncalcular" type="submit" class="btn btn-primary btn-sm">   Calcular   </button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection