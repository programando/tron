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

            <div style="display: none;"><?php include (APPLICATION_SECTIONS .'carrito_header.php');?></div>
            <div style="display: none;"><?php include (APPLICATION_SECTIONS .'tabs_hogar_industrial.php');?></div>
          </div>
        </div>


  <!--Menu-Vista-Industrial -->
     <!-- Tabs hogar , industrial -->
     <?php include (APPLICATION_SECTIONS .'tabs_hogar_industrial.php');?>
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
            <!-- Flecha atras -->
            <li>
               <a class="navbar-brand"  href="javascript:history.go(-1)" id="flecha-industrial" ><span class="glyphicon glyphicon-chevron-left"></span> </a>
            </li>
            <li><a class="list-indust indus_campo_1"  id="indus_productos"  href="<?=BASE_URL ;?>productos/categorias_marcas/">PRODUCTOS</a></li>
            <li><a class="list-indust indus_campo_2"  id="indus_destacados" href="<?=BASE_URL ;?>productos/destacados/">DESTACADOS</a></li>
            <li><a class="list-indust indus_campo_3"                        href="<?=BASE_URL ;?>redtron/contactanos">CONTACTOS</a></li>
            <!-- Info -->
            <li><a href="<?= BASE_URL ;?>redtron/red_de_amigos_tron" class="list-indust" style="padding:5px;"> <img src="<?= BASE_IMG_EMPRESA ; ?>info_menu.png" style="height: 25px;"></a></li>            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <!-- Icon -carrito -->
            <li><a  class="list-indust" id="menu_mostrar_carrito" title="Ir al carrito"style="cursor:pointer;" ><span class="glyphicon glyphicon-shopping-cart"></span> VER CARRITO</a>
                  <!-- SubMenu -->
                  <ul  class="navBar_mostrar_carrito">
                      <li>
                        <?php include (APPLICATION_SECTIONS .'carrito_header.php');?>
                      </li>
 
                  </ul>
            </li>
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
