<!-- NEW -->
<meta http-equiv="Cache-Control" content="public" />
<meta name="vw96.objectype" content="Document" />
<meta name="distribution" content="all" />
<meta name="robots" content="all" />
<meta name="author" content="Balquimia" />
<meta name="language" CONTENT="Spanish" />
<meta name="revisit" content="3 days">

<!--
  <meta http-equiv="cache-control"   content="max-age=0" />
  <meta http-equiv="cache-control"   content="no-cache" />
  <meta http-equiv="expires"         content="0" />
  <meta http-equiv="expires"         content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma"          content="no-cache" />
    off
    <meta property="og:url"           content="<?= Session::Get('Pagina_Facebook_URL') ;?>" />
    <meta property="og:title"         content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta property="og:image"         content="<?= Session::Get('Pagina_Facebook_IMAGEN') ;?>" />
    <meta property="og:description"   content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
-->

<meta property='og:site_name'     content='Entre Amigos Alcanzamos'/>
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= Session::Get('CEO_URL'); ?>" />


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
    <meta name="keywords"               content="<?=  $Pagina_Facebook_keywords ;?>" />

    <?php
	     Session::Set('FACEBOOK', FALSE);
	 endif;
?>

<?php
  if(Session::Get('CEO_CONTROLLER') == 'index') {
      $Pagina_Metas_title         = "Entre amigos alcanzamos - TRON";
      $Pagina_Metas_description   = "El multinivel de los no-vendedores. La Red TRON es un modelo de negocio que permite tener ganancias de una manera sencilla y cómoda para tí. Sin tomar pedidos, sin cobrar, sin manejar inventarios. Sólo pasando la voz a tus amigos, parientes o compañeros de trabajo.";
?>

    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= str_replace (" ", ", ", trim($Pagina_Metas_title)); ?>" />

<?php
  }

  if(Session::Get('CEO_CONTROLLER') == 'industrial') {
      $Pagina_Metas_title         = "Productos Industrial - TRON";
      $Pagina_Metas_description   = "Productos especializados para diferentes sectores de la industria";
?>

    <meta name="title"                  content="<?= $Pagina_Metas_title; ?>" />
    <meta property="og:title"           content="<?= $Pagina_Metas_title; ?>" />
    <meta name="description"            content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:description"     content="<?= $Pagina_Metas_description; ?>" />
    <meta property="og:image"           content="http://entreamigosalcanzamos.com/tron/public/images/slider/1.jpg" />
    <meta name="keywords"               content="<?= str_replace (" ", ", ", trim($Pagina_Metas_title)); ?>" />

<?php } ?>

<!--
  ZONAS
- Home
- Industrial
- Info
- Productos Tron
- Productos todos /categorias_marcas/
- Productos por categoría /productos_por_categoria_individual/
- El producto

   <meta name="title" content="" />
    <meta property="og:title" content="" />
    <meta name="description" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="http://.jpg" />
    <meta name="keywords" content="" />
 -->

