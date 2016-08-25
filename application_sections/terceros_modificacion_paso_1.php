<div class="contenedor_from_1">
	   <div class="row">
<br>
      <!-- Campo NIT -->
       <?php if ( $this->idtpidentificacion == 31 ) :?>
        <div class=" well col-lg-12 col-md-12 col-sm-12 " style="padding: 0px; display: " id="campos_nit">

             <div class="col-lg-6 col-sm-6 col-md-6 " style="padding: 0px;">
		             <!-- Numero NIT -->

						         <div class="form-group">
						           <label for="numero_nit" class="col-lg-5 control-label"> <p class="text-left text-label"> Número NIT : </p></label>
						           <div class="col-lg-7">
						             <input type="text" class="form-control" id="identificacion" value = "<?= $this->identificacion ;?>" disabled='disabled'>
						           </div>
						         </div>
             </div>

             <div class="col-lg6 col-sm-6 col-md-6 " style="padding: 0px;">
							        <!-- Numero D.V -->
							         <div class="form-group">
							           <label for="numero_dv" class="col-lg-5 control-label"> <p class="text-left text-label"> D.V: </p></label>
							           <div class="col-lg-7">
							             <input type="text" class="form-control" id="digitoverificacion" value = "<?= $this->digitoverificacion ;?>" disabled='disabled'>
							           </div>
							         </div>
             </div>

             <div class="col-lg-12 col-md-12 col-sm-12 " style="padding: 0px; margin: 15px 0px;">
             	  <div class="form-group">
							           <label for="numero_dv" class="col-lg-3 control-label" style="width: 180px;"> <p class="text-left text-label"> Razón Social: </p></label>
							           <div class="col-lg-9" style="padding-left: 0px; width: 610px;">
							             <input type="text" class="form-control" id="razonsocial" "<?= $this->razonsocial ;?>" >
							           </div>
							         </div>
             </div>

        </div><br>
							<?php endif ;?>

	       <!-- Columna  Left -->
        <div>
	         <div class="col-lg-6 col-md-6 col-sm-6">
	         	   <div>
                  <form class="form-horizontal" role="form" role="form">
 													        <!-- identificacion -->
 													        <?php if ( $this->idtpidentificacion != 31 ) :?>
														         <div class="form-group">
														           <label for="identificacion_nat" class="col-lg-5 control-label"> <p class="text-left text-label"> Identificación: </p></label>
														           <div class="col-lg-7">
														             <input type="text" class="form-control" id="identificacion_nat" disabled="disabled"
														             value="<?= $this->identificacion_nat ;?>">
														           </div>
														         </div>
													        <?php endif;?>

													        <!-- Nombres -->
													         <?php if ( $this->idtpidentificacion != 31 ) :?>
															         <div class="form-group">
															           <label for="pnombre" class="col-lg-5 control-label"> <p class="text-left text-label"> Nombres: </p></label>
															           <div class="col-lg-7">
															             <input type="text" class="form-control" id="pnombre" value="<?= $this->pnombre ;?>">
															           </div>
		                      </div>
																						<?php endif;?>
													        <!-- Pais -->
													         <div class="form-group">
													           <label for="idpais" class="col-lg-5 control-label"> <p class="text-left text-label"> Pais: </p></label>
													           <div class="col-lg-7">
																	         <select  class="form-control input_campo_datos" id="idpais" tabindex="9">
																	           <option value="1">Colombia</option>
																	         </select>
													           </div>
													         </div>

													        <!-- Municipio -->
													         <div class="form-group">
													           <label for="idmcipio" class="col-lg-5 control-label"> <p class="text-left text-label"> Municipio: </p></label>
													           <div class="col-lg-7">
																			        <select class="form-control input_campo_datos" id="idmcipio">

																			          <option value="<?= $this->idmcipio ;?>"
																			          tabindex="11"> <?= $this->nommcipio ;?></option>
																			        </select>
													           </div>
													         </div>

													        <!-- Barrio -->
													         <div class="form-group">
													           <label for="barrio" class="col-lg-5 control-label"> <p class="text-left text-label"> Barrio: </p></label>
													           <div class="col-lg-7">
													             <input type="text" class="form-control" id="barrio"
													             value="<?= $this->barrio ;?>">
													           </div>
													         </div>

                     <!-- Incluir = Nueva Contraseña ,  Confirmar Contraseña -->
									             <div>
									                <?php include (APPLICATION_SECTIONS . 'editar_password.php');?>
									             </div>


                  </form>
	         	   </div>
	         </div>
        </div>

         <!-- Columna Right-->
         <div>
	         <div class="col-lg-6 col-md-6 col-sm-6">
	         	   <div>
	         	     <form class="form-horizontal" role="form" role="form">
 													        <!-- Correo electronico -->
													         <div class="form-group">
													           <label for="email" class="col-lg-5 control-label"> <p class="text-left text-label"> Correo electrónico: </p></label>
													           <div class="col-lg-7">
																											<input type="email" class="form-control" id="email" 	value="<?= $this->email ;?>">
																											<input type="hidden" class="form-control" id="email-oculto" 	value="<?= $this->email ;?>">
													           </div>
													         </div>

                     <!-- Apellido -->
                     <?php if ( $this->idtpidentificacion != 31 ) :?>
														         <div class="form-group">
														           <label for="papellido" class="col-lg-5 control-label"> <p class="text-left text-label"> Apellido: </p></label>
														           <div class="col-lg-7">
																													<input type="text" class="form-control" id="papellido"
																													value="<?= $this->papellido ;?>">
														           </div>
														         </div>
														         <?php endif ;?>


													        <!-- Departamento -->
													         <div class="form-group">
													           <label for="iddpto" class="col-lg-5 control-label"> <p class="text-left text-label"> Departamento: </p></label>
													           <div class="col-lg-7">
																						<select class="form-control input_campo_datos" id="iddpto">
																							<option value="<?= $this->iddpto ;?>"><?= $this->nomdpto ;?></option>
																										<?php
																														foreach ($this->Departamentos as $Departamento) {
																																	echo '<option value="'.$Departamento['iddpto'].'">'.$Departamento['nomdpto'].'</option>';
																												}
																									?>
																						</select>
													           </div>
													         </div>

													        <!-- Direccion -->
													         <div class="form-group">
													           <label for="direccion" class="col-lg-5 control-label"> <p class="text-left text-label"> Dirección: </p></label>
													           <div class="col-lg-7">
													             <input type="text" class="form-control" id="direccion"
													             value="<?= $this->direccion ;?>">
													           </div>
													         </div>

													        <!-- Celular -->
													         <div class="form-group">
													           <label for="celular1" class="col-lg-5 control-label"> <p class="text-left text-label"> Celular: </p></label>
													           <div class="col-lg-7">
													             <input type="text" class="form-control" id="celular1"
													             value="<?= $this->celular1 ;?>">
													           </div>
													         </div>

																					<!-- Recibir mensajes de texto de informacion comercial y pormociones -->

																					<div class="checkbox">
																					  <label>
																					    <input type="checkbox" id="recibo_promociones_celular" value=""
																													<?php if ( $this->recibo_promociones_celular == TRUE) : ?> checked="checked" <?php endif ;?>
																					    >
																					    Recibir mensajes de texto de información comercial y promociones.
																					  </label>
																					</div><br>

                    <!-- Recibir correos de informacion comercial y pormociones -->
																					<div class="checkbox">
																					  <label>
																					    <input type="checkbox" id="recibo_promociones_email" value=""
																					    <?php if ( $this->recibo_promociones_email == TRUE) : ?> 	checked="checked" 	<?php endif ;?>
																					    >
																					    Recibir correos de información comercial y promociones.
																					  </label>
																					</div>

													    </form>
	         	   </div>
	         </div>
         </div>
	   </div>
</div>
