<div class=" col-lg-12 col-md-12 col-sm-12">

       <div class="divicion_barra_usuario" style="width: 30%;">
           <div class="row">
               <div class="col-lg-3" style="width:155px; padding-left: 0px; padding-right: 0px;">
                   <div class="mis_usuarios">Año de Consulta : </div>
               </div>

               <div class="col-lg-9" style="width: 110px; padding-left: 0px; padding-right: 0px;">
                  <select class="form-control input_campo_datos" id="anio-consulta" style=" padding-left: 0px;">
                    <?php
                    foreach ($this->Anios as $Anios) {
                      echo '<option value="'.$Anios['anio'].'">'.$Anios['anio'].'</option>';
                    }
                    ?>
                  </select>
               </div>
           </div>
      </div>

      <div class="divicion_barra_usuario" style="width: 70%;">
         <div class="barra-usurarios"><!-- Barraar -->
         <?php $Usuarios  = Session::Get('codigos_usuario') ;?>
         <?php if ( isset($Usuarios) && count($Usuarios ) > 1 )  :?>

           <div class="col-lg-3 col-md-3 col-sm-3 colum-usuarios-rgts" >
            <div class="mis_usuarios">  Usuarios Registrados: </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-9 colum-usurarios" style=" padding: 0px;">
            <div><!-- Cont-Usuarios -->
             <ul class="ul-usuarios">
              <?php $es_primero = TRUE ;?>
              <?php foreach ($Usuarios  as $Usuario) : ;?>
                <li class="usuarios usu-1 li-usuarios"
                    <?php if ( $es_primero == TRUE ) :?>
                          style="background: #003E90; color: white;"
                      <?php endif ;?>
                     <?php  $es_primero  = FALSE ;?>

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
</div>

<style>
  .divicion_barra_usuario
  {
      float: left;


  }
</style>
