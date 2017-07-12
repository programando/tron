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

  <meta property='og:site_name'     content='Balquimia ventas online'/>
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
      $Pagina_Metas_Keys          = "balquimia ventas online, tienda virtual, ventas online, on line, tienda virtual, mlm, mln, multinivel, productos de aseo biodegradables, vitaminas, ventas por internet, sistema de afiliados, ";
      $Pagina_Metas_title         = "Balquimia Ventas Online";
      $Pagina_Metas_description   = "Tienda virtual y Mercadeo Multinivel. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
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
     $Pagina_Metas_Keys          = " balquimia ventas online, Químicos especializados para mantenimiento industrial, mantenimiento preventivo, mantenimiento correctivo, productos para limpieza, desengrasantes, productos biodegradables, desengrasantes  no inflamable, desengrasante reutilizable, limpiadores de grasa, ceras, removedor de negro de humo, limpiador de crudo de castilla, limpiadores de aceite, mantenimiento de herramientas, limpieza de piezas mecánicas, mantenimiento de  tuberías, productos para mantenimiento de tanques, limpiadores de pisos, productos útiles en seguridad industrial, productos para fachadas, mantenimiento talleres, productos para mantenimiento de bodegas, limpiadores de aires acondicionados, desincrustante de radiadores, productos para limpieza de chiller, productos para torres de enfriamiento, productos para sistema de recirculación, embellecimiento de cauchos vulcanizados, limpieza de bambury, removedor de cemento, mantenimiento de formaletas, limpieza y mantenimiento de encofrados, productos para la construcción, lubricantes penetrantes, aflojadores de tuercas, lubricante penetrante para aflojar tornillos, objetos apretados, lubricar ejes,  lubricar cadenas, lubricar  balineras, mantenimiento de rodamiento, silenciar roces de metal a metal, lubricar  engranajes, lubricar piñones, mantenimiento  mandriles, mantenimiento acero inoxidable, desalojar la humedad, aislantes de humedad,  dieléctricos, limpiador de contactos eléctrico, limpiador de conectores, mantenimiento de motores, limpiador equipos electrónicos, mantenimiento de bobinados, mantenimiento de transformadores, mantenimiento de generadores, desoxidantes, limpiadores de óxido, removedor de herrumbre, fosfatizar, , corrosión, limpia sarro, mantenimiento de azulejos, restaurar cerámicas, restaurar porcelana sanitaria, gel decapante, brillo aluminio, brillar ollas,";
       $Pagina_Metas_title         = "Productos Industrial - TRON";
       $Pagina_Metas_description   = "La línea Industrial de Balquimia provee Productos especializados para diferentes sectores de la industria como: Artes Gràficas, Sector Alimentos, Textil, Mantenimiento Industrial, Hotelería, Automotriz,  Materias primas (bases para fabricación de productos), Sanidad Portátil (baños Móbiles)";
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
    $Pagina_Metas_Keys          = "mlm, mln, mercado en red, tienda virtual, ventas online, trabajo desde casa, monte su propio negocio, vendedores, jefe de ventas, balquimia ventas online";
      $Pagina_Metas_title         = "Productos TRON - INFO";
      $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
      $Pagina_Metas_Keys      = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
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
       $Pagina_Metas_Keys          = "producto de aseo para el hogar, productos de aseo concentrados, productos de aseo concentrados para el hogar, productos de aseo biodegradables, balquimia ventas online";
       $Pagina_Metas_title         = "Productos Hogar - TRON";
       $Pagina_Metas_description   = "Los Productos TRON son especializados, la Línea hogar cuida el medio ambiente es biodegradable, el gasto de agua es menor al ser de rápido enjuage y reduce el impacto ambiental que producen los desechos plásticos.
       . ";
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
       $Pagina_Metas_Keys          = "mlm, mln, comisiones, mercado en red, tienda virtual, ventas online, balquimia ventas online";
       $Pagina_Metas_title         = "Plan de compensación - TRON";
       $Pagina_Metas_description   = "Las comisiones son el pilar de este negocio el plan de compensación es muy atractivo para los usuarios registrados en el Plan Empresario TRON.";
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
       $Pagina_Metas_Keys          = "mlm, mln, registro, mercado en red, tienda virtual, balquimia ventas online";
       $Pagina_Metas_title         = "Planes de registro - TRON";
       $Pagina_Metas_description   = "Hay dos tipos de registro, Clente y plan Empresario TRON éste es para personas emprendedoras que desean tener ingresos adicionales vendiendo los productos de nuestra página, tambien tiene la posibilidad de formar su grupo de ventas";
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
       $Pagina_Metas_Keys          = "mlm, mln, medios de pago, pasarela de pagos, mercado en red, tienda virtual, balquimia ventas online";
       $Pagina_Metas_title         = "pasarela de pagos - TRON";
       $Pagina_Metas_description   = "Nuestra pasarela de pagos cuenta con gran variedad de alternativas, podras escoger la de tu mayor comodidad";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, medios de promoción, funcionalidades interesantes, balquimia ventas online";
       $Pagina_Metas_title         = "funcionalidades interesantes - TRON";
       $Pagina_Metas_description   = "Tron Tienda virtual,  en la sección funcionalidades interesantes encontrara herramientas que le permitiran promocionar adecuadamente tanto el modelo de negocio como los productos de esta página";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, transporte, balquimia ventas online";
       $Pagina_Metas_title         = "Transporte - TRON";
       $Pagina_Metas_description   = "La Tienda virtual Tron, llega a más de 1300 municipios a nivel nacional ";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, preguntas frecuentes, balquimia ventas online";
       $Pagina_Metas_title         = "Preguntas Frecuentes - TRON";
       $Pagina_Metas_description   = "Una sección con las respuestas a las preguntas mas frecuentes esta a su disposición, le permitira aclarar cualquier inquietud";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, contacto, balquimia ventas online";
       $Pagina_Metas_title         = "Página de Contacto - TRON";
       $Pagina_Metas_description   = "Balquimia ventas online cuenta con una página de contacto ágil y sencilla donde podrá hacernos llegar sus inquietudes ";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, garantía, balquimia ventas online";
       $Pagina_Metas_title         = "Garantía de productos - TRON";
       $Pagina_Metas_description   = "Balquimia S.A.S. y la Tienda Virtual Balquimia ventas online, realiza convenios y negociaciones con grandes marcas de la industria nacional e internacional para poder otorgar a sus clientes los mejores precios, calidad y respaldo. ";
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
       $Pagina_Metas_Keys          = "mlm, mln, como funciona, mercado en red, tienda virtual, condiciones, balquimia ventas online";
       $Pagina_Metas_title         = "Terminos_condiciones - TRON";
       $Pagina_Metas_description   = "Los términos y condiciones de las compras que realice el cliente por este medio serán los que constan a continuación y que serán aceptados por el cliente, como condición esencial para acceder a los productos ofrecidos por Balquimia S.A.S";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, Químicos especializados para mantenimiento industrial, mantenimiento preventivo, mantenimiento correctivo, productos para limpieza, desengrasantes, productos biodegradables, desengrasantes  no inflamable, desengrasante reutilizable, limpiadores de grasa, ceras, removedor de negro de humo, limpiador de crudo de castilla, limpiadores de aceite, mantenimiento de herramientas, limpieza de piezas mecánicas, mantenimiento de  tuberías, productos para mantenimiento de tanques, limpiadores de pisos, productos útiles en seguridad industrial, productos para fachadas, mantenimiento talleres, productos para mantenimiento de bodegas, limpiadores de aires acondicionados, desincrustante de radiadores, productos para limpieza de chiller, productos para torres de enfriamiento, productos para sistema de recirculación, embellecimiento de cauchos vulcanizados, limpieza de bambury, removedor de cemento, mantenimiento de formaletas, limpieza y mantenimiento de encofrados, productos para la construcción, lubricantes penetrantes, aflojadores de tuercas, lubricante penetrante para aflojar tornillos, objetos apretados, lubricar ejes,  lubricar cadenas, lubricar  balineras, mantenimiento de rodamiento, silenciar roces de metal a metal, lubricar  engranajes, lubricar piñones, mantenimiento  mandriles, mantenimiento acero inoxidable, desalojar la humedad, aislantes de humedad,  dieléctricos, limpiador de contactos eléctrico, limpiador de conectores, mantenimiento de motores, limpiador equipos electrónicos, mantenimiento de bobinados, mantenimiento de transformadores, mantenimiento de generadores, desoxidantes, limpiadores de óxido, removedor de herrumbre, fosfatizar, , corrosión, limpia sarro, mantenimiento de azulejos, restaurar cerámicas, restaurar porcelana sanitaria, gel decapante, brillo aluminio, brillar ollas,";
       $Pagina_Metas_title         = "Productos Industrial - TRON";
       $Pagina_Metas_description   = "La línea Industrial de Balquimia provee Productos especializados para diferentes sectores de la industria como: Artes Gràficas, Sector Alimentos, Textil, Mantenimiento Industrial, Hotelería, Automotriz,  Materias primas (bases para fabricación de productos), Sanidad Portátil (baños Móbiles)";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, producto de aseo para el hogar, productos de aseo concentrados, productos biodegradables para el aseo del hogar, balquimia ventas online";
       $Pagina_Metas_title         = "Productos TRON";
       $Pagina_Metas_description   = "productos especializados, la Línea hogar cuida el medio ambiente por ser biodegradables, por reducir el impacto ambiental que producen los desechos plásticos y por ser de rápido enjuage lo cual economiza agua ";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, categorías de productos, marcas, categorías, productos, tienda virtual, agrupaciones, categorías, productos, grupos";
       $Pagina_Metas_title         = "Productos en la tienda virtual TRON";
       $Pagina_Metas_description   = "La línea Industrial de Balquimia provee Productos especializados para diferentes sectores de la industria como: Artes Gràficas, Sector Alimentos, Textil, Mantenimiento Industrial, Hotelería, Automotriz,  Materias primas (bases para fabricación de productos), Sanidad Portátil (baños Móbiles";
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
      $Pagina_Metas_Keys          = "balquimia ventas online, artes gráficas, impresión offset, maquinas planas, lavadores de rodillos para rotativas, lavadores de rodillos planchas y mantillas, despercudidor de rodillos, relavador de rodillos offset, lavador de moletones, leche de burra, protector de planchas, rejuvenecedor de mantillas";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, Inocuidad alimentaria, seguridad alimentaria, bioseguridad alimentaria, limpieza, desinfección, limpieza y desinfección, BPM, HACCP, prácticas higiénicas";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, baños móviles, baños portátiles,  obras de construcción, carreteras,baños para eventos, baños para conciertos,  materia fecal.";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, Formulaciones para productos de aseo, productos de limpieza, fabricación cera, fabricación ceras, ceras carnauba, ceras autoemulsificables, ceras de alto brillo, Agente desmoldante, formulaciones concentradas,";
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
       $Pagina_Metas_Keys          = "balquimia ventas online, shampoo para vehículos, detergente para carros, desengrasante biodegradable para carros, shampoo para carros de pH neutro, desengrasante de motores";
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
       $Pagina_Metas_Keys          = "balquimia ventas onlie, productos de aseo institucional, productos de aseo biodegradables";
       $Pagina_Metas_title         = "Línea Hotelera de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para la limpieza de los hoteles sin contaminar el medio ambiente";
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
       $Pagina_Metas_Keys          = "Mantenimiento industrial, mantenimiento preventivo, mantenimiento correctivo, limpieza de equipos, desengrasante biodegradable no inflamable y reutilizable, grasa, ceras, negro de humo, crudo de castilla, seguridad industrial, limpieza aires acondicionados, mantenimiento de torres de enfriamiento,
bambury, removedor de cemento, ,limpieza de formaletas, mantenimiento de encofrados, lubricante penetrante, aflojar tuercas, aflojador de tornillos, desalojar la humedad, desoxidantes, óxido, ácido, neutro, alcalino, herrumbre, adherencia, pintura, fosfatizar, inhibir, pasivar metales, limpieza de sarro, limpieza de azulejos, limpieza de porcelana sanitaria, gel decapante, brillo aluminio, ollas, pintura electrostática, balquimia ventas online";
       $Pagina_Metas_title         = "Línea Mantenimiento Industrial de Balquimia";
       $Pagina_Metas_description   = "La línea Industrial de Balquimia provee Productos especializados para  el  Mantenimiento Industrial correctivo y preventivo ";
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
       $Pagina_Metas_Keys          = "detergente líquido para lavar ropa, detergente para lavar ropa biodegradable, balquimia ventas online";
       $Pagina_Metas_title         = "Línea Textil de Balquimia";
       $Pagina_Metas_description   = "Productos químicos especialmente diseñados para el cuidado de la ropa y el medio ambiente";
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



