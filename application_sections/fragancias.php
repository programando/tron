<div class="col-sm-3 col-xs-6">
    <div class="contenido_por_fragancia taC">
    
        <img src="<?= BASE_IMG_PRODUCTOS_150x150 . $nombre_imagen ;?>" class="mb10">
        
        <div class="costos-cantidad"> 
                           
            <form class="form-horizontal" role="form">
            
            <div class=" col-xs-4" id="cont-menos">
            <div class="form-group"><!--Inicio  Boton Menos-->
            <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carritoTronMenos"
            onclick="javascript: Carrito_RestarTRON('<?=$id_controles ;?>')"  >-
            </button><!-- Fin Boton Menos-->
            </div>
            </div>
            
            <div class="col-xs-4" id="cont-digitos">
            <div class="form-group"><!--Inicio Input-->
            <input type        = "text"  value="<?= $Cantidad_Comprada ;?> "
            id                = "<?=$id_controles ;?>"
            class             = "digitos btn-carrito-input CantProdCompraTronFragancias"
            precio-amigo-tron = "<?= $id_pv_tron ;?>"
            idproducto        =  "<?= $idproducto ;?>"
            es-tron           =  "true"
            es-tron-acc       =  "false"
            >
            </div><!--Fin Input-->
            </div>
            
            <div class=" col-xs-4" id="cont-mas">
            <div class="form-group"><!-- Inicio Boton Mas-->
            <button id="<?=$idproducto ;?>" type="button" class="btn btn-default btn-menos btns-carritoTronMas"
            onclick="javascript: Carrito_Sumar('<?=$id_controles ;?>')"  >+
            </button><!-- Fin Boton Mas-->
            </div>
            </div>
            
            
            
            </form>
        
        </div>
    </div>           

</div>
            
            
            