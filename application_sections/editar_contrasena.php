<!--
    Js          => Carpeta JS  => cuenta_configuracion_perfil.js
    Estilos CSS => Carpeta CSS => tron_confi_perfil.css
    Ventana modal ( 2 ) = editar contraseña .. -->

<div class="modal fade" id="editar-contrasena" tabindex="-1" role="dialog" aria-labelledby="mymodallabel" aria-hidden="true"><!-- Cont= principal -->
     <div class="modal-dialog">
         <div class="modal-content">

                <div class="modal-header cont-cabezera-modal"><!-- Cabezera-modal -->
                  <div><!-- contenedro -->
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4>Cambiar mi información personal</h4>
                      <p>Administre su información personal.</p>
                  </div><!-- contenedro -->
                </div><!-- Cabezera-modal -->

                <div class="modal-body cont-cuerpo-modal"><!-- Cuerpo-modal -->
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                              <p>Para poder ver y editar tus datos debes colocar tu constraseña </p>
                         </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                           <form>

                              <div><!-- Contraseña Anterior -->
                                  <label for="contrasena-anterior" class="tex-label-modal">Contraseña Anterior :</label>
                                  <input type="password" class="form-control" id="contrasena-anterior">
                                  <div class ="msj-valida-conta-anterior"><!-- Mensaje de validacio -->
                                      <img style ="width: 12px;"src="<?= BASE_IMG_TIENDA;?>negativo-rojo.png" alt="">
                                      <span>Ingrese  su contraseña anterior..!!</span>
                                  </div><!-- Mensaje de validacio -->
                              </div><br><!--Contraseña Anterior  -->

                              <div><!-- Nueva Contraseña -->
                                  <label for="new-contrasena" class="tex-label-modal">Nueva Contraseña :</label>
                                  <input type="password" class="form-control" id="new-contrasena">
                                  <div class ="msj-valida-new-contrasena"><!-- Mensaje de validacio -->
                                      <img style ="width: 12px;"src="<?= BASE_IMG_TIENDA;?>negativo-rojo.png" alt="">
                                      <span>Ingrese una Nueva contraseña ..!!</span>
                                  </div><!-- Mensaje de validacio -->
                              </div><br><!-- Nueva Contraseña -->

                              <div><!-- Repita la nueva Contraseña  -->
                                  <label for="repetir-new-contrasena" class="tex-label-modal">Confirmar Contraseñas :</label>
                                  <input type="password" class="form-control" id="repetir-new-contrasena">
                                  <div class ="msj-valida-no-contrasena"><!-- Mensaje de validacio -->
                                      <img style ="width: 12px;"src="<?= BASE_IMG_TIENDA;?>negativo-rojo.png" alt="">
                                      <span>Las Contraseñas No Coinciden ..!!</span>
                                  </div><!-- Mensaje de validacio -->
                              </div><!--  -->

                           </form>
                        </div>
                    </div>
                </div><!-- Cuerpo-modal -->

              <div class="modal-footer"><!-- Pie-modal -->
                 <div>
                     <button type ="button" class="btn btn-success" id="guardar-contrasena">Guardar</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                 </div>
              </div><!-- Pie-modal -->

         </div>
     </div>
</div><!-- Cont= principal -->
