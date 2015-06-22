// Funtiones tabs

// TABS  =  mi perfil , informes , favoritos
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



// Seleccion de direccion a atualizar
$('#informes-pedidos-realizados').on('click',function(){

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
