<!-- formulario de trasnferencia de pago -->
<div class="col-lg-12 col-md-12 col-sm-12">
  <form class="form-horizontal" role="form" role="form">
     <!-- Titular -->
      <div class="form-group">
        <label for="" class="col-lg-4 control-label"> <p class="text-left text-label"> Titular :</p></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="param_nombre_titular_cuenta" value ="<?= $this->param_nombre_titular_cuenta ;?>">
        </div>
      </div>

      <!-- Tipo de indentidad -->
      <div class="form-group">
      	  <div class="row-fluid">
      	  	 <div class="">
             <label class="col-lg-4 control-label"><p class="text-left text-label"> Tipo de indentificación :</p></label>
           <div class="col-lg-8">
           <!-- cedula -->
												<div class="form-group">
													  <div class="radio" id="param_idtpidentificacion_titular_cuenta"  >

												     <label class="col-lg-4 control-label radio_cedula">
												     		 <?php if ( $this->param_idtpidentificacion_titular_cuenta == '13' ): ?>
												        	<input type="radio" value="13" name='param_idtpidentificacion_titular_cuenta' checked="checked">Cédula
												        <?php else :?>
																					<input type="radio" value="13" name='param_idtpidentificacion_titular_cuenta' >Cédula
												        <?php endif ;?>
												     </label>

												      <label class="col-lg-4 control-label radio_nit">
												       		<?php if ( $this->param_idtpidentificacion_titular_cuenta == '31' ): ?>
												        	<input type="radio" value="31" name='param_idtpidentificacion_titular_cuenta' checked="checked">Nit
												        <?php else :?>
																					<input type="radio" value="31" name='param_idtpidentificacion_titular_cuenta'>Nit
												        <?php endif ;?>

												     </label>

												   </div>
												   <br>
												   <div class="col-lg-8">
												    	   <input type="text" class="form-control" id="param_identificacion_titular_cuenta"
												    	   value="<?= $this->param_identificacion_titular_cuenta ;?>">
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
           <select class="form-control" id="param_tipo_cuenta_transferencias" name="param_tipo_cuenta_transferencias">
           		   <?php $Tipo_Cuenta = $this->param_tipo_cuenta_transferencias ;?>

           		   <?php if ( $Tipo_Cuenta =='AH' ) :?>
           		   		<option  value="<?= $this->param_tipo_cuenta_transferencias ;?>"><?= $this->nom_tipo_cuenta_transferencia ;?></option>
																		<option  value="CO" >CORRIENTE</option>
																<?php endif ;?>

           		   <?php if ( $Tipo_Cuenta =='CO' ) :?>
           		   		<option  value="<?= $this->param_tipo_cuenta_transferencias ;?>"><?= $this->nom_tipo_cuenta_transferencia ;?></option>
																		<option  value="AH" >AHORROS</option>
																<?php endif ;?>



           </select>
         </div>
       </div>
  </form>
</div>


