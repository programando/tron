<div class="">
    <div class="contenedor_barra_usuarion">
        <div class="barra-usurarios"><!-- Barraar -->
        
			<?php $Usuarios  = Session::Get('codigos_usuario') ;?>
            <?php if(isset($Usuarios) && count($Usuarios ) > 1 )  :?>
            
                <div class="col-sm-3 col-xs-12 vcenter">
                	<div class="mis_usuarios"> Mis Usuarios Registrados: </div>
                </div><!--
                
                --><div class="col-sm-9 col-xs-12 vcenter">
                <div><!-- Cont-Usuarios -->
                    <ul class="ul-usuarios">
						<?php $es_primero = TRUE ;?>
							<?php foreach ($Usuarios  as $Usuario) : ;?>
                                <li class="usuarios usu-1 li-usuarios"
									<?php if ( $es_primero == TRUE ) :?>
                                    style="background:#003E90; color:white;"                
                                    <?php endif ;?>
                                    <?php  $es_primero  = FALSE ;?>
                                    codigousuario            = "<?= $Usuario['codigousuario'] ;?>"
                                    idtercero-pedido        = <?= $Usuario['idtercero'] ;?>
                                    cantidad-direcciones    = <?= $Usuario['cantidad_direcciones'] ;?>
                                    id = <?= $Usuario['idtercero'] ;?>
                                >
                                	<?= $Usuario['codigousuario'] ;?>
                                </li><!-- Usuario -->
                            <?php endforeach ;?>
                        <?php endif;?>                    
                    </ul>
            	</div>
        
        </div><!-- Barraar -->
    </div>
</div>

