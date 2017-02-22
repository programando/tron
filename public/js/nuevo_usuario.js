
var $Seguir                  ='NO';
var $es_cliente              = false ;
var $es_empresario           = false ;

var $idtercero_presenta      = 0;
var	$codigo_tercero_presenta = '';
var	$nombre_usuario_presenta = '';


$("#persona-juridica").hide();
$("#mes-anio").hide();
$("#lblgenero").hide();


var Mostrar_Mensajes = function( $Titulo, $Contenido ){
	$('.modal-header #contenido').html($Titulo);
	$('.modal-body #contenido').html($Contenido);
	$('#modal_error').modal('show');
}


var Validacion_Codigo_Tercero_Presenta = function(){
	var $codigoterceropresenta = $('#codigoterceropresenta').val();
	if ( $codigoterceropresenta =='') {
		$Seguir = 'CODIGO_EN_BLACO';
	}else{
		$.ajax({
			data:  {'codigousuario':$codigoterceropresenta},
			dataType: 'json',
			url:      '/tron/terceros/Registro_Buscar_Por_Codigo/',
			type:     'post',
			async	: false,
			success:  function (resultado)	 {

				if ( resultado.Respuesta == 'CODIGO_NO_HABILITADO' )	{
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no se encuentra habilitado en nuestro sistema de información.');
				}
				if ( resultado.Respuesta == 'CODIGO_NO_EMPRESARIO' )	{
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no pertenece a un empresario.');
				}
				if ( resultado.Respuesta == 'CODIGO_INACTIVO' )						{
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no se encuentra activo en nuestro sistema de información o se encuentra desabilitado.');
				}
				if ( resultado.Respuesta == 'CODIGO_NO_EXISTE' )					{
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no existe en nuestro sistema de información o se encuentra desabilitado.');
				}

				if ( resultado.Respuesta == 'CODIGO_OK' )	{
					$Seguir                  = 'SI';
					$idtercero_presenta      = resultado.idtercero;
					$codigo_tercero_presenta = resultado.codigousuario;
					$nombre_usuario_presenta = resultado.nombre_usuario ;
					Mostrar_Mensajes ('¡ Información Importante !','Usted quedará registrado(a) en la red de usuarios encabezada por :<br><br><strong>' + $codigoterceropresenta  + ' - ' +$nombre_usuario_presenta + '</strong>' )
				}


			},
			complet: function(){

			}
		});
	}
}


var Validaciones_Eleccion_Plan_Registro = function(){
	var $es_cliente       =  $("#form-registro input[name=registro-cliente]:radio").is(':checked');
	var $es_empresario    =  $("#form-registro input[name=registro-empresario]:radio").is(':checked');
	if ( $es_cliente == false && $es_empresario  == false ) {
		$Seguir                  = 'NO';
	}
	if ( $es_cliente 			== true ) {	idtipo_plan_compras = 2 ; }
	if ( $es_empresario == true ) {	idtipo_plan_compras = 3 ; }

}


var Validaciones_Tipo_Documento_Numero = function(){
	$idtpidentificacion  = $("#idtpidentificacion").val();
	$identificacion      = $("#identificacion").val();

	if ( $idtpidentificacion == '0' || $identificacion == '' ){
		$Seguir                  = 'NO';
	}else{
		$Seguir                  = 'SI';
	}

}


var Validaciones_Email_Password = function(){
	$email  														= $("#email").val();
	$passwordusuario      = $("#passwordusuario").val();

	if ( $email == '0' || $passwordusuario == '' ){
		$Seguir                  = 'NO';
	}else{
		$Seguir                  = 'SI';
	}

}

var Validaciones_Registro_Tipo_Cliente = function($tpidentificacion, $pnombre, $papellido, $genero, $razonsocial  ){

	if ( $tpidentificacion == '31' && $razonsocial == '' ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrar una empresa debe especificar su nombre o razón social.');
		return ;
	}
	if ( $tpidentificacion != '31' && ( $pnombre == '' || $papellido == '' || $genero =='0') ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrar un cliente es necesario que indique su nombre, apellido y género.');
		return ;
	}
	$Seguir  = 'SI';
}

var Validaciones_Registro_Tipo_Empresario = function($tpidentificacion, $pnombre, $papellido, $genero, $razonsocial,$dianacimiento, $mesnacimiento  ){

	if ( $tpidentificacion == '31' && $razonsocial == '' ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrar una empresa debe especificar su nombre o razón social.');
		return ;
	}
	if ( $tpidentificacion != '31' && ( $pnombre == '' || $papellido == '' || $genero =='0' || $dianacimiento =='0' || $mesnacimiento == '') ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrar un empresario es necesario que indique su nombre, apellido, género, día y mes de nacimiento. <br> Algunos de estos datos se usarán para generar un código único con el cual conformará su red.');
		return ;
	}
	$Seguir  = 'SI';
}


//-------------------------------------------------------------------------------------------------------------------------

$("#codigoterceropresenta").on('blur',function(){
	Validacion_Codigo_Tercero_Presenta();
})

//VALIDACION UNICIDAD DEL EMAIL
$("#email").on('blur',function(){
		Funciones.Terceros_Validar_Email();
})


// CAMBIO DEL TIPO DE DOCUMENTO
$('#idtpidentificacion').on('change',function(){
	var $tpidentificacion = $("#idtpidentificacion").val();
	var $es_cliente       =  $("#form-registro input[name=registro-cliente]:radio").is(':checked');
	var $es_empresario    =  $("#form-registro input[name=registro-empresario]:radio").is(':checked');

			 // 31 Tipo de Identificacion NIT
			 if ( $tpidentificacion == '31' ){
			 	$("#persona-juridica").show();
			 	$("#persona-natural").hide();
			 	$("#lblgenero").hide();
			 	$("#mes-anio").hide();
			 }

			 if ( $tpidentificacion != '31' ){
			 	$("#persona-juridica").hide();
			 	$("#persona-natural").show();
			 	$("#lblgenero").show();
			 	if ( $es_empresario == true ){
			 		$("#mes-anio").show();
			 	}
			 	if ( $es_cliente == true ){
			 		$("#mes-anio").hide();
			 	}
			 }

			});



// CAMBIO EN EL TIPO DE REGISTRO
// BOTON CLIENTE
$("#registro-cliente").on('click', function(){
	$('input:radio[name=registro-empresario]').attr('checked',false);
	$("#lblgenero").hide();
	$("#mes-anio").hide();
});

// BOTÓN EMPREARIO
$("#registro-empresario").on('click', function(){
	var $tpidentificacion = $("#idtpidentificacion").val();
	$('input:radio[name=registro-cliente]').attr('checked',false);
	if ( $tpidentificacion != '31'){
		$("#mes-anio").show();
		$("#lblgenero").show();
	}
});

// BOTÓN GRABAR
$('#btn-grabar-datos').on('click',function(){
	var $codigoterceropresenta =  $('#codigoterceropresenta').val();
	var $es_cliente            =  $("#form-registro input[name=registro-cliente]:radio").is(':checked');
	var $es_empresario         =  $("#form-registro input[name=registro-empresario]:radio").is(':checked');
	var $idtpidentificacion    =  $("#idtpidentificacion").val();
	var $identificacion        =  $("#identificacion").val();
	var $pnombre               =  $("#pnombre").val();
	var $papellido             =  $("#papellido").val();
	var $genero                =  $("#genero").val();
	var $dianacimiento         =  $("#dianacimiento").val();
	var $mesnacimiento         =  $("#mesnacimiento").val();
	var $razonsocial           =  $("#razonsocial").val();
	var	$email                 =  $("#email").val();
	var $passwordusuario       =  $("#passwordusuario").val();

	$Parametros = {'codigoterceropresenta':$codigoterceropresenta, 'es_cliente':$es_cliente,'es_empresario':$es_empresario,
								 'idtpidentificacion':$idtpidentificacion,'identificacion':$identificacion,'pnombre':$pnombre,
								 'papellido':$papellido, 'genero':$genero,'dianacimiento':$dianacimiento,'mesnacimiento':$mesnacimiento,
								 'razonsocial':$razonsocial, 'email':$email, 'passwordusuario':$passwordusuario,'idtercero_presenta':$idtercero_presenta    };


	//Validacion_Codigo_Tercero_Presenta();
	//if ( $Seguir == 'NO'){  return ; }
 /*
    Validaciones_Eleccion_Plan_Registro();
    	if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Debe indicar el tipo de registro que desea crear: Cliente o Empresario TRON.');
					return ;
				}


				Validaciones_Tipo_Documento_Numero() ;
				if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Es necesario que especifique el tipo y número de su documento.');
					return ;
				}

				Validaciones_Email_Password() ;
				if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Debe registrar una cuenta de correo electrónico y la contraseña que usará para hacer uso de nuestro sitio.');
					return ;
				}



	 if ( $es_cliente == true ) {
	 			Validaciones_Registro_Tipo_Cliente ($tpidentificacion, $pnombre, $papellido, $genero, $razonsocial ) ;
	 			if ( $Seguir =='NO') { return ; }
	 }

	 if ( $es_empresario ) {
	 			Validaciones_Registro_Tipo_Empresario ($tpidentificacion, $pnombre, $papellido, $genero, $razonsocial,$dianacimiento, $mesnacimiento  ) ;
	 			if ( $Seguir =='NO') { return ; }
	 		}*/


	 			Funciones.Terceros_Grabar_Datos_Registro ( $Parametros );




	 	});


