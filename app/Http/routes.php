<?php
Route::auth();

Route::group(['middleware' => ['auth']], function () {


    /*-------------------------------------------------------------------------/
     *    Rotas do controller Admin
     *------------------------------------------------------------------------*/
	      Route::get("/sistema-inicio" ,"AdminController@sistema_inicio");
        Route::get('/', "AdminController@sistema_inicio");
	      Route::get('/permissaodeacessorota' , ['as' => 'permissaodeacessorota', 'uses' => 'AdminController@permissaodeacessorota']);

    /*------------------------------------------------------------------------*/

    /*-------------------------------------------------------------------------/
     *   Rotas do controller Cadastro
     *------------------------------------------------------------------------*/
        Route::get("/profile", ['as' => 'profile' , 'uses' => "CadastrosController@profile"]);
        Route::get('/atividade-subatividade' , ['as' => 'pag-atividade-sub', 'uses' => 'CadastrosController@atividade_subatividade']);
        Route::post("/profile", "CadastrosController@salvar_imagem");
        Route::post('/atividade' , 'CadastrosController@atividade');
        Route::post('/subatividade' , 'CadastrosController@subatividade');
	      Route::get("/cadastro-usuario" ,"CadastrosController@cadastro_usuario")
									->middleware('PermisaoRotas');
		/*-------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------/
     *    Rotas do controller Home
     *-------------------------------------------------------------------------*/
        //Acessa a pagina do Bootstrap.
        Route::get("/bootstrap", "HomeController@bootstrap");
        Route::get("/teste", "HomeController@teste");
    /*-------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------/
     *    Rotas do controller Abreviaturas
     *-------------------------------------------------------------------------*/
        Route::get  ("/cadastro-abreviaturas", "AbreviaturaController@getcadastro_abreviaturas");
        Route::post ("/cadastro-abreviaturas","AbreviaturaController@postcadastro_abreviaturas");
        Route::get  ("/show-abreviaturas", "AbreviaturaController@show_abreviaturas");
    /*-------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------/
     *    Rotas do controller Calculos
     *-------------------------------------------------------------------------*/
        Route::get("/calculo-porte" , "CalculosController@calculo_porte");
        Route::get('/listarsubatividade/{idatividade}' , 'CalculosController@listarsubatividade');

				Route::get('/calculos' , ['as' => 'calculos', 'uses' => 'CalculosController@index'])
									->middleware('PermisaoRotas');;

				Route::post('/fazercalculos' , 'CalculosController@fazercalculos');
        Route::post('/calcularporte' , ['as' => 'calcularporte', 'uses' => 'CalculosController@calcularporte']);
        Route::get('/testes' , 'CalculosController@testes');
    /*-------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------
     *    Rotas do controller Ferramentas
     *-------------------------------------------------------------------------*/
        Route::get('/criarativiades' , 'FerramentasController@criarativiades');
        Route::get('/criarportes', 'FerramentasController@criarportes');
        Route::get('/criarppds', 'FerramentasController@criarppds');
        Route::get('/criartipoprecos', 'FerramentasController@criartipoprecos');
        Route::get('/criarsubatividades' , 'FerramentasController@criarsubatividades');
        Route::get('/showdadosmodels/{model}', 'FerramentasController@showdadosmodels');
        Route::get('/showdados', 'FerramentasController@showdados');
    /*---------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------
    *    Rotas do controller Consultar
    *-------------------------------------------------------------------------*/
				Route::get('/consultarprocessoindex' , 'ConsultarController@index');
				Route::post('/fazerconsultarprocesso' , 'ConsultarController@fazerconsultarprocesso');
		/*---------------------------------------------------------------------------*/

		/*--------------------------------------------------------------------------
		*    Rotas do controller Listas
		*-------------------------------------------------------------------------*/
				Route::get('/listartodosprocessos' , 'ListasController@listartodosprocessos');

	/*---------------------------------------------------------------------------*/

}) ;

   /*------------------------------------------------------------------------------
    *    Rotas do controller Ferramentas - Fora da restricao logado
    *-----------------------------------------------------------------------------*/
        Route::get('/instalarbancodedados', 'FerramentasController@instalarbancodedados');
        Route::get('/comandocriarbanco', 'FerramentasController@comandocriarbanco');
				Route::get('/resetsenha', "AdminController@resetsenha");

   /*-----------------------------------------------------------------------------*/



