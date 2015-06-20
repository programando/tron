<div class="contenedor_from_3">
	   <div class=" row">
          <div class="col-lg-12 col-md-12 col-sm-12">
           <!-- Barra Usuarios -->
            <?php include(APPLICATION_SECTIONS .'barra_usuraios.php') ;?>
            <h5>Seleccione la dirección que desea modificar</h5><br />
											 <div class="conteneror-direcciones">
														<?php foreach ($this->Direcciones as $Direccion) :?>
																	<?php
																			$destinatario       = $Direccion['destinatario'];
																			$direccion          = $Direccion['direccion'];
																			$nommcipio_despacho = $Direccion['nommcipio_despacho'];
																			$nomdpto 										 = $Direccion['nomdpto'];
																	?>
																	<a href="">
																  	<strong><?= $destinatario  ;?></strong>
					          				<br> <?= $direccion  . " / " . $nommcipio_despacho  . " / " . $nomdpto  ;?>
					          				<br><br><br><br>
																	</a>
														<?php endforeach ;?>
												</div>
          </div>
     </div>
</div>


