 <tr>

  <td class="text-center"> <?= $fecha_pedido ;?> </td>
  <td class="text-right "><a class='pedido' href="javascript:void(0);"
    idpedido = "<?= $idpedido;?>" > <?= $numero_pedido ;?>  </a></td>
    <td class="text-right">         <?= $valor_pedido ;?>  </td>
    <td class="text-right">         <?=  $vr_a_pagar  ;?> </td>
    <td class="text-center">        <?= $prefijo .' ' . $factura ;?> </td>
    <td class="text-left"> <?= $Estado ;?> </td>


    <td class="text-center"><!-- Medio de pago -->
      <?php if ( $id_forma_pago == 0 && $Estado !='Pagado con puntos/comisiones') :?>
        Por Asignar
      <?php endif ;?>

      <?php if ( $id_forma_pago == 2 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_efecty.jpg" title="Pagado en Efecty">
     <?php endif ;?>

     <?php if ( $id_forma_pago == 3 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_balquimia.jpg" title="Pagado en Empresa">
     <?php endif ;?>

     <?php if ( $id_forma_pago == 4 ) :?>
       <img style="width: 25%;" src="<?= BASE_IMG_EMPRESA ;?>pago_pse.jpg" title="Pagado PayuLatam">
     <?php endif ;?>

   </td>

   <?php if ( $Permite_Cambio_FormaPago  == TRUE )  :?>
    <td class="text-center">
     <img  class ="historial-cambiar-forma-pago" style="width: 25%;"
     src="<?= BASE_IMG_TIENDA ;?>editar_pago.png" title="Cambiar forma de Pago"
     idpedido      = "<?= $idpedido ;?>"
     numero-pedido = "<?= $numero_pedido ;?>"
     idtercero     = "<?= $idtercero ;?>"
     >
   </td>
 <?php else :?>
  <td></td>
<?php endif ;?>

<?php if ( $Permite_Eliminacion  == TRUE )  :?>
 <td class="text-center"><!-- Eliminar -->
   <span class="glyphicon glyphicon-trash historial-eliminar-pedido"
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
<?php endif ;?>
</tr>
