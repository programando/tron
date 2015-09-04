<table class="table table-bordered table-hover  tabla_info_compras">
         <thead><!-- cabezera -->
              <tr>
               <th class="text-center">#</th>
               <th class="text-center">Fecha Registro</th>
               <th class="text-center">Nombre Cliente</th>
               <th class="text-center">Nombre Padre</th>
               <th class="text-center">Nombre Abuelo</th>

          </tr>
     </thead><!-- cabezera -->

     <tbody style="font-size: 11px;">
          <?php $I=1; ?>
           <?php foreach ($this->Clientes as $Cliente)  : ?>
            <?php
              $cliente           = $Cliente['cliente'];
              $fechahoraregistro = date("d-M-Y", strtotime($Cliente['fechahoraregistro']));
              $nombre_padre      = $Cliente['nombre_padre'];
              $nombre_abuelo     = $Cliente['nombre_abuelo'];
            ?>
            <tr>
              <td> <?= $I  ;?> </td>
              <td> <?= $fechahoraregistro ;?> </td>
              <td> <?= $cliente  ;?> </td>
              <td> <?= $nombre_padre ;?> </td>
              <td> <?= $nombre_abuelo  ;?> </td>
            </tr>
            <?php $I++;?>
          <?php endforeach ;?>
     </tbody>
</table>
