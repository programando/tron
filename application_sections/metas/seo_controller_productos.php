<?php

	switch ($seo_metodo) {
	
		case 'productos_tron':
			$Pagina_Metas_description = "productos especializados, la Línea hogar cuida el medio ambiente por ser biodegradables, por reducir el impacto ambiental que producen los desechos plásticos y por ser de rápido enjuage lo cual economiza agua ";
			$Pagina_Metas_Keys        = "balquimia ventas online, producto de aseo para el hogar, productos de aseo concentrados, productos biodegradables para el aseo del hogar, balquimia ventas online";
			$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
			$Pagina_Metas_title       = "Productos TRON";
			$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/cat1.png";
		break;
		
		// Esta es la vista ampliada del producto
		case 'detalle':
			$Pagina_Facebook_keywords = trim( Session::Get('Pagina_Facebook_TITULO') );
			$Pagina_Facebook_keywords = Session::Get('Pagina_Facebook_KEYS') . ',' . $Pagina_Facebook_keywords;
			$Pagina_Facebook_keywords = str_replace (" ", "", $Pagina_Facebook_keywords);
			$Pagina_Metas_Imagen      = Session::Get('Pagina_Facebook_IMAGEN');
			$Pagina_Metas_title       = Session::Get('Pagina_Facebook_TITULO') . " - Balquimia Tienda Online";
			$Pagina_Metas_description = Session::Get('Pagina_Facebook_DESCRIPCION');
		break;
		
		// Líneas industriales
		case 'productos_por_categoria_individual':
		
				//-----------------------
				// LINEA ARTES GRÁFICAS
				//-----------------------
				if( Session::Get('CEO_CATEGORIA_INDUSTRIAL' ) == 1) {
					$Pagina_Metas_description = "La Línea Lito-Tron cuenta con productos altamente especializados para la Industria de Artes Gráficas y gracias a ellos En este importante sector hemos logrado optimizar sus alistamientos y reducir sus tiempos muertos";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/liena_artes_graficas.jpg" ;
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "Lito-Tron – Artes gráficas";
					$Pagina_Metas_Keys        = "balquimia ventas online, artes gráficas, impresión offset, maquinas planas, lavadores de rodillos para rotativas, lavadores de rodillos planchas y mantillas, despercudidor de rodillos, relavador de rodillos offset, lavador de moletones, leche de burra, protector de planchas, rejuvenecedor de mantillas";
				}
				
				//-----------------------
				// LINEA ALIMENTARIA
				//-----------------------
				if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 4)  {
					$Pagina_Metas_description = "Su enfoque es la bioseguridad alimentaria, Cuenta con productos especializados para la limpieza y desifección en todos los sectores de una planta de producción de alimentos, sus  productos son elaborados con altos estándares de calidad y cumplen con todos  los requisitos exigidos por los organismos de control";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_alimentaria.jpg" ;
					$Pagina_Metas_Keys        = "balquimia ventas online, Inocuidad alimentaria, seguridad alimentaria, bioseguridad alimentaria, limpieza, desinfección, limpieza y desinfección, BPM, HACCP, prácticas higiénicas";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "La Línea Alimentaria de Balquimia";
				}
				
				//-----------------------
				// SANIDAD PORTATIL
				//-----------------------
				if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 7) {
					$Pagina_Metas_description = "Productos químicos especializados, enfocados para la limpieza y desinfección de baños móviles o portátiles utilizados en obras de construcción, eventos públicos o privados";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_sanidad.jpg" ;
					$Pagina_Metas_Keys        = "balquimia ventas online, baños móviles, baños portátiles,  obras de construcción, carreteras,baños para eventos, baños para conciertos,  materia fecal.";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "La Línea sanidad portátil de Balquimia";
				}
				
				//-----------------------
				// MATERIAS PRIMAS
				//-----------------------
				if( Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 8 ) {
					$Pagina_Metas_description = "Productos químicos que agilizan sus procesos a bajos costos";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_materias_primas.jpg" ;
					$Pagina_Metas_Keys        = "balquimia ventas online, Formulaciones para productos de aseo, productos de limpieza, fabricación cera, fabricación ceras, ceras carnauba, ceras autoemulsificables, ceras de alto brillo, Agente desmoldante, formulaciones concentradas,";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "La línea de Materias Primas de Balquimia";
				}
				
				//-----------------------
				// AUTOMOTRIZ
				//-----------------------
				if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 2)  {
					$Pagina_Metas_description = "Productos químicos especialmente diseñados para el cuidado cualquier tipo de vehículo sin contaminar el medio ambiente";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_automotriz.jpg" ;
					$Pagina_Metas_Keys        = "balquimia ventas online, shampoo para vehículos, detergente para carros, desengrasante biodegradable para carros, shampoo para carros de pH neutro, desengrasante de motores";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "Línea Automotríz de Balquimia";
				}
				
				//-----------------------
				// HOTELERA
				//-----------------------
				if( Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 5)  {
					$Pagina_Metas_description = "Productos químicos especialmente diseñados para la limpieza de los hoteles sin contaminar el medio ambiente";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_automotriz.jpg" ;
					$Pagina_Metas_Keys        = "balquimia ventas onlie, productos de aseo institucional, productos de aseo biodegradables";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "Línea Hotelera de Balquimia";
				}
				
				//-----------------------
				// MANTENIMIENTO INDUSTRIAL
				//-----------------------
				if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 3) {
					$Pagina_Metas_Keys        = "Mantenimiento industrial, mantenimiento preventivo, mantenimiento correctivo, limpieza de equipos, desengrasante biodegradable no inflamable y reutilizable, grasa, ceras, negro de humo, crudo de castilla, seguridad industrial, limpieza aires acondicionados, mantenimiento de torres de enfriamiento,
					bambury, removedor de cemento, ,limpieza de formaletas, mantenimiento de encofrados, lubricante penetrante, aflojar tuercas, aflojador de tornillos, desalojar la humedad, desoxidantes, óxido, ácido, neutro, alcalino, herrumbre, adherencia, pintura, fosfatizar, inhibir, pasivar metales, limpieza de sarro, limpieza de azulejos, limpieza de porcelana sanitaria, gel decapante, brillo aluminio, ollas, pintura electrostática, balquimia ventas online";
					$Pagina_Metas_title       = "Línea Mantenimiento Industrial de Balquimia";
					$Pagina_Metas_description = "La línea Industrial de Balquimia provee Productos especializados para  el  Mantenimiento Industrial correctivo y preventivo ";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_insdustrial.jpg" ;
				}
				
				//-----------------------
				// LÍNEA TEXTIL
				//-----------------------
				if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 6) {
					$Pagina_Metas_description = "Productos químicos especialmente diseñados para el cuidado de la ropa y el medio ambiente";
					$Pagina_Metas_Imagen      = DOMINIO ."public/images/categorias_index/linea_textil.jpg" ;
					$Pagina_Metas_Keys        = "detergente líquido para lavar ropa, detergente para lavar ropa biodegradable, balquimia ventas online";
					$Pagina_Metas_Keys        = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
					$Pagina_Metas_title       = "Línea Textil de Balquimia";
				}
		
		break;

		default :
			$Pagina_Metas_description = "Tienda virtual y Mercadeo Multinivel. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
			$Pagina_Metas_Imagen      = DOMINIO . "public/images/slider/1.jpg";
			$Pagina_Metas_Keys        = "balquimia ventas online, tienda virtual, ventas online, on line, tienda virtual, mlm, mln, multinivel, productos de aseo biodegradables, vitaminas, ventas por internet, sistema de afiliados, ";
			$Pagina_Metas_title       = "Balquimia Ventas Online";
		break;
		
	}

?>