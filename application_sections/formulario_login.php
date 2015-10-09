
<?php if (Session::Get('autenticado')==false ) :?>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header header-login">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="login-fom-btn-x">&times;</span></button>
          Ingreso a Red TRON
        </div>
        <div class="modal-body">
          <div class="container-fluid" >
            <div class="formulario_ingresar">
              <!--CONTENEDOR DEL FORMULARIO DE INICIAR SEICION -->

              <!--Recuperar Contraseña -->

              <?php include (APPLICATION_SECTIONS . 'formulario_login_recup_passw.php');?>

              <!--Recuperar Contraseña -->

              <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 contenido-login">
                <div  class="panel-body cuerpo_formulario" ><!--INICIO CUERPO DEL FORMULARIO => INPUTS , BOTONES , CHECKBOX -->

                  <form id=" " class="form-horizontal" role="form"><!--INICIO FORMULARIO -->
                    <label for="login-username">Email</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i><!-- IMG QUE SE ENCUENTRA EN LA DERECHA DE INPUT-->
                      </span><!--INPUT = DIRECCION DE CORREO -->
                      <input id="login-username" type="text" class="form-control email-usuario" name="username" value="" placeholder="Usuario">
                    </div>
                    <label for="login-password">Contraseña</label>
                    <div  class="input-group">
                      <span class="input-group-addon">
                        <i class="llave-cont"></i><!-- IMG QUE SE ENCUENTRA EN LA DERECHA DE INPUT-->
                      </span> <!--INPUT = CONTRASEÑA -->
                      <input id="login-password" type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>
                    <div class="olvide_contraseña"><!-- INICIO RECORDAR CONTRASEÑA -->
                      <small>
                        <a href="#" id="olvide-password">He olvidado mi contraseña , favor recordármela..</a>
                      </small>
                    </div><br><!--FIN RECORDAR CONTRASEÑA -->
                    <div class="messagebox" "text-center" >
                    </div>

                    <br>

                    <div class="modal-footer"><!--Pie de la ventana modal -->
                      <div style="margin-top:10px" class="form-group boton"><!-- INICIO Button -->
                        <div class="col-sm-12 controls">
                          <button type="button" class="btn btn-success btn-md btn-login">Iniciar Sesión</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                        </div>
                      </div><!-- FIN Button -->
                    </div><!--Pie de la ventana modal -->



                  </form><!--INICIO FORMULARIO -->
                </div>
              </div>
            </div>  <!-- CONTENEDOR DEL FORULARIO DE INICIAR SEICION -->
          </div>
        </div> <!-- modal-body -->

      </div><!-- modal-content -->

    </div><!-- modal-dialog -->
  </div>



<?php endif ;?>





