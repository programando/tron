
// DIC 29 2014
// FUNCIONALIDAD PARA QUE AL PRESIONAR EN LOS BOTONES + y -, SE ACTUALICEN LOS PRECIOS
// DE ACUERDO A LA ESCALA
var $idtipo_plan_compras_kit =0;
var $kit_comprado            = false;
var $Respuesta_Servidor      ='';



$("#agregar-producto-favoritos").on('click',function(){
	$idproducto = $(this).attr('idproducto');
	$idtercero  = $(this).attr('idtercero');
 				$.ajax({
								dataType: 'text',
								url:      '/productos/Favoritos_Grabar/'+$idproducto+"/"+	$idtercero,
								type:     'post',
	       success:  function (resultado) {
		       new Messi("Producto agregado a tus favoritos !.",
		         {
		         	title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
		           buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-success'}]
		         });
	      	 }
					});

});




/** MUESTRA MENSAJE PARA LA LÍNEA UNDUSTRIAL, SI NO ESTA LOGUEADO **/
$('#modal-industrial').on('click', function(){
	$('#myModal-industrial').modal('show');
})





var $Total_Venta_Ocasional      = $('.carrito-Total_Parcial_pv_ocasional');
var $Total_Venta_Tron           = $('.carrito-Total_Parcial_pv_tron');
var $Mensaje_Add_Producto       = $('.mensaje-agregar_producto');
var $Imagen_Cargando            = $("#dv-img-cargando-recomendar-producto");
//-------------------------------------------------------------------------
var $idtipo_plan_compras                   = 0;
var $usuario_viene_del_registro            = false;
var $usuario_viene_del_registro_es_empresa = false;
var $compra_productos_industriales									= 0;
var $minimo_compras_productos_ta       = 0;

// Recomendacion de productos
var $mensaje_error								 = $('.mensaje-error');



function Mostrar_Mensaje_Producto_Agregado(NomProducto){
	 		$Mensaje_Add_Producto.html('<h4><strong>'+ NomProducto +'</strong></h4>' + '<br>'+ "se agregó a tu carrito de compras !!!");
	 		$Mensaje_Add_Producto.fadeIn(1500);
	 		$Mensaje_Add_Producto.fadeOut(3000);
}

function Recomendar_Producto_a_Mi_Amigo_Mensaje(Parametros){
					$mensaje_error.html('');
					$mensaje_error.html(Parametros);
}

function Actualizar_Vista_Carrito(){
	 //$('.carrito-compras').load('/carrito/Mostrar_Carrito/2');
	  window.location.href = "/carrito/mostrar_carrito/1";

}



function Hallar_Precio_Final_Tron(IdProducto,Parametros){
				$.ajax({
								data:  Parametros,
								dataType: 'json',
								url:      'Hallar_Valor_Escala',
								type:     'post',
	       success:  function (resultado) {
	      	 	$("#precio_final_tron"+IdProducto).html(resultado.Precio_Final_Tron);
	      	 }
					});
}



function Agregar_Producto_a_Carrito(NomProducto,Parametros){
		$.ajax({
					data:  Parametros,
					dataType: 'json',
					url:      '/carrito/Agregar_Producto',
					type:     'post',
     success:  function (resultado) {
    	 }

					});
}

function Imprimir_Totales_Carrito_Header(VrOcasional, VrTron){
   $Total_Venta_Ocasional.html( VrOcasional );
   $Total_Venta_Tron.html( VrTron );
}

function Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Cambio_Plan_Degradar($idtipo_plan_compras){
		$.ajax({
						data:  {'idtipo_plan_compras':$idtipo_plan_compras,'tipo_proceso_en_plan':'DEGRADAR_PLAN'},
						dataType: 'text',
						url:      '/terceros/Cambio_Plan',
						type:     'post',
	     success:  function (resultado) {
	     		}
					});
}

// VERIFICA SI EL USUARIO VIENE DEL REGISTRO INICIAL
function Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario(){
			$.ajax({
					dataType: 'json',
					url:      '/terceros/Verificar_Registro_Inicial_Usuario',
					type:     'post',
					async: false,
	     success:  function (resultado) {
									$idtipo_plan_compras                   = resultado.idtipo_plan_compras;
									$usuario_viene_del_registro            = resultado.usuario_viene_del_registro;
									$usuario_viene_del_registro_es_empresa = resultado.usuario_viene_del_registro_es_empresa;
	     		}
					});

}


function Borrar_Producto(Parametros){
				// BORRA EL PRODUCTO DEL CARRITO
 	$.ajax({
					data:  Parametros,
					dataType: 'json',
					url:      '/carrito/Borrar_Producto_Carrito',
					type:     'post',
     success:  function (resultado)
    	 {
    	 		Actualizar_Vista_Carrito();
    	 }
					});
}


// CONFIRMA SI BORRA EL KIT DE INICIO Y POR LO TANTO CAMBIA DE PLAN
  var Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Confirma_Cambio_Plan = function(idtipo_plan_compras, Parametros){
		var $Texto      = '';
		var $idproducto = Parametros.IdProducto;
		 if ( $idproducto != 10744  ){
		 		Borrar_Producto(Parametros);
		 	return ;
		 }

			if ( (idtipo_plan_compras == 2) || ( idtipo_plan_compras == 3 && $idproducto == 10744) ) {
							$Texto = "<h4>¡¡¡ Opsss !!!</h4> <br>Si eliminas el Kit de Incio no podrás finalizar tu registro y quedarás registrado como: <h4> Comprador Ocasional. </h4>. <br> Deseas continuar ?";
							nuevo_idtipo_plan_compas  = 1;
			}

						new Messi($Texto,{title: 'Mensaje del sistema.',titleClass: 'info',modal: true,
		                buttons: [
		                          {id: 0, label: 'Si, eliminaré el Producto', val: 'Y',class: 'btn-danger' },
		                          {id: 1, label: 'No, quiero mantenerme el en Plan Elegido', val: 'N', class: 'btn-success'}
		                          ],
		                callback: function(val) {
		                			if ( val =='Y'){
		                				Borrar_Producto(Parametros);
		                				Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Cambio_Plan_Degradar(nuevo_idtipo_plan_compas);
		                			}
						          }});
}

// CONFIRMACIÓN DEL CAMBIO DE PLAN PARA EL REGISTRO DE EMPRESAS.....
  var Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Confirma_Cambio_Plan_Empresa = function(idtipo_plan_compras, Parametros){
		var $Texto          = '';
		var $idproducto     = Parametros.IdProducto;
		var $Borrar_Prducto = false ;
		 if ( $idproducto != 10744 && $idproducto != 2071 ){
		 		Borrar_Producto(Parametros);
		 	return ;
		 }
		Consultar_Total_Compra_Productos_Industriales(); /// Consulta que valos ha comprado de productos indstriales

		if ( idtipo_plan_compras == 2 ||  idtipo_plan_compras == 3){
				 if  ( $idproducto == 10744) {
				 		if ( $compra_productos_industriales < $minimo_compras_productos_ta){
				 			$Texto = "<h4>¡¡¡ Opsss !!!</h4> <br>Has elegido eliminar el Kit de Inicio y no has agregado la compra mínima reglamentaria de productos industriales. <br>Si decides continuar quedarás registrado como Comprador Ocasional y te perderás de todos los beneficios de pertenecer a la Red de Usuarios TRON. </h4>. <br> Deseas continuar ?<br><br>";
				 			 nuevo_idtipo_plan_compas  = 1;
									new Messi($Texto,{title: 'Mensaje del sistema.',titleClass: 'info',modal: true,
				                buttons: [ {id: 0, label: 'Si, eliminaré el Producto', val: 'Y',class: 'btn-danger' },
				                           {id: 1, label: 'No, quiero mantenerme el en Plan Elegido', val: 'N', class: 'btn-success'} ],
				                callback: function(val) {
				                			if ( val =='Y'){
				                				Borrar_Producto(Parametros);
				                				Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Cambio_Plan_Degradar(nuevo_idtipo_plan_compas);

				                			}
							      }});
				 			}else{  	Borrar_Producto(Parametros); }}}

		if ( idtipo_plan_compras == 3){
				 if  ( $idproducto == 2071) {
				 		if ( $compra_productos_industriales < $minimo_compras_productos_ta){
				 			$Texto = "<h4>¡¡¡ Opsss !!!</h4> <br>Has elegido eliminar los derechos de inscripción y no has agregado la compra mínima reglamentaria de productos industriales. <br>Si decides continuar quedarás registrado como Cliente de productos TRON y te perderás de todos los beneficios de pertenecer a la Red de Usuarios TRON. </h4>. <br> Deseas continuar ?<br><br>";
				 			 nuevo_idtipo_plan_compas  = 2;
									new Messi($Texto,{title: 'Mensaje del sistema.',titleClass: 'info',modal: true,
									                buttons: [ {id: 0, label: 'Si, eliminaré el Producto', val: 'Y',class: 'btn-danger' },
									                           {id: 1, label: 'No, quiero mantenerme el en Plan Elegido', val: 'N', class: 'btn-success'} ],
									                callback: function(val) {
									                			if ( val =='Y'){
									                				Borrar_Producto(Parametros);
									                				Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Cambio_Plan_Degradar(nuevo_idtipo_plan_compas);
									                			}
							      }});
				 			}else{  	Borrar_Producto(Parametros); }}}

		}






function Borrar_Producto_de_Carrito(Parametros){
				 // junio 08 2015
				// ANTES DE BORRAR VERIFICO SI VIENE DEL REGISTRO Y SI EL PRODUCTO QUE DESEA BORRAR ES EL KIT DE INICIO
				// SE LE ADVIERT QUE SI LO BORRA SE DEGRADARÁ DE PLAN.
				Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario();

				if ($usuario_viene_del_registro == false ){
								Borrar_Producto(Parametros);
				}else{
								if ( $usuario_viene_del_registro_es_empresa == false ){
												Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Confirma_Cambio_Plan($idtipo_plan_compras ,Parametros);
											}else{
												Borrar_Producto_de_Carrito_Verificar_Registro_Inicial_Usuario_Confirma_Cambio_Plan_Empresa($idtipo_plan_compras ,Parametros);
											}
				}

}


function Recomendar_Producto_a_Mi_Amigo(Parametros){
		$Imagen_Cargando.show();

			$.ajax({
					data:  Parametros,
					dataType: 'text',
					url:      '/productos/Recomendar_Producto_a_Amigo',
					type:     'post',
     success:  function (resultado)    	 {
    	 		resultado =  resultado.replace("\n", "");
    	 		resultado = resultado.replace(/\s+/g, '');
    	 		if (resultado=='correo_OK')    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('La información del producto ha sido enviada con éxito.');
    	 		}
    	 		if (resultado=='correo_No_OK')    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('El correo no pudo ser enviado, puede deberse a congestión en el servidor. Favor inténtalo más tarde.');
    	 		}
    	 		if (resultado=='Email_Amigo_No_Ok')    	 		{
    	 			Recomendar_Producto_a_Mi_Amigo_Mensaje('La dirección de correo electrónico parece tener un formato no válido. Por favor verifícala.');
    	 		}
    	 		$Imagen_Cargando.hide();
    	 }
					});


}


var Pedidos_Verificar_Valor_Minimo_A_Pagar = function(){
				$.ajax({
					dataType: 'text',
					url:      '/carrito/Verificar_Valor_Minimo_A_Pagar',
					type:     'post',
					async: false,
     success:  function (Respuesta)    	 {
     		 $Respuesta_Servidor = $.trim(Respuesta);
    	 }
					});
}

var Pedidos_Verficiar_Compra_Minima_Productos_Tron = function(){
				$.ajax({
					dataType: 'text',
					url:      '/carrito/Verificar_Compra_Minima_Productos_Tron',
					type:     'post',
					async: false,
     success:  function (Respuesta)    	 {
     		 $Respuesta_Servidor = $.trim(Respuesta);
    	 }
					});
}






var Pedidos_Verificar_Valor_Minimo_A_Pagar = function(){
				$.ajax({
					dataType: 'text',
					url:      '/carrito/Verificar_Valor_Minimo_A_Pagar',
					type:     'post',
					async: false,
     success:  function (Respuesta)    	 {
     		 $Respuesta_Servidor = $.trim(Respuesta);
    	 }
					});
}


var Pedidos_Verificar_Valor_Minimo_A_Pagar_Procesar_Eleccion_Usuario = function( $Seguir_Comprando, $Usar_Comis_Puntos ){
				$.ajax({
					dataType: 'text',
					url:      '/carrito/Verificar_Valor_Minimo_A_Pagar_Procesar_Eleccion_Usuario/'+ $Seguir_Comprando+'/'+$Usar_Comis_Puntos,
					type:     'post',
					async: false,
     success:  function (Respuesta)    	 {
     		 $Respuesta_Servidor = $.trim(Respuesta);

    	 }
					});
}



// FEBRERO 28 DE 2015... PASOS CARRITO
// BOTÓN SEGUIR COMPRANDO
	$('#contenido-productos').on('click','.btn-seguir-comprando',function(){
	 window.location.href = "/index";
});

$('#contenido-productos').on('click','.btn-finalizar-pedido',function(){
		window.location.href = "/carrito/finalizar_pedido_identificacion";
});

// BOTON ELEGIR FORMA DE PAGO PARA EL PEDIDO
	$('#contenido-productos').on('click','.btn-forma-pago-pedido',function(){
			// Octubre 12 de 2015
		 // Verificar si el pedido tiene un valor mínimo para pagarse por medio de payu-latam
		 var Respuesta_Pedido_Min_PayuLatam;
		 var Respuesta_Copra_Minima_Productos_Tron;

	   Pedidos_Verificar_Valor_Minimo_A_Pagar();
	   		Respuesta_Pedido_Min_PayuLatam = $Respuesta_Servidor ;

	   Pedidos_Verficiar_Compra_Minima_Productos_Tron();
	   		Respuesta_Copra_Minima_Productos_Tron = $Respuesta_Servidor ;


	   if ( Respuesta_Pedido_Min_PayuLatam == 'NO-CUMPLE'){
	   	 $('#modal_no_cumple_pedido_minimo').modal('show');
	   	 return ;
	   	}

	   if ( Respuesta_Copra_Minima_Productos_Tron == 'NO-CUMPLE-COMPRAS-TRON'){
	   		 $('#modal_no_cumple_pedido_minimo_productos_tron').modal('show');
	   		 return ;
	    }


	     // PASAR A LA FORMA DE PAGAR PARA EL PEDIDO
				$.ajax({
						dataType: 'text',
						url:      '/pedidos/Grabar',
						type:     'post',
	     success:  function (resultado)	 {
					 window.location.href = "/carrito/finalizar_pedido_forma_Pago";
	    	 }
				});


});


	$('#contenido-productos').on('click','#btn-seguir_comprando',function(){
				window.location.href = "/index";
				$('#modal_no_cumple_pedido_minimo').modal('hide');
				$Seguir_Comprando = true;
				$Usar_Comis_Puntos = true;
				Pedidos_Verificar_Valor_Minimo_A_Pagar_Procesar_Eleccion_Usuario ( $Seguir_Comprando,$Usar_Comis_Puntos );
	});

	$('#contenido-productos').on('click','#btn-usar-comisiones-puntos',function(){
				$('#modal_no_cumple_pedido_minimo').modal('hide');
				$Seguir_Comprando  = true;
				$Usar_Comis_Puntos = false;
				Pedidos_Verificar_Valor_Minimo_A_Pagar_Procesar_Eleccion_Usuario ( $Seguir_Comprando,$Usar_Comis_Puntos );
				window.location.href = "/carrito/mostrar_carrito/1";
	});



//-------------------------------------------------------------------------------------------------------------------------------------------

// RECOMENDAR PRODUCTO A UN AMIGO
function Recomendar_Producto_a_Mi_Amigo_Validaciones()
{
			var $email_amigo        = $("#email-amigo").val()
			var $nombre_quien_envia = $('#nombre-quien-envia').val();
			var $nombre_amigo       = $('#nombre_amigo').val();

				if ($nombre_amigo.length==0){
					Recomendar_Producto_a_Mi_Amigo_Mensaje('Debes indicar el nombre de tu amig@ para enviar el mensaje.');
					return false;
			}

				if ($email_amigo.length==0){
					Recomendar_Producto_a_Mi_Amigo_Mensaje('Debes registrar el correo electrónico de tu amigo.');
					return false;
			}
			if ($nombre_quien_envia.length==0)	{
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
			var $nombre_amigo       = $('#nombre_amigo').val();
			var $Datos_Valiados     = Recomendar_Producto_a_Mi_Amigo_Validaciones();

			if ($Datos_Valiados==false)	{
						return false;
					}

			var Parametros          = {'idproducto':$idproducto,  'email_amigo': $email_amigo , 'nombre_quien_envia':$nombre_quien_envia,
																													 'mensaje_enviado': $mensaje_enviado, 'nombre_imagen':$nombre_imagen,'nombre_amigo':$nombre_amigo };

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





$('#contenido-productos').on('click','.carrito-resumen-mas',function(){
			$IdProducto    = $(this).attr("idproducto");
			$NomProducto   = $(this).attr("NomProducto");
			$en_oferta   = $(this).attr("en-oferta");
			var Parametros = {"IdProducto" :$IdProducto, "CantidadComprada": 1, "en_oferta":$en_oferta };
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


var Comprobar_IdTipo_Plan_Usuario_Restriccion_Kit_Inicio = function(){
//		JUNIO 25 2015
//  COMPRUEBA QUE EL USUARIO NO SEA CLIENTE O EMPRESARIO PARA COMPRAR EL KIT DE INICIO

			$.ajax({
					dataType: 'json',
					url:      '/terceros/Comprobar_Tipo_Usuario',
					type:     'post',
					async:    false,
     success:  function (resultado) {
    	 		$idtipo_plan_compras_kit= resultado.idtipo_plan_compras;
    	 		$kit_comprado       = resultado.kit_comprado;
    	 }
					});

}

	$('#contenido-productos').on('click','.boton-agregar-carrito',function() {

		var NombreBoton           = $(this).attr("id");
		var IdInputCantidad       = NombreBoton.split("cantidad");
		var IdProducto            = IdInputCantidad[1];
		var CantidadComprada      = $("#cantidad"+IdProducto).val();
		var NomProducto           = $("#nomproducto"+IdProducto).text();
		var NomPresentacion       = $("#nompresentacion"+IdProducto).text();
		var es_tron               = false;
		var es_tron_acc           = false;
		var id_categoria_producto = $(this).attr('id-categoria-producto');
		var en_oferta             = $(this).attr('en-oferta');
		var tipo_combo             = $(this).attr('tipo-combo');


  var Parametros 						 		  = {"IdProducto" :IdProducto, "CantidadComprada": CantidadComprada,
  																									"es_tron": es_tron , "es_tron_acc": es_tron_acc, "en_oferta":en_oferta ,'tipo_combo':tipo_combo	 };
 if ( CantidadComprada > 0 ){
  Agregar_Producto_a_Carrito(NomProducto,Parametros);
  Mostrar_Mensaje_Producto_Agregado(NomProducto);

 }
  return false;

});





$('#contenido-productos').on('click','#tarro-de-eliminar-pedido',function() {
		var idproducto = $(this).attr("idproducto");
		var cantidad   = $(this).attr('cantidad');
		var idproductocombo = $(this).attr("idproductocombo");
		var Parametros = {"IdProducto" :idproducto, "Cantidad": cantidad, 'idproductocombo': idproductocombo };

  Borrar_Producto_de_Carrito(Parametros);
  Actualizar_Vista_Carrito();
		return false;
	});


$('#btn-agregar-kit-ocasional').on('click',function(){
     $Parametros  = {"IdProducto" :10744, "CantidadComprada": 1, "es_tron": true , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);
     Mostrar_Mensaje_Producto_Agregado('Kit de Inicio clientes');
     window.location.href = "/carrito/mostrar_Carrito/1";
});


$('#btn-agregar-kit-empresario').on('click',function(){

    /* $Parametros  = {"IdProducto" :17038, "CantidadComprada": 1, "es_tron": true , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);
     Mostrar_Mensaje_Producto_Agregado('Kit de Inicio clientes');
   **/
     $.ajax({
           data:  '',
           dataType: 'text',
           url:      '/terceros/Cambio_Status',
           type:     'post',
           async:    false,
          success:  function (resultado)     {
           		window.location.href = "/index";
           }
        });
});








