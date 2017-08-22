<?php
	
	switch ($seo_metodo) {
	
		// Home HOGAR Y PERSONAL
		case 'index':
			$Pagina_Metas_description = "Tienda virtual y Mercadeo Multinivel. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
			$Pagina_Metas_Imagen      = DOMINIO . "public/images/slider/1.jpg";
			$Pagina_Metas_Keys        = "balquimia ventas online,tienda virtual,ventas online,on line,tienda virtual,mlm, mln, multinivel, productos de aseo biodegradables, vitaminas, ventas por internet, sistema de afiliados,";
			$Pagina_Metas_title       = "Balquimia Ventas Online";
			$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
		break;
		
		// Home INDUSTRIAL
		case 'industrial':
			$Pagina_Metas_description = "La línea Industrial de Balquimia provee Productos especializados para diferentes sectores de la industria como: Artes Gràficas, Sector Alimentos, Textil, Mantenimiento Industrial, Hotelería, Automotriz,  Materias primas (bases para fabricación de productos), Sanidad Portátil (baños Móbiles)";
			$Pagina_Metas_Keys        = " balquimia ventas online, Químicos especializados para mantenimiento industrial, mantenimiento preventivo, mantenimiento correctivo, productos para limpieza, desengrasantes, productos biodegradables, desengrasantes  no inflamable, desengrasante reutilizable, limpiadores de grasa, limpiadores de pisos, limpieza y mantenimiento de encofrados, productos para la construcción, lubricantes penetrantes, aflojadores de tuercas, lubricante penetrante para aflojar tornillos, objetos apretados, lubricar ejes,  lubricar cadenas, lubricar  balineras, mantenimiento de rodamiento, silenciar roces de metal a metal, lubricar  engranajes, lubricar piñones, aislantes de humedad, mantenimiento de generadores, desoxidantes, limpiadores de óxido, removedor de herrumbre, fosfatizar, , corrosión, limpia sarro, mantenimiento de azulejos, restaurar cerámicas, restaurar porcelana sanitaria, gel decapante, brillo aluminio, brillar ollas,";
			$Pagina_Metas_title       = "Productos Industriales - TRON";
			$Pagina_Metas_Imagen      = DOMINIO ."public/images/empresa/logo.png";
			$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
		break;
		
		
		
		default :
			$Pagina_Metas_description = "Tienda virtual y Mercadeo Multinivel. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
			$Pagina_Metas_Imagen      = DOMINIO . "public/images/slider/1.jpg";
			$Pagina_Metas_Keys        = "balquimia ventas online, tienda virtual, ventas online, on line, tienda virtual, mlm, mln, multinivel, productos de aseo biodegradables, vitaminas, ventas por internet, sistema de afiliados, ";
			$Pagina_Metas_title       = "Balquimia Ventas Online";
			$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
		break;
		
	}

?>