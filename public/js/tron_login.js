


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




var Iniciar_Sesion = function(Parametros){
$.ajax({
							data:  Parametros,
							dataType: 'json',
							url:      '/tron/terceros/Validar_Ingreso_Usuario',
							type:     'post',
							async:    false,
       success:  function (resultado) {
       	Resultado_Logueo = resultado.Resultado_Logueo;
       	Siguiente_Paso   =  resultado.Siguiente_Paso;
								if (Resultado_Logueo !='Logueo_OK')	{
	      	 				Mostrar_Mensaje('Los datos registrados no pudieron ser validados. Inténtelo nuevamente....');
	      	 				return ;
	      	 				}
	      	 if ( 	Resultado_Logueo == 'Logueo_OK'){
	      	 			if (Siguiente_Paso =='DIRECCION' ){
	      	 						window.location.href = "/tron/Carrito/Finalizar_Pedido_Direccion_Envio/";
	      	 			}else{
	      	 				window.location.href = "/tron/Index/";
	      	 			}
	      	 }

      	 }
				});
	}


function Recuperar_Password(Parametros)
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
	     	 		},
	     	complet: function(){
	     	 					$("#dv-img-cargando").hide();
      	 }
				});
}

function Verificar_Activacion_Usuario_Envio_Correo(Parametros){
	//$idtercero ,$email, $pnombre, $genero, $idtipo_plan_compras , $idtpidentificacion,$razonsocial
					$idtercero           = Parametros.idtercero;
				 $nombre_usuario      = Parametros.nombre_usuario;
				 $genero              = Parametros.genero;
				 $idtipo_plan_compras = Parametros.idtipo_plan_compras;
				 $idtpidentificacion  = Parametros.idtpidentificacion;
				 $razonsocial         = Parametros.razonsocial;
				 $email 													 = Parametros.email;
				$.ajax({
							data:  '',
							dataType: 'json',
							url:      '/tron/terceros/Registro_Datos_Usuario_Envio_Correo_Activacion/'+$idtercero +'/'+$email+'/'+$nombre_usuario+'/'+$genero +'/'+$idtipo_plan_compras+'/'+$idtpidentificacion+'/'+$razonsocial+'/',
							type:     'post',
       success:  function (resultado)	 {

      	 }
				});
}



function Verificar_Activacion_Usuario(Parametros){
			$.ajax({
							data:  Parametros,
							dataType: 'json',
							url:      '/tron/terceros/Verificar_Activacion_Usuario/',
							type:     'post',
       success:  function (resultado)	 {
       	if (resultado.Respuesta == 'Usuario_No_Activo'){
       				$Parametros = {'idtercero':resultado.idtercero,'nombre_usuario':resultado.nombre_usuario,'genero':resultado.genero,'email':resultado.Email,
       																		 'idtipo_plan_compras':resultado.idtipo_plan_compras,'idtpidentificacion':resultado.idtpidentificacion,'razonsocial':resultado.razonsocial};

       				Verificar_Activacion_Usuario_Envio_Correo($Parametros)	;

	     				new Messi("<h3> ¡¡¡ Oppss !!!</h3>Hemos detectado que tu registro no ha sido finalizado. Ahora nuestro sistema ha enviado un mensaje a la cuenta de correo electrónico registrada en nuestro sitio para que desde 	ella 	finalices tu registro.<br><br>Favor revisa tu correo y continúa con el proceso de registro.<br><br>",
				      {title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
				        buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-success'}],
				        callback: function(val){
				          window.location.href = "/tron/index/";
				        }
				      });
     				}
      	 }
				});
}

//$Datos = compact('Respuesta','passwordusuario','registroconfirmado','idtercero','nombre_usuario','genero','idtipo_plan_compras','idtpidentificacion','razonsocial');





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

$('.email-usuario').on('focusout',function(){
		var $email = $('.email-usuario').val();
		var $Parametros = {'email':$email};

		Verificar_Activacion_Usuario($Parametros);
});


// ENTER EN PASSWORD
$('#login-password').on('keypress',function(e){
	 if(e.keyCode == 13) {
	 		$('.btn-login').click();
	 }
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
	 // JUNIO 26 DE 2015. EN EL MOMENTO DE LOGUEASE VERIFICAR QUE SI ES EMPRESARIO O CLIENTE
	  //NO TENGA EN EL CARRITO E KIT DE INICIO Y LOS PRODUCTOS PROMOCIONALES

	  Iniciar_Sesion(Parametros);
	 /*alert('Verficar_Plan_Compras_Kit_Inicio_Productos_Promocionales' );
	 Verficar_Plan_Compras_Kit_Inicio_Productos_Promocionales();*/
	return false;
});



// BOTON PARA RECUPERAR CONTRASEÑA $("#btn-recupera-pass").on('click',function(){
$("#btn-recupera-pass").on('click',function(){
		var $email 			  = $('#login-username').val();
		var $Parametros = { "Email": $email };
		Recuperar_Password($Parametros);
		return false;
});




//$(".formulario_ingresar").on('click','#btn-recupera-pass-',function(){
	$('#btn-recupera-pass-').on('click',function(){

		var $email 			  = $('#login-username-').val();
		var $Parametros = { "Email": $email };
		Recuperar_Password($Parametros);
		return false;
});





