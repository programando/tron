

<div id="contenido-productos">


<?php if ( Session::Get('Cantidad_Destacados') >= 5) :?>
    <div class="ionix" id="contenido-productos">
        <div class="general pAA30">

        	<div name="destacados"></div>

    		<?php if (isset($this->Productos_Destacados_Index) and count($this->Productos_Destacados_Index )) :?>

                <div class="titleM1 colorBlue t24 mb30">DESTACADOS</div>

                <!-- INFORMACION DEL PRODUCTO -->
                <?php
                    $mostrar_imagen_varias_referencias=true;
                    $mostrar_un_solo_precio         = false;
                    foreach ($this->Productos_Destacados_Index as $Productos) {
                        include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de

                ?>

                            <div class="artOpt artPor5">
                                <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                            </div><!-- FINAL COLUMNAS -->

                <?php } ?>

    			<br style="clear:both;" />

            <?php endif?>
        </div>
    </div>
<?php endif;?>


<?php if ( Session::Get('Cantidad_Ofertas') >= 5) :?>
    <div class="ionix" id="contenido-productos">
        <div class="general pAA30">

        	<div name="destacados"></div>

    		<?php if (isset($this->Productos_Ofertas_Index) and count($this->Productos_Ofertas_Index)>0) :?>

                <div class="titleM1 colorBlue t24 mb30">OFERTAS</div>

                <!-- INFORMACION DEL PRODUCTO -->
                <?php
                    $mostrar_imagen_varias_referencias=true;
                    $mostrar_un_solo_precio         = false;
                    foreach ($this->Productos_Ofertas_Index as $Productos){
                        include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de

                ?>

                            <div class="artOpt artPor5">
                                <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                            </div><!-- FINAL COLUMNAS -->

                <?php } ?>

    			<br style="clear:both;" />

            <?php endif?>
        </div>
    </div>
<?php endif ;?>


<?php if ( Session::Get('Cantidad_Novedades') >= 5) :?>
<div class="ionix" id="contenido-productos">
    <div class="general pAA30">

    	<div name="destacados"></div>

		<?php if (isset($this->Productos_Novedades_Index) and count($this->Productos_Novedades_Index)>0) : ?>

            <div class="titleM1 colorBlue t24 mb30">NOVEDADES</div>

            <!-- INFORMACION DEL PRODUCTO -->
            <?php
                $mostrar_imagen_varias_referencias=true;
                $mostrar_un_solo_precio         = false;
                foreach ($this->Productos_Novedades_Index as $Productos){
                    include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de

            ?>

                        <div class="artOpt artPor5">
                            <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                        </div><!-- FINAL COLUMNAS -->

            <?php } ?>

			<br style="clear:both;" />

        <?php endif?>
    </div>
</div>
<?php endif ;?>


</div>

