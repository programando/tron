<?php

		class ProductosTronController extends Controller
		{

		    private $Cantidad_Registros;
		    public function __construct()
		    {
		        parent::__construct();
		        $this->Fletes         = $this->Load_Controller('Fletes');


		    }

		    public function index(){}


		    public function Hallar_Precio_Especial($parametros, $datos=array()){
		    	/** MAYO 17 DE 2015
		    	 * 				HALLAR EL PRECIO ESPECIAL DE PRODUCTOS TRON, DECUENTO Y EL PRECIO UNITARIO POR CADA UNA DE LAS CATEGORIAS
		    	 */
		    		Session::Set('REDETRANS_COURRIER_VR_FLETE', 0);
									$idmcipio                            = Session::Get('idmcipio');
									$iddpto                              = Session::Get('iddpto');
									$re_expedicion                       = Session::Get('re_expedicion');

									$py_porciento_recaudo                = $parametros[0]['py_porciento_recaudo'] / 100 ;
									$py_vr_min_recaudo                   = $parametros[0]['py_vr_min_recaudo'];
									$py_vr_adicional                     = $parametros[0]['py_vr_adicional'];

									$costofijo                           = $parametros[0]['costofijo'];
									$correctorvariacion                  = $parametros[0]['correctorvariacion'] / 100 ;

									$dscto_precio_mercado_1_ropa         = $parametros[0]['dscto_precio_mercado_1_ropa'] / 100 ;
									$dscto_precio_mercado_2_banios       = $parametros[0]['dscto_precio_mercado_2_banos'] / 100 ;
									$dscto_precio_mercado_3_pisos        = $parametros[0]['dscto_precio_mercado_3_pisos'] / 100 ;
									$dscto_precio_mercado_4_loza         = $parametros[0]['dscto_precio_mercado_4_loza'] / 100 ;


									$valor_minimo_pedido_productos       = $parametros[0]['valor_minimo_pedido_productos'];
									//VALORES PARA FLETES Y PRESUPUESTO DE FLETES
									Session::Set('rt_courrier_seguro'                                   ,   $parametros[0]['rt_courrier_seguro']);
									Session::Set('rt_courrier_porciento_seguro_minimo'                  ,   $parametros[0]['rt_courrier_porciento_seguro_minimo']/100 );
									Session::Set('factor_vr_declarado_productos_tron'                   ,   $parametros[0]['factor_vr_declarado_productos_tron']);
         Session::Set('valor_minimo_aplicar_vr_declarado_productos_tron'     ,   $parametros[0]['valor_minimo_aplicar_vr_declarado_productos_tron']);

									$subsidio_flete_valle                = 0;
									$descuento_mercado_porcentaje_ropa   = 0;
									$descuento_mercado_porcentaje_banios = 0 ;
									$descuento_mercado_porcentaje_pisos  = 0 ;
									$descuento_mercado_porcentaje_loza   = 0 ;

									extract($datos);
											$Peso_Total         = $Peso_Ropa  								+ $Peso_Banios  							 + $Peso_Pisos  						  + $Peso_Loza ;
											$Costo_Total        = $Cmv_Ropa 										+ $Cmv_Banios 									 + $Cmv_Pisos		 								+ $Cmv_Loza	 ;
											$Precio_Lista_Total = $Precio_Lista_Ropa  + $Precio_Lista_Banios 	+ $Precio_Lista_Pisos 	+ $Precio_Lista_Loza;


										$this->Fletes->Redetrans_Courrier($Peso_Total,$iddpto , $Vr_Declarado_ProdTron  );
										$Flete_Real           = Session::Get('REDETRANS_COURRIER_VR_FLETE') - Session::Get('REDETRANS_COURRIER_VR_SEGURO');

										// ENERO 14. 2016
										// EL 32 Y EL CERO (0), EN LA LLAMADA AL MÉTODO, CORRESPONDEN A VALLE Y A NO REEXPEDIDION
										$this->Fletes->Redetrans_Courrier($Peso_Total,$iddpto , $Vr_Declarado_ProdTron, 32, 0  );

										//$subsidio_flete_valle = Session::Get('subsisio_flete_valle');
										$subsidio_flete_valle = Session::Get('REDETRANS_COURRIER_VR_FLETE');

										$formula_a =  $Costo_Total  +  $costofijo  + $py_vr_adicional  + $Flete_Real + ($py_porciento_recaudo * $Flete_Real );
										$formula_a = $formula_a / ( $correctorvariacion - ( $py_porciento_recaudo * ( 1 + $parametros[0]['iva'] / 100 )  ));


											$formula_b = $Costo_Total  +  $costofijo +  $py_vr_min_recaudo + $py_vr_adicional + $Flete_Real ;
											$formula_b =  $formula_b  / $correctorvariacion;

											$precio_especial = $formula_a ;
											$formula_elegida = $formula_a ;
											if ( $formula_b > 	$formula_a){
															$precio_especial = $formula_b ;
													  $formula_elegida = $formula_b ;
											}

											if (	$precio_especial >  $Precio_Lista_Total ){
														$precio_especial = $Precio_Lista_Total;
											}

											$precio_especial 			= $precio_especial  * ( 1 + $parametros[0]['iva'] / 100 ) + $Flete_Real ;
											$precio_especial_temp = $precio_especial ;
											$Por100_Precio_Lista  = $Precio_Lista_Total  * ( 1-60/100);
											$Res =0;
											if ($Por100_Precio_Lista > $precio_especial  ){
													$Res = $Por100_Precio_Lista;
											}else{
													$Res = $precio_especial ;
											}
											if (  $precio_especial  < $Precio_Lista_Total ){
														$precio_especial  = $Res;
											}else{
													$precio_especial  = $Precio_Lista_Total;
											}

											$descuento_especial = $Precio_Lista_Total  - $precio_especial ;
											if ( $descuento_especial < 0 ) { $descuento_especial = $descuento_especial * -1 ;}

											$descuento_especial_porciento = $descuento_especial / $Precio_Lista_Total  * 100;
											$descuento_especial_porciento = round($descuento_especial_porciento,2);


											// *	10. HALLAR DESCUENTO NEGATIVO PARA ENCONTRAR EL TRANSPORTE
											$descuento_negativo = 0 ;
											if  ( $Precio_Lista_Total = $precio_especial){
															$descuento_negativo = 	$precio_especial_temp - $Precio_Lista_Total;
											}
											//*	11.	HALLAR EL VALOR DE TRANSPORTE
											$transporte_tron = $Flete_Real - $subsidio_flete_valle + $descuento_negativo ;


											//12.	VALOR TOTAL A PAGAR POR EL PEDIDO
											$valor_pedido_tron = $precio_especial + 	$transporte_tron  ;

											// *	13.	DESCUENTO PARA PRECIO MERCADO POR CATEGORIA
											$vr_descuento_precio_mercado_ropa   = $Precio_Lista_Ropa 	 * ( 1 - $dscto_precio_mercado_1_ropa    );
											$vr_descuento_precio_mercado_banios = $Precio_Lista_Banios * ( 1 - $dscto_precio_mercado_2_banios ) ;
											$vr_descuento_precio_mercado_pisos  = $Precio_Lista_Pisos 	* ( 1 - $dscto_precio_mercado_3_pisos  ) ;
											$vr_descuento_precio_mercado_loza   = $Precio_Lista_Loza 		* ( 1 - $dscto_precio_mercado_4_loza   ) ;

											// *	14.	TOTAL DEL VALOR DE DESCUENTO PARA PRECIO DE MERCADO
											$total_vr_descuento_precio_mercado = $vr_descuento_precio_mercado_ropa + 	$vr_descuento_precio_mercado_banios + $vr_descuento_precio_mercado_pisos + $vr_descuento_precio_mercado_loza;

											//*	15.	PORCENTAJE DE DESCUENTO ESPECIAL SOBRE PRECIO DE MARCADO
											if ( $descuento_especial > 0 ){
														$descuento_especial_porcentaje = $total_vr_descuento_precio_mercado / $descuento_especial;
												}else{
														$descuento_especial_porcentaje = 0 ;
												}

											//	*	16.	PORCENTAJES PROPORCIONALES DE CADA CATEGORIA
											if ( $total_vr_descuento_precio_mercado > 0 ) {
															$descuento_mercado_porcentaje_ropa   = $vr_descuento_precio_mercado_ropa 	  / $total_vr_descuento_precio_mercado ;
															$descuento_mercado_porcentaje_banios = $vr_descuento_precio_mercado_banios  / $total_vr_descuento_precio_mercado ;
															$descuento_mercado_porcentaje_pisos  = $vr_descuento_precio_mercado_pisos   / $total_vr_descuento_precio_mercado ;
															$descuento_mercado_porcentaje_loza   = $vr_descuento_precio_mercado_loza    / $total_vr_descuento_precio_mercado ;
														}

											//*	17.	DESCUENTO ESPECIAL PROPORCIONADO POR CADA CATEGORIA
															$descuento_unitario_ropa   = $descuento_mercado_porcentaje_ropa    * $precio_especial ;
															$descuento_unitario_banios = $descuento_mercado_porcentaje_banios  * $precio_especial ;
															$descuento_unitario_pisos  = $descuento_mercado_porcentaje_pisos   * $precio_especial  ;
															$descuento_unitario_loza   = $descuento_mercado_porcentaje_loza    * $precio_especial  ;

										//*	18.	PRECIO ESPECIAL UNITARIO
															$precio_especial_unitario_ropa   = $descuento_unitario_ropa ;
															$precio_especial_unitario_banios = $descuento_unitario_banios ;
															$precio_especial_unitario_pisos  = $descuento_unitario_pisos ;
															$precio_especial_unitario_loza   = $descuento_unitario_loza;

															if ( $precio_especial_unitario_ropa < 0)		{			$precio_especial_unitario_ropa 		= 0 ;						}
															if ( $precio_especial_unitario_banios < 0){		 $precio_especial_unitario_banios = 0 ;						}
															if ( $precio_especial_unitario_pisos < 0) {			$precio_especial_unitario_pisos 	= 0 ;				 	}
															if ( $precio_especial_unitario_loza < 0)		{		 $precio_especial_unitario_loza 		= 0 ;					 }

															$Descuento_Unitario_Total 		=	$descuento_especial ;
											// *	19. VERIFICAR EL PRECIO ESPECIAL CON RESPECTO A LA SUMA DE DESCUENTOS .. PENDIENTE....

											// *	20.	UNITARIO ESPECIAL
															$vr_unitario_ropa   = 0 ;
															$vr_unitario_banios = 0 ;
															$vr_unitario_pisos  = 0 ;
															$vr_unitario_loza   = 0 ;

															if ( $Cantidad_Ropa   > 0 )   {  					 $vr_unitario_ropa 		= $precio_especial_unitario_ropa 		 / $Cantidad_Ropa 		; 											}
															if ( $Cantidad_Banios > 0 ) 	 {							 $vr_unitario_banios = $precio_especial_unitario_banios  / $Cantidad_Banios ;												}
															if ( $Cantidad_Pisos  > 0 ) 		{								$vr_unitario_pisos  = $precio_especial_unitario_pisos   / $Cantidad_Pisos  ;												}
															if ( $Cantidad_Loza   > 0 )   {								$vr_unitario_loza   = $precio_especial_unitario_loza    / $Cantidad_Loza   ;												}

											// * 21		DIFERENCIA A REPARTIR
															$Diferencia = $Descuento_Unitario_Total - $precio_especial ;
											// * 21  SI LA DIFERENCIA EN MAYOR A CERO SE PROPORCIONA
																$Vr_Diferencia_Ropa   = 0 ;
																$Vr_Diferencia_Banios = 0 ;
																$Vr_Diferencia_Pisos  = 0 ;
																$Vr_Diferencia_Loza   = 0 ;
																if ( $Diferencia > 0 ){
																				$Vr_Diferencia_Ropa   = ( $precio_especial_unitario_ropa   / ( $precio_especial  + $Diferencia )) * $Diferencia ;
																				$Vr_Diferencia_Banios = ( $precio_especial_unitario_banios / ( $precio_especial  + $Diferencia )) * $Diferencia ;
																				$Vr_Diferencia_Pisos  = ( $precio_especial_unitario_pisos  / ( $precio_especial  + $Diferencia )) * $Diferencia ;
																				$Vr_Diferencia_Loza   = ( $precio_especial_unitario_loza   / ( $precio_especial  + $Diferencia )) * $Diferencia ;
																}

															if ( $Cantidad_Ropa   > 0 )   { $vr_unitario_ropa   =  ( $precio_especial_unitario_ropa    -  $Vr_Diferencia_Ropa   ) / $Cantidad_Ropa    ;	}
															if ( $Cantidad_Banios > 0 ) 	 { $vr_unitario_banios =  ( $precio_especial_unitario_banios  -  $Vr_Diferencia_Banios ) / $Cantidad_Banios  ;	}
															if ( $Cantidad_Pisos  > 0 ) 		{ $vr_unitario_pisos  =  ( $precio_especial_unitario_pisos   -  $Vr_Diferencia_Pisos  ) / $Cantidad_Pisos   ;	}
															if ( $Cantidad_Loza   > 0 )   { $vr_unitario_loza   =  ( $precio_especial_unitario_loza    -  $Vr_Diferencia_Loza   ) / $Cantidad_Loza    ;	}


																// CALCULO DEL VALOR DECLARADO PARA PRODUCTOS TRON

																Session::Set('precio_especial',$precio_especial);
																Session::Set('transporte_tron',0);
																Session::Set('descuento_especial',$descuento_especial);
																Session::Set('descuento_especial_porcentaje', $descuento_especial_porciento);

																Session::Set('vr_unitario_ropa',$vr_unitario_ropa);
																Session::Set('vr_unitario_banios',$vr_unitario_banios);
																Session::Set('vr_unitario_pisos',$vr_unitario_pisos);
																Session::Set('vr_unitario_loza',$vr_unitario_loza);
		    }

		 }
 ?>
