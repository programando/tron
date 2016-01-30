<!-- Ventana modal convenio comercial -->
<?php
     $texto_convenio_comercial =  file_get_contents(BASE_PDFS.'convenio_comercial.php','r');
?>
<div>
    <div class="modal fade" id="convenio_comercial_modal" tabindex="-1" role="dialog" aria-labelledby="convenio_comercial_modal" aria-hidden="true">
        <div class="modal-dialog" style="width: 1100px; display: block; left: 10px; top: 0px;">
            <div class="modal-content">
             <div class="modal-body">
              <!-- Cuerpo -->
              <div class="contenedor_convenio" style="display: block; width: 100%; margin: 0px auto; height: 490px; overflow: auto; position: relative; background: white; ">
              <div style="padding: 0px 60px; width:100%; text-align:justify; font-size: 17px;">
              <!-- Titulo -->
              <div>
                 <h4 class="text-center"><strong><em>CONVENIO COMERCIAL DE LA RED DE AMIGOS TRON DE BALQUIMIA S.A.S.</em></strong></h4 style="fint">
              </div>
                 <?= $texto_convenio_comercial ;?>

              </div>
              </div>
            </div>
             <div  class="modal-footer">
                <div>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrar_moda_convenio_comercial">Cerrar</button>
                </div>
             </div>

            </div>
        </div>
    </div>
</div>
