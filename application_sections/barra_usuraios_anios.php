<div class="col-lg-12 col-md-12 col-sm-12">
     <div class="contenedor_barra_usuarion">
      <?php if ( isset($this->Anios)) : ?>
       <div class="divicion_barra_usuario" style="width: 21%;" >
           <div class="row">
               <div class="col-lg-3 padding_none" style="width:135px;">
                   <div class="mis_usuarios">Año de Consulta : </div>
               </div>

               <div class="col-lg-9 padding_none" style="width: 70px; ">
                  <select class="form-control input_campo_datos padding_none" id="anio-consulta">
                    <?php
                    foreach ($this->Anios as $Anios) {
                      echo '<option value="'.$Anios['anio'].'">'.$Anios['anio'].'</option>';
                    }
                    ?>
                  </select>
               </div>
           </div>
      </div>
    <?php endif ;?>

      <?php if ( isset($this->Anios)) : ?>
        <div class="diviion_barra_usuario" style="width: 79%;">
       <?php else :?>
           <div class="divicion_barra_usuario" style="width: 100%;">
       <?php endif ;?>
         <div class="barra-usurarios"><!-- Barraar -->
         <?php $Usuarios  = Session::Get('codigos_usuario') ;?>
         <?php if ( isset($Usuarios) && count($Usuarios ) > 1 )  :?>

           <div class="col-lg-3 col-md-3 col-sm-3 colum-usuarios-rgts"  style=" width: 162px;">
            <div class="mis_usuarios">  Usuarios Registrados: </div>
          </div>

          <div class="col-lg-9 col-md-9 col-sm-9 colum-usurarios padding_none" >
            <div><!-- Cont-Usuarios -->
             <ul class="ul-usuarios">
              <?php $es_primero = TRUE ;?>
              <?php foreach ($Usuarios  as $Usuario) : ;?>
                <li class="usuarios usu-1 li-usuarios"
                    <?php if ( $es_primero == TRUE ) :?>
                          style="background: #003E90; color: white;"
                      <?php endif ;?>
                     <?php  $es_primero  = FALSE ;?>
                    codigousuario            = "<?= $Usuario['codigousuario'] ;?>"
                    idtercero-pedido        = <?= $Usuario['idtercero'] ;?>
                    cantidad-direcciones    = <?= $Usuario['cantidad_direcciones'] ;?>
                    id                      = <?= $Usuario['idtercero'] ;?>

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
</div>


