

<?php if ((Session::Get('iddireccion_despacho') == 0 ||
          Session::Get('iddireccion_despacho') == NULL)     ) : ;?>
        <div class="col-lg-12 col-md-12 col-sm-12"><!--Botones -->
          <div class="cont-boton"><!--Contenedor de los botones -->
            <button type="button" class="btn-seguir-comprando btn btn-danger">Seguir Comprando</button>
            <button type="button" class="btn-finalizar-pedido btn btn-danger">Continuar</button>
          </div><!--Contenedor de los botones -->
        </div><!--Botones -->
<?php else :  ;?>
<div class="col-lg-12 col-md-12 col-sm-12"><!--Botones -->
          <div class="cont-boton"><!--Contenedor de los botones -->
            <button type="button" class="btn-seguir-comprando btn btn-danger">Seguir Comprando</button>
            <button type="button" class="btn-forma-pago-pedido btn btn-danger">Continuar</button>
          </div><!--Contenedor de los botones -->
        </div><!--Botones -->
<?php endif ; ?>

