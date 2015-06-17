var $Texto_Validacion = '';
var Datos_Validados = function(){
 var $idtercero                                      = $('idtercero');													 																								var $identificacion_nat     																	  = $('identificacion');
 var $identificacion                                 = $('identificacion');																																	var $digitoverificacion      																	 = $('digitoverificacion');
 var $pnombre                                        = $('pnombre');															 																								var $papellido               																	 = $('papellido');
 var $razonsocial                                    = $('razonsocial');											 																								var $direccion               																	 = $('direccion');
 var $barrio                                         = $('barrio');																																									var $contacto                																	 = $('contacto');
 var $celular1                                       = $('celular1');																																							var $email                   																	 = $('email');
 var $idmcipio                                       = $('idmcipio');																																							var $param_confirmar_nuevos_amigos_x_email  			= $('param_confirmar_nuevos_amigos_x_email');
 var $param_acepto_pago_valor_transferencia          = $('param_acepto_pago_valor_transferencia');									 var $valor_minimo_transferencia              		= $('valor_minimo_transferencia');
 var $param_idbanco_transferencias                   = $('param_idbanco_transferencias');																			var $mis_datos_son_privados                    = $('mis_datos_son_privados');
 var $pago_comisiones_efecty                         = $('pago_comisiones_efecty');																									var $pago_comisiones_transferencia             = $('pago_comisiones_transferencia');
 var $param_acepto_retencion_comis_para_pago_pedidos = $('param_acepto_retencion_comis_para_pago_pedidos');	var $param_valor_comisiones_para_pago_pedidos  = $('param_valor_comisiones_para_pago_pedidos');
 var $declaro_renta                                  = $('declaro_renta');																																		var $nommcipio                                 = $('nommcipio');
 var $iddpto                                         = $('iddpto');																																									var $nomdpto                                   = $('nomdpto');
 var $recibo_promociones_email                       = $('recibo_promociones_email');																						 var $recibo_promociones_celular                = $('recibo_promociones_celular');
 var $param_idbanco_transferencias                   = $('param_idbanco_transferencias');																			var $nombre_banco_transferencias               = $('nombre_banco_transferencias');
 var $param_nro_cuenta_transferencias                = $('param_nro_cuenta_transferencias');															 var $param_tipo_cuenta_transferencias          = $('param_tipo_cuenta_transferencias');
 var $param_idmcipio_transferencias                  = $('param_idmcipio_transferencias');																	 var $nommcipio_transferencia                   = $('nommcipio_transferencia');
 var $iddpto_transferencia                           = $('iddpto_transferencia');																										 var $nomdpto_transferencia                     = $('nomdpto_transferencia');


}



$('#btn_atualizar_datos').on('click',function(){
		if ( Datos_Validados == false ){

		}else{
				// GRABAR LOS DATOS Y ACTUALIZAR REGSITRO
		}
});

// OCULTAR DATOS DE LA CUENTA BANCARIA
$('#datos_cuenta_bancaria').hide();



//SOLAPA CUENTA BANCARIA
$('#pago_comisiones_efecty').on('click',function(){
			if ( $('#pago_comisiones_efecty').is(':checked')){
				 	$('#datos_cuenta_bancaria').hide();
				 	$('#pago_comisiones_transferencia').prop('checked',false);
			}else{
				$('#datos_cuenta_bancaria').show();
				$('#pago_comisiones_efecty').prop('checked',false);
					$('#pago_comisiones_transferencia').prop('checked',true);
			}

});


$('#pago_comisiones_transferencia').on('click',function(){
	 if ( $('#pago_comisiones_transferencia').is(':checked')){
	 		$('#datos_cuenta_bancaria').show();
	 		$('#pago_comisiones_efecty').prop('checked',false);
	 }else{
	 		$('#datos_cuenta_bancaria').hide();
	 		$('#pago_comisiones_efecty').prop('checked',true);
	 }
});

$('#param_acepto_retencion_comis_para_pago_pedidos').on('click',function(){
	if ( $('#param_acepto_retencion_comis_para_pago_pedidos').is(':checked')){
				$('#param_valor_comisiones_para_pago_pedidos').prop('disabled',false);
	}else{
				$('#param_valor_comisiones_para_pago_pedidos').val(0);
				$('#param_valor_comisiones_para_pago_pedidos').prop('disabled',true);
	}

})




