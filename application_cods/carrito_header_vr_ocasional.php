
<?php
			// MAYO 18 DE 2015
		 //				VALOR QUE SE MUESTRA EN LA PARTE SUPERIOR DE LA PAGINA.  VALOR DE VENTA PARA COPRADORES OCASIONALES
			if(Session::Get('SubTotal_Pedido_Ocasional')>0) {
						echo Numeric_Functions::Formato_Numero( Session::Get('SubTotal_Pedido_Ocasional'));
				}else
				{
						echo '$0';
 			}
?>


