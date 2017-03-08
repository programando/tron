 <div   class           ="modal  fade"
        id              ="modal_ventajas_cliente"
        tabindex        ="-1"
        role            ="dialog"
        aria-labelledby ="ver_modalLabel"
        aria-hidden     ="true"
        data-backdrop   ="static"
        data-keyboard   ="false" >
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class=" well modal-header text-center">
       <!-- Boton de cierre en el lado derecho      -->
        <!--  <button type="button"  class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> </button> -->

          <img style="height: 70px;" src="<?= BASE_IMG_EMPRESA ; ?>amigoI.png" />
        <h5><strong>¡ BIENVENIDO (A) ! </strong></h5>
       </div>

       <!-- body -->
       <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 text-justify">
                  <h5>
                  <ul>
                    <li>tendrás acceso a las promociones y ofertas de nuestro sitio</li>
                    <li>Podrás hacer compras con precios especiales en todos los productos de nuestra tienda ( precios en color rojo) </li>

                  </ul>
                  </h5>
                  <br>
                 <h5><strong>Nota:</strong><br>Para hacer efectivo el cambio de status debes realizar la compra del
                 <strong><br>KIT DE INICIO PARA CLIENTES</strong>,
                 el cual tiene un costo de
                 <?= Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_tron')) ;?>
                 + transporte .</h5>
              </div>
            </div>
          </div>
       </div>

       <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"
            id ="btn-agregar-kit-ocasional">Cambiar mi status a
            <strong>CLIENTE TRON</strong></button>

        </div>

   	  </div>
   </div>
</div>
