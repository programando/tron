
// CARGAR LAS CIUDADES POR DEPARTAMENTO
$('#departamento').on('change',function(){
	var $IdDpto     = $(this).val();
	var $Municipios = $('#municipio');

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
        //console.log(JSON.stringify(municipios));
        	for(var i = 0; i < municipios.length; i++)
        	{
              $Municipios.append('<option value="' + municipios[i].idmcipio + '">' + municipios[i].nommcipio + '</option>');
         }
    	 }
					});
   }
})
