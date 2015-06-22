// Funtiones tabs
// TABS  =  mi perfil , informes , favoritos
var $Opciones_Seleccionada = '';

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


$('#mi_perfil').on('click',function(){
				$('.contenedor_cuenta').html('');
	   $('.tabs_click').css('background','#B7B7B7');
	   $(this).css('background','#003E90');
	  	$('#con-row-menu').css('margin-bottom','0px');
	   $('.cabezera').css('display','none');
    $('#cabezera_perfil').css('display','block');
});

// Informes
$('#informes_pedidos').on('click',function(){
		  $('.contenedor_cuenta').html('');
				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','50px');
	   $('.cabezera').css('display','none');
    $('#cabezera_informes').css('display','block');
});

// Favoritos
$('#favoritos').on('click',function(){
		 $('.contenedor_cuenta').html('');
				$('.tabs_click').css('background','#B7B7B7');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','0px');
	   $('.cabezera').css('display','none');
    $('#cabezera_favoritos').css('display','block');
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


$('.contenedor_cuenta').on('click','.usu-1',function(){
	$Usuario_Seleccionado = $(this).attr('id');
	 Activar_Usuarios ($Usuario_Seleccionado );
	 Parametros ={'idtercero':$Usuario_Seleccionado};
	  if ( $Opciones_Seleccionada  == 'PEDIDOS_REALIZADOS'){
  			Mostrar_Pedidos_Usuario(Parametros);
  		}
  	if ( $Opciones_Seleccionada == 'PARTICIPACION_EN_RED'){
  				Mostrar_Participacion_en_Red($Usuario_Seleccionado,2015);
  	}
});


