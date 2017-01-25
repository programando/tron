
<div class="contenedor-contrasenia">
	  <!--Nueva contrasseña -->
   <div class="form-group">
     <label for="password" class="col-lg-5 control-label"> <p class="text-left text-label">Nueva Contaseña:</p></label>
     <div class="col-lg-7">

        <div class="input-group" style="margin: 0px;">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"  id='mostrar-ocultar'>
                <span class="glyphicon glyphicon-eye-open"></span>
            </button>
          </span>
          <input  data-toggle="password" data-placement="before" class="form-control new-password" type="password" id="password" placeholder="Contraseña" oncopy="return false" onpaste="return false" oncut="return false">
        </div><!-- /input-group -->

      <!-- Barra de progreso -->
      <div class="Info-contrasena"  style="display:none;">
        <div class="cont-barra">
                 <div class="barra" id="barra">
                     <div class="porgresador" id="progresador">  </div>
                 </div>
        </div>
       <!-- Texto = dificultad de la contraseña -->
        <div class="text-info-contrasena" id="">
          <div class="text_dificulta_contrasena" >
                <span class="definicion_contrasena" id="definicion_contrasena"><!-- Muy insegura ,  insegura , segura , Muy segura --></span>
          </div>
        </div>

      </div>

      <!-- Tooltisp = pasos para obtener una contraseña segura -->
      <div>
          <div class="cuerpo_ventana_modal_codigo" id="ventana_modal_mensaje_codigo">
             <div>
               Una Contraseña segura debe contener :
               <ul class="list-unstyled pasos_contrasena_segura">
                  <li><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; 6 ó más caracteres. </li>
                  <li><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Una letra minúscula. </li>
                  <li><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Una letra mayúscula. </li>
                  <li><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Un número. </li>
               </ul>
             </div>
           </div>
      </div>

    </div>
  </div>

	<!--Confirmar contraseña -->
  <div class="form-group">
    <label for="confirmar-password" class="col-lg-5 control-label"><p class="text-left text-label">Confirmar Contraseña:</p></label>
    <div class="col-lg-7">
    <div class="input-group" style="margin: 0px;">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id='mostrar-ocultar-confirm'><span class="glyphicon glyphicon-eye-open"></span></button>
      </span>
      <input data-toggle="password" data-placement="before" class="form-control confirmar-password" type="password" id="confirmar-password" placeholder="Confirme la contraseña" oncopy="return false" onpaste="return false" oncut="return false" >
    </div><!-- /input-group -->
    </div>
  </div>

</div>
<!--
    tipografias:

    <span class="glyphicon glyphicon-eye-open"></span> => esta es para cuadno se va a ver la contraseña
    <span class="glyphicon glyphicon-eye-close"></span> => esta para cuando no quiere que se vea la contraseña es decir solo se ve los puntos negros
 -->






