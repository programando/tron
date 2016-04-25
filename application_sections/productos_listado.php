<div id="contenedor-productos">
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

        <?php if ($fabricado_x_ta ==1): ?>
            <!--IMG-tecnologias -->
            <img src="<?=BASE_IMG_PRODUCTOS;?>22.png" width="67" title="Producto Fabricado por Balquimia S.A.S." >
            <!--<div class="img-tecno" title="Producto Fabricado por Balquimia S.A.S."></div>-->
        <?php endif ?>

    </div>
	<!--IMG = Varias Referencias , Ofertas , Tecnoligias-->



    <div class="taC mb10">
        <a href="<?=BASE_URL ;?>productos/vista_ampliada/<?= $idproducto;?>/<?= $Id_Area_Consulta;?> ">

            <img src="<?=BASE_IMG_PRODUCTOS_472x472. $nombre_imagen;?>" class="mb10" />

            <div class="nomproducto taC t14" id ="<?= $idnomproducto ;?>"><?=$nom_producto ;?></div>

            <div class="nompresentacion taC" id ="<?= $idnompresentacion ;?>"><small><?=$nompresentacion ;?></small></div>

        </a>
    </div>

    <!-- SÓLO SE MUESTRAN 2 PRECIOS PARA OTROS PRODUCTOS   ABRIL 25 2016    -->
    <?php if (Session::Get('Id_Area_Consulta') == 2) :?>
      <div class="taC mb10"><!-- Precio Clientes Ocasional -->
          <strong><?=$pv_ocasional;?></strong>
          <span><img src="<?=BASE_IMG_TIENDA;?>18.png" title="Precio Público / Comprador Ocasional" ></span>
      </div>
    <?php endif ;?>

    <!--PRECIO AMIGO TRON-->
    <div class="priceTRONProd taC mb20" >
        <span  id="<?= $id_precio_final_tron ;?>">  <?=$pv_tron;?> </span>
        <span class="tipee2"><img src="<?=BASE_IMG_TIENDA;?>17.png"   title="Precio Plan Cliente TRON" ></span>
        <span class="tipee3"><img src="<?=BASE_IMG_TIENDA;?>16.png"   title="Precio Plan Empresario TRON" ></span>
    </div>



    <!--SECTION = INPUT , BOTONES , IMG => DONDE SE SELECCIONA LA CANTIDAD DE PRODUCTOS -->
      <div class="costos-cantidad">
        <form class="form-horizontal" role="form">

          <div class=" col-xs-4" id="cont-menos">
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
             <button type="button" class="agregar boton-agregar-carrito" id="<?=$id_controles ;?>"
              id-categoria-producto  =   "<?= $id_categoria_producto ;?>">
              <div class="btn-agregar-carrito">
                Agregar
                <span>
                   <img src="<?=BASE_IMG_TIENDA;?>carrito-transparente.png" id="agr-car">
                </span>
              </div>
             </button>
        </div><!--FIN BOTON DE AGREEGAR AL CARRITO DE COMPRAS -->
      </div>  <!--SECTION = INPUT , BOTONES , IMG => DONDE SE SELECCIONA LA CANTIDAD DE PRODUCTOS-->
</div>
