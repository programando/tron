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
-->

<meta property='og:site_name'     content='Entre Amigos Alcanzamos'/>
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= "URL DE LA PÁGINA"; ?>" />


<?php if ( Session::Get('FACEBOOK') == TRUE ):?>
    <meta property="og:url"           content="<?= Session::Get('Pagina_Facebook_URL') ;?>" />
    <meta property="og:title"         content="<?= Session::Get('Pagina_Facebook_TITULO') ;?>" />
    <meta property="og:image"         content="<?= Session::Get('Pagina_Facebook_IMAGEN') ;?>" />
    <meta property="og:description"   content="<?= Session::Get('Pagina_Facebook_DESCRIPCION') ;?>" />
<?php
	Session::Set('FACEBOOK', FALSE);
	endif;
?>


