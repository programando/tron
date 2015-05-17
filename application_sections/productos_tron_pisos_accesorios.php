<?php if(isset($this->Accesorios_Tron_Pisos)) :?>

        <div><!--Titulo-->
         <p class="titulo_de_accesorios"> <strong>ACCESORIOS</strong> </p>
       </div><!--Titulo-->

    <div class="row">

       <!--Primer Accesorio-->

        <?php foreach($this->Accesorios_Tron_Pisos as $Productos )
        {
              include (APPLICATION_CODS . 'campos_productos.php');
          ?>

          <div class="col-lg-6 col-md-6 col-sm-6">
          <div class=" col-lg-6 col-md-6 col-sm-6"><!--IMG-Accesorio-->
            <img src="<?= BASE_IMG_PRODUCTOS_150x150 . $nombre_imagen ;?>" class="img-responsive">
          </div><!--Fin-IMG-Accesorio-->

          <div class="col-lg-6 col-md-6 col-sm-6"><!--Datos acerca del Accesorio -->
            <p class="text-center datos_acerca_del_accesorio"> <small> <?= $nom_producto  ;?> </small> </p>
            <p class="precios_accesorio"> <?= $text_pv_comprador_ocasional ;?> </p>
            <p class="precios_accesorio-rojo"> <strong>  <?=  $text_pv_tron  ;?> </strong></p>

            <div class="row"><!--Botones Del Accesorio -->
              <div class="costos-cantidad">
                <form class="form-horizontal" role="form">

                  <div class=" col-xs-4" id="cont-menos">
                    <div class="form-group"><!--Inicio  Boton Menos-->
                      <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carritoTronMenos"
                        onclick="javascript: Carrito_RestarTRON('<?=$id_controles ;?>')"  >-
                      </button><!-- Fin Boton Menos-->
                    </div>
                  </div>

                   <div class="col-xs-4" id="cont-digitos">
                      <div class="form-group"><!--Inicio Input-->
                         <input type        = "text"  value="<?= $Cantidad_Comprada ;?> "
                          id                = "<?=$id_controles ;?>"
                          class             = "digitos btn-carrito-input CantProdCompraTronFragancias"
                          precio-amigo-tron = "<?= $id_pv_tron ;?>"
                           idproducto        =  "<?= $idproducto ;?>"
                          es-tron           =  "false"
                          es-tron-acc       = "true"
                          >
                      </div><!--Fin Input-->
                   </div>
                 <div class=" col-xs-4" id="cont-mas">
                  <div class="form-group"><!-- Inicio Boton Mas-->
                    <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carritoTronMas"
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
