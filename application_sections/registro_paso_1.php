<!--
    EStilos Css => Carpeta Css => tron_registro.css
    Js          => Carpeta Js  => tron_terceros_registro.js
-->


<div><!--Contenedor- de  el formulario -->
       <div class="row formulario">
        <form class="form-horizontal" role="form">

          <div class="col-lg-5 col-md-5 col-sm-5"><!--TIpo-Document -->
            <div class="form-group">
              <label for="idtpidentificacion" class="col-lg-5  control-label"><p class="text-label ">Tipo de Documento :</p></label>
              <div class="col-lg-6">
               <select class="form-control input_campo_datos" id="idtpidentificacion">
                <option value="">Vacio</option>
              </select>
            </div>

            <div class="col-lg-12"><!--Mensaje de validacion -->
              <div class="mjs-valid-d_cumento"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img">  Seleccione un Documento!!</div>
            </div><!--Mensaje de validacion -->

          </div>
        </div><!--TIpo-Document -->

          <div class="col-lg-7" style="display: none;">
             <div class="col-lg-6">
              <div class="form-group campos-cedu-ciudadana"><!--Numero-documento -->
               <label for="identificacion_nat"  class="well  col-lg-7 "><p class="text-label ">Número  Documento:</p></label>
               <div class="well col-lg-4">
                 <input type="text" class="form-control input_campo_datos" id="identificacion_nat">
               </div>

               <div class ="col-lg-12"><!--Mensaje de validacion -->
                 <div class ="mjs-valid-Num-dcto"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
               </div><!--Mensaje de validacion -->

             </div><!--Numero-documento -->
             </div>

             <div class="col-lg-5">
                 <div class="form-group campos-cedu-ciudadana"><!--Confirmar -->
                   <label for="identificacion_nat_confirm" class="col-lg-4 control-label" ><p class="text-label ">Confirmar:</p></label>
                   <div class="col-lg-8 cont-input">
                    <input type="text" class="form-control input_campo_datos" placeholder="Número Documento" id="identificacion_nat_confirm" style="background: red;">
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-confi-num-dcto"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                  </div><!--Mensaje de validacion -->

                </div><!--Confirmar -->
             </div>


         </div>


        <!--Campos NIT -->

        <div class="row"><!--Fila -->
          <div class="col-lg-12 col-md-12 col-sm-12" id="campos-nit"><!-- Campos NIT-->
            <div class=" col-lg-6"><!--Campos-NIT = Numero-NIT , DV -->

              <div class=" col-lg-8"><!-- Numero nit-->
                <div class="form-group">
                  <label for="identificacion" class="col-lg-6 control-label label-nuemero-nit"><p class="text-label ">Número NIT:</p></label>
                  <div class="col-lg-6">
                   <input type="text" class="form-control input_campo_datos" id="identificacion">
                 </div>

                 <div class="col-lg-12"><!--Mensaje de validacion -->
                      <div class="mjs-valid-nit"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                 </div><!--Mensaje de validacion -->

               </div>
             </div><!-- Numero nit-->


             <div class=" col-lg-4"><!-- D.V-->
               <div class="form-group">
                 <label for="digitoverificacion" class="col-lg-1 control-label"><p class="text-label ">D.V:</p></label>
                 <div class="col-lg-9">
                  <input type="text" class="form-control input_campo_datos" id="digitoverificacion">
                </div>

                 <div class="col-lg-12"><!--Mensaje de validacion -->
                     <div class="mjs-valid-D-V"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img">  Campo Vacio !!</div>
                 </div><!--Mensaje de validacion -->
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

                <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-Confi-NIT"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img">  Campo Vacio !!</div>
                </div><!--Mensaje de validacion -->
             </div>
           </div><!-- Confirmar-Numero nit-->


           <div class=" col-lg-4"><!--Confirmar- D.V-->
             <div class="form-group">
               <label for="digitoverificacion_confirm" class="col-lg-1 control-label"><p class="text-label ">D.V</p></label>
               <div class="col-lg-9">
                <input type="text" class="form-control input_campo_datos" id="digitoverificacion_confirm" placeholder="D.V">
              </div>

               <div class ="col-lg-12"><!--Mensaje de validacion -->
                   <div class ="mjs-valid-confi-D-V"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
               </div><!--Mensaje de validacion -->

            </div>
          </div><!-- Confirmar-D.V-->
        </div><!--Confirmar-NIT = Numero-NIT , D.V -->

      </div><!--Campos NIT -->
    </div><!--Fila -->

    <div class="col-lg-12 col-md-12 col-sm-12" id="campos-nit"><!--Razón Social -->
     <div class="form-group">
       <label for="razonsocial" class="col-lg-2 control-label"><p class="text-label ">Razón Social:</p></label>
       <div class="col-lg-10 ">
         <input type="text" class="form-control input_campo_datos" id="razonsocial">
       </div>

         <div class ="col-lg-12"><!--Mensaje de validacion -->
             <div class ="mjs-valid-nit-razon-scl "><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
         </div><!--Mensaje de validacion -->

     </div>

    </div><!--Razón Social -->


    <!--Campos NIT -->

                 <div class="col-lg-4 col-md-4 col-sm-4"><!--Columan Contiene => numero-documento , nombres , pais -->

                   <div style="display: none;">
                   <div class="form-group campos-cedu-ciudadana"><!--Numero-documento -->
                     <label for="identificacion_nat"  class=" col-lg-6 "><p class="text-label ">Número  Documento:</p></label>
                     <div class="col-lg-6 ">
                       <input type="text" class="form-control input_campo_datos" id="identificacion_nat">
                     </div>

                     <div class ="col-lg-12"><!--Mensaje de validacion -->
                       <div class ="mjs-valid-Num-dcto"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                     </div><!--Mensaje de validacion -->

                   </div><!--Numero-documento -->
                  </div>


                   <div class="form-group cedu-ciudad campos-cedu-ciudadana"><!--Nombres -->
                    <label for="pnombre" class="col-lg-6  control-label"><p class="text-label ">Nombres:</p></label>
                    <div class="col-lg-6 ">
                     <input type="text" class="form-control input_campo_datos" id="pnombre">
                   </div>

                     <div class ="col-lg-12"><!--Mensaje de validacion -->
                        <div class ="mjs-valid-nombre"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                    </div><!--Mensaje de validacion -->

                </div><!--Nombres -->


                <div class="form-group"><!--País residencia -->
                   <label for="idpais" class="col-lg-6  control-label"><p class="text-label ">País residencia:</p></label>
                   <div class="col-lg-6 ">
                     <select  class="form-control input_campo_datos" id="idpais">
                       <option value="1">Colombia</option>
                     </select>
                   </div>

                   <div class ="col-lg-12"><!--Mensaje de validacion -->
                      <div class ="mjs-valid-pais"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img">  Seleccione un Pais !!</div>
                   </div><!--Mensaje de validacion -->

                 </div><!--País residencia -->

                </div><!--Columan Contiene => numero-documento , nombres , pais -->




                <div class="col-lg-4 col-md-4 col-sm-4" id="columna-2"><!--Columan Contine => Confirmar , apellidos , departamento -->

                <div style="display: none;">
                 <div class="form-group campos-cedu-ciudadana"><!--Confirmar -->
                   <label for="identificacion_nat_confirm" class="col-lg-4 control-label" ><p class="text-label ">Confirmar:</p></label>
                   <div class="col-lg-8 cont-input">
                    <input type="text" class="form-control input_campo_datos" placeholder="Número Documento" id="identificacion_nat_confirm" style="background: red;">
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-confi-num-dcto"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                  </div><!--Mensaje de validacion -->

                </div><!--Confirmar -->
                </div>


                <div class="form-group campos-cedu-ciudadana"><!--Apellidos -->
                 <label for="papellido" class="col-lg-4  control-label"><p class="text-label ">Apellidos:</p></label>
                 <div class="col-lg-8 cont-input">
                  <input type="text" class="form-control input_campo_datos" id="papellido">
                </div>

                <div class="col-lg-12"><!--Mensaje de validacion -->
                 <div class="mjs-valid-apellidos"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                </div><!--Mensaje de validacion -->

                </div><!--Apellidos -->


                <div class="form-group"><!--Departamento -->
                  <label for="iddpto" class="col-lg-4  control-label"><p class="text-label ">Departamento:</p></label>
                  <div class="col-lg-8 cont-input">
                    <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>

                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-departamento"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Seleccione un Departamento !!</div>
                  </div><!--Mensaje de validacion -->

                </div><!--Departamento -->

                </div><!--Columan Contine => Confirmar , apellidos , departamento -->



                <div class="col-lg-4 col-md-4 col-sm-4" id="columna-3"><!--colunma  contiene => genero , municipios -->

                 <div class="form-group seleccion-genero campos-cedu-ciudadana"><!--Género -->
                   <label for="genero" class="col-lg-4  control-label"><p class="text-label ">Género:</p></label>
                   <div class="col-lg-8 cont-input">
                    <select  class="form-control input_campo_datos" id="genero">
                      <option value="">Masculino</option>
                      <option value="">Femenino</option>
                    </select>
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                   <div class="mjs-valid-genero"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Seleccione un Genero.</div>
                 </div><!--Mensaje de validacion -->

                </div><!--Género -->


                <div class="form-group"><!--Municipio -->
                 <label for="idmcipio" class="col-lg-4  control-label"><p class="text-label ">Municipio</p></label>
                  <div class="col-lg-8 cont-input">
                    <select class="form-control input_campo_datos" id="idmcipio">
                    <option value="0">Seleccione una ciudad o municipio</option>
                    </select>
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                     <div class="mjs-valid-municipio"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Seleccione un Municipio.</div>
                  </div><!--Mensaje de validacion -->

                </div><!--Municipio -->

                </div><!--colunma  contiene => genero , municipios -->





                <div class="col-lg-12 col-md-12 col-sm-12 columna-5"><!--Dirección residencia -->

                 <div class="form-group">
                   <label for="direccion" class="col-lg-2 control-label"><p class="text-label ">Dirección residencia:</p></label>
                   <div class="col-lg-10">
                    <input type="text" class="form-control input_campo_datos" id="direccion">
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-residencia"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                  </div><!--Mensaje de validacion -->

                </div>
                </div><!--Dirección residencia -->


                <div class="col-lg-6 col-md-6 col-sm-6 columna-6" ><!--Columna contiene => barrio , correo -->

                 <div class="form-group"><!-- Barrio-->
                   <label for="barrio" class=" col-lg-4 control-label"><p class="text-label ">Barrio:</p></label>
                   <div class=" col-lg-6">
                    <input type="text" class="form-control input_campo_datos input-col-6-7" id="barrio">
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                    <div class="mjs-valid-barrio"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                  </div><!--Mensaje de validacion -->

                </div><!-- Barrio-->


                <div class="form-group"><!--Correo Electrónico -->
                 <label for="email" class="col-lg-4 control-label"><p class="text-label ">Correo Electrónico:</p></label>
                 <div class="col-lg-6">
                   <input type="email" class="form-control input_campo_datos input-col-6-7" id="email">
                 </div>

                 <div class="col-lg-12"><!--Mensaje de validacion -->
                  <div class="mjs-valid-correo"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                </div><!--Mensaje de validacion -->

                </div><!--Correo Electrónico -->

                </div><!--Columna contiene => barrio , correo -->



                <div class="col-lg-6 col-md-6 col-sm-6 columna-7" ><!--Columna contenido => numero celular , confirmar -->

                 <div class="form-group"><!--Número Celular -->
                   <label for="celular1" class="col-lg-6 control-label"><p class="text-label ">Número Celular:</p></label>
                   <div class="col-lg-6 ">
                    <input type="text" class="form-control input_campo_datos" id="celular1">
                  </div>

                  <div class="col-lg-12"><!--Mensaje de validacion -->
                   <div class="mjs-valid-cel"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                 </div><!--Mensaje de validacion -->

                </div><!--Número Celular -->


                <div class="form-group"><!--Confirmar -->
                 <label for="email_confirm" class="col-lg-6 control-label"><p class="text-label ">Confirmar:</p></label>
                 <div class="col-lg-6 ">
                  <input type="text" class="form-control input_campo_datos input-col-6-7" id="email_confirm" placeholder="Correo Electrónico">
                </div>

                <div class="col-lg-12"><!--Mensaje de validacion -->
                  <div class="mjs-valid-confi-correo"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" class="error-img"> Campo Vacio !!</div>
                </div><!--Mensaje de validacion -->

                </div><!--Confirmar -->

                </div><!--Columna contenido => numero celular , confirmar -->


                <!-- ====( Btn = Anterior - Siguiente )==== -->
                <div class="row">
                    <div class="col-lg-12">
                         <div class="cont-btn-bottom"><!-- Cont -->
                              <button type="button" class="btn btn-danger disabled">Anterior</button>
                              <button type="button" id="btn_continura" class="btn btn-defautl  btn-continuar"> Continuar </button>
                         </div><!-- Cont -->
                    </div>
                </div>
               <!-- ====( Btn = Anterior - Siguiente )==== -->

                </form>

            </div>

          </div><!--Contenedor- de  el formulario -->






