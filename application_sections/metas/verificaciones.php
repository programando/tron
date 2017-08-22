 <?php




 //-----------------------
 // SECCIONES VARIAS
 //-----------------------
 if( (Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 0) &&
    ((Session::Get('CEO_METODO') == 'categorias_marcas') || (Session::Get('CEO_METODO') == 'productos_por_categoria_individual') || (Session::Get('CEO_METODO') == 'novedades') || (Session::Get('CEO_METODO') == 'ofertas') || (Session::Get('CEO_METODO') == 'varias_referencias')) )  {
       $Pagina_Metas_description = "En nuestra Tienda Virtual los productos estan agrupados por categorías y marcas para hacer más ágil su busqueda";
       $Pagina_Metas_Keys        = "balquimia ventas online, categorías de productos, marcas, categorías, productos, tienda virtual, agrupaciones, categorías, productos, grupos";
       $Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
       $Pagina_Metas_title       = "Productos en la tienda virtual TRON";
       $Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_insdustrial.jpg";

    }

	

?>




