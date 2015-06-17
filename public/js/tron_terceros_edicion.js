
$('#btn_atualizar_datos').on('click',function(){
	alert("kdk");
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




