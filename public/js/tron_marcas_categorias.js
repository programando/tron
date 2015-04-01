



// CATEGORIAS ( NIVEL 1)
$('#menu-izq-otros-productos').on('click','.lista-productos',function(){
	var IdCategoria      = $(this).attr("id-categoria");
	var Nombre_Categoria = $(this).attr("nombre-categoria");
					Mostrar_Productos_Categorias(IdCategoria,Nombre_Categoria );
});

// SUB CATEGORIAS  ( NIVEL 2)
$('#menu-izq-otros-productos').on('click','.sub-lista-productos',function(){
	var IdSubCategoria     = $(this).attr("id-subcategoria");
	var NombreSubcategoria = $(this).attr("nombre-subcategoria");
					Mostrar_Productos_Sub_Categorias(IdSubCategoria ,NombreSubcategoria );
});

// MARCAS
$("#menu-izq-otros-productos").on('click','.lista-marcas',function(){
		var IdMarca =  $(this).attr("id-marca");
		var NomMarca =  $(this).attr("nom-marca");
					 Mostrar_Productos_x_Marca(IdMarca,NomMarca);
});


$("#contenido-productos").on('click','.pagina',function()
{
			var numero_pagina = $(this).attr('pagina');
			var IdCategoria      = $(this).attr("id-categoria");
			Paginacion(numero_pagina);
});


var Paginacion = function(pagina)
	{
			var Parametros = {"Pagina": pagina};
					$.ajax({
						data:  Parametros,
						dataType: 'html',
						url:      '/tron/productos/Productos_Mostrar_Via_Ajax/',
						type:     'post',
      success:  function (resultado)
     	 {
     	 			$("#contenido-productos").html('');
     	 			$("#contenido-productos").html(resultado);
     	 }
			});

	}



var Mostrar_Productos_Categorias = function(IdCategoria,Nombre_Categoria  )
{
	 var Parametros		    = {"idorden_nv_1" :IdCategoria };
		$.ajax({
						data:  Parametros,
						dataType: 'html',
						url:      '/tron/productos/Productos_por_Categoria/',
						type:     'post',
      success:  function (resultado)
     	 {
     	 			$("#contenido-productos").html('');
     	 			$("#contenido-productos").html(resultado);
     	 			$('.titulo-productos').html(Nombre_Categoria );
     	 }
			});
}

var Mostrar_Productos_Sub_Categorias = function(IdSubCategoria,NombreSubcategoria  )
{
	 var Parametros		    = {"idorden_nv_2" :IdSubCategoria };
		$.ajax({
						data:  Parametros,
						dataType: 'html',
						url:      '/tron/productos/Productos_por_Sub_Categoria/',
						type:     'post',
      success:  function (resultado)
     	 {
     	 			$("#contenido-productos").html('');
     	 			$("#contenido-productos").html(resultado);
     	 			$('.titulo-productos').html(NombreSubcategoria );
     	 }
			});
}


var Mostrar_Productos_x_Marca = function(IdMarca,NomMarca  )
{
	 var Parametros		    = {"idmarca" :IdMarca };
		$.ajax({
						data:  Parametros,
						dataType: 'html',
						url:      '/tron/productos/Productos_por_Marca/',
						type:     'post',
      success:  function (resultado)
     	 {
     	 			$("#contenido-productos").html('');
     	 			$("#contenido-productos").html(resultado);
     	 			$('.titulo-productos').html(NomMarca );
     	 }
			});
}




