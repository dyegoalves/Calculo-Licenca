<?php

namespace App\Http\Controllers;

use App\Atividade;
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

       /*
       //Pegar os valores do arquivo local .env
       $env = file_get_contents("../.env");
       $linha = explode("\n", $env);
       for($i = 0 ; $i <  count($linha) ; $i++)
       {
           list($variavel, $valor) = explode('=' , $linha[$i]);
           $dadosarray[$variavel] = $valor;
       }
       json_encode($dadosarray);
       */

       exec("cd .. && php artisan migrate");

       //Exporta os dados de Usuarios Cadastrados
       exec("mysql {$database} -u{$username} -p{$password} < sqls/users.sql");
       //Criar as Tabelas do projeto calculo-licenca
       exec("mysql {$database} -u{$username} -p{$password} < sqls/newbancoipaam.sql");

       /*//deletar todas as tabelas do banco
        exec("mysql ". env('DB_DATABASE')." -u ".env('DB_USERNAME') ." -p".env('DB_PASSWORD')." < sqls/droptables.sql");

       /* //Criar a migrate do User
       exec("cd .. && php artisan migrate");
       //Exporta os dados de Usuarios Cadastrados
       exec("mysql ". env('DB_DATABASE')." -u".env('DB_USERNAME')." -p".env('DB_PASSWORD')." < sqls/users.sql");
       //Criar as Tabelas do projeto calculo-licenca
       exec("mysql ". env('DB_DATABASE')." -u".env('DB_USERNAME')." -p".env('DB_PASSWORD')." < sqls/newbancoipaam.sql");*/
    }
    //criar atividades  - sem chaves estrangeiras
    public function criarativiades()
    {
        $atividade = new Atividade ;
        $arquivo = "atividades.txt";
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
                'codigo' => $dados['codigos'], 'descricao' => $dados['codigos'].' - '.$dados['descricao']
            ]);

        }

    }
    //Criar portes - sem chaves estrangeiras
    public function criarportes(){
        $porte = new Porte;
        $porte->create(['tamanho' => "MICRO"]);
        $porte->create(['tamanho' => "PEQUENO"]);
        $porte->create(['tamanho' => "MEDIO"]);
        $porte->create(['tamanho' => "GRANDE"]);
        $porte->create(['tamanho' => "EXCEPCIONAL"]);
    }

    //Criar ppds - com chaves strangeiras
    public function criarppds(){

        function nivel ($porte_id){
            $ppd = new Ppd;
            $ppd->create(['nivel' => 'P' , 'portes_id' => intval($porte_id)]);
            $ppd->create(['nivel' => 'M' , 'portes_id' => intval($porte_id)]);
            $ppd->create(['nivel' => 'G' , 'portes_id' => intval($porte_id)]);
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
    }
    //Criar tipoprecos - com chaves estrangeiras
    public function criartipoprecos()
    {
        $tipopreco = new Tipopreco;
        $arquivo = "tipopreco.txt";
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
                'precoLP' => $dados['precoLP'],
                'precoLI' => $dados['precoLI'],
                'precoLO' => $dados['precoLO'],
                'ppds_id' => intval($idx+1),
            ]);
        }
    }
    //criar subatividade - com chaves estrangeiras
    public function criarsubatividades()
    {
        $subatividade = new Subatividade;
        $ppd_id = 1 ;
        $arquivo = "subatividades.txt";
        $fhandler = fopen($arquivo, "r")
        or die("Erro ao abrir arquivo");
        $fstring = fread($fhandler, filesize($arquivo));
        $linha_array = explode("\n", $fstring);
        fclose($fhandler);

        for ($idx = 0; $idx < count($linha_array); $idx++) {
            $linha = $linha_array[$idx];
            list($codigo, $decricao) = explode('–',$linha);

            $dados =[
                'codigos' => $codigo, 'descricao'=> $decricao
            ];

            $atividades_id = ($codigo[0].$codigo[1]);
            $atividades_id = DB::table('atividades')->where('codigo', $atividades_id)->first();

            $subatividade->create([
                'codigo' => $dados['codigos'],
                'descricao' => $dados['codigos'].' - '.$dados['descricao'],
                'atividades_id' => intval($atividades_id->id),
                'ppd_id' => intval($ppd_id)
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

}
