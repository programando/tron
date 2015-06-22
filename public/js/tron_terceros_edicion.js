var $Texto                          ='';
var $Parametros_Actualizar_Registro ='';

	var Datos_Validados = function(idtercero,idtpidentificacion){
	 $Texto = '';
	 $Parametros_Actualizar_Registro  = '';
   var $idtercero                                      = idtercero ;
   var $identificacion_nat                             = $('#identificacion');
   var $identificacion                                 = $('#identificacion');
   var $digitoverificacion                             = $('#digitoverificacion');
   var $pnombre                                        = $('#pnombre');
   var $papellido                                      = $('#papellido');
   var $razonsocial                                    = $('#razonsocial');
   var $direccion                                      = $('#direccion');
   var $barrio                                         = $('#barrio');
   var $contacto                                       = $('#contacto');
   var $celular1                                       = $('#celular1');
   var $email                                          = $('#email');
   var $idmcipio                                       = $('#idmcipio');
   var $param_confirmar_nuevos_amigos_x_email          = $('#param_confirmar_nuevos_amigos_x_email');
   var $param_acepto_pago_valor_transferencia          = $('#param_acepto_pago_valor_transferencia');
   var $valor_minimo_transferencia                     = $('#valor_minimo_transferencia');
   var $param_idbanco_transferencias                   = $('#param_idbanco_transferencias');
   var $mis_datos_son_privados                         = $('#mis_datos_son_privados');
   var $pago_comisiones_efecty                         = $('#pago_comisiones_efecty');
   var $pago_comisiones_transferencia                  = $('#pago_comisiones_transferencia');
   var $param_acepto_retencion_comis_para_pago_pedidos = $('#param_acepto_retencion_comis_para_pago_pedidos');
   var $param_valor_comisiones_para_pago_pedidos       = $('#param_valor_comisiones_para_pago_pedidos');
   var $declaro_renta                                  = $('#declaro_renta');
   var $nommcipio                                      = $('#nommcipio');
   var $iddpto                                         = $('#iddpto');
   var $nomdpto                                        = $('#nomdpto');
   var $recibo_promociones_email                       = $('#recibo_promociones_email');
   var $recibo_promociones_celular                     = $('#recibo_promociones_celular');
   var $param_idbanco_transferencias                   = $('#param_idbanco_transferencias');
   var $param_idbanco_transferencias                   = $('#param_idbanco_transferencias');
   var $param_nro_cuenta_transferencias                = $('#param_nro_cuenta_transferencias');
   var $param_tipo_cuenta_transferencias               = $('#param_tipo_cuenta_transferencias');
   var $param_idmcipio_transferencias                  = $('#param_idmcipio_transferencias');
   var $nommcipio_transferencia                        = $('#nommcipio_transferencia');
   var $iddpto_transferencia                           = $('#iddpto_transferencia');
   var $nomdpto_transferencia                          = $('#nomdpto_transferencia');
   var $pago_por_transferencia                         = false;
   var $password                                       = $('#password');
   var $confirmar_password                             = $('#confirmar-password');


		 if ( (idtpidentificacion	!= '31')){
	        if ($.trim( $pnombre.val()) == "" || $.trim( $papellido.val()) == "" ){
	          $Texto = $Texto + 'Debe registrar nombre y el apellido para identificar el registro. <br>';
	        }
		 }else{
		 					 if ($.trim( $razonsocial.val()) == "" ){
		 					 		 $Texto = $Texto + 'Debe registrar el nombre de la empresa. <br>';
		 					 }
		 }
		  if ($idmcipio.val()== '0' ){
      $Texto = $Texto + 'Seleccione el departamento y ciudad en donde recide. <br>';
    }
    if ($.trim( $direccion.val() ) == "" ){
      $Texto = $Texto + 'Debe registrar la dirección de residencia. <br>';
    }
    if ($.trim( $barrio.val()) == "" ){
      $Texto = $Texto + 'Debe registrar el barrio en donde recide. <br>';
    }
    if ($.trim( $celular1.val() ) == "" ){
      $Texto = $Texto + 'Registre un número de celular. <br>';
    }
    if ($.trim( $email.val()) == "" ){
      $Texto = $Texto + 'Debe registrar un correo electrónico. <br>';
    }
    // SI SELECCIONO PAGO POR TRANSFERENCIA BANCARIA
    if ($pago_comisiones_transferencia.is(':checked') ){
    			 if ($.trim( $param_idbanco_transferencias.val()) == "0" ){
      					$Texto = $Texto + 'Debe seleccionar el banco en donde recibirá el pago de comisiones. <br>';
      				}
    			 if ($.trim( $param_nro_cuenta_transferencias.val()) == "" ){
      					$Texto = $Texto + 'Registre el número de cuenta. <br>';
      				}
      		if ( $param_tipo_cuenta_transferencias.val()=='0' ){
      					$Texto = $Texto + 'Seleccione el tipo de cuenta en donde se le harán transferencias. <br>';
      		}
      		if ( $iddpto_transferencia.val() == '0' || $param_idmcipio_transferencias.val()=='0' ){
      				$Texto = $Texto + 'Debe seleccionar el departamento y la ciudad en donde está radicada la cuenta para transferencias bancarias. <br>';
      		}
    }
    if ( ($param_acepto_retencion_comis_para_pago_pedidos.is(':checked')) && ($param_valor_comisiones_para_pago_pedidos.val() =='0')){
    			$Texto = $Texto + 'Registre el valor que autoriza descontar de sus cuenta dinero para el pago de pedidos. <br>';
    }

   if ($.trim( $password.val()) != "" ){
   			if ($.trim( $password.val())  != $.trim( $confirmar_password.val())  ){
   					$Texto = $Texto + 'La contraseña y su confirmación deben ser iguales. <br>';
   			}
   }

  if ( $Texto.length > 0 ){
      return false;
  }else{
      $recibo_promociones_celular                     = $recibo_promociones_celular.is(':checked');
      $pago_comisiones_transferencia                  = $pago_comisiones_transferencia.is(':checked');
      $recibo_promociones_email                       =  $recibo_promociones_email.is(':checked');
      $param_confirmar_nuevos_amigos_x_email          = $param_confirmar_nuevos_amigos_x_email.is(':checked');
      $mis_datos_son_privados                         = $mis_datos_son_privados.is(':checked');
      $declaro_renta                                  = $declaro_renta.is(':checked');
      $param_acepto_retencion_comis_para_pago_pedidos = $param_acepto_retencion_comis_para_pago_pedidos.is(':checked');
      $pago_comisiones_efecty                         = $pago_comisiones_efecty.is(':checked');
  		$Parametros_Actualizar_Registro  = {'pnombre':$pnombre.val(),'papellido':$papellido.val(),'razonsocial':$razonsocial.val(), 'idmcipio':$idmcipio.val(),
  					   														 'direccion':$direccion.val(),'barrio':$direccion.val(), 'celular1':$celular1.val(),'email':$email.val(),
  					   														 'pago_comisiones_transferencia':$pago_por_transferencia,'param_idbanco_transferencias':$param_nro_cuenta_transferencias.val(),
  					   														 'param_tipo_cuenta_transferencias':$param_tipo_cuenta_transferencias.val(), 'param_idmcipio_transferencias':$param_idmcipio_transferencias.val(),
  					   														 'recibo_promociones_celular': $recibo_promociones_celular,
  					   														 'recibo_promociones_email': $recibo_promociones_email,
  					   														 'param_confirmar_nuevos_amigos_x_email': $param_confirmar_nuevos_amigos_x_email,
  					   														 'mis_datos_son_privados': $mis_datos_son_privados,
  					   														 'declaro_renta': $declaro_renta,
  					   														 'param_acepto_retencion_comis_para_pago_pedidos':$param_acepto_retencion_comis_para_pago_pedidos,
  					   														 'pago_comisiones_efecty':$pago_comisiones_efecty,
  					   														 'param_valor_comisiones_para_pago_pedidos':$param_valor_comisiones_para_pago_pedidos.val(),
  					   														 'idtpidentificacion':idtpidentificacion, 'idtercero':idtercero, 'password':$password.val(), 'confirmar_password': $confirmar_password.val() };
    return true;
  }

}


var Actualizar_Datos_Cuenta_Usuario = function(Parametros){
			$.ajax({
						data:  Parametros,
						dataType: 'json',
						url:      '/tron/terceros/Actualizar_Datos_Cuenta/',
						type:     'post',
	     success:  function (resultado)
	    	 {
            if (resultado.Texto == 'OK'){
	    	 				resultado.Texto ='<h4> Los datos han sido actualizados con éxito ! </h4>'
             new Messi(resultado.Texto,
              {title: 'Mensaje del Sistema',modal: true, titleClass: 'info', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-success'}] ,
              callback: function(val) {
                      $('.tab-mi-perfil').click();
              }
            });

	    	 		}else{
	    	 					new Messi(resultado.Texto ,
	    	 								 {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
	    	 		}
	    	 }
			});
}

$('.tab-mi-perfil').on('click', function(){

    window.location.href = "/tron/terceros/administrar_cuenta/";

});



$('.contenedor_cuenta').on('click', '#btn_atualizar_datos', function(){
    $idtercero               = $(this).attr('idtercero');
    $idtpidentificacion      = $(this).attr('idtpidentificacion');
    var $Formulario_Validado = false;

    $Formulario_Validado = Datos_Validados($idtercero , $idtpidentificacion  )

    if ($Formulario_Validado  == false){
             new Messi($Texto,
              {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]
              });
      }else{
      	Actualizar_Datos_Cuenta_Usuario ($Parametros_Actualizar_Registro );

      }
});


$('#email').on('blur',function(){
		var $Texto        = '';
		var $email_oculto = $('#email-oculto').val();

  if ( $('#email').length == 0) { return false;}
  $email = $(this).val();
  if ( $('#email').val() == $('#email-oculto').val() ){
  		return false;
  }

  $.ajax({
        data:  {'email':$email},
        dataType: 'json',
        url:      '/tron/terceros/Consulta_Datos_Por_Email_Registro/',
        type:     'post',
   success:  function (respuesta)
     {
        if (respuesta.Respuesta == 'EMAIL-NO-OK'){
            $Texto = 'El correo electrónico : <strong>' + $email + '</strong> tiene un formato no válido. por favor corrija los datos.';
          }
         if (respuesta.Respuesta == 'EMAIL-EXISTE'){
            $Texto = 'El correo electrónico : <strong>' +  $email + '</strong> ya se encuentra registrado en nuestra base de datos.';
          }
          if ( $Texto.length > 0){
                new Messi($Texto,
                  {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                    buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
                $('#email').val('');
              }

     }
     });

});


var Mostrar_Direcciones_x_IdTercero = function($Parametros){

  $.ajax({
      data:  $Parametros,
      dataType: 'html',
      url:      '/tron/terceros/Direcciones_Despacho_x_IdTercero/',
      type:     'post',
      success:  function (resultado){
          $('.conteneror-direcciones').html('');
          $('.conteneror-direcciones').html(resultado);
      }
   });

}

// OCULTAR DATOS DE LA CUENTA BANCARIA
$('#datos_cuenta_bancaria').hide();

$('.contenedor_cuenta').on('click','#cuenta',function(){
  $('#btn_atualizar_datos').show();
});

$('.contenedor_cuenta').on('click','#personales',function(){
  $('#btn_atualizar_datos').show();
});

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
//$().on('mouseover','#password',function(){
//

$('.contenedor_cuenta').on('click','#direcciones',function(){
  $idtercero = $(this).attr('idtercero');
  $('#btn_atualizar_datos').hide();
  $json = 1;
    $.ajax({
      data:  {'idtercero':$idtercero,'json':$json },
      dataType: 'json',
      url:      '/tron/terceros/Direcciones_Despacho_x_IdTercero/',
      type:     'post',
      success:  function (resultado)
      {

      }
   });
});

//$Codigos = $("ul");
$('.usu-1').on('click',function()
{
  $Usuario_Seleccionado = $(this).attr('id');
  $Cantidad_Direcciones = $(this).attr('cantidad-direcciones');
  $('.barra-usurarios li').each(function(indice, elemento) {
    $(this).css('background','white');
    $(this).css('color','black');
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
  $Parametros = {'idtercero':$Usuario_Seleccionado,'json':0};
  Mostrar_Direcciones_x_IdTercero($Parametros);
})


