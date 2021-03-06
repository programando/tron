
<?php $usuario_viene_del_registro = Session::Get('usuario_viene_del_registro'); ?>
    <?php if ( isset($usuario_viene_del_registro ) && $usuario_viene_del_registro == FALSE) :?>
    <div class="modal fade" id="ventana_mensaje" data-backdrop="static" data-keyboard="false"tabindex="-1"
         role="dialog" aria-labelledby="#ventana_mensaje" aria-hidden="true">
    	   <div class="modal-dialog ventana-editar-direccion">
    	   	   <div class="modal-content "><!-- Contenido de la ventana -->

                <div class="modal-header cabezera-modal-error"><!-- Cabezera-vemtana -->
                	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                	   <h4 class="text-center">Mensaje del Sistema</h4>
                </div><!-- Cabezera-vemtana -->

                <div class="modal-body" id="texto-mensaje">
                    <p id="texto">

                Esta compra será liquidada a <strong>precios normales</strong>
                porque no has realizado compra mínima reglamentaria en este mes
                <?=  Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_tron')) ?>
                en productos TRON para el Hogar ó <?=  Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_ta')) ?> en productos Industriales..
                <br><br>
                Si agregas en este pedido tu compra reglamentaria, obtendrás <strong>los precios especiales TRON</strong>.
                    </p>
                	<p>
                </div>
                <br>
               <div class="modal-footer">
                	   <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </div>
         </div>
      </div>
<?php endif ;?>


