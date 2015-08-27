<tbody id ='resumen_pedido_productos'>
<?php
    $CarritoTron = Session::Get('CarritoTron');

    if ( isset($CarritoTron) ) {
      foreach ($CarritoTron  as $Productos){
        $nom_producto = trim($Productos['nom_producto']);
        $cantidad     = $Productos['cantidad'];
        $pv_tron      = number_format($Productos['pv_tron']);
        $idproducto   = $Productos['idproducto'];

        ?>
        <tr class="fila_por_producto">
          <td id='datos-producto'>
            <div class="nombre_producto">   <small> <?= $nom_producto  ;?>        </small> </div> <!--Nombre Del Producto -->
            <div class="cantidad-producto"> <small> <p> X <?= $cantidad ;?> </p>  </small>  </div><!--cantidad-producto -->
            <div class="precio-porducto">   <small> <p> $ <?= $pv_tron ;?>  </p>  </small>  </div><!--precio-porducto -->
           <!-- Borrar producto -->
            <div     class="borrar-producto"
                     cantidad   = '<?= $cantidad ; ?>'
                     idproducto = '<?= $idproducto ; ?>'>
                <small>
                    <span
                     id         ='btn-borrar-resumen'
                     class      ="glyphicon glyphicon-trash  resumen-pedido-img"
                     title      ="Borrar del Pedido"
                     cantidad   = '<?= $cantidad ; ?>'
                     idproducto = '<?= $idproducto ; ?>'></span>
                </small>
            </div>


          </td>

        </tr>
        <?php } ?>
<?php

} ;?>

  </tbody>
