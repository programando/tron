
<!--  AGOSTO 25 DE 2016
						$NumSelectDpto
						Contador del select del departamento , Necesario para actualizar los municipios por fila
						Este dato lo uso en la modificacion de direcciones
	-->
<?php

						if ( !isset( $NumSelectDpto ))	{
							$NumSelectDpto = -1;
						}
?>

<select class="form-control input_campo_datos" id="iddpto" idselectdpto="<?= $NumSelectDpto ;?>">

			<?php if ( isset( $iddpto_previo )) :?>
								<option value="<?= $iddpto_previo ;?>"  > <?= $nomdpto_previo ;?> </option>
					<?php else :?>
							<option value="0" ">Seleccione un Departamento</option>
			<?php endif ;?>

			<?php 	foreach ($this->Departamentos as $Departamento) : ?>
					<option value ="<?=$Departamento['iddpto'] ;?>"  > <?= $Departamento['nomdpto'] ;?> </option>
		 <?php endforeach ;?>

</select>
