<?php
    $CarritoTron = Session::Get('CarritoTron');

    if ( isset($CarritoTron) ) {
      foreach ($CarritoTron  as $Productos){
        $nom_producto = trim($Productos['nom_producto']);
        $cantidad     = $Productos['cantidad'];
        $pv_tron      = number_format($Productos['pv_tron']);

        ?>
        <tr class="fila_por_producto">
          <td> <div class="nombre_producto"> <small> <?= $nom_producto  ;?> </small> </div> <!--Nombre Del Producto -->
            <div class="cantidad-producto"> <small> <p> X <?= $cantidad ;?>    </p>  </small>  </div><!--cantidad-producto -->
            <div class="precio-porducto">   <small> <p> $ <?= $pv_tron ;?> </p>  </small>  </div><!--precio-porducto -->
            <div class="borrar-producto">   <small><span class="glyphicon glyphicon-trash  resumen-pedido-img" title="Borrar del Pedido"></span></small></div><!--borrar-producto -->
          </td>

        </tr>
        <?php } ?>
<?php

} ;?>
