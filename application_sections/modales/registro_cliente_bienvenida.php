 <div   class           ="modal  fade"
 id              ="modal-registro-cliente"
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
     <div class="row">
       <div class="col-md-12 text-center">
         <h4><strong>¡ BIENVENIDO (A) ! </strong></h4>
       </div>

     </div>
   </div>

   <!-- body -->
   <div class="modal-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-justify">
          <h5>

            <p>

              Tu registro como <strong>CLIENTE</strong> ha sido exitoso! Como has podido observar nuestros productos tienen 2 precios: el de color negro corresponde a los precios normales del mercado, el precio en rojo y las ofertas son para quienes en ese mes compren productos <strong>TRON</strong>. <br> <br>

            </p>
            <img   src="<?= BASE_IMG_EMPRESA ; ?>registro-cliente.jpg" />
          </h5>
          <br>
           <br>
          <p>
            Con sólo agregar a tu compra <strong> <?= Numeric_Functions::Formato_Numero(Session::Get('minimo_compras_productos_tron')) ;?> </strong>de productos <strong>TRON</strong> tendrás acceso a las ofertas y precios especiales… los encontrará en las siguientes secciónes...
          </p>
           <br>
          <img   src="<?= BASE_IMG_EMPRESA ; ?>registro-cliente-prod-tron.jpg" />


        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <a type="button" class="btn btn-success" href="<?=BASE_URL ;?>">Ir a la tienda</a>
  </div>

</div>
</div>
</div>
