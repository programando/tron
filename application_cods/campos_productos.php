<?php
       $en_oferta                   = $Productos['en_oferta'];
       $fabricado_x_ta              = $Productos['fabricado_x_ta'];
       $id_agrupacion               = $Productos['id_agrupacion'];
       $id_controles                = 'cantidad'.$Productos['idproducto'];
       $id_controles_escalas        = 'escalas'.$Productos['idproducto'];
       $id_precio_final_tron        = 'precio_final_tron'.$Productos['idproducto'];
       $id_pv_tron                  = $Productos['pv_tron'];
       $idescala                    = $Productos['idescala'];
       $idnompresentacion           = 'nompresentacion'.$Productos['idproducto'];
       $idnomproducto               = 'nomproducto'.$Productos['idproducto'];
       $idproducto                  = $Productos['idproducto'];
       $nom_agrupacion              = $Productos['nom_agrupacion'];
       $nom_producto                = trim($Productos['nom_producto']);
       $nombre_imagen               = $Productos['nombre_imagen'];
       $nompresentacion             = trim( $Productos['nompresentacion']);
       $pv_ocasional                = Numeric_Functions::Formato_Numero($Productos['pv_ocasional']);
       $pv_tron                     = Numeric_Functions::Formato_Numero($Productos['pv_tron']);
       $pv_comprador_ocasional      = $Productos['pv_ocasional'];
       $pv_tron_escala_a            = $Productos['pv_tron_escala_a'];
       $pv_tron_escala_b            = $Productos['pv_tron_escala_b'];
       $pv_tron_escala_c            = $Productos['pv_tron_escala_c'];
       $pv_tron_previo              = $Productos['pv_tron'];
       $Id_Area_Consulta            = Session::Get('Id_Area_Consulta');
       $id_categoria_producto       = $Productos['id_categoria_producto'];
       //
       $text_pv_comprador_ocasional = Numeric_Functions::Formato_Numero($Productos['pv_ocasional']);
       $text_pv_tron                = Numeric_Functions::Formato_Numero($Productos['pv_tron']);

       if (!isset($Id_Area_Consulta))  {
              $Id_Area_Consulta = 2;
              Session::Set('Id_Area_Consulta',$Id_Area_Consulta);
       }
       // CONSULTA CONTENIDO ARRAY DE CANT. DE PRODUCTOS TRON COMPRADOS
       $NombreArray            = 'TRON'.$idproducto;
       $Cantidad_Comprada      = Session::Get($NombreArray );
       if ( empty($Cantidad_Comprada))  {  $Cantidad_Comprada = 0;  }

       /*     AGOSTO 05 2016
              CONFIGURACIÓN PARA QUE TODOS LOS PRODUCTOS ESTÉN EN OFERTA
              PARA QUIEN CUMPLE AÑOS
       */
        include (APPLICATION_SECTIONS . 'productos/valida_oferta_cumpleanios.php')

?>





