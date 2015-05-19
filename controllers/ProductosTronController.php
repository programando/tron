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

									$subsidio_flete_valle                = 0;
									$descuento_mercado_porcentaje_ropa   = 0;
									$descuento_mercado_porcentaje_banios = 0 ;
									$descuento_mercado_porcentaje_pisos  = 0 ;
									$descuento_mercado_porcentaje_loza   = 0 ;

									extract($datos);
											$Peso_Total         = $Peso_Ropa  								+ $Peso_Banios  							 + $Peso_Pisos  						  + $Peso_Loza ;
											$Costo_Total        = $Cmv_Ropa 										+ $Cmv_Banios 									 + $Cmv_Pisos		 								+ $Cmv_Loza	 ;
											$Precio_Lista_Total = $Precio_Lista_Ropa  + $Precio_Lista_Banios 	+ $Precio_Lista_Pisos 	+ $Precio_Lista_Loza;

											$Flete_Real = $this->Fletes->Valor_Fletes_Productos_Tron($Peso_Total,$iddpto ,$re_expedicion   );

											//$subsidio_flete_valle = $Flete_Real;
											if ( $Precio_Lista_Total >= $valor_minimo_pedido_productos  ){
															$subsidio_flete_valle  = $parametros[0]['kit_flete_real_valle'];
											}

											$formula_a =  $Costo_Total  +  $costofijo  + $py_vr_adicional ;
											$formula_a = 	$formula_a    + ( $correctorvariacion * $subsidio_flete_valle  ) + ( $py_porciento_recaudo * $Flete_Real  );
											$formula_a = 	$formula_a / ( $correctorvariacion - $py_porciento_recaudo );

											$formula_b = $Costo_Total  +  $costofijo +  $py_vr_min_recaudo + $py_vr_adicional;
											$formula_b = $formula_b    + ( $correctorvariacion * $subsidio_flete_valle ) ;
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

											$descuento_especial = $Precio_Lista_Total  - $precio_especial ;
											$desceunto_especial_porciento = $descuento_especial / $Precio_Lista_Total  * 100;

											// *	10. HALLAR DESCUENTO NEGATIVO PARA ENCONTRAR EL TRANSPORTE
											$descuento_negativo = 0 ;
											if  ( $formula_elegida > $Precio_Lista_Total ){
															$descuento_negativo = $formula_elegida - $Precio_Lista_Total;
											}
											//*	11.	HALLAR EL VALOR DE TRANSPORTE
											$transporte_tron = $Flete_Real - $subsidio_flete_valle + $descuento_negativo ;


											//12.	VALOR TOTAL A PAGAR POR EL PEDIDO
											$valor_pedido_tron = $precio_especial + 	$transporte_tron  ;

											// *	13.	DESCUENTO PARA PRECIO MERCADO POR CATEGORIA
											$vr_descuento_precio_mercado_ropa   = $Precio_Lista_Ropa 	 * $dscto_precio_mercado_1_ropa    ;
											$vr_descuento_precio_mercado_banios = $Precio_Lista_Banios * $dscto_precio_mercado_2_banios  ;
											$vr_descuento_precio_mercado_pisos  = $Precio_Lista_Pisos 	* $dscto_precio_mercado_3_pisos   ;
											$vr_descuento_precio_mercado_loza   = $Precio_Lista_Loza 		* $dscto_precio_mercado_4_loza    ;

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
															$descuento_unitario_ropa   = $descuento_mercado_porcentaje_ropa    * $descuento_especial ;
															$descuento_unitario_banios = $descuento_mercado_porcentaje_banios  * $descuento_especial ;
															$descuento_unitario_pisos  = $descuento_mercado_porcentaje_pisos   * $descuento_especial ;
															$descuento_unitario_loza   = $descuento_mercado_porcentaje_loza    * $descuento_especial ;

										//*	18.	PRECIO ESPECIAL UNITARIO
															$precio_especial_unitario_ropa   = $Precio_Lista_Ropa   - $descuento_unitario_ropa ;
															$precio_especial_unitario_banios = $Precio_Lista_Banios - $descuento_unitario_banios ;
															$precio_especial_unitario_pisos  = $Precio_Lista_Pisos  - $descuento_unitario_pisos ;
															$precio_especial_unitario_loza   = $Precio_Lista_Loza   - $descuento_unitario_loza ;
															if ( $precio_especial_unitario_ropa < 0){
																			$precio_especial_unitario_ropa = 0 ;
															}
															if ( $precio_especial_unitario_banios < 0){
																			$precio_especial_unitario_banios = 0 ;
															}
															if ( $precio_especial_unitario_pisos < 0){
																			$precio_especial_unitario_pisos = 0 ;
															}
															if ( $precio_especial_unitario_loza < 0){
																			$precio_especial_unitario_loza = 0 ;
															}
											// *	19. VERIFICAR EL PRECIO ESPECIAL CON RESPECTO A LA SUMA DE DESCUENTOS .. PENDIENTE....

											// *	20.	UNITARIO ESPECIAL
															$vr_unitario_ropa   = 0 ;
															$vr_unitario_banios = 0 ;
															$vr_unitario_pisos  = 0 ;
															$vr_unitario_loza   = 0 ;

															if ( $Cantidad_Ropa  > 0 ) {
																	 $vr_unitario_ropa = $precio_especial_unitario_ropa  / $Cantidad_Ropa ;
																}
															if ( $Cantidad_Banios  > 0 ) {
																	 $vr_unitario_banios = $precio_especial_unitario_banios  / $Cantidad_Banios ;
																}
															if ( $Cantidad_Pisos  > 0 ) {
																	 $vr_unitario_pisos = $precio_especial_unitario_pisos  / $Cantidad_Pisos ;
																}
															if ( $Cantidad_Loza  > 0 ) {
																	 $vr_unitario_loza = $precio_especial_unitario_loza  / $Cantidad_Loza ;
																}
																if ( $vr_unitario_ropa == 0)
																{
																	$vr_unitario_ropa = $Precio_Lista_Ropa;
																}




																Session::Set('precio_especial',$precio_especial);
																Session::Set('transporte_tron',$transporte_tron);
																Session::Set('descuento_especial',$descuento_especial);
																Session::Set('descuento_especial_porcentaje', $descuento_especial_porcentaje);

																Session::Set('vr_unitario_ropa',$vr_unitario_ropa);
																Session::Set('vr_unitario_banios',$vr_unitario_banios);
																Session::Set('vr_unitario_pisos',$vr_unitario_pisos);
																Session::Set('vr_unitario_loza',$vr_unitario_loza);






		    }


		 }
 ?>
