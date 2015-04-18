<!--ESTE ES EL HEADER PRINCIPAL DEL PROYECTO TRON -->

          <div class="row header-tron">
            <div class="col-lg-4 col-md-4  col-sm-4 columna-logo"><!--LOGO-->
              <a href="<?= BASE_URL ;?>">
               <img src= "<?= BASE_IMG_EMPRESA ; ?>logo.png" class="img-logo" >
             </a>
           </div><!-- FIN DEL LOGO-->

           <div class="col-lg-4 col-md-4 contenedor-input">
                <?php include (APPLICATION_SECTIONS . 'header_form_buscar.php');?>
           </div>


          <div class="col-lg-4 col-md-4  col-sm-4 cont-per">
            <?php include (APPLICATION_SECTIONS .'header_cuenta_usuario.php');?>
            <?php include (APPLICATION_SECTIONS .'formulario_login.php');?>

            <?php include (APPLICATION_SECTIONS .'carrito_header.php');?>
            <?php include (APPLICATION_SECTIONS .'tabs_hogar_industrial.php');?>
          </div>
        </div>


        <nav id="menu" class="navbar navbar-default eee" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse" id="boton" >
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=BASE_URL ;?>index" class="navbar-brand inicio-index" id="inicio-menu"><span class="inicio"></span></a>
        </div>


        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">

            <li class="felcha-atras">
               <a class="navbar-brand" href="javascript:history.go(-1)" id="flecha" ><span class="glyphicon glyphicon-chevron-left"></span> </a>
            </li>
            <li class="selected">
               <a class="list-menu  campo_1" id="hogar_produc"     href="<?=BASE_URL ;?>productos/productos_tron/">PRODUCTOS TRON</a>
            </li>
            <li><a class="list-menu campo_2" id="hogar_otros"      href="<?=BASE_URL ;?>productos/categorias_marcas/">OTROS PRODUCTOS</a></li>
            <li><a class="list-menu campo_3" id="hogar_destacados" href="<?=BASE_URL ;?>productos/destacados/">DESTACADOS</a></li>
            <li><a class="list-menu campo_4" id="hogar_ofertas"    href="<?=BASE_URL ;?>productos/ofertas/">OFERTAS</a></li>
            <li><a class="list-menu campo_5" id="hogar_novedades"  href="<?=BASE_URL ;?>productos/novedades/">NOVEDADES</a></li>
            <li><a class="list-menu campo_6"                       href="<?=BASE_URL ;?>redtron/contactanos">CONTACTOS</a></li>

          </ul>
          </div>
        </nav>

<!--
      /.. AREAS DE CONSULTA CORRESPONDEN A LOS TIPOS DE PRODUCTOS ( HOGAR / INDUSTRIAL)
      id-area-consulta ="2" ES HOGAR
      id-area-consulta ="1" ES INDUSTRIAL .../

      /.. Esta  TABLA es para indicar en donde se encuentra cada efecto activo del menu-tron ../

                  CAMPO           CLASE         DOCUMENTO         CONTOLLER-VISTA

              PRODUCTOS TRON  =  campo_1  =  tron_campo_1.css  =  Productos_Tron
              OTROS PRODUCTOS =  campo_2  =  tron_campo_2.css  =  categorias_marcas ( otros productos )
              DESTACADOS      =  campo_3  =  tron_campo_3.css  =  Destacados
              OFERTAS         =  campo_4  =  tron_campo_4.css  =  ofertas
              NOVEDADES       =  campo_5  =  tron_campo_5.css  =  novedades
              COCTACTOS      =   campo_6  =  tron_campo_6.css  =  contactanos
-->
