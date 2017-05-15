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



$('.cboperiodo').on('change',function(){
  var seleccionado = $(this).find('option:selected');
  var idmes        = seleccionado.data('idmes');
  var anio         = seleccionado.data('anio');
 
  $.ajax({
            data:  {},
            dataType: 'html',
            url:      'informes/comisiones/'+idmes+'/'+anio,
            type:     'post',
      success:  function (resultado)
       {
        }
      });
 


});
