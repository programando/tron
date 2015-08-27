 <?php
				$idpedido              = $Pedido['idpedido'] ;
				$idtercero             = $Pedido['idtercero'] ;
				$fecha_pedido          = $Pedido['fecha_pedido'];
				$numero_pedido         = $Pedido['numero_pedido'] ;
				$valor_pedido          = Numeric_Functions::Formato_Numero( $Pedido['valor_pedido']) ;
				$vr_a_pagar            = Numeric_Functions::Formato_Numero( $Pedido['vr_a_pagar']) ;
				$facturado             = $Pedido['facturado'] ;
				$id_forma_pago         = $Pedido['id_forma_pago'] ;
				$prefijo               = $Pedido['prefijo'] ;
				$factura               = $Pedido['factura'] ;
				$vr_comis_pago_pedidos = $Pedido['vr_comis_pago_pedidos'];
				$vr_puntos_redimidos   = $Pedido['vr_puntos_redimidos'];
				$pago_recibido         = $Pedido['pago_recibido'];
?>
