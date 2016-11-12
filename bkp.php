<?php
 //Geradores aletorios
 function palavra(){

	 $vogais = array('a','e','i','o','u');
	 $consoantes = array('b','c','d','f','g','h','nh','lh','ch','j','k','l','m','n','p','qu','r','rr','s','ss','t','v','w','x','y','z',);

	 $palavra = '';
	 $tamanho_palavra = rand(2,5);
	 $contar_silabas = 0;
	 while($contar_silabas < $tamanho_palavra){
		 $vogal = $vogais[rand(0,count($vogais)-1)];
		 $consoante = $consoantes[rand(0,count($consoantes)-1)];
		 $silaba = $consoante.$vogal;
		 $palavra .=$silaba;
		 $contar_silabas++;
		 unset($vogal,$consoante,$silaba);
	 }
	 return $palavra;
	 // unset($vogais,$consoantes,$palavra,$tamanho_palavra,$contar_silabas);

 }
 function gerarCNPJ()
 {
	 return substr(str_shuffle(str_repeat('0123456789',5)),0,14);
 }
 function gerarProceso()
 {
	 return substr(str_shuffle(str_repeat('0123456789',5)),0,14);
 }
 function gerarData()
 {
	 $data = date('Y-m-d h:m:s');

	 return $data;
 }

/*
 * Wiew Blade
 * @for($i = 0 ; $i < 100 ; $i ++)
                    <tr id="trprocesso" role="row" class="even">
                      <td>{{ palavra()}}</td>
                      <td>{{ gerarCNPJ() }}</td>
                      <td>{{ gerarProceso()}}</td>
                      <td>{{ gerarData() }}</td>
                      <td>{{ 'Situacao' . rand( $i , 100) }}</td>
                      <td><button class="btn btn-primary btn-xs" type="submit">Editar</button>  <button class="btn btn-danger btn-xs" type="submit">Deletar</button>  </td>
                    </tr>
	@endfor*/

?>
