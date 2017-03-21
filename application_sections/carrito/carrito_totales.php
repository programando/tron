<?php 
  $nommcipio_despacho   = trim( Session::Get('nommcipio_despacho'));
  $iddireccion_despacho = Session::Get('iddireccion_despacho');
  if ( !isset($iddireccion_despacho )){
      $iddireccion_despacho = 0;
  }
  //echo $iddireccion_despacho . 'iddireccion_despacho';
?>

<tr>
  <td colspan="6" class="text-right">

        <div class="col-resumen-pedido"><strong>Subtotal:</strong></div>

        <?php if ( $iddireccion_despacho > 0 ) :?>
               <?php if ( Session::Get('cobrar_fletes') == TRUE ) :?>
                  <div class="col-resumen-pedido"><strong>( + ) Transporte + Recaudo... <small>( <?= $nommcipio_despacho ;?> ):</small> </strong></div>
                  <?php else : ?>
                    <div class="col-resumen-pedido"><strong>( + ) Recaudo.<small>( <?= $nommcipio_despacho ;?> ):</small> </strong></div>
               <?php endif ;?>
          <?php endif ;?>


        <!-- PUNTOS -->
        <?php if (isset($this->Puntos_Utilizados) && $this->Puntos_Utilizados >0): ; ?>
          <div class="col-resumen-pedido"><strong>( - ) Puntos por redimir:</strong></div>
        <?php endif; ?>
        <!-- COMISIONES -->
        <?php  if (isset($this->Comisiones_Utilizadas ) && $this->Comisiones_Utilizadas >0): ;?>
          <div class="col-resumen-pedido"><strong>( - ) Comisiones utilizadas:</strong></div>
        <?php endif;?>
        <!-- CUPÓN DE DESCUENTOS-->
        <?php  if (isset($Vr_Cupon_Descuento ) && $Vr_Cupon_Descuento >0): ;?>
            <div class="col-resumen-pedido"><strong>( - ) Cupón de descuento:</strong></div>
        <?php endif;?>
        <!-- TRANSPORTE-->

        <!-- TOTAL PEDIDO-->
        <div class="col-resumen-pedido"><strong>( = ) Total Pedido:</strong></div>
  </td>

<?php
  $cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');
  $logueado                              = $_SESSION['logueado'];
?>

 <?php if ( $cumple_condicion_cpras_tron_industial == FALSE || empty( $cumple_condicion_cpras_tron_industial) ) :?>
        <!-- SUBTOTAL -->
        <?php include (APPLICATION_SECTIONS . 'carrito/carrito_totales_no_cumple_condiciones_compra.php');?>
      <?php else :?>
  <td></td>
      <?php include (APPLICATION_SECTIONS . 'carrito/carrito_totales_cumple_condiciones_compra.php');?>
  <?php endif ;?>


</tr>


