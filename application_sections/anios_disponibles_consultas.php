<h4>Año de Consulta : </h4>
<select class="form-control input_campo_datos" id="anio-consulta">
	<?php
	foreach ($this->Anios as $Anios) {
		echo '<option value="'.$Anios['anio'].'">'.$Anios['anio'].'</option>';
	}
	?>
</select>
