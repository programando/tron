<!--
    * Recuperar Contraseña
    * Los estilos CSS se encuentran en el documento CSS => tron_login.css
  -->



  <div class="formulario-olvide-password">
    <div class="modal-body"><!--Cuerpo ventana modal -->

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
          <input id="login-username-recu-pass" type="text" class="form-control" name="username" value="" placeholder="Usuario" />
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
           <button type ="button" class="btn btn-success btn-enviar" id='btn-recupera-pass'>Enviar</button><!--Boton Enviar -->
           <button type ="button" class="btn btn-default btn-cerrar" data-dismiss="modal" >Cerrar</button>
      </div>
    </div>

 </div>
 <!--Recuperar Contraseña -->


