<!--
    TABS HOGAR - INDUSTRIAl =>  division de la pagina TRON ...
    - Productos-Hogar
    - Productos-Industrial
-->
<!--TABS= Hogar // Industrial -->

<div class="menTipoZonas">

    <a href="<?=BASE_URL ;?>" class="tab-hogar">
    	<div class="tabAll">
            <div class="tabIn t14">
                <span class="glyphicon glyphicon-home" ></span>
                &nbsp; HOGAR Y PERSONAL
            </div>
        </div>
    </a>

    <?php if ( Session::Get('logueado') == TRUE ) :?>
       <a href="<?=BASE_URL ;?>index/industrial" class="tab-industrial">
        	<div class="tabAll">
                <div class="tabIn t14">
                    <span><img src="<?= BASE_IMG_CATEGORIAS_INDEX ;?>industrial.png" class="logo-indusrial"></span>
                    &nbsp; INDUSTRIAL
        		</div>
            </div>
        </a>
        <?php else :?>
          <?php Session::Set('Id_Area_Consulta','1') ;?>
        <a href="#" class="tab-industrial" id ="modal-industrial">
        <div class="tabAll">
            <div class="tabIn t14">
                <span><img src="<?= BASE_IMG_CATEGORIAS_INDEX ;?>industrial.png" class="logo-indusrial"></span>
                &nbsp; INDUSTRIAL
            </div>
        </div>
    </a>
<?php endif ;?>

</div>



<!-- Modal -->
<div class="modal fade" id="myModal-industrial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel"><strong> PRODUCTOS DIRIGIDOS AL SECTOR INDUSTRIAL</strong> </h4>
      </div>
      <div class="modal-body ">
                <div class="text-center">
                     <img   src="<?=BASE_IMG_EMPRESA ;?>alert.png" alt="">
                </div>

            <p>
                Por su concentración y características, pueden requerir asistencia técnica para su uso. Consulte su caso y/o solicite asesoría
                personalizada en contactos@balquimia.com
            </p>
            <br>
            <br>
      </div>
      <div class="modal-footer">
         <a href="<?=BASE_URL ;?>index/industrial" > Cerrar

         </a>
      </div>
    </div>
  </div>
</div>

<!--TABS= Hogar // Industrial -->


