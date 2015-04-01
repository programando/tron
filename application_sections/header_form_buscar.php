<!-- Input-Buscar-->
<!-- Los estilos de la barra de navegacion en el vista industrial se encentran en el documento CSS => tron-vista-industrial.css // se utilizan las mismas clases -->

<div class="row">
 <div class="col-lg-12">



<!-- /// Barra de busquedad /// -->

          <div class="contenido-input-buscar"><!--Contenedor del slect-inptu-btn -->

             <div class="cont-btn-input">
               <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 columan-input">
                  <input type="text" class="form-control input-buscar" placeholder="Buscar en Red TRON" id="texto-busqueda">
               </div>
             </div>

              <div class="cont-btn-buscar">
                  <button type="button" class="btn-buscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
              </div>

           </div><!--Contenedor del slect-inptu-btn -->

<!-- /// Barra de busquedad /// -->

 <!-- ///  Selección de busquedad /// -->

          <div class="col-lg-12 col-md-12 col-sm-12 col-selec-busquedad">
           <div class="cont-selec-busquedad">
                  <p class="text-label text-label-industrila">Buscar :</p>
                <div class="option-busquedad"><!-- -->
                   <input type="radio" name="tipobusqueda" id="marcas" class="marcas" value="Marca">
                   <label for="marcas" class="text-label text-label-industrila">Marcas</label>
                </div><!-- -->

                <div class="option-busquedad"><!-- -->
                   <input type="radio" name="tipobusqueda" id="nombre-product" class="nombre-product" value="Producto">
                   <label for="nombre-product" class="text-label text-label-industrila">Nombre Producto</label>
                </div><!-- -->

                <div class="option-busquedad"><!-- -->
                   <input type="radio" name="tipobusqueda" checked="checked" id="palabra-clave" class="palabra-clave" value="Palabra">
                   <label for="palabra-clave" class="text-label text-label-industrila"  >Palabra Clave</label>
                </div><!-- -->

           </div>
         </div>

<!-- ///  Selección de busquedad /// -->

</div>
</div>

