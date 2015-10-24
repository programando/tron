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
																				    <input type="checkbox" id="param_confirmar_nuevos_amigos_x_email" value=""
																									<?php if ( $this->param_confirmar_nuevos_amigos_x_email == TRUE) : ?> checked="checked" <?php endif ;?>
																				    >
																				     <span class="text-justify">Recibir confirmación en mi correo electrónico cuando un amigo ingresa a mi red.</span>
																				  </label>
																				</div><br>

																				<!-- Option 2 -->
																				<div class="checkbox">
																				  <label>
																				    <input type="checkbox" id="mis_datos_son_privados"    value=""
																				    <?php if ( $this->mis_datos_son_privados == TRUE) : ?> checked="checked" <?php endif ;?>>
																				    Establecer mi dirección de correo eletrónico y mi número de celular como datos privados, es decir, no estarán disponibles en consultas de otros usuarios de la red.
																				  </label>
																				</div><br>

																				<!-- Option 3 -->
																				<div class="checkbox">
																				  <label>
																				    <input type="checkbox" id="declaro_renta" value=""
																				    <?php if ( $this->declaro_renta == TRUE) : ?> checked="checked" <?php endif ;?>>
					                   Certifico que soy declarante de impuesto sobre la renta.
																				  </label>
																				</div><br>



																			<!-- option 4
																			<div class="checkbox">
																			  <label>
																			    <input type="checkbox" id="param_acepto_retencion_comis_para_pago_pedidos" value=""
																			    <?php if ( $this->param_acepto_retencion_comis_para_pago_pedidos == TRUE) : ?>   <?php endif ;?>>
																			    Acepto que se retenga de mis comisiones, de manera indefinida y mientras no modifique este registro, la suma de $ :<strong>
																			    	<input type="text" name="" class="registro_suma_input" value="<?= $this->param_valor_comisiones_para_pago_pedidos;?>"
																			    	id ='param_valor_comisiones_para_pago_pedidos'
																			    	valor-pago-pedidos = "<?= $this->param_valor_comisiones_para_pago_pedidos;?>"
																			    	<?php if ( $this->param_acepto_retencion_comis_para_pago_pedidos == FALSE) : ?> disabled="disabled"  <?php endif ;?>>
																			    </strong>para el pago de mis pedidos.
																			  </label>
																			</div><br>
																			<br> -->


				               <div>
				               	   <div class="col-lg-12 col-md-12 col-sm-12">
				                        <p class="subtitulos_form2"><strong>Forma de pagos de Comisiones </strong></p>
				               	   </div>
				               </div><br>

<!--
																			<div class="checkbox">
																			  <label>
																			    <input type="checkbox" id="pago_comisiones_efecty" value=""
																			    <?php if ( $this->pago_comisiones_efecty == TRUE) : ?>  <?php endif ;?>>
																			    Efecty
																			  </label>
																			</div><br><br>


																			<div class="checkbox"  >
																			  <label>
																			    <input type="checkbox" id="pago_comisiones_transferencia" value=""
																			    <?php if ( $this->pago_comisiones_transferencia == TRUE) : ?>  <?php endif ;?>>
                       <span class="">
																			    Transferencia a mi cuenta bancaria.<br>
																			    Asumo el valor de: <strong>
																			     </strong>que corresponde al costo de la transferencia electrónica a mi cuenta para el pago de mis comisiones.
																			     Autorizo que las comisones se transfieran a mi cuenta siempre que sean mayores a: <strong>  </strong>.
                       </span>
																			  </label>
																			</div><br>Tiutulo = Forma de pago de comisiones-->

                 </form>
               </div>

              <!-- Certificacion que la cuenta me pertenece -->
              <div  id='datos_cuenta_bancaria' <?php if ( $this->pago_comisiones_transferencia == FALSE) : ?>   <?php endif ;?>>
                 <div class="col-lg-12 col-md-12 col-sm-12">
            	  	    <div>
           	  	    	   <div class="text-center">
           	  	    	   	    <strong> Cuenta para transferencias:</strong><br>
           	  	    	   </div>
           	  	    </div>
                 </div><br><br><br>

                 <!-- Formulario -->
                 <div class="form_sobre_banco">
                 	  <?php include (APPLICATION_SECTIONS . 'formulario_cuenta_transferencias.php');?>
                 </div>
              </div>

            </div>
         </div>
       </div>
      </div>

