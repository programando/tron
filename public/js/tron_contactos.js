
var $btn_cancelar   = $('#btn_cancelar');
var $btn_enviar     = $('#btn_enviar');
var $nombre_usuario = $('#nombre_usuario');
var $email          = $('#email');
var $telefono       = $('#telefono');
var $comentarios    = $('#comentarios');

var Enviar_Correo_Contactos = function(Parametros){
       $img_cargando.css('display','block');
        $.ajax({
              data:  Parametros,
              dataType: 'text',
              url:      '/tron/Emails/envio_correo_contactos/',
              type:     'post',
          success:  function (resultado)
           {
                $respuesta = resultado;



                $img_cargando.css('display','none');

           }
        });

}

$btn_cancelar.on('click',function(){
	 window.location.href = "/tron/index/";
});


$nombre_usuario.on('focus',function(){
  if ( $nombre_usuario.val() == 'Registre el nombre') {
     $nombre_usuario.css('background','white') ;
     $nombre_usuario.css('color','black') ;
     $nombre_usuario.val('');
  }
});

$email.on('focus',function(){
  if ( $email.val() == 'Registre dirección de correo electrónico') {
     $email.css('background','white') ;
     $email.css('color','black') ;
     $email.val('');
  }
});

$comentarios.on('focus',function(){
  if ( $comentarios.val() == 'Registre el comentario que desea enviarnos...') {
     $comentarios.css('background','white') ;
     $comentarios.css('color','black') ;
     $comentarios.val('');
  }
});




$btn_enviar.on('click',function(){

	  $campos_validados = true ;


   if ( $nombre_usuario.val()=='' ) {
        $nombre_usuario.css('background','#FF3333') ;
        $nombre_usuario.css('color','white') ;
        $nombre_usuario.val('Registre el nombre');
        $campos_validados= false;
   }

   if ( $email.val()=='' ) {
        $email.css('background','#FF3333') ;
        $email.css('color','white') ;
        $email.val('Registre dirección de correo electrónico');
        $campos_validados= false;
   }

   if ( $comentarios.val()=='' ) {
        $comentarios.css('background','#FF3333') ;
        $comentarios.css('color','white') ;
        $comentarios.val('Registre el comentario que desea enviarnos...');
        $campos_validados= false;
   }
   if ( $campos_validados == true)
   {
				$nombre_usuario = $nombre_usuario.val();
				$email          = $email.val();
				$comentarios    = $comentarios.val();
   	Parametros = {'nombre_usuario':$nombre_usuario ,'email':$email,'comentarios':$comentarios };


   }

});


