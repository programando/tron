<?php
    $Pedido_Minimo_Tron   = Session::Get('valor_minimo_pedido_productos');
    $Pedido_Minimo_Indus  = Session::Get('pedido_minimo_productos_fabricados_ta');
?>

<div class="pAA30">
	<div class="titleM1 colorBlue t18 dIB">PLAN EMPRESARIO TRON</div>
    <div class="p20">
        <div class="col-sm-8 col-xs-12 vcenter">
En el plan Empresario se deben registrar todos los vendedores que deseen comercializar, entre sus amigos, los productos de nuestra tienda virtual, los inscritos en este plan podrán inscribir otros vendedores para formar su grupo de ventas. <br><br>

Los vendedores inscritos en el Plan Empresario TRON recibirán un código que les permitirá inscribir amigos y podrán hacer una red de consumidores para ganar comisiones por las compras que  realicen sus amigos y los amigos de sus vendedores, recibirá comisiones hasta el cuarto (4to) nivel en profundidad,

            <a id="soy" href="<?= BASE_URL ;?>redtron/red_de_amigos_tron#estructura">ver estructura de la red.</a>

        </div><!--
        --><div class="col-sm-4 col-xs-12 vcenter taRC">
            <img src="<?= BASE_IMG_EMPRESA ;?>empresarioI.png" />
        </div>
        <br>
Cada uno de los Empresarios TRON tendrá cuantos vendedores desee. También podrá inscribir amigos que no deseen vender, en el Plan Cliente, formar un grupo con ellos aparte de la red y ganar comisión por las compras que ellos realicen.
		<br><br>


        <div class="lista-empresario">
        	En síntesis, el Empresario TRON contará con:
        	<br><br>
            <ul class="list-unstyled ulGen">
                <!--Las listas estan horganisadas de la forma = li => span => img => a => text cada etiqueta tiene una clase. -->
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Precios Especiales para Amigos TRON.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Productos que están en oferta.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Invitación a capacitaciones y eventos sobre el modelo de negocio.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Código de usuario para invitar amigos a tu red.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Comisiones según planes de compensación.</a></li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Acceso a Informes administrativos sobre el desempeño de tu red.</li>
            </ul>
        </div>
		<br><br>

        <!--Boton-registrar-Empresario TRON -->
        <div>
        	<a href="<?= BASE_URL ;?>terceros/nuevo_usuario" type="button" class="btn btn-danger">Regístrate ahora!</a>
        </div>
        <!--Boton-registrar-Empresario TRON -->
	</div>
</div>
<br /><br />

<div class="pAA30">
	<div class="titleM1 colorBlue t18">PLAN CLIENTE</div>
    <div class="p20">

        <div class="col-sm-4 col-xs-12 vcenter taLC">
        	<img src="<?= BASE_IMG_EMPRESA ;?>amigoI.png"/>
        </div><!--
        --><div class="col-sm-8 col-xs-12 vcenter">
            Como su nombre lo indica este es el Plan para consumidores habituales de los productos TRON. <br><br>
            Las personas que desean aprovechar todos los beneficios que ofrecen los productos TRON, podrán hacerlo realizando compras desde
            <?= $Pedido_Minimo_Tron ;?>
            Esto  les da derecho a acceder a precios preferenciales no sólo en los productos TRON sino también en toda la tienda virtual. Cómo también a las ofertas. <br><br> Para registrarse en este Plan se debe adquirir productos TRON para el hogar ó comprar <?= $Pedido_Minimo_Tron ;?> en productos Industriales.



            <img src="<?= BASE_IMG_PRODUCTOS ;?>balquimia.png" width="60" />
        </div>
        <br><br>

        En síntesis, el Cliente contará con:
        <br><br>

        <ul class="list-unstyled ulGen">
              <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png"/></span>Precios Especiales para Amigos TRON.</li>
              <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png"/></span>Productos que estén en oferta.</li>
              <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png"/></span>Invitación a capacitaciones y eventos sobre el modelo de negocio <small>(opcional)</small>.</li>
        </ul>
       	<br><br>

        <div>
        	<a href="<?= BASE_URL ;?>terceros/nuevo_usuario" type="button" class="btn btn-danger">Regístrate ahora!</a>
        </div>

	</div>
</div>
<br /><br />


<br /><br />
