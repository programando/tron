$('#btn-activar_cta_ocasional').on('click',function(){

	var $codigo_verificacion = $('#codigo-verificacion').val();
	var $idtecero            = $(this).attr('idtercero');
	var $password            = $.trim( $('#password_activar_cuenta').val());
	var $password_confirm    = $.trim($('#confir-password_activar_cuenta').val());
	var $img_cargando        = $('#img_cargando');
	var $email               = $('#email_activar_cuenta').val();
	var $Parametros          = {'idtecero':$idtecero,'codigo_verificacion':$codigo_verificacion,
	'password':$password,'password_confirm':$password_confirm,'email':$email };
	var $Texto = '';
 $.ajax({
              data:  $Parametros,
              dataType: 'json',
              url:      '/tron/terceros/activar_cuenta_usuario_finalizar_registro/',
              type:     'post',
          success:  function (resultado)
           {
             $Texto = resultado.Respuesta;
                new Messi($Texto,
                  {title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
                    buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-success'}]});
                if (  $Texto == 'El registro ha finalizado con éxito.'){
				 													 window.location.href = "/tron/index/";
																}
           },
           beforeSend: function(){
              $img_cargando.css('display','block');
           },
           complete: function(){
              $img_cargando.css('display','none');

           },
           error: function(xhr){
           		alert(xhr.responseText);
                  new Messi('Se ha presentado el siguiente error : <br>' + xhr.responseText,
                         {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
           }
        });
});


