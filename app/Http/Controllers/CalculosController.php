<?php

namespace App\Http\Controllers;
use App\Atividade;
use App\Porte;
use App\Ppd;
use App\User;
use Illuminate\Http\Request;
use App\Processo;
use App\Subatividade;
use Illuminate\Support\Facades\Input;
use Redirect;
use Response;
use DB;
use Validator;

class CalculosController extends Controller
{
    //Mostrar a pagina de calculo index
	public function index(Atividade $atividade)
	{
			$atividade = $atividade->getQuery()->orderBy('codigo', 'ASC')->get();
			return view('sistema.calculos.pessoajuridica', compact("atividade"));
	}
	//Mostrar a pagina de calculo pessoa juridica
	public function pessoajuridica(Atividade $atividade)
	{

			$atividade = $atividade->getQuery()->orderBy('codigo', 'ASC')->get();
			return view('sistema.calculos.pessoajuridica', compact("atividade"));
	}
	//Usado da Requisicao AJAX. para obter uma lista de subatividade
	public function listarsubatividade(Atividade $atividade, $idatividade)
	{
			$atividade = $atividade->find($idatividade);
			$subatividade = $atividade->subatividade()->getQuery()->get(['id', 'codigo', 'descricao']);
			return Response::json($subatividade);
	}
	/*
	|--------------------------------------------------------------------------
	| Calculos da licença
	|--------------------------------------------------------------------------
	|
	| Aqui vamos fazer toda parte de calculo da licenca e salvar no banco os
	| os dados fornecidos
	|
	*/


	public function fazercalculos(Request $request)
	{
		//Funcoes para calculos do processo.
		if($request->get("btncalcular") == "btncalcular" )
		{


			if($request->get('subatividade') != " ")
			{
				$subatividade  = Subatividade::find(intval(trim($request->get("subatividade"))));
				if($subatividade->codigo == "1803")
				{
					$rules = array(
						'atividade' => 'required',
						'subatividade' => 'required',
						'basedecalculo01' => 'required',
						'tipopreco' => 'required',
					);
				  return  $this->auxcalculo($rules);
				}
				else
				{
					$rules = array(
						'atividade' => 'required',
						'subatividade' => 'required',
						'basedecalculo01' => 'required',
						'basedecalculo02' => 'required',
						'tipopreco' => 'required',
					);
					return $this->auxcalculo($rules);
				}
			}
			else
			{
				$rules = array(
					'atividade' => 'required',
					'subatividade' => 'required',
					'basedecalculo01' => 'required',
					'basedecalculo02' => 'required',
					'tipopreco' => 'required',
				);
				return $this->auxcalculo($rules);
			}
		}
		// Funcoes de Salvar o Calculo do processo.
		if($request->get("btnsalvar") == "btnsalvar" )
		{

			$usuarioscadastrados = User::where('funcao','=','Analista')->get();

			if(count($usuarioscadastrados) == 0 )
			{
				$msgerro = "Nenhum usuario do tipo Analista cadastrado no sistema primeiro faça o cadastro de um usuário (Analista) para realização desta tarefa";
				return Redirect::route('calculos')
					->with(compact('msgerro'))
					->withInput();
			}

			//Regras de validação
			if($request->get('subatividade') != " "){
				$subatividade  = Subatividade::find(intval(trim($request->get("subatividade"))));
				if($subatividade->codigo == '1803')
				{
					$rules = array(
						'num_processo' => 'required',
						'razaoSocial' => 'required',
						'nomeFantasia' => 'required',
						'CNPJ' => 'required|size:14',
						'inscEstadual' => 'required',
						'email' => 'required|email',
						'telefone' => 'required',
						'celular' => 'required',
						'fax' => '',
						'endereco' => 'required',
						'numero' => 'required',
						'complemento' => '',
						'CEP' => 'required',
						'bairro' => 'required',
						'cidade' => 'required',
						'UF' => 'required',
						'atividade' => 'required',
						'subatividade' => 'required',
						'basedecalculo01' => 'required',
						'tipopreco' => 'required',
						'portedaempresa' => 'required',
						'valordalicenca' => 'required',
						'ppd' => 'required',
						'valordalicenca' => 'required',
					);
					return $this->auxcalculosalvar($rules);
				}
				else
				{
					$rules = array(
						'num_processo' => 'required',
						'razaoSocial' => 'required',
						'nomeFantasia' => 'required',
						'CNPJ' => 'required|size:14',
						'inscEstadual' => 'required',
						'email' => 'required|email',
						'telefone' => 'required',
						'celular' => 'required',
						'fax' => '',
						'endereco' => 'required',
						'numero' => 'required',
						'complemento' => '',
						'CEP' => 'required',
						'bairro' => 'required',
						'cidade' => 'required',
						'UF' => 'required',
						'atividade' => 'required',
						'subatividade' => 'required',
						'basedecalculo01' => 'required',
						'basedecalculo02' => 'required',
						'tipopreco' => 'required',
						'portedaempresa' => 'required',
						'valordalicenca' => 'required',
						'ppd' => 'required',
						'valordalicenca' => 'required',
					);
					return $this->auxcalculosalvar($rules);
				}
			}
			else
			{
				$rules = array(
					'num_processo' => 'required',
					'razaoSocial' => 'required',
					'nomeFantasia' => 'required',
					'CNPJ' => 'required|size:14',
					'inscEstadual' => 'required',
					'email' => 'required|email',
					'telefone' => 'required',
					'celular' => 'required',
					'fax' => '',
					'endereco' => 'required',
					'numero' => 'required',
					'complemento' => '',
					'CEP' => 'required',
					'bairro' => 'required',
					'cidade' => 'required',
					'UF' => 'required',
					'atividade' => 'required',
					'subatividade' => 'required',
					'basedecalculo01' => 'required',
					'basedecalculo02' => 'required',
					'tipopreco' => 'required',
					'portedaempresa' => 'required',
					'valordalicenca' => 'required',
					'ppd' => 'required',
					'valordalicenca' => 'required',
				);
				return $this->auxcalculosalvar($rules);
			}
		}
	}
	//Funcao para auxiliar o calculo dos dados de acordo com suas regras;
	public function auxcalculo($rules)
	{
			$validator = Validator::make(Input::all(), $rules);
			if($validator->fails())
			{
					return back()
							->withErrors($validator)
							->with(compact('selecsub'))
							->withInput();
			}
			//Subatividade
			$subatividade   = Subatividade::find(intval(trim(Input::get("subatividade"))));
			//PPD nivel
			$ppd = $subatividade->ppd->nivel;
			$selecsub = DB::table('subatividades')->where('id', Input::get("subatividade"))->first();
			$portedaempresa = $this->calcularporte();
			$porte = DB::table('portes')->where('tamanho', $portedaempresa)->first();
			$portemodel = Porte::find($porte->id);
			$porteppd =  $portemodel->ppd()->where('nivel', $ppd)->get();
			$ppdmodel  = Ppd::find($porteppd[0]->id);
			$tipo  = Input::get("tipopreco");
			$valordalicenca = $ppdmodel->tipopreco[0]->$tipo;
			return Redirect::route('calculos')
					->with(compact('portedaempresa', 'selecsub' , 'ppd' , 'porte' , 'valordalicenca'))
					->withInput();
	}
	//Funcao para auxiliar o salvamento dos dados de acordo com suas regras;
	public function auxcalculosalvar($rules)
	{
			$selecsub = DB::table('subatividades')->where('id', Input::get("subatividade"))->first();
			$validator = Validator::make(Input::all(), $rules);
			if($validator->fails()) {
					return back()
							->withErrors($validator)
							->with(compact('selecsub'))
							->withInput();
			}

			$cadastro  = new CadastrosController();
			if($cadastro->cadastrarprocesso())
			{
					if($cadastro->cadastrarempresa())
					{
							$sucessocadastro = "Foram salvos os seguintes dados,
											Numero de processo,
											Dados da Empresa,
											Calculos,
											Todos os dados foram cadastrado no sistema SISCAL";
							$cadastro->cadastrarempreendimento();
							return back()
									->with(compact('sucessocadastro'));
					}
					else
					{
							$processo_id  = Processo::where('num_processo' , "=" , Input::get("num_processo"))->get(['id']);
							$deletarprocesso = Processo::find($processo_id[0]->id);
							$deletarprocesso->delete();
							$errodecastroempresa = "Empresa já cadastrada no sistema SISCAL";
							return back()
									->with(compact('errodecastroempresa'))
									->withInput();
					}
			}
			else
			{
					$errodecastroprocesso = "Processo já existe cadastrado no sistema SISCAL";
					return back()
							->with(compact('errodecastroprocesso'))
							->withInput();
			}
	}
	//Auxilio calcularporte
	public function micro()
	{
			return "MICRO";
	}
	//Auxilio calcularporte
	public function pequeno()
	{
			return "PEQUENO";
	}
	//Auxilio calcularporte
	public function medio()
	{
			return "MEDIO";
	}
	//Auxilio calcularporte
	public function grande()
	{
			return "GRANDE";
	}
	//Auxilio calcularporte
	public function excepcional()
	{
			return "EXCEPCIONAL";
	}
	//Calcular porte do empreendimento
	public function calcularporte()
	{
		$atvidadecodido     = Atividade::find(intval(Input::get("atividade")));
		$subatividadecodigo = Subatividade::find(intval(Input::get("subatividade")));
		$atvidadecodido     = trim($atvidadecodido->codigo);
		$subatividadecodigo = trim($subatividadecodigo->codigo);
		if ($atvidadecodido == "03" && ($subatividadecodigo >= "0301" && $subatividadecodigo <= "0352"))
		{
				$basedecalculo01 = Input::get("basedecalculo01");
				$basedecalculo02 = Input::get("basedecalculo02");
				// tab = atv03  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
				if ($basedecalculo01 < 1 && $basedecalculo02 < 100) 														    {return $this->pequeno();}
				// tab = atv03  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
				if ($basedecalculo01 < 1 && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 	    						{return $this->medio();}
				// tab = atv03  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
				if ($basedecalculo01 < 1 && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->grande();}
				// tab = atv03  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
				if ($basedecalculo01 < 1 && ($basedecalculo02 >= 900))															{return $this->excepcional();}
				// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
				if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && $basedecalculo02 < 100) 								{return $this->medio();}
				// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
				if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))   {return $this->medio();}
				// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
				if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))     {return $this->grande();}
				// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
				if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 900)) 								{return $this->excepcional();}
				// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
				if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && $basedecalculo02 < 100) 									{return $this->grande();}
				// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
				if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))     {return $this->grande();}
				// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
				if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))       {return $this->grande();}
				// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
				if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 >= 900))                                {return $this->excepcional();}
				// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
				if (($basedecalculo01 >= 3) && $basedecalculo02 < 100) 															{return $this->excepcional();}
				// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
				if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 							{return $this->excepcional();}
				// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
				if (($basedecalculo01 >= 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->excepcional();}
				// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
				if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 900)) 														{return $this->excepcional();}
		}
		if ($atvidadecodido == "04" && ($subatividadecodigo >= "0401" && $subatividadecodigo <= "0409"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv04  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
			if ($basedecalculo01 < 1 && $basedecalculo02 < 100) 																													  {return $this->pequeno();}
			// tab = atv04  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 	    						{return $this->medio();}
			// tab = atv04  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
			if ($basedecalculo01 < 1 && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->grande();}
			// tab = atv04  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 900))															{return $this->excepcional();}
			// tab = atv04  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && $basedecalculo02 < 100) 								{return $this->medio();}
			// tab = atv04  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))   {return $this->medio();}
			// tab = atv04  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))     {return $this->grande();}
			// tab = atv04  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 900)) 								{return $this->excepcional();}
			// tab = atv04  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && $basedecalculo02 < 100) 									{return $this->grande();}
			// tab = atv04  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))     {return $this->grande();}
			// tab = atv04  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))       {return $this->grande();}
			// tab = atv04  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 2 && $basedecalculo01 < 3) && ($basedecalculo02 >= 900))                                {return $this->excepcional();}
			// tab = atv04  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 3) && $basedecalculo02 < 100) 															{return $this->excepcional();}
			// tab = atv04 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 							{return $this->excepcional();}
			// tab = atv04  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->excepcional();}
			// tab = atv04  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 900)) 														{return $this->excepcional();}
		}
		if ($atvidadecodido == "05" && ($subatividadecodigo >= "0501" && $subatividadecodigo <= "0504"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");
			// tab = atv05  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
			if ($basedecalculo01 < 0.2 && $basedecalculo02 < 100) 																												  {return $this->pequeno();}
			// tab = atv05  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 							{return $this->medio();}
			// tab = atv05  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->grande();}
			// tab = atv05  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
			if ($basedecalculo01 < 0.2 && $basedecalculo02 >= 900) 															{return $this->excepcional();}
			// tab = atv05 ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && $basedecalculo02 < 100)                               {return $this->medio();}
			// tab = atv05  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) {return $this->medio();}
			// tab = atv05  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))   {return $this->grande();}
			// tab = atv05  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 900))                            {return $this->excepcional();}
			// tab = atv05  ; col = 3 ; lin = 1 // au = 1.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && $basedecalculo02 < 100)                                   {return $this->grande();}
			// tab = atv05  ; col = 3 ; lin = 2 // au = 1.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))     {return $this->grande();}
			// tab = atv05  ; col = 3 ; lin = 3 // au = 1.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))       {return $this->grande();}
			// tab = atv05  ; col = 3 ; lin = 4  // au = 1.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 900))                                {return $this->excepcional();}
			// tab = atv05  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 3) && $basedecalculo02 < 100)                                                          {return $this->excepcional();}
			// tab = atv05  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 							{return $this->excepcional();}
			// tab = atv05  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))                              {return $this->excepcional();}
			// tab = atv05  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 900)) 																										  {return $this->excepcional();}
		}
		if ($atvidadecodido == "06" && ($subatividadecodigo >= "0601" && $subatividadecodigo <= "0604"))
		{

			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");
			// tab = atv06  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
			if ($basedecalculo01 < 1 && $basedecalculo02 < 100) 															{return $this->pequeno();}
			// tab = atv06  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 200
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 100 && $basedecalculo02 <= 200)) 								{return $this->medio();}
			// tab = atv06  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 201 ate 499
			if ($basedecalculo01 < 1 && ($basedecalculo02 > 200 && $basedecalculo02 < 500)) 								{return $this->grande();}
			// tab = atv06  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 500++
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 500)) 															{return $this->excepcional();}
			// tab = atv06  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && $basedecalculo02 < 100) 								{return $this->medio();}
			// tab = atv06  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 200
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 200))   {return $this->medio();}
			// tab = atv06  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 201 ate 499
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 > 200 && $basedecalculo02 < 500))     {return $this->grande();}
			// tab = atv06  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 500++
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 500))                              {return $this->excepcional();}
			// tab = atv06  ; col = 3 ; lin = 1 // au = 2 ate 4.99 ne = 99
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && $basedecalculo02 < 100)                                   {return $this->grande();}
			// tab = atv06  ; col = 3 ; lin = 2 // au = 2 ate 4.99 ne = 100 ate 300
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 200))     {return $this->grande();}
			// tab = atv06  ; col = 3 ; lin = 3 // au = 2 ate 4.99 ne = 301 ate 499
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 > 200 && $basedecalculo02 < 500))       {return $this->grande();}
			// tab = atv06  ; col = 3 ; lin = 4  // au = 2 ate 4.99 ne = 500++
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 >= 500))                                {return $this->excepcional();}
			// tab = atv06  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 5) && $basedecalculo02 < 100)                                                          {return $this->excepcional();}
			// tab = atv06  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 5) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 200))                            {return $this->excepcional();}
			// tab = atv06  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 5) && ($basedecalculo02 > 200 && $basedecalculo02 < 500))                              {return $this->excepcional();}
			// tab = atv06  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 5) && ($basedecalculo02 >= 500)) 																											{return $this->excepcional();}
		}
		if ($atvidadecodido == "08" && ($subatividadecodigo >= "0801" && $subatividadecodigo <= "0802"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if ($basedecalculo01 < 0.2 && $basedecalculo02 < 20)                                 							{return $this->pequeno();}
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))                 				{return $this->medio();}
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 > 50 && $basedecalculo02 < 100))                  				{return $this->grande();}
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 100))                             							{return $this->excepcional();}

			if (($basedecalculo01 >= 0.2 && $basedecalculo01 < 1 ) && $basedecalculo02 < 20)                  				{return $this->medio();}
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 < 1 ) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))   {return $this->medio();}
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 < 1 ) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))    {return $this->grande();}
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 < 1 ) && ($basedecalculo02 >= 100))              				{return $this->excepcional();}

			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3 ) && $basedecalculo02 < 20)                   				{return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3 ) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))    {return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3 ) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))     {return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3 ) && ($basedecalculo02 >= 100))               				{return $this->excepcional();}

			if (($basedecalculo01 > 3 ) && $basedecalculo02 < 20)                                							{return $this->excepcional();}
			if (($basedecalculo01 > 3 ) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))                              {return $this->excepcional();}
			if (($basedecalculo01 > 3 ) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))                               {return $this->excepcional();}
			if (($basedecalculo01 > 3 ) && ($basedecalculo02 >= 100))                                                       {return $this->excepcional();}

		}
		if ($atvidadecodido == "09" && ($subatividadecodigo >= "0901" && $subatividadecodigo <= "0905"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 2) &&  ($basedecalculo02 < 20))                              							{return $this->pequeno();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))                 				{return $this->medio();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 > 80 && $basedecalculo02 < 300))                  				{return $this->grande();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 300))                             							{return $this->excepcional();}

			if (($basedecalculo01 >= 2 &&  $basedecalculo01 <= 5) && ($basedecalculo02 < 20))                 				{return $this->medio();}
			if (($basedecalculo01 >= 2 &&  $basedecalculo01 <= 5) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))   	{return $this->medio();}
			if (($basedecalculo01 >= 2 &&  $basedecalculo01 <= 5) && ($basedecalculo02 > 80 && $basedecalculo02 < 300))    	{return $this->grande();}
			if (($basedecalculo01 >= 2 &&  $basedecalculo01 <= 5) && ($basedecalculo02 >= 300))               				{return $this->excepcional();}

			if (($basedecalculo01 > 5  &&  $basedecalculo01 < 10) && ($basedecalculo02 < 20))                 				{return $this->grande();}
			if (($basedecalculo01 > 5  &&  $basedecalculo01 < 10) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))    {return $this->grande();}
			if (($basedecalculo01 > 5  &&  $basedecalculo01 < 10) && ($basedecalculo02 > 80 && $basedecalculo02 < 300))    	{return $this->grande();}
			if (($basedecalculo01 > 5  &&  $basedecalculo01 < 10) && ($basedecalculo02 >= 300))               				{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  $basedecalculo02 < 20)                              							{return $this->excepcional();}
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))               				{return $this->excepcional();}
			if (($basedecalculo01 >= 10) && ($basedecalculo02 > 80 && $basedecalculo02 < 300))                				{return $this->excepcional();}
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 300))                           							{return $this->excepcional();}

		}
		if ($atvidadecodido == "10" && ($subatividadecodigo >= "1001" && $subatividadecodigo <= "1005"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 1) &&  ($basedecalculo02 < 20))                               							{return $this->pequeno();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 100))                				{return $this->medio();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                 				{return $this->grande();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 500))                             							{return $this->excepcional();}

			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 < 20))                  				{return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 500))                				{return $this->excepcional();}

			if (($basedecalculo01 > 2  && $basedecalculo01 < 5) &&  ($basedecalculo02 < 20))                   				{return $this->grande();}
			if (($basedecalculo01 > 2  && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 100))    {return $this->grande();}
			if (($basedecalculo01 > 2  && $basedecalculo01 < 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))     {return $this->grande();}
			if (($basedecalculo01 > 2  && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 500))                 				{return $this->excepcional();}

			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 < 20))                              							{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 100))               				{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                				{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 500))                            							{return $this->excepcional();}

		}
		if ($atvidadecodido == "11" && ($subatividadecodigo >= "1101" && $subatividadecodigo <= "1102"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 < 20))                              							{return $this->pequeno();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))                			{return $this->medio();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 > 50 && $basedecalculo02 < 300))                 			{return $this->grande();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 300))                            							{return $this->excepcional();}

			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <=1) &&  ($basedecalculo02 < 20))                  			{return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <=1) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))   {return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <=1) &&  ($basedecalculo02 > 50 && $basedecalculo02 < 300))    {return $this->grande();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <=1) &&  ($basedecalculo02 >= 300))                			{return $this->excepcional();}

			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) &&  ($basedecalculo02 < 20))                     			{return $this->grande();}
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))      {return $this->grande();}
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) &&  ($basedecalculo02 > 50 && $basedecalculo02 < 300))       {return $this->grande();}
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) &&  ($basedecalculo02 >= 300))                   			{return $this->excepcional();}

			if (($basedecalculo01 >= 3) &&  ($basedecalculo02 < 20))                               							{return $this->excepcional();}
			if (($basedecalculo01 >= 3) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))                 			{return $this->excepcional();}
			if (($basedecalculo01 >= 3) &&  ($basedecalculo02 > 50 && $basedecalculo02 < 300))                  			{return $this->excepcional();}
			if (($basedecalculo01 >= 3) &&  ($basedecalculo02 >= 300))                             							{return $this->excepcional();}

		}
		if ($atvidadecodido == "12" && ($subatividadecodigo >= "1201" && $subatividadecodigo <= "1220"))
		{

			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 1) &&  ($basedecalculo02 < 30))                               							{return $this->pequeno();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                				{return $this->medio();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                 				{return $this->grande();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 500))                             							{return $this->excepcional();}

			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 < 30))                  				{return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 500))                				{return $this->excepcional();}

			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 < 30))                    				{return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))     {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))      {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 500))                  				{return $this->excepcional();}

			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 < 30))                              							{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))               				{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                				{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 500))                           	 						{return $this->excepcional();}

		}
		if ($atvidadecodido == "12" && ($subatividadecodigo >= "1221" && $subatividadecodigo <= "1225"))
		{

			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 2) &&  ($basedecalculo02 < 30))                                							{return $this->pequeno();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                 			{return $this->medio();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                  			{return $this->grande();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 500))                              							{return $this->excepcional();}

			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 < 30))                   			{return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 500))                 			{return $this->excepcional();}

			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 < 30))                    			{return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))    {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))     {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 500))                  			{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 < 30))                              							{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))               			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 500))                            							{return $this->excepcional();}

		}
		if ($atvidadecodido == "13" && ($subatividadecodigo >= "1301" && $subatividadecodigo <= "1303"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 < 30))                                 						{return $this->pequeno();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                  			{return $this->medio();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                   			{return $this->grande();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 500))                               						{return $this->excepcional();}

			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 < 30))                    			{return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100)) {return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))  {return $this->grande();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 500))                  			{return $this->excepcional();}

			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 < 30))                        			{return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))     {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))      {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 500))                      			{return $this->excepcional();}

			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 < 30))                                  						{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                   			{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                    			{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 500))                                						{return $this->excepcional();}
		}
		if ($atvidadecodido == "14" && ($subatividadecodigo >= "1401" && $subatividadecodigo <= "1403"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 < 20))                                 						{return $this->pequeno();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))                   			{return $this->medio();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 > 80 && $basedecalculo02 < 400))                    			{return $this->grande();}
			if (($basedecalculo01 < 0.5) &&  ($basedecalculo02 >= 400))                               						{return $this->excepcional();}

			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 < 20))                    			{return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))  {return $this->medio();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 > 80 && $basedecalculo02 < 400))   {return $this->grande();}
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) &&  ($basedecalculo02 >= 400))                  			{return $this->excepcional();}

			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 < 20))                        			{return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))      {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 > 80 && $basedecalculo02 < 400))       {return $this->grande();}
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) &&  ($basedecalculo02 >= 400))                      			{return $this->excepcional();}

			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 < 20))                                  						{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 20 && $basedecalculo02 <= 80))                    			{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 > 80 && $basedecalculo02 < 400))                     			{return $this->excepcional();}
			if (($basedecalculo01 >= 5) &&  ($basedecalculo02 >= 400))                                						{return $this->excepcional();}
		}
		if ($atvidadecodido == "15" && ($subatividadecodigo >= "1501" && $subatividadecodigo <= "1508"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 1) &&  ($basedecalculo02 < 100))                                  						{return $this->pequeno();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))                   			{return $this->medio();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 > 300 && $basedecalculo02 < 900))                     			{return $this->grande();}
			if (($basedecalculo01 < 1) &&  ($basedecalculo02 >= 900))                                 						{return $this->excepcional();}

			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3) &&  ($basedecalculo02 < 100))                     			{return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3) &&  ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))  {return $this->medio();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3) &&  ($basedecalculo02 > 300 && $basedecalculo02 < 900))    {return $this->grande();}
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 3) &&  ($basedecalculo02 >= 900))                    			{return $this->excepcional();}

			if (($basedecalculo01 > 3 && $basedecalculo01 < 10) &&  ($basedecalculo02 < 100))                      			{return $this->grande();}
			if (($basedecalculo01 > 3 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))   {return $this->grande();}
			if (($basedecalculo01 > 3 && $basedecalculo01 < 10) &&  ($basedecalculo02 > 300 && $basedecalculo02 < 900))     {return $this->grande();}
			if (($basedecalculo01 > 3 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 900))                     			{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 < 100))                                						{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))                 			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 > 300 && $basedecalculo02 < 900))                   			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 900))                               						{return $this->excepcional();}
		}
		if ($atvidadecodido == "16" && ($subatividadecodigo >= "1601" && $subatividadecodigo <= "1607"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 2) &&  ($basedecalculo02 < 30))                                   						{return $this->pequeno();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                    			{return $this->medio();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                     			{return $this->grande();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 500))                                 						{return $this->excepcional();}

			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 < 30))                      			{return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 500))                    			{return $this->excepcional();}

			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 < 30))                       			{return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))    {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))     {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 500))                     			{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 < 30))                                 						{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                  			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                   			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 500))                               						{return $this->excepcional();}
		}
		if ($atvidadecodido == "17" && ($subatividadecodigo >= "1701" && $subatividadecodigo <= "1703"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 2) &&  ($basedecalculo02 < 30))                                   						{return $this->pequeno();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                    			{return $this->medio();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                     			{return $this->grande();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 500))                                 						{return $this->excepcional();}

			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 < 30))                      			{return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 500))                    			{return $this->excepcional();}

			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 < 30))                       			{return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))    {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))     {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 500))                     			{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 < 30))                                 						{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                  			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                   			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 500))                               						{return $this->excepcional();}
		}
		if ($atvidadecodido == "18" && ($subatividadecodigo >= "1801" && $subatividadecodigo <= "1801"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			if (($basedecalculo01 < 2) &&  ($basedecalculo02 < 30))                                   						{return $this->pequeno();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                    			{return $this->medio();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                     			{return $this->grande();}
			if (($basedecalculo01 < 2) &&  ($basedecalculo02 >= 500))                                 						{return $this->excepcional();}

			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 < 30))                      			{return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))   {return $this->medio();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))    {return $this->grande();}
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) &&  ($basedecalculo02 >= 500))                    			{return $this->excepcional();}

			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 < 30))                       			{return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))    {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))     {return $this->grande();}
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) &&  ($basedecalculo02 >= 500))                     			{return $this->excepcional();}

			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 < 30))                                 						{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))                  			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 > 100 && $basedecalculo02 < 500))                   			{return $this->excepcional();}
			if (($basedecalculo01 >= 10) &&  ($basedecalculo02 >= 500))                               						{return $this->excepcional();}
		}
		if ($atvidadecodido == "18" && ($subatividadecodigo >= "1803" && $subatividadecodigo <= "1803"))
		{
				$basedecalculo01 = Input::get("basedecalculo01");
				if ($basedecalculo01 <= 300)                               						{return $this->pequeno();}
				if ($basedecalculo01 > 300 && $basedecalculo01 < 500 )                			{return $this->medio();}
				if ($basedecalculo01 > 500 && $basedecalculo01 < 1000 )                			{return $this->grande();}
				if ($basedecalculo01 >= 1000)                                 		     		{return $this->excepcional();}

		}
		if ($atvidadecodido == "19" && ($subatividadecodigo >= "1901" && $subatividadecodigo <= "1906"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 2 ne de 0 ate 600
			if ($basedecalculo01 < 2 && $basedecalculo02 < 30) 														        							{return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
			if ($basedecalculo01 < 2 && ($basedecalculo02 >= 30 && $basedecalculo02 <= 100)) 	    							{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
			if ($basedecalculo01 < 2 && ($basedecalculo02 > 100 && $basedecalculo02 < 600)) 										{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
			if ($basedecalculo01 < 2 && ($basedecalculo02 >= 600))																							{return $this->excepcional();}

			// tab = atv03  ; col = 2 ; lin = 1 // au = 2 ate 5 ne ate 30
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) && $basedecalculo02 < 30) 								    							{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 2 ate 5 ne de 30 ate 100
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))    {return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 2 ate 5 ne = 100 ate 600
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) && ($basedecalculo02 > 100 && $basedecalculo02 < 600))     {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 2 ate 5 ne = 600++
			if (($basedecalculo01 >= 2 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 600)) 															{return $this->excepcional();}

			// tab = atv03  ; col = 3 ; lin = 1 // au = 5 ate 10 ne = 99
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && $basedecalculo02 < 30) 																	{return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 >= 30 && $basedecalculo02 <= 100))     {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 > 100 && $basedecalculo02 < 600))      {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 >= 600))                               {return $this->excepcional();}

			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 10) && $basedecalculo02 < 30) 																						{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 30 && $basedecalculo02 <= 100)) 							{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 10) && ($basedecalculo02 > 100 && $basedecalculo02 < 600))								{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 600)) 																				{return $this->excepcional();}
		}
		if ($atvidadecodido == "20" && ($subatividadecodigo == "2001"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 1 && ne = de <50
			if ($basedecalculo01 < 1 && $basedecalculo02 < 50) 					    									    						{return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au < 1 && 50 <= ne <= 150
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 50 && $basedecalculo02 <= 150)) 	    						{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au < 1 && 150 < ne < 500
			if ($basedecalculo01 < 1 && ($basedecalculo02 > 150 && $basedecalculo02 < 500)) 									{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au < 1 && ne >= 500
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 500))																						{return $this->excepcional();}

			// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && $basedecalculo02 < 50)   																{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 50 && $basedecalculo02 <= 150))   	{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 > 150 && $basedecalculo02 < 500))     {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 500)) 															{return $this->excepcional();}

			// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && $basedecalculo02 < 50) 																	{return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 >= 50 && $basedecalculo02 <= 150))     {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 > 150 && $basedecalculo02 < 500))      {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 5 && $basedecalculo01 < 10) && ($basedecalculo02 >= 500))                               {return $this->excepcional();}

			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 10) && $basedecalculo02 < 50) 																						{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 50 && $basedecalculo02 <= 150)) 							{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 10) && ($basedecalculo02 > 150 && $basedecalculo02 < 500))								{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 10) && ($basedecalculo02 >= 500)) 																				{return $this->excepcional();}
		}
		if ($atvidadecodido == "21" && ($subatividadecodigo >= "2101" && $subatividadecodigo <= "2102"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 1 && ne = de <50
			if ($basedecalculo01 < 0.5 && $basedecalculo02 < 20) 					    																	{return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au < 1 && 50 <= ne <= 150
			if ($basedecalculo01 < 0.5 && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50)) 	    						{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au < 1 && 150 < ne < 500
			if ($basedecalculo01 < 0.5 && ($basedecalculo02 > 50 && $basedecalculo02 < 200)) 										{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au < 1 && ne >= 500
			if ($basedecalculo01 < 0.5 && ($basedecalculo02 >= 200))																						{return $this->excepcional();}
			// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) && $basedecalculo02 < 20)   															{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))   {return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) && ($basedecalculo02 > 50 && $basedecalculo02 < 200))    {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 0.5 && $basedecalculo01 <= 2) && ($basedecalculo02 >= 200)) 														{return $this->excepcional();}
			// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && $basedecalculo02 < 20) 																		{return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))       {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 > 50 && $basedecalculo02 < 200))        {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 2 && $basedecalculo01 < 5) && ($basedecalculo02 >= 200))                                {return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 5) && $basedecalculo02 < 20) 																							{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 5) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50)) 							    {return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 5) && ($basedecalculo02 > 50 && $basedecalculo02 < 200))										{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 5) && ($basedecalculo02 >= 200)) 																					{return $this->excepcional();}
		}
		if ($atvidadecodido == "25" && ($subatividadecodigo == "2501"))
		{

			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 20)                               						{return $this->pequeno();}
			if ($basedecalculo01 > 20 && $basedecalculo01 <= 50 )                	{return $this->medio();}
			if ($basedecalculo01 > 50 && $basedecalculo01 < 100 )                	{return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     	{return $this->excepcional();}
		}
		if ($atvidadecodido == "25" && ($subatividadecodigo == "2502"))
		{

			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 10)     	                         						{return $this->pequeno();}
			if ($basedecalculo01 > 10 && $basedecalculo01 <= 20 )                	{return $this->medio();}
			if ($basedecalculo01 > 20 && $basedecalculo01 <= 40 )                	{return $this->grande();}
			if ($basedecalculo01 > 40)                                 		     		{return $this->excepcional();}
		}
		if ($atvidadecodido == "25" && ($subatividadecodigo >= "2503" && $subatividadecodigo <= "2504"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 50)                               						{return $this->pequeno();}
			if ($basedecalculo01 > 50 && $basedecalculo01 <= 250 )                {return $this->medio();}
			if ($basedecalculo01 > 250 && $basedecalculo01 <= 500 )               {return $this->grande();}
			if ($basedecalculo01 > 500)                                 		     	{return $this->excepcional();}
		}


		/*
		 * Testar as atividades abaixo
		 *
		 * */

		//PORTE-68: 2505
		if ($atvidadecodido == "25" && ($subatividadecodigo == "2505"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 20)                               						{return $this->pequeno();}
			if ($basedecalculo01 > 20 && $basedecalculo01 <= 80 )                	{return $this->medio();}
			if ($basedecalculo01 > 80 && $basedecalculo01 < 240 )                	{return $this->grande();}
			if ($basedecalculo01 >= 240)                                 		     	{return $this->excepcional();}
		}
		//PORTE-72: 2506
		if ($atvidadecodido == "25" && ($subatividadecodigo == "2506"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 100)                               						{return $this->pequeno();}
			if ($basedecalculo01 >= 100 && $basedecalculo01 <= 200 )              {return $this->medio();}
			if ($basedecalculo01 > 200 && $basedecalculo01 < 400 )                {return $this->grande();}
			if ($basedecalculo01 >= 400)                                 		     	{return $this->excepcional();}
		}
		//PORTE-69: 2703
		if ($atvidadecodido == "27" && ($subatividadecodigo == "2703"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 20)                               						{return $this->pequeno();}
			if ($basedecalculo01 > 20 && $basedecalculo01 <= 50 )                	{return $this->medio();}
			if ($basedecalculo01 > 50 && $basedecalculo01 < 100 )                	{return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     	{return $this->excepcional();}
		}
		//PORTE-76: 2701-2702;2706
		if ($atvidadecodido == "27" && ($subatividadecodigo >= "2701" && $subatividadecodigo <= "2702" || $subatividadecodigo=="2706"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 <= 20)                               						{return $this->pequeno();}
			if ($basedecalculo01 >= 20 && $basedecalculo01 <= 50 )                {return $this->medio();}
			if ($basedecalculo01 > 50 && $basedecalculo01 < 150 )                	{return $this->grande();}
			if ($basedecalculo01 >= 150)                                 		     	{return $this->excepcional();}
		}
		//PORTE-77: 2704;2707
		if ($atvidadecodido == "27" && ($subatividadecodigo == "2704" || $subatividadecodigo=="2707"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 10)                               						{return $this->pequeno();}
			if ($basedecalculo01 >= 10 && $basedecalculo01 <= 30 )              {return $this->medio();}
			if ($basedecalculo01 > 30 && $basedecalculo01 < 100 )               {return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		    {return $this->excepcional();}
		}
		//porte-78: 2705
		if ($atvidadecodido == "27" && ($subatividadecodigo == "2705"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 1 && ne = de < 10
			if ($basedecalculo01 < 1 && $basedecalculo02 < 10) 					    									    {return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au < 1 && 50 <= ne <= 150
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 10 && $basedecalculo02 <= 30)) 	    						{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au < 1 && 150 < ne < 500
			if ($basedecalculo01 < 1 && ($basedecalculo02 > 30 && $basedecalculo02 < 100))   								{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au < 1 && ne >= 500
			if ($basedecalculo01 < 1 && ($basedecalculo02 >= 100))															{return $this->excepcional();}

			// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && $basedecalculo02 < 10)   								{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 10 && $basedecalculo02 <= 30))     {return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 > 30 && $basedecalculo02 < 100))      {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 1 && $basedecalculo01 <= 5) && ($basedecalculo02 >= 100)) 								{return $this->excepcional();}

			// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 5 && $basedecalculo01 < 15) && $basedecalculo02 < 10) 								    {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 5 && $basedecalculo01 < 15) && ($basedecalculo02 >= 10 && $basedecalculo02 <= 30))      {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 5 && $basedecalculo01 < 15) && ($basedecalculo02 > 30 && $basedecalculo02 < 100))       {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 5 && $basedecalculo01 < 15) && ($basedecalculo02 >= 100))                               {return $this->excepcional();}

			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 15) && $basedecalculo02 < 10) 															{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 15) && ($basedecalculo02 >= 10 && $basedecalculo02 <= 30)) 							{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 15) && ($basedecalculo02 > 30 && $basedecalculo02 < 100))								{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 15) && ($basedecalculo02 >= 100)) 														{return $this->excepcional();}
		}
		//PORTE-79: 2708-2710
		if ($atvidadecodido == "27" && ($subatividadecodigo >= "2708" && $subatividadecodigo <= "2710"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 1)                               								{return $this->pequeno();}
			if ($basedecalculo01 > 1 && $basedecalculo01 <= 3 )                			{return $this->medio();}
			if ($basedecalculo01 > 3 && $basedecalculo01 < 5 )                			{return $this->grande();}
			if ($basedecalculo01 >= 5)                                 		     			{return $this->excepcional();}
		}
		//PORTE-79: 2712-2715
		if ($atvidadecodido == "27" && ($subatividadecodigo >= "2712" && $subatividadecodigo <= "2715"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 1)                               								{return $this->pequeno();}
			if ($basedecalculo01 > 1 && $basedecalculo01 <= 3 )                			{return $this->medio();}
			if ($basedecalculo01 > 3 && $basedecalculo01 < 5 )                			{return $this->grande();}
			if ($basedecalculo01 >= 5)                                 		     			{return $this->excepcional();}
		}
		//PORTE-80: 2711
		if ($atvidadecodido == "27" && ($subatividadecodigo == "2711"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 30)                               									{return $this->pequeno();}
			if ($basedecalculo01 >= 30 && $basedecalculo01 <= 80 )                		{return $this->medio();}
			if ($basedecalculo01 > 80 && $basedecalculo01 < 300 )                			{return $this->grande();}
			if ($basedecalculo01 >= 300)                                 		     			{return $this->excepcional();}
		}
		//PORTE-99: 3201;3203;3205
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3201" || $subatividadecodigo=="3203" || $subatividadecodigo=="3205"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 5)                               								  {return $this->pequeno();}
			if ($basedecalculo01 >= 5 && $basedecalculo01 <= 20 )                			{return $this->medio();}
			if ($basedecalculo01 > 20 && $basedecalculo01 < 50 )                			{return $this->grande();}
			if ($basedecalculo01 >= 50)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-100: 3202;3204;3216
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3202" || $subatividadecodigo=="3204" || $subatividadecodigo=="3216"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 5)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 5 && $basedecalculo01 <= 30 )                			{return $this->medio();}
			if ($basedecalculo01 > 30 && $basedecalculo01 < 100 )                			{return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-101: 3206-3208
		if ($atvidadecodido == "32" && ($subatividadecodigo >= "3206" && $subatividadecodigo <="3208"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 0.5)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 0.5 && $basedecalculo01 <= 3 )                			{return $this->medio();}
			if ($basedecalculo01 > 3 && $basedecalculo01 < 8 )                    			{return $this->grande();}
			if ($basedecalculo01 >= 8)                                 		         		  {return $this->excepcional();}
		}
		//PORTE-102: 3209
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3209"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 5)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 5 && $basedecalculo01 <= 30 )                			{return $this->medio();}
			if ($basedecalculo01 > 30 && $basedecalculo01 < 100 )                			{return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-103: 3210
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3210"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 2)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 2 && $basedecalculo01 <= 20 )                			{return $this->medio();}
			if ($basedecalculo01 > 20 && $basedecalculo01 < 100 )                			{return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-104: 3211
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3212"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 5)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 5 && $basedecalculo01 <= 20 )                			{return $this->medio();}
			if ($basedecalculo01 > 20 && $basedecalculo01 < 50 )                			{return $this->grande();}
			if ($basedecalculo01 >= 50)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-105: 3212-3213;3215
		if ($atvidadecodido == "32" && ($subatividadecodigo >= "3212" && $subatividadecodigo <= "3213" || $subatividadecodigo=="3215"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 20)                               						      {return $this->pequeno();}
			if ($basedecalculo01 >= 20 && $basedecalculo01 <= 50 )                		{return $this->medio();}
			if ($basedecalculo01 > 50 && $basedecalculo01 < 200 )                			{return $this->grande();}
			if ($basedecalculo01 >= 200)                                 		     		  {return $this->excepcional();}
		}
		//PORTE-106: 3214
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3214"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 20)                               						        {return $this->pequeno();}
			if ($basedecalculo01 >= 20 && $basedecalculo01 <= 50 )                			{return $this->medio();}
			if ($basedecalculo01 > 50 && $basedecalculo01 < 100 )                			  {return $this->grande();}
			if ($basedecalculo01 >= 100)                                 		     		    {return $this->excepcional();}
		}
		//PORTE-107: 3217
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3217"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 1000)                               						{return $this->pequeno();}
			if ($basedecalculo01 >= 1000 && $basedecalculo01 <= 2000 )            {return $this->medio();}
			if ($basedecalculo01 > 2000 && $basedecalculo01 < 5000 )              {return $this->grande();}
			if ($basedecalculo01 >= 5000)                                 		    {return $this->excepcional();}
		}
		//PORTE-108: 3218
		if ($atvidadecodido == "32" && ($subatividadecodigo == "3218"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			if ($basedecalculo01 < 0.5)                               						{return $this->pequeno();}
			if ($basedecalculo01 >= 0.5 && $basedecalculo01 <= 3 )               	{return $this->medio();}
			if ($basedecalculo01 > 3 && $basedecalculo01 < 8 )                   	{return $this->grande();}
			if ($basedecalculo01 >= 8)                                 	    	    {return $this->excepcional();}
		}
		//porte-109: 3219-3221
		if ($atvidadecodido == "32" && ($subatividadecodigo >= "3219" && $subatividadecodigo <= "3221"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 1 && ne = de <50
			if ($basedecalculo01 < 0.2 && $basedecalculo02 < 20) 					    									{return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au < 1 && 50 <= ne <= 150
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50)) 	    						{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au < 1 && 150 < ne < 500
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 > 50 && $basedecalculo02 < 100)) 								{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au < 1 && ne >= 500
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 100))														{return $this->excepcional();}

			// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && $basedecalculo02 < 20)   								{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))   {return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))    {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 0.1 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 100)) 							{return $this->excepcional();}

			// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && $basedecalculo02 < 20) 									{return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50))       {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))        {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 100))                                {return $this->excepcional();}

			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 3) && $basedecalculo02 < 20) 															{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 20 && $basedecalculo02 <= 50)) 							    {return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 3) && ($basedecalculo02 > 50 && $basedecalculo02 < 100))								{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 100)) 														{return $this->excepcional();}
		}
		//porte-110: 3301-3306
		if ($atvidadecodido == "33" && ($subatividadecodigo >= "3301" && $subatividadecodigo <= "3306"))
		{
			$basedecalculo01 = Input::get("basedecalculo01");
			$basedecalculo02 = Input::get("basedecalculo02");

			// tab = atv03  ; col = 1 ; lin = 1 // au < 1 && ne = de <50
			if ($basedecalculo01 < 0.2 && $basedecalculo02 < 100) 					    									{return $this->pequeno();}
			// tab = atv03  ; col = 1 ; lin = 2 // au < 1 && 50 <= ne <= 150
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 	    						{return $this->medio();}
			// tab = atv03  ; col = 1 ; lin = 3 // au < 1 && 150 < ne < 500
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 > 300 && $basedecalculo02 < 900)) 								{return $this->grande();}
			// tab = atv03  ; col = 1 ; lin = 4 // au < 1 && ne >= 500
			if ($basedecalculo01 < 0.2 && ($basedecalculo02 >= 900))														{return $this->excepcional();}

			// tab = atv03  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && $basedecalculo02 < 100)   							{return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 50))  {return $this->medio();}
			// tab = atv03  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
			if (($basedecalculo01 >= 0.2 && $basedecalculo01 <= 1) && ($basedecalculo02 > 300 && $basedecalculo02 < 100))   {return $this->grande();}
			// tab = atv03  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
			if (($basedecalculo01 >= 0.1 && $basedecalculo01 <= 1) && ($basedecalculo02 >= 900)) 							{return $this->excepcional();}

			// tab = atv03  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && $basedecalculo02 < 100) 									{return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300))     {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))       {return $this->grande();}
			// tab = atv03  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
			if (($basedecalculo01 > 1 && $basedecalculo01 < 3) && ($basedecalculo02 >= 900))                                {return $this->excepcional();}

			// tab = atv03  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
			if (($basedecalculo01 >= 3) && $basedecalculo02 < 100) 															{return $this->excepcional();}
			// tab = atv03 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 100 && $basedecalculo02 <= 300)) 							{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
			if (($basedecalculo01 >= 3) && ($basedecalculo02 > 300 && $basedecalculo02 < 900))								{return $this->excepcional();}
			// tab = atv03  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
			if (($basedecalculo01 >= 3) && ($basedecalculo02 >= 900)) 														{return $this->excepcional();}
		}
		}
	/*|-------------------------------------------------------------------------- */
}
