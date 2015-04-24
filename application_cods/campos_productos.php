<?php

       $en_oferta            = $Productos['en_oferta'];
       $fabricado_x_ta       = $Productos['fabricado_x_ta'];
       $id_agrupacion        = $Productos['id_agrupacion'];
       $id_controles         = 'cantidad'.$Productos['idproducto'];
       $id_controles_escalas = 'escalas'.$Productos['idproducto'];
       $id_precio_final_tron = 'precio_final_tron'.$Productos['idproducto'];
       $id_pv_tron           = $Productos['pv_tron'];
       $idescala             = $Productos['idescala'];
       $idnompresentacion    = 'nompresentacion'.$Productos['idproducto'];
       $idnomproducto        = 'nomproducto'.$Productos['idproducto'];
       $idproducto           = $Productos['idproducto'];
       $nom_agrupacion       = $Productos['nom_agrupacion'];
       $nom_producto         =  $Productos['nom_producto'];
       $nombre_imagen        = $Productos['nombre_imagen'];
       $nompresentacion      =  $Productos['nompresentacion'];
       $pv_ocasional         = Numeric_Functions::Formato_Numero($Productos['pv_ocasional']);
       $pv_tron              = Numeric_Functions::Formato_Numero($Productos['pv_tron']);
       $pv_tron_escala_a     = $Productos['pv_tron_escala_a'];
       $pv_tron_escala_b     = $Productos['pv_tron_escala_b'];
       $pv_tron_escala_c     = $Productos['pv_tron_escala_c'];
       $pv_tron_previo       = $Productos['pv_tron'];
       $Id_Area_Consulta      = Session::Get('Id_Area_Consulta');
       if (!isset($Id_Area_Consulta))
       {
              $Id_Area_Consulta = 2;
       }
       // CONSULTA CONTENIDO ARRAY DE CANT. DE PRODUCTOS TRON COMPRADOS
       $NombreArray            = 'TRON'.$idproducto;
       $Cantidad_Comprada      = Session::Get($NombreArray );
?>





