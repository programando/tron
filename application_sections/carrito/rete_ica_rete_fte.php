<?php if ( $vr_rte_ica > 0 ) :?>
  <div><strong><?=  Numeric_Functions::Formato_Numero( $vr_rte_ica)  ;?> </strong></div>
<?php endif ;?>

<?php if ( $vr_rte_fte > 0 ) :?>
  <div><strong><?=  Numeric_Functions::Formato_Numero( $vr_rte_fte)  ;?> </strong></div>
<?php endif ;?>

<?php if ( $vr_rte_fte > 0 || $vr_rte_ica > 0 ) :?>
  <div><strong><?=  Numeric_Functions::Formato_Numero( $Vr_Pedido_Total - ( $vr_rte_ica + $vr_rte_fte ) )  ;?> </strong></div>
<?php endif ;?>