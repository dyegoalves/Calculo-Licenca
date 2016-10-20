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
            <form class="form-horizontal" action="{{url("/fazercalculos")}}" method="post" role="form">
            {{csrf_field()}}
            <h4 class="page-title" >Processo</h4>
            <div class="form-group">
              {{--Numero de processo--}}
              <div class="col-md-4 {{ $errors->has('num_processo') ? ' has-error' : '' }}">
                <label for="num_processo">Numero: </label>
                <input id="num_processo" type="text" class="form-control input-sm" name="num_processo" value="{{ old('num_processo') }}">
                @if ($errors->has('num_processo'))
                <span class="help-block">
                <strong>{{ $errors->first('num_processo') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <br/>
            <h4 class="page-title">Dados da Empresa</h4>

            {{--Tipo pessoa--}}
            <div class="form-group">
              <div class="col-sm-12">
                <label>Tipo de Pessoa    </label>
                <div class=" radio radio-info radio-inline">
                  <input value="1" type="radio" id="inlineRadio1"  name="escolhatipo" checked>
                  <label for="inlineRadio1">Pessoa Juridica?       </label>
                  <input value="2" type="radio" id="inlineRadio2"  name="escolhatipo">
                  <label for="inlineRadio2">Pessoa Fisíca?</label>
                </div>
              </div>
            </div>
            <div class="form-group">
            {{--Input Razao social--}}
              <div class="col-md-3 {{ $errors->has('razaosocial') ? ' has-error' : '' }}">
                <label for="razaosocial" >Razão Social *</label>
                <input id="razaosocial" type="text" class=" form-control input-sm" name="razaosocial" value="{{ old('razaosocial') }}">
                @if ($errors->has('razaosocial'))
                <span class="help-block">
                <strong>{{ $errors->first('razaosocial') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Nome fantasia--}}
              <div class="col-md-3 {{ $errors->has('nomefantasia') ? ' has-error' : '' }}">
                <label for="nomefantasia" >Nome fantasia *</label>
                <input id="nomefantasia" type="text" class=" form-control input-sm" name="nomefantasia" value="{{ old('nomefantasia') }}">
                @if ($errors->has('nomefantasia'))
                <span class="help-block">
                <strong>{{ $errors->first('nomefantasia') }}</strong>
                </span>
                @endif
              </div>
              {{--Input CNPJ--}}
              <div class=" col-md-3{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                <label for="cnpj" >CNPJ *</label>
                <input id="cnpj" type="text" class=" form-control input-sm" name="cnpj" value="{{ old('cnpj') }}">
                @if ($errors->has('cnpj'))
                <span class="help-block">
                <strong>{{ $errors->first('cnpj') }}</strong>
                </span>
                @endif
              </div>
              {{--Input numero inscricao--}}
              <div class=" col-md-3{{ $errors->has('numerodeinscricao') ? ' has-error' : '' }}">
                <label for="numerodeinscricao" >Nº Ins. Estadual *</label>
                <input id="numerodeinscricao" type="text" class=" form-control input-sm" name="numerodeinscricao" value="{{ old('numerodeinscricao') }}">
                @if ($errors->has('numerodeinscricao'))
                <span class="help-block">
                <strong>{{ $errors->first('numerodeinscricao') }}</strong>
                </span>
                @endif
              </div>
            </div>
            {{-- fim Input numero inscricao--}}
            <div class="form-group">
              {{--Input Email--}}
              <div class="col-md-4 {{$errors->has('email') ? ' has-error' : '' }}">
                <label for="email" >Email *</label>
                <input id="email" type="text" class=" form-control input-sm" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Nome Telefone--}}
              <div class="col-md-3 {{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone" >Telefone *</label>
                <input id="telefone" type="text" class=" form-control input-sm" name="telefone" value="{{ old('telefone') }}">
                @if ($errors->has('telefone'))
                <span class="help-block">
                <strong>{{ $errors->first('telefone') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Celular--}}
              <div class=" col-md-3{{ $errors->has('celular') ? ' has-error' : '' }}">
                <label for="celular" >Celular *</label>
                <input id="celular" type="text" class=" form-control input-sm" name="celular" value="{{ old('celular') }}">
                @if ($errors->has('celular'))
                <span class="help-block">
                <strong>{{ $errors->first('celular') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Fax--}}
              <div class=" col-md-2{{ $errors->has('fax') ? ' has-error' : '' }}">
                <label for="fax" >Fax </label>
                <input id="fax" type="text" class=" form-control input-sm" name="fax" value="{{ old('fax') }}">
                @if ($errors->has('fax'))
                <span class="help-block">
                <strong>{{ $errors->first('fax') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              {{--Input Endereco--}}
              <div class="col-md-6 {{ $errors->has('endereco') ? ' has-error' : '' }}">
                <label for="endereco" >Endereco da Empresa *</label>
                <input id="endereco" type="text" class=" form-control input-sm" name="endereco" value="{{ old('endereco') }}">
                @if ($errors->has('endereco'))
                <span class="help-block">
                <strong>{{ $errors->first('endereco') }}</strong>
                </span>
                @endif
              </div>
              {{--Input numero do empredimento--}}
              <div class=" col-md-2 {{ $errors->has('numero') ? ' has-error' : '' }}">
                <label for="numero" >Numero *</label>
                <input id="numero" type="text" class=" form-control input-sm" name="numero" value="{{ old('numero') }}">
                @if ($errors->has('numero'))
                <span class="help-block">
                <strong>{{ $errors->first('numero') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Complemento--}}
              <div class=" col-md-4{{ $errors->has('complemento') ? ' has-error' : '' }}">
                <label for="complemento" >Complemento </label>
                <input id="complemento" type="text" class=" form-control input-sm" name="complemento" value="{{ old('complemento') }}">
                @if ($errors->has('complemento'))
                <span class="help-block">
                <strong>{{ $errors->first('complemento') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              {{--Input CEP--}}
              <div class="col-md-3{{ $errors->has('cep') ? ' has-error' : '' }}">
                <label for="cep" >CEP *</label>
                <input id="cep" type="text" class=" form-control input-sm" name="cep" value="{{ old('cep') }}">
                @if ($errors->has('cep'))
                <span class="help-block">
                <strong>{{ $errors->first('cep') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Bairro--}}
              <div class="col-md-3 {{ $errors->has('bairro') ? ' has-error' : '' }}">
                <label for="bairro" >Bairro *</label>
                <input id="bairro" type="text" class=" form-control input-sm" name="bairro" value="{{ old('bairro') }}">
                @if ($errors->has('bairro'))
                <span class="help-block">
                <strong>{{ $errors->first('bairro') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Estados--}}

               <div class=" col-md-3{{ $errors->has('estado') ? ' has-error' : '' }}">
               <?php $estados = "Amazonas";?>

                <label for="estado" >Estado *</label>
                <input id="estado" type="text" class=" form-control input-sm" name="estado" value="{{old('estado')}}">

                @if ($errors->has('estado'))
                <span class="help-block">
                <strong>{{ $errors->first('estado') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Municipio--}}
              <div class=" col-md-3{{ $errors->has('municipio') ? ' has-error' : '' }}">
                <label for="municipio" >Municipio *</label>
                <input   id="municipio" type="text" class=" form-control input-sm" name="municipio" value="{{ old('municipio') }}">
                @if ($errors->has('municipio'))
                <span class="help-block">
                <strong>{{ $errors->first('municipio') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <br/>


            <h4 class="page-title">Dados do Empreendimento e Calculos Lei No 3.785/2012 * </h4>

            <div class="form-group{{ $errors->has('atividade') ? ' has-error' : '' }}">
              <label for="atividade" class="col-md-2 control-label">Atividade: </label>
              <div class="col-md-5">
                <select  autocomplete="off" name="atividade" id="atividade" class="form-control input-sm">


                    <option selected value=" "> </option>
                    @if(isset($atividade))
                    @foreach ($atividade as $key)
                         <option value="{{$key->id}}"{{ (old("atividade") == $key->id ? " selected "  : " ") }}>{{ $key->descricao }}</option>
                     @endforeach
                    @endif

                     {{--
                     @if(isset($atividade))
                           @foreach($atividade as $atv)
                               <option value="{{ $atv->id }}">{{$atv->descricao }}</option>
                           @endforeach
                     @endif
                     --}}

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
              <div class="col-md-8">
                {{--Dados obtidos por meio  de requisicao ajax main.js--}}

                <select id ='subatividade' name="subatividade"  class="form-control input-sm">
               <option selected
                value="{{ session()->has('selecsub') ? session("selecsub")->id  : ''}} ">
                {{ session()->has('selecsub') ? session("selecsub")->descricao : ''}}
               </option>
                </select>

                @if ($errors->has('subatividade'))
                <span class="help-block">
                <strong>{{ $errors->first('subatividade') }}</strong>
                </span>
                @endif
              </div>

                <div class="col-md-2">
                  <button  id="atualizarsub" name="atualizarsub" type="button" class="btn btn-primary btn-sm">Atualizar Subatividade</button>
                </div>
            </div>


            <div name="input1" class="form-group{{ $errors->has('areaultiu  ') ? ' has-error' : '' }}">
              <label for="areaultiu" class="col-md-2 control-label">Área Útil em ha (hectare)</label>
              <div class="col-md-4">
                <input id="areaultiu" type="text" class="form-control input-sm" name="areaultiu" value="{{ old('areaultiu') }}">
                @if ($errors->has('areaultiu'))
                <span class="help-block">
                <strong>{{ $errors->first('areaultiu') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div name="input2" class="form-group{{ $errors->has('numerodeempregados') ? ' has-error' : '' }}">
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
              <div class="col-md-2">

                <?php
                    $tipopreco = [1 => 'LP',2 => 'LI', 3 =>'LO']
                ?>

                <select  autocomplete="off" name="tipopreco" id="inputID" class="form-control input-sm">
                <option selected value=""> </option>
                @foreach ($tipopreco as $key => $food)
                      <option value="{{$key}}"{{ (old("tipopreco") == $key ? " selected":"") }}>{{ $food }}</option>
                @endforeach

                </select>

              </div>
              @if ($errors->has('tipopreco'))
              <span class="help-block">
              <strong>{{ $errors->first('tipopreco') }}</strong>
              </span>
              @endif
            </div>


             <div class="form-group{{ $errors->has('portedaempresa') ? ' has-error' : '' }}">
              <label for="portedaempresa" class="col-md-2 control-label">Porte da empresa: </label>
              <div class="col-md-4">
                <input readonly="readonly" id="portedaempresa" type="text" class="form-control input-sm" name="portedaempresa"
                    value="{{ session()->has('portedaempresa') ? session("portedaempresa") : '' }}">
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
{{--</div>--}}
@endsection
