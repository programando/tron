
//Menu fijo


    $(window).scroll(function(){

       if($(this).scrollTop() > 100 ){

          $('header').addClass('header2');
         	$('.header2').css("display", "block");

       } else {

          $('header').removeClass('header2');
         	$('.header2').css("display", "none");
       }

    });




// funcion de login => restaurar contraseña
   $('#olvide-password').click(function(){
     $('.formulario-olvide-password').slideDown('slow');
     $('.contenido-login').slideUp('slow');
     $('.header-login').html('Recuperar Contraseña');
   });

   // BARRA DE BUSQUEDA

$('.btn-buscar').on('click',function(){
      var $texto_busqueda = $('.input-buscar').val();
      var $tipo_busqueda  = $('input:radio[name=tipobusqueda]:checked').val();
      var $pagina        =  $('body');
      var Parametros     = {"texto_busqueda": $texto_busqueda,"tipo_busqueda":$tipo_busqueda };
      if ($texto_busqueda.length>0)
      {
        $.ajax({
            data:  Parametros,
            dataType: 'html',
            url:      '/tron/productos/Busqueda_General/',
            type:     'post',
             success:  function (resultado)
               {
                 $pagina.html('');
                 $pagina.html(resultado);
               }
              });
      }

});







