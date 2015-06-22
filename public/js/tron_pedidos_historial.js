
var $Usuario_Seleccionado;


var Activar_Usuarios = function($Usuario_Seleccionado){
 $('.barra-usurarios li').each(function(indice, elemento) {
 		$(this).css('background','white');
  	$(this).css('color','black');
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
}



var  Mostrar_Pedidos_Usuario = function(Parametros)
	{

	  $.ajax({
	      data:  Parametros,
	      dataType: 'html',
	      url:      '/tron/pedidos/historial_mis_pedidos_x_tercero/',
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
	      url:      '/tron/pedidos/historial_mis_pedidos_x_idpedido/',
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
	      url:      '/tron/pedidos/Eliminar/',
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


$('.contenedor_cuenta').on('click','.usu-1',function(){
	$Usuario_Seleccionado = $(this).attr('id');
	 Activar_Usuarios ($Usuario_Seleccionado );
	 Parametros ={'idtercero':$Usuario_Seleccionado};
  Mostrar_Pedidos_Usuario(Parametros);
});


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


$('.contenido-historial-pedidos').on('click','.historial-eliminar-pedido', function(){
		 var $idtercero             = $(this).attr('idtercero');
			var $idpedido              = $(this).attr('idpedido');
			var $comisiones_utilizadas = $(this).attr('comisiones-utilizadas');
			var $puntos_utilizados     = $(this).attr('puntos-utilizados');
			var $numero_pedido         = $(this).attr('numero-pedido');
			var $Parametros = '';
	  new Messi('<h4>Confirma que desea borrar el pedido número : ' + $numero_pedido + ' ?</h4><br>',
       {title: 'Confirmación del Usuario',titleClass: 'info',modal: true,
       buttons: [
                 {id: 0, label: 'Si, Deseo elimar el pedido.', val: 'Y',class: 'btn-danger'},
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



