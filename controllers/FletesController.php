<?php

  class FletesController extends Controller
  {
						public  $valor_flete                  = 0;
						public 	$valor_dscto_flete_kit_inicio = 0;
						public 	$valor_flete_kit_inicio       = 0;		// VALOR QUE FINALMENTE SE COBRARÁ EN EL KIT DE INICIO POR CONCEPTO DE FLETE.

						private $iddpto                       = 0;
						private $idmcipio                     = 0;
						private $re_expedicion                = 0;
						private $cantidad_unidades_despacho   = 0;		// CANTIDAD DE BOLSAS ( UNIDADES DE DESPACHO ) QUE SE ENTREGAN A LA TRANSPORTADORA
						private $seguro_redetrans_courrier    = 0;
						private $tipo_tarifa                  ='';
						private $flete_calculado              = FALSE ;
						private $Transportadoras 		           ='';



      public function __construct()
      {
          parent::__construct();
										$this->Fletes     = $this->Load_Model('Fletes');
										$this->Parametros = $this->Load_Model('Parametros');
      }

      public function Index() { }

      public function Sevientrega_Premier($peso_kilos_pedido,$valor_declarado)
      {/** MARZO 16 DE 2015
      	*				CALCULA VALOR DE FLETE SE COBRARÁ POR SERVIENTREGA PREMIER
      	*/
										$kilos_adicionales            = 0;
										$valor_flete_hasta_3_kilos    = 0;
										$valor_flete_kilos_adiconales = 0;
										$seguro_flete                 = 0;
										$this->valor_flete            = 0;
										$this->re_expedicion          = Session::Get('re_expedicion');
										$this->idmcipio               = Session::Get('idmcipio');
										$this->iddpto                 = Session::Get('iddpto');

										$this->Transportadoras = $this->Parametros->Transportadoras();

			      	// 1. HALLAR KILOS ADICIONALES
			      	if ($peso_kilos_pedido > 3)
			      	{
			      		$kilos_adicionales = $peso_kilos_pedido - 3;
			      		if ($kilos_adicionales < 1) { $kilos_adicionales = 1 ;}
			      	}

			      	//
			      	if ($this->iddpto != 32) // No Valle, es Nacional
			      	{
											$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_nacional'];
											$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_nacional'];
											$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER NACIONAL';
			      	}
			      	if ($this->iddpto == 32) // Valle
			      	{
			      			if ($this->idmcipio != 153) // valle - no cali
			      			{
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_zonal'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_zonal'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER DEPARTAMENTAL/ZONAL';
			      			}else
			      			{
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_urbano'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_urbano'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER URBANO';
			      			}
			      	}
			      	if ($this->re_expedicion == 1)
			      	{
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_reexpedicion'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_reexpedicion'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER REEXPEDICIÓN';
			      	}
										$valor_flete_hasta_3_kilos    = $valor_flete_hasta_3_kilos    * ($peso_kilos_pedido  - $kilos_adicionales ) ;
										$valor_flete_kilos_adiconales = $valor_flete_kilos_adiconales *  $kilos_adicionales ;


										// HALLO EL SEGURO
										if ($valor_declarado < $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'])
										{
												$seguro_flete         = $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'];
										}else
											{
												$seguro_flete         = $valor_declarado * $this->Transportadoras[0]['sv_premier_porciento_seguro']/100;
											}
											$this->valor_flete     =  $valor_flete_hasta_3_kilos  	 +  $valor_flete_kilos_adiconales  + $seguro_flete ;

											$this->flete_calculado = TRUE ;
          $this->Adicionar_Cobro_Flete_Transportadora(3,'2030','SERVIENTREGA');
      }

      public function Servientrega_Industrial($peso_kilos_pedido,$valor_declarado, $cant_unidades_despacho)
      {/**  MAZO 16 DE 2015
      	*							CALCULA EL VALOR DE FLETE QUE SE COBRARA POR CARGA INDUSTRIAL SERVIENTREGA
      	*/
								$descuento_comercial   = 0;
								$tasa_manejo           = 0;
								$valor_minimo_manejo   = 0;
								$seguro_fijo           = 0;
								$seguro_variable       = 0;
								$seguro_flete          = 0;
								$this->valor_flete     = 0 ;
								$this->tipo_tarifa     = '';
								$this->re_expedicion   = Session::Get('re_expedicion');
								$this->idmcipio        = Session::Get('idmcipio');
								$this->iddpto          = Session::Get('iddpto');
								$this->Transportadoras = $this->Parametros->Transportadoras();
								$peso_minimo           = $cant_unidades_despacho * $this->Transportadoras['0']['sv_carga_peso_minimo'];



	      	if ($peso_minimo > $peso_kilos_pedido)
	      	{
	      		$peso_kilos_pedido = $peso_minimo;
	      	}
	      	$this->valor_flete = $peso_kilos_pedido  * Session::Get('vr_kilo_idmcipio_servientrega');


	      	if ($this->re_expedicion == 0)
	      	{
	      			$descuento_comercial        = $this->valor_flete  * $this->Transportadoras[0]['sv_carga_peso_minimo']/100;
	      	}

	      	$this->valor_flete = $this->valor_flete - $descuento_comercial ;

	      if ($this->iddpto != 32)
	      {
									$tasa_manejo         = $this->Transportadoras[0]['sv_carga_tasa_manejo_nacional'];
									$valor_minimo_manejo = $this->Transportadoras[0]['sv_carga_flete_minimo_nacional'];
									$this->tipo_tarifa   = 'SERVIENTREGA - CARGA NACIONAL';
	      }

	      if ($this->iddpto == 32 ) // Valle
	      {
	      	 if ($this->idmcipio != 153) // No Cali
	      	 {
	      	 	$tasa_manejo         = $this->Transportadoras[0]['sv_carga_tasa_manejo_zonal'];
										$valor_minimo_manejo = $this->Transportadoras[0]['sv_carga_flete_minimo_zonal'];
										$this->tipo_tarifa   = 'SERVIENTREGA - CARGA DEPARTAMENTAL/ZONAL';
								 }else 	// Cali
									{
										$tasa_manejo         = $this->Transportadoras[0]['sv_carga_tasa_manejo_reexpedicion']; // Dice Reexpedicion.. es ok!
										$valor_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_urbano'];
										$this->tipo_tarifa   = 'SERVIENTREGA - CARGA URBANO';
									}
							}
	      if ($this->re_expedicion == 1)
	      {
	      		$tasa_manejo         = 0;
									$valor_minimo_manejo = 0;
	      }
	      $tasa_manejo = $tasa_manejo / 100;

	      //6. APLICAR TASA DE MANEJO Y COMPARAR CON EL VALOR DEL FLETE
	      if ($this->valor_flete < ($tasa_manejo  * $cant_unidades_despacho))
	      {
	      		$this->valor_flete = $tasa_manejo  * $cant_unidades_despacho;
	      }
	      // 7. HALLAR SEGURO FIJO Y SEGURO VARIABLE
							$seguro_fijo     = $cant_unidades_despacho * $valor_minimo_manejo;
							$seguro_variable = $valor_declarado * $this->Transportadoras[0]['sv_carga_tasa_manejo_nacional']/100;
	      // 8. VALIDA SEGURO VARIABLE CON RESPECTO AL VALOR MÍNIMO MANEJO

	      if ($seguro_variable < 	$valor_minimo_manejo )
	      {
	      	$seguro_variable  = $valor_minimo_manejo ;
	      }
	      //9. ELEGIR EL MAYOR DE LOS SEGUROS
	      if ($seguro_fijo > $seguro_variable)
	      {
	      	$seguro_flete = $seguro_fijo;
	      }else
	      {
	      	$seguro_flete = $seguro_variable;
	      }

							$this->valor_flete     = $this->valor_flete + $seguro_flete ;
							$this->flete_calculado = TRUE ;
       $this->Adicionar_Cobro_Flete_Transportadora(2,'2030','SERVIENTREGA');

     }



      public function Redetrans_Carga($peso_kilos_pedido,$valor_declarado, $cant_unidades_despacho)
      {/** MARZO 12 DE 2015
      	*				CALCULA EL VALOR DE FLETE QUE SE COBRARA POR CARGA REDE TRANS
      	*/
								$seguro_fijo                = 0;
								$seguro_reexpedicion        = 0;
								$seguro_flete               = 0;
								$descuento_comercial        = 0;
								$porciento_dscto_ccial      = 0;
								$this->valor_flete          = 0;
								$this->Transportadoras      = $this->Parametros->Transportadoras();
								$this->re_expedicion        = Session::Get('re_expedicion');
								$vr_kilo_idmcipio_redetrans = Session::Get('vr_kilo_idmcipio_redetrans');
								$vr_re_expedicion_redetrans = Session::Get('vr_re_expedicion_redetrans');

								$porcentaje_seg_reexp       = $this->Transportadoras[0]['rt_carga_porciento_reexpedicion']/100;
								$porciento_dscto_ccial      = $this->Transportadoras[0]['rt_carga_descuento_comercial']/100;

								$this->valor_flete          = $peso_kilos_pedido * $vr_kilo_idmcipio_redetrans ;


       	if ($this->valor_flete < $this->Transportadoras[0]['rt_carga_vr_minimo_unidad'])
       		  {
       		  	$this->valor_flete = $this->Transportadoras[0]['rt_carga_vr_minimo_unidad'];
       		  }

       		$seguro_fijo = $cant_unidades_despacho * $this->Transportadoras[0]['rt_carga_vr_seguro_fijo_unidad'];

       		if ($this->re_expedicion==1 and $valor_declarado > $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'])
       		{
       				$seguro_reexpedicion = $valor_declarado * $porcentaje_seg_reexp;
       		}else
       		{
       				$seguro_reexpedicion = $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'] * $porcentaje_seg_reexp;
       		}
       		$seguro_flete = 	$seguro_reexpedicion;

       		if ($seguro_fijo > $seguro_reexpedicion)
       		{
       				$seguro_flete  = $seguro_fijo;
       		}else
       		{
       			$seguro_flete  = $seguro_reexpedicion;
       		}
									$this->valor_flete     = $this->valor_flete  + $seguro_flete;

       		if ($this->re_expedicion==0)
       			{
       					$descuento_comercial  = $this->valor_flete * $porciento_dscto_ccial;
       		 }
       		$this->valor_flete  = $this->valor_flete  - $descuento_comercial;

									$this->flete_calculado = TRUE ;
									$this->tipo_tarifa     = 'REDETRANS - CARGA';
       		$this->Adicionar_Cobro_Flete_Transportadora(1,'1572','REDETRANS');
      }

      public function Redetrans_Courrier($peso_pedido_gramos,$valor_declarado)
      {/** MARZO 07 DE 2015
      	*					CALCULA EL VALOR DE FLETE QUE SE CORBRA POR COURRIER EN REDETRANS
      	*/

									$peso_pedido_gramos 		           = $peso_pedido_gramos*1000;
									$this->Transportadoras           = $this->Parametros->Transportadoras();
									$Flete_Redetrans_Courrier        = array('idtercero'=>0, 'valor_flete'=>0, 'aplica'=>FALSE);
									$this->valor_flete               = 0;
									$this->seguro_redetrans_courrier = 0;
									$this->idmcipio                  = Session::Get('idmcipio');
									$this->iddpto                    = Session::Get('iddpto');
									$this->re_expedicion             = Session::Get('re_expedicion');
									$this->tipo_tarifa               = 'REDETRANS - COURRIER';
									$this->flete_calculado           = FALSE ;

									if ($peso_pedido_gramos >= 16000)
									{
										$this->valor_flete        = 0;
									}else
									{
											$this->flete_calculado            = TRUE ;
											$this->Valor_Fletes_Productos_Tron($peso_pedido_gramos,$this->iddpto,$this->re_expedicion );
											$this->cantidad_unidades_despacho = $peso_pedido_gramos/4000;
											$this->cantidad_unidades_despacho = Numeric_Functions::Valor_Absoluto($this->cantidad_unidades_despacho);
											$this->valor_flete                = $this->valor_flete  * $this->cantidad_unidades_despacho;
											if ($valor_declarado > $this->Transportadoras[0]['rt_courrier_seguro'] )
											{
													$this->seguro_redetrans_courrier = $valor_declarado  *  $this->Transportadoras[0]['rt_courrier_porciento_seguro_minimo']/100;
													$this->seguro_redetrans_courrier = round($this->seguro_redetrans_courrier,0);
											}
											$this->valor_flete = $this->valor_flete + $this->seguro_redetrans_courrier;
									}
									$this->Adicionar_Cobro_Flete_Transportadora(0,'1572','REDETRANS');
   		  }


						private function Adicionar_Cobro_Flete_Transportadora($posicion,$idtransportadora, $nombre_transportadora)
						{/** MARZO 11 DE 2015
							*						ADICIONA VALORES A VARIABLE DE SESIÓN CON LOS CALCULOS DE CADA UNO DE LOS FLETES QUE SE HAN CALCULADO CON LAS TRANSPORTADORAS
							*/
									$Fletes_Cobrados_Transportadoras                             = Session::Get('Fletes_Cobrados_Transportadoras');
									$Fletes_Cobrados_Transportadoras[$posicion]['idtercero']     = $idtransportadora ;
									$Fletes_Cobrados_Transportadoras[$posicion]['transportador'] = $nombre_transportadora;
									$Fletes_Cobrados_Transportadoras[$posicion]['valor_flete']   = round($this->valor_flete,0);
									$Fletes_Cobrados_Transportadoras[$posicion]['tipo_tarifa']   = $this->tipo_tarifa;
									$Fletes_Cobrados_Transportadoras[$posicion]['aplica']        = $this->flete_calculado;
								 Session::Set('Fletes_Cobrados_Transportadoras',$Fletes_Cobrados_Transportadoras);

						}

      public function Valor_Fletes_Productos_Tron($peso_total_pedido,$iddpto,$re_expedicion)
      {		/** FEBRERO 10 DE 2014
									*	CONSULTA LOS FLETES PARA EL CALCULO DE PRECIOS EN PRODUCTOS TRON. TIENE EN CUENTA EL DEPARTAMENTO,
								 *	PUES SI ES REGIONAL TIENE UN PRECIO DIFERENTE AL PRECIO NACIONAL.
									* EL SISTEMA EVALUA SI SE ENVÍA PARÁMETRO DE REEXPEDICIÓN EN CUYO CASO TOMA LOS VALORES DE LAS COLUMNAS CORRESPONDIENTES
									*/
									$this->valor_flete                  = 0;
									$this->valor_dscto_flete_kit_inicio = 0;
									$this->valor_flete_kit_inicio       = 0;		// VALOR QUE FINALMENTE SE COBRARÁ EN EL KIT DE INICIO POR CONCEPTO DE FLETE.
									$this->Fletes 					         	 		    = $this->Fletes->Consultar_Fletes_Productos_Tron();// TABLA FLETES REDETRANS

									/*
										* EN EL KIT DE INICIO SE COBRARA EL EXCENDE QUE RESULTE DE RESTAR EL VALOR DEL FLETE - EL VALOR PARA "CALI"
										* TOMO EL PRIMER VALOR QUE CORRESPONDERÍA AL PESO Y POSTERIORMENTE, AL FINAL DEL MÉTODO LO OPERO.
									 */
									if ($re_expedicion==0)
										{
											 $this->valor_dscto_flete_kit_inicio= $this->Fletes[0]['courrier_regional']  ;
										}else
										{
											$this->valor_dscto_flete_kit_inicio = $this->Fletes[0]['courrier_nacional']  ;
										}

			      		foreach ($this->Fletes as $Flete)
			      		 {
														$inicio                 = $Flete['inicio'];
														$final                  = $Flete['final'];
														$courrier_regional      = $Flete['courrier_regional'];
														$carga_regional         = $Flete['carga_regional'];
														$courrier_nacional      = $Flete['courrier_nacional'];
														$carga_nacional         = $Flete['carga_nacional'];
														$re_expedicion_regional = $Flete['re_expedicion_regional'];
														$re_expedicion_nacional = $Flete['re_expedicion_nacional'];

													if($peso_total_pedido>=$inicio && $peso_total_pedido<=$final )
													{
														switch ($re_expedicion)
														{
																case '0':
																			if ($iddpto==32)
																			{
																				$this->valor_flete           = $courrier_regional ;
																				$this->tipo_tarifa = 'COURRIER REGIONAL';
																				if ($courrier_regional ==0)
																					{
																						$this->valor_flete   = $carga_regional ;
																						$this->tipo_tarifa   = 'CARGA REGIONAL';
																					}
																			}else
																			{
																				$this->valor_flete  	= $courrier_nacional;//vr_flete_courrier_nacional
																				$this->tipo_tarifa   = 'COURRIER NACIONAL';
																				if ( $this->valor_flete == 0 )
																				{
																					$this->valor_flete  = $courrier_regional;//vr_flete_carga_nacional
																					$this->tipo_tarifa  = 'COURRIER REGIONAL';
																				}
																			}
																		 break;

										 					case '1':
																			if ($iddpto==32)
																			{
																				$this->valor_flete = $re_expedicion_regional;
																				$this->tipo_tarifa = 'RE-EXPEDICION REGIONAL';
																			}else
																			{
																				$this->valor_flete = $re_expedicion_nacional ;
																				$this->tipo_tarifa = 'RE-EXPEDICION NACIONAL';
																			}
																		break;
														} // fin switc

														$this->valor_flete_kit_inicio  = $this->valor_flete   - $this->valor_dscto_flete_kit_inicio;

													}// fin if
			      		}// fin foreach
			      }// fin function


}?>

