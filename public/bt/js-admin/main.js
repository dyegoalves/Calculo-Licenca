 $(document).ready(function () {
     var menux = $('.ts-sidebar-menu li a.parent');
 	 $(".ts-sidebar-menu li a").each(function () {
 		if ($(this).next().length > 0) {
 			$(this).addClass("parent");
 		};
 	})
     var tempomsgatvsub = 'slow' ;
 	 $('<div class="more"><i class="fa fa-angle-down"></i></div>').insertBefore(menux);
     $('.more').click(function () {
        $("#inicio").removeClass('open');
        $(this).parent('li').toggleClass('open');
 	});
     $('.parent').click(function (e) {
		e.preventDefault();
 		$(this).parent('li').toggleClass('open');
 	});
     $('.menu-btn').click(function () {
 		$('nav.ts-sidebar').toggleClass('menu-open');
 	});
     $('#zctb').DataTable();
     $("#input-43").fileinput({
		showPreview: false,
		allowedFileExtensions: ["jpeg", "png", "jpg", "gif"],
		elErrorContainer: "#errorBlock43"
			// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
	 });
     $("#Abreviatura").click(function(){
         $('#alerta-abrev').remove();
     });
     $("#atv_codigo").click(function(){
        $('#atv_msgsucess').fadeOut(tempomsgatvsub , function(){
            $(this).remove();
        });
    });
     $("#atv_codigo").click(function(){
        $('#atv_msgerro').fadeOut(tempomsgatvsub, function(){
            $(this).remove();
        });
     });
     $("#subatv_codigo").click(function(){
         $('#msgsub').fadeOut( tempomsgatvsub,  function(){
             $(this).remove();
         });
     });
     $("#subatv_codigo").click(function(){
         $('#msgsuberro').fadeOut( tempomsgatvsub, function(){
             $(this).remove();
         });
     });
     //Requisicao Ajax de subatividades:
     $('select[name = atividade]').change( function (){
         var idatividade = $(this);
         if (idatividade.val() == " ") {
             $('input[name = subatividade]').empty();
         }
         $('select[name = subatividade]').empty();
         $.get('/listarsubatividade/' + idatividade.val() , function(subatividade){

             $('select[name = subatividade]').empty();
             $('select[name = subatividade]').append('<option value= " ">Escolha a Subatividade</option>');

             $.each( subatividade , function(key, value){
                 $('select[name = subatividade]').append('<option value='+value.id +'>'+value.descricao +'</option>');
             });
         });
     });
     // Acao do butao para atualizar as subatividades relacionada com a Atividade correspondente.
     $('button[name = atualizarsub]').click( function (){
         var idatividade =  $('select[name = atividade]');

         if (idatividade.val() == " ") {
              alert("Preencha a Atividade primeiramente para atualizar")
             $('select[name = subatividade]').empty();
         }

         $.get('/listarsubatividade/' + idatividade.val() , function(subatividade){

             $('select[name = subatividade]').empty();
             $('select[name = subatividade]').append('<option value= " ">Escolha a Subatividade</option>');

             $.each( subatividade , function(key, value){
                 $('select[name = subatividade]').append('<option value='+value.id +'>'+value.descricao +'</option>');
             });
         });
     });
      //Tipo preco
     $('select[name = "tipopreco"]').change( function (){
         $('input[name = "portedaempresa"]').prop('readonly', false).val(" ").prop('readonly', true);
         $('input[name = "ppd"]').prop('readonly', false).val(" ").prop('readonly', true);
         $('input[name = "valordalicenca"]').prop('readonly', false).val(" ").prop('readonly', true);

     });
     //Funcao pra deletar a sessionStorage local
     function dSecion(name){
         sessionStorage.removeItem(name);
     }
     //Trocar a label de algumas ativiadades 1801 , 1803
     $('select[name = subatividade]').change( function (){
         var subatividadeselecionada = $("select[name = subatividade] option:selected");
         var conteudo = subatividadeselecionada.text();
         if(conteudo.substr(0,4) == 1801)
         {
             // Salva dados na sessão
             var c1801 = sessionStorage.setItem("comportamento1801", "1801");
             $("label[name = basedecalculo02] ").text('Numero de Cabeças');
         }
         else
         {
             dSecion("comportamento1801");
             $("label[name = basedecalculo02] ").text('Numero de Empregados');
         }

         if(conteudo.substr(0,4) == 1803){
             var c1803 = sessionStorage.setItem("comportamento1803", "1803");
             $("label[name = basedecalculo01] ").text('Numero de Animais');
             $("div[name = basedecalculo02] ").removeAttr("style").hide();

         }else
         {
             dSecion("comportamento1803");
             $("label[name = basedecalculo01]").text('Área Útil em ha (hectare)');
             $("div[name = basedecalculo02]").show();
         }


     });
     //Caso ainda exista o comportamento1801 na pagina depois do submit da mesma.
     if( c1801 = sessionStorage.getItem('comportamento1801') == "1801")
     {
         $("label[name = basedecalculo02] ").text('Numero de Cabeças');
     }
     //Caso ainda exista o comportamento1801 na pagina depois do submit da mesma.
     if( c1803 = sessionStorage.getItem('comportamento1803') == "1803")
     {
         $("label[name = basedecalculo01] ").text('Numero de Animais: ');
         $("div[name = basedecalculo02] ").removeAttr("style").hide();
     }

     $('button[name=consultarprocesso]').click(function(){
            $('form[name=formconsultar] :input select option').prop('readonly', true);
            $("select").prop('disabled', true);
     })

     //$("form[name=formconsultar] select").prop('disabled', true);

     $('form[name=formconsultar] :input').prop('readonly', true);

     $('form[name=formconsultar] input[name=num_processo]').prop('readonly', false);

     $('#maskZone').show();

 });