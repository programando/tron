
// VALIDACIONES PARA EL CAMBIO DE CONTRASEÑA.  FEBRERO 03 DE 2015
//-----------------------------------------------------------------------------
var Mostrar_Mensaje_Validacion_Cambio_Password = function (Parametros)
{
	  var $mensaje            = $('#mensaje-validacion');
	 	$mensaje.html(Parametros);
 		$mensaje.show();

}


var Grabar_Nuevo_Password = function(Parametros)
{
		 var $Respuesta;
			$.ajax({
							data:  Parametros,
							dataType: 'text',
							url:      '/terceros/Actualizar_Password',
							type:     'post',
       success:  function (Resultado)
      	 {
      	 	 $Respuesta = $.trim(Resultado);

      	 	 if ($Respuesta=="PasswordTemporal_No_OK"){
      	 	 	Mostrar_Mensaje_Validacion_Cambio_Password('El código de verificación no fue encontrado en nuestros registros. Favor repita el proceso para recuperación de su contraseña.');
      	 	 }
      	 	 if ($Respuesta=="TodoOK"){
      	 	 	$('#ventana-final').modal('show');

      	 	 }
      	 }

				});
}



$('#cerrar-ventana-final').on('click',function(){
 	window.location.href = "/index";
	 $('#ventana-final').modal('hide');
})


$(".boton-guarar-password").on('click',function(){
 var $password_temporal  = $('#codigo-verificacion').val();
 var $new_password       = $('#password').val();
 var $confirmar_password = $('#confirmar-password').val();
  var $Parametros;
	 if ($new_password != $confirmar_password)
	 {
	 	 Mostrar_Mensaje_Validacion_Cambio_Password('Las contraseñas no son iguales. No es posible Continuar !');
	 	 	return false;
	 }
	 if ($new_password.length==0 && $confirmar_password.length==0)
	 {
	 	 Mostrar_Mensaje_Validacion_Cambio_Password('Registre la nueva contraseña para finalizar el proceso.');
	 	 	return false;
	 }
	 $Parametros ={'password_temporal':$password_temporal,'new_password':$new_password ,'confirmar_password':$confirmar_password };
	  Grabar_Nuevo_Password($Parametros );
	 return false;

});


$('.new-password').on('focus',function(){
		$('#mensaje-validacion').html('');
});


$('.confirmar-password').on('focus',function(){
		$('#mensaje-validacion').html('');
});


