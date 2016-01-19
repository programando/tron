<?php if(isset($this->Productos_Tron_Ropa )): ?>
    <div class="row">
		<?php
        	foreach( $this->Productos_Tron_Ropa as $Productos ){
        		include (APPLICATION_CODS . 'campos_productos.php');
				include (APPLICATION_SECTIONS . 'fragancias.php');
			}
		?>
    </div>
<?php endif; ?>
