

<?php
	$cumple_condicion_cpras_tron_industial =  Session::Get('cumple_condicion_cpras_tron_industial');
	$logueado                              =  $_SESSION['logueado'];
    $idtipo_plan_compras                   =  $_SESSION['idtipo_plan_compras'];
    $nombre_usuario                        =  strtoupper(trim(Session::Get('nombre_usuario')));
    $codigousuario                         =  Session::Get('codigousuario');
    $solicita_cambio_plan                  = Session::Get('solicita_cambio_plan');

?>

<?php if ( $logueado == TRUE && $idtipo_plan_compras == 3 ) :?>
	<div class=" taR mb20">
		<small>Pedido a nombre del Usuario : <strong> <?= strtoupper( $codigousuario) ;?></strong></small>
	</div>
    <?php else :?>

        <?php if ( strlen($nombre_usuario) > 0 ) :?>
	       <small>Pedido a nombre de : <strong> <?=  $nombre_usuario  ;?></strong></small>
        <?php endif ;?>

         <?php if ( $solicita_cambio_plan == TRUE  ) :?>
               <br>     
               <!--          <small>  Solicitaste un cambio de plan y hasta ahora has agregado $40.000 en productos 
                    TRON... te faltan $80.000 para que el cambio sea efectivo.
          </small>  -->
        <?php endif ;?>


<?php endif ;?>

<thead class="cabezera-tabla"><!--Cabezera de la tabla -->
        <tr>
            <th colspan="5" class="text-center "></th><!--IMG-eliminar producto -->
            <?php if ( $cumple_condicion_cpras_tron_industial == FALSE ) :?>
                <th colspan="2" class="text-center "><a href="#" class="explica-precio-especial">Este podría ser tu precio si...</a></th> <!-- Precio Unitario 1      -->
            <?php else :?>
                <th colspan="2" class="text-center "></th> <!-- Precio Unitario 1      -->
            <?php endif ;?>
            <th colspan="2" class="text-center titulo-tron"> TU PRECIO ACTUAL</th>  <!-- Precio Unitario 2      -->
        </tr>

    <tr>
        <th class="text-center  titulos-tabla"></th><!--IMG-eliminar producto -->
        <th class="text-center  titulos-tabla"></th><!--IMG producto seleccionado -->
        <th class="text-center  titulos-tabla"><strong>Producto</strong> </th><!--Nombre del producto -->
        <th class="text-center  titulos-tabla"><strong>Presentación</strong></th>
        <th class="text-center  titulos-tabla"><strong>Cantidad</strong> </th><!--Cantidad -->

        <?php if ( $cumple_condicion_cpras_tron_industial == FALSE ) :?>
            <th class="text-right   titulos-tabla"><strong>Precio Unit.</strong> </th><!--Precio UNIT. -->
            <th class="text-right   titulos-tabla"><strong>Total</strong> </th><!--Total -->
            <th class="text-right  titulo-tron" title="Precio unitario para clientes/empresarios TRON"><strong>Precio Unit.</strong> </th><!--Total -->
            <th class="text-right  titulo-tron" title="Valores calculados para cliente/empresarios TRON"><strong>Total</strong> </th><!--Total -->
        <?php else :?>
            <th class="text-center  titulos-tabla"></th>
            <th class="text-center  titulos-tabla"></th>
            <th class="text-right  titulo-tron" title="Precio unitario para clientes/empresarios TRON"><strong>Precio Unit.</strong> </th><!--Total -->
            <th class="text-right  titulo-tron" title="Valores calculados para cliente/empresarios TRON"><strong>Total</strong> </th><!--Total -->
        <?php endif ;?>
    </tr>

</thead><!--Cabezera de la tabla -->
