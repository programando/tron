// Validacion = Contraseña para editar info-personal ventana-modal ( 1 )

$('#validar').on('click',function(){

      var $contrasena = $('#contrasena').val(); // Contraseña

      if($contrasena == 0){
      	  $('.cont-mensj-validacion').fadeIn()
      	  $('#contrasena').focus();
      	  return false
      }else{
      	  $('.cont-mensj-validacion').fadeOut()
      }
});


// Validacion = Cambio de contraseña - ventana modal ( 2 )

$('#guardar-contrasena').on('click',function(){

					var $Contrasena_anterior    = $('#contrasena-anterior').val();   // contraseña Anterior
					var $new_contrasena         = $('#new-contrasena').val();        // Contraseña nueva
					var $repetir_new_contrasena = $('#repetir-new-contrasena').val(); // Confirmar Contraseña Nueva

     if($Contrasena_anterior == 0){ //..................  contraseña Anterior
         $('.msj-valida-conta-anterior').fadeIn();
         $('#contrasena-anterior').focus();
         return false ;
     }else{
         $('.msj-valida-conta-anterior').fadeOut();
     }

     if($new_contrasena == 0){ //..................  Contraseña nueva
         $('.msj-valida-new-contrasena').fadeIn();
         $('#new-contrasena').focus();
         return false ;
     }else{
         $('.msj-valida-new-contrasena').fadeOut();
     }

     if($new_contrasena !== $repetir_new_contrasena){ //.......... confirmacion de contraseñas
     	  $('.msj-valida-no-contrasena').fadeIn();
     	  $('#new-contrasena').focus();
     	  $('#new-contrasena').val('');
     	  $('#repetir-new-contrasena').val('');
     	  return false;
     }else{
     	  $('.msj-valida-no-contrasena').fadeOut();
     }

});
