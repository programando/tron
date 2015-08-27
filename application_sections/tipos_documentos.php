 <select class="form-control input_campo_datos" id="idtpidentificacion">
 <option value="0">Seleccione....</option>
 	<?php
 	foreach ($this->TiposDocumentos as $Documento) {
 		echo '<option value="'.$Documento['idtpidentificacion'].'">'.$Documento['nomtpidentificacion'].'</option>';
 	}
 	?>
 </select>
