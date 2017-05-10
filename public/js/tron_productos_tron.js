
function Imprimir_Totales_Carrito_Header(resultado) 	{

		function paraLimpiarOld(valor){
			valor 	  = valor.replace('$','');
			valor 	  = valor.replace(' ','');
			valor 	  = parseInt(valor.replace('.',''));
			return valor;
		}

		var old_value1 	= paraLimpiarOld($('#precio-tron-ropa').text());
		var old_value2 	= paraLimpiarOld($('#precio-tron-banios').text());
		var old_value3 	= paraLimpiarOld($('#precio-tron-pisos').text());
		var old_value4 	= paraLimpiarOld($('#precio-tron-loza').text());


	   $Total_Venta_Ocasional.html(resultado.SubTotal_Pedido_Ocasional);
	   $Total_Venta_Tron.html(resultado.SubTotal_Pedido_Amigos);

	   $('#tron_descuento').html(resultado.descuento_especial_porcentaje);
	   $('#tron_descuento_porciento').html(resultado.descuento_especial);

	   $('#Total_Venta_Ocasional').html(resultado.SubTotal_Pedido_Ocasional);
	   $('#Total_Venta_Tron').html(resultado.SubTotal_Pedido_Amigos);

	   $('#Total_Venta_Ocasional_Resumen').html(resultado.pv_ocas_resumen);
	   $('#Total_Venta_Tron_Resumen').html(resultado.pv_tron_resumen);



		function paraLimpiar(valor){
			valor 	  = valor.replace('$','');
			valor 	  = valor.replace(' ','');
			valor 	  = parseInt(valor.replace('.',''));
			return valor;
		}
		function paraLimpiar2(valor22){
			valor22 	  = valor22.replace('$','');
			valor22 	  = valor22.replace(' ','');
			valor22 	  = parseInt(valor22.replace('.',''));
			return valor22;
		}
		function paraLimpiar3(valor33){
			valor33 	  = valor33.replace('$','');
			valor33 	  = valor33.replace(' ','');
			valor33 	  = parseInt(valor33.replace('.',''));
			return valor33;
		}
		function paraLimpiar4(valor44){
			valor44 	  = valor44.replace('$','');
			valor44 	  = valor44.replace(' ','');
			valor44 	  = parseInt(valor44.replace('.',''));
			return valor44;
		}
		function paraMostrar(valor111, inc10111, turn111){
			var iinn1 = parseInt(valor111) + parseInt(Math.round(inc10111*turn111)); return "$"+iinn1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
		function paraMostrar2(valor222, inc10222, turn222){
			var iinn2 = parseInt(valor222) + parseInt(Math.round(inc10222*turn222)); return "$"+iinn2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
		function paraMostrar3(valor333, inc10333, turn333){
			var iinn3 = parseInt(valor333) + parseInt(Math.round(inc10333*turn333));

			return "$"+iinn3.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
		function paraMostrar4(valor444, inc10444, turn444){
			var iinn4 = parseInt(valor444) + parseInt(Math.round(inc10444*turn444));
			return "$"+iinn4.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
		function paraFinalizar(valorRec){
			return "$"+valorRec.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

	   if ( resultado.vr_unitario_ropa != '$ 0'){

			$('#vr_unitario_ropa').html(resultado.vr_unitario_ropa);

			var valor 		= paraLimpiar(resultado.vr_unitario_ropa);
			var new_value 	= paraLimpiar($('#precio-tron-ropa').text());
			var ot_val 		= valor-new_value;
			var inc10 		= ot_val / 10;



			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 1)); }, 50);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 2)); }, 100);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 3)); }, 150);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 4)); }, 200);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 5)); }, 250);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 6)); }, 300);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 7)); }, 350);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 8)); }, 400);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraMostrar(valor, inc10, 9)); }, 450);
			setTimeout(function(){ $('#precio-tron-ropa').html(paraFinalizar(valor)); }, 500);


			if(valor != old_value1){
				$( "#bIONPrd1 #precio-tron-ropa" ).stop().animate({ color : '#003e90' }, 500, function() {
					$( "#bIONPrd1 #precio-tron-ropa" ).animate({ color : '#f89008' }, 600);
				});
			}

	  	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	  	if ( resultado.vr_unitario_banios != '$ 0'){

			$('#vr_unitario_banios').html(resultado.vr_unitario_banios);

			var valor2 		= paraLimpiar2(resultado.vr_unitario_banios);
			var new_value2 	= paraLimpiar2($('#precio-tron-banios').text());
			var ot_val2 	= valor2-new_value2;
			var inc102 		= ot_val2 / 10;



			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 1)); }, 50);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 2)); }, 100);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 3)); }, 150);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 4)); }, 200);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 5)); }, 250);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 6)); }, 300);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 7)); }, 350);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 8)); }, 400);
			setTimeout(function(){ $('#precio-tron-banios').html(paraMostrar2(valor2, inc102, 9)); }, 450);
			setTimeout(function(){ $('#precio-tron-banios').html(paraFinalizar(valor2)); }, 500);


			if(valor2 != old_value2){
				$( "#bIONPrd2 #precio-tron-banios" ).stop().animate({ color : '#003e90' }, 500, function() {
					$( "#bIONPrd2 #precio-tron-banios" ).animate({ color : '#f89008' }, 600);
				});
			}


	  	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	  	if ( resultado.vr_unitario_pisos != '$ 0'){

			$('#vr_unitario_pisos').html(resultado.vr_unitario_pisos);

			var valor3 		= paraLimpiar3(resultado.vr_unitario_pisos);
			var new_value3 	= paraLimpiar3($('#precio-tron-pisos').text());
			var ot_val3 	= valor3-new_value3;
			var inc103 		= ot_val3 / 10;



			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 1)); }, 50);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 2)); }, 100);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 3)); }, 150);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 4)); }, 200);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 5)); }, 250);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 6)); }, 300);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 7)); }, 350);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 8)); }, 400);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraMostrar3(valor3, inc103, 9)); }, 450);
			setTimeout(function(){ $('#precio-tron-pisos').html(paraFinalizar(valor3)); }, 500);


			if(valor3 != old_value3){
				$( "#bIONPrd3 #precio-tron-pisos" ).stop().animate({ color : '#003e90' }, 500, function() {
					$( "#bIONPrd3 #precio-tron-pisos" ).animate({ color : '#f89008' }, 600);
				});
			}

	  	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	  	if ( resultado.vr_unitario_loza != '$ 0'){

			$('#vr_unitario_loza').html(resultado.vr_unitario_loza);

			var valor4 		= paraLimpiar4(resultado.vr_unitario_loza);
			var new_value4 	= paraLimpiar4($('#precio-tron-loza').text());
			var ot_val4 	= valor4-new_value4;
			var inc104 		= ot_val4 / 10;



			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 1)); }, 50);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 2)); }, 100);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 3)); }, 150);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 4)); }, 200);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 5)); }, 250);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 6)); }, 300);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 7)); }, 350);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 8)); }, 400);
			setTimeout(function(){ $('#precio-tron-loza').html(paraMostrar4(valor4, inc104, 9)); }, 450);
			setTimeout(function(){ $('#precio-tron-loza').html(paraFinalizar(valor4)); }, 500);

			if(valor4 != old_value4){
				$( "#bIONPrd4 #precio-tron-loza" ).stop().animate({ color : '#003e90' }, 500, function() {
					$( "#bIONPrd4 #precio-tron-loza" ).animate({ color : '#f89008' }, 600);
				});
			}

	  	}
	  $('.resumen_tron').load('../mostrar_resumen_producto');
	}


function Agregar_Producto_Tron_a_Carrito(Parametros)
{
		$.ajax({
					data:  Parametros,
					dataType: 'json',
					url:      '/carrito/Agregar_Producto',
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
					url:      '/carrito/Borrar_Producto_Carrito',
					type:     'post',
     success:  function (resultado)
    	 {
    	 		Imprimir_Totales_Carrito_Header( resultado );

    	 		window.location.href = "/carrito/mostrar_carrito/2";
    	 }
					});
}


// EVENTOS SOBRE PRODUCTOS TRON - CONTROL QUE TIENE LA CANTIDAD DE PRODUCTOS COMPRADOS
//$('#contenido-productos').on('keyup','.CantProdCompraTronFragancias',function(){

$('.CantProdCompraTronFragancias ').on('keyup',function(){
			$IdProducto  =  $(this).attr("idproducto");
			$es_tron     =  $(this).attr("es-tron");
			$es_tron_acc =  $(this).attr("es-tron-acc");
			$Cantidad    =  $(this).val();
			$Parametros  = {'IdProducto':$IdProducto , 'CantidadComprada':1,'es_tron':$es_tron, 'es_tron_acc':$es_tron_acc};

			// AGREGAR PRODUCTO TRON AL CARRITO
			Agregar_Producto_Tron_a_Carrito ( $Parametros );


});



$('.resumen_tron').on('click','#btn-borrar-resumen', function(){
	var $idproducto  = 0;
	var $cantidad 		 = 0;
	$idproducto 				 = $(this).attr('idproducto');
	$cantidad  						= $(this).attr('cantidad');
 $Parametros = {'IdProducto':$idproducto , 'Cantidad':$cantidad };
	Borrar_Producto_de_Carrito($Parametros );


}) ;

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


$('.contenedor-producto').on('click','.borrar-producto',function(){
		$idproducto = $(this).attr('idproducto');
		$cantidad   = $(this).attr('cantidad');
		$Parametros = {'IdProducto':$idproducto , 'Cantidad':$cantidad };
 	Borrar_Producto_de_Carrito($Parametros );
});



// Ventana Modal => Etiqueta del producto

				// Abrir => Ventana Modal Producto1
				$('#cont-img-producto-ropa1').on('click',function(){
					     $('#ventana_modal_ropa').fadeIn();
				});

				// Cerrar => Ventana Modal Producto1
				$('.ventana_modal').on('click',function(){
					     $('#ventana_modal_ropa').fadeOut();
				});



				// Abrir => Ventana Modal Producto2
				$('#cont-img-producto-banos').on('click',function(){
					     $('#ventana_modal_banos').fadeIn();
				});

				// Cerrar => Ventana Modal Producto2
				$('.ventana_modal').on('click',function(){
					     $('#ventana_modal_banos').fadeOut();
				});


				// Abrir => Ventana Modal Producto3
				$('#cont-img-producto-pisos').on('click',function(){
					     $('#ventana_modal_pisos').fadeIn();
				});

				// Cerrar => Ventana Modal Producto3
				$('.ventana_modal').on('click',function(){
					     $('#ventana_modal_pisos').fadeOut();
				});

				// Abrir => Ventana Modal Producto4
				$('#cont-img-producto-loza').on('click',function(){
					     $('#ventana_modal_loza').fadeIn();
				});

				// Cerrar => Ventana Modal Producto4
				$('.ventana_modal').on('click',function(){
					     $('#ventana_modal_loza').fadeOut();
				});


