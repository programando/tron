<?php
  $cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');
?>

<thead class="cabezera-tabla"><!--Cabezera de la tabla -->
  <tr>
   <th class="text-center  titulos-tabla"></th><!--IMG-eliminar producto -->
   <th class="text-center  titulos-tabla"></th><!--IMG producto seleccionado -->
   <th class="text-center  titulos-tabla"><strong>Producto</strong> </th><!--Nombre del producto -->
   <th class="text-center  titulos-tabla"><strong>Presentación</strong></th>
   <th class="text-center  titulos-tabla"><strong>Cantidad</strong> </th><!--Cantidad -->

  <?php if ($cumple_condicion_cpras_tron_industial == FALSE ) :?>
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
