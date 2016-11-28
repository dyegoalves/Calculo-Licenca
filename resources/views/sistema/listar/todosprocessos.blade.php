@extends('layout.main-admin')
@section('content')

      <div class="col-md-12">
        <h2 class="page-title">SISCAL: Lista de todos os processo cadastrados</h2>
        <div class="panel panel-default">
          <div class="panel-heading">Lista: </div>
          <div class="panel-body">
            <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
              <div class="col-sm-12">
                <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 20%;">Nome da Empresa</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 10%;">CNPJ</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="CNPJ: activate to sort column ascending" style="width: 17%;">Numero processo</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 17%;">Data de Entrada</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width:14%;">Responsavel</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width:10%;">Situação</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Acao: activate to sort column ascending" style="width: 25%;">Ação</th>

                  </thead>
                    {{--<tfoot>
                      <tr>
                      <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 152px;">Nome da Empresa</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 235px;">Numero processo</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 150px;">Data de Entrada</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 51px;">Situação</th>
                      <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 104px;">Ação</th>
                      </tr>
                    </tfoot>--}}
                  <tbody>

                    @foreach($processos as $processo)
                    <tr id="trprocesso" role="row" class="even">
                      <td class="sorting_1">{{$processo->empreendimento->empresa->razaoSocial}}</td>
                      <td>{{$processo->empreendimento->empresa->CNPJ}}</td>
                      <td>{{$processo->num_processo}}</td>
                      <td>{{date("d/m/Y H:i:s", strtotime($processo->created_at))}}</td>
                       <td>{{$processo->user->name}}</td>
                      <td>{{$processo->situacao}}</td>
                      <td><button class="btn btn-primary btn-xs" type="submit">Editar</button>  <button class="btn btn-danger btn-xs" type="submit">Deletar</button>  </td>
                    </tr>
                    @endforeach

                   {{--@for($i = 0 ; $i < 100 ; $i ++)
                    <tr id="trprocesso" role="row" class="even">
                      <td>{{ palavra()}}</td>
                      <td>{{ gerarCNPJ() }}</td>
                      <td>{{ gerarProceso()}}</td>
                      <td>{{ gerarData() }}</td>
                      <td>{{ 'Situacao' . rand( $i , 100) }}</td>
                      <td><button class="btn btn-primary btn-xs" type="submit">Editar</button>  <button class="btn btn-danger btn-xs" type="submit">Deletar</button>  </td>
                    </tr>
                   @endfor--}}
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="zctb_info" role="status" aria-live="polite"></div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>

@endsection