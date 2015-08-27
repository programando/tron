<select class="form-control input_campo_datos" id="iddpto">
	<option value="0">Seleccione un Departamento</option>
	<?php
	foreach ($this->Departamentos as $Departamento) {
		echo '<option value="'.$Departamento['iddpto'].'">'.$Departamento['nomdpto'].'</option>';
	}
	?>
</select>
