// Funtiones tabs

// Mi perfil
$('#mi_perfil').on('click',function(){

	   $('.tabs_click').css('background','#85ABDD');
	   $(this).css('background','#003E90');
	  	$('#con-row-menu').css('margin-bottom','0px');
	   $('.cabezera').css('display','none');
    $('#cabezera_perfil').css('display','block');
});

// Informes
$('#informes_pedidos').on('click',function(){
				$('.tabs_click').css('background','#85ABDD');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','50px');
	   $('.cabezera').css('display','none');
    $('#cabezera_informes').css('display','block');
});

// Favoritos
$('#favoritos').on('click',function(){
				$('.tabs_click').css('background','#85ABDD');
				$(this).css('background','#003E90');
				$('#con-row-menu').css('margin-bottom','0px');
	   $('.cabezera').css('display','none');
    $('#cabezera_favoritos').css('display','block');
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
