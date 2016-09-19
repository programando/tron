<?php
       $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
       $Cumple_Anios     = Session::Get('cumple_anios');
       $Cambio_Status		  = Session::Get('ofertas_x_cambio_status_empresario') ;

       if ( ( $Id_Area_Consulta == 2  && $Cumple_Anios == TRUE ) || $Cambio_Status == TRUE ) {
              $en_oferta = TRUE ;
       }

?>
