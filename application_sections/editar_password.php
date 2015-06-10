<!-- Tooltisp = pasos para obtener una contraseña segura -->
<div>
    <div class="cuerpo_ventana_modal_codigo" id="ventana_modal_mensaje_codigo">
       <div>
         Una Contraseña segura debe contener :
         <ul class="list-unstyled pasos_contrasena_segura">
            <li><span class="glyphicon glyphicon-ok"></span> 6 o mas caracteres. </li>
            <li><span class="glyphicon glyphicon-ok"></span> Una letra minuscula. </li>
            <li><span class="glyphicon glyphicon-ok"></span> Una letra mayuscula. </li>
            <li><span class="glyphicon glyphicon-ok"></span> Un  numero. </li>
         </ul>
       </div>
     </div>
</div>

<section>
	  <!--Nueva contrasseña -->
   <div class="form-group">
     <label for="password" class="col-lg-5 control-label"> <p class="text-left text-label">Nueva Contaseña:</p></label>
     <div class="col-lg-7">
      <input data-toggle="password" data-placement="before" class="form-control new-password"
      type="password" id="password" placeholder="Registre nueva contraseña"/>

      <!-- Barra de progreso -->
      <div class="Info-contrasena">
        <div class="cont-barra">
							 	   <div class="barra" id="barra">
						 	   	   <div class="porgresador" id="progresador">
						 	   	      <!-- Indicar Progreso -->
						 	   	    </div>
						 	   </div>
        </div>
       <!-- Texto = dificultad de la contraseña -->
  			<div class="text-info-contrasena" id="">
  			  <div class="text_dificulta_contrasena" >
               Contraseña: <span class="definicion_contrasena" id="definicion_contrasena"><!-- Muy insegura ,  insegura , segura , Muy segura --></span>
  			  </div>
  			</div>

      </div>

    </div>
  </div>
</section>


<section>
	<!--Confirmar contraseña -->
  <div class="form-group">
    <label for="confirmar-password" class="col-lg-5 control-label"><p class="text-left text-label">Confirmar Contraseña:</p></label>
    <div class="col-lg-7" >
      <input data-toggle="password" data-placement="before"class="form-control confirmar-password" type="password"
      id="confirmar-password" placeholder="Confirme la contraseña" />
    </div>
    <div class="text-center" id="mensaje-validacion"></div><br>
  </div>

</section>

