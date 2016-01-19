<div class="carrito-resumen-pedido" id="carrito-resumen"><!--Contenedor Del Carrito-Resumen-Pedido -->
    <div class="row"><!--Titulo-->
        <h5 class="titulo-resumen-pedido text-center"><strong>RESUMEN PEDIDO TRON</strong></h5>
    </div><!--Fin-Titulo-->
    
    <!--Cant , Precio , Borrar Inicio Cabezera Del Resumen-Pedido -->
    <div class="row">
        <div class="fila-cant_precio_borrar p10">
            <div class="resumen-cant">Cant</div>
            <div class="resumen-precio">Precio</div>
            <div class="resumen-borrar">X</div>
        </div>
    </div>
    <!--Cant , Precio , Borrar Inicio Cabezera Del Resumen-Pedido -->
    
    <!--Informacion-Producto Acerca DE CANT , PRECIO , BORRAR -->
    <div class="resumen_tron mb10">
        <div class="row">
            <div class="datos_producto_seleccionado">
                <table class="tabla-cont-datos-porducto-seleccionado"><!--Datos Del Producto -->
                    <tbody id ='resumen_pedido_productos'>
                        <?php include (APPLICATION_SECTIONS . 'productos_tron_resumen_productos.php'); ?>
                    </tbody>
                </table><!--Datos Del Producto -->
            </div>
        </div>
    </div>
    <!--Informacion-Producto Acerca DE CANT , PRECIO , BORRAR -->


    <!--Datos Precios
    Session::Destroy('pv_tron_resumen');
    Session::Destroy('pv_ocas_resumen');
    -->
    <div class=" row">    
        <div class="resumen_datos_precios">        
            <p class="resumen_precio_ocacional">
                <strong id='Total_Venta_Ocasional_Resumen'>
                    <?php
                        // MAYO 18 DE 2015
                        //       VALOR QUE SE MUESTRA EN LA PARTE SUPERIOR DE LA PAGINA.  VALOR DE VENTA PARA COPRADORES OCASIONALES
                        if(Session::Get('pv_ocas_resumen')>0) {
                            echo Numeric_Functions::Formato_Numero( Session::Get('pv_ocas_resumen'));
                        }else{
                            echo '$0';
                        }
                    ?>
                </strong><!--contenedor = Precio-Ocacional 16 -->
                <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>18.png" title="Comprador Ocasional"></span>
            </p>
        
            <p class="resumen_precio_clien-tron">
                <strong id ='Total_Venta_Tron_Resumen'>
                    <?php
                        // MAYO 18 DE 2015
                        //       VALOR QUE SE MUESTRA EN LA PARTE SUPERIOR DE LA PAGINA.  VALOR DE VENTA PARA COPRADORES OCASIONALES
                        if(Session::Get('pv_tron_resumen')>0) {
                            echo Numeric_Functions::Formato_Numero( Session::Get('pv_tron_resumen'));
                        } else {
                            echo '$0';
                        }
                    ?>
                </strong><!--contenedor = Precio-Cliente TRON 30 -->
                <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>17.png" title="Cliente TRON"></span>
                <span><img class="resumen-pedido-img" src="<?= BASE_IMG_PRODUCTOS ;?>16.png" title="Empresario TRON"></span>
            </p>
        
            <p>
                Descuento:
                <strong id ="tron_descuento">
                    <?php
                        $descuento_especial_porcentaje = Session::Get('descuento_especial_porcentaje');
                        $descuento_especial_porcentaje =  number_format((float)$descuento_especial_porcentaje, 2, '.', '') .'%';
                        if ( isset( $descuento_especial_porcentaje  )){
                            echo $descuento_especial_porcentaje  ;
                        }
                    ?>
                </strong>
            </p><!--contenedor = Descuento  -->
            
            <p>
                Ahorro:
                <strong id ='tron_descuento_porciento'>
                    <?php
                        $descuento_especial = "$ ".number_format(Session::Get('descuento_especial'),0,"",".");
                        if ( isset( $descuento_especial  )){
                            echo $descuento_especial;
                        }
                    ?>
                </strong>
            </p><!--contenedor = Ahorro -->
        
        </div>
    </div>
    <!--Datos Precios -->



    <!--Botones = Ir carrito , Comprar-Productos-->
    <div class="row">
        <div class="resumen-pedido-botones">
            <a id="link_btn_resumen_pedido" href="<?= BASE_URL ;?>carrito/mostrar_carrito/1/">
                <button id="" type="button" class="btn btn-danger mb5" style="width:100%;">Ir al Carrito</button>
            </a>
            
            <a id="link_btn_resumen_pedido" href="<?= BASE_URL ;?>productos/categorias_marcas/">
                <button id="boton-otros-productos" type="button" class="btn btn-info" style="width:100%;"><span class="nothere">Comprar </span>Otros Productos</button>
            </a>
        </div>
    </div>
    <!--Botones = Ir carrito , Comprar-Productos-->


</div><!--Fin-Contenedor Del Carrito-Resumen-Pedido -->

