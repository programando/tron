<!--
    EStilos Css => Carpeta Css => tron_registro.css
    Js          => Carpeta Js  => tron_terceros_registro.js
  -->

 <!-- Tooltip *** Mensaje del codigo *** -->
 <div class="ventana_modal_codigo">
    <?php include (APPLICATION_SECTIONS . 'registro_tooltip_codigo.php');?>
 </div>

  <div><!--Contenedor- de  el formulario -->
   <div class="row formulario">
    <form class="form-horizontal" role="form">

      <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="col-lg-4 col-md-4 col-sm-4"><!--Codigo -->
              <div class="form-group">
                <label for="input_codigo"  class="col-lg-6  control-label  label_codigo"><p class="text-label">
                Código del usuario<br>que te presenta en la Red:</p></label>
                <div class="col-lg-6" style=" padding-left: 5px;width: 166px;">
                   <input type="text" class="form-control" id="input_codigo" tabindex="1" />
                </div>
              </div>
          </div><!--Codigo -->

          <div class="  col-lg-5 col-md-5 col-sm-5"><!--TIpo-Document -->
              <div class="form-group">
                <label for="idtpidentificacion" style=" padding-left: 5px;" class="col-lg-5  control-label"><p class="text-label">Tipo de Documento:</p></label>
                <div class="col-lg-5" style="margin-left: -40px; width: 210px;"  id="cont-selec-document">
                  <?php include (APPLICATION_SECTIONS . 'tipos_documentos.php');?>
                </div>
              </div>
          </div><!--TIpo-Document -->
      </div>


      <!--Campos NIT -->
      <div class="row" ><!--Fila -->
        <div class="col-lg-12 col-md-12 col-sm-12" ><!-- Campos NIT-->

        <div class="campos-nit"><!-- Div oculto => Campos NIT -->
                <div class=" col-lg-6"><!--Campos-NIT = Numero-NIT , DV -->

                  <div class=" col-lg-8 "><!-- Numero nit-->
                    <div class="form-group">
                      <label for="identificacion" class="col-lg-6 control-label label-nuemero-nit"><p class="text-label ">Número NIT:</p></label>
                      <div class="col-lg-6"  id="contnumero-nit">
                       <input type="text" class="form-control input_campo_datos" id="identificacion">
                     </div>
                   </div>
                 </div><!-- Numero nit-->


                 <div class=" col-lg-4"><!-- D.V-->
                   <div class="form-group">
                     <label for="digitoverificacion" class="col-lg-1 control-label"><p class="text-label ">D.V:</p></label>
                     <div class="col-lg-9">
                      <input type="text" class="form-control input_campo_datos" id="digitoverificacion">
                    </div>
                  </div>
                </div><!-- D.V-->

              </div><!--Campos-NIT = Numero-NIT , DV -->


              <div class=" col-lg-6"><!--Confirmar-NIT = Numero-NIT , D.V -->
                <div class=" col-lg-8"><!-- Confirmar-Numero nit-->
                  <div class="form-group">
                    <label for="identificacion_confirm" class="col-lg-5 control-label"><p class="text-label ">Confirmar:</p></label>
                    <div class="col-lg-7">
                     <input type="text" class="form-control input_campo_datos" id="identificacion_confirm" placeholder="Número NIT">
                   </div>

                 </div>
               </div><!-- Confirmar-Numero nit-->


               <div class=" col-lg-4"><!--Confirmar- D.V-->
                 <div class="form-group">
                   <label for="digitoverificacion_confirm" class="col-lg-1 control-label"><p class="text-label ">D.V</p></label>
                   <div class="col-lg-9">
                    <input type="text" class="form-control input_campo_datos" id="digitoverificacion_confirm" placeholder="D.V">
                  </div>
                </div>
              </div><!-- Confirmar-D.V-->
            </div><!--Confirmar-NIT = Numero-NIT , D.V -->

            <div class="col-lg-12 col-md-12 col-sm-12" ><!--Razón Social -->
             <div class="form-group">
               <label for="razonsocial" class="col-lg-2 control-label"><p class="text-label ">Razón Social:</p></label>
               <div class="col-lg-10 ">
                 <input type="text" class="form-control input_campo_datos" id="razonsocial">
               </div>
             </div>
           </div><!--Razón Social -->
       </div><!-- Div oculto => Campos NIT -->

    </div><!--Campos NIT -->
  </div><!--Fila -->
 <!--Campos NIT -->


     <div class="col-lg-4 col-md-4 col-sm-4"><!--Columan Contiene => numero-documento , nombres , pais -->
       <div>
         <div class="form-group  campos-cedu-ciudadana"><!--Numero-documento -->
           <label for="identificacion_nat"  class="col-lg-6 control-label"><p class="text-label">Número Documento: </p></label>
           <div class="col-lg-6 ">
             <input type="text" class="form-control input_campo_datos" id="identificacion_nat" tabindex="2">
           </div>
         </div><!--Numero-documento -->
       </div>


       <div class="form-group cedu-ciudad campos-cedu-ciudadana"><!--Nombres -->
        <label for="pnombre" class="col-lg-6  control-label"><p class="text-label ">Nombres:</p></label>
          <div class="col-lg-6 ">
             <input type="text" class="form-control input_campo_datos" id="pnombre" tabindex="6">
          </div>
       </div><!--Nombres -->


     <div class="form-group"><!--País residencia -->
       <label for="idpais" class="col-lg-6  control-label"><p class="text-label ">País residencia:</p></label>
       <div class="col-lg-6 ">
         <select  class="form-control input_campo_datos" id="idpais" tabindex="9">
           <option value="1">Colombia</option>
         </select>
       </div>
     </div><!--País residencia -->
    </div><!--Columan Contiene => numero-documento , nombres , pais -->




    <div class="col-lg-4 col-md-4 col-sm-4" id="columna-2"><!--Columan Contine => Confirmar , apellidos , departamento -->
      <div>
         <div class="form-group campos-cedu-ciudadana"><!--Confirmar -->
           <label for="identificacion_nat_confirm" class="col-lg-4 control-label" ><p class="text-label ">Confirmar:</p></label>
           <div class="col-lg-8 cont-input">
            <input type="text" class="form-control input_campo_datos" placeholder="Número Documento" id="identificacion_nat_confirm" tabindex="3">
          </div>
        </div><!--Confirmar -->
      </div>


      <div class="form-group campos-cedu-ciudadana"><!--Apellidos -->
         <label for="papellido" class="col-lg-4  control-label"><p class="text-label ">Apellidos:</p></label>
         <div class="col-lg-8 cont-input">
          <input type="text" class="form-control input_campo_datos" id="papellido" tabindex="7">
        </div>
      </div><!--Apellidos -->


      <div class="form-group"><!--Departamento -->
        <label for="iddpto" class="col-lg-4  control-label"><p class="text-label ">Departamento:</p></label>
        <div class="col-lg-8 cont-input" tabindex="9">
          <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>
        </div>
      </div><!--Departamento -->
    </div><!--Columan Contine => Confirmar , apellidos , departamento -->


  <!--colunma  contiene => genero , municipios -->
      <div class="col-lg-4 col-md-4 col-sm-4" id="columna-3">

      <div id="mes_dia">
       <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="col-lg-8 col-md-8 col-sm-8"><!-- Mes -->
         <div class="form-group campos-cedu-ciudadana">
            <label for="mes"  class="col-lg-2  control-label label-mes"><p class="text-label ">Mes:</p></label>
            <div class="col-lg-10 cont-input">
                <select  class="form-control " id="mes" tabindex="4">
                  <option value="1">ENERO</option>
                  <option value="2">FEBRERO</option>
                  <option value="3">MARZO</option>
                  <option value="4">ABRIL</option>
                  <option value="5">MAYO</option>
                  <option value="6">JUNIO</option>
                  <option value="7">JULIO</option>
                  <option value="8">AGOSTO</option>
                  <option value="9">SEPTIEMBRE</option>
                  <option value="10">OCTUBRE</option>
                  <option value="11">NOVIEMBRE</option>
                  <option value="12">DICIEMBRE</option>
                </select>
            </div>
            </div>
          </div>
             <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="form-group campos-cedu-ciudadana">
              <label for="dia"  class="col-lg-2  control-label label-dia"><p class="text-label ">Dia:</p></label>
              <div class="col-lg-10 cont-input" tabindex ="5">
                <select  class="form-control  select-dia" id="dia">
                    <?php for($i=1;$i<=31;$i++) : ;?>
                          <option value="<?= $i ;?>"><?= $i ;?></option>
                    <?php endfor ;?>
                </select>
              </div>
              </div>
             </div>
       </div>
       </div>

       <div class="form-group seleccion-genero campos-cedu-ciudadana"><!--Género -->
         <label for="genero" class="col-lg-4  control-label"><p class="text-label ">Género:</p></label>
         <div class="col-lg-8 cont-input">
          <select  class="form-control input_campo_datos" id="genero" tabindex="8">
            <option value="1">Masculino</option>
            <option value="0">Femenino</option>
          </select>
        </div>
      </div><!--Género -->


      <div class="form-group"><!--Municipio -->
       <label for="idmcipio" class="col-lg-4  control-label"><p class="text-label ">Municipio :</p></label>
       <div class="col-lg-8 cont-input">
        <select class="form-control input_campo_datos" id="idmcipio">
          <option value="0" tabindex="11">Seleccione una ciudad o municipio</option>
        </select>
       </div>
      </div><!--Municipio -->
      </div>
  <!--colunma  contiene => genero , municipios -->




<div class="col-lg-12 col-md-12 col-sm-12 columna-5"><!--Dirección residencia -->
   <div class="form-group">
     <label for="direccion" class="col-lg-2 control-label"><p class="text-label ">Dirección residencia:</p></label>
     <div class="col-lg-10">
      <input type="text" class="form-control input_campo_datos" id="direccion" value = "" tabindex="12">
    </div>
  </div>
</div><!--Dirección residencia -->


<div class="col-lg-6 col-md-6 col-sm-6 columna-6" ><!--Columna contiene => barrio , correo -->
   <div class="form-group"><!-- Barrio-->
     <label for="barrio" class=" col-lg-4 control-label"><p class="text-label ">Barrio:</p></label>
     <div class=" col-lg-6">
      <input type="text" class="form-control input_campo_datos input-col-6-7" id="barrio" tabindex="13">
    </div>
   </div><!-- Barrio-->

  <div class="form-group"><!--Correo Electrónico -->
     <label for="email" class="col-lg-4 control-label"><p class="text-label ">Correo Electrónico:</p></label>
    <div class="col-lg-6">
      <input type="email" class="form-control input_campo_datos input-col-6-7" id="email" tabindex="15">
   </div>



</div><!--Correo Electrónico -->

</div><!--Columna contiene => barrio , correo -->



<div class="col-lg-6 col-md-6 col-sm-6 columna-7" ><!--Columna contenido => numero celular , confirmar -->

 <div class="form-group"><!--Número Celular -->
   <label for="celular1" class="col-lg-6 control-label"><p class="text-label ">Número Celular:</p></label>
   <div class="col-lg-6 ">
    <input type="text" class="form-control input_campo_datos" id="celular1" tabindex="14">
  </div>



</div><!--Número Celular -->


<div class="form-group"><!--Confirmar -->
 <label for="email_confirm" class="col-lg-6 control-label"><p class="text-label ">Confirmar:</p></label>
 <div class="col-lg-6 ">
  <input type="text" class="form-control input_campo_datos input-col-6-7" id="email_confirm"  tabindex="15" placeholder="Correo Electrónico">
</div>


</div><!--Confirmar -->

</div><!--Columna contenido => numero celular , confirmar -->


 <!-- ====( Btn = Anterior - Siguiente )==== -->
  <div class="row">
      <div class="col-lg-12">
           <div class="cont-btn-bottom"><!-- Cont -->
                <button type="button" class="btn_volver" id="btn_paso_2_anterior">Anterior</button>
                 <button type="button" class="btn_volver-" id="btn_finalizar">Finalizar Registro</button>
           </div><!-- Cont -->

      </div>
  </div>
 <!-- ====( Btn = Anterior - Siguiente )==== -->

</form>

</div>

</div><!--Contenedor- de  el formulario -->





