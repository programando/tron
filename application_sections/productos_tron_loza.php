<?php
	$pv_comprador_ocasional      	= $this->Productos_Tron_Loza[0]['pv_ocasional'];
	$pv_tron                     	= $this->Productos_Tron_Loza[0]['pv_ocasional'];
	$text_pv_comprador_ocasional 	= Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
	$valor 							= Session::Get('vr_unitario_loza')  ;
	
	if ( isset( $valor) && $valor > 0  ){
		$text_pv_tron               = Numeric_Functions::Formato_Numero($valor );
	} else{
		$text_pv_tron               = Numeric_Functions::Formato_Numero($pv_tron );
	}
?>


<div class="presentacion_del_producto mb10">
    <div id="cont-img-producto-loza" class="mb10 taC">
        <img src="<?= BASE_IMG_PRODUCTOS_TRON ;?>loza_producto.jpg" />
    </div>    
    <p class="taC nombre_del_producto">
        Concentrado LAVALOZA de alto rendimiento
    </p>
</div>


<p class="text-center aviso_de_los_cojines">
	<small>Con cada cojín puede preparar 500 mL del producto listo para usar.</small>
</p><!--Aviso Acerca De Los Cojines-->

<div class="precio_del_producto">
    <p class="text-center precio_publico-ocacional"> <strong> <?= $text_pv_comprador_ocasional ;?> </strong><!--contenedor = Precio-Ocacional-->
        <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>18.png" title="Comprador Ocasional"></span>
    </p>
    <p class="text-center  precio_del_cliente_tron">
        <strong id='vr_unitario_loza'>
            <?= $text_pv_tron ;?>
        </strong>
    
        <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>17.png" title="Cliente TRON"></span>
        <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>16.png" title="Empresario TRON"></span>
    </p>
</div>

<!--Precio_varia_segun_la_cantidad -->
<p class="taC Precio_varia_segun_la_cantidad">
	<small>Precio varía según la cantidad</small>
</p>



