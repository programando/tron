var continuar ;
var valor_traslado ;
var comisiones ;
var puntos;

$(".usu-1" ).first().css('background','#003E90');
$(".usu-1" ).first().css('color','white')
$("#alert-error").hide();

//$(".table").tablesorter();

var Comisiones_x_IdTercero = function($idtercero) {
					$.ajax({
						data:  {'idtercero':$idtercero},
						dataType: 'html',
						url:      'Saldos_Comisiones_Puntos_x_IdTercero',
						type:     'post',
      success:  function (resultado)
     	 {
     	 			$(".contenedor-datos-informe").html('');
     	 			$(".contenedor-datos-informe").html(resultado);
     	 }
			});
	}

var Comisiones_Salida = function( $idtercero,$tipo_registro,$numero_pedido, $valor, $idtercero_destino) {

          $.ajax({
            data : { 'idtercero': $idtercero, 'tipo_registro': $tipo_registro,'numero_pedido' :$numero_pedido, 'valor':$valor, 'idtercero_destino': $idtercero_destino   },
            dataType: 'text',
            url:      '/informes/Salida_Comisiones',
            type:     'post',
      success:  function (resultado) {
           window.location.href  = '/informes/traslado_comisiones_puntos/';
       }
      });
  }



var Puntos_Salida = function( $idtercero,$tipo_registro,$numero_pedido, $valor,$idtercero_destino) {

          $.ajax({
            data : { 'idtercero': $idtercero, 'tipo_registro': $tipo_registro,'numero_pedido' :$numero_pedido, 'valor':$valor, 'idtercero_destino': $idtercero_destino   },
            dataType: 'text',
            url:      '/informes/Salida_Puntos',
            type:     'post',
      success:  function (resultado) {
            window.location.href  = '/informes/traslado_comisiones_puntos/';
       }
      });
  }




  var Mensaje_Error = function( $texto ) {
      continuar = false ;
      $('.texto').html($texto )
      $("#alert-error").show();
  }



$('.usu-1').on('click',function(){
  $Usuario_Seleccionado = $(this).attr('id');
  $Cantidad_Direcciones = $(this).attr('cantidad-direcciones');
  $('.barra-usurarios li').each(function(indice, elemento) {
    $(this).css('background','white');
    $(this).css('color','black');
  });
  $('#'+$Usuario_Seleccionado).css('background','#003E90');
  $('#'+$Usuario_Seleccionado).css('color','white');
  Comisiones_x_IdTercero($Usuario_Seleccionado);
})


$('.contenedor_cuenta').on('click','#modal_det_liq_pedido', function(){
      $numero_pedido  = $(this).attr('numero_pedido');
      $idctrlfactura  = $(this).attr('idctrlfactura');
    $.ajax({
        data:  '',
        dataType: 'html',
        url:      '/informes/Comisiones_x_Pedido/'+$numero_pedido,
        type:     'post',
        success:  function (resultado){
          $('.contenido').html('');
          $('.contenido').html(resultado);
        }
     });

});



// Informes
//
$('.contenedor_cuenta').on('click','#volver_comisiones', function(){
 $('.li_pasos_registro').css('background','#85ABDD');
 $(this).css('background','#003E90');
 $('#cabezera_perfil').slideUp(400);
 $('#cabezera_informes').slideUp(400);
 $('#cabezera_favoritos').slideUp(400);
 $("#columna_izquierdad").hide(400);
 $("#menuAppr").show(400);
  Comisiones_Ganadas();
});

$('.contenedor_cuenta').on('click','#volver_comisiones', function(){
 $('.li_pasos_registro').css('background','#85ABDD');
 $(this).css('background','#003E90');
 $('#cabezera_perfil').slideUp(400);
 $('#cabezera_informes').slideUp(400);
 $('#cabezera_favoritos').slideUp(400);
 $("#columna_izquierdad").hide(400);
 $("#menuAppr").show(400);
  Comisiones_Ganadas();
});

$('.contenedor_cuenta').on('click','#volver_comisiones', function(){
 $('.li_pasos_registro').css('background','#85ABDD');
 $(this).css('background','#003E90');
 $('#cabezera_perfil').slideUp(400);
 $('#cabezera_informes').slideUp(400);
 $('#cabezera_favoritos').slideUp(400);
 $("#columna_izquierdad").hide(400);
 $("#menuAppr").show(400);
  Comisiones_Ganadas();
});

$('.contenedor_cuenta').on('click','#volver_comisiones', function(){
 $('.li_pasos_registro').css('background','#85ABDD');
 $(this).css('background','#003E90');
 $('#cabezera_perfil').slideUp(400);
 $('#cabezera_informes').slideUp(400);
 $('#cabezera_favoritos').slideUp(400);
 $("#columna_izquierdad").hide(400);
 $("#menuAppr").show(400);
  Comisiones_Ganadas();
});

$('#cod-desde').on('change',function(){
    var seleccionado = $(this).find('option:selected');
    var valor        = seleccionado.data('saldo_traslado');
    puntos           = seleccionado.data('puntos');
    comisiones       = seleccionado.data('comisiones');
    valor_traslado   = seleccionado.data('saldo_traslado');
    $('#vr-traslado').val(Funciones.Formato_Numero( valor )) ;
});

// VERIFICA QUE NO ELIJA LOS MISMOS CÓDIGOS PARA TRASLADAR
$('#cod-hasta').on('change',function(){

    var  cod_desde = $.trim ( $('#cod-desde').val() );
    var  cod_hasta = $.trim ( $(this).find('option:selected').val());

    if ( cod_desde == cod_hasta ){
      Mensaje_Error('El código desde donde se traslada y el de destino deben ser diferentes.' );
    }
    else if ( cod_desde =="" || cod_hasta =="" ){
      Mensaje_Error('Debe seleccionar el código desde donde traslada y el código de destino.' );
    } else {
        continuar = true ;
        $("#alert-error").hide();
    }

});


$('.btn-realizar-traslado-ctas').on('click' ,function(){

   $('#cod-hasta').change();

   var origen  =  $('#cod-desde').find('option:selected') ;
   var destino =  $('#cod-hasta').find('option:selected') ;
   var origen  = origen.data('idtercero_desde');
   var destino = destino.data('idtercero_hasta') ;


   if ( continuar == false ) { return ; }


   if ( comisiones > 0) {
        Comisiones_Salida(origen, 25,0, comisiones,destino); //25  TRANSFERENCIA ENTRE USUARIOS
   }
   if ( puntos > 0 ) {
        Puntos_Salida ( origen, 25,0, puntos,destino); //25  TRANSFERENCIA ENTRE USUARIOS)
   }



});









