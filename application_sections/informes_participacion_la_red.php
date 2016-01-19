<table class="table table-bordered table-hover" style="font-size: 12px;">

    <thead><!-- cabezera -->
            <tr>
                   <th class="text-center">#</th>
                   <th class="text-center">Código Usuario</th>
                   <th class="text-center">Nombre</th>
                   <th class="text-center">Presentado por</th>
                   <th class="text-center">Fecha Reg.</th>
                   <th class="text-center">Cant. Frontales</th>
                   <th class="text-center">Códigos por Persona</th>
            </tr>
    </thead><!-- cabezera -->
    
    <tbody>
    <?php $I= 1 ;?>
    <?php foreach ($this->Terceros as $Tercero)  :?>
		<?php
			$codigousuario                 = $Tercero['codigousuario'];
			$nombre                        = substr($Tercero['nombre'],0,25);
			$codigoterceropresenta_inicial = $Tercero['codigoterceropresenta_inicial'];
			$fecha_registro                = $Tercero['fecha_registro_formato'];
			$amigos_nivel_1                = $Tercero['amigos_nivel_1'];
			$cantidad_codigos              = $Tercero['cantidad_codigos'];
        ?>
                <tr>
                    <td class="text-center"><?= $I;?> </td>
                    <td class="text-left"><?= $codigousuario;?> </td>
                    <td class="text-left"><?= $nombre;?> </td>
                    <td class="text-left"><?= $codigoterceropresenta_inicial;?> </td>
                    <td class="text-right"><?= $fecha_registro;?> </td>
                    <td class="text-right"><?= $amigos_nivel_1;?> </td>
                    <td class="text-right"><?= $cantidad_codigos;?> </td>
                </tr>
        <?php $I++ ;?>
    <?php endforeach ;?>
    </tbody>

</table>

<?php if ( $this->Cantidad_Registros == 0 ) :?>
	<h3 class="text-center"> No existen registros para el usuario seleccionado. </h3>
<?php endif ;?>
