
<?php
   $valor_minimo_pedido_productos =  Session::Get('valor_minimo_pedido_productos')  ;
?>
<!-- ventana modal :: ! atencion ¡ las compras deben ser mayor a 20.000 pesos -->
<div class="modal  fade" id="modal_explica_columnas_pedido"   tabindex="-1" role="dialog" aria-labelledby="ver_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4>Apreciado usuario...!</h4>
       </div>

       <!-- body -->
       <div class="modal-body">
       	   <div class="container-fluid">
       	   	   <div class="row">
                  <div class=" text-justify col-lg-12 col-md-12 col-sm-12">
                        En este momento tu carrito cuenta con 2 columnas que tienen diferentes precios.
Estas 2 columnas son para mostrarte los precios especiales que obtienen nuestros consumidores de productos TRON de las líneas Hogar o Industrial. Esta columna la identificarás con color azul.<br><br>
Los usuarios que obtienen estos precios especiales son aquellos cuyas compras sumen <strong><?= $valor_minimo_pedido_productos ;?> </strong>o más en alguna de estas líneas.<br><br>

<p class="text-center"> ¿ Te animas a echarles un vistazo ? </p>
 <br>Sólo debes consumir <strong><?= $valor_minimo_pedido_productos ;?> </strong> en alguna de estas 2 líneas y obtendrás los mejores precios.

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
