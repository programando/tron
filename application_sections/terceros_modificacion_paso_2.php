<div class="contenedor_from_2">
	   <div class="row">
	   	  <!-- Formulario -->
	   	  <div>
           <div class="col-lg-12 col-md-12 col-sm-12">
               <div>
               	   <form class="form-horizontal" role="form" role="form">
																				<!-- option 1  -->
																				<div class="checkbox">
																				  <label>
																				    <input type="checkbox" id="param_confirmar_nuevos_amigos_x_email"
																				    checked="<?= $this->param_confirmar_nuevos_amigos_x_email ;?>"
																				    value="">
																				     <span class="text-justify">Recibir confirmacion en mi correoeletronico cuando un amigo ingresa a mi red.</span>
																				  </label>
																				</div><br>

																				<!-- Option 2 -->
																				<div class="checkbox">
																				  <label>
																				    <input type="checkbox" id="mis_datos_son_privados"
																				    value=""
																				    checked="<?= $this->mis_datos_son_privados ;?>">

																				    Establecer mi dirección de correo eletrónico y mi número de celular como datos privados ,  es decir , no estarán disponibles en consultas de otros usuarios de la red.
																				  </label>
																				</div><br>

																				<!-- Option 3 -->
																				<div class="checkbox">
																				  <label>
																				    <input type="checkbox" id="declaro_renta" value=""
																				    checked="<?= $this->declaro_renta ;?>">
					                   Certifico que soy declarante de impuesto sobre la renta.
																				  </label>
																				</div><br>


				              <!-- Tiutulo = Pedidos -->
				               <div>
				               	   <div class="col-lg-12 col-md-12 col-sm-12">
				                        <p class="subtitulos_form2"><strong>Pedidos</strong></p>
				               	   </div>
				               </div><br><br>

																			<!-- option 4 -->
																			<div class="checkbox">
																			  <label>
																			    <input type="checkbox" id="param_acepto_retencion_comis_para_pago_pedidos" value=""
																			    checked="<?= $this->param_acepto_retencion_comis_para_pago_pedidos ;?>">
																			    Acepto que se retenga de mis comisiones, de manera indefinida y mientras no modifique este registro, la suma de :<strong>
																			    	<input type="text" name="" value="<?= $this->param_valor_comisiones_para_pago_pedidos;?>"
																			    	id ='param_valor_comisiones_para_pago_pedidos'
																			    	valor-pago-pedidos = "<?= $this->param_valor_comisiones_para_pago_pedidos;?>">
																			    </strong>para el pago de mis pedidos.
																			  </label>
																			</div><br>

				              <!-- Tiutulo = Forma de pago de comisiones-->
				               <div>
				               	   <div class="col-lg-12 col-md-12 col-sm-12">
				                        <p class="subtitulos_form2"><strong>Forma de pagos de Comisiones </strong></p>
				               	   </div>
				               </div><br><br>

																			<!-- Efecty -->
																			<div class="checkbox">
																			  <label>
																			    <input type="checkbox" id="efecty" value="option5">
																			    Efecty
																			  </label>
																			</div><br>

																			<!-- option 6 -->
																			<div class="checkbox">
																			  <label>
																			    <input type="checkbox" id="opcion6" value="option6">
                       <span class="">
																			    Transferencia a mi cuenta bancaria.
																			    Asumo el valor <strong> $4.500</strong>que corresponde al costo de la transferencia electrónica a mi cuenta para el pago de mis comisiones. Autorizo que las comisones se transfieran a mi cuenta siempre que sean mayores a <strong>$10.000</strong>.
                       </span>
																			  </label>
																			</div><br>
                 </form>
               </div>

              <!-- Certificacion que la cuenta me pertenece -->
              <div>
                 <div class="col-lg-12 col-md-12 col-sm-12">
            	  	    <div>
           	  	    	   <div class="text-center">
           	  	    	   	    <strong>Datos de la cuenta para la transferencia de comisiones</strong><br>
           	  	    	   	    ( Certifico que la cuenta se encuentra a mi nombre ).
           	  	    	   </div>
           	  	    </div>
                 </div><br><br><br>

                 <!-- Formulario -->
                 <div class="form_sobre_banco">
                 	   <div class="col-lg-12 col-md-12 col-sm-12">
                 	   	   <form class="form-horizontal" role="form" role="form">
																			        <!-- Nombre del banco -->
																			         <div class="form-group">
																			           <label for="nombre_banco" class="col-lg-5 control-label"> <p class="text-left text-label"> Nombre del banco: </p></label>
																			           <div class="col-lg-7">
																			             <input type="" class="form-control" id="nombre_banco">
																			           </div>
																			         </div>

																			        <!-- Numero de la cuenta -->
																			         <div class="form-group">
																			           <label for="numero_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Numero de la cuenta: </p></label>
																			           <div class="col-lg-7">
																			             <input type="" class="form-control" id="numero_cuenta">
																			           </div>
																			         </div>

																				        <!-- Tipo de cuenta -->
																				         <div class="form-group">
																				           <label for="Tipo_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Tipo de cuenta: </p></label>
																				           <div class="col-lg-7">
																				             <select class="form-control" id="Tipo_cuenta">
																				             	    <option value="">SELECCIONE</option>
																				             </select>
																				           </div>
																				         </div>

																						        <!-- Departamento -->
																						         <div class="form-group">
																						           <label for="departamento" class="col-lg-5 control-label"> <p class="text-left text-label"> Departamento: </p></label>
																						           <div class="col-lg-7">
																						             <select class="form-control" id="departamento">
																						             	    <option value="">SELECCIONE</option>
																						             </select>
																						           </div>
																						         </div>

																							        <!-- Ciudad origen cuenta -->
																							         <div class="form-group">
																							           <label for="ciudad_origen_cuenta" class="col-lg-5 control-label"> <p class="text-left text-label"> Ciudad origen cuenta: </p></label>
																							           <div class="col-lg-7">
																							             <select class="form-control" id="ciudad_origen_cuenta">
																							             	    <option value="">SELECCIONE</option>
																							             </select>
																							           </div>
																							         </div>
                 	   	   </form>
                 	   </div>
                 </div>
              </div>
            </div>
         </div>
       </div>
      </div>

