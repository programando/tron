<div class="modal fade" id="recomendar"
      tabindex="-1" role="dialog"
      aria-labelledy="myModallabel"
      aria-hidden="true">
    <div class="modal-dialog">
    	  <div class="modal-content">

           <div class="modal-header encabezado-modal"><!--Emcabezado de la ventana modal -->
           	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--BTN = cerrar ventana modal -->
           	   <h4>Si crees que algún amig@ puede estar interesad@ en <br> este producto ¡ RECOMIENDASELO !</h4>
           </div><!--Emcabezado de la ventana modal -->

          <div class="modal-body cuerpo-modal"><!--Cuerpo de la ventana modal -->
             <div class="row">
              <form class="form-horizontal">
              <div class="form-group"><!-- nombre amigo -->
                  <label for="nombre_amigo" class="col-lg-6 control-label"><p class="text-left">Nombre de tu amig@ :</p></label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" id="nombre_amigo">
                  </div>
              </div><!-- nombre amigo -->

              <div class="form-group"><!--Correo amigo -->
              	  <label for="email-amigo" class="col-lg-6 control-label"><p class="text-left">correo electrónico :</p></label>
                  <div class="col-lg-6">
              	   <input type="text" class="form-control" id="email-amigo">
                  </div>
              </div><!--Correo amigo -->

              <div class="form-group"><!--Tu nombre -->
              	  <label for="nombre" class="col-lg-6 control-label"><p class="text-left">Nombre de quien envia esta recomendacion :</p></label>
                  <div class="col-lg-6">
              	    <input type="text" class="form-control" id="nombre-quien-envia">
                  </div>
              </div><!--Tu nombre -->
              <div class="form-group"><!--TExt-area -->
                  <label for="campo-text" class="col-lg-6 control-label"><p class="text-left">Mensaje adicional (opcional) :</p></label>
                  <div class="col-lg-6">
                    <textarea class="form-control tex-area" rows="3" id="mensaje-enviado"></textarea>
                  </div>
              </div><!--TExt-area -->

              <div class="mensaje-error"><!--mensaje error --></div><!--mensaje error -->

            <div class="text-center" id="dv-img-cargando-recomendar-producto">
                <img id="imagen-cargando" src= "<?= BASE_IMG_EMPRESA ;?>cargando.gif" alt="" />
                <br>
            </div>
          </form>
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
