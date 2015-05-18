<div class="carrito-resumen-pedido" id="carrito-resumen"><!--Contenedor Del Carrito-Resumen-Pedido -->
    <div class=" row"><!--Titulo-->
     <h5 class="titulo-resumen-pedido text-center"><strong>RESUMEN PEDIDO TRON</strong></h5>
   </div><!--Fin-Titulo-->

   <!--Cant , Precio , Borrar Inicio Cabezera Del Resumen-Pedido -->
   <div class=" row">
    <div class="fila-cant_precio_borrar">
      <div class="resumen-cant">   <p>Cant   </p> </div>
      <div class="resumen-precio"> <p>Precio </p> </div>
      <div class="resumen-borrar"> <p>X      </p> </div>
    </div>
  </div>
  <!--Cant , Precio , Borrar Inicio Cabezera Del Resumen-Pedido -->

  <!--Informacion-Producto Acerca DE CANT , PRECIO , BORRAR -->
  <div class=" row">
    <div class="datos_producto_seleccionado">
     <table class="tabla-cont-datos-porducto-seleccionado"><!--Datos Del Producto -->
      <tbody>
       <tr class="fila_por_producto">
        <td> <div class="nombre_producto"> <small>Tapa dosificadora TRON Detergente para lavar ropa </small> </div> <!--Nombre Del Producto -->
          <div class="cantidad-producto"> <small> <p> X1    </p>  </small>  </div><!--cantidad-producto -->
          <div class="precio-porducto">   <small> <p> $ 300 </p>  </small>  </div><!--precio-porducto -->
          <div class="borrar-producto">   <small><span class="glyphicon glyphicon-trash  resumen-pedido-img" title="Restirar Del Pedido"></span></small></div><!--borrar-producto -->
        </td>
      </tr>
    </tbody>
  </table><!--Datos Del Producto -->
</div>
</div>
<!--Informacion-Producto Acerca DE CANT , PRECIO , BORRAR -->


<!--Datos Precios -->
<div class=" row">

 <div class="resumen_datos_precios">
  <p class="resumen_precio_ocacional"> <strong id='Total_Venta_Ocasional'>
        <?php
          if(Session::Get('SubTotal_Pedido_Ocasional')>0)
            {
              echo Numeric_Functions::Formato_Numero( Session::Get('SubTotal_Pedido_Ocasional'));
          }else
      {
        ?> $0
        <?php } ?>

  </strong><!--contenedor = Precio-Ocacional 16 -->
   <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>18.png" title="Comprador Ocasional"></span>
 </p>

 <p class="resumen_precio_clien-tron"> <strong> $ 0   </strong><!--contenedor = Precio-Cliente TRON 30 -->
  <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>17.png" title="Cliente TRON"></span>
  <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>16.png" title="Empresario TRON"></span>
</p>

<p> Descuento : <strong id ="tron_descuento">
    <?php
         $descuento_especial = "$ ".number_format(Session::Get('descuento_especial'),0,"",".");
         if ( isset( $descuento_especial  )){
              echo $descuento_especial  ;
            }
    ?>
</strong> </p><!--contenedor = Descuento  -->
<p> Ahorro    : <strong id ='tron_descuento_porciento'>
      <?php
         $descuento_especial_porcentaje = Session::Get('descuento_especial_porcentaje');
         $descuento_especial_porcentaje =  number_format((float)$descuento_especial_porcentaje, 0, '.', '') .'%';
         if ( isset( $descuento_especial_porcentaje  )){
              echo $descuento_especial_porcentaje  ;
            }
    ?>
</strong>    </p><!--contenedor = Ahorro -->

</div>
</div>
<!--Datos Precios -->


    <!--Botones = Ir carrito , Comprar-Productos-->
    <div class=" row">
         <div class="resumen-pedido-botones">
              <a id="link_btn_resumen_pedido" href="<?= BASE_URL ;?>carrito/mostrar_carrito/1/">
                 <button id="boton-ir-carrito" type="button" class="btn btn-default btn-block">Ir al Carrito</button>
              </a>

              <a id="link_btn_resumen_pedido" href="<?= BASE_URL ;?>productos/categorias_marcas/">
                  <button id="boton-otros-productos" type="button" class="btn btn-default btn-block">Comprar Otros Productos</button>
              </a>
        </div>
    </div>
    <!--Botones = Ir carrito , Comprar-Productos-->

</div><!--Fin-Contenedor Del Carrito-Resumen-Pedido -->
