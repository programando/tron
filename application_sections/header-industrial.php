<!--HEADER INDUSTRIAL // -->

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


  <!--Menu-Vista-Industrial -->

        <nav id="menu-industial" class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse" id="boton" >
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=BASE_URL ;?>index/index" class="navbar-brand index_industral" id="inicio-menu-industrial"><span class="inicio"></span></a>
        </div>


        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li></li>
            <li><a class="navbar-brand list-indust"  href="javascript:history.go(-1)" id="flecha-industrial" ><span class="glyphicon glyphicon-chevron-left"></span> </a></li>
            <li><a class="list-indust indus_campo_1"  id="indus_productos"  href="#">PRODUCTOS</a></li>
            <li><a class="list-indust indus_campo_2"  id="indus_destacados" href="#">DESTACADOS</a></li>
            <li><a class="list-indust indus_campo_3"                        href="<?=BASE_URL ;?>redtron/contactanos">CONTACTOS</a></li>
          </ul>

        </div>
      </nav>
    </div>

    <!--Menu-Vista-Industrial -->

<!--
      /.. Esta  TABLA es para indicar en donde se encuentra cada efecto activo del menu-tron ../

                  CAMPO              CLASE               DOCUMENTO            CONTOLLER-VISTA

               PRODUCTOS      =  indus_campo_1  =  tron_indus_campo_1.css  =
               DESTACADOS     =  indus_campo_2  =  tron_indus_campo_2.css  =
               CONTACTANOS    =  indus_campo_3  =  tron_indus_campo_3.css  =  contactos
-->
