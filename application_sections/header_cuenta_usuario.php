<?php if ( isset($_SESSION['logueado']) &&  $_SESSION['logueado'] == FALSE ) :?>

	<!-- INFORMACION SOBRE CUENTAS-->
	<div class="taRC">

        <a href="#myModal" class="aS p10 colorRed dIB" data-toggle="modal" data-target="#FormModalLogin">
            <span class="glyphicon glyphicon-user arro rr50"></span> Iniciar Sesión
        </a>
 <!-- INFORMACION SOBRE CUENTAS

 -->

         <a href="<?=BASE_URL ;?>terceros/nuevo_usuario" class="aS p10 colorRed dIB">
            <span class="glyphicon glyphicon-list-alt arro rr50"></span> Registrarme
        </a>


	</div>
    <div class="onlyPCBoo"><br /><br /><br /></div>

<?php endif ;?>



<!-- INFORMACIÓN PARA USUARIOS LOGUEADOS -->
<?php if (   $_SESSION['logueado'] == TRUE ) :?>

    <div class="dropCuenta taRC">
    <!-- Bienvenido: -->
        <div class="dropdown dIB">
            <button class="btn dropdown-toggle aS colorRed" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <?= ucwords(strtolower(( Session::Get('nombre_usuario_pedido')))) ;?>
                <span class="caret"></span>
            </button>

            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                <?php if ( Session::Get('Generando_Pedido_Amigo')== FALSE) :?>
                    <li role="presentation">
                        <a href="<?= BASE_URL ;?>terceros/administrar_cuenta" role="menuitem" tabindex="-1">
                            <span class="glyphicon glyphicon-user"></span> &nbsp; Mi Cuenta
                        </a>
                    </li>

                    <?php if ( Session::Get('idtipo_plan_compras') == 3 ) :?>
                        <li role="presentation">
                            <a href="<?= BASE_URL ;?>terceros/nuevo_usuario/1" role="menuitem" tabindex="-1">
                                <span class="registrar_amigo"></span> &nbsp; Registrar Amigo bajo mi código
                            </a>
                        </li>
                     <?php endif; ?>

                <?php endif; ?>
                <li role="presentation" class="divider"></li>
                <li role="presentation">
                	<a href="<?=BASE_URL ;?>index/Cerrar_Sesion" role="menuitem" tabindex="-1">
                    	<span class="exit"></span> &nbsp; Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>

    </div>
    <div class="onlyPCBoo"><br /><br /><br /></div>

<?php endif ;?>
