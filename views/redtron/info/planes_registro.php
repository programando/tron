<?php
    $Pedido_Minimo_Tron   = Session::Get('valor_minimo_pedido_productos');
    $Pedido_Minimo_Indus  = Session::Get('pedido_minimo_productos_fabricados_ta');
?>

<div class="pAA30">
	<div class="titleM1 colorBlue t18 dIB">PLAN EMPRESARIO TRON</div>
    <div class="p20">
        <div class="col-sm-8 col-xs-12 vcenter">
            Es un plan para las personas que además de querer beneficiarse de los productos TRON desean obtener ingresos adicionales a través del
            modelo de negocio que brinda la red TRON Entre amigos alcanzamos.
            <br><br>
            Las personas inscritas en el Plan Empresario TRON recibirán un código que les permitirá inscribir amigos y podrán hacer una red de
            consumidores para ganar comisiones por las compras que realicen sus amigos y los amigos de sus amigos, recibirá comisiones hasta
            el sexto(6to) nivel en profundidad, <a id="soy" href="<?= BASE_URL ;?>redtron/red_de_amigos_tron#estructura">ver estructura de la red.</a>
        </div><!--
        --><div class="col-sm-4 col-xs-12 vcenter taRC">
            <img src="<?= BASE_IMG_EMPRESA ;?>empresarioI.png" />
        </div>
        <br><br>        
        
		Cada uno de los Empresarios TRON tendrá cuatro (4) frontales en el primer nivel inicialmente, el Empresario TRON recibirá
        bonificaciones por cada amigo registrado en el Plan Empresario TRON,
        <a href="<?= BASE_URL ;?>redtron/Bonificaciones">ir a la sección de bonificaciones</a>, el Empresario TRON también podrá
        inscribir amigos, que no deseen crear red, en el Plan Cliente TRON, formar un grupo con ellos aparte de la red y ganar comisión
        por las compras que ellos realicen.
		<br><br>
        

        <div class="lista-empresario">
        	En síntesis, el Empresario TRON contará con:
        	<br><br>
            <ul class="list-unstyled ulGen">
                <!--Las listas estan horganisadas de la forma = li => span => img => a => text cada etiqueta tiene una clase. -->
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Precios Especiales para Amigos TRON.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Invitación a capacitaciones y eventos sobre el modelo de negocio.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Pases de Cortesía.</a></li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Código de usuario para invitar amigos a tu red.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Comisiones.</a></li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Bonificaciones.</a></li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Primas Anuales.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Reconocimiento y estatus por logros alcanzados en tu red.</li>
                <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png" alt=""></span>Acceso a Informes administrativos sobre el desempeño de tu red.</li>
            </ul>
        </div>
		<br><br>
        
        <!--Boton-registrar-Empresario TRON -->
        <div>
        	<a href="<?= BASE_URL ;?>terceros/registro" type="button" class="btn btn-danger">Regístrate ahora!</a>
        </div>
        <!--Boton-registrar-Empresario TRON -->
	</div>
</div>
<br /><br />

<div class="pAA30">
	<div class="titleM1 colorBlue t18">PLAN CLIENTE TRON</div>
    <div class="p20">
           
        <div class="col-sm-4 col-xs-12 vcenter taLC">
        	<img src="<?= BASE_IMG_EMPRESA ;?>amigoI.png"/>
        </div><!--
        --><div class="col-sm-8 col-xs-12 vcenter">
            Como su nombre lo indica este es el Plan de las personas que desean aprovechar todos los beneficios que ofrecen los productos TRON,
            convirtiéndose en consumidores habituales de ellos con una compra mensual mínima de <?= $Pedido_Minimo_Tron ;?>. El hacerlo les da
            derecho a acceder a precios preferenciales aún mejores que en el Plan Comprador Ocasional, no solo en los productos TRON sino también
            en toda la tienda virtual. Para registrarse en este Plan se debe adquirir el kit de Inicio de productos TRON para el hogar ó comprar
            <?= $Pedido_Minimo_Indus ;?> en productos Industriales fabricados por Balquimia S.A.S.
            <img src="<?= BASE_IMG_PRODUCTOS ;?>balquimia.png" width="60" />
        </div>
        <br><br>
        
        En síntesis, el Cliente TRON contará con:
        <br><br>
        
        <ul class="list-unstyled ulGen">
              <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png"/></span>Precios Especiales para Amigos TRON.</li>
              <li class="lista-empresario-tron"><span class="img-span"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png"/></span>Invitación a capacitaciones y eventos sobre el modelo de negocio <small>(opcional)</small>.</li>
        </ul>
       	<br><br>
        
        <div>
        	<a href="<?= BASE_URL ;?>terceros/registro" type="button" class="btn btn-danger">Regístrate ahora!</a>
        </div>
        
	</div>
</div>
<br /><br />

<div class="pAA30">
	<div class="titleM1 colorBlue t18">PLAN CLIENTE TRON</div>
    <div class="p20">           
        
        <div class="col-sm-8 col-xs-12 vcenter">
            En este plan se pueden registrar todas las personas que quieran comprar en nuestra tienda virtual y desean beneficiarse
            de los precios especiales, ofertas y concursos para ganar descuentos.
        </div><!--
        --><div class="col-sm-4 col-xs-12 vcenter taLC">
        	<img src="<?= BASE_IMG_EMPRESA ;?>visitanteI.png"/>
        </div>
        <br><br>

        
        <div>
        	<a href="<?= BASE_URL ;?>terceros/registro" type="button" class="btn btn-danger">Regístrate ahora!</a>
        </div>
        
	</div>
</div>
<br /><br />
