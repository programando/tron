<?php if ( $this->idtipo_plan_compras == 3 ) :?>
    <div class="li_pasos_registro colorfff cP" id="mi-perfil" style="background-color:#003E90;">
        <span class="ff2 mb5 dB t20">Mi Perfil</span>
        <span class="ff1 onlyPCBoo">
            Información Personal,  recomendar modelo de negocio, mi plan actual.
        </span>
    </div>
<?php else :?>
    <div class="li_pasos_registro colorfff cP" id="mi-perfil" style="background-color:#003E90;">
        <span class="ff2 mb5 dB t20">Mi Perfil</span>
        <span class="ff1 onlyPCBoo">
            Plan actual, Información Personal.
        </span>
    </div>
<?php endif ;?>

<?php if (  Session::Get('email')  == 'organizacionsmart@gmail.com') :?>
    <?php if ( $this->idtipo_plan_compras == 3 ) :?>
        <div class="li_pasos_registro colorfff cP" id="informes_comisiones">
            <span class="ff2 mb5 dB t20">Comisiones</span>
            <span class="ff1 onlyPCBoo">
                Comisiones actuales y las que ya se han pagado
            </span>
        </div>

    <?php endif ;?>
<?php endif ;?>

<?php if ( $this->idtipo_plan_compras == 3 ) :?>
    <div class="li_pasos_registro colorfff cP" id="informes_pedidos">
        <span class="ff2 mb5 dB t20">Pedidos e Informes</span>
        <span class="ff1 onlyPCBoo">
            Pedidos realizados, estado de mis cuentas e informes de la actividad de los integrantes de mi red.
        </span>
    </div>
<?php else :?>
    <div class="li_pasos_registro colorfff cP" id="informes_pedidos">
        <span class="ff2 mb5 dB t20">Pedidos</span>
        <span class="ff1 onlyPCBoo">
        Pedidos realizados y estado de cuenta.
        </span>
    </div>
<?php endif ;?>

<div class="li_pasos_registro colorfff cP" id="favoritos">
    <span class="ff2 mb5 dB t20">Favoritos</span>
    <span class="ff1 onlyPCBoo">
        Acceso rápido a mis productos favoritos.
    </span>
</div>

<div class="onlySmartBoo"><br style="clear:both;" /></div>


