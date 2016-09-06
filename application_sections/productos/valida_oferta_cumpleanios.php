<?php
       $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
       $Cumple_Anios     = Session::Get('cumple_anios');

       if ( $Id_Area_Consulta == 2  && $Cumple_Anios == TRUE ){
              $en_oferta = TRUE ;
       }
?>
