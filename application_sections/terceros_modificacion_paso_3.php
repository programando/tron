<div class="contenedor_from_3">
	   <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
           <!-- Barra Usuarios -->
            <?php include(APPLICATION_SECTIONS .'barra_usuraios.php') ;?>

            <!-- Formulario -->
            <div class="row" id="cont_direcciones_modificacion">
              <div class="col-lg-12 col-md-12 col-sm-12" >
                 <div class="fila-direcciones"><!-- Direccion -->


                <?php if (Session::Get('cantidad_direcciones') < 3)  :;?>
                  <span>
                        <a href="#venta_editar"
                          class="btn-editar-direccion"
                          iddirecciondespacho   = "0" >

                      </a>
                  </span>
                <?php endif;?>
                <br>
                  <?php
                        $I = 0;
                          foreach($this->Direcciones as $Direccion) {
                            include (APPLICATION_CODS . 'campos_direccion_usuario.php'); // Carga las variables direcciones
                  ;?>
                  <?php include (APPLICATION_SECTIONS . 'carrito_crear_editar_direccion_datos.php');?>
                  <?php };?>
                </div><!-- Direccion -->
              </div>
            </div>

          <!-- Incluir  ventana modal  -->
           <?php include (APPLICATION_SECTIONS . 'carrito_crear_editar_direccion.php');?>
           <?php include (APPLICATION_SECTIONS . 'ventana_mensaje_error.php');?>
          </div>
     </div>
</div>


