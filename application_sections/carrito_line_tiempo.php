<!--
     Line De tiempo / Ubicada en la parte superior de la tabla del carro de compras
     Los CSS => tron_car-linea-tiempo.css

-->

    <div class ="line-estado"><!-- Contenedor -->
      <ol class  ="cont-lista">

        <li class  ="list-line">
            <a class="link" id='link1' href="<?=BASE_URL ;?>carrito/mostrar_carrito/1">
                    Mi Carrito
            </a>
        </li>

        <?php if ( Session::Get('autenticado')== FALSE) : ; ?>
          <li class  ="list-line" >
                <a class="link"  id='link2'   href="<?=BASE_URL ;?>carrito/finalizar_pedido_identificacion/">
                        Identificación
                </a>
          </li>
        <?php endif ;?>

        <li class  ="list-line" >
            <a class="link" id='link3'   href="<?=BASE_URL ;?>carrito/Finalizar_Pedido_Identificacion/">
                    Dirección Envío
            </a>
        </li>
        <li class  ="list-line " >
            <a class="link"  id='link4' href="<?=BASE_URL ;?>carrito/mostrar_carrito/1">
                    Resumen Pedido
            </a>
        </li>

        <li class  ="list-line " >
            <a class="link" id='link5' href="<?=BASE_URL ;?>carrito/Finalizar_Pedido_Forma_Pago/">
                    Forma de Pago
            </a>
        </li>


         <li class  ="list-line " >
            <a class="link"  href="#"  id='link6' >
                    Información del Pago
            </a>
        </li>

      </ol>
    </div><!-- Contenedor -->
 <br>
 <br>
