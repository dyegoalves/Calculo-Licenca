@extends("layout.main-admin")
{{--Corpo Padrao meus Codigos --}}
@section("content")

      <div class="col-md-12">
        <h2 class="text-left page-title">SISCAL: Tela de Inicio</h2>
      </div>

      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">ACESSO RAPIDO AS PRINCIPAIS FUNCOES</div>
          <div class="panel-body">
            <div class="panel" id="accordion" role="tablist" aria-multiselectable="true">

              {{--PRIMEIRO MENU--}}
              <div class="panel  panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                    SISCAL CADASTROS
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-success text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Usuarios</div>
                          </div>
                        </div>
                        <a href="{{url("cadastro-usuario")}}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
              {{-- FIM PRIMEIRO MENU--}}

              {{--SEGUNDO MENU--}}
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    SISCAL PROCESSOS - CÁLCULOS
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-success text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Cadastro e Calculos</div>
                          </div>
                        </div>
                        <a href="{{ url("/calculos") }}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-primary text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Consultar Processo</div>
                          </div>
                        </div>
                        <a href="{{ url("/consultarprocessoindex") }}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-info text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Listar todos os Processos</div>
                          </div>
                        </div>
                        <a href="{{url("/listartodosprocessos")}}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
              {{-- FIM SEGUNDO MENU--}}



            </div>
          </div>
        </div>
      </div>

@endsection