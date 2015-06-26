
 <?php if (Session::Get('autenticado')==false ) :?>
  <div class="row" id="personal"><!-- INFORMACION SOBRE CUENTAS-->

    <p class="text-right">

      <a href="#myModal" class="ing" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-user"></span>  Iniciar Sesión
      </a>
      <a href="<?=BASE_URL ;?>terceros/registro" class="rgs">
         <span class="glyphicon glyphicon-list-alt"></span> Registrarme
      </a>

    </p>

  </div><!-- FINAL DE INFORMACION SOBRE CUENTAS--  >
  <?php endif ;?>

  <!-- INFORMACIÓN PARA USUARIOS AUTENTICADOS -->
 <?php if (Session::Get('autenticado')==true ) :?>
  <div class="row"  id="personal"><!-- INFORMACION SOBRE CUENTAS-->


      <a  href="#" class="bienvenido_usuario  bienvenido_industrial" id="bienvenido_usuario">
          <strong>Bienvenido: </strong> <?= ucfirst(strtolower(( Session::Get('nombre_usuario_pedido')))) ;?>
      </a>
        <ul class="list-unstyled cont-mi-cuenta">
           <li class="dropdown mi_cuenta"><!--MI CUENTA-->
                  <a href="#" class="dropdown-toggle  ing" data-toggle="dropdown">
                     <span class="glyphicon glyphicon-user"></span> Mi Cuenta <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu menu" style="width: 208px;">
                     <li><a href="<?= BASE_URL ;?>terceros/administrar_cuenta"      ><span class="configuracion"></span> Administrar Mi Cuenta</a></li>
                     <li><a href="<?= BASE_URL ;?>terceros/registro"                ><span class="registrar_amigo"></span> Registrar Amigo</a></li>
<!--                 <li><a href="<?= BASE_URL ;?>pedidos/historial_mis_pedidos"    ><span class="mis_pedidos"></span> Mis Pedidos</a></li>
                     <li><a href="<?= BASE_URL ;?>terceros/cuenta_pases_de_cortesia"><span ></span> Pases de Cortesia</a></li>
                     <li><a href="#"                                                ><span class="favoritos"></span> Favoritos</a></li>
                     <li><a href="<?= BASE_URL ;?>terceros/informacion_mi_cuenta"><span ></span> Informes y Reportes </a></li> -->
                  </ul>
           </li><!--MI CUENTA-->
           <li>
              <a href="<?=BASE_URL ;?>index/Cerrar_Sesion" class="rgs" >
                  <span class="exit"></span> Cerrar Sesión
              </a>
          </li><!-- CERRAR SESION-->
        </ul>

  </div><!-- FINAL DE INFORMACION SOBRE CUENTAS--  >
<?php endif ;?>

