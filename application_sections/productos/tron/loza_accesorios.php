
<?php if(isset($this->Accesorios_Tron_Loza)) :?>

    <div>
    	<p class="titulo_de_accesorios"><strong>ACCESORIOS</strong></p>
    </div>
    
    <div class="row">        
        <?php
        	foreach($this->Accesorios_Tron_Loza as $Productos ) {
        		include (APPLICATION_CODS . 'campos_productos.php');
				include (APPLICATION_SECTIONS . 'accesorios.php');
        	}
        ?>
    </div>
    
<?php endif;?>
