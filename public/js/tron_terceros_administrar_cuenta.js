// Funtiones tabs
// TABS  =  mi perfil , informes , favoritos

// Efecto activo de los tabs
$('.contenedor_cuenta').on('click','.tab_link_modif',function(){
					$('.tab_link_modif').css('background','transparent');
					$('.tab_link_modif').css('color','inherit');
					$(this).css('background','#003E90');
					$(this).css('color','white');

});

var $Opciones_Seleccionada = '';
$(function() {
   $('#mi-perfil').click();
   $('#btn_mostrar').click();
});


var Activar_Usuarios = function($Usuario_Seleccionado){
 $('.barra-usurarios li').each(function(indice, elemento) {
 		$(this).css('background','white');
  	$(this).css('color','black');
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
}


var  Mostrar_Participacion_en_Red = function($idtercero,$anio)
	{

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

 //  Menu deslizante  =  barra derecha
 $('.tabs_click').on('click',function(){
	    $('#columna_izquierdad').animate({'margin-left':'-600px'},700);
	    $('#btn_mostrar').fadeIn(600);
     $('#columan_derecha').attr('class','col-lg-12');
});

$('#btn_mostrar').on('click',function(){
	    $('#columna_izquierdad').animate({'margin-left':'0px'});
	    $('#btn_mostrar').fadeOut(400);
	    $('#columan_derecha').attr('class','col-lg-9' );
});

$('#mi-perfil').on('click',function(){

				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','0px');
	   $('.cabezera').css('display','none');
    $('#cabezera_perfil').css('display','block');
    $('.contenedor_cuenta').html('');
    $('#plan_seleccionado').click();
});


// Informes
$('#informes_pedidos').on('click',function(){
				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','50px');
	   $('.cabezera').css('display','none');
    $('#cabezera_informes').css('display','block');
   // $('.contenedor_cuenta').html('');
    $('#informes-pedidos-realizados').click();
});

// Favoritos
$('#favoritos').on('click',function(){

				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','0px');
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

// Seleccion de direccion a atualizar
$('.contenedor_cuenta').on('click','.direcciones_a_atualizar',function(){
	   $('.direcciones_a_atualizar').css('background','#B7B7B7');
	   $(this).css('background','#003E90');
	   $(this).css('color','white');

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

$('#recomendar_amigo').on('click',function(){
    $.ajax({
         dataType: 'html',
         url:      '/tron/terceros/recomendar_amigo/',
         type:     'post',
				    success:  function (respuesta)
				      {
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
				    success:  function (respuesta)
				      {
				         $('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html(respuesta);
				      }
				  });
});

$('#convenio_comercial').on('click',function(){
	$('.contenedor_cuenta').html('');
				         $('.contenedor_cuenta').html('Un momento por favor... estamos generando el archivo...');
	window.location.href  = '/tron/pdf/Convenio_Comercial';
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




$('.contenedor_cuenta').on('click','.usu-1',function(){
	$Usuario_Seleccionado = $(this).attr('id');
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

//compras_otros_link
  	if ( $Opciones_Seleccionada == 'DATOS_PERSONALES'){
  				Mostrar_Direcciones_x_IdTercero($Usuario_Seleccionado );
  	}



});

