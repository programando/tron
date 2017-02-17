
var $Seguir                  ='NO';
var $idtercero_presenta      = 0 ;
var $codigo_tercero_presenta = '' ;
var $nombre_usuario_presenta = '' ;
var $idtipo_plan_compras     = 0 ;
var $idtpidentificacion      = 0 ;
var $identificacion										= '' ;

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

		        			if ( resultado.Respuesta == 'CODIGO_NO_EMPRESARIO' )	{ }
		        			if ( resultado.Respuesta == 'CODIGO_INACTIVO' )						{ }
		        			if ( resultado.Respuesta == 'CODIGO_NO_EXISTE' )					{ }

		        			if ( resultado.Respuesta == 'CODIGO_OK' )	{
															$Seguir                  = 'SI';
															$idtercero_presenta      = resultado.idtercero;
															$codigo_tercero_presenta = resultado.codigousuario;
															$nombre_usuario_presenta = resultado.nombre_usuario ;
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
$("#registro-cliente").on('click', function(){
		$('input:radio[name=registro-empresario]').attr('checked',false);
		$("#lblgenero").hide();
		$("#mes-anio").hide();

});

$("#registro-empresario").on('click', function(){
		var $tpidentificacion = $("#idtpidentificacion").val();

		$('input:radio[name=registro-cliente]').attr('checked',false);

			if ( $tpidentificacion != '31'){
					$("#mes-anio").show();
					$("#lblgenero").show();
			}

});


$('#btn-grabar-datos').on('click',function(){
    /*
    Validacion_Codigo_Tercero_Presenta();
    if ( $Seguir == 'NO'){  return ; }
    Validaciones_Eleccion_Plan_Registro();
    if ( $Seguir == 'NO'){  return ; }
				*/

				Validaciones_Tipo_Documento_Numero() ;
				if ( $Seguir == 'NO'){
					Mostrar_Mensajes ('Error en el Registro','Es necesario que especifique el tipo y número de su documento');
					return ;
				}



  });


