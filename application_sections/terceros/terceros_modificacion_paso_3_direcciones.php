<div class="contenedor_from_3">
  <div class=" row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <!-- Barra Usuarios -->
      <br />
      <?php include(APPLICATION_SECTIONS .'barra_usuraios.php') ;?>
      <br />
      <h5>Realice los cambios en la dirección que desea modificar</h5><br />

      <table class="table table-bordered table-hover  tabla_info_compras">
        <thead>
          <tr>
            <th class="table-header">DESTINATARIO</th>
            <th class="table-header">DIRECCIÓN</th>
            <th class="table-header">BARRIO</th>
            <th class="table-header">CELULAR</th>
            <th class="table-header">DPTO</th>
            <th class="table-header">MCIPIO</th>
            <th class="table-header"></th>
          </tr>
        </thead>
        <tbody>
      <!--  AGOSTO 25 DE 2016
              $NumSelectDpto
              Contador del select del departamento , Necesario para actualizar los municipios por fila
              Este dato lo uso en la modificacion de direcciones
            -->
            <?php $NumSelectDpto = 0 ;?>
            <?php $Cantidad_Direcciones = 0 ;?>
            <?php   foreach($this->Direcciones as $Direccion)   :?>
              <?php $iddireccion_despacho = $Direccion['iddireccion_despacho'] ;?>

              <tr class="table-row fila-direccion">

                <td contenteditable="true" id="<?=$iddireccion_despacho;?>"  >  <?= $Direccion['destinatario'] ;?> </td>
                <td contenteditable="true"   > <?= $Direccion['direccion'] ;?>     </td>
                <td contenteditable="true"   > <?= $Direccion['barrio'] ;?>        </td>
                <td contenteditable="true"   > <?= $Direccion['telefono'] ;?>      </td>

                <td>
                  <?php
                  $iddpto_previo    = $Direccion['iddpto']    ;
                  $nomdpto_previo   = $Direccion['nomdpto']   ;
                  $idmcipio_previo  = $Direccion['idmcipio']  ;
                  $nommcipio_previo = $Direccion['nommcipio'] ;

                  ?>
                  <?php include (APPLICATION_SECTIONS . 'departamentos.php');?>
                </td>

                <td> <select class="form-control" id="new_idmcipio<?=$NumSelectDpto;?>">
                  <option value="<?= $idmcipio_previo ;?>"> <?= $nommcipio_previo ;?> </option>
                  <option>Seleccione un Municipio</option>
                </select>
              </td>

              <td>
                <button type="button" id="btn-actualizar-direccion" class="btn btn-success" idselectdpto="<?= $NumSelectDpto ;?>">
                  Actualizar Datos
                </button>
              </td>
            </tr>
            <?php $NumSelectDpto++        ;?>
            <?php $Cantidad_Direcciones++ ;?>
          <?php endforeach ;?>

        </tbody>
      </table>
      <?php if  ( $Cantidad_Direcciones < 3 ) :?>
        <button type="button" id="btn-agregar-direccion" class="btn btn-success"  >
          Crear Nueva Dirección
        </button>
        <?php include (APPLICATION_SECTIONS . 'carrito/carrito_crear_editar_direccion.php');?>
      <?php endif ;?>


    </div>
  </div>
</div>


