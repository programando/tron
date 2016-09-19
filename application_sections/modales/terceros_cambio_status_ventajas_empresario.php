 <div   class           ="modal  fade"
        id              ="modal_ventajas_empresarios"
        tabindex        ="-1"
        role            ="dialog"
        aria-labelledby ="ver_modalLabel"
        aria-hidden     ="true"
        data-backdrop   ="static"
        data-keyboard   ="false" >
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class="modal-header text-center">
       <!-- Boton de cierre en el lado derecho      -->
        <!--  <button type="button"  class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> </button> -->

          <img style="height: 70px;" src="<?= BASE_IMG_EMPRESA ; ?>empresarioI.png" />
        <h5><strong>BENEFICIOS PARA EMPRESARIOS TRON</strong></h5>
       </div>

       <!-- body -->
       <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 text-justify">
                  <h5>
                  <ul>
                    <li>Ganarás comisiones por las compras que realicen tus clientes y los empresarios de tu red ( hasta el 6 nivel )</li>
                    <li>Te asignaremos un código de usuario con el cual podrás agregar amigos a tu red</li>
                    <li>Tendrás acceso a las promociones y ofertas de nuestro sitio</li>
                    <li>Podrás hacer compras con precios especiales en todos los productos de nuestra tienda ( precios en color rojo) </li>
                  </ul>
                  </h5>
                  <br>
                 <h5 class="text-justify"><strong>Nota:</strong><br>Para hacer efectivo el cambio de status debes realizar la compra del
                 <strong><br>KIT INICIO PARA EMPRESARIOS</strong>,
                 el cual tiene un costo de
                 <?= Numeric_Functions::Formato_Numero(Session::Get('valor_kit_inicio_empresario')) ;?> + transporte .</h5>
              </div>
            </div>
          </div>
       </div>

       <div class="modal-footer">
       <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true"
            id ="btn-agregar-kit-empresario">Cambiar mi status a
            <strong>EMPRESARIO TRON</strong></button>
        </div>

   	  </div>
   </div>
</div>
