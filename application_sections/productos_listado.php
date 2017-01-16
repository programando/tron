<div id="contenedor-productos" style="position:relative;">

	<div class="counttis">
    	<img src="<?=BASE_IMG_TIENDA;?>lad1.png" class="lad1">
        <img src="<?=BASE_IMG_TIENDA;?>lad2.png" class="lad2">

        <div class="p10">
            <div class="colorT1 ff3 t12 mb5 taC">- OFERTA - </div>

            <div class="row p0 m0">
                <div class="col-sm-12 col-xs-12 colorT2 t30 ff2 vcenter taC">
                   <?php

						//$partt = explode
						echo $pv_tron;

				   ?>
                </div><!--
                --><div class="col-sm-12 col-xs-12 colorT2 ff2 vcenter taC">
                   <span class="dB t10 color666 mb3"><em>Exclusivo</em></span>
                    <span class="dIB"><img src="<?=BASE_IMG_TIENDA;?>17.png"   title="Precio Plan Cliente TRON" ></span>
                    <span class="dIB"><img src="<?=BASE_IMG_TIENDA;?>16.png"   title="Precio Plan Empresario TRON" ></span>
                </div>
            </div>
        </div>



        <!-- Opción CUENTA REGRESIVA OFERTAS -->
        <div class="p510 bb333 taC color666 ff0" style="color:#fff; background-color:#f63d27; display:none;">

            <div class="row p0 m0">
                <div class="col-sm-3 col-xs-3 vcenter taC">
                    <em>solo<br>por</em>
                </div><!--
                --><div class="col-sm-3 col-xs-3 vcenter taC">
                	<div class="t24">12</div>
                    <div class="t10">horas</div>
                </div><!--
                --><div class="col-sm-3 col-xs-3 vcenter taC">
                	<div class="t24">48</div>
                    <div class="t10">minutos</div>
                </div><!--
                --><div class="col-sm-3 col-xs-3 vcenter taC">
                	<div class="t24">26</div>
                    <div class="t10">segundos</div>
                </div>
            </div>

        </div>

        <!-- Opción OFERTA BÁSICA -->
        <div class="p10 bb333 taC color666 ff0" style="color:#fff; background-color:#f63d27; display:;">

            <div class="row p0 m0">
                <div class="col-sm-12 col-xs-12 vcenter taC t18">
                    <em>Por tiempo limitado</em>
                </div>
            </div>

        </div>

        <!-- Opción CANTIDAD -->

        <div class="p10 bb333 taC colorfff ff0" style="color:#fff; background-color:#f63d27; display:none;">

            <div class="row" style="margin:0; padding:0;">
                <div class="col-sm-7 col-xs-7 vcenter taC">
                    <em>Cantidad limitada</em>
                </div><!--
                --><div class="col-sm-2 col-xs-2 vcenter taC">
                	<div class="t24">13</div>
                </div><!--
                --><div class="col-sm-3 col-xs-3 vcenter taC t12">
                	<em>unidades<br>restantes</em>
                </div>
            </div>

        </div>

    </div>



	<!--IMG = Varias Referencias , Ofertas , Tecnoligias-->
    <div class="imgRefTec">

		<?php if (isset($mostrar_imagen_varias_referencias) and $mostrar_imagen_varias_referencias!=false) : ?>
        	<?php if ($id_agrupacion!=0): ?>
                <!--IMG-Varias Referencias-->
                <a href="<?=BASE_URL ;?>productos/varias_referencias/<?=$id_agrupacion ;?> ">
                    <div class="img-varRef" title="Ver Varias Referencias"><!--IMG-varias-referencias -->

                    </div>
                </a><!--IMG-Varias Referencias-->
        	<?php endif ?>
        <?php endif ?>


        <?php if ($en_oferta == 1): ?>
            <!--IMG-ofertas -->
            <div class="img-ofertas" title="Producto en Oferta"> </div>
        <?php endif ?>
  <!--
        <?php if ($fabricado_x_ta ==1): ?>
            <img src="<?=BASE_IMG_PRODUCTOS;?>22.png" width="67" title="Producto Fabricado por Balquimia S.A.S." >

        <?php endif ?>
-->
    </div>
	<!--IMG = Varias Referencias , Ofertas , Tecnoligias-->

    <div class="taC mb10">
        <a href="<?=BASE_URL ;?>productos/vista_ampliada/<?= $idproducto;?>/<?= $Id_Area_Consulta;?> ">
            <?php if ( !empty( $nombre_imagen )) :;?>
              <img src="<?=BASE_IMG_PRODUCTOS_472x472. $nombre_imagen;?>" class="mb10" />
            <?php else :?>
              <img src="<?=BASE_IMG_PRODUCTOS_472x472. 'sin-foto.jpg';?>" class="mb10" />
            <?php endif ;?>

            <div class="nomproducto taC t14" id ="<?= $idnomproducto ;?>"><?=$nom_producto ;?></div>
            <div class="nompresentacion taC" id ="<?= $idnompresentacion ;?>"><small><?=$nompresentacion ;?></small></div>
        </a>
    </div>

    <!-- SÓLO SE MUESTRAN 2 PRECIOS PARA OTROS PRODUCTOS   ABRIL 25 2016    -->
    <?php if (Session::Get('Id_Area_Consulta') == 2) :?>
      <div class="taC mb10"><!-- Precio Clientes Ocasional -->
          <?php if ( isset($mostrar_un_solo_precio  ) and $mostrar_un_solo_precio == false) : ?>
            <strong><?=$pv_ocasional;?></strong>
            <span><img src="<?=BASE_IMG_TIENDA;?>18.png" title="Precio Público / Comprador Ocasional" ></span>
         <?php endif ;?>

      </div>
    <?php endif ;?>


    <!--PRECIO AMIGO TRON-->
     <?php if ($en_oferta == 0): ?>
        <div class="priceTRONProd taC mb20" style="position:relative;" >
        	 <!-- <img src="<?=BASE_IMG_TIENDA;?>tach.png" class="tach">-->
            <span  id="<?= $id_precio_final_tron ;?>">  <?=$pv_tron;?> </span>
            <span class="tipee2"><img src="<?=BASE_IMG_TIENDA;?>17.png"   title="Precio Plan Cliente TRON" ></span>
            <span class="tipee3"><img src="<?=BASE_IMG_TIENDA;?>16.png"   title="Precio Plan Empresario TRON" ></span>
        </div>
      <?php else :?>
         <div class="priceTRONProd taC mb20" style="position:relative;" >  </div>
      <?php endif ;?>

    <!--SECTION = INPUT , BOTONES , IMG => DONDE SE SELECCIONA LA CANTIDAD DE PRODUCTOS -->
    <div class="costos-cantidad">
        <form class="form-horizontal" role="form">

          <div class="col-xs-4" id="cont-menos">
            <div class="form-group"><!--Inicio  Boton Menos-->
              <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carrito"
                      onclick="javascript: Carrito_Restar('<?=$id_controles ;?>')"  >-
              </button><!-- Fin Boton Menos-->
            </div>
          </div>

           <div class="col-xs-4" id="cont-digitos">
              <div class="form-group"><!--Inicio Input-->
                 <input type        = "text"  value="1"
                  id                = "<?=$id_controles ;?>"
                  class             = "digitos btn-carrito-input CantProductosComprados"
                  id-idescala       = "<?= $idescala;?>"
                  pv-tron-escala-a  = "<?= $pv_tron_escala_a ;?>"
                  pv-tron-escala-b  = "<?= $pv_tron_escala_b ;?>"
                  pv-tron-escala-c  = "<?= $pv_tron_escala_c ;?>"
                  precio-amigo-tron = "<?= $id_pv_tron ;?>"
                  >
              </div><!--Fin Input-->
           </div>

           <div class=" col-xs-4" id="cont-mas">
              <div class="form-group"><!-- Inicio Boton Mas-->
                <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carrito"
                      onclick="javascript: Carrito_Sumar('<?=$id_controles ;?>')"  >+
              </button><!-- Fin Boton Mas-->
              </div>
           </div>
        </form>

        <!--INICIO BOTON DE AGREEGAR AL CARRITO DE COMPRAS -->
        <div class="div-btn-">
             <button type="button" class="agregar boton-agregar-carrito"
              id                     = "<?=$id_controles ;?>"
              id-categoria-producto  = "<?= $id_categoria_producto ;?>"
              en-oferta               = "<?= $en_oferta ;?>">
              <div class="btn-agregar-carrito">
                Agregar
                <span>
                   <img src="<?=BASE_IMG_TIENDA;?>carrito-transparente.png" id="agr-car">
                </span>
              </div>
             </button>
        </div><!--FIN BOTON DE AGREEGAR AL CARRITO DE COMPRAS -->
    </div>
    <!--SECTION = INPUT , BOTONES , IMG => DONDE SE SELECCIONA LA CANTIDAD DE PRODUCTOS-->

</div>
