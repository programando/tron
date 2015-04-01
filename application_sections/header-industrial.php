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
            <li><a class="list-indust tron_indu_produ_active" id="indus_productos" href="#">PRODUCTOS</a></li>
            <li><a class="list-indust tron_indu_destacados_active" id="indus_destacados" href="#">DESTACADOS</a></li>
          </ul>

        </div>
      </nav>
    </div>

    <!--Menu-Vista-Industrial -->
