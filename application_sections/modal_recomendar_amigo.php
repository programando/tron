<!-- Ventana modal =   recomendar negocio a amigo -->
 <div class="modal fade" id="modal_recomendar_amigo" tabindex="-1" role="dialog" aria-labelledby="modal_recomendar_amigoLabel" aria-hidden="true">
  <div class="modal-dialog" style="display: block; width: 40%;">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true" id="login-fom-btn-x" style="color: black;">&times;</span></button><br>
        <div>
          <img src= "<?= BASE_IMG_EMPRESA ; ?>logo.png" class="modal_logo_tron">
        </div>
      </div>

      <!-- Cuepro -->
      <div class="modal-body">
          <div>
               <div class="container-fluid">
                   <div class="row">
                       <!-- formualrio -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="contendero_form_recomendar">

                            <form class="form-horizontal" role="form">

                             <!-- Nombre -->
                              <div class="form-group"  >
                                <label for="recomendar_nombre"  class="col-lg-6 control-label">
                                  <p class="text-label">Nombre de tu amigo ( a ) :</p>
                                </label>
                                <div class="col-lg-6" >
                                  <input type="text" class="form-control input_recomendar" id="recomendar_nombre"/>
                                </div>
                              </div>

                              <!-- direccion -->
                              <div class="form-group cont_label_input">
                                <label for="recomendar_email"  class="col-lg-6 control-label" title="Dirección electrónica de tu amigo(a)">
                                  <p class="text-label">Dirección electrónica ( email ):</p>
                                </label>
                                <div class="col-lg-6" >
                                  <input type="text" class="form-control input_recomendar" id="recomendar_email" title="Dirección electrónica de tu amigo(a)"/>
                                </div>
                              </div>

                              <!-- nobrede quien envia -->
                              <div class="form-group cont_label_input">
                                <label for="recomendar_nombre_envia"  class="col-lg-6 control-label">
                                  <p class="text-label">Nombre de quien envia :</p>
                                </label>
                                <div class="col-lg-6" >
                                  <input type="text" class="form-control input_recomendar" id="recomendar_nombre_envia"
                                    value="<?= ucfirst(strtolower(( Session::Get('nombre_usuario_pedido')))) ;?>"/>
                                </div>
                              </div>



                            </form>

                          </div>
                        </div>
                        <!-- text " te he enviado " -->
                        <div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                Te he enviado este enlace para que conozcas un interesante modelo
                                de negocio donde podrás encontrar , no sólo grandes descuentos si no
                                 también la posibilidad de generar ingresos adicionales para ti. <br><br>
                            </div>
                        </div>
                        <!-- mensaje personal -->
                        <div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                 Si deseas escribir un mensaje personal hazlo en el siguiente espacio:
                                 <div>
                                     <textarea class="form-control" id="recomendar_mnsj_personal" cols="30" rows="2"></textarea>
                                 </div>
                            </div>
                        </div>

               <div id="img_cargando" style="display: none; width: 100%; text-align:center;">
               <br>
                   Enviando recomendación...
                <br>
                   <img src="<?=BASE_IMG_EMPRESA;?>cargando.gif" style="display: block;  widht: 30%; margin : 0px auto ;">
                        &nbsp;&nbsp;Espere unos segundos......
                  </div>

                   </div>
               </div>
          </div>
      </div>
      <div    style="text-align: center; font-weight: bold" id="msj-error" >

      </div>
      <!-- Footer -->
      <div class="modal-footer">
           <div class="col-lg-12 col-md-12 col-sm-12">
                <button class="btn btn-success" id="btn-recomendar-modelo-metodo-1">Enviar mensaje</button>
           </div>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>



