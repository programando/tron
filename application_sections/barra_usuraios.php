         <!-- /// Barra de usuario /// -->
               <div class="col-lg-12 col-md-12 col-sm-12">
                 <div class="barra-usurarios"><!-- Barraar -->

                   <div class="col-lg-3 col-md-3 col-sm-3 colum-usuarios-rgts" style="width: 200px">
                 	      <div class="mis_usuarios"> Mis Usuarios Registrados: </div>
                   </div>

                   <div class="col-lg-9 col-md-9 col-sm-9 colum-usurarios">
                 	    <div><!-- Cont-Usuarios -->
                           <ul class="ul-usuarios">
                            <?php
                                $Usuarios  = Session::Get('codigos_usuario');
                                foreach ($Usuarios  as $Usuario) : ;?>
                            	  <li class="usuarios usu-1 li-usuarios"
                                    idtercero-pedido = <?= $Usuario['idtercero'] ;?>
                                    id = <?= $Usuario['idtercero'] ;?>
                                >
                                <?= $Usuario['codigousuario'] ;?> </li><!-- Usuario -->
                 	    	     <?php endforeach ;?>
                           </ul>
                 	    </div>
                   </div>

                 </div><!-- Barraar -->
                </div>
         <!-- /// Barra de usuario /// -->
