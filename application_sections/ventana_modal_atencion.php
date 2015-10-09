<!-- ventana modal :: ! atencion ¡ las compras deben ser mayor a 20.000 pesos -->
<div class="modal  fade" id="ver_modal" tabindex="-1" role="dialog" aria-labelledby="ver_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4>Apreciado usuario..!</h4>
       </div>
       <!-- body -->
       <div class="modal-body">
       	   <div class="container-fluid">
       	   	   <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                  	   <p>El valor minimo a pagar por un pedido es de <strong>$20.000</strong><br><br>
                  	      El valor total de tu pedido es de
                  	      <span id="valor_tu_pedido"><strong>$17.000</strong></span>
                  	      con el cual no podas realizar el pago, pero tienes estas opciones: <br>
                         <!-- opciones -->
                         <div>
                           <!-- seguri comprando -->
                           <div class="radio">
																											  <label>
																											    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">Seguir comprando.
																											  </label>
                           </div>
                           <!-- no usar mis puntos y comisiones -->
                           <div class="radio">
																											  <label>
																											    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No usar mis puntos y comisiones para pagar este pedido. <br>
																											    <span><small>Nota: Quedan acomulados para un proximo pedido</small></span>
																											  </label>
																											</div>
                         </div>
                  	   </p>
                  </div>
       	   	   </div>
       	   </div>
       </div>
   	  </div>
   </div>
</div>
