<?php
    $Pedido_Minimo_Tron           = Session::Get('valor_minimo_pedido_productos');
    $Pedido_Minimo_Indus          = Session::Get('pedido_minimo_productos_fabricados_ta');
    $cuota_1_valor                = Numeric_Functions::Formato_Numero( $this->Bonificacion_Cuotas[0]['cuota_1_valor'] );
    $cuota_2_valor                = Numeric_Functions::Formato_Numero($this->Bonificacion_Cuotas[0]['cuota_2_valor'] );
    $cuota_3_valor                = Numeric_Functions::Formato_Numero($this->Bonificacion_Cuotas[0]['cuota_3_valor'] );
    $cuota_2_tope_ganancias       = Numeric_Functions::Formato_Numero($this->Bonificacion_Cuotas[0]['cuota_2_tope_ganancias'] );
    $cuota_3_tope_gananacias      = Numeric_Functions::Formato_Numero($this->Bonificacion_Cuotas[0]['cuota_3_tope_gananacias'] );
    $Total_Derecho_Inscripcion    = $this->Bonificacion_Cuotas[0]['cuota_1_valor']  ;
    $Total_Derecho_Inscripcion    = Numeric_Functions::Formato_Numero($Total_Derecho_Inscripcion);
    $valor_transferencia_bancaria =  Session::Get('valor_transferencia_bancaria');
    $valor_minimo_transferencias  =  Session::Get('valor_minimo_transferencias');
    $valor_kit_inicio_ocasional   = Numeric_Functions::Formato_Numero( Session::Get('valor_kit_inicio_ocasional' ));
    $valor_kit_inicio_empresario  = Numeric_Functions::Formato_Numero( Session::Get('valor_kit_inicio_empresario' ));
?>

<div class="pAA30">


<div class="contenedor-preguntas-frecuentes">
<div class="panel-group" id="accordion">


   <div class="panel panel-default"><!--Tienda Virtual-->
       <div class=" panel-heading">
           <h4 class="cont-titulos-panel  panel-title">
               <a href="#collapse_uno"  class="panel-titulo"  data-toggle="collapse" data-parent="#accordion">Tienda Virtual</a>
            </h4>
       </div>

       <div id="collapse_uno" class="panel-collapse collapse ">
        <div class="panel-body"><!--Contenedor de las preguntas frecuentes -->

          <ul class="list-unstyled accordion" id="accordion"><!--menu-accordion -->

               <li><!--linkPor qué los productos de la tienda tienen dos (2) precios? -->
                 <div class="link">
                    <p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>
                     ¿Por qué los productos de la tienda tienen dos (2) precios?
                    </p>
                 </div><!--Pregunta -->
                     <ul class="list-unstyled submenu"><!--Contenido -->
                         <li>
                          El primero (más alto y en negro) es para los Clientes, es un excelente precio y estamos vigilando para que sea el mejor precio del mercado. El segundo (en rojo) es el precio para los Amigos de los productos TRON. Aquellas personas que conocen que sólo elaboramos productos de alta calidad y que nuestros precios son supremamente atractivos. A ellos que consumen mensualmente los productos TRON para el aseo del hogar en cuantía mínima de <?= $Pedido_Minimo_Tron ;?> mensuales ó los productos industriales fabricados por Balquimia S.A.S. en cuantía mínima de <?= $Pedido_Minimo_Indus ;?> mensuales, les ofrecemos el beneficio de este precio especial.

                         </li>
                     </ul><!--Contenido -->
               </li><!-- ¿Por qué los productos de la tienda tienen dos (2) precios?-->

               <li><!--¿Al precio de los productos debo sumarle un flete? -->
                  <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Al precio de los productos debo sumarle un flete?</p></div><!--Pregunta -->
                   <ul class="list-unstyled submenu"><!--Contenido -->
                         <li>Sí, el valor del transporte es calculado basado en el peso del pedido y de la ciudad destino. Se agrega cuando el pedido se finaliza. </li>
                     </ul><!--Contenido -->
               </li><!--¿Al precio de los productos debo sumarle un flete? -->







          </ul><!--menu-accordion -->
        </div><!--Contenedor de las preguntas frecuentes -->
   </div>
</div><!--Tienda Virtual-->


<!-- ///////////////////////////////////////////////////////-Panel-Tipos de Registro-///////////////////////////////////////////////////////-->


<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
    <h4 class="cont-titulos-panel  panel-title">
         <a href="#tipos-registro"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Tipos de Registro</a>
    </h4>
</div>

<div id="tipos-registro" class="panel-collapse collapse ">
    <div class="panel-body"><!--Contenedor de Tipos de Registro -->

     <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->
       <li><!--Tipos de Registro -->
          <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span> ¿Debo registrarme para comprar en la Tienda Virtual?  </p></div><!--Pregunta -->
           <ul class="list-unstyled submenu"><!--Contenido -->
                 <li>Sí, de esta manera obtendremos tus datos básicos y sabremos donde despachar tus compras. Además, tendrás derecho a manejar la opción del menú denominada Mi Cuenta donde podrás editar tu información personal, ver el historial de tus pedidos, acceder fácilmente a tus productos Favoritos y otras cosas interesantes adicionales que están disponibles dependiendo del tipo de registro que escojas.    </li>
             </ul><!--Contenido -->
       </li><!--Tipos de Registro -->

       <li><!--¿Cuántos tipos de registro hay? -->
          <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cuántos tipos de registro hay?   </p></div><!--Pregunta -->
           <ul class="list-unstyled submenu"><!--Contenido -->
                 <li>Hay tres (3) tipos de registro. El más sencillo es el denominado Comprador Ocasional. Es sobre todo para quienes aún no nos conocen bien. Recibes unos muy buenos precios siempre.
                 Sugerimos a quienes escojan este plan que busquen los productos TRON, los compren y los evalúen. Si les gustan y desean implementar compras mensuales de ellos,
                 los encontrarán en los otros dos (2) planes siguientes a precios muchísimo más bajos. El segundo plan se denomina Plan Cliente TRON,
                 es para quien quiera consumir los productos fabricados por Balquimia S.A.S., en cuantía mínima de <?= $Pedido_Minimo_Tron ;?>
                 pesos mensuales ó los productos industriales fabricados por Balquimia S.A.S., en cuantía mínima de <?= $Pedido_Minimo_Indus ;?> pesos mensuales.
                 Como beneficio por esta preferencia, ofrecemos un precio especial en toda la Tienda. El tercer plan se llama Plan Empresario TRON.
                 Tiene todos los beneficios del plan anterior pero es para personas emprendedoras, que desean tener ingresos adicionales beneficiando a sus amigos y conocidos.
                 Ellos obtendrán ganancias por el plan de compensación que ofrecemos el cual consta de comisiones.   </li>
             </ul><!--Contenido -->
       </li><!--¿Cuántos tipos de registro hay? -->
     </ul><!--Menu accordion -->
    </div><!--Contenedor de  Tipos de Registro-->
</div>
</div><!--Panel -->





<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
  <h4 class="cont-titulos-panel  panel-title">
       <a href="#pago-comisiones-bonificaciones"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Pago de comisiones </a>
  </h4>
</div>

<div id="pago-comisiones-bonificaciones" class="panel-collapse collapse">
  <div class="panel-body"><!--Contenedor de  -->

 <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->
   <li><!--¿Quiénes tienen derecho a recibir comisiones? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Quiénes tienen derecho a recibir comisiones?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Todos los usuarios registrados en el Plan Empresario TRON, que se encuentren activos en la red y que al último día del mes a liquidar cumplan con alguna de las siguientes condiciones: <br><br> 1) Que tengan amigos en su red vinculados al Plan Empresario TRON y éstos hayan hecho compras. <br> 2) Que tengan amigos vinculados por ellos en el Plan Cliente TRON y estos hayan hecho compras.  <br> 3) Que amigos vinculados por ellos al Plan Empresario TRON, tengan amigos vinculados por ellos en el Plan Cliente TRON y éstos hayan hecho compras.    </li>
         </ul><!--Contenido -->
   </li><!--¿Quiénes tienen derecho a recibir comisiones? -->



  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cuando se liquidan las comisiones?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Los primeros 3 días hábiles del mes siguiente al mes que se liquida.   </li>
         </ul><!--Contenido -->
   </li>

  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cuándo se pagan las comisiones  ?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li> El mismo día que se realiza la liquidación de comisiones quedan abonadas a tu cuenta dinero. Cuando lo desees podrás solicitar que te las transfieran a tu cuenta bancaria.   </li>
         </ul><!--Contenido -->
   </li>




  <li><!--¿Se pueden perder las comisiones?-->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Se pueden perder las comisiones?  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Sí. Pierden las comisiones todos aquellos Empresarios TRON que por cualquier motivo incumplieron al no realizar la compra mínima mensual reglamentaria <?= $Pedido_Minimo_Tron ;?> de los productos TRON ó <?=$Pedido_Minimo_Indus ;?> de los productos fabricados por Balquimia S.A.S.    </li>
         </ul><!--Contenido -->
   </li><!--¿Se pueden perder las comisiones?-->

  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cómo me pagan las comisiones?    </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Al registrarse en el Plan Empresario TRON, se crearán dos (2) cuentas virtuales a nombre del usuario. La cuenta Dinero y la cuenta Puntos. El 70% del valor total de comisiones serán consignadas en la cuenta Dinero y el 30% restante serán consignados en la cuenta Puntos y estos sólo se utilizaran para compras en la Tienda Virtual. Cada punto tendrá el valor de $1 M/cte. (un peso moneda colombiana corriente).     </li>
         </ul><!--Contenido -->
   </li>

  <li><!--¿Por qué es importante ganar puntos?  -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span> ¿Por qué es importante ganar puntos?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Porque así como tú te ves obligado a comprar en la Tienda Virtual para redimirlos, así lo tendrán que hacer tus muchos amigos registrados en tu red y al hacerlo, tú ganas más porque ganas comisiones por esas compras.   </li>
         </ul><!--Contenido -->
   </li><!--¿Por qué es importante ganar puntos?  -->

  <li><!--¿Tienen los puntos fecha de expiración?-->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Tienen los puntos fecha de expiración?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Sí, Los puntos tendrán una vigencia de 60 días. Por ejemplo: En la liquidación de comisiones del mes de Marzo, un usuario obtiene 15.000 puntos. Estos puntos aparecen en su cuenta Puntos los primeros días del mes de Abril cuando se realiza la liquidación de comisiones. El usuario tiene todo el mes de Abril y todo el mes de Mayo para utilizarlos comprando en la Tienda Virtual. El proceso para redimirlos es muy sencillo: basta comprar cualquier producto TRON u otro producto. Al momento de la liquidación del pedido el sistema verificará en primera instancia si existen puntos a favor y los aplicará al valor a pagar a razón de $ 1 por cada punto. De esta forma los puntos se convierten en dinero.    </li>
         </ul><!--Contenido -->
   </li><!--¿Tienen los puntos fecha de expiración? -->



  <li><!--¿Cuál es la base para liquidación de mis comisiones? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span> ¿Cuál es la base para liquidación de mis comisiones?  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li> Todas las compras de productos hechas en el mes por las personas que conforman tu red
             (“Mis amigos” y “los Amigos de mis Amigos”) registrados en el Plan Empresario TRON hasta el nivel sexto (6º.)
             en tu Red y todas las compras de productos hechas en el mes por las personas registradas con tu Código de
             Usuario en el Plan Cliente TRON.   </li>
         </ul><!--Contenido -->
   </li><!--¿Cuál es la base para liquidación de mis comisiones? -->


  <li><!--¿Sobre qué cuantías no se pagan comisiones? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Sobre qué cuantías no se pagan comisiones?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Sobre el IVA, el valor del transporte o la compra de accesorios. Estas cuantías se encuentran discriminadas en tu factura. Tampoco se pagan comisiones por la compra de productos clasificados como PP (productos promocionales). </li>
         </ul><!--Contenido -->
   </li><!--¿Sobre qué cuantías no se pagan comisiones? -->

  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Existen cuantías pequeñas en comisiones que quedan pendientes de pago?  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
          <li>
             No. Cuando solicites el traslado de comisiones de tu cuenta dinero a tu cuenta bancaria será transfereido tu saldo y sólo se descontará el valor de la transferencia.
           </li>
         </ul><!--Contenido -->
   </li>

  <li><!-- ¿Dónde reclamar el pago?-->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Dónde reclamar el pago?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li> Los pagos son hechos todos los meses directamente a la cuenta corriente o de ahorros que los usuarios deben registrar al momento de inscribirse o en otro momento utilizando el menú Mi cuenta/Datos personales/Datos de cuenta. Al hacerlo, autorizan asumir  el costo de esta transferencia (hoy <?= $valor_transferencia_bancaria ;?>).   Igualmente el usuario debe saber que el valor mínimo que se trasladará a su cuenta es por defecto $ 30.000. Este valor puede ser aumentado a voluntad del usuario pero no disminuido. Lo ganado que no alcance este valor mínimo a trasferir, permanecerá en la cuenta Dinero y servirá para ser abonado al próximo pedido.” </li>
         </ul><!--Contenido -->
   </li>
 </ul><!--Menu accordion -->
</div><!--Contenedor de  -->
</div>
</div><!--Panel -->


<!-- ///////////////////////////////////////////////////////-Panel-Estructura de la Red de Usuarios-///////////////////////////////////////////////////////-->

<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
<h4 class="cont-titulos-panel  panel-title">
   <a href="#estructura-usuarios"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Estructura de la Red de Usuarios</a>
</h4>
</div>

<div id="estructura-usuarios" class="panel-collapse collapse">
<div class="panel-body"><!--Contenedor de Estructura de la Red de Usuarios -->

 <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->
   <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>Número de amigos empresarios TRON por nivel  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li> Número de amigos empresarios por nivel: Podrás tener hasta 4 amigos Empresarios en tu primer nivel (acción que el sistema hace de forma automática). Cada uno de ellos también puede tener 4 amigos por lo que, en este, tu segundo nivel habrán 16 amigos. Cada uno de estos últimos puede también inscribir 4 amigos por lo que, en este, tu tercer nivel habrán 64 amigos. Al repetir esta operación, tenemos que habrán: 256 amigos en tu cuarto nivel, 1.024 amigos en tu quinto nivel y 4.096 amigos en tu sexto nivel. El total de amigos que habrán en tu Red será de 5.460. Pero este no es el límite. Si estando copada tu Red, con tu código de usuario ingresas otro amigo, el sistema abrirá una posición adicional en tu primer nivel o sea, abrirá el quinto amigo en tu primer nivel. Esto permitirá que tu red pueda a partir de este nuevo amigo, crecer hasta el sexto nivel. Cuando así se haya hecho, contarás con 1.365 amigos adicionales. Cuando vuelvas a ingresar otro amigo con tu código de usuario, al estar todos los niveles copados, sucederá lo mismo, el sistema abrirá una posición adicional en tu primer nivel o sea, abrirá el sexto amigo en tu primer nivel, y así sucesivamente, cuantas veces ocurra. Esto garantizará que puedas tener un número ilimitado de amigos que te benefician con un porcentaje sobre sus consumos.   </li>
        </ul><!--Contenido -->
   </li><!--Número de amigos empresarios TRON por nivel  -->

    <li><!--Apertura de nuevos Códigos de Usuario -->
        <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>Apertura de nuevos Códigos de Usuario   </p></div><!--Pregunta -->
         <ul class="list-unstyled submenu"><!--Contenido -->
               <li><p>Es un premio al cual tienen derecho todos los Empresarios TRON por cada (20) amigos presentados a la red. Rigen las siguientes condiciones: </p>
                   <ul>
                      <li>El código de usuario inicial, el que se recibió al registrarse en el Plan Empresario TRON, puede generar un (1) código adicional al cumplir con la cuota de inscribir a 20 amigos Empresarios en la Red.</li>

                      <li>Un tercer código puede ser obtenido cuando el código adicional obtenido previamente (segundo código), haya inscrito a la red a 20 amigos Empresarios.</li>
                      <li>Un cuarto código puede ser obtenido cuando el código adicional obtenido previamente (tercer código), haya inscrito a la red a 20 amigos Empresarios. Y así sucesivamente.</li>

                      <li>Es posible inscribir más de 20 amigos con un mismo código de usuario pero sólo 20 servirán para adquirir un nuevo código, los demás no contarán para este proceso. Si se desean más códigos adicionales, deben utilizarse los que aún no tienen 20 amigos. </li>
                   </ul><br><br>

                   <p>En cada caso el nuevo código siempre formará el quinto frontal del código con el cual obtuvo el derecho. Bajo un código sólo podrá abrirse uno (1) más con la misma identificación.</p>
               </li>
           </ul><!--Contenido -->
     </li><!-- Apertura de nuevos Códigos de Usuario-->

  <li><!--Apertura de nuevos frontales -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>Apertura de nuevos frontales  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li><p>Entendiendo frontales como los amigos del primer nivel, es posible abrirlos en los siguientes casos: </p>
                 <ul>
                    <li>Por abrir nuevos códigos de usuario tal como fue explicado en el punto anterior.</li>
                    <li>Por haber terminado la red básica o sea, haber llenado los seis (6) niveles. En estos casos de cuatro (4) amigos frontales, se pasará a abrir el quinto (5º.) y así sucesivamente sin límite mientras se den las situaciones para hacerlo.</li>
                 </ul>
             </li>
         </ul><!--Contenido -->
   </li><!--Apertura de nuevos frontales -->

  <li><!--Cooperativismo en la Red -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>Cooperativismo en la Red  </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Cada nivel tiene sólo 4 amigos para que pueda operar el cooperativismo en la Red. Este consiste en que cada amigo Empresario TRON adicional a estos iniciales que agregues a la Red, será colocado por el sistema en el primer nivel de alguno de tus amigos o de alguno de los amigos de tus amigos, beneficiándote no solo a ti sino también a todos aquellos que existan en línea directa entre el amigo agregado y tú.    </li>
         </ul><!--Contenido -->
   </li><!--Cooperativismo en la Red -->
  </ul><!--Menu accordion -->
</div><!--Contenedor de Estructura de la Red de Usuarios -->
</div>
</div><!--Panel -->








<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
<h4 class="cont-titulos-panel  panel-title">
     <a href="#derecho-inscripcion"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Inscripción de Nuevos Códigos</a>
</h4>
</div>

<div id="derecho-inscripcion" class="panel-collapse collapse">
<div class="panel-body">

 <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->




  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Puedo registrarme en la Red más de una vez? </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Si puedes regístrate más de una vez , para ello debes cumplir con lo estipulado en Estructura de la Red de usuarios / apertura nuevos Códigos de Usuario.    </li>
         </ul><!--Contenido -->
   </li><!--¿Puedo registrarme en la Red más de una vez, y si lo hago debo volver a pagar el Derecho de Inscripción?  -->

  <li><!--¿Se puede perder la inscripción?  -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Se puede perder la inscripción?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Sí, si te inactivas por 3 meses consecutivos (dejas de hacer la compra mínima reglamentaria de los productos TRON ó de los productos industriales fabricados por Balquimia S.A.S.), entendemos que no estás interesado en continuar perteneciendo al modelo de negocio y se dará por terminado unilateralmente el convenio comercial.    </li>
         </ul><!--Contenido -->
   </li><!--¿Se puede perder la inscripción?  -->
 </ul><!--Menu accordion -->
</div>
</div>
</div><!--Panel -->

<!-- ///////////////////////////////////////////////////////-Panel-Derecho de Permanencia-///////////////////////////////////////////////////////-->




<!-- ///////////////////////////////////////////////////////-Panel-Pago de Pedidos-///////////////////////////////////////////////////////-->


<div class="panel panel-default"><!--Panel -->
  <div class="  panel-heading">
      <h4 class="cont-titulos-panel  panel-title">
           <a href="#pago-pedidos"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Pago de Pedidos</a>
      </h4>
  </div>

  <div id="pago-pedidos" class="panel-collapse collapse">
      <div class="panel-body"><!--Contenedor de Pago de Pedidos -->

       <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->
         <li><!--¿Cómo y dónde pago mis pedidos? -->
            <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cómo y dónde pago mis pedidos?   </p></div><!--Pregunta -->
             <ul class="list-unstyled submenu"><!--Contenido -->
                   <li>Al terminar tu pedido el sistema te conducirá a una página donde debes decidir que medio de pago utilizar entre los que se encuentran los siguientes:

                       <div class="panel-pagos-img">
                           <img src="<?= BASE_IMG_TIENDA ;?>medio_pago.png" class="img-responsive">
                       </div>

                    </li>
               </ul><!--Contenido -->
         </li><!--¿Cómo y dónde pago mis pedidos? -->

  <li>
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Si tengo comisiones acumuladas puedo hacer cruce para pagar mis pedidos?    </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Si. Si tienes comisiones acumuladas en tu cuenta dinero podrás usarlas para pagar tus pedidos.   </li>
         </ul><!--Contenido -->
   </li>

  <li><!--¿Qué pasa si se me olvida hacer mi pedido mensual? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Qué pasa si se me olvida hacer mi pedido mensual?</p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Si se te olvida hacer tu pedido mínimo reglamentario del mes en productos de aseo TRON, no tendrás derecho a liquidación de comisiones, estas volverán a ser liquidadas con la comisión regular cuando hagas y pagues tu pedido mínimo reglamentario del mes de productos de aseo TRON o de productos industriales fabricados por Balquimia S.A.S.</li>
         </ul><!--Contenido -->
   </li><!--¿Qué pasa si se me olvida hacer mi pedido mensual? -->


 </ul><!--Menu accordion -->
</div><!--Contenedor de Pago de Pedidos -->
</div>
</div><!--Panel -->

<!-- ///////////////////////////////////////////////////////-Panel-Responsabilidad de los Usuarios-///////////////////////////////////////////////////////-->


<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
  <h4 class="cont-titulos-panel  panel-title">
       <a href="#responsabilidad-usuario"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Responsabilidad de los Usuarios</a>
  </h4>
</div>

<div id="responsabilidad-usuario" class="panel-collapse collapse">
  <div class="panel-body"><!--Contenedor de  Responsabilidad de los Usuarios-->

   <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->

     <li><!-- ¿Cuál es mi responsabilidad como miembro de la Red?-->
        <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cuál es mi responsabilidad como miembro de la Red?   </p></div><!--Pregunta -->
         <ul class="list-unstyled submenu"><!--Contenido -->
               <li>Tus responsabilidades son dos: <br><br>
                   <ul>
                      <li>Consumir los productos para el aseo y la desinfección de tu hogar de la marca TRON ó productos de la zona INDUSTRIAL fabricados por Balquimia S.A.S. identificados con el logo símbolo de la empresa en cuantías mensuales de mínimo <?=$Pedido_Minimo_Tron ;?> ó   <?=$Pedido_Minimo_Indus ;?> respectivamente. Al hacerlo, conservas tu status de Activo y el beneficio de ganar las comisiones sobre las compras de tus amigos y los amigos de tus amigos.</li> <br><br>

                      <li>Integrar por lo menos a cuatro (4) amigos en tu red. Si no haces esto, no puedes esperar que tu red crezca y se generen ingresos residuales a tu favor en el futuro. Hacerlo y acompañar a tus amigos para que igualmente lo hagan, es asegurar que la red no se detenga y puedas ver crecer tu negocio como integrante de esta.</li>
                   </ul>
               </li>
           </ul><!--Contenido -->
     </li><!--¿Cuál es mi responsabilidad como miembro de la Red? -->

  <li><!--¿Qué pasa si no compro los productos además de no ganar comisiones? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Qué pasa si no compro los productos además de no ganar comisiones?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>Si permaneces inactivo durante tres (3) meses consecutivos, consideraremos que no estás interesado en pertenecer a la Red y cancelaremos tu registro sin derecho alguno a reclamos o indemnización tal como consta en el Convenio Comercial aceptado en el momento de la inscripción. Si no compras los productos TRON pero sí compras otros productos en la tienda virtual estos últimos serán liquidados con el precio normal, no serán liquidados a precios amigos TRON.</li>
         </ul><!--Contenido -->
     </li><!--¿Qué pasa si no compro los productos además de no ganar comisiones? -->
   </ul><!--Menu accordion -->
  </div><!--Contenedor de Responsabilidad de los Usuarios -->
</div>
</div><!--Panel -->


<!-- ///////////////////////////////////////////////////////-Panel-Responsabilidad de los Usuarios-///////////////////////////////////////////////////////-->


<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
<h4 class="cont-titulos-panel  panel-title">
     <a href="#despacho"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Despacho de Productos a Domicilio</a>
</h4>
</div>

<div id="despacho" class="panel-collapse collapse ">
<div class="panel-body"><!--Contenedor de  Despacho de Productos a Domicilio-->

   <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->

     <li><!--¿En cuánto tiempo después de pagar mi pedido recibo los productos?  -->
        <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿En cuánto tiempo después de pagar mi pedido recibo los productos?    </p></div><!--Pregunta -->
         <ul class="list-unstyled submenu"><!--Contenido -->
               <li>Depende del día de la semana en que realices tu pago y de la zona del país donde habites. Si tu pago lo realizas entre lunes y jueves, recibirás tus productos hasta 4 días después. Si lo realizas de viernes a domingo, recibirás el jueves siguiente. Si tu resides en la costa norte, los Santander, los llanos orientales o en un sitio denominado destino especial o sea que se requiere reexpedición (cambio de transportador), agrega a lo anteriormente dicho, 1 día más. Sin embargo, podrían ser sólo 2 días después dependiendo del proveedor o de si el producto lo tenemos en inventario como es el caso de los productos TRON.</li>
           </ul><!--Contenido -->
     </li><!--¿En cuánto tiempo después de pagar mi pedido recibo los productos?  -->

    <li><!--¿Debo pagar el costo del flete a la transportadora? -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Debo pagar el costo del flete a la transportadora?   </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>No, el costo de los fletes fue incluido en la liquidación del pedido bajo el concepto transporte.

 </li>
         </ul><!--Contenido -->
     </li><!--¿Debo pagar el costo del flete a la transportadora? -->

    <li><!--¿Qué debo hacer si la bolsa de los productos viene abierta o evidencio averías?  -->
      <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Qué debo hacer si la bolsa de los productos viene abierta o evidencio averías?    </p></div><!--Pregunta -->
       <ul class="list-unstyled submenu"><!--Contenido -->
             <li>No la recibas. Deja constancia en la guía del transportador del motivo por el cual no la recibes y en la sección Contáctanos, infórmanos citando los datos básicos, para hacerte el reenvío de tu pedido lo más pronto posible, incluso antes que la transportadora nos lo devuelva.    </li>
         </ul><!--Contenido -->
      </li><!--¿Qué debo hacer si la bolsa de los productos viene abierta o evidencio averías?  -->
   </ul><!--Menu accordion -->
</div><!--Contenedor de  Despacho de Productos a Domicilio-->
</div>
</div><!--Panel -->

<!-- ///////////////////////////////////////////////////////-Panel-Uso de Productos de Aseo TRON presentados en cojines-///////////////////////////////////////////////////////-->


<div class="panel panel-default"><!--Panel -->
<div class="  panel-heading">
<h4 class="cont-titulos-panel  panel-title">
     <a href="#uso-productos"  class="panel-titulo"  data-toggle="collapse"   data-parent="#accordion">Uso de Productos de Aseo TRON presentados en cojines</a>
</h4>
</div>

<div id="uso-productos" class="panel-collapse collapse ">
<div class="panel-body"><!--Contenedor de Uso de Productos de Aseo TRON presentados en cojines -->

   <ul class="list-unstyled accordion" id="accordion"><!-- Menu accordion-->
     <li><!--¿Cómo debo de preparar los productos?  -->
        <div class="link"><p><span class="fonts-flecha-link glyphicon glyphicon-chevron-down"></span>¿Cómo debo de preparar los productos?    </p></div><!--Pregunta -->
         <ul class="list-unstyled submenu"><!--Contenido -->
               <li>Todos los productos, sin importar el tamaño del cojín se preparan igual. <br><br>
                   <ul>
                       <li>En el frasco dosificador que corresponde al cojín, agrega agua hasta aproximadamente la mitad del envase</li>
                       <li>Con la ayuda de unas tijeras, abra el cojín y viértelo en su totalidad dentro del envase.</li>
                       <li>Mueve suavemente el envase hacia ambos lados. Esto permitirá que el producto se mezcle bien sin producir exceso de espuma.</li>
                       <li>Completa con agua a baja presión hasta un poco antes de llegar a la rosca del envase.</li>
                       <li>Tápalo y nuevamente muévelo para homogeneizarlo en su totalidad.</li>
                       <li>Utilízalo de acuerdo a las instrucciones de uso que se encuentran en el envase.</li>
                   </ul>
               </li>
               <br>
        <div class="videoWrapper">
          <iframe width="854" height="480" src="https://www.youtube.com/embed/IM87aby0DNQ" frameborder="0" allowfullscreen></iframe>
        </div>




           </ul><!--Contenido -->
     </li><!--¿Cómo debo de preparar los productos?  -->
   </ul><!--Menu accordion -->
</div><!--Contenedor de Uso de Productos de Aseo TRON presentados en cojines -->
</div>
</div><!--Panel -->
</div>
</div>

</div>

