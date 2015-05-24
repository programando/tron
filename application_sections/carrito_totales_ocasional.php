<td coslpan="3" class="text-right">
        <div><strong><?= Numeric_Functions::Formato_Numero( $this->SubTotal_Pedido_Ocasional)  ; ?></strong></div>
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
