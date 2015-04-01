
<div class="panel"><!--aqui va el panel-default = el color del panel -->
    <div class="panel-heading  cabezera-panel">
      <h4 class="panel-title">
           <a  class="categorias" data-toggle="collapse" data-parent="#accordion" href="#one">CATEGORÍAS</a>
      </h4>
    </div>
    <div id="one" class="panel-collapse collapse in"> <!-- collapse in -->
            <div class="panel-body">
                <ul class="nav" >
                  <?php foreach ($this->Productos_Categorias_Nv_1  as $Categorias_Nv_1)
                    {
                      $orden_nivel_1 = String_Functions::Formato_Texto($Categorias_Nv_1['orden_nivel_1']);
                      $idorden_nv_1  = $Categorias_Nv_1['idorden_nv_1'];   // Id del menu
                      $nombre_clase  = 'orden_nivel_'.$idorden_nv_1 ;
                    ?>
                     <li>
                        <a  class="lista-productos" id="btn-1" data-toggle="collapse"
                            data-target="#<?=  $nombre_clase ; ?>"
                            id-categoria ="<?= $idorden_nv_1 ; ?>"
                            nombre-categoria=" <?= $orden_nivel_1 ;?> "
                            aria-expanded="false"><?= $orden_nivel_1  ;?>
                        </a>
                      </li>
                      <ul class="nav collapse " id="<?= $nombre_clase; ?>" role="menu" aria-labelledby="btn-1">
                          <?php
                            foreach($this->Productos_Categorias_Nv_2  as $Categorias_Nv_2)
                            {
                              $idorden_nv_1_en_nv_2 = $Categorias_Nv_2['idorden_menu_nivel_1']; // Campo que relaciona Categoria y subcategoria
                              $orden_nivel_2        = String_Functions::Formato_Texto($Categorias_Nv_2['orden_nivel_2']) ;
                              $orden_nivel_2        = $orden_nivel_2  .' (' . $Categorias_Nv_2['cantidad'] . ')';

                              $idorden_nv_2         = $Categorias_Nv_2['idorden_nv_2'] ;
                              if ( $idorden_nv_1 == $idorden_nv_1_en_nv_2) {
                          ?>
                            <li>
                                <a  class="sub-lista-productos"
                                    nombre-subcategoria ="<?=$orden_nivel_2 ?> "
                                    id-subcategoria="<?=  $idorden_nv_2 ;?>"
                                  > &nbsp;&nbsp;&nbsp; <?=$orden_nivel_2 ?>
                                </a>
                            </li>
                          <?php }};?> <!-- $this->Productos_Categorias_Nv_2  -->
                       </ul>
                 <?php };?>  <!-- Fin Ciclo $this->Productos_Categorias_Nv_1  -->
                </ul>
            </div> <!-- Fin  class="panel-body" -->
     </div> <!-- id="one" class="panel-collapse collapse in"> -->
</div>



