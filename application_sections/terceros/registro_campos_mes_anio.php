<div id="mes-anio">
              <div class="form-group ">
                <div class="row">
                  <label for="dianacimiento" class="col-lg-4 control-label">Día de nacimiento :</label>
                  <div>

                    <div class="col-lg-3">
                      <select  class="form-control" id="dianacimiento" value="0">
                          <option value="<?= $this->dianacimiento ;?>"><?= $this->dianacimiento  ;?></option>
                        <?php for( $i=1; $i<=31; $i++) : ;?>
                          <option value="<?= $i ;?>"><?= $i ;?></option>
                        <?php endfor ;?>
                      </select>
                    </div>
                    <label for="mesnacimiento" class="col-lg-2 control-label">Mes :</label>
                    <div class="col-lg-3">
                      <select  class="form-control " id="mesnacimiento" tabindex="4" value="0">
                        <option value="<?= $this->mesnacimiento ;?>"><?= $this->nom_mes ;?></option>

                        <option value="1">ENERO</option>
                        <option value="2">FEBRERO</option>
                        <option value="3">MARZO</option>
                        <option value="4">ABRIL</option>
                        <option value="5">MAYO</option>
                        <option value="6">JUNIO</option>
                        <option value="7">JULIO</option>
                        <option value="8">AGOSTO</option>
                        <option value="9">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>

                      </select>
                    </div>
                  </div>
                </div>

              </div>
            </div>
