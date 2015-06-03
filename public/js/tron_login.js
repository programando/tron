

var Mostrar_Mensaje = function(mensaje)
{

	 $('.messagebox').text(mensaje).fadeIn(2000);
  $('.messagebox').fadeOut(4000);
}

var Mensaje_Resultado_Cambio_Password_OK = function()
{
		 var $html =''
			$('#dv-img-cargando').hide();
			$('.modal-body').html('');
			$('.header-login').html('');
			$('.header-login').html('Correo enviado correctamente');
			$html ='<br>Hemos enviado a la cuenta de correo electrónico registrada en Red de Usuarios TRON, las instrucciones necesarias para que cambies tu contraseña.<br>';
			$html = $html + '<br><br>';
			$html = $html + "<div class='cont-btn-enviar'>";
			$html = $html + "<button type='button' class='btn btn-default btn-cerrar' data-dismiss='modal' >Cerrar</button>";
			$html = $html + "</div>";
			$('.modal-body').html($html);
}


var Mensaje_Resultado_Cambio_Password_NoEnvio_Correo = function()
{
	$('#dv-img-cargando').hide();
	$("#msgbox").removeClass().addClass('messagebox').text('El correo no pudo ser enviado. Tal vez se deba a saturación del servidor. Favor inténtelo más tarde.').fadeIn(3000);
}

var Mensaje_Resultado_Cambio_Password_Cuenta_No_Ok = function()
{
		$('#dv-img-cargando').hide();
		$("#msgbox").removeClass().addClass('messagebox').text('La cuenta de correo no tiene un formato válido para el envío de correos electrónicos.').fadeIn(3000);
}

var Mensaje_Resultado_Cambio_Password_Correo_No_Existe = function()
{
			$('#dv-img-cargando').hide();
			$("#msgbox").removeClass().addClass('messagebox').text('La cuenta de correo digitada no se encuentra registrada en la Red de Usuarios TRON.').fadeIn(3000);
}



var Iniciar_Sesion = function(Parametros)
{
			$.ajax({
							data:  Parametros,
							dataType: 'json',
							url:      '/tron/terceros/Validar_Ingreso_Usuario',
							type:     'post',
       success:  function (resultado)
      	 {
      	 	if (resultado.Resultado_Logueo!='Logueo_OK')
      	 		{
      	 				Mostrar_Mensaje('Los datos registrados no pudieron ser validados. Inténtelo nuevamente....');
      	 			}
      	 		  else{
      	 					Mostrar_Mensaje('Iniciando sesión en Red de Usuarios TRON... espere unos segundos...');

      	 					if (resultado.Siguiente_Pago=='DIRECCION')
      	 							{
      	 								window.location.href = "/tron/Carrito/Finalizar_Pedido_Direccion_Envio/";
      	 							}else
      	 							{
      	 								window.location.href = "/tron";
      	 							}

      	 		}
      	 }
				});
}

var Recuperar_Password = function(Parametros)
{
			$("#dv-img-cargando").show();
			$.ajax({
							data:  Parametros,
							dataType: 'json',
							url:      '/tron/terceros/Recuperar_Password/',
							type:     'post',
       success:  function (resultado)
      	 {
      	 		if (resultado.CorreoEnviado=='Ok'){
      	 					 Mensaje_Resultado_Cambio_Password_OK();
      	 					}
      	 		if (resultado.CorreoEnviado=='NoOk'){
      	 						Mensaje_Resultado_Cambio_Password_NoEnvio_Correo();
      	 					}
	     	 		if (resultado.CorreoEnviado=='Correo_No_OK'){
	     	 					Mensaje_Resultado_Cambio_Password_Cuenta_No_Ok();
	     	 				 }
	     	 		if (resultado.CorreoEnviado=='NoUsuario')		{
	     	 			   Mensaje_Resultado_Cambio_Password_Correo_No_Existe();
	     	 			  }
      	 }
				});
}


$('.email-usuario').on('focus',function(){
	  $("#msgbox").removeClass().addClass('messagebox').text('');
	  return false;
});

$('#login-password').on('focus',function(){
	 $("#msgbox").removeClass().addClass('messagebox').text('');
	 return false;
});

$('#login-username').on('focus',function(){
	 $("#msgbox").removeClass().addClass('messagebox').text('');
	 return false;
});

//BOTON PARA INICIAR SESION. ENERO 30 DE 2015
$('.btn-login').on('click', function(){
	var email    =  $('.email-usuario').val();
	var password =  $('#login-password').val();

 $("#msgbox").removeClass().addClass('messagebox').text('Iniciando sesión, por favor espere....').fadeIn(1000);
	if (email.length==0 || password.length==0)
		 {

		 			Mostrar_Mensaje('Debe registrar los datos de Email y Contraseña.');

		 	  return false;
		 }
	 var Parametros = {"Password":password, "email":email };
	 Iniciar_Sesion(Parametros);
	return false;
});

// BOTON PARA RECUPERAR CONTRASEÑA $("#btn-recupera-pass").on('click',function(){
$(".formulario_ingresar").on('click','#btn-recupera-pass',function(){
		var $email 			  = $('#login-username').val();
		var $Parametros = { "Email": $email };
		Recuperar_Password($Parametros);
		return false;
});







