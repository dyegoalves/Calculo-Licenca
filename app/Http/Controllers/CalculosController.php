<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Empresa;
use App\Porte;
use App\Ppd;
use Illuminate\Http\Request;
use App\Processo;
use App\Subatividade;
use Illuminate\Support\Facades\Input;
use Redirect;
use Response;
use Illuminate\Support\Facades\View;
use DB;
use Validator;

class CalculosController extends Controller
{
    // Mostrar a pagina de calculo index
    public function index(Atividade $atividade)
    {
        $atividade = $atividade->getQuery()->orderBy('codigo', 'ASC')->get();
        return view('sistema.calculos.pessoajuridica', compact("atividade"));
    }
    // Mostrar a pagina de calculo pessoa juridica
    public function pessoajuridica(Atividade $atividade)
    {
        $atividade = $atividade->getQuery()->orderBy('codigo', 'ASC')->get();
        return view('sistema.calculos.pessoajuridica', compact("atividade"));
    }
    // Mostrar a pagina de calculo pessoa fisica
    public function pessoafisica(Atividade $atividade)
    {
        $atividade = $atividade->getQuery()->orderBy('codigo', 'ASC')->get();
        return view('sistema.calculos.pessoafisica', compact("atividade"));
    }
    // Usado da Requisicao AJAX. para obter uma lista de subatividade
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
    //Faz os caluculos da Lincenca
    /**
     * @param Request $request
     * @param Subatividade $subatividade
     * @return $this
     */
    public function fazercalculos(Request $request)
    {



        //Regras de validacao

       /* $rules = array(
        'num_processo' => 'required',
        'razaosocial' => 'required',
        'nomefantasia' => 'required',
        'cnpj' => 'required|size:14',
        'numerodeinscricao' => 'required',
        'email' => 'required|email',
        'telefone' => 'required',
        'celular' => 'required',
        'fax' => '',
        'endereco' => 'required',
        'numero' => 'required',
        'complemento' => '',
        'cep' => 'required',
        'bairro' => 'required',
        'estado' => 'required',
        'municipio' => 'required',
        'atividade' => 'required',
        'subatividade' => 'required',
        'areaultiu' => 'required',
        'numerodeempregados' => 'required',
        'tipopreco' => 'required',
        'portedaempresa' => 'required',
        'valordalicenca' => 'required',
        'ppd' => 'required',
        );

        $selecsub = DB::table('subatividades')->where('id', Input::get("subatividade"))->first();
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with(compact('selecsub'))
                ->withInput();
        }*/



        if($request->get("btncalcular") == "btncalcular" ){
            $rules = array(

                'atividade' => 'required',
                'subatividade' => 'required',
                'areaultiu' => 'required',
                'numerodeempregados' => 'required',
                'tipopreco' => 'required'

            );

            $validator = Validator::make(Input::all(), $rules);
            if($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->with(compact('selecsub'))
                    ->withInput();
            }

        //Subatividade
        $subatividade   = Subatividade::find(intval(trim($request->get("subatividade"))));
        //PPD nivel
        $ppd = $subatividade->ppd->nivel;
        $selecsub = DB::table('subatividades')->where('id', Input::get("subatividade"))->first();
        $portedaempresa = $this->calcularporte();
        $porte = DB::table('portes')->where('tamanho', $portedaempresa)->first();
        $portemodel = Porte::find($porte->id);
        $porteppd =  $portemodel->ppd()->where('nivel', $ppd)->get();
        $ppdmodel  = Ppd::find($porteppd[0]->id);
        $tipo  = $request->get("tipopreco");
        $valordalicenca = "R$ " . $ppdmodel->tipopreco[0]->$tipo;
        return Redirect::route('calculos')
               ->with(compact('portedaempresa', 'selecsub' , 'ppd' , 'porte' , 'valordalicenca'))
               ->withInput();
        }

        if($request->get("btnsalvar") == "btnsalvar" ){


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

        if ($atvidadecodido == "04" && ($subatividadecodigo >= "0401" && $subatividadecodigo <= "0409"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv04  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 1 && $ne < 100)
            {
                return $this->pequeno();
            }
            // tab = atv04  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if ($au < 1 && ($ne >= 100 && $ne <= 300))
            {
                return $this->medio();
            }
            // tab = atv04  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if ($au < 1 && ($ne > 300 && $ne < 900))
            {
               return $this->grande();
            }
            // tab = atv04  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if ($au < 1 && ($ne >= 900))
            {
                return $this->excepcional();
            }
            // tab = atv04  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 1 && $au <= 2) && $ne < 100)
            {
                return $this->medio();
            }
            // tab = atv04  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if (($au >= 1 && $au <= 2) && ($ne >= 100 && $ne <= 300))
            {
                return $this->medio();
            }
            // tab = atv04  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if (($au >= 1 && $au <= 2) && ($ne > 300 && $ne < 900))
            {
                return $this->grande();
            }
            // tab = atv04  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if (($au >= 1 && $au <= 2) && ($ne >= 900))
            {
                return $this->excepcional();
            }
            // tab = atv04  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
            if (($au > 2 && $au < 3) && $ne < 100)
            {
                return $this->grande();
            }
            // tab = atv04  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
            if (($au > 2 && $au < 3) && ($ne >= 100 && $ne <= 300))
            {
                return $this->grande();
            }
            // tab = atv04  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
            if (($au > 2 && $au < 3) && ($ne > 300 && $ne < 900))
            {
                return $this->grande();
            }
            // tab = atv04  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
            if (($au > 2 && $au < 3) && ($ne >= 900))
            {
                return $this->excepcional();
            }
            // tab = atv04  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 3) && $ne < 100)
            {
                return $this->excepcional();
            }
            // tab = atv04 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 3) && ($ne >= 100 && $ne <= 300))
            {
                return $this->excepcional();
            }
            // tab = atv04  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 3) && ($ne > 300 && $ne < 900))
            {
               return $this->excepcional();
            }
            // tab = atv04  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 3) && ($ne >= 900))
            {
                return $this->excepcional();
            }
        }
        if ($atvidadecodido == "05" && ($subatividadecodigo >= "0501" && $subatividadecodigo <= "0504"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv05  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 0.2 && $ne < 100)
            {
                return $this->pequeno();

            }
            // tab = atv05  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if ($au < 0.2 && ($ne >= 100 && $ne <= 300))
            {
                return $this->medio();

            }
            // tab = atv05  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if ($au < 0.2 && ($ne > 300 && $ne < 900))
            {
                return $this->grande();

            }
            // tab = atv05  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if ($au < 0.2 && $ne >= 900)
            {
                return $this->excepcional();

            }
            // tab = atv05 ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 0.2 && $au <= 1) && $ne < 100)
            {
                return $this->medio();

            }
            // tab = atv05  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if (($au >= 0.2 && $au <= 1) && ($ne >= 100 && $ne <= 300))
            {
                return $this->medio();

            }
            // tab = atv05  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if (($au >= 0.2 && $au <= 1) && ($ne > 300 && $ne < 900))
            {
                return $this->grande();

            }
            // tab = atv05  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if (($au >= 0.2 && $au <= 1) && ($ne >= 900))
            {
                return $this->excepcional();

            }
            // tab = atv05  ; col = 3 ; lin = 1 // au = 1.1 ate 2.99 ne = 99
            if (($au > 1 && $au < 3) && $ne < 100)
            {
                return $this->grande();

            }
            // tab = atv05  ; col = 3 ; lin = 2 // au = 1.1 ate 2.99 ne = 100 ate 300
            if (($au > 1 && $au < 3) && ($ne >= 100 && $ne <= 300))
            {
                return $this->grande();

            }
            // tab = atv05  ; col = 3 ; lin = 3 // au = 1.1 ate 2.99 ne = 301 ate 899
            if (($au > 1 && $au < 3) && ($ne > 300 && $ne < 900))
            {
                return $this->grande();

            }
            // tab = atv05  ; col = 3 ; lin = 4  // au = 1.1 ate 2.99 ne = 900++
            if (($au > 1 && $au < 3) && ($ne >= 900))
            {
                return $this->excepcional();

            }
            // tab = atv05  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 3) && $ne < 100)
            {
                return $this->excepcional();

            }
            // tab = atv05  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 3) && ($ne >= 100 && $ne <= 300))
            {
                return $this->excepcional();

            }
            // tab = atv05  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 3) && ($ne > 300 && $ne < 900))
            {
                return $this->excepcional();

            }
            // tab = atv05  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 3) && ($ne >= 900))
            {
                return $this->excepcional();

            }
        }
        if ($atvidadecodido == "06" && ($subatividadecodigo >= "0601" && $subatividadecodigo <= "0604"))
        {

            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv06  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 1 && $ne < 100)
            {
                return $this->pequeno();

            }
            // tab = atv06  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 200
            if ($au < 1 && ($ne >= 100 && $ne <= 200))
            {
                return $this->medio();

            }
            // tab = atv06  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 201 ate 499
            if ($au < 1 && ($ne > 200 && $ne < 500))
            {
                return $this->grande();

            }
            // tab = atv06  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 500++
            if ($au < 1 && ($ne >= 500))
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 1 && $au <= 2) && $ne < 100)
            {
                return $this->medio();

            }
            // tab = atv06  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 200
            if (($au >= 1 && $au <= 2) && ($ne >= 100 && $ne <= 200))
            {
                return $this->medio();

            }
            // tab = atv06  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 201 ate 499
            if (($au >= 1 && $au <= 2) && ($ne > 200 && $ne < 500))
            {
                return $this->grande();

            }
            // tab = atv06  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 500++
            if (($au >= 1 && $au <= 2) && ($ne >= 500))
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col = 3 ; lin = 1 // au = 2 ate 4.99 ne = 99
            if (($au > 2 && $au < 5) && $ne < 100)
            {
                return $this->grande();

            }
            // tab = atv06  ; col = 3 ; lin = 2 // au = 2 ate 4.99 ne = 100 ate 300
            if (($au > 2 && $au < 5) && ($ne >= 100 && $ne <= 200))
            {
                return $this->grande();

            }
            // tab = atv06  ; col = 3 ; lin = 3 // au = 2 ate 4.99 ne = 301 ate 499
            if (($au > 2 && $au < 5) && ($ne > 200 && $ne < 500))
            {
                return $this->grande();

            }
            // tab = atv06  ; col = 3 ; lin = 4  // au = 2 ate 4.99 ne = 500++
            if (($au > 2 && $au < 5) && ($ne >= 500))
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 5) && $ne < 100)
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 5) && ($ne >= 100 && $ne <= 200))
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 5) && ($ne > 200 && $ne < 500))
            {
                return $this->excepcional();

            }
            // tab = atv06  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 5) && ($ne >= 500))
            {
                return $this->excepcional();
            }
         }
        if ($atvidadecodido == "08" && ($subatividadecodigo >= "0801" && $subatividadecodigo <= "0802"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if ($au < 0.2 && $ne < 20)                                 {return $this->pequeno();}
            if ($au < 0.2 && ($ne >= 20 && $ne <= 50))                 {return $this->medio();}
            if ($au < 0.2 && ($ne > 50 && $ne < 100))                  {return $this->grande();}
            if ($au < 0.2 && ($ne >= 100))                             {return $this->excepcional();}

            if (($au >= 0.2 && $au < 1 ) && $ne < 20)                  {return $this->medio();}
            if (($au >= 0.2 && $au < 1 ) && ($ne >= 20 && $ne <= 50))  {return $this->medio();}
            if (($au >= 0.2 && $au < 1 ) && ($ne > 50 && $ne < 100))   {return $this->grande();}
            if (($au >= 0.2 && $au < 1 ) && ($ne >= 100))              {return $this->excepcional();}

            if (($au >= 1 && $au <= 3 ) && $ne < 20)                   {return $this->grande();}
            if (($au >= 1 && $au <= 3 ) && ($ne >= 20 && $ne <= 50))   {return $this->grande();}
            if (($au >= 1 && $au <= 3 ) && ($ne > 50 && $ne < 100))    {return $this->grande();}
            if (($au >= 1 && $au <= 3 ) && ($ne >= 100))               {return $this->excepcional();}

            if (($au > 3 ) && $ne < 20)                                {return $this->excepcional();}
            if (($au > 3 ) && ($ne >= 20 && $ne <= 50))                {return $this->excepcional();}
            if (($au > 3 ) && ($ne > 50 && $ne < 100))                 {return $this->excepcional();}
            if (($au > 3 ) && ($ne >= 100))                            {return $this->excepcional();}

        }
        if ($atvidadecodido == "09" && ($subatividadecodigo >= "0901" && $subatividadecodigo <= "0905"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 2) &&  ($ne < 20))                              {return $this->pequeno();}
            if (($au < 2) && ($ne >= 20 && $ne <= 80))                 {return $this->medio();}
            if (($au < 2) && ($ne > 80 && $ne < 300))                  {return $this->grande();}
            if (($au < 2) && ($ne >= 300))                             {return $this->excepcional();}

            if (($au >= 2 &&  $au <= 5) && ($ne < 20))                 {return $this->medio();}
            if (($au >= 2 &&  $au <= 5) && ($ne >= 20 && $ne <= 80))   {return $this->medio();}
            if (($au >= 2 &&  $au <= 5) && ($ne > 80 && $ne < 300))    {return $this->grande();}
            if (($au >= 2 &&  $au <= 5) && ($ne >= 300))               {return $this->excepcional();}

            if (($au > 5  &&  $au < 10) && ($ne < 20))                 {return $this->grande();}
            if (($au > 5  &&  $au < 10) && ($ne >= 20 && $ne <= 80))   {return $this->grande();}
            if (($au > 5  &&  $au < 10) && ($ne > 80 && $ne < 300))    {return $this->grande();}
            if (($au > 5  &&  $au < 10) && ($ne >= 300))               {return $this->excepcional();}

            if (($au >= 10) &&  $ne < 20)                              {return $this->excepcional();}
            if (($au >= 10) && ($ne >= 20 && $ne <= 80))               {return $this->excepcional();}
            if (($au >= 10) && ($ne > 80 && $ne < 300))                {return $this->excepcional();}
            if (($au >= 10) && ($ne >= 300))                           {return $this->excepcional();}

        }
        if ($atvidadecodido == "10" && ($subatividadecodigo >= "1001" && $subatividadecodigo <= "1005"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 1) &&  ($ne < 20))                               {return $this->pequeno();}
            if (($au < 1) &&  ($ne >= 20 && $ne <= 100))                {return $this->medio();}
            if (($au < 1) &&  ($ne > 100 && $ne < 500))                 {return $this->grande();}
            if (($au < 1) &&  ($ne >= 500))                             {return $this->excepcional();}

            if (($au >= 1 && $au <= 2) &&  ($ne < 20))                  {return $this->medio();}
            if (($au >= 1 && $au <= 2) &&  ($ne >= 20 && $ne <= 100))   {return $this->medio();}
            if (($au >= 1 && $au <= 2) &&  ($ne > 100 && $ne < 500))    {return $this->grande();}
            if (($au >= 1 && $au <= 2) &&  ($ne >= 500))                {return $this->excepcional();}

            if (($au > 2  && $au < 5) &&  ($ne < 20))                   {return $this->grande();}
            if (($au > 2  && $au < 5) &&  ($ne >= 20 && $ne <= 100))    {return $this->grande();}
            if (($au > 2  && $au < 5) &&  ($ne > 100 && $ne < 500))     {return $this->grande();}
            if (($au > 2  && $au < 5) &&  ($ne >= 500))                 {return $this->excepcional();}

            if (($au >= 5) &&  ($ne < 20))                              {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 20 && $ne <= 100))               {return $this->excepcional();}
            if (($au >= 5) &&  ($ne > 100 && $ne < 500))                {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 500))                            {return $this->excepcional();}

        }
        if ($atvidadecodido == "11" && ($subatividadecodigo >= "1101" && $subatividadecodigo <= "1102"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 0.5) &&  ($ne < 20))                              {return $this->pequeno();}
            if (($au < 0.5) &&  ($ne >= 20 && $ne <= 50))                {return $this->medio();}
            if (($au < 0.5) &&  ($ne > 50 && $ne < 300))                 {return $this->grande();}
            if (($au < 0.5) &&  ($ne >= 300))                            {return $this->excepcional();}

            if (($au >= 0.5 && $au <=1) &&  ($ne < 20))                  {return $this->medio();}
            if (($au >= 0.5 && $au <=1) &&  ($ne >= 20 && $ne <= 50))    {return $this->medio();}
            if (($au >= 0.5 && $au <=1) &&  ($ne > 50 && $ne < 300))     {return $this->grande();}
            if (($au >= 0.5 && $au <=1) &&  ($ne >= 300))                {return $this->excepcional();}

            if (($au > 1 && $au < 3) &&  ($ne < 20))                     {return $this->grande();}
            if (($au > 1 && $au < 3) &&  ($ne >= 20 && $ne <= 50))       {return $this->grande();}
            if (($au > 1 && $au < 3) &&  ($ne > 50 && $ne < 300))        {return $this->grande();}
            if (($au > 1 && $au < 3) &&  ($ne >= 300))                   {return $this->excepcional();}

            if (($au >= 3) &&  ($ne < 20))                               {return $this->excepcional();}
            if (($au >= 3) &&  ($ne >= 20 && $ne <= 50))                 {return $this->excepcional();}
            if (($au >= 3) &&  ($ne > 50 && $ne < 300))                  {return $this->excepcional();}
            if (($au >= 3) &&  ($ne >= 300))                             {return $this->excepcional();}

        }
        if ($atvidadecodido == "12" && ($subatividadecodigo >= "1201" && $subatividadecodigo <= "1220"))
        {

            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 1) &&  ($ne < 30))                               {return $this->pequeno();}
            if (($au < 1) &&  ($ne >= 30 && $ne <= 100))                {return $this->medio();}
            if (($au < 1) &&  ($ne > 100 && $ne < 500))                 {return $this->grande();}
            if (($au < 1) &&  ($ne >= 500))                             {return $this->excepcional();}

            if (($au >= 1 && $au <= 2) &&  ($ne < 30))                  {return $this->medio();}
            if (($au >= 1 && $au <= 2) &&  ($ne >= 30 && $ne <= 100))   {return $this->medio();}
            if (($au >= 1 && $au <= 2) &&  ($ne > 100 && $ne < 500))    {return $this->grande();}
            if (($au >= 1 && $au <= 2) &&  ($ne >= 500))                {return $this->excepcional();}

            if (($au > 2 && $au < 5) &&  ($ne < 30))                    {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 30 && $ne <= 100))     {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne > 100 && $ne < 500))      {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 500))                  {return $this->excepcional();}

            if (($au >= 5) &&  ($ne < 30))                              {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 30 && $ne <= 100))               {return $this->excepcional();}
            if (($au >= 5) &&  ($ne > 100 && $ne < 500))                {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 500))                            {return $this->excepcional();}

        }
        if ($atvidadecodido == "12" && ($subatividadecodigo >= "1221" && $subatividadecodigo <= "1225"))
        {

            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 2) &&  ($ne < 30))                                {return $this->pequeno();}
            if (($au < 2) &&  ($ne >= 30 && $ne <= 100))                 {return $this->medio();}
            if (($au < 2) &&  ($ne > 100 && $ne < 500))                  {return $this->grande();}
            if (($au < 2) &&  ($ne >= 500))                              {return $this->excepcional();}

            if (($au >= 2 && $au <= 5) &&  ($ne < 30))                   {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 30 && $ne <= 100))    {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne > 100 && $ne < 500))     {return $this->grande();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 500))                 {return $this->excepcional();}

            if (($au > 5 && $au < 10) &&  ($ne < 30))                    {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 30 && $ne <= 100))     {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne > 100 && $ne < 500))      {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 500))                  {return $this->excepcional();}

            if (($au >= 10) &&  ($ne < 30))                              {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 30 && $ne <= 100))               {return $this->excepcional();}
            if (($au >= 10) &&  ($ne > 100 && $ne < 500))                {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 500))                            {return $this->excepcional();}

        }
        if ($atvidadecodido == "13" && ($subatividadecodigo >= "1301" && $subatividadecodigo <= "1303"))
        {

            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 0.5) &&  ($ne < 30))                                 {return $this->pequeno();}
            if (($au < 0.5) &&  ($ne >= 30 && $ne <= 100))                  {return $this->medio();}
            if (($au < 0.5) &&  ($ne > 100 && $ne < 500))                   {return $this->grande();}
            if (($au < 0.5) &&  ($ne >= 500))                               {return $this->excepcional();}

            if (($au >= 0.5 && $au <= 2) &&  ($ne < 30))                    {return $this->medio();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne >= 30 && $ne <= 100))     {return $this->medio();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne > 100 && $ne < 500))      {return $this->grande();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne >= 500))                  {return $this->excepcional();}

            if (($au > 2 && $au < 5) &&  ($ne < 30))                        {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 30 && $ne <= 100))         {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne > 100 && $ne < 500))          {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 500))                      {return $this->excepcional();}

            if (($au >= 5) &&  ($ne < 30))                                  {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 30 && $ne <= 100))                   {return $this->excepcional();}
            if (($au >= 5) &&  ($ne > 100 && $ne < 500))                    {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 500))                                {return $this->excepcional();}

        }
        if ($atvidadecodido == "14" && ($subatividadecodigo >= "1401" && $subatividadecodigo <= "1403"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 0.5) &&  ($ne < 20))                                 {return $this->pequeno();}
            if (($au < 0.5) &&  ($ne >= 20 && $ne <= 80))                   {return $this->medio();}
            if (($au < 0.5) &&  ($ne > 80 && $ne < 400))                    {return $this->grande();}
            if (($au < 0.5) &&  ($ne >= 400))                               {return $this->excepcional();}

            if (($au >= 0.5 && $au <= 2) &&  ($ne < 20))                    {return $this->medio();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne >= 20 && $ne <= 80))      {return $this->medio();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne > 80 && $ne < 400))       {return $this->grande();}
            if (($au >= 0.5 && $au <= 2) &&  ($ne >= 400))                  {return $this->excepcional();}

            if (($au > 2 && $au < 5) &&  ($ne < 20))                        {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 20 && $ne <= 80))          {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne > 80 && $ne < 400))           {return $this->grande();}
            if (($au > 2 && $au < 5) &&  ($ne >= 400))                      {return $this->excepcional();}

            if (($au >= 5) &&  ($ne < 20))                                  {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 20 && $ne <= 80))                    {return $this->excepcional();}
            if (($au >= 5) &&  ($ne > 80 && $ne < 400))                     {return $this->excepcional();}
            if (($au >= 5) &&  ($ne >= 400))                                {return $this->excepcional();}
        }
        if ($atvidadecodido == "15" && ($subatividadecodigo >= "1501" && $subatividadecodigo <= "1508"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 1) &&  ($ne < 100))                                  {return $this->pequeno();}
            if (($au < 1) &&  ($ne >= 100 && $ne <= 300))                   {return $this->medio();}
            if (($au < 1) &&  ($ne > 300 && $ne < 900))                     {return $this->grande();}
            if (($au < 1) &&  ($ne >= 900))                                 {return $this->excepcional();}

            if (($au >= 1 && $au <= 3) &&  ($ne < 100))                     {return $this->medio();}
            if (($au >= 1 && $au <= 3) &&  ($ne >= 100 && $ne <= 300))      {return $this->medio();}
            if (($au >= 1 && $au <= 3) &&  ($ne > 300 && $ne < 900))        {return $this->grande();}
            if (($au >= 1 && $au <= 3) &&  ($ne >= 900))                    {return $this->excepcional();}

            if (($au > 3 && $au < 10) &&  ($ne < 100))                      {return $this->grande();}
            if (($au > 3 && $au < 10) &&  ($ne >= 100 && $ne <= 300))       {return $this->grande();}
            if (($au > 3 && $au < 10) &&  ($ne > 300 && $ne < 900))         {return $this->grande();}
            if (($au > 3 && $au < 10) &&  ($ne >= 900))                     {return $this->excepcional();}

            if (($au >= 10) &&  ($ne < 100))                                {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 100 && $ne <= 300))                 {return $this->excepcional();}
            if (($au >= 10) &&  ($ne > 300 && $ne < 900))                   {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 900))                               {return $this->excepcional();}
        }
        if ($atvidadecodido == "16" && ($subatividadecodigo >= "1601" && $subatividadecodigo <= "1607"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 2) &&  ($ne < 30))                                   {return $this->pequeno();}
            if (($au < 2) &&  ($ne >= 30 && $ne <= 100))                    {return $this->medio();}
            if (($au < 2) &&  ($ne > 100 && $ne < 500))                     {return $this->grande();}
            if (($au < 2) &&  ($ne >= 500))                                 {return $this->excepcional();}

            if (($au >= 2 && $au <= 5) &&  ($ne < 30))                      {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 30 && $ne <= 100))       {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne > 100 && $ne < 500))        {return $this->grande();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 500))                    {return $this->excepcional();}

            if (($au > 5 && $au < 10) &&  ($ne < 30))                       {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 30 && $ne <= 100))        {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne > 100 && $ne < 500))         {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 500))                     {return $this->excepcional();}

            if (($au >= 10) &&  ($ne < 30))                                 {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 30 && $ne <= 100))                  {return $this->excepcional();}
            if (($au >= 10) &&  ($ne > 100 && $ne < 500))                   {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 500))                               {return $this->excepcional();}
        }
        if ($atvidadecodido == "17" && ($subatividadecodigo >= "1701" && $subatividadecodigo <= "1703"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");

            if (($au < 2) &&  ($ne < 30))                                   {return $this->pequeno();}
            if (($au < 2) &&  ($ne >= 30 && $ne <= 100))                    {return $this->medio();}
            if (($au < 2) &&  ($ne > 100 && $ne < 500))                     {return $this->grande();}
            if (($au < 2) &&  ($ne >= 500))                                 {return $this->excepcional();}

            if (($au >= 2 && $au <= 5) &&  ($ne < 30))                      {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 30 && $ne <= 100))       {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne > 100 && $ne < 500))        {return $this->grande();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 500))                    {return $this->excepcional();}

            if (($au > 5 && $au < 10) &&  ($ne < 30))                       {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 30 && $ne <= 100))        {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne > 100 && $ne < 500))         {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 500))                     {return $this->excepcional();}

            if (($au >= 10) &&  ($ne < 30))                                 {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 30 && $ne <= 100))                  {return $this->excepcional();}
            if (($au >= 10) &&  ($ne > 100 && $ne < 500))                   {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 500))                               {return $this->excepcional();}
        }
        if ($atvidadecodido == "18" && ($subatividadecodigo >= "1801" && $subatividadecodigo <= "1801"))
        {
            $au = Input::get("areaultiu");
            $nc = Input::get("numerodeempregados");

            if (($au < 2) &&  ($ne < 30))                                   {return $this->pequeno();}
            if (($au < 2) &&  ($ne >= 30 && $ne <= 100))                    {return $this->medio();}
            if (($au < 2) &&  ($ne > 100 && $ne < 500))                     {return $this->grande();}
            if (($au < 2) &&  ($ne >= 500))                                 {return $this->excepcional();}

            if (($au >= 2 && $au <= 5) &&  ($ne < 30))                      {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 30 && $ne <= 100))       {return $this->medio();}
            if (($au >= 2 && $au <= 5) &&  ($ne > 100 && $ne < 500))        {return $this->grande();}
            if (($au >= 2 && $au <= 5) &&  ($ne >= 500))                    {return $this->excepcional();}

            if (($au > 5 && $au < 10) &&  ($ne < 30))                       {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 30 && $ne <= 100))        {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne > 100 && $ne < 500))         {return $this->grande();}
            if (($au > 5 && $au < 10) &&  ($ne >= 500))                     {return $this->excepcional();}

            if (($au >= 10) &&  ($ne < 30))                                 {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 30 && $ne <= 100))                  {return $this->excepcional();}
            if (($au >= 10) &&  ($ne > 100 && $ne < 500))                   {return $this->excepcional();}
            if (($au >= 10) &&  ($ne >= 500))                               {return $this->excepcional();}
        }

    }
    /*|-------------------------------------------------------------------------- */
}