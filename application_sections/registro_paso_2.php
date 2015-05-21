<!--
    EStilos Css => Carpeta Css => tron_registro.css
    Js          => Carpeta Js  => tron_terceros_registro.js
  -->

 <div style ="display:none;" id="elemento_a_mostrar">Los número de identificación deben ser iguales </div>

  <div><!--Contenedor- de  el formulario -->
   <div class="row formulario">
    <form class="form-horizontal" role="form">

      <div class="col-lg-5 col-md-5 col-sm-5"><!--TIpo-Document -->
        <div class="form-group">
          <label for="idtpidentificacion" class="col-lg-5  control-label"><p class="text-label">Tipo de Documento :</p></label>
          <div class="col-lg-7"  id="cont-selec-document">
            <?php include (APPLICATION_SECTIONS . 'tipos_documentos.php');?>
          </div>
        </div>
      </div><!--TIpo-Document -->


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
             <input type="text" class="form-control input_campo_datos" id="identificacion_nat">
           </div>
         </div><!--Numero-documento -->
       </div>


       <div class="form-group cedu-ciudad campos-cedu-ciudadana"><!--Nombres -->
        <label for="pnombre" class="col-lg-6  control-label"><p class="text-label ">Nombres:</p></label>
          <div class="col-lg-6 ">
             <input type="text" class="form-control input_campo_datos" id="pnombre">
          </div>
       </div><!--Nombres -->


     <div class="form-group"><!--País residencia -->
       <label for="idpais" class="col-lg-6  control-label"><p class="text-label ">País residencia:</p></label>
       <div class="col-lg-6 ">
         <select  class="form-control input_campo_datos" id="idpais">
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
            <input type="text" class="form-control input_campo_datos" placeholder="Número Documento" id="identificacion_nat_confirm">
          </div>
        </div><!--Confirmar -->
      </div>


      <div class="form-group campos-cedu-ciudadana"><!--Apellidos -->
         <label for="papellido" class="col-lg-4  control-label"><p class="text-label ">Apellidos:</p></label>
         <div class="col-lg-8 cont-input">
          <input type="text" class="form-control input_campo_datos" id="papellido">
        </div>
      </div><!--Apellidos -->


      <div class="form-group"><!--Departamento -->
        <label for="iddpto" class="col-lg-4  control-label"><p class="text-label ">Departamento:</p></label>
        <div class="col-lg-8 cont-input">
          <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>
        </div>
      </div><!--Departamento -->
    </div><!--Columan Contine => Confirmar , apellidos , departamento -->


  <!--colunma  contiene => genero , municipios -->
      <div class="col-lg-4 col-md-4 col-sm-4" id="columna-3">
       <div class="col-lg-12 col-md-12 col-sm-12">

         <div class="col-lg-8 col-md-8 col-sm-8"><!-- Mes -->
         <div class="form-group campos-cedu-ciudadana">
            <label for="mes"  style="padding-left: 0px;" class="col-lg-2  control-label label-mes"><p class="text-label ">Mes:</p></label>
            <div class="col-lg-10 cont-input">
                <select  class="form-control " id="mes">
                  <option value=" ">ENERO</option>
                  <option value=" ">FEBRERO</option>
                  <option value=" ">MARZO</option>
                  <option value=" ">ABRIL</option>
                  <option value=" ">MAYO</option>
                  <option value=" ">JUNIO</option>
                  <option value=" ">JULIO</option>
                  <option value=" ">AGOSTO</option>
                  <option value=" ">SEPTIEMBRE</option>
                  <option value=" ">OCTUBRE</option>
                  <option value=" ">NOVIEMBRE</option>
                  <option value=" ">DICIEMBRE</option>
                </select>
            </div>
            </div>
          </div>


             <div class="col-lg-4 col-md-4 col-sm-4">
              <div class="form-group campos-cedu-ciudadana">
              <label for="dia"  style="padding-left: 0px;" class="col-lg-2  control-label label-dia"><p class="text-label ">Dia:</p></label>
              <div class="col-lg-10 cont-input">
                <select  class="form-control  select-dia" id="dia">
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                    <option value="">13</option>
                    <option value="">14</option>
                    <option value="">15</option>
                    <option value="">16</option>
                    <option value="">17</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                    <option value="">21</option>
                    <option value="">22</option>
                    <option value="">23</option>
                    <option value="">24</option>
                    <option value="">25</option>
                    <option value="">26</option>
                    <option value="">27</option>
                    <option value="">28</option>
                    <option value="">29</option>
                    <option value="">30</option>
                    <option value="">31</option>
                </select>
              </div>
              </div>
             </div>
       </div>

       <div class="form-group seleccion-genero campos-cedu-ciudadana"><!--Género -->
         <label for="genero" class="col-lg-4  control-label"><p class="text-label ">Género:</p></label>
         <div class="col-lg-8 cont-input">
          <select  class="form-control input_campo_datos" id="genero">
            <option value="1">Masculino</option>
            <option value="0">Femenino</option>
          </select>
        </div>
      </div><!--Género -->


      <div class="form-group"><!--Municipio -->
       <label for="idmcipio" class="col-lg-4  control-label"><p class="text-label ">Municipio</p></label>
       <div class="col-lg-8 cont-input">
        <select class="form-control input_campo_datos" id="idmcipio">
          <option value="0">Seleccione una ciudad o municipio</option>
        </select>
       </div>
      </div><!--Municipio -->
      </div>
  <!--colunma  contiene => genero , municipios -->




<div class="col-lg-12 col-md-12 col-sm-12 columna-5"><!--Dirección residencia -->
   <div class="form-group">
     <label for="direccion" class="col-lg-2 control-label"><p class="text-label ">Dirección residencia:</p></label>
     <div class="col-lg-10">
      <input type="text" class="form-control input_campo_datos" id="direccion" value = "<?= Session::Get('direccion') ;?>">
    </div>
  </div>
</div><!--Dirección residencia -->


<div class="col-lg-6 col-md-6 col-sm-6 columna-6" ><!--Columna contiene => barrio , correo -->
   <div class="form-group"><!-- Barrio-->
     <label for="barrio" class=" col-lg-4 control-label"><p class="text-label ">Barrio:</p></label>
     <div class=" col-lg-6">
      <input type="text" class="form-control input_campo_datos input-col-6-7" id="barrio">
    </div>
   </div><!-- Barrio-->

  <div class="form-group"><!--Correo Electrónico -->
     <label for="email" class="col-lg-4 control-label"><p class="text-label ">Correo Electrónico:</p></label>
    <div class="col-lg-6">
      <input type="email" class="form-control input_campo_datos input-col-6-7" id="email">
   </div>



</div><!--Correo Electrónico -->

</div><!--Columna contiene => barrio , correo -->



<div class="col-lg-6 col-md-6 col-sm-6 columna-7" ><!--Columna contenido => numero celular , confirmar -->

 <div class="form-group"><!--Número Celular -->
   <label for="celular1" class="col-lg-6 control-label"><p class="text-label ">Número Celular:</p></label>
   <div class="col-lg-6 ">
    <input type="text" class="form-control input_campo_datos" id="celular1">
  </div>



</div><!--Número Celular -->


<div class="form-group"><!--Confirmar -->
 <label for="email_confirm" class="col-lg-6 control-label"><p class="text-label ">Confirmar:</p></label>
 <div class="col-lg-6 ">
  <input type="text" class="form-control input_campo_datos input-col-6-7" id="email_confirm" placeholder="Correo Electrónico">
</div>


</div><!--Confirmar -->

</div><!--Columna contenido => numero celular , confirmar -->


 <!-- ====( Btn = Anterior - Siguiente )==== -->
  <div class="row">
      <div class="col-lg-12">
           <div class="cont-btn-bottom"><!-- Cont -->
                <button type="button" class="btn_volver" id="btn_paso_2_anterior">Anterior</button>
           </div><!-- Cont -->
      </div>
  </div>
 <!-- ====( Btn = Anterior - Siguiente )==== -->

</form>

</div>

</div><!--Contenedor- de  el formulario -->





