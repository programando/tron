<!-- ventana modal :: ! atencion ¡ las compras deben ser mayor a 20.000 pesos -->
<div class="modal  fade" id="modal_no_cumple_pedido_minimo_productos_tron"   tabindex="-1" role="dialog" aria-labelledby="ver_modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                  <div class="col-lg-12 col-md-12 col-sm-12">
                  	   <p class="text-justify">

                          La compra mínima de productos <strong>TRON</strong> es de : <strong><?=   "$ ".number_format(Session::Get('minimo_compras_productos_tron'),0,"",".") ;?></strong>
                          Hasta el momento has incluido un total de : <strong><?=   "$ ".number_format(Session::Get('compra_productos_tron'),0,"",".") ;?></strong>.
                          Agrega más productos <strong>TRON</strong> para facturar el pedido.
                          <br><br>
                  	   </p>
                  </div>
       	   	   </div>
       	   </div>
           <div class="modal-footer">
                <button  href="#" data-dismiss="modal" type="button" class="btn btn-success btn_confirm_pagina_guardada"><i class='fa fa-times'></i> Continuar</button>
            </div>

       </div>
   	  </div>
   </div>
</div>



