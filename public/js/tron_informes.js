$(".usu-1" ).first().css('background','#003E90');
$(".usu-1" ).first().css('color','white')

//$(".table").tablesorter();

var Comisiones_x_IdTercero = function($idtercero)
	{

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



$('.usu-1').on('click',function()
{
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
      //alert($numero_pedido );
      //alert($idctrlfactura  );
      //Comisiones_x_Pedido

    $.ajax({
        data:  '',
        dataType: 'html',
        url:      '/informes/Comisiones_x_Pedido/'+$numero_pedido,
        type:     'post',
        success:  function (resultado)
        {

          $('.contenido').html('');
          $('.contenido').html(resultado);
        }

     });

});




