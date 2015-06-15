  <div class="col-lg-12 col-md-12 col-sm-12">
   <div class="barra-usurarios"><!-- Barraar -->
   <?php $Usuarios  = Session::Get('codigos_usuario') ;?>
   <?php if ( isset($Usuarios) && count($Usuarios ) > 0 )  :?>

     <div class="col-lg-3 col-md-3 col-sm-3 colum-usuarios-rgts" style="width: 200px">
      <div class="mis_usuarios"> Mis Usuarios Registrados: </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-9 colum-usurarios">
      <div><!-- Cont-Usuarios -->
       <ul class="ul-usuarios">
        <?php
        foreach ($Usuarios  as $Usuario) : ;?>
          <li class="usuarios usu-1 li-usuarios"
              idtercero-pedido        = <?= $Usuario['idtercero'] ;?>
              cantidad-direcciones    = <?= $Usuario['cantidad_direcciones'] ;?>
              id = <?= $Usuario['idtercero'] ;?>
        >
        <?= $Usuario['codigousuario'] ;?> </li><!-- Usuario -->
      <?php endforeach ;?>
    <?php endif;?>
    </ul>
  </div>
</div>

</div><!-- Barraar -->
</div>
