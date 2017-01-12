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
		    		Session::Set('Sobre_Precio_Prod_Tron', 0 );
		    		$parametros[0]['iva']  = Session::Get('iva'); ;
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



										$Por100Iva =  1 + $parametros[0]['iva'] / 100   ;
											//$correctorvariacion

										$formula_a  = ( $Costo_Total  +  $costofijo ) / ( $correctorvariacion  - ( $py_porciento_recaudo * $Por100Iva ) ) ;


											$precio_especial = $formula_a ;
											$formula_elegida = $formula_a ;

											$precio_especial 				 = $precio_especial  * $Por100Iva    ;
											$precio_especial_temp = $precio_especial ;
											$descuento_especial   = $Precio_Lista_Total  - $precio_especial ;

											if ( $descuento_especial < 0 ) { $descuento_especial = $descuento_especial * -1 ;}

											$descuento_especial 										= round($descuento_especial,0);
											$descuento_especial_porciento = $descuento_especial / $Precio_Lista_Total  * 100;
											$descuento_especial_porciento = round($descuento_especial_porciento,2);

										//*** PRECIOS UNITARIOS
										//*----------------------
										$Precio_Unitario_Ropa   = 0 ;
										$Precio_Unitario_Banios = 0 ;
										$Precio_Unitario_Pisos  = 0 ;
										$Precio_Unitario_Loza   = 0 ;

										if ( $Cantidad_Ropa   > 0 )  {	$Precio_Unitario_Ropa    = 	$Precio_Lista_Ropa 	 / $Cantidad_Ropa 		;	}
										if ( $Cantidad_Banios > 0 )  {	$Precio_Unitario_Banios  = 	$Precio_Lista_Banios / $Cantidad_Banios ;	}
										if ( $Cantidad_Pisos  > 0 )  {	$Precio_Unitario_Pisos   = 	$Precio_Lista_Pisos  / $Cantidad_Pisos  ;	}
										if ( $Cantidad_Loza   > 0 )  {	$Precio_Unitario_Loza    = 	$Precio_Lista_Loza   / $Cantidad_Loza   ;	}


									$Precio_Unitario_Ropa   = $Precio_Unitario_Ropa   	* ( 1 - $dscto_precio_mercado_1_ropa				) ;
									$Precio_Unitario_Banios = $Precio_Unitario_Banios 	* ( 1 - $dscto_precio_mercado_2_banios  ) ;
									$Precio_Unitario_Pisos  = $Precio_Unitario_Pisos  	* ( 1 - $dscto_precio_mercado_3_pisos  	)	;
									$Precio_Unitario_Loza   = $Precio_Unitario_Loza  		* ( 1 - $dscto_precio_mercado_4_loza  		)	;

									$Precio_Total_Ropa   = $Precio_Unitario_Ropa   	* $Cantidad_Ropa  ;
									$Precio_Total_Banios = $Precio_Unitario_Banios 	* $Cantidad_Banios;
									$Precio_Total_Pisos  = $Precio_Unitario_Pisos  	* $Cantidad_Pisos	;
									$Precio_Total_Loza   = $Precio_Unitario_Loza  		* $Cantidad_Loza 	;

									$Precio_Total_Pedido = $Precio_Total_Ropa  + 	$Precio_Total_Banios + $Precio_Total_Pisos + $Precio_Total_Loza  ;

									$Descuento_Concedido = $Precio_Total_Pedido  - $precio_especial  ;

									/** PROPORCIONES DE LOS PRECIOS INDIVIDUALES
									**------------------------------------------*/
									$Proporc_Ropa_Precio_Mcado   = 0 ;
									$Proporc_Banios_Precio_Mcado = 0 ;
									$Proporc_Pisos_Precio_Mcado  = 0 ;
									$Proporc_Loza_Precio_Mcado   = 0 ;

									if (  $Precio_Total_Pedido > 0 ) {
												$Proporc_Ropa_Precio_Mcado   = $Precio_Total_Ropa 		/ $Precio_Total_Pedido  ;
												$Proporc_Banios_Precio_Mcado = $Precio_Total_Banios	/ $Precio_Total_Pedido  ;
												$Proporc_Pisos_Precio_Mcado  = $Precio_Total_Pisos		/ $Precio_Total_Pedido  ;
												$Proporc_Loza_Precio_Mcado   = $Precio_Total_Loza 	 / $Precio_Total_Pedido  ;
								 }

								// **PROPORCIONES SOBRE LOS PRECIOS INDIVIDUALES
								$Proporc_Dscto_Ropa   = $Proporc_Ropa_Precio_Mcado 		* $Descuento_Concedido ;
								$Proporc_Dscto_Banios = $Proporc_Banios_Precio_Mcado * $Descuento_Concedido ;
								$Proporc_Dscto_Pisos  = $Proporc_Pisos_Precio_Mcado 	* $Descuento_Concedido ;
								$Proporc_Dscto_Loza   = $Proporc_Loza_Precio_Mcado 		* $Descuento_Concedido ;

								// VALORES TOTALES INDIVIDUALES
								$VrPedTotal_Ropa   = $Precio_Total_Ropa 		- $Proporc_Dscto_Ropa   ;
								$VrPedTotal_Banios = $Precio_Total_Banios - $Proporc_Dscto_Banios  ;
								$VrPedTotal_Pisos  = $Precio_Total_Pisos 	- $Proporc_Dscto_Pisos ;
								$VrPedTotal_Loza   = $Precio_Total_Loza 		- $Proporc_Dscto_Loza ;


									//*----------------------
								$Precio_Unitario_Ropa   = 0 ;
								$Precio_Unitario_Banios = 0 ;
								$Precio_Unitario_Pisos  = 0 ;
								$Precio_Unitario_Loza   = 0 ;
								if ( $Cantidad_Ropa   > 0 )  {	$Precio_Unitario_Ropa    = 	$VrPedTotal_Ropa 	 / $Cantidad_Ropa 		;	}
								if ( $Cantidad_Banios > 0 )  {	$Precio_Unitario_Banios  = 	$VrPedTotal_Banios / $Cantidad_Banios ;	}
								if ( $Cantidad_Pisos  > 0 )  {	$Precio_Unitario_Pisos   = 	$VrPedTotal_Pisos  / $Cantidad_Pisos  ;	}
								if ( $Cantidad_Loza   > 0 )  {	$Precio_Unitario_Loza    = 	$VrPedTotal_Loza   / $Cantidad_Loza   ;	}


									// CALCULO DEL VALOR DECLARADO PARA PRODUCTOS TRON
									Session::Set('precio_especial'              , $precio_especial   );
									Session::Set('transporte_tron'              , 0                  );
									Session::Set('descuento_especial'           , $descuento_especial);
									Session::Set('descuento_especial_porcentaje', $descuento_especial_porciento);
									Session::Set('Sobre_Precio_Prod_Tron'       , 0 );



     if ( $Precio_Unitario_Ropa    == 0 ||  $Precio_Unitario_Ropa  > Session::Get('text_pv_tron_ropa') ) {
           $Precio_Unitario_Ropa =  Session::Get('text_pv_tron_ropa')    ;
          }
     if ( $Precio_Unitario_Banios  == 0 || $Precio_Unitario_Banios  > Session::Get('text_pv_tron_banios')) {
            $Precio_Unitario_Banios  = Session::Get('text_pv_tron_banios') ;
          }
     if ( $Precio_Unitario_Pisos  == 0 || $Precio_Unitario_Pisos > Session::Get('text_pv_tron_pisos')) {
            $Precio_Unitario_Pisos  = Session::Get('text_pv_tron_pisos')   ;
          }
     if ( $Precio_Unitario_Loza    == 0 ||  $Precio_Unitario_Loza  >  Session::Get('text_pv_tron_loza')) {
         $Precio_Unitario_Loza = Session::Get('text_pv_tron_loza')     ;
        }


									Session::Set('vr_unitario_ropa',     $Precio_Unitario_Ropa);
									Session::Set('vr_unitario_banios',   $Precio_Unitario_Banios);
									Session::Set('vr_unitario_pisos',    $Precio_Unitario_Pisos);
									Session::Set('vr_unitario_loza',     $Precio_Unitario_Loza);



		    } //Proceso para hallar el precio especial




		    public function Hallar_Precio_Especial_old($parametros, $datos=array()){
		    	/** MAYO 17 DE 2015
		    	 * 				HALLAR EL PRECIO ESPECIAL DE PRODUCTOS TRON, DECUENTO Y EL PRECIO UNITARIO POR CADA UNA DE LAS CATEGORIAS
		    	 */
		    		Session::Set('REDETRANS_COURRIER_VR_FLETE', 0);
		    		Session::Set('Sobre_Precio_Prod_Tron', 0 );
		    		$parametros[0]['iva']  = Session::Get('iva'); ;
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



										$Por100Iva =  1 + $parametros[0]['iva'] / 100   ;
											//$correctorvariacion

										$formula_a  = ( $Costo_Total  +  $costofijo ) / ( $correctorvariacion  - ( $py_porciento_recaudo * $Por100Iva ) ) ;


											$precio_especial = $formula_a ;
											$formula_elegida = $formula_a ;

											$precio_especial 				 = $precio_especial  * $Por100Iva    ;
											$precio_especial_temp = $precio_especial ;
											$descuento_especial   = $Precio_Lista_Total  - $precio_especial ;

											if ( $descuento_especial < 0 ) { $descuento_especial = $descuento_especial * -1 ;}

											$descuento_especial 										= round($descuento_especial,0);
											$descuento_especial_porciento = $descuento_especial / $Precio_Lista_Total  * 100;
											$descuento_especial_porciento = round($descuento_especial_porciento,2);

											/// CALCULO DEL DESCUENTO NEGATIVO
											if (  $precio_especial  > $Precio_Lista_Total ){
													$Descuento_Negativo = $precio_especial -  $Precio_Lista_Total ;
												}else{
													$Descuento_Negativo = 0;
												}



											/*CAMBIOS IMPLEMENTADOS EL 19 DE ABRIL DE 2016*/

											// ESTE PEDIDO A PRECIO DE LISTA
											$Pedido_Precio_Lista = $Precio_Lista_Ropa + $Precio_Lista_Banios + $Precio_Lista_Pisos + $Precio_Lista_Loza;

											//	PROPORCION ESTE PEDIDO
											$Proporcion_Ropa   = $Precio_Lista_Ropa 		/ $Pedido_Precio_Lista ;
											$Proporcion_Banios = $Precio_Lista_Banios / $Pedido_Precio_Lista;
											$Proporcion_Pisos  = $Precio_Lista_Pisos 	/ $Pedido_Precio_Lista;
											$Proporcion_Loza   = $Precio_Lista_Loza 		/ $Pedido_Precio_Lista;



											//	PRECIOS UNITARIOS DE MARCADO
											$Precio_Unit_Mcdo_Ropa   =	0 ;
											$Precio_Unit_Mcdo_Banios =	0 ;
											$Precio_Unit_Mcdo_Pisos  = 0 ;
											$Precio_Unit_Mcdo_Loza   =	0 ;
											if ( $Cantidad_Ropa  > 0 ){
														$Precio_Unit_Mcdo_Ropa   =	$Precio_Lista_Ropa 		/ $Cantidad_Ropa 		* ( 1 - $dscto_precio_mercado_1_ropa ) ;
													}
											if ( $Cantidad_Banios  > 0 )	{
														$Precio_Unit_Mcdo_Banios =	$Precio_Lista_Banios / $Cantidad_Banios * ( 1 - $dscto_precio_mercado_2_banios ) ;
													}
												if ( $Cantidad_Pisos > 0 ){
																$Precio_Unit_Mcdo_Pisos  =	$Precio_Lista_Pisos		/ $Cantidad_Pisos 	* ( 1 - $dscto_precio_mercado_3_pisos ) ;
															}
												if ( $Cantidad_Loza > 0 ){
															$Precio_Unit_Mcdo_Loza   =	$Precio_Lista_Loza		 / $Cantidad_Loza 		* ( 1 - $dscto_precio_mercado_4_loza ) ;
														}



											/*-----------------------------------------------------*-----------------------------------------------------
											*ESTE PEDIDO A PRECIO DE MERCADO... VALORES TOTALES. YA CALCULADO EN LAS LINEAS ANTERIORES
											*-----------------------------------------------------*-----------------------------------------------------*/

											//		DTO1. PARA IGUALAR PRECIO MERCADO
											$Dcto_1_Igualar_Precio_Mcado_Ropa   =	 $Precio_Lista_Ropa 			* $dscto_precio_mercado_1_ropa ;
											$Dcto_1_Igualar_Precio_Mcado_Banios =	 $Precio_Lista_Banios 	* $dscto_precio_mercado_2_banios ;
											$Dcto_1_Igualar_Precio_Mcado_Pisos  =	 $Precio_Lista_Pisos 		* $dscto_precio_mercado_3_pisos ;
											$Dcto_1_Igualar_Precio_Mcado_Loza   =	 $Precio_Lista_Loza 			* $dscto_precio_mercado_4_loza ;
											$Dcto_1_Igualar_Precio_Mcado_Total  =  $Dcto_1_Igualar_Precio_Mcado_Ropa  + $Dcto_1_Igualar_Precio_Mcado_Banios + $Dcto_1_Igualar_Precio_Mcado_Pisos + $Dcto_1_Igualar_Precio_Mcado_Loza;



											//		FALTANTE=DIF.DTO1 VS. DTO.ESPECIAL
											$descuento_especial_negativo = $descuento_especial  * -1;

											$descuento_especial_2 = abs( $descuento_especial );

											if ( $Dcto_1_Igualar_Precio_Mcado_Total < $descuento_especial_2 ){
														$Faltante = ( $descuento_especial_negativo * -1 ) - ( $Dcto_1_Igualar_Precio_Mcado_Total );
												}else{
														$Faltante = ( $Dcto_1_Igualar_Precio_Mcado_Total  * - 1 ) - ( $descuento_especial_negativo   );
												}
												$Faltante_Inicial = $Faltante;
												$Faltante = abs( $Faltante );




												// DTO2. PARA IGUALAR PRECIO ESPECIAL
												if ( $Proporcion_Ropa  * $Faltante > $Dcto_1_Igualar_Precio_Mcado_Ropa ){
															$Dcto_2_Igualar_Precio_Mcado_Ropa = $Dcto_1_Igualar_Precio_Mcado_Ropa * -1 ;
													}else{
														$Dcto_2_Igualar_Precio_Mcado_Ropa = $Proporcion_Ropa  * $Faltante_Inicial;
													}

													if ( $Proporcion_Banios  * $Faltante > $Dcto_1_Igualar_Precio_Mcado_Banios ){
																	$Dcto_2_Igualar_Precio_Mcado_Banios = $Dcto_1_Igualar_Precio_Mcado_Banios  * -1;
															}else{
																$Dcto_2_Igualar_Precio_Mcado_Banios = $Proporcion_Banios  * $Faltante_Inicial;
															}
												if ( $Proporcion_Pisos  * $Faltante > $Dcto_1_Igualar_Precio_Mcado_Pisos ){
																	$Dcto_2_Igualar_Precio_Mcado_Pisos = $Dcto_1_Igualar_Precio_Mcado_Pisos  * -1;
															}else{
																$Dcto_2_Igualar_Precio_Mcado_Pisos = $Proporcion_Pisos  * $Faltante_Inicial;
															}
												if ( $Proporcion_Loza  * $Faltante > $Dcto_1_Igualar_Precio_Mcado_Loza ){
																	$Dcto_2_Igualar_Precio_Mcado_Loza = $Dcto_1_Igualar_Precio_Mcado_Loza  * -1;
															}else{
																$Dcto_2_Igualar_Precio_Mcado_Loza = $Proporcion_Loza  * $Faltante_Inicial;
															}
												$Dcto_2_Igualar_Precio_Mcado_Total = 	$Dcto_2_Igualar_Precio_Mcado_Ropa + 			$Dcto_2_Igualar_Precio_Mcado_Banios + $Dcto_2_Igualar_Precio_Mcado_Pisos + $Dcto_2_Igualar_Precio_Mcado_Loza;


												//		DESCUENTO 1 + DESCUENTO 2
													$Dcto_1_Mas_Dcto_2_Ropa   = $Dcto_1_Igualar_Precio_Mcado_Ropa  		+ $Dcto_2_Igualar_Precio_Mcado_Ropa;
													$Dcto_1_Mas_Dcto_2_Banios = $Dcto_1_Igualar_Precio_Mcado_Banios  + $Dcto_2_Igualar_Precio_Mcado_Banios;
													$Dcto_1_Mas_Dcto_2_Pisos  = $Dcto_1_Igualar_Precio_Mcado_Pisos  	+ $Dcto_2_Igualar_Precio_Mcado_Pisos;
													$Dcto_1_Mas_Dcto_2_Loza   = $Dcto_1_Igualar_Precio_Mcado_Loza  		+ $Dcto_2_Igualar_Precio_Mcado_Loza;
													$Dcto_1_Mas_Dcto_2_Total  = $Dcto_1_Mas_Dcto_2_Ropa + $Dcto_1_Mas_Dcto_2_Banios + $Dcto_1_Mas_Dcto_2_Pisos + $Dcto_1_Mas_Dcto_2_Loza ;



													//		DIF. DTO2 VS FALTANTE
														$Dif_Dcto_2_Faltante = $Faltante_Inicial - $Dcto_2_Igualar_Precio_Mcado_Total ;



													//  DTO.3 PARA IGUALAR PRECIO ESPECIAL
														$Dcto_3_Igualar_Precio_Mcado_Ropa = 0;
														if ( $Dcto_1_Mas_Dcto_2_Total <> 0 ){
																		$Dcto_3_Igualar_Precio_Mcado_Ropa = ( $Dcto_1_Mas_Dcto_2_Ropa / $Dcto_1_Mas_Dcto_2_Total) * $Dif_Dcto_2_Faltante;
																}
														$Dcto_3_Igualar_Precio_Mcado_Banios = 0;
														if ( $Dcto_1_Mas_Dcto_2_Total <> 0 ){
																		$Dcto_3_Igualar_Precio_Mcado_Banios = ( $Dcto_1_Mas_Dcto_2_Banios / $Dcto_1_Mas_Dcto_2_Total) * $Dif_Dcto_2_Faltante;
																}
														$Dcto_3_Igualar_Precio_Mcado_Pisos = 0;
														if ( $Dcto_1_Mas_Dcto_2_Total <> 0 ){
																		$Dcto_3_Igualar_Precio_Mcado_Pisos = ( $Dcto_1_Mas_Dcto_2_Pisos / $Dcto_1_Mas_Dcto_2_Total) * $Dif_Dcto_2_Faltante;
																}
														$Dcto_3_Igualar_Precio_Mcado_Loza = 0;
														if ( $Dcto_1_Mas_Dcto_2_Total <> 0 ){
																		$Dcto_3_Igualar_Precio_Mcado_Loza = ( $Dcto_1_Mas_Dcto_2_Loza / $Dcto_1_Mas_Dcto_2_Total) * $Dif_Dcto_2_Faltante;
																}

												//		TOTAL DESCUENTO
																$Total_Descuento_Ropa   =	 $Dcto_1_Mas_Dcto_2_Ropa + $Dcto_3_Igualar_Precio_Mcado_Ropa;
																$Total_Descuento_Banios =	 $Dcto_1_Mas_Dcto_2_Banios + $Dcto_3_Igualar_Precio_Mcado_Banios;
																$Total_Descuento_Pisos  =	 $Dcto_1_Mas_Dcto_2_Pisos + $Dcto_3_Igualar_Precio_Mcado_Pisos;
																$Total_Descuento_Loza   =	 $Dcto_1_Mas_Dcto_2_Loza + $Dcto_3_Igualar_Precio_Mcado_Loza;

												// 	PRECIOS UNITARIOS
																$Precio_Unitario_Ropa  = 0;
																if ( $Cantidad_Ropa  > 0 ){
																			$Precio_Unitario_Ropa   = ( $Precio_Lista_Ropa - $Total_Descuento_Ropa ) / $Cantidad_Ropa;
																	}
																$Precio_Unitario_Banios  = 0;
																if ( $Cantidad_Banios  > 0 ){
																			$Precio_Unitario_Banios   = ( $Precio_Lista_Banios - $Total_Descuento_Banios) / $Cantidad_Banios;
																	}
																$Precio_Unitario_Pisos  = 0;
																if ( $Cantidad_Pisos  > 0 ){
																			$Precio_Unitario_Pisos   = ( $Precio_Lista_Pisos - $Total_Descuento_Pisos) / $Cantidad_Pisos;
																	}
																$Precio_Unitario_Loza  = 0;
																if ( $Cantidad_Loza  > 0 ){
																			$Precio_Unitario_Loza   = ( $Precio_Lista_Loza - $Total_Descuento_Loza) / $Cantidad_Loza;
																	}

																	$Precio_Unitario_Ropa 		= round($Precio_Unitario_Ropa,0) ;
																	$Precio_Unitario_Banios = round($Precio_Unitario_Banios,0) ;
																	$Precio_Unitario_Pisos 	= round($Precio_Unitario_Pisos,0) ;
																	$Precio_Unitario_Loza 		= round($Precio_Unitario_Loza,0) ;

																/*	if ( $Precio_Unitario_Ropa 		< 0 )  {   $Precio_Unitario_Ropa  	= 0 ; }
																	if ( $Precio_Unitario_Banios < 0 )  {   $Precio_Unitario_Banios = 0 ; }
																	if ( $Precio_Unitario_Pisos 	< 0 )  {   $Precio_Unitario_Pisos  = 0 ; }
																	if ( $Precio_Unitario_Loza 		< 0 )  {   $Precio_Unitario_Loza  	= 0 ; }
																	*/

 															// CALCULO DEL VALOR DECLARADO PARA PRODUCTOS TRON
																Session::Set('precio_especial'              , $precio_especial   );
																Session::Set('transporte_tron'              , 0                  );
																Session::Set('descuento_especial'           , $descuento_especial);
																Session::Set('descuento_especial_porcentaje', $descuento_especial_porciento);
																Session::Set('Sobre_Precio_Prod_Tron'       , $Descuento_Negativo );

																Session::Set('vr_unitario_ropa',     $Precio_Unitario_Ropa);
																Session::Set('vr_unitario_banios',   $Precio_Unitario_Banios);
																Session::Set('vr_unitario_pisos',    $Precio_Unitario_Pisos);
																Session::Set('vr_unitario_loza',     $Precio_Unitario_Loza);


		    } //Proceso para hallar el precio especial





		 }
 ?>
