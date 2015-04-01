<div class="panel">
  <div class="panel-heading  cabezera-panel">
    <h4 class="panel-title">
      <a class="marcas" data-toggle="collapse" data-parent="#accordion" href="#two">MARCAS</a>
    </h4>
  </div>
  <div id="two" class="panel-collapse collapse">
    <div class="panel-body">
      <nav>
        <ul class="nav">
              <?php
              foreach ($this->Productos_Marcas  as $Marcas)
              {
                $idmarca   = $Marcas['idmarca'];   // id de la marca
                $nom_marca = String_Functions::Formato_Texto($Marcas['nom_marca']);   // Nombre de la marca
                $cantidad  = $Marcas['cantidad'];   // Nombre de la marca
                ?>
                <li>
                  <a class="lista-marcas" nom-marca="<?=$nom_marca ;?>" id-marca="<?=$idmarca  ;?>">
                      <?= $nom_marca . ' ( ' . $cantidad . ' )' ?>
                  </a>
                </li>
                <?php };?>
        </ul>
      </nav>
    </div>
  </div>
</div>
