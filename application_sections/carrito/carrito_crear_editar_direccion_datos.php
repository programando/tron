<label for="direccion<?= $I ;?>" class="direccion1" id="label<?= $I ;?>">

    <div class="cont-direccion"><!-- Direccion  1 -->

		<div class="tabAll">

    		<div class="tabIn p5">
                <input type="radio" name="direccion-usuario" id="direccion<?= $I ;?>"
                    class                 ="input-checkbox-direccion"
                    iddirecciondespacho   = <?= $IdDireccion_Depacho ;?>
                    idmcipio              = <?= $IdMcipio ;?>
                    iddpto                = <?= $IdDpto ;?>
                    reexpedicion          = <?= $Re_Expedicion;?>
                    numero-opcion         = <?= $I ;?>
                    nombre-usuario-pedido = <?= $Nombre_Usuario_Pedido ;?>
                    nommcipio             = <?= "'".$NomMcipio."'"   ;?>
                    nomdpto               = <?= "'".$NomDpto."'"   ;?>
                    codigousuario         = <?= "'".$CodigoUsuario."'"   ;?>
                />
        	</div>
            <div class="tabIn ff1 p20">
            	<div class="t12"><?= $Destinatario ;?></div>
                <strong><?= $Destino  ;?></strong>
				<div><?= $Barrio  . " / " . $NomMcipio  . " / " . $NomDpto ;?></div>
    		</div>
            <div class="tabIn" style="width:50px">
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
                codigousuario       = <?= "'".$CodigoUsuario."'"   ;?>
                >
                    Editar
                    <img src="<?= BASE_IMG_TIENDA ;?>editar.png" width="48" title="Editar Dirección" />
                </a>
            </div>

    	</div>

	</div><!-- Direccion  1 -->

</label>
