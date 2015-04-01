
<tr>
  <td colspan="6" class="text-right">
    <div class="cont-cupon"><!--Cupon de descuento -->
      <div class="form-horizontal">
        <label for="cupon" class="label-cupon text-label">Cupón de descuento:</label>
        <div>
          <input type="text" class="form-control input-cupon" id="cupon">
        </div>
        <button type="button" class="btn-cupon">Aplicar</button>
      </div>
    </div><!--Cupon de descuento -->


    <div class="col-resumen-pedido"><strong>Subtotal:</strong></div>

    <!-- PUNTOS -->
    <?php if (isset($saldo_puntos_cantidad ) and $saldo_puntos_cantidad >0): ; ?>
      <div class="col-resumen-pedido"><strong>Puntos por redimir:</strong></div>
    <?php endif; ?>

    <!-- COMISIONES -->
    <?php  if (isset($saldo_comisiones ) and $saldo_comisiones >0): ;?>
      <div class="col-resumen-pedido"><strong>Comisiones utilizadas:</strong></div>
    <?php endif;?>

    <!-- CUPÓN DE DESCUENTOS-->
    <?php  if (isset($Vr_Cupon_Descuento ) and $Vr_Cupon_Descuento >0): ;?>
        <div class="col-resumen-pedido"><strong>Cupón de descuento:</strong></div>
    <?php endif;?>

    <!-- TRANSPORTE-->
    <?php if (Session::Get('autenticado')==false): ; ?>
      <div class="col-resumen-pedido"><strong>Transporte (Calculado para Cali):</strong></div>
    <?php else : ?>
       <div class="col-resumen-pedido"><strong>Transporte ( <?= Session::Get('nommcipio_despacho') ;?> ):</strong></div>
    <?php endif ;?>

    <!-- TOTAL PEDIDO-->
    <div class="col-resumen-pedido"><strong>Total Pedido:</strong></div>
  </td>

  <td  class="text-right">

      <!-- SUBTOTAL -->
      <div><strong><?= Numeric_Functions::Formato_Numero( $this->Total_Parcial_pv_ocasional)  ; ?></strong></div>

      <!-- PUNTOS -->
      <?php if (isset($this->saldo_puntos_cantidad ) and $this->saldo_puntos_cantidad >0): ; ?>
        <div><strong> <?=  Numeric_Functions::Formato_Numero( $this->saldo_puntos_cantidad) ;?> </strong></div>
      <?php endif;?>

      <!-- COMISIONES -->
      <?php  if (isset($this->saldo_comisiones ) and $this->saldo_comisiones >0): ;?>
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->saldo_comisiones)  ;?> </strong></div>
      <?php endif ;?>

      <!-- CUPÓN DE DESCUENTO -->
      <?php  if (isset($this->Vr_Cupon_Descuento ) and $this->Vr_Cupon_Descuento >0): ;?>
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Cupon_Descuento)  ;?> </strong></div>
      <?php endif ;?>

      <!-- TRANSPORTE -->
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Transporte_Cliente)  ;?> </strong></div>


      <!-- TOTAL PEDIDO -->
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Total_Pedido_Ocasional )  ;?> </strong></div>

  </td>
<?php if (Session::Get('idtipo_plan_compras')==1 || Session::Get('autenticado')==false) :?>
  <td ><!-- Este campo debe de estar vacio Columna de separación en los totales--> </td>


 <td coslpan="3" class="text-right">
   <!-- SUBTOTAL -->
   <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Total_Parcial_pv_tron ) ; ?> </strong></div>

   <!-- PUNTOS -->
   <?php if (isset($this->saldo_puntos_cantidad ) and $this->saldo_puntos_cantidad >0): ; ?>
    <div><strong> <?=   Numeric_Functions::Formato_Numero( $saldo_puntos_cantidad)  ;?> </strong></div>
  <?php endif;?>

  <!-- COMISIONES -->
  <?php  if (isset($this->saldo_comisiones ) and $this->saldo_comisiones >0): ;?>
    <div><strong><?= Numeric_Functions::Formato_Numero( $this->saldo_comisiones) ;?></strong></div>
  <?php endif ;?>

  <!-- CUPÓN DE DESCUENTO -->
  <?php  if (isset($this->Vr_Cupon_Descuento ) and $this->Vr_Cupon_Descuento >0): ;?>
    <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Cupon_Descuento)  ;?> </strong></div>
  <?php endif ;?>

  <!-- TRANSPORTE -->
      <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Transporte_Cliente)  ;?> </strong></div>


  <!-- TOTAL PEDIDO -->
     <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Total_Pedido_Tron  )  ;?> </strong></div>
<?php endif;?>

</td>
</tr>


