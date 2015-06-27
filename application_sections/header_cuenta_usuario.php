
 <?php if (Session::Get('autenticado')==false ) :?>
  <div class="row" id="personal"><!-- INFORMACION SOBRE CUENTAS-->

    <p class="text-right">

      <a href="#myModal" class="ingresar" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-user"></span>  Iniciar Sesión
      </a>
      <a href="<?=BASE_URL ;?>terceros/registro" class="registrar">
         <span class="glyphicon glyphicon-list-alt"></span> Registrarme
      </a>

    </p>

  </div><!-- FINAL DE INFORMACION SOBRE CUENTAS--  >
  <?php endif ;?>

  <!-- INFORMACIÓN PARA USUARIOS AUTENTICADOS -->
 <?php if (Session::Get('autenticado')==true ) :?>
  <div class="row"  id="personal"><!-- INFORMACION SOBRE CUENTAS-->
    <ul class="list-unstyled cont-mi-cuenta">
         <!-- bienvenido -->
         <li>
            <a  href="#" class="bienvenido_usuario  bienvenido_industrial" id="bienvenido_usuario">
                <strong>Bienvenido: </strong> <?= ucfirst(strtolower(( Session::Get('nombre_usuario_pedido')))) ;?>
            </a>
         </li>
          <!-- Mi cuentA -->
           <li class="dropdown mi_cuenta">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <span class="glyphicon glyphicon-user"></span> Mi Cuenta <span class="caret"></span>
              </a>
              <!-- Cuenta  = Menu -->
              <ul class="dropdown-menu" id="cuenta_info_menu" style="width: 220px; margin-left: -50px;">
                 <li><a class="info_cuent_link" href="<?= BASE_URL ;?>terceros/administrar_cuenta"      ><span class="configuracion"></span> Administrar Mi Cuenta</a></li>
                 <li><a class="info_cuent_link" href="<?= BASE_URL ;?>terceros/registro"                ><span class="registrar_amigo"></span> Registrar Amigo Bajo mi Código</a></li>
              </ul>
           </li>
          <!-- cerrar secion -->
           <li>
              <a href="<?=BASE_URL ;?>index/Cerrar_Sesion">
                  <span class="exit"></span> Cerrar Sesión
              </a>
          </li>
        </ul>
  </div><!-- FINAL DE INFORMACION SOBRE CUENTAS--  >
<?php endif ;?>

