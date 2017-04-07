// funcion de login => restaurar contraseña
   $('#olvide-password').click(function(){
     $('.formulario-olvide-password').slideDown('slow');
     $('.contenido-login').slideUp('slow');
     $('.header-login').html('<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="login-fom-btn-x">&times;</span></button><br>Recuperar Contraseña<br><br>');
   });

   // BARRA DE BUSQUEDA
var Realizar_Busqueda = function (Parametros){
    var $pagina        =  $('body');
    $.ajax({
      data:  Parametros,
      dataType: 'html',
      url:      '/productos/Busqueda_General',
      type:     'get',
       success:  function (resultado)
         {
           $pagina.html('');
           $pagina.html(resultado);
         }
        });
}


$('.btn-buscar').on('click',function(){
      var $texto_busqueda = $('.input-buscar').val();
      var $tipo_busqueda  = '' // $('input:radio[name=tipobusqueda]:checked').val();
      var Parametros     = {"texto_busqueda": $texto_busqueda,"tipo_busqueda":$tipo_busqueda };
      if ($texto_busqueda.length>0)  {
          Realizar_Busqueda(Parametros);
      }

});
$('#texto-busqueda').on('keypress',function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
     if(keycode == '13') {
     var $texto_busqueda = $('.input-buscar').val();
      var $tipo_busqueda  = ''
      var Parametros     = {"texto_busqueda": $texto_busqueda,"tipo_busqueda":$tipo_busqueda };
      if ($texto_busqueda.length>0)  {
          Realizar_Busqueda(Parametros);
      }
    }
});







