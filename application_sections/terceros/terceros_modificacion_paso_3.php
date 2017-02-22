<div class="contenedor_from_3">
    <div class=" row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- Barra Usuarios -->
            <br />
            <?php include(APPLICATION_SECTIONS .'barra_usuraios.php') ;?>
            <hr />
            <h5>Seleccione la dirección que desea modificar</h5><br />

            <div class="col-lg-6 col-md-6 col-sm-6 ">
            <div class="conteneror-direcciones">
             <?php $Cant_Direcciones=0;?>
                    <?php foreach ($this->Direcciones as $Direccion) :?>
                                <?php
                                            $destinatario         = $Direccion['destinatario'];
                                            $direccion            = $Direccion['direccion'];
                                            $nommcipio_despacho   = $Direccion['nommcipio_despacho'];
                                            $nomdpto              = $Direccion['nomdpto'];
                                            $iddireccion_despacho = $Direccion['iddireccion_despacho'];
                                            $iddpto               = $Direccion['iddpto'];
                                            $idmcipio             = $Direccion['idmcipio'];
                                            $telefono             = $Direccion['telefono'];
                                            $barrio 													 = $Direccion['barrio'];
                                            $idtercero            = $Direccion['idtercero'];
                                            $Cant_Direcciones++ ;
                                ?>
                                <a href="" class="direcciones_a_atualizar" id="direcciones_a_atualizar"
                                            destinatario         = "<?= $destinatario ;?>"
                                            direccion            = "<?= $direccion ;?>"
                                            nommcipio-despacho   = "<?= $nommcipio_despacho ;?>"
                                            nomdpto              = "<?= $nomdpto ;?>"
                                            iddpto               = "<?= $iddpto ;?>"
                                      iddireccion-despacho = "<?= $iddireccion_despacho ;?>"
                                            idmcipio             = "<?= $idmcipio ;?>"
                                            telefono             = "<?= $telefono ;?>"
                                            barrio               = "<?= $barrio ;?>"
                                            idtercero            = "<?= $idtercero ;?>"

                                >

                                <strong><?= $destinatario  ;?></strong>
            <br> <?= $direccion  . " / " . $nommcipio_despacho  . " / " . $nomdpto  ;?>
                                </a>
            <br>
                    <?php endforeach ;?>
                        <?php if ( $Cant_Direcciones < 3 ) :?>
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="text-center">
            <button type="button" class="btn_nueva_direccion" id="btn_nueva_direccion">Crear Nueva Dirección</button>
            </div>
            </div>
            <br>
            <?php endif ;?>
            </div>




            </div>

         	<!-- Formulario -->
            <div class="col-lg-6 col-md-6 col-sm-6">
            <div>
               <form class="form-horizontal" role="form">
                                            <!-- destinario -->
                                              <div class="form-group">
                                                <label for="new_destinario"  class="col-lg-3  control-label"><p class="text-label">Destinario:</p></label>
                                                <div class="col-lg-9" >
                                                   <input type="text" class="form-control" id="new_destinario"

                                                   />
                                                </div>
                                              </div>

                 <!-- Departamento -->
                                              <div class="form-group">
                                                <label for="new_iddpto"  class="col-lg-3  control-label "><p class="text-label">Departamento:</p></label>
                                                <div class="col-lg-9" >
                                                <select class="form-control" id="new_iddpto">
                                                    <option value="0">Seleccione un Departamento</option>
                                                        <?php
                                                              foreach ($this->Departamentos as $Departamento) {
                                                                  echo '<option value="'.$Departamento['iddpto'].'">'.$Departamento['nomdpto'].'</option>';
                                                                }
                                                        ?>
                                                </select>
                                                <div id='dpto_actual' class="departamento_municipio_actual"></div>
                                                </div>
                                              </div>

                 <!-- Municipio -->
                                              <div class="form-group">
                                                <label for="new_idmcipio"  class=" col-lg-3  control-label "><p class="text-label">Municipio: </p></label>
                                                <div class="col-lg-9" >
                                                   <select class="form-control" id="new_idmcipio">
                                                        <option>Seleccione un Municipio</option>
                                                   </select>
                                                   <div id='mcipio_actual' class="departamento_municipio_actual"></div>
                                                </div>
                                              </div>

                 <!-- Direccion -->
                                              <div class="form-group">
                                                <label for="new_direccion"  class="col-lg-3  control-label "><p class="text-label">Dirección: </p></label>
                                                <div class="col-lg-9" >
                                                   <input type="text" class="form-control" id="new_direccion" />
                                                </div>
                                              </div>

                 <!-- Barrio -->
                                              <div class="form-group">
                                                <label for="new_barrio"  class="col-lg-3  control-label "><p class="text-label">Barrio: </p></label>
                                                <div class="col-lg-9" >
                                                   <input type="text" class="form-control" id="new_barrio" />
                                                </div>
                                              </div>

                 <!-- Telefono -->
                                              <div class="form-group">
                                                <label for="new_celular1"  class="col-lg-3  control-label "><p class="text-label">Celular: </p></label>
                                                <div class="col-lg-9" >
                                                   <input type="text" class="form-control" id="new_celular1" />
                                                </div>
                                              </div>

                 <!-- Btn = crear / actualizar direccion -->
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <div class="text-center">
                           <button type="button" class="btn_atualizar_direccion btn btn-success" id="btn_direccion"
                                iddireccion-despacho = "<?= $iddireccion_despacho ;?>"
                                idmcipio= "<?= $idmcipio ;?>"
                                idtercero= "0">Crear / Actualizar Dirección</button>
                       </div>
                   </div>
               </form>
            </div>
            </div>

    	</div>
    </div>
</div>


