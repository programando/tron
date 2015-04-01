
<?php if ((Session::Get('iddireccion_despacho') == 0 ||
          Session::Get('iddireccion_despacho') == NULL) and
          Session::Get('imagen_resumen_pedido')== FALSE ) : ;?>
        <div class="col-lg-12 col-md-12 col-sm-12"><!--Botones -->
          <div class="cont-boton"><!--Contenedor de los botones -->
            <button type="button" class="btn-seguir-comprando">Seguir Comprando</button>
            <button type="button" class="btn-finalizar-pedido">Finalizar Pedido</button>
          </div><!--Contenedor de los botones -->
        </div><!--Botones -->
<?php else :  ;?>
<div class="col-lg-12 col-md-12 col-sm-12"><!--Botones -->
          <div class="cont-boton"><!--Contenedor de los botones -->
            <button type="button" class="btn-seguir-comprando">Seguir Comprando</button>
            <button type="button" class="btn-forma-pago-pedido">Elegir Forma de Pago para el Pedido ... </button>
          </div><!--Contenedor de los botones -->
        </div><!--Botones -->
<?php endif ; ?>
