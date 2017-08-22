<?php

	//-------------------------------
    // DEFINICIÓN DE VARIABLES
    //-------------------------------
	
    $Pagina_Metas_GeneralKeys = 'TRON, Cali, Colombia, Balquimia, Balquimia Ventas Online, Balquimia Tienda, Balquimia Virtual, Tienda virtual, Tienda virtual cali, Ventas online cali, ';
    $Pagina_Metas_Keys        = '';
    $Pagina_Metas_Imagen      = DOMINIO . "public/images/productos/tron_1.jpg";
    $Pagina_Facebook_keywords = '';
    $Pagina_Metas_description = '' ;
    $Pagina_Metas_title       = '';
	
	
	//-------------------------------
    // CAPTURA DE CONTROLADOR
    //-------------------------------
	
	$seo_controller 	= Session::Get('CEO_CONTROLLER');
	$seo_metodo 		= Session::Get('CEO_METODO');
	echo '<meta name="juanAndrade" controller="'.$seo_controller.'" metodo="'.$seo_metodo.'" />';
	
	
	//-------------------------------
    // CONDICIONALES Y LLAMADOS
    //-------------------------------
	
	if(Session::Get('CEO_CONTROLLER') == 'index'){

		include (APPLICATION_SECTIONS . 'metas/seo_controller_index.php');

	} elseif(Session::Get('CEO_CONTROLLER') == 'redtron'){
		
		include (APPLICATION_SECTIONS . 'metas/seo_controller_redtron.php');
		
	} elseif(Session::Get('CEO_CONTROLLER') == 'productos'){
		
		include (APPLICATION_SECTIONS . 'metas/seo_controller_productos.php');
				
	} elseif(Session::Get('CEO_CONTROLLER') == 'terceros'){
		
		include (APPLICATION_SECTIONS . 'metas/seo_controller_terceros.php');
		
	} else {
		
		include (APPLICATION_SECTIONS . 'metas/seo_controller_default.php');
		
	}

?>