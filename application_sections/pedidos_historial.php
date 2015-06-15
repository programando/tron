 <tr>
  <td class="text-center"> <?= $fecha_pedido ;?> </td><!-- Fecha pedido -->
  <td class="text-center "><a class='pedido' href="javascript:void(0);"
    idpedido = "<?= $idpedido;?>" > <?= $numero_pedido ;?>  </a></td><!-- Numero-Pedido -->
    <td class="text-center"> <?= $valor_pedido ;?>  </td><!--Valor pedido -->
    <td class="text-center"><?=  $vr_a_pagar  ;?> </td><!-- Valor a pagar -->
    <td class="text-center"><?= $prefijo .' ' . $factura ;?> </td><!-- Número factura -->
    <?php if ( $facturado  == TRUE ) :?>
      <td class="text-center">Facturado</td><!-- Estado -->
    <?php else :?>
      <td class="text-center">Pendiente de Pago</td><!-- Estado -->
    <?php endif ;?>
    <td class="text-center"><!-- Medio de pago -->
      <?php if ( $id_forma_pago == 2 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_efecty.jpg" title="Pagado en Efecty">
     <?php endif ;?>
     <?php if ( $id_forma_pago == 3 || $id_forma_pago == 0 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_balquimia.jpg" title="Pago en Empresa">
     <?php endif ;?>
     <?php if ( $id_forma_pago == 4 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_pse.jpg" title="Pago PSE">
     <?php endif ;?>
   </td>
   <?php if ( $facturado  == TRUE )  :?>
    <td class="text-center"><!-- Medio de pago -->
     <img  class ="historial-cambiar-forma-pago" style="width: 25%;" src="<?= BASE_IMG_TIENDA ;?>editar_pago.png" title="Cambiar forma de Pago">
   </td><!-- Medio de pago -->

   <td class="text-center"><!-- Eliminar -->

     <img class="historial-eliminar-pedido"
          src                   ="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png" title="Eliminar Pedido"
          idpedido              = "<?= $idpedido ;?>"
          comisiones-utilizadas = "<?= $vr_comis_pago_pedidos ;?>"
          puntos-utilizados     = "<?= $vr_puntos_redimidos ;?>"
          numero-pedido         = "<?= $numero_pedido ;?>"
          idtercero             = "<?= $idtercero ;?>"
      >
 </td><!-- Eliminar -->
<?php else :?>
<td></td>
<td></td>
<?php endif ;?>
</tr>
