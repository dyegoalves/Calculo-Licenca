<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Calculo;
use App\Empreendimento;
use App\User;
use App\Empresa;
use App\Porte;
use App\Ppd;
use App\Processo;
use App\Subatividade;
use App\Tipopreco;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use PDO;
use Schema;

class FerramentasController extends Controller
{
    //Criar dados criarbancoedados
    public function instalarbancodedados()
    {
        $this->comandocriarbanco();
        $this->criarativiades();
        $this->criarportes();
        $this->criarppds();
        $this->criartipoprecos();
        $this->criarsubatividades();
        $array  = "A estrutura do Banco e seus dados foram criado com sucesso";
        return Response::json($array);
    }
    //Comando no Banco de dados
    public function comandocriarbanco()
    {
       $database = env("DB_DATABASE");
       $username = env("DB_USERNAME");
       $password = env("DB_PASSWORD");

       exec("cd .. && php artisan migrate");
       //Exporta os dados de Usuarios Cadastrados
       exec("mysql {$database} -u{$username} -p{$password} < sqls/users.sql");

    }
    //criar atividades  - sem chaves estrangeiras
    public function criarativiades()
    {
        $atividade = new Atividade ;
        $arquivo = "dados/atividades.txt";
        $fhandler = fopen($arquivo, "r")
        or die("Erro ao abrir arquivo");
        $fstring = fread($fhandler, filesize($arquivo));
        $linha_array = explode("\n", $fstring);
        fclose($fhandler);

        for ($idx = 0; $idx < count($linha_array); $idx++) {
            $linha = $linha_array[$idx];
            list($codigo,$decricao) = explode('-',$linha);

            $dados =['codigos' => $codigo,'descricao'=> $decricao];

            $atividade->create([
                'codigo' => $dados['codigos'],
                'descricao' => $dados['codigos'].' - '.$dados['descricao']
            ]);
        }

        return Response::json("Atividades cadastradas com sucesso");

    }
    //Criar portes - sem chaves estrangeiras
    public function criarportes(){
        $porte = new Porte;
        $porte->create(['tamanho' => "MICRO"]);
        $porte->create(['tamanho' => "PEQUENO"]);
        $porte->create(['tamanho' => "MEDIO"]);
        $porte->create(['tamanho' => "GRANDE"]);
        $porte->create(['tamanho' => "EXCEPCIONAL"]);

        return Response::json("Portes cadastrados com sucesso");

    }
    //Criar ppds - com chaves strangeiras
    public function criarppds(){

        function nivel ($porte_id){
            $ppd = new Ppd;
            $ppd->create(['nivel' => 'PEQUENO' ,  'porte_id' => intval($porte_id)]);
            $ppd->create(['nivel' => 'MEDIO'   ,  'porte_id' =>   intval($porte_id)]);
            $ppd->create(['nivel' => 'GRANDE'  ,  'porte_id' =>  intval($porte_id)]);
        }
        $porte_id = 1;
        nivel($porte_id);
        $porte_id = 2;
        nivel($porte_id);
        $porte_id = 3;
        nivel($porte_id);
        $porte_id = 4;
        nivel($porte_id);
        $porte_id = 5;
        nivel($porte_id);

        return Response::json("ppdS cadastrados com sucesso");
    }
    //Criar tipoprecos - com chaves estrangeiras
    public function criartipoprecos()
    {
        $tipopreco = new Tipopreco;
        $arquivo = "dados/tipopreco.txt";
        $fhandler = fopen($arquivo, "r")
        or die("Erro ao abrir arquivo");
        $fstring = fread($fhandler, filesize($arquivo));
        $linha_array = explode("\n", $fstring);
        fclose($fhandler);

        for ($idx = 0; $idx < count($linha_array); $idx++) {
            $linha = $linha_array[$idx];
            list($precoLP,$precoLI,$precoLO) = explode('::',$linha);

            $dados=[
                     'precoLP' => $precoLP,
                     'precoLI' => $precoLI,
                     'precoLO' => $precoLO,
            ];

            $tipopreco->create([
                'LP' => $dados['precoLP'],
                'LI' => $dados['precoLI'],
                'LO' => $dados['precoLO'],
                'ppd_id' => intval($idx+1),
            ]);
        }
        return Response::json("tipo preco cadastrados com sucesso");
    }
    //criar subatividade - com chaves estrangeiras
    public function criarsubatividades()
    {
        $subatividade = new Subatividade;

        $arquivo = "dados/subatividades.txt";
        $fhandler = fopen($arquivo, "r")
        or die("Erro ao abrir arquivo");
        $fstring = fread($fhandler, filesize($arquivo));
        $linha_array = explode("\n", $fstring);
        fclose($fhandler);

        for ($idx = 0; $idx < count($linha_array); $idx++) {
            $linha = $linha_array[$idx];

            list($codigo, $decricao , $ppd_id) = explode(' – ',$linha);

            $dados =[
                'codigo' => $codigo, 'descricao'=> $decricao , 'ppd_id' => $ppd_id
            ];

            //Relacao do campo codigo subatividade com codigo da ativiadade.
            $atividade_codigo_relacao = ($codigo[0].$codigo[1]);
            $atividade_id = DB::table('atividades')
                                ->where('codigo', $atividade_codigo_relacao)
                                ->first();

            $subatividade->create([
                'codigo' => $dados['codigo'],
                'descricao' => $dados['codigo'].' - '.$dados['descricao'],
                'atividade_id' => intval($atividade_id->id),
                'ppd_id' => intval($dados['ppd_id'])
            ]);

        }
    }
    //Mostrar dados dos models
    public function showdadosmodels($model){

        //Todos o dados da tabela PPDS
        if($model == 'Ppds'){
            return Response::json(Ppd::all());
        }
        //Todos o dados da tabela Portes
        if($model == 'Portes'){
            return Response::json(Porte::all());
        }
        //Todos o dados da tabela Atividades
        if($model == 'Atividades'){
            return Response::json(Atividade::all());
        }
        //Todos o dados da tabela Tipoprecos
        if($model == 'Tipoprecos'){
            return Response::json(Tipopreco::all());
        }
        //Todos o dados da tabela Subatividades
        if($model == 'Subatividade'){
            return Response::json(Subatividade::all());
        }
    }

    public function cad()
    {


    }

    public function showdados()
    {

        //Empreendimento
        $empreendimento = Empreendimento::find(1);

        //Empresa dados
        $empresa =  $empreendimento->empresa;

        //Dados sobre porte do Empreendimento
        $porte = $empreendimento->porte;

        //Dados sobre Atividades do Empreendimento
        $atividade = $empreendimento->atividade;

        //Dados sobre Subatividade do Empreendimento
        $subatividade = $empreendimento->subatividade;

        //Nivel do PPD da subatividade
        $ppd_nivel = $subatividade->ppd->nivel;

        //Busca porte ppd pelo nivel
        $porteppd =  $porte->ppd()->where('nivel', $ppd_nivel)->get();;

        $ppd  = Ppd::find($porteppd[0]->id);

        $tipopreco =  $ppd->tipopreco;


        dd($empresa , $atividade , $subatividade , $porte,  $porteppd , $tipopreco );

        // return Response::json($empresa->processo);
        //$processo  = $empresa->processo()->getQuery()->get(['id', 'numero' , 'empresa_id']);
        //$calculo   = $empresa->calculo()->getQuery()->get(['id', 'valor' , 'empresa_id']);
        //$empresa   = Empresa::with('processo','calculo')->get();
        //$columns   = Schema::getColumnListing('calculos'); // users table
        //dd($columns); // dump the result and die

    }

}
