//EXPLICACION DE LAS DOS COLUMNAS DENTRO DEL PEDIDO
$('.explicacion-columnas').on('click', function(){
	$logueado 							  = $('#contenido').attr('logueado');
	 $('#modal_explica_columnas_pedido').modal('show');
})


//	AGOSTO 05 2016
// MOSTRAR VENTANA DE CUMPLEAÑOS.
//======================================
$('#modal_cumpleanios').modal('show');

//CIERRE DE LA VENTANA DE CUMPLEAÑOS
//======================================
$('.cerrar_cumpleanios').on('click', function(){
		 $.ajax({
       data:'',
       dataType: '',
       url: '/tron/index/ocular_mjs_cumpleanios/',
       type: 'post',
         success:  function (resultado) {
													window.location.href = "/tron/index/";
          }
       });
		});









