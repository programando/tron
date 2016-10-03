
<div class="t12">

    <table class="table table-condenced table-hover">

        <thead><!--Emcabezado -->
            <tr>
                <th class="t18">BENEFICIOS</th>
                <th class="text-center">
                    <a class="nuvv" title="
                    <img src='<?= BASE_IMG_EMPRESA ;?>img_tooltips1.png' style='float:left; margin:0 20px 10px 0' /> <br />
                    Para aquellas personas que aún no han descubierto los beneficios de consumir los productos TRON.
                    <br style='clear:both;' /> ">
                        <span class="aS colurAd">
                            PLAN COMPRADOR<br />OCASIONAL
                        </span>
                    </a>
                </th>

                <th class="text-center">
                    <a class="nuvv" title="
                    <img src='<?= BASE_IMG_EMPRESA ;?>img_tooltips2.png' style='float:left; margin:0 20px 10px 0' />
                    Para aquellas personas que se quieren beneficiar de lo que brinda TRON pero aún no han comprendido la facilidad con que podrían recibir ingresos adicionales. ">
                        <span class="aS colurAd">
                            PLAN CLIENTE<br />TRON
                        </span>
                    </a>
                </th>
                <th class="text-center">
                    <a class="nuvv" title="
                    <img src='<?= BASE_IMG_EMPRESA ;?>img_tooltips3.png' style='float:left; margin:0 20px 10px 0' />
                    Para aquellas personas que quieren beneficiarse de TODO lo que brinda TRON y desea compartirlo con sus familiares y amigos.
                    <br style='clear:both;' /> ">
                        <span class="aS colurAd">
                            PLAN EMPRESARIO<br />TRON
                        </span>
                    </a>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <a class="nuvv cP" title="
                        Beneficio que adquieren aquellas personas que consumen mensualmente los productos TRON de aseo y desinfección para el hogar o los productos de la línea industrial
                        fabricados por BALQUIMIA S.A.S. ">
                        <span class="aS colurAd">PRECIOS ESPECIALES PARA AMIGOS TRON</span>
                    </a>
                </td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
            </tr>

            <tr>
                <td>INVITACIÓN A CAPACITACIONES Y EVENTOS SOBRE EL MODELO DE NEGOCIO</td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
            </tr>



            <tr>
                <td>CÓDIGO DE USUARIO PARA INVITAR AMIGO A TU RED</td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
            </tr>

            <tr>
                <td>
                    <a class="nuvv cP" title="
                        Sobre las compras de las personas que ingreses a la red y las que ellos ingresen hasta por 6 niveles.">
                        <span class="aS colurAd">COMISIONES</span>
                    </a>
                </td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
            </tr>


            <tr>
                <td>ACCESO A INFORMES ADMINISTRATIVOS SOBRE EL DESEMPEÑO A TU RED</td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>negativo-rojo.png "></td>
                <td class="text-center"><img src="<?= BASE_IMG_TIENDA ;?>positivo-verde.png "></td>
            </tr>

            <tr>
                <td class="text-right">
                    Valor del kit de inicio <strong><small>( Calculado para Cali )</small></strong>:
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">
                    $<?= number_format(Session::Get('valor_kit_inicio_ocasional'),0) ;?>
                </td>
                <td class="text-center">
                    $<?= number_format(Session::Get('valor_kit_inicio_empresario'),0) ;?>
                </td>
            </tr>

            <tr>
                <td class="text-right"><strong>TOTAL A PAGAR <small> ( Calculado para Cali ) : </small></strong> </td>
                <td class="text-center">.</td>
                <td class="text-center">$ <?= number_format( Session::Get('valor_kit_inicio_ocasional'),0) ;?> </td>
                <td class="text-center">$ <?= number_format( Session::Get('valor_kit_inicio_empresario'),0) ;?> </td>
            </tr>

            <tr>
                <td class="text-right" style="vertical-align:middle;"><strong>REGISTRARME EN EL PLAN:</strong></td>
                <td class="text-center">
                    <button type="button" id="btn_plan1"  idplan ="1" class="btn-registrar-en-plan btn btn-danger t16">
                        COMPRADOR<br />OCASIONAL
                    </button>
                </td>
                <td class="text-center">
                    <button type="button" id="btn_plan2"  idplan ="2"  class="btn-registrar-en-plan btn btn-danger t16">
                        CLIENTE<br>TRON
                    </button>
                </td>
                <td class="text-center">
                    <button type="button" id="btn_plan3"  idplan ="3"  class="btn-registrar-en-plan btn btn-danger t16">
                        EMPRESARIO<br>TRON
                    </button>
                </td>
            </tr>

        </tbody>

    </table>

</div>


