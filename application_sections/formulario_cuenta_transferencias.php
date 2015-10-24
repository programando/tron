<!-- formulario de trasnferencia de pago -->
<div class="col-lg-12 col-md-12 col-sm-12">
  <form class="form-horizontal" role="form" role="form">
     <!-- Titular -->
      <div class="form-group">
        <label for="" class="col-lg-4 control-label"> <p class="text-left text-label"> Titular :</p></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="">
        </div>
      </div>

      <!-- Tipo de indentidad -->
      <div class="form-group">
      	  <div class="row-fluid">
      	  	 <div class="">
             <label class="col-lg-4 control-label"><p class="text-left text-label"> Tipo de indentificacion :</p></label>
           <div class="col-lg-8">
           <!-- cedula -->
												<div class="form-group">
													  <div class="radio">
												     <label class="col-lg-2 control-label radio_cedula" style="padding-left: 35px;">
												        <input type="radio" value="option1">Cedula
												     </label>
												    <div class="col-lg-10">
												    	   <input type="text" class="form-control" id="">
												    </div>
												   </div>
												</div>
           <!-- Nit -->
												<div class="form-group">
													  <div class="radio">
												     <label class="col-lg-2 control-label radio_nit" style="padding-left: 35px; padding-right: 30px;">
												        <input type="radio" value="option2">Nit
												     </label>
												    <div class="col-lg-10">
												    	   <input type="text" class="form-control" id="">
												    </div>
												   </div>
												</div>
      	  	 </div>
      	  	 </div>
      	  </div>
      </div>
      <!-- nombre del bacno -->
      <div class="form-group">
        <label for="nombre_banco" class="col-lg-4 control-label"> <p class="text-left text-label"> Nombre del banco: </p></label>
        <div class="col-lg-8">
									<select class="form-control" id="param_idbanco_transferencias">
										<option value="<?= $this->param_idbanco_transferencias ;?>"><?= $this->nombre_banco_transferencias ;?></option>
													<?php
																	foreach ($this->Bancos as $Banco) {
																				echo '<option value="'.$Banco['param_idbanco_transferencias'].'">'.$Banco['nombre_banco_transferencias'].'</option>';
															}
												?>
									</select>
        </div>
      </div>
      <!-- numero de cuenta -->
      <div class="form-group">
        <label for="numero_cuenta" class="col-lg-4 control-label"> <p class="text-left text-label"> Número de la cuenta: </p></label>
        <div class="col-lg-8">
          <input type="" class="form-control" id="param_nro_cuenta_transferencias" value ="<?= $this->param_nro_cuenta_transferencias ;?>">
        </div>
      </div>
      <!-- tipo de cuenta -->
       <div class="form-group">
         <label for="Tipo_cuenta" class="col-lg-4 control-label"> <p class="text-left text-label"> Tipo de cuenta: </p></label>
         <div class="col-lg-8">
           <select class="form-control" id="param_tipo_cuenta_transferencias">
           	    <option value="0">SELECCIONE</option>
           	    <option value="1">AHORROS</option>
           	    <option value="2">CORRIENTE</option>
           </select>
         </div>
       </div>
  </form>
</div>



<!--
                 	   <div class="col-lg-12 col-md-12 col-sm-12">
                 	   	   <form class="form-horizontal" role="form" role="form">

																			         <div class="form-group">
																			           <label for="nombre_banco" class="col-lg-5 control-label"> <p class="text-left text-label"> Nombre del banco: </p></label>
																			           <div class="col-lg-7">
																															<select class="form-control" id="param_idbanco_transferencias">
																																<option value="<?= $this->param_idbanco_transferencias ;?>"><?= $this->nombre_banco_transferencias ;?></option>
																																			<?php
																																							foreach ($this->Bancos as $Banco) {
																																										echo '<option value="'.$Banco['param_idbanco_transferencias'].'">'.$Banco['nombre_banco_transferencias'].'</option>';
																																					}
																																		?>
																															</select>
																			           </div>
																			         </div>


																			         <div class="form-group">
																			           <label for="numero_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Número de la cuenta: </p></label>
																			           <div class="col-lg-7">
																			             <input type="" class="form-control" id="param_nro_cuenta_transferencias" value ="<?= $this->param_nro_cuenta_transferencias ;?>">
																			           </div>
																			         </div>


																				         <div class="form-group">
																				           <label for="Tipo_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Tipo de cuenta: </p></label>
																				           <div class="col-lg-7">
																				             <select class="form-control" id="param_tipo_cuenta_transferencias">
																				             	    <option value="0">SELECCIONE</option>
																				             	    <option value="1">AHORROS</option>
																				             	    <option value="2">CORRIENTE</option>
																				             </select>
																				           </div>
																				         </div>


																						         <div class="form-group">
																						           <label for="departamento" class="col-lg-5 control-label"> <p class="text-left text-label"> Departamento: </p></label>
																						           <div class="col-lg-7">
																																	<select class="form-control input_campo_datos" id="iddpto_transferencia">
																																	<?php if ( $this->iddpto_transferencia  > 0 ) :?>
																																		<option value="<?= $this->iddpto_transferencia ;?>"><?= $this->nomdpto_transferencia ;?></option>
																																	<?php else :?>
																																		<option value="0">SELECCIONE DEPARTAMENTO</option>
																																	<?php endif; ?>
																																					<?php
																																									foreach ($this->Departamentos as $Departamento) {
																																												echo '<option value="'.$Departamento['iddpto'].'">'.$Departamento['nomdpto'].'</option>';
																																							}
																																				?>
																																	</select>
																						           </div>
																						         </div>

																							         <div class="form-group">
																							           <label for="ciudad_origen_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Ciudad origen cuenta: </p></label>
																							           <div class="col-lg-7">
																							             <select class="form-control" id="param_idmcipio_transferencias">
																							             	    <option value="">SELECCIONE</option>
																							             </select>
																							           </div>
																							         </div>
                 	   	   </form>
                 	   </div>
 -->
