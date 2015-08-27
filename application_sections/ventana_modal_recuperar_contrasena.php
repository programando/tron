<!-- VEntana modal = Recueprar contraseña
     llamada desde el footer  => Recuperar Contraseña
 -->

 <div  class="modal fade" id="recuperar_contrasena" tabindex="-1" role="dialog" aria-labelledby="recuperar_contrasenaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header header-login">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="login-fom-btn-x">&times;</span>
        </button>
        Ingreso a Red TRON
      </div>

      <div class="modal-body">
        <div class="formulario_ingresar">

     <div><!--Aviso -->
      <h5 class="text-justify">Ingresa el E-mail registrado en la Red de Usuarios TRON. El sistema enviará un correo
        electrónico en donde te indicaremos el procedimiento para cambiar tu contraseña. </h5>
        <br>
      </div><!--Aviso -->


      <div class="form-group"><!--Input Email -->
        <label for="correo">E-mail Registrado...</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i><!-- IMG QUE SE ENCUENTRA EN LA DERECHA DE INPUT-->
          </span><!--INPUT = DIRECCION DE CORREO -->
          <input id="login-username-" type="text" class="form-control" name="username" value="" placeholder="Usuario" />
        </div>
        <div id="msgbox">
        </div>
      </div><!--Input Email -->

      <div class="text-center" id="dv-img-cargando"  >
        <img id="imagen-cargando" src= "<?= BASE_IMG_EMPRESA ;?>cargando.gif" alt="" />
        <br>

      </div><br/>

    </div><!--Cuerpo ventana modal -->


    <div class="modal-footer">
      <div class   ="cont-btn-enviar">
           <button type ="button" class="btn btn-success btn-enviar" id='btn-recupera-pass-'>Enviar</button><!--Boton Enviar -->
           <button type ="button" class="btn btn-default btn-cerrar" data-dismiss="modal" >Cerrar</button>
      </div>
    </div>

        </div>
      </div>

        </div>
    </div><!-- modal-content -->

  </div><!-- modal-dialog -->
</div>

