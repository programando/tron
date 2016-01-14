

<div id="contenido-productos">



<div class="ionix" id="contenido-productos">
    <div class="general pAA30">

    	<div name="destacados"></div>

		<?php if (isset($this->Productos_Destacados_Index) and count($this->Productos_Destacados_Index )) :?>

            <div class="titleM1 colorBlue t24 mb30">DESTACADOS</div>

            <!-- INFORMACION DEL PRODUCTO -->
            <?php
                foreach ($this->Productos_Destacados_Index as $Productos) {
                    include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                    $mostrar_imagen_varias_referencias=true;
            ?>

                        <div class="artOpt artPor5">
                            <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                        </div><!-- FINAL COLUMNAS -->

            <?php } ?>

			<br style="clear:both;" />

        <?php endif?>
    </div>
</div>



<div class="ionix" id="contenido-productos">
    <div class="general pAA30">

    	<div name="destacados"></div>

		<?php if (isset($this->Productos_Ofertas_Index) and count($this->Productos_Ofertas_Index)>0) :?>

            <div class="titleM1 colorBlue t24 mb30">OFERTAS</div>

            <!-- INFORMACION DEL PRODUCTO -->
            <?php
                foreach ($this->Productos_Ofertas_Index as $Productos){
                    include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                    $mostrar_imagen_varias_referencias=true;
            ?>

                        <div class="artOpt artPor5">
                            <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                        </div><!-- FINAL COLUMNAS -->

            <?php } ?>

			<br style="clear:both;" />

        <?php endif?>
    </div>
</div>


<div class="ionix" id="contenido-productos">
    <div class="general pAA30">

    	<div name="destacados"></div>

		<?php if (isset($this->Productos_Novedades_Index) and count($this->Productos_Novedades_Index)>0) : ?>

            <div class="titleM1 colorBlue t24 mb30">NOVEDADES</div>

            <!-- INFORMACION DEL PRODUCTO -->
            <?php
                foreach ($this->Productos_Novedades_Index as $Productos){
                    include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                    $mostrar_imagen_varias_referencias=true;
            ?>

                        <div class="artOpt artPor5">
                            <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                        </div><!-- FINAL COLUMNAS -->

            <?php } ?>

			<br style="clear:both;" />

        <?php endif?>
    </div>
</div>


</div>

