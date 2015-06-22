<div class="contenedor_from_3">
	   <div class=" row">
          <div class="col-lg-12 col-md-12 col-sm-12">
           <!-- Barra Usuarios -->
            <?php include(APPLICATION_SECTIONS .'barra_usuraios.php') ;?>
            <h5>Seleccione la dirección que desea modificar</h5><br />
											 <div class="col-lg-6 col-md-6 col-sm-6 conteneror-direcciones">
														<?php foreach ($this->Direcciones as $Direccion) :?>
																	<?php
																			$destinatario       = $Direccion['destinatario'];
																			$direccion          = $Direccion['direccion'];
																			$nommcipio_despacho = $Direccion['nommcipio_despacho'];
																			$nomdpto 										 = $Direccion['nomdpto'];
																	?>
																	<a href="#" class="direcciones_a_atualizar" id="direcciones_a_atualizar">
																  	<strong><?= $destinatario  ;?></strong>
					          				<br> <?= $direccion  . " / " . $nommcipio_despacho  . " / " . $nomdpto  ;?>
					          				<!-- <br><br><br><br> -->
																	</a>
														<?php endforeach ;?>
												</div>

         <!-- Formulario -->
           <div class="col-lg-6 col-md-6 col-sm-6">
               <div>
               	   <form class="form-horizontal" role="form">
									            <!-- destinario -->
									              <div class="form-group">
									                <label for="new_destinario"  class="col-lg-3  control-label"><p class="text-label">Destinario:</p></label>
									                <div class="col-lg-9" >
									                   <input type="text" class="form-control" id="new_destinario" />
									                </div>
									              </div>

                     <!-- Departamento -->
									              <div class="form-group">
									                <label for="new_iddpto"  class="col-lg-3  control-label "><p class="text-label">Departamento:</p></label>
									                <div class="col-lg-9" >
									                   <select class="form-control" id="new_iddpto">
									                   	    <option>SELECCIONE</option>
									                   </select>
									                </div>
									              </div>

                     <!-- Municipio -->
									              <div class="form-group">
									                <label for="new_idmcipio"  class=" col-lg-3  control-label "><p class="text-label">Municipio: </p></label>
									                <div class="col-lg-9" >
									                   <select class="form-control" id="new_idmcipio">
									                   	    <option>SELECCIONE</option>
									                   </select>
					 				                </div>
									              </div>

                     <!-- Direccion -->
									              <div class="form-group">
									                <label for="new_direccion"  class="col-lg-3  control-label "><p class="text-label">Dirección: </p></label>
									                <div class="col-lg-9" >
									                   <input type="text" class="form-control" id="new_direccion" />
									                </div>
									              </div>

                     <!-- Barrio -->
									              <div class="form-group">
									                <label for="new_barrio"  class="col-lg-3  control-label "><p class="text-label">Barrio: </p></label>
									                <div class="col-lg-9" >
									                   <input type="text" class="form-control" id="new_barrio" />
									                </div>
									              </div>

                     <!-- Telefono -->
									              <div class="form-group">
									                <label for="new_celular1"  class="col-lg-3  control-label "><p class="text-label">Celular: </p></label>
									                <div class="col-lg-9" >
									                   <input type="text" class="form-control" id="new_celular1" />
									                </div>
									              </div>

                     <!-- Btn = crear / actualizar direccion -->
                       <div class="col-lg-12 col-md-12 col-sm-12">
                       	   <div class="text-center">
                       	   	   <button type="button" class="btn_atualizar_direccion" id="btn_direccion">Crear / Actualizar Dirección</button>
                       	   </div>
                       </div>
               	   </form>
               </div>
           </div>

          </div>
     </div>
</div>


