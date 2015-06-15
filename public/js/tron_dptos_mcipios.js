
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
})
