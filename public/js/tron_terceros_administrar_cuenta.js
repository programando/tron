// Funtiones tabs
// TABS  =  mi perfil , informes , favoritos

// var $Opciones_Seleccionada = '';
// $(function() {
//    // $('#mi-perfil').click();
//    // // $('#btn_mostrar').click();
// });

var $Usuario_Seleccionado = 0;
var $Codigo_Seleccionado  = '';
// Efecto activo de los tabs
$('.contenedor_cuenta').on('click','.tab_link_modif',function(){
					$('.tab_link_modif').css('background','transparent');
					$('.tab_link_modif').css('color','inherit');
					$(this).css('background','#003E90');
					$(this).css('color','white');

});


var Activar_Usuarios = function($Usuario_Seleccionado){
 $('.barra-usurarios li').each(function(indice, elemento) {
 		$(this).css('background','white');
  	$(this).css('color','black');
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
}


var  Mostrar_Participacion_en_Red = function($idtercero,$anio){
	  $.ajax({
	      data:  '',
	      dataType: 'html',
	      url:      '/tron/informes/Participacion_En_La_Red_Ajax/'+$idtercero+'/'+$anio,
	      type:     'post',
	      success:  function (resultado)  {
				      $('.participacion-red').html('');
				      $('.participacion-red').html(resultado);
	      }
	   });
	}

var  Mostrar_Amigos_Presentados = function($idtercero,$anio){
	  $.ajax({
	      data:  '',
	      dataType: 'html',
	      url:      '/tron/informes/Amigos_Presentados_Ajax/'+$idtercero+'/'+$anio,
	      type:     'post',
	      success:  function (resultado)  {
				      $('.participacion-red').html('');
				      $('.participacion-red').html(resultado);
	      }
	   });
	}

var  Mostar_Clientes_x_IdTercero = function($codigousuario){
	  $.ajax({
	      data:  '',
	      dataType: 'html',
	      url:      '/tron/informes/Clientes_Presentados_Ajax/'+$codigousuario,
	      type:     'post',
	      success:  function (resultado)  {
				      $('.participacion-red').html('');
				      $('.participacion-red').html(resultado);
	      }
	   });
	}





var Mostrar_Estado_Cuenta_x_idTercero = function($idtercero){
    $.ajax({
    					data : {'idtercero':$idtercero},
         dataType: 'html',
         url:      '/tron/informes/Saldos_Comisiones_Puntos_x_IdTercero/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor-datos-informe').html('');
				         $('.contenedor-datos-informe').html(respuesta);
				      }
				  });
}

var Mostar_Compra_Tron_x_IdTercero = function($idtercero,$anio){
	    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Productos_Tron_x_IdTercero/'+$idtercero+'/'+$anio,
         type:     'post',
				    success:  function (respuesta){
				         $('.contenido-reporte').html('');
				         $('.contenido-reporte').html(respuesta);
				      }
				  });
}

var Mostar_Compra_Otros_x_IdTercero = function($idtercero,$anio){
	    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Otros_Productos_x_IdTercero/'+$idtercero+'/'+$anio,
         type:     'post',
				    success:  function (respuesta){
				         $('.contenido-reporte').html('');
				         $('.contenido-reporte').html(respuesta);
				      }
				  });
}

var Mostar_Compra_Industriales_x_IdTercero = function($idtercero,$anio){
	    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Productos_Industriales_x_IdTercero/'+$idtercero+'/'+$anio,
         type:     'post',
				    success:  function (respuesta){
				         $('.contenido-reporte').html('');
				         $('.contenido-reporte').html(respuesta);
				      }
				  });
}

var Mostar_Compra_Totales_x_IdTercero = function($idtercero,$anio){
	    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Totales_x_IdTercero/'+$idtercero+'/'+$anio,
         type:     'post',
				    success:  function (respuesta){
				         $('.contenido-reporte').html('');
				         $('.contenido-reporte').html(respuesta);
				      }
				  });
}

 //  Menu deslizante  =
 $('.perfil_menu_link').on('click',function(){
     $('#columna_izquierdad').animate({'margin-left':'-600px'},700);
	    $('#btn_mostrar').fadeIn(600);
     $('#columan_derecha').attr('class','col-lg-12');
});

// BTn = mostrar menu
$('#btn_mostrar').on('click',function(){
	    $('.contenido-reporte').html('');
	    $('.contenedor_cuenta').html('');
	    $('#columna_izquierdad').animate({'margin-left':'0px'});
	    $('#btn_mostrar').fadeOut(400);
	    $('#columan_derecha').attr('class','col-lg-9' );

});

$('#mi-perfil').on('click',function(){
	$('.tabs_click').css('background','#B7B7B7');
	$(this).css('background','#003E90');
   $('.cabezera').css('display','none');
    $('#cabezera_perfil').css('display','block');
    $('.contenedor_cuenta').html('');
    $('#plan_seleccionado').click();
});


// Informes
$('#informes_pedidos').on('click',function(){
				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
	   $('.cabezera').css('display','none');
    $('#cabezera_informes').css('display','block');
    $('.contenedor_cuenta').html('');
    $('#informes-pedidos-realizados').click();
});

// Favoritos
$('#favoritos').on('click',function(){

				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
	   $('.cabezera').css('display','none');
    $('#cabezera_favoritos').css('display','block');
    $('.contenedor_cuenta').html('');

});

$('li .perfil_menu_link').on('click',function(){
				$('.perfil_menu_link').css('background','#B7B7B7');
				$(this).css('background','#003E90');
});




// Menu sueprior
$('li .perfil_menu_link').on('click',function(){
				$('.perfil_menu_link').css('background','#B7B7B7');
				$(this).css('background','#003E90');
});

var Mostrar_Direcciones_x_IdTercero = function($idtercero){

  $.ajax({
      data:  {'idtercero':$idtercero,'json':0},
      dataType: 'html',
      url:      '/tron/terceros/Direcciones_Despacho_x_IdTercero/',
      type:     'post',
      success:  function (resultado){
          $('.conteneror-direcciones').html('');
          $('.conteneror-direcciones').html(resultado);
      }
   });
}

var Direccion_Validar_Datos = function( $idtercero){
		 var $Texto ='';
			var 		$destinatario         = $('#new_destinario').val();
			var 		$iddpto               = $('#new_iddpto').val();
			var 		$direccion            = $('#new_direccion').val();
			var   $barrio 												  = $('#new_barrio').val();
			var 		$telefono             = $('#new_celular1').val();
			var 		$idmcipio             = $('.btn_atualizar_direccion').attr('idmcipio');
			var 		$iddireccion_despacho = $('.btn_atualizar_direccion').attr('iddireccion-despacho');
			var   $Parametros										 = '';



			if ($.trim($destinatario)==''){
							$Texto = 'Debe especificar el destanario de la dirección. <br>';
			}
			if ($idmcipio == 0){
				$Texto =$Texto +  'Debe seleccionar el departamento y municipio para los despachos. <br>';
			}
			if ($.trim($direccion)==''){
							$Texto = $Texto + 'Debe especificar la dirección para el despacho. <br>';
			}
			if ($.trim($barrio)==''){
							$Texto = $Texto + 'Indique el barrio a donde se harán los despachos. <br>';
			}
			if ($.trim($telefono)==''){
							$Texto = $Texto + 'Registre un número de teléfono. <br>';
			}
			if  ( $.trim($Texto)==''){
									$Parametros = {'iddireccion_despacho':$iddireccion_despacho,'destinatario':$destinatario, 'idmcipio':$idmcipio,
                     	 'direccion':$direccion , 'telefono':$telefono, 'barrio':$barrio,'destinatario':$destinatario ,
                     	 'idtercero': $idtercero  };
			}else{
							$Parametros = {'iddireccion_despacho':-1};
              new Messi($Texto,
                    {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                    buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]
                   });

			}
				return $Parametros;
		}

var  Direccion_Usuario_Grabar = function(Parametros){

  $.ajax({
      data:  Parametros,
      dataType: 'json',
      url:      '/tron/terceros/Direcciones_Despacho_Grabar_Actualizar/',
      type:     'post',
      async:     false,
      success:  function (server)  {
          if (server.Respuesta == "OK") {

          			return 'OK';

          }else{
              new Messi(server.Respuesta,
                    {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                    buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]
                   });
              return 'No_OK';
          }
      }
   });
}
// BOTON ACTUALIZAR LA DIRECCIÓN
$('.contenedor_cuenta').on('click','.btn_atualizar_direccion',function(){
		 var $idtercero = $(this).attr('idtercero');
			var $Parametros = '';
			$Parametros  = Direccion_Validar_Datos( $idtercero);
			if ( $Parametros.iddireccion_despacho != -1 ){
					$Rsultado = Direccion_Usuario_Grabar($Parametros);
					if ( $Rsultado = 'OK'){
										Mostrar_Direcciones_x_IdTercero($idtercero );
											$('.btn_atualizar_direccion').attr('iddireccion-despacho',0);
											$('.btn_atualizar_direccion').attr('idmcipio',0 );
											$('#new_destinario').val('');
											$('#new_direccion').val('');
											$('#new_barrio').val('');
											$('#new_celular1').val('');
											$('#dpto_actual').html('');
											$('#mcipio_actual').html('');
							}
			}
});

// Seleccion de direccion a atualizar
$('.contenedor_cuenta').on('click','.direcciones_a_atualizar',function(event){
				event.preventDefault();
				var 		$destinatario         = $(this).attr('destinatario');
				var 		$iddpto               = $(this).attr('iddpto');
				var 		$idmcipio             = $(this).attr('idmcipio');
				var 		$direccion            = $(this).attr('direccion');
				var   $barrio 												  = $(this).attr('barrio');
				var 		$telefono             = $(this).attr('telefono');
				var 		$nommcipio_despacho   = $(this).attr('nommcipio-despacho');
				var 		$nomdpto              = $(this).attr('nomdpto');
				var 		$iddireccion_despacho = $(this).attr('iddireccion-despacho');
				var   $idtercero   								 = $(this).attr('idtercero');


				$('#new_destinario').val($destinatario);
			 $('#dpto_actual').html('Departamento Actual :' +$nomdpto  );
			 $('#mcipio_actual').html('Municpio Actual :' +$nommcipio_despacho  );
			 $('#new_direccion').val($direccion);
			 $('#new_barrio').val($barrio );
			 $('#new_celular1').val($telefono);
			 $('.btn_atualizar_direccion').attr('iddireccion-despacho',$iddireccion_despacho);
			 $('.btn_atualizar_direccion').attr('idmcipio',$idmcipio );
			 $('.btn_atualizar_direccion').attr('idtercero',$idtercero );

	   $('.direcciones_a_atualizar').css('background','white');
	   $('.direcciones_a_atualizar').css('color','inherit');
	   $(this).css('background','#003E90');
	   $(this).css('color','white');
});

// BOTON CREAR NUEVA DIRECCION
$('.contenedor_cuenta').on('click','.btn_nueva_direccion',function(){
				$('#new_destinario').val('');
			 $('#dpto_actual').html('');
			 $('#mcipio_actual').html('');
			 $('#new_direccion').val('');
			 $('#new_barrio').val('' );
			 $('#new_celular1').val('');
			 $('#new_destinario').focus();
			 $('.btn_atualizar_direccion').attr('iddireccion-despacho','0');
			 $('.btn_atualizar_direccion').attr('idmcipio','0');
});

$('.contenedor_cuenta').on('change','#new_idmcipio',function(){
	$idmcipio  = $(this).val();
	$('.btn_atualizar_direccion').attr('idmcipio',$idmcipio );
});

//  pases de cortesia => pases premium
$('.contenedor_cuenta').on('click','#ver_pases_premiun',function(){
	   $('#pases_cortesia_vista').fadeOut();
	   $('#pases_premium_vista').fadeIn();
});

$('.contenedor_cuenta').on('click','#ver_pases_cortesia',function(){
	   $('#pases_premium_vista').fadeOut();
	   $('#pases_cortesia_vista').fadeIn();
});

// vistas cargadas con ajax
$('#plan_seleccionado').on('click',function(){
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/plan_seleccionado/',
         type:     'post',
				    success:  function (respuesta)
				      {
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#perfil-datos-personales').on('click',function(){
		  $Opciones_Seleccionada ='DATOS_PERSONALES';
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/modificacion_datos/',
         type:     'post',
				    success:  function (respuesta)
				      {
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#tabla_comisiones').on('click',function(){
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/tabla_comisiones/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#recomendar_amigo').on('click',function(){
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/recomendar_amigo/',
         type:     'post',
				    success:  function (respuesta) {
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#pases_cortesia').on('click',function(){
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/pases_cortesia/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});


// Mostrar menu = vista previa / imprimir
$('#convenio_comercial').on('click',function(){
    $('.menu_convenio').show();
});

// funcion = esconde el menu de convenio comercial por medio del cierre de la ventana modal.
$('#cerrar_moda_convenio_comercial').on('click',function(){
	$('#ventana_modal_convenio_comercial').fadeOut();
	$('.menu_convenio').hide();
});

// mostrar pdf = convenio comercial
$('#convenio_pdf').on('click',function(){
    $('.contenedor_cuenta').html('');
	$('.contenedor_cuenta').html('Un momento por favor... estamos generando el archivo...');
	// window.location.href  = '/tron/pdf/Convenio_Comercial';
	window.open('/tron/pdf/Convenio_Comercial');
	$('.contenedor_cuenta').html('');
	$('.menu_convenio').hide();
});



$('#informes-pedidos-realizados').on('click',function(){
				$Opciones_Seleccionada ='PEDIDOS_REALIZADOS';
    $.ajax({
         dataType: 'html',
         url:      '/tron/pedidos/historial_mis_pedidos/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});


$('#informes-estado-cuenta').on('click',function(){
    $Opciones_Seleccionada ='ESTADO_CUENTA';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Saldos_Comisiones_Puntos/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#informes-participacion-red').on('click',function(){
    $Opciones_Seleccionada = 'PARTICIPACION_EN_RED';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Participacion_En_La_Red/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});


$('#informes-amigos-presentados').on('click',function(){
    $Opciones_Seleccionada = 'AMIGOS_PRESENTADOS';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Amigos_Presentados/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#informes-clientes-presentados').on('click',function(){
    $Opciones_Seleccionada = 'CLIENTES_PRESENTADOS';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Clientes_Presentados/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

//$('.contenedor_cuenta').on('click','.usu-1',function(){
	//$Usuario_Seleccionado = $(this).attr('id');


$('#compras_tron_link').on('click',function(){
		$Opciones_Seleccionada = 'COMPRAS_TRON';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Productos_Tron/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#compras_otros_link').on('click',function(){
		$Opciones_Seleccionada = 'COMPRAS_TRON';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Otros_Productos/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#compras_industriales_link').on('click',function(){
		$Opciones_Seleccionada = 'COMPRAS_INDUSTRIALES';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Productos_Industriales/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#compras_totales_link').on('click',function(){
		$Opciones_Seleccionada = 'COMPRAS_TOTALES';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Compras_Totales/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});


$('#informes-red-usuarios').on('click',function(){
    $Opciones_Seleccionada = 'RED_USUARIOS';
    $.ajax({
         dataType: 'html',
         url:      '/tron/informes/Mi_Red_de_Usuarios/',
         type:     'post',
				    success:  function (respuesta){
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

/* MODIFICACION DE LA FORMA DEL PAGO DEL PEDIDO.
			SE INHABILITA PORQUE A LA FECHA ( JULIO 02 DE 2015)
			SÓLO TENEMOS UNA FORMA DE PAGO
$('.contenedor_cuenta').on('click','.historial-cambiar-forma-pago',function(){
		$idpedido = $(this).attr('idpedido');
		 window.location.href = "/tron/carrito/Finalizar_Pedido_Forma_Pago/"+$idpedido;
});
*/


$('.contenedor_cuenta').on('click','.historial-eliminar-pedido', function(){
		 var $idtercero             = $(this).attr('idtercero');
			var $idpedido              = $(this).attr('idpedido');
			var $comisiones_utilizadas = $(this).attr('comisiones-utilizadas');
			var $puntos_utilizados     = $(this).attr('puntos-utilizados');
			var $numero_pedido         = $(this).attr('numero-pedido');
			var $Parametros = '';
	  new Messi('<h4>Confirma que desea borrar el pedido número : ' + $numero_pedido + ' ?</h4><br>',
       {title: 'Confirmación del Usuario',titleClass: 'info',modal: true,
       buttons: [
                 {id: 0, label: 'Si, Deseo eliminar el pedido.', val: 'Y',class: 'btn-danger'},
                 {id: 1, label: 'No, Espere. He presionado mal.', val: 'N', class: 'btn-success'}
                 ],
       callback: function(val) {
         if (val=='Y') {
         			$Parametros ={'idtercero':$idtercero ,'idpedido':$idpedido, 'comisiones_utilizadas':$comisiones_utilizadas,
         															  'puntos_utilizados':$puntos_utilizados,'numero_pedido':$numero_pedido };
         			Eliminar_Pedido($Parametros);
         }
       }});

});



$('.contenedor_cuenta').on('click','.usu-1',function(){
	$Usuario_Seleccionado = $(this).attr('id');
	$codigousuario        = $(this).attr('codigousuario');

	 Activar_Usuarios ($Usuario_Seleccionado );
	 Parametros ={'idtercero':$Usuario_Seleccionado};
	  if ( $Opciones_Seleccionada  == 'PEDIDOS_REALIZADOS'){
  			Mostrar_Pedidos_Usuario(Parametros);
  		}
    if ( $Opciones_Seleccionada  == 'ESTADO_CUENTA'){
  			Mostrar_Estado_Cuenta_x_idTercero($Usuario_Seleccionado );
  		}

  	if ( $Opciones_Seleccionada == 'PARTICIPACION_EN_RED'){
  			 $anio = $('#anio-consulta').val();
  				Mostrar_Participacion_en_Red($Usuario_Seleccionado,$anio );
  	}

  	if ( $Opciones_Seleccionada == 'AMIGOS_PRESENTADOS'){
  			 $anio = $('#anio-consulta').val();
  				Mostrar_Amigos_Presentados($Usuario_Seleccionado,$anio );
  	}

  	if ( $Opciones_Seleccionada == 'COMPRAS_TRON'){
  			 $anio = $('#anio-consulta').val();
  				Mostar_Compra_Otros_x_IdTercero($Usuario_Seleccionado,$anio );
  	}
  	if ( $Opciones_Seleccionada == 'COMPRAS_OTROS'){
  			 $anio = $('#anio-consulta').val();
  				Mostar_Compra_Tron_x_IdTercero($Usuario_Seleccionado,$anio );
  	}
  	if ( $Opciones_Seleccionada == 'COMPRAS_INDUSTRIALES'){
  			 $anio = $('#anio-consulta').val();
  				Mostar_Compra_Industriales_x_IdTercero($Usuario_Seleccionado,$anio );
  	}
  	if ( $Opciones_Seleccionada == 'COMPRAS_TOTALES'){
  			 $anio = $('#anio-consulta').val();
  				Mostar_Compra_Totales_x_IdTercero($Usuario_Seleccionado,$anio );
  	}
  	if ( $Opciones_Seleccionada == 'CLIENTES_PRESENTADOS'){
  				Mostar_Clientes_x_IdTercero($codigousuario);
  	}


			//compras_otros_link
  	if ( $Opciones_Seleccionada == 'DATOS_PERSONALES'){
  				Mostrar_Direcciones_x_IdTercero($Usuario_Seleccionado );
  				$('.btn_atualizar_direccion').attr('idtercero',$Usuario_Seleccionado);
  	}
});




