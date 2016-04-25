

    <td coslpan="3" class="text-right">
            <div><strong><?= Numeric_Functions::Formato_Numero( $this->SubTotal_Pedido_Ocasional)  ; ?></strong></div>
            <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Transporte_Ocasional)  ;?> </strong></div>
            <!-- PUNTOS -->
            <?php if (isset($this->Puntos_Utilizados ) and $this->Puntos_Utilizados >0): ; ?>
              <div><strong> <?=  Numeric_Functions::Formato_Numero( $this->Puntos_Utilizados) ;?> </strong></div>
            <?php endif;?>
            <!-- COMISIONES -->
            <?php  if (isset($this->Comisiones_Utilizadas ) and $this->Comisiones_Utilizadas >0): ;?>
              <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Comisiones_Utilizadas)  ;?> </strong></div>
            <?php endif ;?>
            <!-- CUPÓN DE DESCUENTO -->
            <?php  if (isset($this->Vr_Cupon_Descuento ) and $this->Vr_Cupon_Descuento >0): ;?>
              <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Cupon_Descuento)  ;?> </strong></div>
            <?php endif ;?>
            <!-- TRANSPORTE -->
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Total_Pedido_Ocasional )  ;?> </strong></div>

    </td>
<td></td>

<td coslpan="3" class="text-right">
   <!-- SUBTOTAL -->
       <div><strong><?=  Numeric_Functions::Formato_Numero( $this->SubTotal_Pedido_Amigos ) ; ?> </strong></div>
         <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Transporte_Tron)  ;?> </strong></div>
       <!-- PUNTOS -->
       <?php if (isset($this->Puntos_Utilizados ) and $this->Puntos_Utilizados >0): ; ?>
        <div><strong> <?=   Numeric_Functions::Formato_Numero( $this->Puntos_Utilizados)  ;?> </strong></div>
      <?php endif;?>

      <!-- COMISIONES -->
      <?php  if (isset($this->Comisiones_Utilizadas ) and $this->Comisiones_Utilizadas >0): ;?>
        <div><strong><?= Numeric_Functions::Formato_Numero( $this->Comisiones_Utilizadas) ;?></strong></div>
      <?php endif ;?>
      <!-- CUPÓN DE DESCUENTO -->
      <?php  if (isset($this->Vr_Cupon_Descuento ) and $this->Vr_Cupon_Descuento >0): ;?>
        <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Cupon_Descuento)  ;?> </strong></div>
      <?php endif ;?>
 <div><strong><?=  Numeric_Functions::Formato_Numero( $this->Vr_Total_Pedido_Tron )  ;?> </strong></div>

</td>

