<?php
     $pv_comprador_ocasional      = $this->Productos_Tron_Ropa[0]['pv_ocasional'];
     $pv_tron                     = $this->Productos_Tron_Ropa[0]['pv_ocasional'];
     $text_pv_comprador_ocasional = Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
     $valor = Session::Get('vr_unitario_ropa')  ;
     if ( isset( $valor ) && $valor > 0 ){
          $text_pv_tron                = Numeric_Functions::Formato_Numero($valor );
      } else{
          $text_pv_tron                = Numeric_Functions::Formato_Numero($pv_tron );
      }
?>
<div class="col-lg-3 col-md-3  col-sm-3 columna-presentacion-producto">
        <!-- Me Presenta una Imagen del Producto -->
        <div class="presentacion_del_producto"><!--No se Olvide De Insertar IMG-Ampliada Del Producto -- >

          <!--Contenido-Presentacion-Producto -->

          <div class="porductos-tron-img_producto" id="cont-img-producto-ropa1">
           <img src="<?= BASE_IMG_PRODUCTOS_TRON ;?>ropa_producto.jpg"
           class="img-responsive  Imagen_Del_Producto"><br><!--Imagen Del Producto -->
         </div>

         <p class="text-center nombre_del_producto"> Concentrado Detergente Para Lavar ROPA </p><br><!--Nombre-Producto-->
       </div>

       <!-- Fin-Me presenta una imagen del producto -->

       <p class="text-center aviso_de_los_cojines"> <small> Con cada cojín puede preparar 500 mL del producto listo para usar.</small> </p><!--Aviso Acerca De Los Cojines-->

       <div class="precio_del_producto"><!--Prescios Del Producto-->

        <p class="text-center precio_publico-ocacional"> <strong> <?= $text_pv_comprador_ocasional ;?> </strong><!--contenedor = Precio-Ocacional-->
         <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>18.png" title="Comprador Ocasional"></span>
       </p>

       <p class="text-center  precio_del_cliente_tron">
            <strong id='vr_unitario_ropa'>
            <?= $text_pv_tron ;?>
            </strong><!--contenedor = Precio-Cliente TRON-->

        <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>17.png" title="Cliente TRON"></span>
        <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>16.png" title="Empresario TRON"></span>
      </p>
    </div>
      <!--Precio_varia_segun_la_cantidad -->
  <div class=" row">
    <div class=" col-lg-12 col-md-12 col-sm-12">
     <p class="text-left Precio_varia_segun_la_cantidad"> <small> Precio varía según la cantidad </small> </p>
   </div>
 </div>
  </div><!--Fin-Contenido-Presentacion-Producto -->


