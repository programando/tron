 <?php
 			// MAYO 18 DE 2015
		 //				VALOR QUE SE MUESTRA EN LA PARTE SUPERIOR DE LA PAGINA.  VALOR DE VENTA PARA AMIGOS TRON O EMPRESARIOS
 		if(Session::Get('SubTotal_Pedido_Amigos')>0)
 				{
   				echo Numeric_Functions::Formato_Numero( Session::Get('SubTotal_Pedido_Amigos'));
 				}else {
   				echo  '$0';
  		}
?>
