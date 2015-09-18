
<tr>
  <td colspan="6" class="text-right">

        <div class="col-resumen-pedido"><strong>Subtotal:</strong></div>
        <?php if (Session::Get('autenticado') == FALSE): ; ?>
          <div class="col-resumen-pedido"><strong>Transporte <small>( Calculado para Cali ):</small></strong></div>
        <?php else : ?>
           <div class="col-resumen-pedido"><strong>( + ) Transporte <small>( <?= Session::Get('nommcipio_despacho') ;?> ):</small> </strong></div>
        <?php endif ;?>

        <!-- PUNTOS -->
        <?php if (isset($this->Puntos_Utilizados) and $this->Puntos_Utilizados >0): ; ?>
          <div class="col-resumen-pedido"><strong>( - ) Puntos por redimir:</strong></div>
        <?php endif; ?>
        <!-- COMISIONES -->
        <?php  if (isset($this->Comisiones_Utilizadas ) and $this->Comisiones_Utilizadas >0): ;?>
          <div class="col-resumen-pedido"><strong>( - ) Comisiones utilizadas:</strong></div>
        <?php endif;?>
        <!-- CUPÓN DE DESCUENTOS-->
        <?php  if (isset($Vr_Cupon_Descuento ) and $Vr_Cupon_Descuento >0): ;?>
            <div class="col-resumen-pedido"><strong>( - ) Cupón de descuento:</strong></div>
        <?php endif;?>
        <!-- TRANSPORTE-->

        <!-- TOTAL PEDIDO-->
        <div class="col-resumen-pedido"><strong>( = ) Total Pedido:</strong></div>
  </td>

<?php
  $cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');
?>

 <?php if ( $cumple_condicion_cpras_tron_industial == FALSE || empty( $cumple_condicion_cpras_tron_industial)) :?>
        <!-- SUBTOTAL -->
        <?php include (APPLICATION_SECTIONS . 'carrito_totales_no_cumple_condiciones_compra.php');?>
      <?php else :?>
  <td></td>
      <?php include (APPLICATION_SECTIONS . 'carrito_totales_cumple_condiciones_compra.php');?>
  <?php endif ;?>







</tr>


