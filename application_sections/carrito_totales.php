
<tr>
  <td colspan="6" class="text-right">
  <!--
        <div class="cont-cupon">
          <div class="form-horizontal">
            <label for="cupon" class="label-cupon text-label">Cupón de descuento:</label>
            <div>
              <input type="text" class="form-control input-cupon" id="cupon">
            </div>
            <button type="button" class="btn-cupon">Aplicar</button>
          </div>
        </div>
    -->

        <div class="col-resumen-pedido"><strong>Subtotal:</strong></div>
        <?php if (Session::Get('autenticado') == false): ; ?>
          <div class="col-resumen-pedido"><strong>Transporte (Calculado para Cali):</strong></div>
        <?php else : ?>
           <div class="col-resumen-pedido"><strong>( + ) Transporte ( <?= Session::Get('nommcipio_despacho') ;?> ):</strong></div>
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

<?php if  (Session::Get('autenticado')== FALSE)  :?>
        <!-- SUBTOTAL -->
          <?php include (APPLICATION_SECTIONS . 'carrito_totales_ocasional.php');?>
  <td></td>
      <?php include (APPLICATION_SECTIONS . 'carrito_totales_tron.php');?>
  <?php endif ;?>


<?php if  (Session::Get('autenticado')== TRUE)  :?>
  <td></td>
  <td></td>
    <?php if  ( Session::Get('cumple_condicion_cpras_tron_industial')== TRUE)  :?>
            <?php include (APPLICATION_SECTIONS . 'carrito_totales_tron.php');?>
      <?php else :?>
            <?php include (APPLICATION_SECTIONS . 'carrito_totales_ocasional.php');?>
    <?php endif ;?>
  <?php endif ;?>
</tr>


