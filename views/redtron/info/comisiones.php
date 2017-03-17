<?php
    $Pedido_Minimo_Tron   = Session::Get('valor_minimo_pedido_productos');
    $Pedido_Minimo_Indus  = Session::Get('pedido_minimo_productos_fabricados_ta');
?>

<div class="row pAA30">
    <div class="col-sm-3 col-xs-12 mb20_onlySmart">
        <nav class="indice">
            <h5 class="t18">ÍNDICE</h5>
            <ul class="list-unstyled">
                <li><a href="#introduccion">Introducción</a></li>
                <li><a href="#info_general">Información general</a></li>
                <li><a href="#porcentajes">Porcentajes de Comisiones</a></li>
                <li><a href="#puntos">Puntos</a></li>
                <li><a href="#medios">Medios de Cobro</a></li>
            </ul>
        </nav>
    </div>

    <div class="col-sm-9 col-xs-12"><!--Informacion-Contendo-Introduccion -->
        <div class="titleM1 dIB colorBlue mb10 t18">Introducción</div>

        <div class="p20">
            Las comisiones son el pilar del plan de compensación para los usuarios registrados en el Plan Empresario TRON.
        </div>
    </div><!--Informacion-Contendo-Introduccion -->
</div>
<br /><br />

<div>
	<div class="titleM1 colorBlue mb10 t18">Información General</div>
    <div class="p20 taJ">
    	Para recibir comisiones el Empresario TRON debe encontrarse activo en la red y que al último día del mes a liquidar cumplan
        con alguna de las siguientes condiciones:
        <br><br>

        <ul class="list-unstyled ulGen">
           <li>1. Que tengan amigos en su red vinculados al Plan Empresario TRON y estos hayan hecho compras.</li>
           <li>2. Que tengan amigos vinculados por ellos en el Plan Cliente TRON y estos hayan hecho compras.</li>
           <li>3. Que amigos vinculados por ellos al Plan Empresario TRON, tengan amigos vinculados por ellos en el Plan Cliente TRON éstos hayan hecho compras.</li>

        </ul>
        <br>

        Las Comisiones se liquidan los primeros 3 días hábiles de cada mes.
        <br><br>
		Las comisiones se pierden cuando un Empresario TRON se inactiva un mes, es decir, no realiza su compra mínima mensual reglamentaria.
        ( <?= $Pedido_Minimo_Tron ;?> en productos TRON para el hogar ó <?= $Pedido_Minimo_Indus ;?> en productos industriales fabricados
        por Balquimia S.A.S.).
        <br><br>
        Al registrarse en el Plan Empresario TRON, se crearán dos (2) cuentas virtuales a nombre del usuario. La cuenta Dinero
        y la cuenta Puntos. El 70% del valor total de comisiones serán consignadas en la cuenta Dinero y el 30% restante serán
        consignados en la cuenta Puntos y estos sólo se utilizaran para compras en la Tienda Virtual. Cada punto tendrá
        el valor <a name="porcentajes"></a>de $1 M/cte. (un peso moneda colombiana corriente).
        <br><br>
        Las liquidaciones se basan en todas las compras de productos hechas en el mes por las personas que conforman tu red
        (“Mis amigos” y “los Amigos de mis Amigos”) registrados en el Plan Empresarios TRON hasta el nivel sexto (6º.) en
        tu Red y todas las compras de productos hechas en el mes por las personas registradas con tu Código de Usuario
        en el Plan Cliente TRON.
        <br><br>
        Hay algunas cuantías sobre las que no se pagan comisiones, estas son: el IVA, el valor del transporte, la compra de accesorios o
        de productos promocionales los cuales se encuentran identificados con el ícono <img src="<?= BASE_IMG_PRODUCTOS ;?>star2.png" width="32" />
        <a name="puntos"></a>

	</div>
</div>
<br><br>

<div>
	<div class="titleM1 colorBlue mb10 t18">Porcentajes de Comisiones</div>
    <div class="p20 taJ">
        <table class="table table-condensed table-hover contenido-tablas">
            <thead><!--Emcabezado -->
                <tr>
                    <th>Tipo Plan</th>
                    <th  class="text-center">Productos Comprados</th>
                    <th  class="text-center">Comisiones</th>
                </tr>
            </thead><!--Emcabezado -->

            <tbody><!--Cuerpo-->
                <tr>
                    <td>Empresario TRON:</td>
                    <td class="text-left">Productos TRON (cojines)</td>
                    <td class="text-left">Entre el 5% y 6% según su rango</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-left">Otros productos</td>
                    <td class="text-left">Variable<small>( ver tabla en menú Mi Cuenta )</small></td>
                </tr>
                <tr>
                    <td>Cliente TRON</td>
                    <td class="text-left">Productos TRON (cojines)</td>
                    <td class="text-left">entre el 25% y el 30% según su rango</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-left">Otros productos</td>
                    <td class="text-left">Variable x 5  <small>(ver tabla en menú Mi Cuenta)</small></td>
                </tr>

                <tr>
                    <td>Comprador Ocasional</td>
                    <td class="text-left">Otros Productos</td>
                    <td class="text-left">Variable x 5  <small>(ver tabla en menú Mi Cuenta)</small></td>
                </tr>


            </tbody><!--Cuerpo-->
        </table>

	</div>
</div>
<br><br>

<div>
	<div class="titleM1 colorBlue mb10 t18"><a name="medios"></a>Puntos</div>
    <div class="p20 taJ">
        Los puntos son lo correspondiente al 30% de las Comisiones del Empresario TRON.
        <br><br>
        Los puntos son una estrategia importante para el funcionamiento de la Red, porque así como tú te ves obligado a comprar en la
        Tienda Virtual para redimirlos, así lo tendrán que hacer tus muchos amigos registrados en tu red y al hacerlo, tú ganas más
        porque ganas comisiones por esas compras.
        <br><br>
        Los puntos tendrán una vigencia de 60 días. Por ejemplo: En la liquidación de comisiones del mes de Marzo, un usuario
        obtiene 15.000 puntos. Estos puntos aparecen en su cuenta Puntos los primeros días de Abril cuando se realiza la liquidación de comisiones.
        El usuario tiene todo el mes de Abril y todo el mes de Mayo para utilizarlos comprando en la Tienda Virtual. El proceso para redimirlos es
        muy sencillo. Basta comprar cualquier producto TRON u otro producto. Al momento de la liquidación del pedido el sistema verificará en
        primera instancia si existen puntos a favor y los aplicará al valor a pagar a razón de $ 1 por cada punto. De esta forma los puntos se
        convierten en dinero.
	</div>
</div>
<br><br>

<div>
	<div class="titleM1 colorBlue mb10 t18"><a name="medios"></a>Medios de Cobro</div>
    <div class="p20 taJ">
        El pago de las Comisiones se hará los primeros tres (3) días hábiles de cada mes y serán abonadas en tu cuenta dinero.  
        <br><br>
        Recuerda que el costo de la transferencia bancaria es de <?= Session::Get('valor_transferencia_bancaria') ;?> por lo que debes ajustar
        la cifra Valor Mínimo a Transferir a la cuantía que te convenga. Esta cifra viene por defecto en <?= Session::Get('valor_minimo_transferencias') ;?>
        y puedes incrementarla a tu conveniencia (no disminuirla).
	</div>
</div>
<br><br>


