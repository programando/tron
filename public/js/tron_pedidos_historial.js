
var $Usuario_Seleccionado;






var  Mostrar_Pedidos_Usuario = function(Parametros)
	{

	  $.ajax({
	      data:  Parametros,
	      dataType: 'html',
	      url:      '/pedidos/historial_mis_pedidos_x_tercero',
	      type:     'post',
	      success:  function (resultado)
	      {
	      	 $('.contenido-historial-pedidos').html('');
	        $('.contenido-historial-pedidos').html(resultado);
	      }

	   });
	}

var  Mostrar_Detalle_Pedido = function(Parametros)
	{
	  $.ajax({
	      data:  Parametros,
	      dataType: 'html',
	      url:      '/pedidos/historial_mis_pedidos_x_idpedido',
	      type:     'post',
	      success:  function (resultado)
	      {
	      	 $('.contenido-historial-pedidos').html('');
	        $('.contenido-historial-pedidos').html(resultado);
	      }
	   });
	}

 var  Eliminar_Pedido = function(Parametros){
	  $.ajax({
	      data:  Parametros,
	      dataType: 'html',
	      url:      'pedidos/Eliminar',
	      type:     'post',
	      success:  function (resultado)
	      {
	      	 $('.contenido-historial-pedidos').html('');
	        $('.contenido-historial-pedidos').html(resultado);
	      },
	      complete: function(){
	   new Messi('<h4>Pedido eliminado con éxito !</h4><br>',
	       {title: 'Mensaje del Sistema',titleClass: 'info',modal: true,
	       buttons: [
	                 {id: 0, label: 'Cerrar', val: 'Y',class: 'btn-success'}]
	       });

	      }
	   });
	}

$('.contenedor_cuenta').on('click','.pedido', function(){
		$idpedido  = $(this).attr('idpedido');
		Parametros = {'idpedido':$idpedido};
		Mostrar_Detalle_Pedido(Parametros);
});


$('.contenido-historial-pedidos').on('click','.regresar', function(){
		$idtercero = $(this).attr('idtercero');
  Parametros = {'idtercero':$idtercero};
  Mostrar_Pedidos_Usuario(Parametros);
  Activar_Usuarios($idtercero);
});





