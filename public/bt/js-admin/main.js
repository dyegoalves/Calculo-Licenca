 $(document).ready(function () {
	 
 	 $(".ts-sidebar-menu li a").each(function () {
 		if ($(this).next().length > 0) {
 			$(this).addClass("parent");
 		};
 	})

 	 var menux = $('.ts-sidebar-menu li a.parent');
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

    /* $("#input-43").fileinput({
		showPreview: false,
		allowedFileExtensions: ["jpeg", "png", "jpg", "gif"],
		elErrorContainer: "#errorBlock43"
			// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
	 });*/

     $("#Abreviatura").click(function(){
         $('#alerta-abrev').remove();
     });

     var tempomsgatvsub = 'slow' ;
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
         $.get('/listarsubatividade/' + idatividade.val() , function(subatividade){

             $('select[name = subatividade]').empty();
             $('select[name = subatividade]').append('<option value= " ">Escolha a Subatividade</option>');

             $.each( subatividade , function(key, value){
                 $('select[name = subatividade]').append('<option value='+value.id +'>'+value.descricao +'</option>');
             });
         });
     });
     // input CPNJ e CPF com Radio
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
     // input CPNJ e CPF com Radio
     $("input[type='radio'][name='escolhatipo']").change(function(){
         var tipopessoavalor = $("input[type='radio'][name='escolhatipo']:checked").val();
         if(tipopessoavalor  == 1 ){
             //Tipo juridica
             window.location.href = "/pessoajuridica";
         }

         if(tipopessoavalor  == 2 ){
             //Tipo fisica
             window.location.href = "/pessoafisica";
         }

     });
     //Trocar de nomes do inputs de acordo com a atividades

  });

