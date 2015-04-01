<select class="form-control" id="departamento">
	<option value="0">Seleccione un Departamento</option>
	<?php
	foreach ($this->Departamentos as $Departamento) {
		echo '<option value="'.$Departamento['iddpto'].'">'.$Departamento['nomdpto'].'</option>';
	}
	?>
</select>
