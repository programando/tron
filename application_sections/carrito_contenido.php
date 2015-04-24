<tbody>
      <!--Cuerpo = Tabla -->
    <?php

        foreach ($this->Datos_Carro as $ProductosCarro)
        {
          $idproducto              = $ProductosCarro['idproducto'];
          $nom_producto            = $ProductosCarro['nom_producto'];
          $nompresentacion         = $ProductosCarro['nompresentacion'];
          $pv_ocasional            = Numeric_Functions::Formato_Numero( $ProductosCarro['pv_ocasional'] );
          $pv_tron                 = Numeric_Functions::Formato_Numero($ProductosCarro['pv_tron']);
          $nombre_imagen           = $ProductosCarro['nombre_imagen'];
          $cantidad                = $ProductosCarro['cantidad'];
          $id_controles            = 'cantidad'.$ProductosCarro['idproducto'];
          $id_precio_final_tron    = 'precio_final_tron'.$ProductosCarro['idproducto'];
          $idescala                = $ProductosCarro['idescala'];
          $pv_tron_escala_a        = $ProductosCarro['pv_tron_escala_a'];
          $pv_tron_escala_b        = $ProductosCarro['pv_tron_escala_b'];
          $pv_tron_escala_c        = $ProductosCarro['pv_tron_escala_c'];
          $id_pv_tron              = $ProductosCarro['pv_tron'];
          $Id_Area_Consulta        = Session::Get('Id_Area_Consulta');

          $Vr_Total_Item_Ocasional = $cantidad * $ProductosCarro['pv_ocasional'];
          $Vr_Total_Item_Ocasional = Numeric_Functions::Formato_Numero($Vr_Total_Item_Ocasional ) ;
          $Vr_Total_Item_Tron      = Numeric_Functions::Formato_Numero($ProductosCarro['sub_total_pv_tron']);

          $Vr_Unit_Real_Producto  = Numeric_Functions::Formato_Numero($ProductosCarro['precio_unitario_produc_pedido']);
          $Vr_Total_Real_Producto = Numeric_Functions::Formato_Numero($ProductosCarro['precio_total_produc_pedido']);

      ?>

      <tr class="fila">
       <td class="col-tabla-eliminar" >
         <p class="info-tabla">
           <span class="glyphicon glyphicon-trash  img-eliminar"
                 id       ="tarro-de-eliminar-pedido"
                 idproducto ="<?= $idproducto ;?>"
                 cantidad ="<?= $cantidad  ;?>"
                 title    ="Eliminar Producto del Pedido">
           </span>



         </p>
       </td><!--IMG-eliminar producto -->
       <td class="col-tabla-img-proct" ><img src="<?= BASE_IMG_PRODUCTOS_50x50. $nombre_imagen ; ?>" class="img-producto"></td><!--IMG producto seleccionado -->

       <td class="col-nombre-product" >
         <p class="info-tabla">
          <a href="<?=BASE_URL ;?>productos/vista_ampliada/<?= $idproducto;?>/<?= $Id_Area_Consulta;?> "> <?= $nom_producto ;?> </a>
          </p>
       </td><!--Nombre del producto -->

      <td id="presentacion-producto"><!-- Presentacon = Producto -->
          <p class="text-center info-tabla"> <?= $nompresentacion ;?> </p>
      </td><!-- Presentacon = Producto -->



       <td class="col-tabla-cantidad" ><!--Botones => Cantidad -->
        <p class="text-center">
         <div class="costos-cantidad cantidad">
          <form class="form-horizontal" role="form">
            <div class=" col-xs-4" id="cont-menos">
              <div class="form-group">
                <!--Inicio  Boton Menos-->
                <button
                id="<?=$idproducto ;?>"
                type="button"
                class="btn btn-default btn-menos btns-carrito carrito-resumen-menos"
                onclick="javascript: Carrito_Restar('<?=$id_controles ;?>')"
                idproducto  = "<?=$idproducto ;?>"
                NomProducto ="<?= $nom_producto ;?>" >-
              </button><!-- Fin Boton Menos-->

            </div>
          </div>

          <div class="col-xs-4" id="cont-digitos">
            <div class="form-group"><!--Inicio Input-->
             <input type        = "text"  value="<?= $cantidad  ;?>"
             id                = "<?=$id_controles ;?>"
             class             = "digitos btn-carrito-input CantProductosComprados"
             id-idescala       = "<?= $idescala;?>"
             pv-tron-escala-a  = "<?= $pv_tron_escala_a ;?>"
             pv-tron-escala-b  = "<?= $pv_tron_escala_b ;?>"
             pv-tron-escala-c  = "<?= $pv_tron_escala_c ;?>"
             precio-amigo-tron = "<?= $id_pv_tron ;?>" >

           </div><!--Fin Input-->
         </div>

         <div class=" col-xs-4" id="cont-mas">
          <div class="form-group">
            <!-- Inicio Boton Mas-->
            <button
            id          ="<?=$idproducto ;?>"
            type        ="button"
            class       ="btn btn-default btn-menos btns-carrito carrito-resumen-mas"
            onclick     ="javascript: Carrito_Sumar('<?=$id_controles ;?>')"
            idproducto  = "<?=$idproducto ;?>"
            NomProducto ="<?= $nom_producto ;?>" >+
          </button> <!-- Fin Boton Mas-->
        </div>
      </div>
    </form>
  </div>
</p>
</td><!--Botones => Cantidad -->

<?php
  $Autenticado                                 = Session::Get('autenticado');
  $Cumple_Compra_Minima_Prod_Tron_Industriales = Session::Get('cumple_condicion_cpras_tron_industial');
?>

<?php if ($Autenticado == FALSE ) : ;?>
    <!--TOTAL -->
    <td class="col-tabla-preci1" ><p class="info-tabla"> <?= $pv_ocasional ;?> </p></td><!--Precio UNIT. -->
    <td class="col-tabla-preci1" ><p class="info-tabla"> <?= $Vr_Total_Item_Ocasional ;?> </p></td><!--Total -->

    <?php if (Session::Get('idtipo_plan_compras')==1 || Session::Get('autenticado')==false) :?>
      <td class="col-tabla-preci2" title="Precio unitario para clientes/empresarios TRON" >
          <p class="info-tabla" id="<?= $id_precio_final_tron ;?>"><?= $pv_tron ;?> </p>
      </td><!--Precio UNIT. -->

      <td class="col-tabla-preci2" title="Valores calculados para cliente/empresarios TRON">
        <p class="info-tabla"> <?= $Vr_Total_Item_Tron  ;?>   </p>
      </td>
    <?php endif ;?>

<?php else : ;?>
      <td class="col-tabla-preci1" ><p class="info-tabla"> <?= $Vr_Unit_Real_Producto ;?> </p></td><!--Precio UNIT. -->
      <td class="col-tabla-preci1" ><p class="info-tabla"> <?= $Vr_Total_Real_Producto ;?> </p></td><!--Total -->
 <?php endif ;?>


</tr>

    <?php } ; ?>  <!--Final recorrido productos del carro de compras -->

  </tbody>


