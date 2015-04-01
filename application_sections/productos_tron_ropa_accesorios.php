<?php if(isset($this->Accesorios)) :?>

        <div><!--Titulo-->
         <p class="titulo_de_accesorios"> <strong>ACCESORIOS</strong> </p>
       </div><!--Titulo-->

    <div class="row">

       <!--Primer Accesorio-->

        <?php foreach($this->Accesorios as $Accesorios )
        {
           $id_controles                = 'cantidad'.$Accesorios['idproducto'];
           $id_pv_tron                  = $Accesorios['pv_tron'];
           $idescala                    = $Accesorios['idescala'];
           $idproducto                  = $Accesorios['idproducto'];
           $nombre_imagen               = $Accesorios['nombre_imagen'];
           $pv_comprador_ocasional      = $Accesorios['pv_ocasional'];
           $pv_tron                     = $Accesorios['pv_tron'];
           $pv_tron_escala_a            = $Accesorios['pv_tron_escala_a'];
           $pv_tron_escala_b            = $Accesorios['pv_tron_escala_b'];
           $pv_tron_escala_c            = $Accesorios['pv_tron_escala_c'];
           $text_pv_comprador_ocasional = Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
           $text_pv_tron                = Numeric_Functions::Formato_Numero($pv_tron );

          ?>

          <div class="col-lg-6 col-md-6 col-sm-6">
          <div class=" col-lg-6 col-md-6 col-sm-6"><!--IMG-Accesorio-->
            <img src="<?= BASE_IMG_PRODUCTOS_150x150 . $nombre_imagen ;?>" class="img-responsive">
          </div><!--Fin-IMG-Accesorio-->

          <div class="well col-lg-6 col-md-6 col-sm-6"><!--Datos acerca del Accesorio -->
            <p class="text-center datos_acerca_del_accesorio"> <small> <?= $nom_producto  ;?> </small> </p>
            <p class="precios_accesorio"> <?= $text_pv_comprador_ocasional ;?> </p>
            <p class="precios_accesorio-rojo"> <strong>  <?=  $text_pv_tron  ;?> </strong></p>

            <div class="row"><!--Botones Del Accesorio -->
              <div class="costos-cantidad">
                <form class="form-horizontal" role="form">

                  <div class=" col-xs-4" id="cont-menos">
                    <div class="form-group"><!--Inicio  Boton Menos-->
                      <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carrito"
                        onclick="javascript: Carrito_RestarTRON('<?=$id_controles ;?>')"  >-
                      </button><!-- Fin Boton Menos-->
                    </div>
                  </div>

                   <div class="col-xs-4" id="cont-digitos">
                      <div class="form-group"><!--Inicio Input-->
                         <input type        = "text"  value="0"
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
            </div>
          </div><!--Botones Del Accesorio -->
        </div><!--Fin-Datos acerca del Accesorio -->

      </div>
      <!--Primer Accesorio-->
      <?php };?>
</div>
<?php endif;?>
