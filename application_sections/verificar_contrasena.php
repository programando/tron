<!--
    Js          => Carpeta JS  => cuenta_configuracion_perfil.js
    Estilos CSS => Carpeta CSS => carpeta CSS => tron_confi_perfil.css
    Ventana modal ( 1 ) = verificar contraseña par pder edita la informacion personal .. -->

<div class="modal fade" id="verificar-contrasena" tabindex="-1" role="dialog" aria-labelledby="mymodallabel" aria-hidden="true"><!-- Cont= principal -->
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
                               <label for="contrasena" class="tex-label-modal">Contraseña :</label>
                               <input type="password" class="form-control" id="contrasena">
                               <div class="cont-mensj-validacion"><!-- Mensaje de validacio -->
                                   <img style="width: 12px;"src="<?= BASE_IMG_TIENDA;?>negativo-rojo.png" alt="">
                                   <span>Ingrese  su contraseña..!!</span>
                               casi me lo saco
                               
                        </div>            <button type ="button" class="btn btn-success" id="validar">Validar</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                 </div>
              </div><!-- Pie-modal -->

         </div>
     </div>
</div><!-- Cont= principal -->
