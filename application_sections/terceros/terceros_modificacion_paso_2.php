<div class="contenedor_from_2">
	   <div class="row">
	   	  <!-- Formulario -->
         	<br /><br />
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



                 </form>
               </div>

              <!-- Certificacion que la cuenta me pertenece -->
              <div  id='datos_cuenta_bancaria' <?php if ( $this->pago_comisiones_transferencia == FALSE) : ?>   <?php endif ;?>>
                 <div class="col-lg-12 col-md-12 col-sm-12 checkbox">
                       <input type="checkbox" id="pago_comisiones_transferencia" value="">
                         Quiero que mis comisiones sean trasladadas a la siguiente cuenta bancaria :
                 </div><br>

                 <!-- Formulario -->
                 <div class="form_sobre_banco">
                 	  <?php include (APPLICATION_SECTIONS . 'formulario_cuenta_transferencias.php');?>
                 </div>
              </div>

            </div>
         </div>
       </div>
      </div>

