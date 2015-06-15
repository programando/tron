
                                  //******** Paso 2 =  Confirmacion de envio  *********
//------------------------- Validacion = Seleccion de direccion --------------------------------
// COLORES EN LOS CÓDIGOS DE USUARIO

$(".usu-1" ).first().css('background','#003E90');
$(".usu-1" ).first().css('color','white')
$(".direccion1").css('background','white');

function Depurar_Texto(resultado)
{/*     MARZO 20 DE 2015
  *         QUITA ESPACIOS EN BLANCO Y SALTOS DE LINEA DEL TEXTO PASADO COMO PARAMETRO
  */
  $.trim(resultado);
  resultado = resultado.replace("\n", "");
  resultado = resultado.replace(/\s+/g, '');
  return resultado;
}



function Mostrar_Direcciones_Usuario_Seleccionado(Usuario_Seleccionado, Cantidad_Direcciones)
{
  var $Usuario_Seleccionado = Usuario_Seleccionado;
  Parametros ={'idtercero':$Usuario_Seleccionado, 'cantidad_direcciones':Cantidad_Direcciones};
  $.ajax({
      data:  Parametros,
      dataType: 'text',
      url:      '/tron/carrito/Finalizar_Pedido_Direccion_Cambio_Usuario/',
      type:     'post',
      success:  function (resultado)
      {
        $('.fila-direcciones').load('/tron/carrito/Finalizar_Pedido_Direccion_Mostrar_Direcciones');
      }
   });
}



function Direccion_Usuario_Grabar(Parametros)
{
  $.ajax({
      data:  Parametros,
      dataType: 'text',
      url:      '/tron/terceros/Direcciones_Despacho_Grabar_Actualizar/',
      type:     'post',
      success:  function (resultado)
      {
          resultado = Depurar_Texto(resultado);
          if (resultado=='Destinatario_No_OK')
          {
            $('#mensaje_error').html('Debe registrar el destinatario.');
            return false;
          }
          if (resultado=='Municipio_No_OK')
          {
            $('#mensaje_error').html('Debe seleccionar departamento y municipio.');
            return false;
          }
          if (resultado=='Direccion_No_OK')
          {
            $('#mensaje_error').html('Debe registrar la dirección para realizar el despacho.');
            return false;
          }
          if (resultado=='Barrio_No_OK')
          {
            $('#mensaje_error').html('Registre el barrio en donde figura la dirección registrada.');
            return false;
          }
          if (resultado=='Telefono_No_OK')
          {
            $('#mensaje_error').html('Es necesario que registre un número de teléfono.');
            return false;
          }
          if (resultado=='OK')
          {

            $('#venta_editar').modal('hide');
            $('.fila-direcciones').load('/tron/carrito/Finalizar_Pedido_Direccion_Mostrar_Direcciones');
            return false;
          }

      }
   });
}

// BOTÓN CONTINUAR EN LA PARTE DE DIRECCIONES. VALIDA QUE SE HAYA ELEGIDO DIRECCION Y USUARIO PARA EL PEDIDO
$('.btn-continuar').on('click',function()
{
  $.ajax({
      dataType: 'text',
      url:      '/tron/carrito/Finalizar_Pedido_Finalizar_Direccion/',
      type:     'post',
      success:  function (resultado)
      {
        resultado=$.trim(resultado);
        if (resultado!='Siguente_Paso_OK')
        {
          $('.modal-body #texto').html(resultado);
          $('#ventana_error').modal('show');
        }else
        {
            window.location.href = "/tron/carrito/mostrar_carrito/1";
        }
      }
   });
});



$('#destinatario,#direccion,#municipio,#telefono,#barrio').on('focus',function(){
  $('#mensaje_error').html('');
})


$('#btn-direccion-grabar').on('click',function(){
   var $iddireccion_despacho = $iddireccion_despacho_seleccionada;
   var $idmcipio             = $('#idmcipio').val();
   var $direccion            = $('#direccion').val();
   var $telefono             = $('#telefono').val();
   var $barrio               = $('#barrio').val();
   var $destinatario         = $('#destinatario').val();
   var $Parametros = {'iddireccion_despacho':$iddireccion_despacho,'destinatario':$destinatario, 'idmcipio':$idmcipio,
                     'direccion':$direccion , 'telefono':$telefono, 'barrio':$barrio,'destinatario':$destinatario   };
   Direccion_Usuario_Grabar ($Parametros) ;
})

//Administración de la venta editar / crear dirección
$('.fila-direcciones').on('click','.btn-editar-direccion',function(e){
  e.preventDefault();
  var $IdDireccion_Despacho = $(this).attr('iddirecciondespacho');
  $iddireccion_despacho_seleccionada = $IdDireccion_Despacho;
  var $destinatario         = $(this).attr('destinatario');
  var $iddpto               = $(this).attr('iddpto');
  var $idmcipio             = $(this).attr('idmcipio');
  var $direccion            = $(this).attr('direccion');
  var $barrio               = $(this).attr('barrio');
  var $telefono             = $(this).attr('telefono');
  $('.modal-body #destinatario').val($destinatario);
  $('.modal-body #departamento').val($iddpto );
  $('.modal-body #direccion').val($direccion );
  $('.modal-body #barrio').val($barrio);
  $('.modal-body #telefono').val($telefono );
  $('#venta_editar').modal('show');
})

//Obterner valor de radio button y cambiar los valores de las variables de session para entrega del pedido
$('.fila-direcciones').on('click','.input-checkbox-direccion',function(){
    var $IdDireccion_Despacho  = $(this).attr('iddirecciondespacho');
    var $IdMcipio              = $(this).attr('idmcipio');
    var $IdDpto                = $(this).attr('iddpto');
    var $Re_Expedicion         = $(this).attr('reexpedicion');
    var $IdControl             = $(this).attr('numero-opcion');
    var $Nombre_Usuario_Pedido = $(this).attr('nombre-usuario-pedido');
    var $Label                 = $('#label'+$IdControl);

    $(".direccion1").css('background','white');
    $(".direccion1").css('color','black');

    $Label.css('background','#003E90');
    $Label.css('color','white');

    Parametros = {'iddirecciondespacho':$IdDireccion_Despacho , 'idmcipio':$IdMcipio ,'iddpto':$IdDpto ,'reexpedicion':$Re_Expedicion};
    $.ajax({
      data:  Parametros,
      dataType: 'json',
      url:      '/tron/carrito/Finalizar_Pedido_Direccion_Final/',
      type:     'post',
      success:  function (resultado)
       {
          //$('#nombre-usuario-pedido').html('El pedido será despachado a nombre de :' + $Nombre_Usuario_Pedido);
      }
      });
})



//$Codigos = $("ul");
$('.usu-1').on('click',function()
{
  $Usuario_Seleccionado = $(this).attr('id');
  $Cantidad_Direcciones = $(this).attr('cantidad-direcciones');
  $('.barra-usurarios li').each(function(indice, elemento) {
    $(this).css('background','white');
    $(this).css('color','black');
  //console.log('El elemento con el índice '+indice+' contiene '+$(elemento).text());
  //alert($(elemento).text());
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
  Mostrar_Direcciones_Usuario_Seleccionado($Usuario_Seleccionado, $Cantidad_Direcciones);

})


$('#ingresar').on('click',function(){ // ........Efecto click Checkbox = Ingresar a mi cuenta
	  $('#campo_cuenta').slideDown();
	  $('#pedido_amigo').slideUp();
})

$('#pedido-amigo').on('click',function(){ // ........Efecto click Checkbox = Pedido amigo
    $('#campo_cuenta').slideUp();
    $('#pedido_amigo').slideDown();

});



$('#btn-ing-por-amigo').on('click',function(){ //......... Ingresar hacer pedido amigo

	    var $cedula_amigo  = $('#cedula-amigo').val();  //...  Numero cedula de tu amigo
	    var $usuario_amigo = $('#usuario-amigo').val(); //...  Codigo usuario de tu amigo


	    if($cedula_amigo == ''){ //............................ Condicion = Numero cedula de tu amigo
	    	  $('.msj-validacion-cedu-amigo').fadeIn();
	    	  $('#cedula-amigo').focus();
	    	  return false;
	    }else{
	    	  $('.msj-validacion-cedu-amigo').fadeOut();
	    }

	    if($usuario_amigo == ''){ //............................ Condicion = Codigo usuario de tu amigo
	    	  $('.msj-validacion-amigo').fadeIn();
	    	  $('#usuario-amigo').focus();
	    	  return false;
	    }else{
	    	  $('.msj-validacion-amigo').fadeOut();
	    }
});

// etas es la imagen de payu latam... luego de esto cargo la pagina
$('.img-pago1').on('click',function(){
    $id_forma_pago = $(this).attr("id");
    $Parametros    = {'id_forma_pago':$id_forma_pago};

      $.ajax({
      data:  $Parametros,
      dataType: 'text',
      url:      '/tron/pedidos/Forma_Pago_Pedido_Payu_Latam/',
      type:     'post',
      success:  function (resultado)
      {
         $('#formaspago').html(resultado);
         document.formPaypal.submit();
      }
   });
});




