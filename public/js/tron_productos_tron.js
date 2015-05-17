
function Imprimir_Totales_Carrito_Header(resultado)
	{
		  $Total_Venta_Ocasional.html(resultado.SubTotal_Pedido_Ocasional);
	   $Total_Venta_Tron.html(resultado.SubTotal_Pedido_Amigos);
	}


function Agregar_Producto_Tron_a_Carrito(Parametros)
{
		$.ajax({
					data:  Parametros,
					dataType: 'json',
					url:      '/tron/carrito/Agregar_Producto/',
					type:     'post',
     success:  function (resultado)
    	 {
    	 		Imprimir_Totales_Carrito_Header(resultado);
    	 }

					});
}

function Borrar_Producto_de_Carrito(Parametros)
{
		$.ajax({
					data:  Parametros,
					dataType: 'json',
					url:      '/tron/carrito/Borrar_Producto_Carrito/',
					type:     'post',
     success:  function (resultado)
    	 {

    	 		Imprimir_Totales_Carrito_Header(resultado);
    	 }
					});
}


// EVENTOS SOBRE PRODUCTOS TRON - CONTROL QUE TIENE LA CANTIDAD DE PRODUCTOS COMPRADOS
//$('#contenido-productos').on('keyup','.CantProdCompraTronFragancias',function(){
$('.CantProdCompraTronFragancias').on('keyup',function(){
			$IdProducto  =  $(this).attr("idproducto");
			$es_tron     =  $(this).attr("es-tron");
			$es_tron_acc =  $(this).attr("es-tron-acc");
			$Cantidad    =  $(this).val();
			$Parametros  = {'IdProducto':$IdProducto , 'CantidadComprada':1,'es_tron':$es_tron, 'es_tron_acc':$es_tron_acc};

			Agregar_Producto_Tron_a_Carrito ($Parametros);

			// AGREGAR PRODUCTO TRON AL CARRITO
});



$('.btns-carritoTronMas').on('click',function(){
		var $Input  = '#cantidad';
		$IdProducto = $(this).attr("id");
		$Input      = $Input+$IdProducto;
		$($Input).keyup();
});

// AL PRESIONAR EN EL BOTON - SE EJECTUA LO CONTENIDO EN EL INPUT TEX
$('.btns-carritoTronMenos').on('click',function(){
		var $Input  = '#cantidad';
		$IdProducto = $(this).attr("id");
  $Parametros = {'IdProducto':$IdProducto , 'Cantidad':1};
 	Borrar_Producto_de_Carrito($Parametros );
});

// Ventana Modal => Etiqueta del producto

				// Abrir => Ventana Modal
				$('#cont-img-producto-ropa').on('click',function(){
					     $('#ventana_modal').fadeIn();
				});

				// Cerrar => Ventana Modal
				$('.ventana_modal').on('click',function(){
					     $('#ventana_modal').fadeOut();
				});
