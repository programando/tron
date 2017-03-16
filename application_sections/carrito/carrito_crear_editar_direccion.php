
<!-- MARZO 04 DE 2015
  VENTANA MODAL PARA LA EDICIÓN / CREACIÓN DE DIRECCIONES DE DESPACHO PARA PEDIDOS
-->
 
<div class="modal fade " id="venta_editar" tabindex="-1"  role="dialog" aria-labelledby="#venta_editar" aia-hidden="true">
	   <div class="modal-dialog ventana-editar-direccion">
	   	   <div class="modal-content "><!-- Contenido de la ventana -->

            <div class="modal-header cabezera-modal-editar"><!-- Cabezera-vemtana -->
            	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	   <h4 class="text-center">Editar/Crear Dirección</h4>
            </div><!-- Cabezera-vemtana -->

            <div class="modal-body">

                    <form class="form-horizontal" role="form">
                          <div class="cont-fromulario">
                              <div class="row">

                            <!--destinario -->
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                 <label for="destinario" class="text-label">Destinatario :</label>
                                 <input type="text" id="destinatario" class="form-control destinario" <br>
                              </div>

                             <!-- Selecciona país-->
                              <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="seleccion-pais" class="text-label">Selecciona país :</label>
                               <select  class="form-control" id="pais">
                                 <option value="1">Colombia</option>
                               </select><br>
                               </div>

                             <!-- Selecciona departamento-->
                               <div class="col-lg-6 col-md-6 col-sm-6">

                                 <label for="seleccion-departamento" class="text-label">Selecciona departamento :</label>
                                      <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>
                                 <br>
                               </div>

                             <!-- Selecciona ciudad -->
                               <div class="col-lg-12 col-md-12 col-sm-12">
                                 <label for="seleccion-ciudad" class="text-label">Selecciona ciudad :</label>

                                 <select  id="idmcipio" class="form-control">
                                      <option value="0">Vacio </option>
                                 </select><br>
                              </div>

                             <!-- Indicanos dirección-->
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                 <label for="direccion" class="text-label">Dirección :</label>
                                 <input type="text" id="direccion" class="form-control"><br>
                              </div>

                             <!--Indicanos barrio -->
                               <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="indicanos-barrio" class="text-label">Barrio :</label>
                                 <input type="text" id="barrio" class="form-control"><br>
                               </div>

                             <!--Indicanos teléfono -->
                               <div class="col-lg-6 col-md-6 col-sm-6">
                                 <label for="telefono" class="text-label">Número Teléfono :</label>
                                 <input type="text" id="telefono" class="form-control"><br>
                               </div>

                                <div class="text-center" id="mensaje_error">

                                </div>
                              </div>
                          </div>
                    </form>

            </div>

            <div class="modal-footer">
            	   <button type="button" class="btn btn-success" id='btn-direccion-grabar' >Guardar</button>
            	   <button type="button" class="btn btn-default " data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>


	   	   </div><!-- Contenido de la ventana -->
	   </div>
</div>






