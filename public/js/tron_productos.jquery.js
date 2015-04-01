
// DIC 29 2014
// FUNCIONALIDAD PARA QUE AL PRESIONAR EN LOS BOTONES + y -, SE ACTUALICEN LOS PRECIOS
// DE ACUERDO A LA ESCALA

$('#ventana_mensaje').modal('show');

var $Total_Venta_Ocasional = $('.carrito-Total_Parcial_pv_ocasional');
var $Total_Venta_Tron      = $('.carrito-Total_Parcial_pv_tron');
var $Mensaje_Add_Producto  = $('.mensaje-agregar_producto');
var $Imagen_Cargando       = $("#dv-img-cargando-recomendar-producto");

// Recomendacion de productos
var $mensaje_error								 = $('.mensaje-error');



function Mostrar_Mensaje_Producto_Agregado(NomProducto)
{
	 		$Mensaje_Add_Producto.html('<h4><strong>'+ NomProducto +'</strong></h4>' + '<br>'+ "se agregó a tu carrito de compras !!!");
	 		$Mensaje_Add_Producto.fadeIn(1500);
	 		$Mensaje_Add_Producto.fadeOut(3000);
}

function Recomendar_Producto_a_Mi_Amigo_Mensaje(Parametros)
{
					$mensaje_error.html('');
					$mensaje_error.html(Parametros);
}

function Actualizar_Vista_Carrito()
{
	 $('.carrito-compras').load('/tron/carrito/Mostrar_Carrito/2');
}



function Hallar_Precio_Final_Tron(IdProducto,Parametros)
{
				$.ajax({
								data:  Parametros,
								dataType: 'json',
								url:      '/tron/productos/Hallar_Valor_Escala/',
								type:     'post',
	       success:  function (resultado)
	      	 {
	      	 	$("#precio_final_tron"+IdProducto).html(resultado.Precio_Final_Tron);
	      	 }
					});
}

function Agregar_Producto_a_Carrito(NomProducto,Parametros)
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

function Imprimir_Totales_Carrito_Header(resultado)
{
	  $Total_Venta_Ocasional.html(resultado.Total_Parcial_pv_ocasional);
   $Total_Venta_Tron.html(resultado.Total_Parcial_pv_tron);

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
    	 		Actualizar_Vista_Carrito();
    	 }
					});
}

function Recomendar_Producto_a_Mi_Amigo(Parametros)
{
		$Imagen_Cargando.show();

			$.ajax({
					data:  Parametros,
					dataType: 'text',
					url:      '/tron/productos/Recomendar_Producto_a_Amigo/',
					type:     'post',
     success:  function (resultado)
    	 {
    	 		resultado =  resultado.replace("\n", "");
    	 		resultado = resultado.replace(/\s+/g, '');
    	 		if (resultado=='correoOK')
    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('La información del producto ha sido enviada con éxito.');
    	 		}
    	 		if (resultado=='correo_No_OK')
    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('El correo no pudo ser enviado, puede deberse a congestión en el servidor. Favor inténtalo más tarde.');
    	 		}
    	 		if (resultado=='Email_Amigo_No_Ok')
    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('La dirección de correo electrónico parece tener un formato no válido. Por favor verifícala.');
    	 		}
    	 		$Imagen_Cargando.hide();
    	 }
					});


}


// FEBRERO 28 DE 2015... PASOS CARRITO
// BOTÓN SEGUIR COMPRANDO
	$('#contenido-productos').on('click','.btn-seguir-comprando',function(){
	 window.location.href = "/tron";
});

$('#contenido-productos').on('click','.btn-finalizar-pedido',function(){
		window.location.href = "/tron/Carrito/finalizar_pedido_identificacion/";
});

// BOTON ELEGIR FORMA DE PAGO PARA EL PEDIDO
	$('#contenido-productos').on('click','.btn-forma-pago-pedido',function(){
	  window.location.href = "/tron/carrito/Finalizar_Pedido_Forma_Pago";
});




//-------------------------------------------------------------------------------------------------------------------------------------------

// RECOMENDAR PRODUCTO A UN AMIGO
function Recomendar_Producto_a_Mi_Amigo_Validaciones()
{
			var $email_amigo        = $("#email-amigo").val()
			var $nombre_quien_envia = $('#nombre-quien-envia').val();
				if ($email_amigo.length==0)
			{
					Recomendar_Producto_a_Mi_Amigo_Mensaje('Debes registrar el correo electrónico de tu amigo.');
					return false;
			}
			if ($nombre_quien_envia.length==0)
			{
					Recomendar_Producto_a_Mi_Amigo_Mensaje('Debes registrar tu nombre para que tu amigo(a) sepa quién envía la recomendación.');
					return false;
			}
			return true;
}

$('#email-amigo').on('focus',function(){
	 Recomendar_Producto_a_Mi_Amigo_Mensaje('');
})

$('#nombre-quien-envia').on('focus',function(){
	 Recomendar_Producto_a_Mi_Amigo_Mensaje('');
})

$('#mensaje-enviado').on('focus',function(){
	 Recomendar_Producto_a_Mi_Amigo_Mensaje('');
})
//--------------------------------------------------------------------------------------------------


$('#btn-recomendar-producto').on('click',function(){
			var $idproducto         = $(this).attr("id-producto");
			var $mensaje_enviado    = $('#mensaje-enviado').val();
			var $nombre_imagen      = $(this).attr('nombre-imagen');
			var $email_amigo        = $('#email-amigo').val();
			var $nombre_quien_envia = $('#nombre-quien-envia').val();
			var $Datos_Valiados     = Recomendar_Producto_a_Mi_Amigo_Validaciones();
			if ($Datos_Valiados==false)
					{
						return false;
					}

			var Parametros          = {'idproducto':$idproducto,  'email_amigo': $email_amigo , 'nombre_quien_envia':$nombre_quien_envia,
																													 'mensaje_enviado': $mensaje_enviado, 'nombre_imagen':$nombre_imagen };

		 		$Imagen_Cargando.show();
		 			Recomendar_Producto_a_Mi_Amigo(Parametros );

		 })
//  FIN RECOMENDAR PRODUCTO A MI AMIGO





// EVENTOS SOBRE PRODUCTOS TRON
$('#contenido-productos').on('keyup','.CantProdCompraTron',function(){
			$IdProducto    = $(this).attr("idproducto");
			$es_tron       =  $(this).attr("es-tron");
			$es_tron_acc   =  $(this).attr("es-tron-acc");
			$Cantidad      =  $(this).val();
			$NomProducto 	 =  '';
			var Parametros = {"IdProducto" :$IdProducto, "CantidadComprada": $Cantidad, "es_tron": $es_tron , "es_tron_acc": $es_tron_acc };
			Agregar_Producto_a_Carrito($NomProducto,Parametros);
});


$('#contenido-productos').on('click','.btns-carritoTronMas',function(){

});

$('#contenido-productos').on('click','.btns-carritoTronMenos',function(){

});


$('#contenido-productos').on('click','.carrito-resumen-mas',function(){
			$IdProducto    = $(this).attr("idproducto");
			$NomProducto   = $(this).attr("NomProducto");
			var Parametros = {"IdProducto" :$IdProducto, "CantidadComprada": 1};
   Agregar_Producto_a_Carrito($NomProducto,Parametros);
   Actualizar_Vista_Carrito();

})

$('#contenido-productos').on('click','.carrito-resumen-menos',function(){
			$IdProducto    = $(this).attr("idproducto");
			var Parametros = {"IdProducto" :$IdProducto, "Cantidad": 1 };

   Borrar_Producto_de_Carrito(Parametros);
   Actualizar_Vista_Carrito();
})




$('#contenido-productos').on('keyup','.CantProductosComprados',function(){
			var NombreIdCantidad 	= $(this).attr("id");
			var IdInputCantidad 		= NombreIdCantidad.split("cantidad");
			var IdProducto 					  = IdInputCantidad[1];
			var CantidadComprada 	= $("#"+NombreIdCantidad).val();
			// ESCALA - PRECIO ESCALAS 1,2,3
			var IdEscala          = $(this).attr("id-idescala");
			var Precio_Amigo_Tron = $(this).attr("precio-amigo-tron");
			var Precio_Escala_A   = $(this).attr("pv-tron-escala-a");
			var Precio_Escala_B   = $(this).attr("pv-tron-escala-b");
			var Precio_Escala_C   = $(this).attr("pv-tron-escala-c");
			var Parametros 					  =  {
						 																							"IdProducto"								: IdProducto,
																														"CantidadComprada"	 : CantidadComprada,
																														"IdEscala"									 : IdEscala,
																														"Precio_Amigo_Tron" : Precio_Amigo_Tron,
																														"Precio_Escala_A" 		: Precio_Escala_A,
																														"Precio_Escala_B" 		: Precio_Escala_B,
																														"Precio_Escala_C" 		: Precio_Escala_C
																											};


			if (IdEscala==0)								 {  return false;  	}
			Hallar_Precio_Final_Tron(IdProducto,Parametros);
			return false;

});

$('#contenido-productos').on('click','.btns-carrito',function()
{
		var IdBoton     = $(this).attr("id");
		$('#cantidad'+IdBoton	).keyup();
		return false;
});

//$('.boton-agregar-carrito').on('click',function()
	$('#contenido-productos').on('click','.boton-agregar-carrito',function()
{
		var NombreBoton      	= $(this).attr("id");
		var IdInputCantidad 		= NombreBoton.split("cantidad");
  var IdProducto 					  = IdInputCantidad[1];
  var CantidadComprada 	= $("#cantidad"+IdProducto).val();
  var NomProducto       = $("#nomproducto"+IdProducto).text();
  var NomPresentacion   = $("#nompresentacion"+IdProducto).text();
  var es_tron 										= false;
  var es_tron_acc							= false;
  var Parametros 						 = {"IdProducto" :IdProducto, "CantidadComprada": CantidadComprada,"es_tron": es_tron , "es_tron_acc": es_tron_acc	 };
  Agregar_Producto_a_Carrito(NomProducto,Parametros);
  Mostrar_Mensaje_Producto_Agregado(NomProducto);
  return false;
});

$('#contenido-productos').on('click','#tarro-de-eliminar-pedido',function()
	{
		var idproducto = $(this).attr("idproducto");
		var cantidad   = $(this).attr('cantidad');
		var Parametros = {"IdProducto" :idproducto, "Cantidad": cantidad };

  Borrar_Producto_de_Carrito(Parametros);
  Actualizar_Vista_Carrito();
		return false;
	});







// FIN FUNCIONALIDAD BOTONES + y -


// ENE 01 DE 2014
// FUNCIONALIDAD PARA EL ZOOM DE LAS IMAGENES EN LA VISTA AMPLIADA
$("#zoom_03").elevateZoom({
	constrainType				  : "height",
	constrainSize				  : 274,
	zoomType									  : "inner",
	containLensZoom	   : true,
	gallery            :'gallery_01',
	cursor             : 'pointer',
	galleryActiveClass : "active",
	imageCrossfade 			 : false
});

$("#zoom_03").on("click", function(e) {
		var ez = $('#zoom_03').data('elevateZoom');
		$.fancybox(ez.getGalleryList());
		return false;
	}); // FIN FUNCIONES ZOOM EN LA VISTA AMPLIADA.



