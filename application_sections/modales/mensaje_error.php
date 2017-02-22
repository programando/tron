<!-- ventana modal :: ! atencion ¡ las compras deben ser mayor a 20.000 pesos -->
 <div   class           ="modal  fade"
        id              ="modal_error"
        tabindex        ="-1" role="dialog"
        aria-labelledby ="ver_modalLabel"
        aria-hidden     ="true"
        data-backdrop   ="static"
        data-keyboard   ="false"
        >
  <div class="modal-dialog">
   	  <div class="modal-content">
       <!-- header -->
       <div class="modal-header text-center">
       <!-- Boton de cierre en el lado derecho      -->
        <!--  <button type="button"  class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> </button> -->
          <strong><h4 id="contenido" >¡ ERROR AL INGRESAR AL SISTEMA !</h4></strong>
       </div>

       <!-- body -->
       <div class="modal-body text-aligment">
          <div id="contenido">
                El correo electrónico y la contraseña no pudieron ser validados en nuestro sistema.<br>
                <br>Confirme y registre nuevamente sus datos.
          </div>
       </div>

    <?php
      $Redirect           = Session::Get('Redirect');
      $UrlRedirect        = Session::Get('UrlRedirect');
      $BtnCaptionRedirect = Session::Get('BtnCaptionRedirect');
      ?>
       <div class="modal-footer">
            <?php if ( !isset( $Redirect )) :?>
              <button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <?php else :?>
            <a href= "<?= $UrlRedirect ;?>" class="btn btn-info" role="button"><?= $BtnCaptionRedirect  ;?></a>
          <?php endif ;?>
       </div>

   	  </div>
   </div>
</div>
