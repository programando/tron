<div class="latInfo">
    <div class="panel"><!--aqui va el panel-default = el color del panel -->
        <div class="panel-heading">
            <div class="panel-title colorBlue">
               <a class="t16" data-toggle="collapse" data-parent="#accordion" href="#fiveMen">Tienda TRON</a>
            </div>
        </div>

        <div id="fiveMen" class="panel-collapse collapse <?php if($ml2 == true) echo "in";?>">
            <div class="panel-body">
                <nav>
                    <ul class="nav">

                        <li>
                            <a href="<?= BASE_URL ;?>redtron/planes_registro" class="cP t14">
                                <div class="tab">
                                    <div class="tab30 p5"><img src="<?= BASE_IMG_TIENDA ;?>planesC.png" /></div>
                                    <div class="tab70 p5">Planes de Registro</div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ;?>redtron/tron_medios_pago" class="cP t14">
                                <div class="tab">
                                    <div class="tab30 p5"><img src="<?= BASE_IMG_TIENDA ;?>pagosC.png" /></div>
                                    <div class="tab70 p5">Medios de Pago</div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ;?>redtron/funcionalidades_interesantes" class="cP t14">
                                <div class="tab">
                                    <div class="tab30 p5"><img src="<?= BASE_IMG_TIENDA ;?>interesantesC.png" /></div>
                                    <div class="tab70 p5">Funcionalidades interesantes</div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ;?>redtron/tron_transporte" class="cP t14">
                                <div class="tab">
                                    <div class="tab30 p5"><img src="<?= BASE_IMG_TIENDA ;?>transporteC.png" /></div>
                                    <div class="tab70 p5">Transporte</div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
