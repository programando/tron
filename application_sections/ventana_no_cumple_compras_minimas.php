

<div class="modal fade" id="ventana_mensaje" tabindex="-1"  role="dialog" aria-labelledby="#ventana_mensaje" aria-hidden="true">
	   <div class="modal-dialog ventana-editar-direccion">
	   	   <div class="modal-content "><!-- Contenido de la ventana -->

            <div class="modal-header cabezera-modal-error"><!-- Cabezera-vemtana -->
            	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	   <h4 class="text-center">Mensaje del Sistema</h4>
            </div><!-- Cabezera-vemtana -->

            <div class="modal-body" id="texto-mensaje">
                <p id="texto">

    Esta compra será liquidada a <strong>precios normales</strong>
    por que no realizaste en el mes la compra mínima reglamentaria
    <?=  Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_tron')) ?>
    en productos TRON para el Hogar ó <?=  Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_ta')) ?> en productos Industriales fabricados por Balquimia.
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

