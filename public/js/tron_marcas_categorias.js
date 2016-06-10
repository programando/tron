
var Mostrar_Productos_Categorias = function(IdCategoria,Nombre_Categoria  )
{
	 var Parametros		    = {"idorden_nv_1" :IdCategoria,"nom_categoria":Nombre_Categoria  };
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


var Paginacion = function(pagina , nombre_categoria ) 	{
			var Parametros = {"Pagina": pagina, "nombre_categoria":nombre_categoria};
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

var Mostrar_Productos_Sub_Categorias = function(IdSubCategoria,NombreSubcategoria  )
{

	 var Parametros		    = {"idorden_nv_2" :IdSubCategoria, "nom_categoria":NombreSubcategoria  };
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
	 var Parametros		    = {"idmarca" :IdMarca, "nom_marca" :NomMarca  };
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


$("#contenido-productos").on('click','.pagina',function(){
			var numero_pagina     = $(this).attr('pagina');
			var  nombre_categoria = $(this).attr("nombre-categoria");
			Paginacion(numero_pagina, nombre_categoria);
});











