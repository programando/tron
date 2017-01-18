
<div class="ionix">
    <div class="general">
		<div class="contenido-index mb30 pAA30">

            <!-- INICIA PRESENTACIÓN DE PRODUCTOS -->
            <div id="contenido-productos">
				<?php
                    $mostrar_imagen_varias_referencias=true;
                    $mostrar_un_solo_precio         = TRUE;
                    foreach ($this->Productos_Carros_Motos as $Productos){
                
                
                        include (APPLICATION_CODS . 'campos_productos.php');
                ?>
                     <?php if ( $en_oferta == 1 ) : ?> <div class="artOpt artPor4 oferta">
                        <?php else :?>                 <div class="artOpt artPor4">
                     <?php endif ;?>
                
                     <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
                
                      </div>
                
                <?php } ?>
                <br style="clear:both;" /><br /><br />
            
            </div>


        </div>
    </div>


</div>

