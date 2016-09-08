<?php
   $valor_minimo_pedido_productos    = Numeric_Functions::Formato_Numero( Session::Get('minimo_compras_productos_tron'))  ;
   $valor_min_productos_industriales = Numeric_Functions::Formato_Numero( Session::Get('minimo_compras_productos_ta') );
?>
<!-- ventana modal :: ! atencion ¡ las compras deben ser mayor a 20.000 pesos -->
<div class="modal  fade" id="carrito-explica-precio-especial"   tabindex="-1" role="dialog" aria-labelledby="ver_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4>Este podría ser tu precio si...</h4>
       </div>

       <!-- body -->
       <div class="modal-body">
       	   <div class="container-fluid">
       	   	   <div class="row">
                  <div class=" text-justify col-lg-12 col-md-12 col-sm-12">
                    Incluyes en este pedido: <br><br>
                    <strong><?= $valor_minimo_pedido_productos ;?> </strong> en productos <strong>TRON</strong> ó <br> <br>
                    <strong><?= $valor_min_productos_industriales  ;?> </strong> en productos <strong>INDUSTRIALES</strong> fabricados por BALQUIMIA S.A.S.
                  	   </p>
                  </div>
       	   	   </div>
       	   </div>
       </div>
                      <div class="modal-footer">
                     <button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
   	  </div>
   </div>
</div>
