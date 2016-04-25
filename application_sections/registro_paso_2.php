<div class="ventana_modal_codigo">
	<?php include (APPLICATION_SECTIONS . 'registro_tooltip_codigo.php');?>
</div>

<div>
	<div class="row formulario">
		<form class="form-horizontal" role="form">

			<div>
                <label for="input_codigo" class="col-sm-4 col-xs-12 vcenter">
                    <div class="taR pR20 ff1">Código del usuario que te presenta en la Red:</div>
                </label><!--
                --><div class="col-sm-8 col-xs-12 vcenter">
                    <?php if ( $this->Modifica_Codigo_Presenta == FALSE) :?>
                        <input type="text" class="form-control" id="input_codigo" tabindex="1" value= "<?= $this->codigousuario ;?>" disabled="disabled" />
                    <?php else :?>
                        <input type="text" class="form-control" id="input_codigo" tabindex="1" value= "<?= $this->codigousuario ;?>"/>
                    <?php endif ;?>
                </div>

                <hr />

                <!--TIpo-Document -->
                <label for="idtpidentificacion" class="col-sm-4 col-xs-12 vcenter">
                    <div class="pR20 ff1">Tipo de Documento:</div>
                </label><!--
                --><div class="col-sm-8 col-xs-12 vcenter" id="cont-selec-document">
                    <?php include (APPLICATION_SECTIONS . 'tipos_documentos.php');?>
                </div>
            </div>

			<br /><br />

            <!--Campos NIT -->
            <div class="campos-nit">
                <label for="identificacion" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Número NIT:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="identificacion">
                </div><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                </div><!--
                --><label for="digitoverificacion" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">D.V:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="digitoverificacion">
                </div>

                <br /><br />

                <label for="identificacion_confirm" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Confirmar:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="identificacion_confirm" placeholder="Número NIT">
                </div><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                </div><!--
                --><label for="digitoverificacion_confirm" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Confirmar D.V:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="digitoverificacion_confirm" placeholder="D.V">
                </div>

                <br /><br />

                <label for="razonsocial" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Razón Social:</div>
                </label><!--
                --><div class="col-sm-10 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="razonsocial" />
                </div>
            </div>
            <!--Campos NIT -->


            <div class="campos-cedu-ciudadana">
				<label for="identificacion_nat" class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <div class="pR20 ff1">Número Documento:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <input type="text" class="form-control input_campo_datos" id="identificacion_nat">
                </div><!--
                --><label for="identificacion_nat_confirm" class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <div class="pLR20 ff1">Confirmar:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <input type="text" class="form-control input_campo_datos" id="identificacion_nat_confirm">
                </div><!--
                --><label class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana"><div class="pLR20 ff1"></div></label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana"></div>

<!--
      <div class="col-lg-4 col-md-4 col-sm-4" id="columna-3">

      <div id="mes_dia">
       <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="col-lg-8 col-md-8 col-sm-8"><!-- Mes -->
         <div class="form-group campos-cedu-ciudadana">
            <label for="mes"  class="col-lg-2  control-label label-mes"><p class="text-label ">Mes:</p></label>
            <div class="col-lg-10 cont-input">
                <select  class="form-control " id="mes" tabindex="4">
                  <option value="0">SELECCIONE...</option>
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
                    <option value="0">SELECCIONE...</option>
                    <?php for($i=1;$i<=31;$i++) : ;?>
                          <option value="<?= $i ;?>"><?= $i ;?></option>
                    <?php endfor ;?>
                </select>
              </div>
              </div>
             </div>
       </div>
       </div>




                <br /><br />

                <label for="pnombre" class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <div class="pR20 ff1">Nombres:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <input type="text" class="form-control input_campo_datos" id="pnombre">
                </div><!--
                --><label for="papellido" class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <div class="pLR20 ff1">Apellidos:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <input type="text" class="form-control input_campo_datos" id="papellido">
                </div><!--
                --><label for="genero" class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <div class="pLR20 ff1">Género:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter campos-cedu-ciudadana">
                    <select  class="form-control input_campo_datos" id="genero" tabindex="8">
                        <option value="">Seleccione...</option>
                        <option value="1">Masculino</option>
                        <option value="0">Femenino</option>
                    </select>
                </div>

            </div>

            <hr />

			<div>
				<label for="idpais" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">País residencia:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                    <select class="form-control input_campo_datos" id="idpais" tabindex="9">
                    	<option value="1">Colombia</option>
                    </select>
                </div><!--
                --><label for="iddpto" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pLR20 ff1">Departamento:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                    <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>
                </div><!--
                --><label for="idmcipio" class="col-sm-2 col-xs-12 vcenter">
                	<div class="pLR20 ff1">Municipio:</div>
                </label><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                	<select class="form-control input_campo_datos" id="idmcipio">
                    	<option value="0" tabindex="11">Seleccione una ciudad o municipio</option>
                    </select>
                </div>

                <br /><br />

                <label for="razonsocial" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Dirección Residencia:</div>
                </label><!--
                --><div class="col-sm-10 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="direccion" />
                </div>

                <br /><br />

                <label for="barrio" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Barrio:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="barrio">
                </div><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                </div><!--
                --><label for="email" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Correo Electrónico:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="email">
                </div>

                <br /><br />

                <label for="celular1" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Número Celular:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="celular1">
                </div><!--
                --><div class="col-sm-2 col-xs-12 vcenter">
                </div><!--
                --><label for="email_confirm" class="col-sm-2 col-xs-12 vcenter">
                    <div class="pR20 ff1">Confirmar Correo Electrónico:</div>
                </label><!--
                --><div class="col-sm-3 col-xs-12 vcenter">
                    <input type="text" class="form-control input_campo_datos" id="email_confirm">
                </div>

			</div>


			<hr />

            <center>

            	<?php include (APPLICATION_SECTIONS . 'indicador_procesos.php');?>
                <button type="button" class="btn_volver btn btn-danger" id="btn_paso_2_anterior">Anterior</button>
                <button type="button" class="btn_finalizar_registro btn btn-success" id="btn_finalizar">Finalizar Registro</button>


            </center>


</div>
</div>
<!-- ====( Btn = Anterior - Siguiente )==== -->

</form>

</div>

</div>


