<!-- ENERO 12 DE 2015
    INFORMACIÓN RELACIONADA CON EL CARRITO DE COMPRAS UBICADO EN LA PARTE SUPERIOR DERECHA DEL SITIO.
    DIFIERO DE carrito_header_fijo.php SÓLAMENTE EN LOS ESTILOS APLICADOS PARA LA UBICACIÓN
-->

<div class="row tbl">
  <div class="col-lg-12 col-sm-12 col-md-12 "><!--Fila -->
    <?php Session::Set('imagen_resumen_pedido',FALSE) ;?>

    <a href="<?=BASE_URL ;?>carrito/mostrar_carrito/1"  >
      <div class="  cont-carrito-compras"><!--Contenedor Del carrito -->

          <div class="cont-img-carrito"><!--IMG-Carrito -->

              <img class="imagen-carrito" src="<?= BASE_IMG_TIENDA ; ?>carrito.png"><!--IMG-CARRITO -->

          </div><!--IMG-Carrito -->

          <div class="Cont-precios"><!--PRecios -->

              <div class="precio-ocacional">
                <img class="img-cliente-precios" src="<?=BASE_IMG_PRODUCTOS ;?>18.png"  title="Precio Público / Comprador Ocasional ">
                  <span>
                     <p class="text-right carrito-Total_Parcial_pv_ocasional">
                      <?php
                      if(Session::Get('SubTotal_Pedido_Ocasional')>0)
                      {
                        echo Numeric_Functions::Formato_Numero( Session::Get('SubTotal_Pedido_Ocasional'));
                      }else
                      {
                        ?> $0
                        <?php } ?>
                     </p><!--Precio-Precio Público -->
                  </span>
              </div>

              <div class="precio-cliente-tron">
                <img class="img-cliente-precios" src="<?= BASE_IMG_PRODUCTOS ;?>17.png"  title="Precio Plan Cliente TRON">
                   <span>
                       <img class="img-cliente-precios" src="<?= BASE_IMG_PRODUCTOS ;?>16.png"  title="Precio Plan Empresario TRON">
                   </span>
                   <span>
                       <p class="text-right carrito-Total_Parcial_pv_tron">
                            <?php
                        if(Session::Get('SubTotal_Pedido_Amigos')>0)
                        {
                          echo Numeric_Functions::Formato_Numero( Session::Get('SubTotal_Pedido_Amigos'));
                        }else
                        {
                          ?> $0
                          <?php } ?>
                       </p> <!--Precio-Cliente TRON -->
                   </span>
              </div>

          </div><!--PRecios -->
      </div><!--Contenedor Del carrito -->
    </a>

  </div><!--Fila -->
</div>
    <!--FINAL DE LA TABLA-->


