
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
 <?php if (Session::Get('autenticado')== TRUE ) :?>
  <div class="row"  id="personal"><!-- INFORMACION SOBRE CUENTAS-->
    <ul class="list-unstyled cont-mi-cuenta">
         <!-- bienvenido -->
         <li>
            <a  href="#" class="bienvenido_usuario  bienvenido_industrial" id="bienvenido_usuario">
                <strong>Bienvenido: </strong> <?= ucfirst(strtolower(( Session::Get('nombre_usuario_pedido')))) ;?>
            </a>
         </li>

       <!-- Mi cuenta -->
        <li>
          <a href="<?= BASE_URL ;?>terceros/administrar_cuenta">
            / <span class="glyphicon glyphicon-user"></span> Mi Cuenta
          </a>
        </li>

       <!-- Registrar Amigo -->
        <li>
           <a href="<?= BASE_URL ;?>terceros/registro">
             / <span class="registrar_amigo"></span> Registrar Amigo bajo mi Código
           </a>
        </li>

        <!-- cerrar secion -->
         <li>
            <a href="<?=BASE_URL ;?>index/Cerrar_Sesion">
                / <span class="exit"></span> Cerrar Sesión
            </a>
        </li>
      </ul>
  </div><!-- FINAL DE INFORMACION SOBRE CUENTAS--  >
<?php endif ;?>

