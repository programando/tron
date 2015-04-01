<div class="modal fade" id="recomendar"
      tabindex="-1" role="dialog"
      aria-labelledy="myModallabel"
      aria-hidden="true">
    <div class="modal-dialog">
    	  <div class="modal-content">

           <div class="modal-header encabezado-modal"><!--Emcabezado de la ventana modal -->
           	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--BTN = cerrar ventana modal -->
           	   <h4>Si crees que algún amigo necesita éste producto,<br> ¡ Recomiéndaselo !</h4>
           </div><!--Emcabezado de la ventana modal -->

          <div class="modal-body cuerpo-modal"><!--Cuerpo de la ventana modal -->

              <div class="form-group"><!--Correo amigo -->
              	  <label for="email-amigo">Indícanos el correo electrónico de tu amigo</label>
              	  <input type="text" class="form-control" id="email-amigo" placeholder="Indícanos el correo de tu amigo">
              </div><!--Correo amigo -->

              <div class="form-group"><!--Tu nombre -->
              	  <label for="nombre">Escribe tu nombre para que sepa quién envía el mensaje</label>
              	  <input type="text" class="form-control" id="nombre-quien-envia" placeholder="Ingresa Tu nombre">
              </div><!--Tu nombre -->
              <div class="form-group"><!--TExt-area -->
                  <label for="campo-text">¿Deseas decirle algo más?</label>
                 <textarea class="form-control tex-area" rows="3" id="mensaje-enviado" placeholder="¿Deseas decirle algo más?"></textarea>
              </div><!--TExt-area -->

              <div class="mensaje-error"><!--mensaje error --></div><!--mensaje error -->

            <div class="text-center" id="dv-img-cargando-recomendar-producto">
                <img id="imagen-cargando" src= "<?= BASE_IMG_EMPRESA ;?>cargando.gif" alt="" />
                <br>
            </div>

          </div><!--Cuerpo de la ventana modal -->

          <div class="modal-footer pie-modal"><!--Pie de la ventana modal -->
            <button type="button" class="btn btn-success btn-enviar-modal" id='btn-recomendar-producto'
                    id-producto ='<?=$idproducto ;?>'
                    nombre-imagen ="<?= $nombre_imagen ;?>"  >Enviar</button>
            <button type="button" class="btn btn-default btn-cerrar-modal" data-dismiss="modal">Cerrar</button>
          </div><!--Pie de la ventana modal -->

    	  </div>
    </div>
</div>
