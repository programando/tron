
var $Seguir                  ='SI';
var $es_cliente              = false ;
var $es_empresario           = false ;

var $idtercero_presenta      = 0;
var	$codigo_tercero_presenta = '';
var	$nombre_usuario_presenta = '';


//$("#persona-juridica").hide();
//$("#mes-anio").hide();
//$("#lblgenero").hide();
$("#alert-datos-grabados").hide();
//$("#registro-cliente").prop("checked", true);
$("#img_cargando").hide();
$('#digitoverificacion').hide();
$('#datos-impuestos').hide();






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
			url:      '/terceros/Registro_Buscar_Por_Codigo',
			type:     'post',
			async	: false,
			success:  function (resultado)	 {

				if ( resultado.Respuesta == 'CODIGO_NO_HABILITADO' )	{
					$("#codigoterceropresenta").val('');
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no se encuentra habilitado en nuestro sistema de información.');
				}
				if ( resultado.Respuesta == 'CODIGO_NO_EMPRESARIO' )	{
						$("#codigoterceropresenta").val('');
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no pertenece a un empresario.');
				}
				if ( resultado.Respuesta == 'CODIGO_INACTIVO' )						{
					$("#codigoterceropresenta").val('');
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no se encuentra activo en nuestro sistema de información o se encuentra desabilitado.');
				}
				if ( resultado.Respuesta == 'CODIGO_NO_EXISTE' )					{
					$("#codigoterceropresenta").val('');
					Mostrar_Mensajes ('Error en el Registro','El código : <h4>' + $codigoterceropresenta + '</h4> no existe en nuestro sistema de información o se encuentra desabilitado.');
				}

				if ( resultado.Respuesta == 'CODIGO_OK' )	{
					$Seguir                  = 'SI';
					$idtercero_presenta      = resultado.idtercero;
					$codigo_tercero_presenta = resultado.codigousuario;
					$nombre_usuario_presenta = resultado.nombre_usuario ;
					Mostrar_Mensajes ('<strong>¡ Información Importante !</strong>','Usted quedará registrado(a) en la red de usuarios liderada por :<br><br><strong>' +
						$nombre_usuario_presenta + '</strong> <br>cuyo código de usuario es : <strong>'+ $codigoterceropresenta  +'</strong>' )
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
  $Seguir                  = 'SI';
	if ( ( $es_cliente == false) && ( $es_empresario  == false) ) {
		$Seguir                  = 'NO';
	}

	if ( $es_cliente 			== true ) {	idtipo_plan_compras = 2 ; }
	if ( $es_empresario   == true )   {	idtipo_plan_compras = 3 ; }
}

var Validaciones_Datos_Tributarios = function(){
	 $Seguir                  = 'SI';

		var $idtppersona_nat       =  $("#form-registro input[name=idtppersona-nat]:radio").is(':checked');
		var $idtppersona_jur       =  $("#form-registro input[name=idtppersona-jur]:radio").is(':checked');
		var $idtregimen_comun      =  $("#form-registro input[name=regimen-comun]:radio").is(':checked');
	 var $idtregimen_simplif    =  $("#form-registro input[name=regimen-simplif]:radio").is(':checked');

			if ( ( $idtppersona_nat == false) && ( $idtppersona_jur  == false) ) {
						$Seguir                  = 'NO';
			}

			if ( ( $idtregimen_comun == false) && ( $idtregimen_simplif == false) ) {
						$Seguir                  = 'NO';
			}
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

var Validaciones_Email_Password_Edicion = function(){
	$email  														= $("#email-edit").val();
	$passwordusuario      = $("#passwordusuario").val();

	if ( $email == '0' || $passwordusuario == '' ){
		$Seguir                  = 'NO';
	}else{
		$Seguir                  = 'SI';
	}
}


var Validaciones_Registro_Tipo_Cliente = function($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial  ){

	if ( $idtpidentificacion == '31' && $razonsocial == '' ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrar una empresa debe especificar su nombre o razón social.');
		return ;
	}
	if ( $idtpidentificacion != '31' && ( $pnombre == '' || $papellido == '' || $genero =='-1') ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrarse es necesario que indique su nombre, apellido y género....');
		return ;
	}
	$Seguir  = 'SI';
}

var Validaciones_Registro_Tipo_Empresario = function($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial,$dianacimiento, $mesnacimiento  ){

	if ( $idtpidentificacion == '31' && $razonsocial == '' ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrarse debe especificar su nombre o razón social.');
		return ;
	}
	if ( $idtpidentificacion != '31' && ( $pnombre == '' || $papellido == '' || $genero =='-1' || $dianacimiento =='0' || $mesnacimiento == '') ){
		$Seguir  = 'NO';
		Mostrar_Mensajes ('Error en el Registro','Para registrarse es necesario que indique su nombre, apellido, género, día y mes de nacimiento. <br> Algunos de estos datos se usarán para generar un código único con el cual conformará su red.');
		return ;
	}
	$Seguir  = 'SI';
}


//-------------------------------------------------------------------------------------------------------------------------

$("#ir-inicio").on('click', function(){
				window.location.href = "/Index";
})


$("#codigoterceropresenta").on('blur',function(){
	$(this).val($(this).val().toUpperCase());
	Validacion_Codigo_Tercero_Presenta();
})

//VALIDACION UNICIDAD DEL EMAIL
$("#email").on('blur',function(){
		Funciones.Terceros_Validar_Email();
})

//VALIDACION UNICIDAD DE NÚMERO DE DOCUMENTTO
$("#identificacion").on('blur',function(){
		Funciones.Terceros_Buscar_x_Identificacion();
		$("#alert-datos-grabados").hide();
})

$("#identificacion").on('change',function(){
		$("#alert-datos-grabados").hide();
})

$("#idtppersona-nat").on('change', function(){
		$("#idtppersona-jur").prop("checked", false);
});

$("#idtppersona-jur").on('change', function(){
		$("#idtppersona-nat").prop("checked", false);
});

$("#regimen-comun").on('change', function(){
		$("#regimen-simplif").prop("checked", false);
});

$("#regimen-simplif").on('change', function(){
		$("#regimen-comun").prop("checked", false);
});



// CAMBIO DEL TIPO DE DOCUMENTO
$('#idtpidentificacion').on('change',function(){
	var $idtpidentificacion = $("#idtpidentificacion").val();
	var $es_cliente       =  $("#form-registro input[name=registro-cliente]:radio").is(':checked');
	var $es_empresario    =  $("#form-registro input[name=registro-empresario]:radio").is(':checked');

			 // 31 Tipo de Identificacion NIT
			 if ( $idtpidentificacion == '31' ){
			 	$("#persona-natural").hide();
			 	$("#lblgenero").hide();
			 	$("#mes-anio").hide();
			 	$("#persona-juridica").show();
			 	$("#datos-impuestos").show();
			 	$("#idtppersona-nat").prop("checked", false);
				 $("#idtppersona-jur").prop("checked", false);
				 $("#regimen-comun").prop("checked", false);
     $("#regimen-simplif").prop("checked", false);
			 	$("#alert-datos-grabados").show();

			 }

			 if ( $idtpidentificacion != '31' ){
			 	$("#persona-juridica").hide();
			 	$("#persona-natural").show();
			 	$("#lblgenero").show();
			 	$("#datos-impuestos").hide();
			 	$("#alert-datos-grabados").hide();
			 	$("#idtppersona-nat").prop("checked", true);
			 		$("#regimen-simplif").prop("checked", true);
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
	var $idtpidentificacion = $("#idtpidentificacion").val();
	$('input:radio[name=registro-cliente]').attr('checked',false);
	$("#modal_empresario_explicacion").modal('show');
	if ( $idtpidentificacion != '31'){
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

	var $idtppersona_nat       =  $("#form-registro input[name=idtppersona-nat]:radio").is(':checked');
	var $idtppersona_jur       =  $("#form-registro input[name=idtppersona-jur]:radio").is(':checked');
	var $idtregimen_comun      =  $("#form-registro input[name=regimen-comun]:radio").is(':checked');
 var $idtregimen_simplif    =  $("#form-registro input[name=regimen-simplif]:radio").is(':checked');


	$Parametros = {'codigoterceropresenta':$codigoterceropresenta, 'es_cliente':$es_cliente,'es_empresario':$es_empresario,
								 'idtpidentificacion':$idtpidentificacion,'identificacion':$identificacion,'pnombre':$pnombre,
								 'papellido':$papellido, 'genero':$genero,'dianacimiento':$dianacimiento,'mesnacimiento':$mesnacimiento,
								 'razonsocial':$razonsocial, 'email':$email, 'passwordusuario':$passwordusuario,'idtercero_presenta':$idtercero_presenta ,
								 'idtppersona_nat':$idtppersona_nat,'idtppersona_jur':$idtppersona_jur, 'idtregimen_comun':$idtregimen_comun,
								 'idtregimen_simplif':$idtregimen_simplif    };

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

	 if ( $es_cliente == true ) {
	 			Validaciones_Registro_Tipo_Cliente ($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial ) ;

	 			if ( $Seguir =='NO') { return ; }
	 }

	 if ( $es_empresario ) {
	 			Validaciones_Registro_Tipo_Empresario ($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial,$dianacimiento, $mesnacimiento  ) ;
	 			if ( $Seguir =='NO') { return ; }
	 		}

   Validaciones_Datos_Tributarios( );
    	if ( $Seguir == 'NO'){
							Mostrar_Mensajes ('Error en el Registro','Es necesario que especifique: <br><br>  1) Tipo de persona : Natural o Jurídica   <br>2) Régimen tributario: Común o simplificado');
					return ;
				}



				Validaciones_Email_Password() ;
				if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Debe registrar una cuenta de correo electrónico y la contraseña que usará para hacer uso de nuestro sitio.');
					return ;
				}

	 			Funciones.Terceros_Grabar_Datos_Registro ( $Parametros );

	 	});



//----------------------------------------------------------------------------------------------
//---     MODIFICACIÓN DE DATOS DE USUARIO
//----------------------------------------------------------------------------------------------

//VALIDACION UNICIDAD DEL EMAIL
$("#email-edit").on('blur',function(){
		Funciones.Terceros_Validar_Email_Edicion();
}) ;



$('#btn-actualiza-datos').on('click',function(){
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
	var	$email                 =  $("#email-edit").val();
	var $passwordusuario       =  $("#passwordusuario").val();
	var $idtercero 												=  $("#idtercero").val();
	var $idtppersona_nat       =  $("#form-registro input[name=idtppersona-nat]:radio").is(':checked');
	var $idtppersona_jur       =  $("#form-registro input[name=idtppersona-jur]:radio").is(':checked');
	var $idtregimen_comun      =  $("#form-registro input[name=regimen-comun]:radio").is(':checked');
 var $idtregimen_simplif    =  $("#form-registro input[name=regimen-simplif]:radio").is(':checked');

	$Parametros = {'codigoterceropresenta':$codigoterceropresenta, 'es_cliente':$es_cliente,'es_empresario':$es_empresario,
								 'idtpidentificacion':$idtpidentificacion,'identificacion':$identificacion,'pnombre':$pnombre,
								 'papellido':$papellido, 'genero':$genero,'dianacimiento':$dianacimiento,'mesnacimiento':$mesnacimiento,
								 'razonsocial':$razonsocial, 'email':$email, 'passwordusuario':$passwordusuario,'idtercero_presenta':$idtercero_presenta,'idtercero':$idtercero,
								 'idtppersona_nat':$idtppersona_nat,'idtppersona_jur':$idtppersona_jur, 'idtregimen_comun':$idtregimen_comun,
								 'idtregimen_simplif':$idtregimen_simplif    };

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

	 if ( $es_cliente == true ) {
	 			Validaciones_Registro_Tipo_Cliente ($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial ) ;
	 			if ( $Seguir =='NO') { return ; }
	 }

	 if ( $es_empresario ) {
	 			Validaciones_Registro_Tipo_Empresario ($idtpidentificacion, $pnombre, $papellido, $genero, $razonsocial,$dianacimiento, $mesnacimiento  ) ;
	 			if ( $Seguir =='NO') { return ; }
	 		}

   Validaciones_Datos_Tributarios( );
    	if ( $Seguir == 'NO'){
							Mostrar_Mensajes ('Error en el Registro','Es necesario que especifique: <br><br>  1) Tipo de persona : Natural o Jurídica   <br>2) Régimen tributario: Común o simplificado');
					return ;
				}


				Validaciones_Email_Password_Edicion() ;
				if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Debe registrar una cuenta de correo electrónico y la contraseña que usará para hacer uso de nuestro sitio.');
					return ;
				}


	 			Funciones.Terceros_Actualizar_Datos_Registro ( $Parametros );

	 	});

