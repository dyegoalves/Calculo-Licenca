@extends("layout.main-admin")
{{--Corpo Padrao meus Codigos --}}
@section("content")

      <div class="col-md-12">
        <h2 class="text-left page-title">SISCAL: PRINCIPAL</h2>
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
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-primary text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Abreviaturas</div>
                          </div>
                        </div>
                        <a href="{{ url("cadastro-abreviaturas")}}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
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
                    SISCAL PROCESSOS
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-success text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Cadastro</div>
                          </div>
                        </div>
                        <a href="#" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-primary text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Listar todos</div>
                          </div>
                        </div>
                        <a href="#" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-info text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Entregues</div>
                          </div>
                        </div>
                        <a href="#" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-danger text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Atrasados</div>
                          </div>
                        </div>
                        <a href="#" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- FIM SEGUNDO MENU--}}

              {{--TERCEIRO MENU--}}
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    SISCAL DICIONARIOS
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body">
                    <div class="col-md-3">
                      <div class="panel panel-default">
                        <div class="panel-body bk-success text-light">
                          <div class="stat-panel text-center">
                            <div class="stat-panel-number h5 ">Abreviaturas</div>
                          </div>
                        </div>
                        <a href="{{url("show-abreviaturas")}}" class="block-anchor panel-footer">Acesse <i class="fa fa-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- FIM DO TERCEIRO MENU--}}

            </div>
          </div>
        </div>
      </div>

@endsection