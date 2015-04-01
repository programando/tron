<div id="contenedor-productos">
                <!--IMG = Varias Referencias , Ofertas , Tecnoligias-->
                <div class="imagenes-referencias-ofertas-tenologias">

                <?php if (isset($mostrar_imagen_varias_referencias) and $mostrar_imagen_varias_referencias!=false) : ?>
                   <?php if ($id_agrupacion!=0): ?>
                   <!--IMG-Varias Referencias-->
                     <a href="<?=BASE_URL ;?>productos/varias_referencias/<?=$id_agrupacion ;?> ">
                       <div class="img-varias-referencias"  title="Ver Varias Referencias"><!--IMG-varias-referencias -->

                       </div>
                     </a><!--IMG-Varias Referencias-->
                 <?php endif ?>
               <?php endif ?>


                <?php if ($en_oferta ==1): ?>
                  <!--IMG-ofertas -->
                  <div class="img-ofertas" title="Producto en Oferta">

                  </div> <!--IMG-ofertas -->
               <?php endif ?>

                <?php if ($fabricado_x_ta ==1): ?>
                <!--IMG-tecnologias -->
                  <div class="img-tecnologias" title="Producto Fabricado por Tecnologias Aplicadas S.A.">

                  </div> <!--IMG-tecnologias -->
                <?php endif ?>

                </div>
                <!--IMG = Varias Referencias , Ofertas , Tecnoligias-->
              <p class="text-center">
                <a href="<?=BASE_URL ;?>productos/vista_ampliada/<?= $idproducto;?>/<?= $Id_Area_Consulta;?> ">
                  <img src="<?=BASE_IMG_PRODUCTOS_150x150. $nombre_imagen;?>" class="img-responsive" id="img-prod">
                  <div  class="div-destacados-index-nomproducto" id ="<?= $idnomproducto  ;?>">
                      <h5  class="text-center" ><?=$nom_producto ;?> </h5> <br><br>
                  </div>
                  <div class="div-destacados-index-nompresentacion" id ="<?=  $idnompresentacion  ;?>">
                    <small><?=$nompresentacion ;?> </small>
                  </div>
                </a>
               </p>
               <div>
                <!-- Precio Clientes Ocasional -->
                <p class="text-center"><strong><?=$pv_ocasional;?></strong>
                   <span><img src="<?=BASE_IMG_TIENDA;?>18.png"   title="Precio Público / Comprador Ocasional" ></span>
                </p>
                </div>

                <!--PRECIO AMIGO TRON-->
                <p class="priceTRONProd  text-center" >
                   <span  id="<?= $id_precio_final_tron ;?>">  <?=$pv_tron;?> </span>
                   <span class="tipee2"><img src="<?=BASE_IMG_TIENDA;?>17.png"   title="Precio Plan Cliente TRON" ></span>
                   <span class="tipee3"><img src="<?=BASE_IMG_TIENDA;?>16.png"   title="Precio Plan Empresario TRON" ></span>
                </p><br>


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
                     <button type="button" class="agregar  boton-agregar-carrito" id="<?=$id_controles ;?>">
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
