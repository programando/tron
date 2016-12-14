
//EXPLICACION DE LAS DOS COLUMNAS DENTRO DEL PEDIDO
$('.explica-precio-especial').on('click', function(){
   $('#carrito-explica-precio-especial').modal('show');
})

//	AGOSTO 05 2016
// MOSTRAR VENTANA DE CUMPLEAÑOS.
//======================================
$('#modal_cumpleanios').modal('show');


//  SEPTIEMBRE 14 2016
//  VENTANA QUE MUESTRA MENSAJE CUANDO ALGUIEN HA CAMBIADO A EMPRESARIO.
//========================================================================
$('#tienda_oferta_x_cambio_status').modal('show');


//  DIC 13 DE 2016
//  VENTANA QUE MUESTRA CON MOTIVO DE VACACIONES COLECTIVAS
//========================================================================
$('#modal_vacaciones').modal('show');



//CIERRE DE LA VENTANA DE CUMPLEAÑOS
//======================================
$('.cerrar_cumpleanios').on('click', function(){
		 $.ajax({
       data:'',
       dataType: '',
       url: '/tron/index/ocultar_mjs_cumpleanios/',
       type: 'post',
         success:  function (resultado) {
						window.location.href = "/tron/productos/categorias_marcas";
          }
       });
		});


//CIERRE DE LA VENTANA DE CUMPLEAÑOS
//======================================
$('.cerrar-msj-vacaciones').on('click', function(){
     $.ajax({
       data:'',
       dataType: '',
       url: '/tron/index/ocultar_mjs_vacaciones/',
       type: 'post',
         success:  function (resultado) {
            window.location.href = "/tron/index";
          }
       });
    });








