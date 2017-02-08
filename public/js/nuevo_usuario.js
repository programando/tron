
var $Seguir ='NO';

var Validacion_Codigo_Tercero_Presenta = function(){
				var $codigoterceropresenta = $('#codigoterceropresenta').val();
				$.ajax({
								data:  {'codigousuario':$codigoterceropresenta},
								dataType: 'json',
							 url:      '/tron/terceros/Registro_Buscar_Por_Codigo/',
								type:     'post',
								async	: false,
	        success:  function (resultado)	 {
	        		//CODIGO_NO_EMPRESARIO
	        		//CODIGO_INACTIVO
	        		//CODIGO_OK


		     	 		},
		     	complet: function(){

	      	 }
					});
}


var Validaciones_Previas_Nuevo_Registro = function(){

			alert( $codigoterceropresenta );
}

$(".persona-juridica").hide();


// CAMBIO DEL TIPO DE DOCUMENTO
$('#idtpidentificacion').on('change',function(){
			var $tpidentificacion = $("#idtpidentificacion").val();
			 // 31 Tipo de Identificacion NIT
			 if ( $tpidentificacion == '31' ){
			 		$(".persona-juridica").show();
			 		$(".persona-natural").hide();
			 }else{
			 		$(".persona-juridica").hide();
			 		$(".persona-natural").show();
			 }
});


$('#btn-grabar-datos').on('click',function(){
    Validacion_Codigo_Tercero_Presenta();
    alert($Seguir  );
  });
