        <div class="col-lg-9 col-md-9 col-sm-9"><!--Inicio-Division De la Pagina = Producto -->
          <div class=" col-lg-12"><!--Inicio-Emcabezado-Producto_seleccionado-->

            <?php if (isset($this->nom_categoria )) :?>
                <p class="titulo-productos"><strong><?= $this->nom_categoria ;?></strong></p><!--Titulo-->
            <?php else :?>
               <p class="titulo-productos"><strong>TODOS LOS PRODUCTOS</strong></p><!--Titulo-->
            <?php endif ;?>
            <div class=" well pref-png">
              <div class="text_seleccion_pagina">


                <!--<p class="text-left Productos-Por-Pagina">Productos Por Página</p>Inicio-Select = pagina
              </div>

              <div class="selecion-productos-pagina">
                <select name="selecion-productos-pagina" id="selecion-productos-pagina" value="12">
                  <option value="12"> 12 </option>
                  <option value="24"> 24 </option>
                  <option value="36"> 36 </option>
                </select>
              </div>
-->
            </div>
          </div> <!--Fin-Emcabezado-Producto_seleccionado-->
        </div>
