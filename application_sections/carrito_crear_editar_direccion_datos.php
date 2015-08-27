      <div class=" cont-direccion"  ><!-- Direccion  1 -->
       <label for="direccion<?= $I ;?>" class="direccion1" id="label<?= $I ;?>">
         <input type="radio" name="direccion-usuario" id="direccion<?= $I ;?>"
         class                 ="input-checkbox-direccion"
         iddirecciondespacho   = <?= $IdDireccion_Depacho ;?>
         idmcipio              = <?= $IdMcipio ;?>
         iddpto                = <?= $IdDpto ;?>
         reexpedicion          = <?= $Re_Expedicion;?>
         numero-opcion         = <?= $I ;?>
         nombre-usuario-pedido = <?= $Nombre_Usuario_Pedido ;?>
         nommcipio           = <?= "'".$NomMcipio."'"   ;?>
         nomdpto             = <?= "'".$NomDpto."'"   ;?>
         >

         <div class="direccion">
          <?= $Destinatario ;?>
          <br>
          <strong><?= $Destino  ;?></strong>
          <br> <?= $Barrio  . " / " . $NomMcipio  . " / " . $NomDpto ;?>
        </div>
        <!-- /// Ventana modal ///  data-toggle="modal" data-target="#venta_editar"-->
        <a href="#venta_editar"
            class="btn-editar-direccion"
            iddirecciondespacho = <?= $IdDireccion_Depacho ;?>
            destinatario        = <?= "'".$Destinatario."'"  ;?>
            iddpto              = <?= $IdDpto  ;?>
            idmcipio            = <?= $IdMcipio ;?>
            direccion           = <?= "'".$Destino."'"  ;?>
            barrio              = <?= "'".$Barrio."'"  ;?>
            telefono            = <?= "'".$telefono."'"   ;?>
            nommcipio           = <?= "'".$NomMcipio."'"   ;?>
            nomdpto             = <?= "'".$NomDpto."'"   ;?>
            >
          <img src="<?= BASE_IMG_TIENDA ;?>editar.png" class="img-editar">
        </a>

      </label>
    </div><!-- Direccion  1 -->
