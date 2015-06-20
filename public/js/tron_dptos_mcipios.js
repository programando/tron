
// CARGAR LAS CIUDADES POR DEPARTAMENTO
$('#iddpto').on('change',function(){
	var $IdDpto     = $(this).val();
	var $Municipios = $('#idmcipio');
 if ($IdDpto==0)
 {
    $Municipios.empty();
    $Municipios.append("<option>Seleccione un departamento</option>");
   }else
   {

    $.ajax({
					data:  {'iddpto':$IdDpto},
					dataType: 'json',
					url:      '/tron/municipios/Consultar/',
					type:     'post',
     success:  function (municipios)
    	 {
        $Municipios.empty();
        $Municipios.append('<option value="0"> SELECCIONE UNA CIUDAD O MUNICIPIO...</option>');
        	for(var i = 0; i < municipios.length; i++)
        	{
              $Municipios.append('<option value="' + municipios[i].idmcipio + '">' + municipios[i].nommcipio + '</option>');
         }
    	 }
					});
   }
});




// CARGAR LAS CIUDADES POR DEPARTAMENTO EN LA EDICION DE DATOS DE LA CUENTA
// PARA LAS CIUDADES Y DEPARTAMENTOS DE LA CUENTA BANCARIA
$('#iddpto_transferencia').on('change',function(){
  var $IdDpto     = $(this).val();
  var $Municipios_Transf = $('#param_idmcipio_transferencias');

 if ($IdDpto==0)
 {
    $Municipios_Transf.empty();
    $Municipios_Transf.append("<option>Seleccione un departamento</option>");
   }else
   {
    $.ajax({
          data:  {'iddpto':$IdDpto},
          dataType: 'json',
          url:      '/tron/municipios/Consultar/',
          type:     'post',
     success:  function (municipios)
       {
        $Municipios_Transf.empty();
        $Municipios_Transf.append('<option value="0"> SELECCIONE UNA CIUDAD O MUNICIPIO...</option>');
          for(var i = 0; i < municipios.length; i++)
          {
              $Municipios_Transf.append('<option value="' + municipios[i].idmcipio + '">' + municipios[i].nommcipio + '</option>');
         }
       }
       });
   }
})

