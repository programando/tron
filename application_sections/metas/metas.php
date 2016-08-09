<!-- NEW -->

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
  <meta http-equiv="Content-Type"    content="text/html; charset=utf-8"/>
  <meta http-equiv="cache-control"   content="max-age=0" />
  <meta http-equiv="cache-control"   content="no-cache" />
  <meta http-equiv="expires"         content="0" />
  <meta http-equiv="expires"         content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma"          content="no-cache" />
  <meta http-equiv="Cache-Control" content="public" />

  <meta name="viewport"              content="width=device-width, initial-scale=1">
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
    $Pagina_Metas_GeneralKeys= 'TRON, Cali, Amigos,';
    $Pagina_Metas_Keys = '';
?>

<?php if ( Session::Get('FACEBOOK') == TRUE ):?>
  <?php
     $Pagina_Facebook_keywords=  trim(Session::Get('Pagina_Facebook_TITULO'));
     $Pagina_Facebook_keywords = str_replace (" ", ", ", $Pagina_Facebook_keywords);
  ?>
    <meta name="title"                  content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta property="og:title"           content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta name="description"            content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
    <meta property="og:description"     content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
    <meta property="og:image"           content="<?= Session::Get('Pagina_Facebook_IMAGEN') ;?>" />
    <meta name="keywords"               content="<?=  $Pagina_Metas_GeneralKeys .$Pagina_Facebook_keywords ;?>" />
    <?php   Session::Set('FACEBOOK', FALSE);
	 endif; ?>

<?php   if(Session::Get('CEO_CONTROLLER') == 'index') : ;?>
    <?php
      $Pagina_Metas_Keys          = '';
      $Pagina_Metas_title         = "Entre amigos alcanzamos - TRON";
      $Pagina_Metas_description   = "El multinivel de los no-vendedores. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda para tí. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>



  <?php   if(Session::Get('CEO_CONTROLLER') == 'industrial') :?>
     <?php
       $Pagina_Metas_Keys          = '';
       $Pagina_Metas_title         = "Productos Industrial - TRON";
       $Pagina_Metas_description   = "Productos especializados para diferentes sectores de la industria";
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />

  <?php  endif; ?>



  <?php   if(Session::Get('CEO_CONTROLLER') == 'redtron') :?>
     <?php
       $Pagina_Metas_Keys          = 'mlm, mln, como funciona, mercado en red, tienda virtual';
       $Pagina_Metas_title         = "Productos Industrial - TRON";
       $Pagina_Metas_description   = "Tron Tienda virtual, modelo de negocio entreamigosalcanzamos, Resuelva cualquier inquietud sobre la tienda o el modelo de negocio en la zona Info, la encontrara al lado derecho en la parte superior de la Página, botón de color naranja";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>




  <?php   if(Session::Get('CEO_METODO') == 'productos_tron') :?>
     <?php
       $Pagina_Metas_Keys          = 'desechos plásticos, cuidado del planeta, impacto ambiental, plástico, producto de aseo, hogar, concentrados, concentrados para el hogar, biodegradables';
       $Pagina_Metas_title         = "Productos TRON";
       $Pagina_Metas_description   = "productos especializados, la Línea hogar cuida el medio ambiente por ser biodegradables y por reducir el impacto ambiental que producen los desechos plásticos";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


  <?php   if( (Session::Get('CEO_METODO') == 'categorias_marcas') || (Session::Get('CEO_METODO') == 'productos_por_categoria_individual') ) :?>
     <?php
       $Pagina_Metas_Keys          = 'categorías de productos, marcas, categorías, productos, tienda virtual, agrupaciones, categorías, productos, grupos';
       $Pagina_Metas_title         = "Productos en la tienda virtual TRON";
       $Pagina_Metas_description   = "Los productos en la tienda virtual TRON entreamigosalcanzamos están agrupados por categorías y marcas para facilitar su búsqueda";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>


   <?php   if(Session::Get('CEO_CATEGORIA_INDUSTRIAL') == 1) :?>
     <?php
       $Pagina_Metas_Keys          = 'desechos plásticos, cuidado del planeta, impacto ambiental, plástico, producto de aseo, hogar, concentrados, concentrados para el hogar, biodegradables';
       $Pagina_Metas_title         = "Productos TRON";
       $Pagina_Metas_description   = "productos especializados, la Línea hogar cuida el medio ambiente por ser biodegradables y por reducir el impacto ambiental que producen los desechos plásticos";
       $Pagina_Metas_Keys         = $Pagina_Metas_GeneralKeys . $Pagina_Metas_Keys;
    ?>
    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/productos/tron_1.jpg" />
    <meta name="keywords"               content="<?= $Pagina_Metas_Keys ;?>" />
  <?php  endif; ?>





<!--
  ZONAS
-             Home
-             Industrial
-             El producto

- Info
- Productos Tron
- Productos todos /categorias_marcas/
- Productos por categoría /productos_por_categoria_individual/


   <meta name="title" content="" />
    <meta property="og:title" content="" />
    <meta name="description" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="http://.jpg" />
    <meta name="keywords" content="" />
 -->

