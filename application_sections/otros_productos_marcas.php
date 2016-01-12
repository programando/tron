<div class="lateralion">
    <div class="panel"><!--aqui va el panel-default = el color del panel -->
        <div class="panel-heading">
            <div class="panel-title colorBlue">
               <a class="t16" data-toggle="collapse" data-parent="#accordion" href="#two">Marcas</a>
            </div>
        </div>

        <div id="two" class="panel-collapse collapse in">
            <div class="panel-body">
                <nav>
                    <ul class="nav">
                        <?php
                        foreach ($this->Productos_Marcas  as $Marcas) {
                            $idmarca   = $Marcas['idmarca'];   // id de la marca
                            $nom_marca = String_Functions::Formato_Texto($Marcas['nom_marca']);   // Nombre de la marca
                            $cantidad  = $Marcas['cantidad'];   // Nombre de la marca
                        ?>
                            <li>
                                <a class="lista-marcas cP t14" nom-marca="<?=$nom_marca ;?>" id-marca="<?=$idmarca  ;?>">
                                    <span class="cantti t10 rr10"><?= $cantidad; ?></span>
									<?= ucwords(strtolower($nom_marca)); ?>
                                    <br style="clear:both;" />
                                </a>
                            </li>
                        <?php };?>
                    </ul>
                </nav>
            </div>
        </div>
	</div>
</div>