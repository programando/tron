<!-- NEW -->

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
  <meta name      ="viewport"              content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type"    content="text/html; charset=utf-8"/>


  <meta http-equiv="pragma"          content="no-cache" />
  <meta http-equiv='cache-control' content='no-cache , no-store'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>


  <meta name="vw96.objectype" content="Document" />
  <meta name="distribution" content="all" />
  <meta name="robots" content="all" />
  <meta name="author" content="Balquimia" />
  <meta name="language" CONTENT="Spanish" />
  <meta name="revisit" content="3 days">

  <meta property='og:site_name'     content='Entre Amigos Alcanzamos'/>
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= Session::Get('CEO_URL'); ?>" />



<?php
    $Pagina_Metas_GeneralKeys= 'TRON, Cali, Amigos, Balquimia,';
    $Pagina_Metas_Keys = '';
?>

<?php if ( Session::Get('FACEBOOK') == TRUE ):?>
  <?php
     $Pagina_Facebook_keywords=  trim( Session::Get('Pagina_Facebook_TITULO') );
     $Pagina_Facebook_keywords = str_replace (" ", ", ", $Pagina_Facebook_keywords);
     $Pagina_Facebook_keywords = $Pagina_Facebook_keywords . ','.Session::Get('Pagina_Facebook_KEYS');
  ?>
  	<title><?= Session::Get('Pagina_Facebook_TITULO') ;?></title>
    <meta name="title"                  content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta property="og:title"           content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta name="description"            content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
    <meta property="og:description"     content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
    <meta property="og:image"           content="<?= Session::Get('Pagina_Facebook_IMAGEN') ;?>" />
    <meta name="keywords"               content="<?=  $Pagina_Metas_GeneralKeys.$Pagina_Facebook_keywords ;?>" />
    <?php   Session::Set('FACEBOOK', FALSE);
	 endif; ?>



<?php   if(Session::Get('CEO_METODO') == 'index' || Session::Get('CEO_METODO') == 'terceros') : ;?>
    <?php
      $Pagina_Metas_Keys          = "";
      $Pagina_Metas_title         = "Balquimia Ventas Online";
      $Pagina_Metas_description   = "El multinivel de los no-vendedores. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda para tí. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
	?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>



  <?php   if(Session::Get('CEO_METODO') == 'industrial') :?>
     <?php
       $Pagina_Metas_Keys          = '';
       $Pagina_Metas_title         = "Productos Industrial - TRON";
       $Pagina_Metas_description   = "Productos especializados para diferentes sectores de la industria";
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />

  <?php  endif; ?>



  <?php   if(Session::Get('CEO_CONTROLLER') == 'redtron'){ ?>

	<?php
		if(Session::Get('CEO_METODO') == 'red_de_amigos_tron'){
			$Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
			$Pagina_Metas_title         = "Productos TRON - INFO";
			$Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
			$Pagina_Metas_Keys			= $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
	?>
        <title><?= $Pagina_Metas_title; ?></title>
        <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
        <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
        <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
        <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
        <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
        <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  	<?php
		}elseif(Session::Get('CEO_METODO') == 'tron_productos'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
    <?php
		}elseif(Session::Get('CEO_METODO') == 'comisiones'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
    <?php
		}elseif(Session::Get('CEO_METODO') == 'planes_de_registro'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
    <?php
		}elseif(Session::Get('CEO_METODO') == 'tron_medios_pago'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'funcionalidades_interesantes'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'tron_transporte'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'preguntas_frecuentes'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'contactanos'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'garantia_calidad'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}elseif(Session::Get('CEO_METODO') == 'terminos_condiciones'){
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php
		}else{
		   $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
		   $Pagina_Metas_title         = "Productos Industrial - TRON";
		   $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
		   $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
            <title><?= $Pagina_Metas_title; ?></title>
            <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
            <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
            <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
            <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
            <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
	<?php } ?>

  <?php } ?>




  <?php   if(Session::Get('CEO_METODO') == 'productos_tron') :?>
     <?php
       $Pagina_Metas_Keys          = 'desechos plásticos, cuidado del planeta, impacto ambiental, plástico, producto de aseo, hogar, concentrados, concentrados para el hogar, biodegradables';
       $Pagina_Metas_title         = "Productos TRON";
       $Pagina_Metas_description   = "productos especializados, la Línea hogar cuida el medio ambiente por ser biodegradables y por reducir el impacto ambiental que producen los desechos plásticos";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


  <?php
 if( (Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 0) &&
 		((Session::Get('CEO_METODO') == 'categorias_marcas') || (Session::Get('CEO_METODO') == 'productos_por_categoria_individual') || (Session::Get('CEO_METODO') == 'novedades') || (Session::Get('CEO_METODO') == 'ofertas') || (Session::Get('CEO_METODO') == 'varias_referencias')) ) :?>
     <?php
       $Pagina_Metas_Keys          = 'categorías de productos, marcas, categorías, productos, tienda virtual, agrupaciones, categorías, productos, grupos';
       $Pagina_Metas_title         = "Productos en la tienda virtual TRON";
       $Pagina_Metas_description   = "Los productos en la tienda virtual TRON entreamigosalcanzamos están agrupados por categorías y marcas para facilitar su búsqueda";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
	 ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


   <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 1) :?>
     <?php
       $Pagina_Metas_Keys          = 'artes gráficas, impresión offset, maquinas planas, rotativas, lavadores, despercudidor, relavador, moletones, leche de burra, planchas, mantillas';
       $Pagina_Metas_title         = "Lito-Tron – Artes gráficas";
       $Pagina_Metas_description   = "La Línea Lito-Tron cuenta con productos altamente especializados para la Industria de Artes Gráficas y gracias a ellos En este importante sector hemos logrado optimizar sus alistamientos y reducir sus tiempos muertos";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/liena_artes_graficas.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>

  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 4) :?>
     <?php
       $Pagina_Metas_Keys          = 'Inocuidad, seguridad alimentaria, bioseguridad, bioseguridad alimentaria, limpieza, desinfección, limpieza y desinfección, BPM, HACCP, prácticas higiénicas';
       $Pagina_Metas_title         = "La Línea Alimentaria de Balquimia";
       $Pagina_Metas_description   = "Su enfoque es la bioseguridad alimentaria, Cuenta con productos especializados para la limpieza y desifección en todos los sectores de una planta de producción de alimentos, sus  productos son elaborados con altos estándares de calidad y cumplen con todos  los requisitos exigidos por los organismos de control";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_alimentaria.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>

   <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 7) :?>
     <?php
       $Pagina_Metas_Keys          = 'Químicos, baños, baños móviles, baños portátiles, orinales, popo, pipi, obras de construcción, carreteras, eventos, conciertos, matrimonios, cumpleaños, limpieza, desinfección, desodorizar, aromatizar, malos olores, materia fecal, biodegradable, asfalto, grafitis, superficies brillantes';
       $Pagina_Metas_title         = "La Línea sanidad portátil de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especializados, enfocados para la limpieza y desinfección de baños móviles o portátiles utilizados en obras de construcción, eventos públicos o privados";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_sanidad.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>

  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 8) :?>
     <?php
       $Pagina_Metas_Keys          = 'Formulaciones, aseo, limpieza, cera, ceras, carnauba, autoemulsificables, alto brillo, pisos, baldosas, silicona, Agente desmoldante, anti-adherente, moldes, muebles, madera, cuero, detergente, concentrados, pH';
       $Pagina_Metas_title         = "La línea de Materias Primas de Balquimia";
       $Pagina_Metas_description   = "Productos químicos que agilizan sus procesos a bajos costos";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_materias_primas.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>



  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 2) :?>
     <?php
       $Pagina_Metas_Keys          = 'Vehículos, carros, camiones, mixer, camionetas, buses, busetas, motos, tractores, tractomulas, carpas, contenedores,lanchas, shampoo, detergente, desengrasante, biodegradable, medio ambiente, pH neutro, espuma, espumosidad, ceras, lavar, limpieza, motor';
       $Pagina_Metas_title         = "Línea Automotríz de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para el cuidado cualquier tipo de vehículo sin contaminar el medio ambiente";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_automotriz.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 5) :?>
     <?php
       $Pagina_Metas_Keys          = 'Vehículos, carros, camiones, mixer, camionetas, buses, busetas, motos, tractores, tractomulas, carpas, contenedores,lanchas, shampoo, detergente, desengrasante, biodegradable, medio ambiente, pH neutro, espuma, espumosidad, ceras, lavar, limpieza, motor';
       $Pagina_Metas_title         = "Línea Hotelera de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para el cuidado cualquier tipo de vehículo sin contaminar el medio ambiente";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_automotriz.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 3) :?>
     <?php
       $Pagina_Metas_Keys          = 'Vehículos, carros, camiones, mixer, camionetas, buses, busetas, motos, tractores, tractomulas, carpas, contenedores,lanchas, shampoo, detergente, desengrasante, biodegradable, medio ambiente, pH neutro, espuma, espumosidad, ceras, lavar, limpieza, motor';
       $Pagina_Metas_title         = "Línea Mantenimiento Industrial de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para el cuidado cualquier tipo de vehículo sin contaminar el medio ambiente";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_automotriz.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


  <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 6) :?>
     <?php
       $Pagina_Metas_Keys          = 'Vehículos, carros, camiones, mixer, camionetas, buses, busetas, motos, tractores, tractomulas, carpas, contenedores,lanchas, shampoo, detergente, desengrasante, biodegradable, medio ambiente, pH neutro, espuma, espumosidad, ceras, lavar, limpieza, motor';
       $Pagina_Metas_title         = "Línea Textil de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para el cuidado cualquier tipo de vehículo sin contaminar el medio ambiente";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <title><?= $Pagina_Metas_title; ?></title>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="<?= DOMINIO ;?>tron/public/images/categorias_index/linea_automotriz.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>



