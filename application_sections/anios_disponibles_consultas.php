 <div>
	   <div class="row">
	   	   <div class="col-lg-3" style="width:177px; ">
             <h4>Año de Consulta : </h4>
         </div>

	   	   <div class="col-lg-9">
											<select class="form-control input_campo_datos" id="anio-consulta" style="width: 100px; padding-left: 0px;">
												<?php
												foreach ($this->Anios as $Anios) {
													echo '<option value="'.$Anios['anio'].'">'.$Anios['anio'].'</option>';
												}
												?>
											</select>
	   	   </div>
	   </div>
</div>

