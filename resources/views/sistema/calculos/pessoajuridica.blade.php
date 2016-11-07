@extends('layout.main-admin')
@section('content')

      <div class="col-md-12">
        <h2 class="page-title">Calculo da licenca</h2>
        <div class="panel panel-default">
          <div class="panel-heading">Formulário - Calculo da licenca.      <strong>  Atencao !</strong> È obrigatorio o preenchimento de todos os dados *.</div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{url("/fazercalculos")}}" method="post" role="form">
            {{csrf_field()}}

            @if(session()->has('sucessocadastro'))
            <div class="alert alert-success fade in">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Successo!</strong> {{ session("sucessocadastro") }}
            </div>
            @endif

            @if(session()->has('errodecastroprocesso'))
            <div class="alert alert-danger fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Erro! </strong> {{ session("errodecastroprocesso")}}
            </div>
            @endif

            @if(session()->has('errodecastroempresa'))
            <div class="alert alert-danger fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Erro! </strong> {{ session("errodecastroempresa")}}
            </div>
            @endif

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
                <label>Tipo de Pessoa    </label> <br/>
                <div class=" radio radio-info radio-inline">
                  <input value="1" type="radio" id="inlineRadio1"  name="escolhatipo" checked>
                  <label for="inlineRadio1">Pessoa Juridica?</label>     

                </div>
              </div>
            </div>
            <div class="form-group">
              {{--Input Razao social--}}
              <div class="col-md-3 {{ $errors->has('razaoSocial') ? ' has-error' : '' }}">
                <label for="razaoSocial" >Razão Social *</label>
                <input id="razaoSocial" type="text" class=" form-control input-sm" name="razaoSocial" value="{{ old('razaoSocial') }}">
                @if ($errors->has('razaoSocial'))
                <span class="help-block">
                <strong>{{ $errors->first('razaoSocial') }}</strong>
                </span>
                @endif
              </div>
              {{--Input Nome fantasia--}}
              <div class="col-md-3 {{ $errors->has('nomeFantasia') ? ' has-error' : '' }}">
                <label for="nomeFantasia" >Nome fantasia *</label>
                <input id="nomeFantasia" type="text" class=" form-control input-sm" name="nomeFantasia" value="{{ old('nomeFantasia') }}">
                @if ($errors->has('nomeFantasia'))
                <span class="help-block">
                <strong>{{ $errors->first('nomeFantasia') }}</strong>
                </span>
                @endif
              </div>
              {{--Input CNPJ--}}
              <div class=" col-md-3{{ $errors->has('CNPJ') ? ' has-error' : '' }}">
                <label for="CNPJ" >CNPJ *</label>
                <input id="CNPJ" type="text" class=" form-control input-sm" name="CNPJ" value="{{ old('CNPJ') }}">
                @if ($errors->has('CNPJ'))
                <span class="help-block">
                <strong>{{ $errors->first('CNPJ') }}</strong>
                </span>
                @endif
              </div>
              {{--Input numero inscricao--}}
              <div class=" col-md-3{{ $errors->has('inscEstadual') ? ' has-error' : '' }}">
                <label for="inscEstadual" >Nº Ins. Estadual *</label>
                <input id="inscEstadual" type="text" class=" form-control input-sm" name="inscEstadual" value="{{ old('inscEstadual') }}">
                @if ($errors->has('inscEstadual'))
                <span class="help-block">
                <strong>{{ $errors->first('inscEstadual') }}</strong>
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
              <div class="col-md-3{{ $errors->has('CEP') ? ' has-error' : '' }}">
                <label for="CEP" >CEP *</label>
                <input id="CEP" type="text" class=" form-control input-sm" name="CEP" value="{{ old('CEP') }}">
                @if ($errors->has('CEP'))
                <span class="help-block">
                <strong>{{ $errors->first('CEP') }}</strong>
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


              {{--Input Municipio--}}
              <div class=" col-md-3{{ $errors->has('cidade') ? ' has-error' : '' }}">
                <label for="cidade" >Municipio *</label>
                <input   id="cidade" type="text" class=" form-control input-sm" name="cidade" value="{{ old('cidade') }}">
                @if ($errors->has('cidade'))
                <span class="help-block">
                <strong>{{ $errors->first('cidade') }}</strong>
                </span>
                @endif
              </div>


              {{--Input Estados--}}
            <div class=" col-md-3{{ $errors->has('UF') ? ' has-error' : '' }}">
              <?php $estados = "Amazonas";?>
              <label for="UF" >Estado *</label>
              <input id="UF" type="text" class=" form-control input-sm" name="UF" value="{{old('UF')}}">
              @if ($errors->has('UF'))
              <span class="help-block">
              <strong>{{ $errors->first('UF') }}</strong>
              </span>
              @endif
            </div>

            </div>
            <br/>
            <h4 class="page-title">Dados do Empreendimento e Calculos Lei No 3.785/2012 * </h4>

                @if(session()->has('erroatividade'))
                <div class="alert alert-danger fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Erro! </strong> {{ session("erroatividade")}}
                </div>
                @endif

                @if(session()->has('errosubatividade'))
                <div class="alert alert-danger fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Erro! </strong> {{ session("errosubatividade")}}
                </div>
                @endif


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
                <button  id="atualizarsub" name="atualizarsub" type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></button>
              </div>
            </div>


            <div name="basedecalculo01" class="form-group{{ $errors->has('basedecalculo01') ? ' has-error' : '' }}">
              <label name= "basedecalculo01" for="basedecalculo01" class="col-md-2 control-label">Área Útil em ha (hectare)</label>
              <div class="col-md-4">
                <input id="basedecalculo01" type="text" class="form-control input-sm" name="basedecalculo01" value="{{ old('basedecalculo01') }}">
                @if ($errors->has('basedecalculo01'))
                <span class="help-block">
                <strong>{{ $errors->first('basedecalculo01') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div name="basedecalculo02" class="form-group{{ $errors->has('basedecalculo02') ? ' has-error' : '' }}">
              <label name= "basedecalculo02" for="basedecalculo02" class="col-md-2 control-label">Nº de empregados: </label>
              <div class="col-md-4">
                <input id="basedecalculo02" type="text" class="form-control input-sm" name="basedecalculo02" value="{{ old('basedecalculo02') }}">
                @if ($errors->has('basedecalculo02'))
                <span class="help-block">
                <strong>{{ $errors->first('basedecalculo02') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('tipopreco') ? ' has-error' : '' }}">
              <label for="tipopreco" class="col-md-2 control-label">Tipo da lincenca: </label>
              <div class="col-md-2">
                <?php
                  $tipopreco = ['LP' => 'LP', 'LI' => 'LI','LO' =>'LO'];
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
                value="{{ session()->has('portedaempresa') ? session("portedaempresa") : ' ' }}">
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
                <input readonly id="ppd" type="text" class="form-control input-sm" name="ppd"
                value="{{ session()->has('ppd') ? session("ppd") : '' }}">
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
                <input readonly id="valordalicenca" type="text" class="form-control input-sm" name="valordalicenca"
                value="{{ session()->has('valordalicenca') ? session("valordalicenca") : '' }}">
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
                <button value="btncalcular"  name="btncalcular" type="submit" class="btn btn-primary btn-sm">   Calcular   </button>    
                <button  value="btnsalvar"   name="btnsalvar" type="submit" class="btn btn-success btn-sm">   Salvar   </button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>

@endsection