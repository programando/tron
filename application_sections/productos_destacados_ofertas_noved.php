
<div  name="destacados">  </div>


<?php if (isset($this->Productos_Destacados_Index) and count($this->Productos_Destacados_Index )) :?>
 <section >
  <div class="">
   <div class="col-lg-12">
     <h3   id="destacados"><strong>DESTACADOS</strong></h3>
   </div>
 </div>
</section>

<!-- INICIO SECCION DESTACADOS -/////////////////////////////////////////////////////////////////////////////////  -->
<section>
  <div class="contenido">
   <div class="row">
     <!-- INFORMACION DEL PRODUCTO -->
     <?php
     foreach ($this->Productos_Destacados_Index as $Productos)
     {
                include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                $mostrar_imagen_varias_referencias=true;
                ?>
                <div class="col-lg-2  col-md-2 col-sm-2  col-xs-2"  id="articulos">
                 <?php include (APPLICATION_SECTIONS . 'productos_listado.php');?>
               </div><!-- FINAL COLUMNAS -->

               <?php }?>
             </div><!-- FINAL ROW -->
           </div><!-- FINAL CONTAINER-->
         </section><!-- FINAL SECCION DESTACADOS -->
       <?php endif?>


       <?php if (isset($this->Productos_Ofertas_Index) and count($this->Productos_Ofertas_Index)>0) :?>
        <!-- INICIO SECCION OFERTAS -////////////////////////////////////////////////////////////////////////////  -->

          <div class="">
           <div class="col-lg-12">
             <h3 id="ofertas"><strong>OFERTAS</strong></h3>
           </div>
         </div>



       <div  name="ofertas">  </div>

       <section>
        <div class="contenido">
         <div class="row">
           <!-- INFORMACION DEL PRODUCTO -> OFERTAS-->
           <?php
           foreach ($this->Productos_Ofertas_Index as $Productos)
           {
                 $mostrar_imagen_varias_referencias=true;
                 include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                 ?>
                 <div class="col-lg-2  col-md-2 col-sm-2  col-xs-2"  id="articulos">
                  <?php include (APPLICATION_SECTIONS .'productos_listado.php');?>
                </div><!-- FINAL COLUMNAS -->
                <?php }?>
              </div><!-- FINAL ROW -->
            </div><!-- FINAL CONTAINER-->
          </section><!-- FINAL SECCION OFERTAS -->

        <?php endif ;?>


        <!-- INICIO SECCION NOVEDADES -////////////////////////////////////////////////////////////////////////////  -->


        <!-- INICIO SECCION NOVEDADES -////////////////////////////////////////////////////////////////////////////  -->
        <?php if (isset($this->Productos_Novedades_Index) and count($this->Productos_Novedades_Index)>0) : ?>
          <section>
            <div class="">
             <div class="col-lg-12">
               <h3 id="novedades"><strong>NOVEDADES</strong></h3>
             </div>
           </div>
         </section>

         <section>
          <div class="contenido">
           <div class="row">
             <!-- INFORMACION DEL PRODUCTO -> NOVEDADES-->
             <?php
             foreach ($this->Productos_Novedades_Index as $Productos)
             {
                 $mostrar_imagen_varias_referencias=true;
                 include (APPLICATION_CODS . 'campos_productos.php'); // Carga las variables de
                 ?>
                 <div class="col-lg-2  col-md-2 col-sm-2  col-xs-2"  id="articulos">
                  <?php include (APPLICATION_SECTIONS .'productos_listado.php');?>
                </div><!-- FINAL COLUMNAS -->
                <?php }?>
              </div>    <!-- FINAL ROW -->
            </div>           <!-- FINAL CONTAINER-->
          </section>           <!-- FINAL SECCION NOVEDADES -->

        <?php endif ;?>
        <!--FIN-NOVEDADES///////////////////////////////////////////////////////////////////////////////////////////////////////////-->



    <br>
    <br>
    <br>
