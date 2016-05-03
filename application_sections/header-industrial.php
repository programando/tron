<!--HEADER INDUSTRIAL // -->
<!--ESTE ES EL HEADER PRINCIPAL DEL PROYECTO TRON -->
<div class="headion headIndustrial">
    <div class="ionix hein1">
        <div class="generalMax">

            <div class="row header-tron">

                <div class="">
                    <div class="col-sm-4  col-xs-12 vcenter taLC mb10_onlySmart">
                        <a href="<?= BASE_URL ;?>">
                            <img src="<?= BASE_IMG_EMPRESA ; ?>logo.png" class="logo" />
                        </a>
                    </div><!--

                    --><div class="col-sm-4 col-xs-12 vcenter">
                        <?php include (APPLICATION_SECTIONS . 'header_form_buscar.php');?>
                    </div><!--

                    --><div class="col-sm-4 col-xs-12 vcenter">
                        <?php include (APPLICATION_SECTIONS .'header_cuenta_usuario.php');?>
                        <?php include (APPLICATION_SECTIONS .'formulario_login.php');?>
                    </div>

                </div>

            </div>

            <?php include (APPLICATION_SECTIONS .'tabs_hogar_industrial.php');?>

        </div>
    </div>


    <!-- Menu -->
         <!-- Tabs hogar , industrial -->

    <div class="ionix hein2">
        <div class="generalFull">
            <div class="menGion">
                <nav class="navbar navbar-default colorfff" role="navigation">

                    <div class="navbar-header colorfff">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Desplegar navegación</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a href="<?=BASE_URL ;?>index/industrial" class="navbar-brand"><div class="tabIn"><span class="inicio colorfff"></span></div></a>
                        <a href="javascript:history.go(-1)" class="navbar-brand"><div class="tabIn colorfff"><span class="glyphicon glyphicon-chevron-left t10"></span></div></a>

                    </div>

                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav t14">
                            <li><a href="<?=BASE_URL ;?>productos/categorias_marcas/" id="indus_productos">PRODUCTOS</a></li>
                            <?php if ( Session::Get('Cantidad_Destacados_Industrial') >=5 ) :?>
                            <li><a href="<?=BASE_URL ;?>productos/destacados/" id="indus_destacados">DESTACADOS</a></li>
                        <?php endif ;?>
                            <li><a href="<?=BASE_URL ;?>redtron/contactanos">CONTÁCTENOS</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?= BASE_URL ;?>redtron/red_de_amigos_tron" title="Información" class="t12 infoSpecial rr20" >
                                    <img src="<?= BASE_IMG_CATEGORIAS_INDEX ;?>info2.png" style="padding-bottom:2px" /> &nbsp; <strong>INFO</strong>
                                </a>
                            </li>
                            <li class="onlyMax">
                                <a href="<?=BASE_URL ;?>carrito/mostrar_carrito/1" title="Ir al carrito" class="t12 explicacion-columnas" >
                                    <span class="glyphicon glyphicon-shopping-cart"></span> &nbsp; VER CARRITO
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
    </div>
</div>
