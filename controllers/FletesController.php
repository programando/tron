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
						private $tipo_tarifa                  = '';
						private $tipo_despacho  														=	0;
						private $flete_calculado              = FALSE ;
						private $Transportadoras 		           = '';
						private $Cant_Unidades_Despacho 						= 0;
						private $Datos_Carro  																= array();

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
										$this->re_expedicion          = Session::Get('re_expedicion_servientrega');
										$this->idmcipio               = Session::Get('idmcipio');
										$this->iddpto                 = Session::Get('iddpto');
										$this->tipo_despacho										= 3;  // SERVIENTREGA PREMIER
										$this->Transportadoras = $this->Parametros->Transportadoras();

			      	// 1. HALLAR KILOS ADICIONALES
			      	if ($peso_kilos_pedido > 3) 		      	{
			      		$kilos_adicionales = $peso_kilos_pedido - 3;

			      		if ($kilos_adicionales < 0) { $kilos_adicionales = 0 ;}
			      	}

			      	//
			      	if ($this->iddpto != 32) 	{ // No Valle, es Nacional
											$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_nacional'];
											$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_nacional'];
											$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER NACIONAL';

			      	}
			      	if ($this->iddpto == 32) 	{ // Valle
			      			if ($this->idmcipio != 153) {   // VALLE NO CALI
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_zonal'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_zonal'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER DEPARTAMENTAL/ZONAL';
			      			}else	{
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_urbano'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_urbano'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER URBANO';
			      			}
			      	}
			      	if ($this->re_expedicion == 1){
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_reexpedicion'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_reexpedicion'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER REEXPEDICIÓN';
			      	}

										$valor_flete_hasta_3_kilos    = $valor_flete_hasta_3_kilos ;
										$valor_flete_kilos_adiconales = $valor_flete_kilos_adiconales *  $kilos_adicionales ;

										// HALLO EL SEGURO
										if ($valor_declarado < $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'])	{
												$seguro_flete         = $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'];
										}else	{
												$seguro_flete         = $valor_declarado * $this->Transportadoras[0]['sv_premier_porciento_seguro']/100;
											}

											$this->valor_flete     =  $valor_flete_hasta_3_kilos  	 +  $valor_flete_kilos_adiconales  + $seguro_flete ;

											$this->flete_calculado = TRUE ;
          $this->Adicionar_Cobro_Flete_Transportadora(3,'2030','SERVIENTREGA');
      }

      public function Servientrega_Industrial($peso_kilos_pedido,$valor_declarado)
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
								$this->re_expedicion   = Session::Get('re_expedicion_servientrega');
								$this->idmcipio        = Session::Get('idmcipio');
								$this->iddpto          = Session::Get('iddpto');
								$this->Transportadoras = $this->Parametros->Transportadoras();
								$this->Calcular_Numero_Unidades_Despacho($peso_kilos_pedido);
								$this->tipo_despacho										= 4;  // SERVIENTREGA CARGA


								$peso_minimo           = $this->Cant_Unidades_Despacho * $this->Transportadoras['0']['sv_carga_peso_minimo'];

	      	if ($peso_minimo > $peso_kilos_pedido) {
	      		$peso_kilos_pedido = $peso_minimo;
	      	}

	      	$this->valor_flete = $peso_kilos_pedido  * Session::Get('vr_kilo_idmcipio_servientrega');


	      	if ($this->re_expedicion == 0)  	{
	      			$descuento_comercial        = $this->valor_flete  * $this->Transportadoras[0]['sv_descuento_comercial']/100;
	      	}

	      	$this->valor_flete = $this->valor_flete - $descuento_comercial ;

	      if ($this->iddpto != 32) {
									$flete_minimo     = $this->Transportadoras[0]['sv_carga_flete_minimo_nacional'];
									$tasa_manejo      = $this->Transportadoras[0]['sv_carga_tasa_manejo_nacional'];
									$vr_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_nacional'];
									$this->tipo_tarifa   = 'SERVIENTREGA - CARGA NACIONAL';
	      }

	      if ($this->iddpto == 32 ) // Valle
	      {
	      	 if ($this->idmcipio != 153) // No Cali
	      	 {
									$flete_minimo     = $this->Transportadoras[0]['sv_carga_flete_minimo_zonal'];
									$tasa_manejo      = $this->Transportadoras[0]['sv_carga_tasa_manejo_zonal'];
									$vr_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_zonal'];
										$this->tipo_tarifa   = 'SERVIENTREGA - CARGA DEPARTAMENTAL/ZONAL';
								 } else			{ // Cali
									$flete_minimo     = $this->Transportadoras[0]['sv_carga_flete_minimo_reexpedicion'];
									$tasa_manejo      = $this->Transportadoras[0]['sv_carga_tasa_manejo_reexpedicion'];
									$vr_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_urbano'];
									$this->tipo_tarifa   = 'SERVIENTREGA - CARGA URBANO';
									}
							}
	      if ($this->re_expedicion == 1){
											$flete_minimo     = 0;
											$tasa_manejo      = 0;
											$vr_minimo_manejo = 0;
	      }
	      // HALLO EL FLETE MÍNIMO
	      if ( $this->valor_flete < $flete_minimo ){
	      	$this->valor_flete  = $flete_minimo;
	      }
	      //6. APLICAR TASA DE MANEJO Y COMPARAR CON EL VALOR DEL FLETE
	      $costo_manejo  = 0;
							$tasa_manejo  = $tasa_manejo / 100;
							$costo_manejo = $valor_declarado *  $tasa_manejo;
	      if ($costo_manejo < 	$vr_minimo_manejo ){
	      				$costo_manejo = $vr_minimo_manejo ;
	      }
							$this->valor_flete     = $this->valor_flete + $costo_manejo ;
							$this->flete_calculado = TRUE ;
       $this->Adicionar_Cobro_Flete_Transportadora(2,'2030','SERVIENTREGA');
      }



      public function Redetrans_Carga($peso_kilos_pedido,$valor_declarado)
      {/** MARZO 12 DE 2015
      	*				CALCULA EL VALOR DE FLETE QUE SE COBRARA POR CARGA REDE TRANS
      	*/
						$seguro_fijo                = 0;
						$seguro_reexpedicion        = 0;
						$seguro_flete               = 0;
						$descuento_comercial        = 0;
						$this->valor_flete          = 0;
						$this->Transportadoras      = $this->Parametros->Transportadoras();
						$this->re_expedicion        = Session::Get('re_expedicion');
						$vr_kilo_idmcipio_redetrans = Session::Get('vr_kilo_idmcipio_redetrans');
						$vr_re_expedicion_redetrans = Session::Get('vr_re_expedicion_redetrans');
						$porcentaje_seguro 								 = $this->Transportadoras[0]['rt_carga_porciento_seguro']/100;
						$porcentaje_seg_reexp       = $this->Transportadoras[0]['rt_carga_porciento_reexpedicion']/100;
						$porciento_dscto_ccial      = $this->Transportadoras[0]['rt_carga_descuento_comercial']/100;
						$this->idmcipio             = Session::Get('idmcipio');
						$this->iddpto               = Session::Get('iddpto');

								$this->tipo_despacho										= 2;  // CARGA REDETRANS

								$this->Calcular_Numero_Unidades_Despacho($peso_kilos_pedido);
								// DETERMINAR EL TIPO DE TARIFA A APLICAR.  URBANO - REGIONAL - NACIONAL O REEXPEDICION
								//----------------------------------------------------------------------------------------
								if ($this->iddpto == 32 ){		// VALLE
													if ( $this->idmcipio == 153 ){
																	$tipo_destino         ='URBANO';
																	$peso_minino          =	$this->Transportadoras[0]['rdtrans_peso_min_urbano']  ;
																	$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_urbano'] ;
																	$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_urbano']  ;
																	$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_urbano']  ;
													}
													if ( $this->idmcipio != 153 && $this->re_expedicion  == FALSE) {
																	$tipo_destino         ='REGIONAL';
																	$peso_minino          =	$this->Transportadoras[0]['rdtrans_peso_min_regional']  ;
																	$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_regional'] ;
																	$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_regional']  ;
																	$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_regional']  ;
													}
								}
								if ($this->iddpto != 32 ){
																	$tipo_destino         ='NACIONAL';
																	$peso_minino          =	$this->Transportadoras[0]['rdtrans_peso_min_nacional']  ;
																	$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_nacional'] ;
																	$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_nacional']  ;
																	$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_nacional']  ;
								}

								if ( $this->re_expedicion  == TRUE) {
														$tipo_destino         ='RE-EXPEDICION';
														$peso_minino          =	$this->Transportadoras[0]['rdtrans_peso_min_reexpedicion']  ;
														$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_reexpedicion'] ;
														$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_reexpedicion']  ;
														$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_reexpedicion']  ;
										}

							$flete_variable_porc = $flete_variable_porc / 100;

							// DETERMINO PESO REAL DEL PEDIDO
							if ( $peso_kilos_pedido < $peso_minino ){
											$peso_kilos_pedido = $peso_minino;
							}
							//CALCULO EL VALOR DEL FLETE
								$this->valor_flete          = $peso_kilos_pedido * $vr_kilo_idmcipio_redetrans ;

    		if ($this->re_expedicion == 0) {
    					$descuento_comercial  = $this->valor_flete * $porciento_dscto_ccial;
    		 }

    		 $this->valor_flete  = $this->valor_flete  - $descuento_comercial;

								//DETERMINO EL FLETE MÍNIMO
      	if ($this->valor_flete < $flete_minimo) {
      		  	$this->valor_flete = $flete_minimo;
      		  }

      	// SEGURO REEXPEDICION
      	if ( $this->re_expedicion== 0){
      				if ( $valor_declarado > $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'] ){
      							$seguro_reexpedicion = $valor_declarado * $porcentaje_seguro;
      				}else{
      							$seguro_reexpedicion = $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'] * $porcentaje_seguro;
      				}
      	}else{
      			if ( $valor_declarado > $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'] ){
      							$seguro_reexpedicion = $valor_declarado * $porcentaje_seg_reexp;
      			}else{
      							$seguro_reexpedicion = $this->Transportadoras[0]['rt_carga_vr_minimo_asegurable'] * $porcentaje_seg_reexp;
      			}
      	}

 					$seguro_fijo = $this->Cant_Unidades_Despacho * $this->Transportadoras[0]['rt_carga_vr_seguro_fijo_unidad'];
    		$seguro_flete = 	$seguro_reexpedicion;

    		if ($seguro_fijo > $seguro_reexpedicion){
    				$seguro_flete  = $seguro_fijo;
    		}else{
    			$seguro_flete  = $seguro_reexpedicion;
    		}

						$this->valor_flete     = $this->valor_flete  + $seguro_flete;

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
									$this->tipo_despacho													= 1;  // REDETRANS COURRIER

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
											}else{
													$this->seguro_redetrans_courrier = $this->Transportadoras[0]['rt_courrier_seguro'] *  $this->Transportadoras[0]['rt_courrier_porciento_seguro_minimo']/100;
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
									$Fletes_Cobrados_Transportadoras[$posicion]['tipo_despacho']   = $this->tipo_despacho;
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
									Session::Set('subsisio_flete_valle',0);


									/*
										* EN EL KIT DE INICIO SE COBRARA EL EXCENDE QUE RESULTE DE RESTAR EL VALOR DEL FLETE - EL VALOR PARA "CALI"
										* TOMO EL PRIMER VALOR QUE CORRESPONDERÍA AL PESO Y POSTERIORMENTE, AL FINAL DEL MÉTODO LO OPERO.
									 */

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

														// Valle no re-expedicion
														if ( $iddpto == 32 && $re_expedicion == FALSE)	{
																	if($peso_total_pedido >= $inicio && $peso_total_pedido <= $final ) {
																				$this->valor_flete  = $courrier_regional ;
																				$this->tipo_tarifa  = 'COURRIER REGIONAL';
																				Session::Set('subsisio_flete_valle',$courrier_regional);
																			}
															}
														// Valle SI re-expedicion
														if ( $iddpto == 32 && $re_expedicion == TRUE)	{
																	if($peso_total_pedido >= $inicio && $peso_total_pedido <= $final ) {
																				$this->valor_flete  = $re_expedicion_regional ;
																				$this->tipo_tarifa  = 'REEXPEDICION REGIONAL';
																				Session::Set('subsisio_flete_valle',$courrier_regional);
																			}
															}
														// Nacional no reexpedidico
														if ( $iddpto != 32 && $re_expedicion == FALSE)	{
																	if($peso_total_pedido >= $inicio && $peso_total_pedido <= $final ) {
																				$this->valor_flete  = $courrier_nacional ;
																				$this->tipo_tarifa  = 'COURRIER NACIONAL';
																				Session::Set('subsisio_flete_valle',$courrier_regional);
																			}
															}
														// Nacional SI reexpedidico
														if ( $iddpto != 32 && $re_expedicion == TRUE)	{
																	if($peso_total_pedido >= $inicio && $peso_total_pedido <= $final ) {
																				$this->valor_flete  = $re_expedicion_nacional ;
																				$this->tipo_tarifa  = 'COURRIER NACIONAL';
																				Session::Set('subsisio_flete_valle',$courrier_regional);
																			}
															}
			      		}// fin foreach
			      		return $this->valor_flete ;
			      }// fin function


public function Calcular_Numero_Unidades_Despacho($peso_kilos_pedido)
    {/** MARZO 12 de 2015
      *         CALCULA LA CANTIDAD DE UNIDES DE DESPACHO QUE RESULTAN
      */
      /*  38  4 kg.   39  4 kg.   42  4 lts.    122 4 lts(1)    123 4 lts(1)    124 4 lts(1)    145 4 lts.      148 4 lts.
          151 4 kg.   155 4 kg.   160 4 lts.    162 4 lts(1)    163 4 lts.      164 4 lts.(1)   195 4 lts (1)
      */
						$Cant_Unid_No_04_20_Litros    = 0;       // Cantidad de productos que no son 4 y 20 litros
						$Cant_Unid_Si_04_Litros       = 0;      // Cantidad de presentaciones que son 4 litros
						$Cant_Unid_Si_20_Litros       = 0;      // Cantidad de presentaciones que son 20 litros
						$Cant_Unid_No_Industriales    = 0;     // Cantidad de productos que no son industriales
						$this->Cant_Unidades_Despacho = 1;

      $presentaciones_4_litros   = array(38, 39, 42, 122, 123, 124, 145, 148, 151, 155, 160, 162, 163, 164, 195 );
      $presentaciones_20_litros  = array(57, 59, 61, 153, 171, 184, 185 );

      $this->Datos_Carro = Session::Get('carrito');



       foreach ($this->Datos_Carro as $Productos)
        {
          if ($Productos['id_categoria_producto']==6) // Productos industriales
          {
            $ID_Presentacion = $Productos['idpresentacion'];

            // Presentaciones diferentes a 4 litros
            if (!in_array($ID_Presentacion, $presentaciones_4_litros) and !in_array($ID_Presentacion, $presentaciones_20_litros))
              {
                  $Cant_Unid_No_04_20_Litros = $Cant_Unid_No_04_20_Litros + $Productos['cantidad'];
              }
            if (in_array($ID_Presentacion, $presentaciones_4_litros))  // presentaciones iguales a 4 litros
              {
                  $Cant_Unid_Si_04_Litros = $Cant_Unid_Si_04_Litros + $Productos['cantidad'];
              }
            if (in_array($ID_Presentacion,  $presentaciones_20_litros))  // presentaciones iguales a 4 litros
              {
                  $Cant_Unid_Si_20_Litros = $Cant_Unid_Si_20_Litros + $Productos['cantidad'];
              }
          }
          if ($Productos['id_categoria_producto']==7) // Productos que no son industriales
          {
              $Cant_Unid_No_Industriales = $Cant_Unid_No_Industriales + $peso_kilos_pedido;
          }

        }// end foreach
        $Cant_Unid_Si_04_Litros       = Numeric_Functions::Valor_Absoluto($Cant_Unid_Si_04_Litros);
        $Cant_Unid_No_Industriales    = $Cant_Unid_No_Industriales*1000/4000;  // Viene en kilos, lo paso a gramos ( * 1000 )
        $Cant_Unid_No_Industriales    = Numeric_Functions::Valor_Absoluto($Cant_Unid_No_Industriales);
        $this->Cant_Unidades_Despacho = $Cant_Unid_No_04_20_Litros + $Cant_Unid_Si_04_Litros + $Cant_Unid_Si_20_Litros + $Cant_Unid_No_Industriales;

    }



}?>

