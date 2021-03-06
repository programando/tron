<?php

  class FletesController extends Controller {
						private $Cant_Unidades_Despacho 						= 0;
						private $cantidad_unidades_despacho   = 0;		// CANTIDAD DE BOLSAS ( UNIDADES DE DESPACHO ) QUE SE ENTREGAN A LA TRANSPORTADORA
						private $Datos_Carro  																= array();
						private $flete_calculado              = FALSE ;
						private $iddpto                       = 0;
						private $idmcipio                     = 0;
						private $re_expedicion                = 0;
						private $seguro_redetrans_courrier    = 0;
						private $tipo_despacho  														=	0;
						private $tipo_tarifa                  = '';
						private $transportador 															= '';
						private $Transportadoras 		           = '';
						private $valor_seguro																	= 0;
						public 	$valor_dscto_flete_kit_inicio = 0;
						public 	$valor_flete_kit_inicio       = 0;		// VALOR QUE FINALMENTE SE COBRARÁ EN EL KIT DE INICIO POR CONCEPTO DE FLETE.
						public  $valor_flete                  = 0;

      public function __construct() {
          parent::__construct();
										$this->Fletes     = $this->Load_Model('Fletes');
										$this->Parametros = $this->Load_Model('Parametros');
      }

    public function Index() {  }


				public function Calcular_Valor_Fletes_Inicializacion_Variables(){
					    $this->Cant_Unidades_Despacho 			= 0;
					    $Fletes_Cobrados_Transportadoras = array(array('idtercero'=>0, 'valor_flete'=>0, 'aplica'=>FALSE,
					                                               'transportador'=>'', 'tipo_tarifa'=>'','tipo_despacho'=>0));
					    Session::Set('Fletes_Cobrados_Transportadoras',$Fletes_Cobrados_Transportadoras);
				}


    private function Depurar_Fletes_Calculados()   {
      /** ABRIL 03 2016
      *   BORRA TODOS LOS FLETES QUE SEAN IGUALES A CERO.
      */
       	$Fletes_Cobrados_Transportadoras = Session::Get('Fletes_Cobrados_Transportadoras');

       	foreach( $Fletes_Cobrados_Transportadoras as $Indice => $Elemento){
       		 $Valor_Flete  = $Elemento['valor_flete'] ;

										if( empty(  $Valor_Flete ) || $Valor_Flete == 0) {
														unset( $Fletes_Cobrados_Transportadoras [$Indice] ); // BORRAR EL ELEMENTO POR CLAVE
										}
								}
								//REGENERAR LOS INDICES DEL ARRAY
								$Fletes_Cobrados_Transportadoras = array_merge($Fletes_Cobrados_Transportadoras);
        Session::Set('Fletes_Cobrados_Transportadoras', $Fletes_Cobrados_Transportadoras );
    }



    public function Encontrar_Mejor_Flete() {
     /**  MARZO 12 DE 2015
      *       VERIFICA DE LOS FLETES ENCONTRADOS EL MEJOR PARA ASIGNARLO AL PEDIDO
      */
      $this->Depurar_Fletes_Calculados();
						$i                               = 0;
						$Fletes_Cobrados_Transportadoras = Session::Get('Fletes_Cobrados_Transportadoras');

						$Asignar_Flete                   = TRUE;
						$this->valor_flete               = 0;
					 $Mejor_Flete   																		= current($Fletes_Cobrados_Transportadoras) ;//[0];

      foreach ($Fletes_Cobrados_Transportadoras as $Fletes)   {
	      	if (  array_key_exists($i,$Fletes_Cobrados_Transportadoras ) && ( $Asignar_Flete  == TRUE &&  $Fletes['valor_flete'] > 0 )	)  {
												$Mejor_Flete   = $Fletes_Cobrados_Transportadoras[$i];
												$Asignar_Flete = FALSE ;
											}

	      		if ( $Mejor_Flete['valor_flete'] > 0 && $Mejor_Flete['valor_flete'] > $Fletes['valor_flete'] && $Fletes['valor_flete'] > 0 ){
	        	   $Mejor_Flete['idtercero']     = $Fletes['idtercero']   ;
	            $Mejor_Flete['valor_flete']   = $Fletes['valor_flete'] ;
	            $Mejor_Flete['tipo_tarifa']   = $Fletes['tipo_tarifa'] ;
	            $Mejor_Flete['tipo_despacho'] = $Fletes['tipo_despacho'] ;
	      		   }
	          $i++;
        }

      if ( isset($Mejor_Flete)){
          $this->valor_flete                  = $Mejor_Flete['valor_flete']  + Session::Get('kit_vr_transporte');
          Session::Set('flete_real_calculado', $this->valor_flete);
          Session::Set('id_transportadora',    $Mejor_Flete['idtercero']);
          Session::Set('tipo_despacho_pedido', $Mejor_Flete['tipo_despacho'] );
          Session::Set('tipo_tarifa',          $Mejor_Flete['tipo_tarifa']);
        }else{
          $this->valor_flete                  =   Session::Get('kit_vr_transporte');
          Session::Set('flete_real_calculado', $this->valor_flete);
          Session::Set('id_transportadora',   '1572'); // 1572 REDETRANS
          Session::Set('tipo_despacho_pedido', 1 );     /// REDETRANS COURRIER
          Session::Set('tipo_tarifa', 'REDETRANS COURRIER');
        }



    }

      public function Vr_Transporte_Kit_Inicio($kit_inicio_peso_total,$kit_cantidad ){
      			 Session::Set('kit_vr_transporte',0);
      			 Session::Set('subsidio_total_kit_inicio',0);
										$kit_vr_venta_valle           = Session::Get('kit_vr_venta_valle');
										$subsidio_transporte_tron     = Session::Get('subsidio_transporte_tron') * $kit_cantidad ;
										// HALLAR EL VALOR DEL FLETE REAL
										$this->Valor_Fletes_Productos_Tron($kit_inicio_peso_total , Session::Get('iddpto') , Session::Get('re_expedicion') );
										$this->valor_flete = ( $this->valor_flete * $kit_cantidad ) -  $subsidio_transporte_tron ;
										Session::Set('kit_vr_transporte', $this->valor_flete );
										Session::Set('subsidio_total_kit_inicio',$subsidio_transporte_tron);

      }





      public function Sevientrega_Premier( $Peso_Pedido, $Valor_Declarado )  {
      /** MARZO 16 DE 2015
      	*				CALCULA VALOR DE FLETE SE COBRARÁ POR SERVIENTREGA PREMIER
      	*/

								Session::Set('SERVIENTREGA_PREMIER_VR_FLETE', 0 );
								$servientrega_tipo_despacho = trim(Session::Get('servientrega_tipo_despacho'));


										$kilos_adicionales            = 0;
										$valor_flete_hasta_3_kilos    = 0;
										$valor_flete_kilos_adiconales = 0;
										$seguro_flete                 = 0;
										$this->valor_flete            = 0;
										$this->re_expedicion          = Session::Get('re_expedicion_servientrega');
										$this->idmcipio               = Session::Get('idmcipio');
										$this->iddpto                 = Session::Get('iddpto');
										$this->tipo_despacho										= 3;  // SERVIENTREGA PREMIER
										$this->Transportadoras 							= $this->Parametros->Transportadoras();
										$Peso_Pedido 																	= $Peso_Pedido / 1000;
										$this->tipo_tarifa												='';

	      	 if ( empty($servientrega_tipo_despacho)){
	      	 		$this->Adicionar_Cobro_Flete_Transportadora(3,'0','SERVIENTREGA-PREMIER -> NO APLICA');
	      	 	return ;
	      	 }

			      	// 1. HALLAR KILOS ADICIONALES
			      	if ($Peso_Pedido > 3) 		      	{
			      		$kilos_adicionales = $Peso_Pedido - 3;
			      		if ($kilos_adicionales < 0) { $kilos_adicionales = 0 ;}
			      	}



			      	if ( $servientrega_tipo_despacho == 'NACION' ){
											$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_nacional'];
											$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_nacional'];
											$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER NACIONAL';
			      	}
			      	if ( $servientrega_tipo_despacho == 'ZONAL' ){
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_zonal'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_zonal'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER DEPARTAMENTAL/ZONAL';
			 							}
			 							if ( $servientrega_tipo_despacho == 'URBANO' ){
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_urbano'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_urbano'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER URBANO';
			      			}
 								if ( $servientrega_tipo_despacho == 'REEXPE' ){
														$valor_flete_hasta_3_kilos    = $this->Transportadoras[0]['sv_premier_vr_kilo_1_3_reexpedicion'];
														$valor_flete_kilos_adiconales = $this->Transportadoras[0]['sv_premier_vr_kilo_mayor_3_reexpedicion'];
														$this->tipo_tarifa            = 'SERVIENTREGA - PREMIER REEXPEDICIÓN';
			      	}


										$valor_flete_hasta_3_kilos    = $valor_flete_hasta_3_kilos ;
										$valor_flete_kilos_adiconales = $valor_flete_kilos_adiconales *  $kilos_adicionales ;

										// HALLO EL SEGURO
										$seguro_flete = $Valor_Declarado  * $this->Transportadoras[0]['sv_premier_porciento_seguro']/100;


										if ($seguro_flete < $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'])	{
												$seguro_flete         = $this->Transportadoras[0]['sv_premier_vr_seguro_minimo'];
										}

										$fletes = $valor_flete_hasta_3_kilos  	 +  $valor_flete_kilos_adiconales  ;
										if ( $fletes > 0 ) {
												$this->valor_flete     =  $fletes  + $seguro_flete ;
											}else{
													$this->valor_flete  = 0;
											}

										$this->valor_seguro = $seguro_flete ;
										Session::Set('SERVIENTREGA_PREMIER_VR_FLETE',  $this->valor_flete);
										Session::Set('SERVIENTREGA_PREMIER_VR_SEGURO', $this->valor_seguro) ;
										$this->flete_calculado = TRUE ;
          $this->Adicionar_Cobro_Flete_Transportadora(3,'2030','SERVIENTREGA PREMIER');
      }

      public function Servientrega_Industrial( $Numero_Unidades, $Valor_Declarado, $Peso_Pedido ) {
      /**  MAZO 16 DE 2015
      	*							CALCULA EL VALOR DE FLETE QUE SE COBRARA POR CARGA INDUSTRIAL SERVIENTREGA

       	*/

      	 Session::Set('SERVIENTREGA_INDUSTRIAL_VR_FLETE', 0 );

      	 $servientrega_tipo_despacho = Session::Get('servientrega_tipo_despacho');

								$descuento_comercial   = 0;
								$tasa_manejo           = 0;
								$valor_minimo_manejo   = 0;
								$seguro_fijo           = 0;
								$vr_minimo_manejo 					= 0;
								$seguro_variable       = 0;
								$seguro_flete          = 0;
								$this->valor_flete     = 0 ;
								$this->tipo_tarifa     = '';

								$this->re_expedicion   = Session::Get('re_expedicion_servientrega');
								$this->idmcipio        = Session::Get('idmcipio');
								$this->iddpto          = Session::Get('iddpto');
								$this->Transportadoras = $this->Parametros->Transportadoras();
								$Peso_Pedido 									 = $Peso_Pedido / 1000;

								$this->tipo_despacho   = 4;  // SERVIENTREGA CARGA

      	 if ( empty($servientrega_tipo_despacho)){
      	 	$this->Adicionar_Cobro_Flete_Transportadora(2,'0','SERVIENTREGA-INDUSTRIAL -> NO APLICA');
      	 	return ;
      	 }



								$peso_minimo           = $Numero_Unidades * $this->Transportadoras['0']['sv_carga_peso_minimo'];
	      	if ($peso_minimo > $Peso_Pedido) {
	      		$Peso_Pedido = $peso_minimo;
	      	}

	      	$this->valor_flete = $Peso_Pedido  * Session::Get('vr_kilo_idmcipio_servientrega');
	      	if ($this->re_expedicion == 0)  	{
	      			$descuento_comercial        = $this->valor_flete  * $this->Transportadoras[0]['sv_descuento_comercial']/100;
	      	}
	      	$this->valor_flete = $this->valor_flete - $descuento_comercial ;
	      	$servientrega_tipo_despacho  = trim(Session::Get('servientrega_tipo_despacho'));

	      	switch ($servientrega_tipo_despacho) {
		      		case 'NACION':
		      									$flete_minimo      = $this->Transportadoras[0]['sv_carga_flete_minimo_nacional'];
																	$tasa_manejo       = $this->Transportadoras[0]['sv_carga_tasa_manejo_nacional'];
																 $vr_minimo_manejo  = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_nacional'];
																 $this->tipo_tarifa = 'SERVIENTREGA - INDUSTRIAL NACIONAL';
		      					break;

		      		case 'ZONAL':
																	$flete_minimo     = $this->Transportadoras[0]['sv_carga_flete_minimo_zonal'];
																	$tasa_manejo      = $this->Transportadoras[0]['sv_carga_tasa_manejo_zonal'];
																	$vr_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_zonal'];
																	$this->tipo_tarifa   = 'SERVIENTREGA - INDUSTRIAL DEPARTAMENTAL/ZONAL';
		      					break;

		      		case 'URBANO':
																$flete_minimo     = $this->Transportadoras[0]['sv_carga_flete_minimo_reexpedicion'];// Aunque dice reexpedidion se trata de zonal/urbano
																$tasa_manejo      = $this->Transportadoras[0]['sv_carga_tasa_manejo_reexpedicion'];
																$vr_minimo_manejo = $this->Transportadoras[0]['sv_carga_vr_manejo_minimo_urbano'];
																$this->tipo_tarifa   = 'SERVIENTREGA - INDUSTRIAL URBANO';
		      					break;
		      		default:
													$flete_minimo      = 0;
													$tasa_manejo       = 0;
													$vr_minimo_manejo  = 0;
													$this->tipo_tarifa = '';
													$this->valor_flete = 0;
													break;
	      	}

	      if ($this->re_expedicion == 1){
											$flete_minimo     = 0;
											$tasa_manejo      = 0;
											$vr_minimo_manejo = 0;
	      }

	      // HALLO EL FLETE MÍNIMO
	      if ( $this->valor_flete < ( $flete_minimo * $Numero_Unidades) ){
	      	$this->valor_flete  = $flete_minimo * $Numero_Unidades;
	      }

	      //6. APLICAR TASA DE MANEJO Y COMPARAR CON EL VALOR DEL FLETE
							$costo_manejo     = 0;
							$tasa_manejo      = $tasa_manejo / 100;
							$costo_manejo     = $Valor_Declarado *  $tasa_manejo;
							$vr_minimo_manejo = $vr_minimo_manejo  * $Numero_Unidades;

	      if ($costo_manejo < 	$vr_minimo_manejo ){
	      				$costo_manejo = $vr_minimo_manejo ;
	      }

							$this->valor_flete     = $this->valor_flete + $costo_manejo ;
							if ( Session::Get('vr_kilo_idmcipio_servientrega') == 0 ){
									$this->valor_flete  = 0;
							}

							$this->valor_seguro = $costo_manejo ;
							Session::Set('SERVIENTREGA_INDUSTRIAL_VR_FLETE',$this->valor_flete);
							$this->flete_calculado = TRUE ;
       $this->Adicionar_Cobro_Flete_Transportadora(2,'2030','SERVIENTREGA INDUSTRIAL');
      }


				private function Redetrans_Carga_Evaluar_Peso_Minimo ($Peso_Minimo_Calculado, $Peso_Total_Pedido   ){
							if ( $Peso_Minimo_Calculado < $Peso_Total_Pedido ){
										$Peso_Minimo_Calculado = $Peso_Total_Pedido  ;
							}

							return $Peso_Minimo_Calculado;
				}

      public function Redetrans_Carga( $Numero_Unidades, $Valor_Declarado, $Peso_Pedido ) {
      /** MARZO 12 DE 2015
      	*				CALCULA EL VALOR DE FLETE QUE SE COBRARA POR CARGA REDE TRANS
		  */
		 
      Session::Set('REDETRANS_CARGA_VR_FLETE'        ,0);

						$seguro_fijo                  = 0;
						$seguro_reexpedicion          = 0;
						$seguro_flete                 = 0;
						$descuento_comercial          = 0;
						$this->valor_flete            = 0;
						$Peso_Pedido                  = $Peso_Pedido / 1000;

						$this->Transportadoras        = $this->Parametros->Transportadoras();
						$this->re_expedicion          = Session::Get('re_expedicion');
						$vr_kilo_idmcipio_redetrans   = Session::Get('vr_kilo_idmcipio_redetrans');
						$vr_re_expedicion_redetrans   = Session::Get('vr_re_expedicion_redetrans');
						$porcentaje_seguro            = $this->Transportadoras[0]['rt_carga_porciento_seguro']/100;
						$porcentaje_seg_reexp         = $this->Transportadoras[0]['rt_carga_porciento_reexpedicion']/100;
						$porciento_dscto_ccial        = $this->Transportadoras[0]['rt_carga_descuento_comercial']/100;
						$this->idmcipio               = Session::Get('idmcipio');
						$this->iddpto                 = Session::Get('iddpto');



						$this->tipo_despacho          = 2;  // CARGA REDETRANS
						$this->Cant_Unidades_Despacho = $Numero_Unidades;

						$redetrans_tipo_despacho      =  Session::Get('redetrans_tipo_despacho');
 

      if (  empty( $redetrans_tipo_despacho ) ){
      	$this->Adicionar_Cobro_Flete_Transportadora(1,'0','REDETRANS - CARGA -> NO APLICA');
      	return ;
      }
								// DETERMINAR EL TIPO DE TARIFA A APLICAR.  URBANO - REGIONAL - NACIONAL O REEXPEDICION
								//----------------------------------------------------------------------------------------

							if ( $this->re_expedicion  == FALSE) {
											if ($this->iddpto == 32 ){		// VALLE
																if ( $this->idmcipio == 153 ){
																				$tipo_destino         ='URBANO';
																				if ( $this->Cant_Unidades_Despacho <= 1 ){
																					$peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_urbano']  ;
																				}else{
																						$peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_urbano_mayor_2_cajas']  * $this->Cant_Unidades_Despacho  ;
																						$peso_minimo										= $this->Redetrans_Carga_Evaluar_Peso_Minimo ($peso_minimo, $Peso_Pedido );
																				}
																				$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_urbano'] ;
																				$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_urbano']  ;
																				$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_urbano']  ;
																}

																if ( $this->idmcipio != 153  ) {
																				$tipo_destino         ='REGIONAL';

																				if ( $this->Cant_Unidades_Despacho <= 1 ){
																					$peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_regional']  ;
																				}else{
																						$peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_regional_mayor_2_cajas']  * $this->Cant_Unidades_Despacho  ;
																						$peso_minimo										= $this->Redetrans_Carga_Evaluar_Peso_Minimo ($peso_minimo, $Peso_Pedido );
																				}
																				$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_regional'] ;
																				$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_regional']  ;
																				$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_regional']  ;
																}
											}

											if ($this->iddpto != 32 ){
																				$tipo_destino         ='NACIONAL';
																				if ( $this->Cant_Unidades_Despacho <= 1 ){
																					 $peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_nacional']  ;

																				}else{
																						$peso_minimo          =	$this->Transportadoras[0]['rdtrans_peso_min_nacional_mayor_2_cajas']  * $this->Cant_Unidades_Despacho  ;

																						$peso_minimo										= $this->Redetrans_Carga_Evaluar_Peso_Minimo ($peso_minimo, $Peso_Pedido );

																				}
																				$flete_minimo         =	$this->Transportadoras[0]['rdtrans_flete_min_nacional'] ;
																				$flete_variable_porc  =	$this->Transportadoras[0]['rdtrans_flete_variable_porc_nacional']  ;
																				$flete_variable_valor =	$this->Transportadoras[0]['rdtrans_flete_variable_valor_nacional']  ;
												}
								}



								if ( $this->re_expedicion  == TRUE) {
														$tipo_destino               ='RE-EXPEDICION';
														$peso_minimo                =	$this->Transportadoras[0]['rdtrans_peso_min_reexpedicion']  ;
														$vr_kilo_idmcipio_redetrans = $vr_re_expedicion_redetrans;
														$flete_minimo               = $vr_kilo_idmcipio_redetrans * $peso_minimo   * $this->Cant_Unidades_Despacho  ;
										}else{
											$flete_minimo = $flete_minimo * $this->Cant_Unidades_Despacho ;
										}


							// DETERMINO PESO REAL DEL PEDIDO
							if ( $Peso_Pedido < $peso_minimo ){
											$Peso_Pedido = $peso_minimo;
							}

							//CALCULO EL VALOR DEL FLETE
								$this->valor_flete          = $Peso_Pedido * $vr_kilo_idmcipio_redetrans ;



    		if ($this->re_expedicion == 0) {
    					$descuento_comercial  = $this->valor_flete * $porciento_dscto_ccial;
    		 }

    		 $this->valor_flete  = $this->valor_flete  - $descuento_comercial;


								//DETERMINO EL FLETE MÍNIMO
      	if ($this->valor_flete < $flete_minimo) {
      		  	$this->valor_flete = $flete_minimo;
      		  }

							/**SEGURO
							*--------------------------------------------------------
							* SEGURO 1.... % SOBRE EL VALOR DECLARADO ... MINU Unids
							*--------------------------------------------------------*/
							$seguro        = 0;
							$seguro_minimo = 0;

						if ( $this->re_expedicion== 0){
									$seguro  = $Valor_Declarado * $this->Transportadoras[0]['rt_carga_porciento_seguro']/100;
									if ($seguro < $this->Transportadoras[0]['rdtrans_carga_vr_seguro_minimo']){
											 $seguro  = $this->Transportadoras[0]['rdtrans_carga_vr_seguro_minimo'];
									}
									$seguro_minimo = $Numero_Unidades * $this->Transportadoras[0]['rdtrans_carga_vr_seguro_fijo_unidad'];
								}else{ /// ES REEXPEDICION
									$seguro  = $Valor_Declarado * $this->Transportadoras[0]['rt_carga_porciento_reexpedicion']/100;
									if ( $seguro < $this->Transportadoras[0]['rdtrans_carga_vr_seguro_minimo_reexp']){
											$seguro = $this->Transportadoras[0]['rdtrans_carga_vr_seguro_minimo_reexp'];
									}
									$seguro_minimo = $Numero_Unidades * $this->Transportadoras[0]['rdtrans_carga_vr_seguro_fijo_unidad_reexp'];
								}

								$seguro_flete = $seguro ;
								if ($seguro_minimo > 	$seguro ){
									$seguro_flete = $seguro_minimo ;
								}

								if ( $this->valor_flete  > 0 ) {
											$this->valor_flete     = $this->valor_flete  + $seguro_flete;
											}else{
											 	$this->valor_flete   = 0;
											}
											$this->valor_seguro = $seguro_flete;

								Session::Set('REDETRANS_CARGA_VR_FLETE',$this->valor_flete);
								$this->flete_calculado = TRUE ;
								$this->tipo_tarifa     = 'REDETRANS - CARGA';
		    		$this->Adicionar_Cobro_Flete_Transportadora(1,'1572','REDETRANS');

 

      }

      public function Redetrans_Courrier( $Peso_Pedido, $Costo_Total, $id_dpto = 0, $re_expedidion = 0 )      {
       /** MARZO 07 DE 2015
      	*					CALCULA EL VALOR DE FLETE QUE SE CORBRA POR COURRIER EN REDETRANS
		  */
		  
      	$re_expedidion = Session::Get('re_expedicion');
      	  Session::Set('REDETRANS_COURRIER_VR_FLETE',  0 );
		 						Session::Set('REDETRANS_COURRIER_VR_SEGURO', 0 );
      	  $this->valor_flete               = 0;
									$this->seguro_redetrans_courrier = 0;
									$this->tipo_tarifa     									 = 'REDETRANS-COURRIER';

		      $redetrans_tipo_despacho =  Session::Get('redetrans_tipo_despacho');


		      if (  empty($redetrans_tipo_despacho) ){
		      		$this->valor_flete  = 0 ;
		      		$this->valor_seguro = 0;
		      		$this->Adicionar_Cobro_Flete_Transportadora(0,'0','REDETRANS-COURRIER -> NO APLICA');
		      	return ;
		      }


									$Parametros       = $this->Parametros->Transportadoras();
									$MinimoSeguro     = $Parametros [0]['rt_courrier_seguro'];
									$PorcientoSeguro  = $Parametros [0]['rt_courrier_porciento_seguro_minimo']/100;
									$MinimoAsegurable = $Parametros [0]['rt_carga_vr_minimo_asegurable'];
									$TasaSeguro       = $Parametros [0]['rt_carga_porciento_seguro'];
									$TasaSeguro_Reexp = $Parametros [0]['rt_carga_porciento_reexpedicion']/100;
									$Peso_Maximo      = 4000;

									$this->tipo_tarifa               = 'REDETRANS - COURRIER';
									$this->flete_calculado           = FALSE ;
									$this->tipo_despacho													= 1;  // REDETRANS COURRIER
									if ( $id_dpto == 0 ) {
								 			$this->iddpto                    = Session::Get('iddpto');
												$this->re_expedicion             = Session::Get('re_expedicion');
											}else{
											 $this->iddpto                    = $id_dpto;
												$this->re_expedicion             = $re_expedidion ;
											}

									if ( $this->iddpto == 32  ){
														$this->tipo_tarifa 			= 'REDETRANS - COURRIER - REGIONAL';
														$Vr_Primer_Kilo       = $Parametros [0]['rdtrans_courrier_vr_kg_regional'];
														$Vr_Kilo_Adicional 			= $Parametros[0]['rdtrans_courrier_vr_kg_regional_adic'];

									}else{
															$this->tipo_tarifa    = 'REDETRANS - COURRIER - NACIONAL';
															$Vr_Primer_Kilo 				  = $Parametros[0]['rdtrans_courrier_vr_kg_nacional'];
															$Vr_Kilo_Adicional 			= $Parametros[0]['rdtrans_courrier_vr_kg_nacional_adic'];
									}
									if ( $this->re_expedicion == TRUE ){
														$this->tipo_tarifa    = 'REDETRANS - COURRIER - REEXPEDICION';
														$Vr_Primer_Kilo 						= $Parametros[0]['rdtrans_courrier_vr_kg_reexp'];
														$Vr_Kilo_Adicional 			= $Parametros[0]['rdtrans_courrier_vr_kg_reexp_adic'];
									}

									//Debug::Mostrar($this->re_expedicion  );
									//Debug::Mostrar( Session::Get('idmcipio') );

									$Numero_Bolsas         = (int)( $Peso_Pedido/$Peso_Maximo);
									$Flete_Bolsa_Completa  = $Vr_Primer_Kilo  + ( 3 * $Vr_Kilo_Adicional );

									$Flete_Bolsa_Completa  = $Flete_Bolsa_Completa * $Numero_Bolsas ;

									$Peso_Bolsa_Incompleta = $Peso_Pedido - ( (int)($Peso_Pedido /$Peso_Maximo) * $Peso_Maximo );


									if ( $Peso_Bolsa_Incompleta <= 1000 ){
												$Flete_Bolsa_Incompleta = $Vr_Primer_Kilo;
									}
									if ($Peso_Bolsa_Incompleta >= 1001 && $Peso_Bolsa_Incompleta <= 2000  ){
												$Flete_Bolsa_Incompleta = $Vr_Primer_Kilo + $Vr_Kilo_Adicional ;
									}
									if ($Peso_Bolsa_Incompleta >= 2001 && $Peso_Bolsa_Incompleta <= 3000  ){
												$Flete_Bolsa_Incompleta = $Vr_Primer_Kilo + ( 2 * $Vr_Kilo_Adicional ) ;
									}
									if ($Peso_Bolsa_Incompleta >= 3001 && $Peso_Bolsa_Incompleta <= 4000  ){
												$Flete_Bolsa_Incompleta = $Vr_Primer_Kilo + ( 3 * $Vr_Kilo_Adicional ) ;
									}
									$Flete_Total = $Flete_Bolsa_Completa + $Flete_Bolsa_Incompleta ;


										if ( $Costo_Total >  $Parametros[0]['rt_courrier_seguro'] )		{
												$this->seguro_redetrans_courrier = $Costo_Total  * $PorcientoSeguro;
										}else{
												$this->seguro_redetrans_courrier = 0 ;//$MinimoSeguro *  $PorcientoSeguro;
										}



										if ( $Flete_Total > 0 ) {
												$this->valor_flete = $Flete_Total + $this->seguro_redetrans_courrier;
											}else{
													$this->valor_flete = 0;
											}


										$this->valor_seguro = $this->seguro_redetrans_courrier;
		 							Session::Set('REDETRANS_COURRIER_VR_FLETE', $this->valor_flete );
		 							Session::Set('REDETRANS_COURRIER_VR_SEGURO', $this->seguro_redetrans_courrier);
										$this->flete_calculado = TRUE ;
				    		$this->Adicionar_Cobro_Flete_Transportadora(0,'1572','REDETRANS COURRIER');

   		  }




						private function Adicionar_Cobro_Flete_Transportadora($posicion,$idtransportadora, $nombre_transportadora)
						{/** MARZO 11 DE 2015
							*						ADICIONA VALORES A VARIABLE DE SESIÓN CON LOS CALCULOS DE CADA UNO DE LOS FLETES QUE SE HAN CALCULADO CON LAS TRANSPORTADORAS
							*/

									$Fletes_Cobrados_Transportadoras                             = Session::Get('Fletes_Cobrados_Transportadoras');
									$Fletes_Cobrados_Transportadoras[$posicion]['idtercero']     = $idtransportadora ;
									$Fletes_Cobrados_Transportadoras[$posicion]['transportador'] = $nombre_transportadora;
									$Fletes_Cobrados_Transportadoras[$posicion]['valor_seguro '] = round($this->valor_seguro,0);
									$Fletes_Cobrados_Transportadoras[$posicion]['valor_flete']   = round($this->valor_flete,0);
									$Fletes_Cobrados_Transportadoras[$posicion]['tipo_tarifa']   = $this->tipo_tarifa;
									$Fletes_Cobrados_Transportadoras[$posicion]['tipo_despacho'] = $this->tipo_despacho;
									$Fletes_Cobrados_Transportadoras[$posicion]['aplica']        = round($this->flete_calculado,0);
								 Session::Set('Fletes_Cobrados_Transportadoras',$Fletes_Cobrados_Transportadoras);

						}

      public function Valor_Fletes_Productos_Tron($peso_total_pedido,$iddpto,$re_expedicion){
        /** FEBRERO 10 DE 2014
									*	CONSULTA LOS FLETES PARA EL CALCULO DE PRECIOS EN PRODUCTOS TRON. TIENE EN CUENTA EL DEPARTAMENTO,
								 *	PUES SI ES REGIONAL TIENE UN PRECIO DIFERENTE AL PRECIO NACIONAL.
									* EL SISTEMA EVALUA SI SE ENVÍA PARÁMETRO DE REEXPEDICIÓN EN CUYO CASO TOMA LOS VALORES DE LAS COLUMNAS CORRESPONDIENTES
									*/
									$this->valor_flete                  = 0;
									$this->valor_dscto_flete_kit_inicio = 0;
									$this->valor_flete_kit_inicio       = 0;		// VALOR QUE FINALMENTE SE COBRARÁ EN EL KIT DE INICIO POR CONCEPTO DE FLETE.
									$Tabla_Fletes 					         	 		    = $this->Fletes->Consultar_Fletes_Productos_Tron();// TABLA FLETES REDETRANS
									Session::Set('subsisio_flete_valle',0);

			      		foreach ($Tabla_Fletes as $Flete) 		 {
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
																				$this->tipo_tarifa  = 'COURRIER REEXPEDICION REGIONAL';
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
																				$this->tipo_tarifa  = 'COURRIER REEXPEDICION NACIONAL';
																				Session::Set('subsisio_flete_valle',$courrier_regional);
																			}
															}
			      		}// fin foreach
			      		return $this->valor_flete ;
			      }// fin function





public function Numero_Unidades_Despacho() {
			    /** MARZO 12 de 2015
			      *         CALCULA LA CANTIDAD DE UNIDES DE DESPACHO QUE RESULTAN
			      */
							$_20_Litros_Garrafas_Presentaciones           = array(46, 49, 54, 57, 59, 61, 62, 70, 71, 72, 73, 74, 75, 76, 103, 104, 105,106, 108,110, 111, 112, 113, 114, 115, 130, 147, 153, 154, 156, 171, 173, 184, 185, 186, 190 );
							$_20_Litros_Garrafas_Cantidad                 = 0;
							$_20_Litros_Garrafas_Vr_Declarado             = 0;
							$_20_Litros_Garrafas_Vr_Declarado_ocasional   = 0;
							$_20_Litros_Garrafas_Vr_Declarado_tron        = 0;
							$_20_Litros_Garrafas_Peso_Gramos              = 0;
							$_20_Litros_Garrafas_Subsidio_Flete           = 0;
							$_20_Litros_Garrafas_Subsidio_Flete_Ocasional = 0;
							$_20_Litros_Garrafas_Subsidio_Flete_Tron      = 0;

							$_20_Litros_Garrafas_Recaudo                  = 0;
							$_20_Litros_Garrafas_Recaudo_Ocasional        = 0;
							$_20_Litros_Garrafas_Recaudo_Tron             = 0;

							$_20_Litros_Garrafas_Vr_Compra                = 0;
							$_20_Litros_Garrafas_Vr_Compra_Ocasional      = 0;

							$_20_Litros_Garrafas_Unidades                 = 0;


							$_04_Litros_Galon_Presentaciones              = array(17,30, 38, 145, 148, 151, 155, 157, 160, 163, 164, 179, 195, 196, 281, 282, 287, 39, 42, 122, 123, 124, 162 );
							$_04_Litros_Galon_Cantidad                    = 0;
							$_04_Litros_Galon_Vr_Declarado                = 0;
							$_04_Litros_Galon_Vr_Declarado_ocasional      = 0;
							$_04_Litros_Galon_Vr_Declarado_tron           = 0;
							$_04_Litros_Galon_Peso_Gramos                 = 0;
							$_04_Litros_Galon_Subsidio_Flete              = 0;
							$_04_Litros_Galon_Subsidio_Flete_Ocasional    = 0;
							$_04_Litros_Galon_Subsidio_Flete_Tron         = 0;

							$_04_Litros_Galon_Recaudo                     = 0;
							$_04_Litros_Galon_Recaudo_Ocasional           = 0;
							$_04_Litros_Galon_Recaudo_Tron                = 0;

							$_04_Litros_Galon_Vr_Compra                   = 0;
							$_04_Litros_Galon_Vr_Compra_Ocasional         = 0;
							$_04_Litros_Galon_Unidades                    = 0;

							$_Otros_Productos_Presentaciones              = array(144, 85, 87, 90, 149, 192 ) ;
							$_Otros_Productos_Vr_Declarado                = 0;
							$_Otros_Productos_Vr_Declarado_ocasional      = 0;
							$_Otros_Productos_Vr_Declarado_tron           = 0;
							$_Otros_Productos_Peso_Gramos                 = 0;
							$_Otros_Productos_Subsidio_Flete              = 0;
							$_Otros_Productos_Subsidio_Flete_Ocasional    = 0;
							$_Otros_Productos_Subsidio_Flete_Tron 		  = 0;

							$_Otros_Productos_Recaudo             		  = 0;
							$_Otros_Productos_Recaudo_Ocasional   		  = 0;
							$_Otros_Productos_Recaudo_Tron        		  = 0;

							$_Otros_Productos_Vr_Compra           		  = 0;
							$_Otros_Productos_Unidades            		  = 0;

							$Carga_Fija_Vr_Compra 						   = 0;
							$Carga_Fija_Vr_Compra_Ocasional				   = 0;
							$_Otros_Productos_Cantidad  				   = 0;

							$Espacio_Libre								   = 0;					
							$_Courrier_Unidades							   = 0;
							$_Carga_Variable_Unidades					   = 0;

							Session::Set('Unidades_Adicionales', FALSE );
			      $this->Datos_Carro = Session::Get('carrito');

			       foreach ($this->Datos_Carro as &$Productos){
													$ID_Presentacion       = $Productos['idpresentacion'] ;
													$ID_categoria_producto = $Productos['id_categoria_producto'];



			          if ( in_array($ID_Presentacion, $_20_Litros_Garrafas_Presentaciones )) {
							$_20_Litros_Garrafas_Cantidad                 = $_20_Litros_Garrafas_Cantidad  														 + $Productos['cantidad'];

							$_20_Litros_Garrafas_Vr_Declarado             = $_20_Litros_Garrafas_Vr_Declarado 												+ $Productos['valor_declarado'];
							$_20_Litros_Garrafas_Vr_Declarado_ocasional   = $_20_Litros_Garrafas_Vr_Declarado_ocasional 		+ $Productos['valor_declarado_ocasional'];
							$_20_Litros_Garrafas_Vr_Declarado_tron        = $_20_Litros_Garrafas_Vr_Declarado_tron 							+ $Productos['valor_declarado_tron'];

							$_20_Litros_Garrafas_Peso_Gramos              = $_20_Litros_Garrafas_Peso_Gramos 													+ $Productos['peso_gramos'] * $Productos['cantidad'];

							$_20_Litros_Garrafas_Subsidio_Flete           = $_20_Litros_Garrafas_Subsidio_Flete 										+ $Productos['vr_ppto_fletes'];
							$_20_Litros_Garrafas_Subsidio_Flete_Ocasional = $_20_Litros_Garrafas_Subsidio_Flete_Ocasional + $Productos['vr_ppto_fletes_ocas'];
							$_20_Litros_Garrafas_Subsidio_Flete_Tron      = $_20_Litros_Garrafas_Subsidio_Flete_Tron 					+ $Productos['vr_ppto_fletes_tron'];

							$_20_Litros_Garrafas_Recaudo                  = $_20_Litros_Garrafas_Recaudo 																	+ $Productos['vr_anticipo_recaudo'];
							$_20_Litros_Garrafas_Recaudo_Ocasional        = $_20_Litros_Garrafas_Recaudo_Ocasional 							+ $Productos['vr_anticipo_recaudo_ocas'];
							$_20_Litros_Garrafas_Recaudo_Tron        				 = $_20_Litros_Garrafas_Recaudo_Tron 												+ $Productos['vr_anticipo_recaudo_tron'];

							$_20_Litros_Garrafas_Vr_Compra                = $_20_Litros_Garrafas_Vr_Compra  														+ $Productos['precio_unitario_produc_pedido'] * $Productos['cantidad'];
							$_20_Litros_Garrafas_Vr_Compra_Ocasional      = $_20_Litros_Garrafas_Vr_Compra_Ocasional  				+ $Productos['pv_ocasional'] 																	* $Productos['cantidad'];
							$Productos['tipo_despacho_final']='CARGA' ; // Carga
			             }

			          if ( in_array($ID_Presentacion, $_04_Litros_Galon_Presentaciones  )) {
							$_04_Litros_Galon_Cantidad                 = $_04_Litros_Galon_Cantidad  									     	+ $Productos['cantidad'];

							$_04_Litros_Galon_Vr_Declarado             = $_04_Litros_Galon_Vr_Declarado 						 			 	+ $Productos['valor_declarado'];
							$_04_Litros_Galon_Vr_Declarado_ocasional   = $_04_Litros_Galon_Vr_Declarado_ocasional  	+ $Productos['valor_declarado_ocasional'];
							$_04_Litros_Galon_Vr_Declarado_tron        = $_04_Litros_Galon_Vr_Declarado_tron 							+ $Productos['valor_declarado_tron'];

							$_04_Litros_Galon_Peso_Gramos              = $_04_Litros_Galon_Peso_Gramos 													+ $Productos['peso_gramos'] * $Productos['cantidad'];

							$_04_Litros_Galon_Subsidio_Flete           = $_04_Litros_Galon_Subsidio_Flete 										+ $Productos['vr_ppto_fletes'];
							$_04_Litros_Galon_Subsidio_Flete_Ocasional = $_04_Litros_Galon_Subsidio_Flete_Ocasional + $Productos['vr_ppto_fletes_ocas'];
							$_04_Litros_Galon_Subsidio_Flete_Tron      = $_04_Litros_Galon_Subsidio_Flete_Tron 					+ $Productos['vr_ppto_fletes_tron'];

							$_04_Litros_Galon_Recaudo                  = $_04_Litros_Galon_Recaudo 																	+ $Productos['vr_anticipo_recaudo'];
							$_04_Litros_Galon_Recaudo_Ocasional        = $_04_Litros_Galon_Recaudo_Ocasional 							+ $Productos['vr_anticipo_recaudo_ocas'];
							$_04_Litros_Galon_Recaudo_Tron             = $_04_Litros_Galon_Recaudo_Tron 												+ $Productos['vr_anticipo_recaudo_tron'];

							$_04_Litros_Galon_Vr_Compra                = $_04_Litros_Galon_Vr_Compra  														+ $Productos['precio_unitario_produc_pedido'] * $Productos['cantidad'];
							$_04_Litros_Galon_Vr_Compra_Ocasional      = $_04_Litros_Galon_Vr_Compra_Ocasional  														+ $Productos['pv_ocasional'] 																	* $Productos['cantidad'];
							$Productos['tipo_despacho_final']='CARGA' ; // Carga

			             }


			          if ( $ID_categoria_producto != 6 || in_array($ID_Presentacion, $_Otros_Productos_Presentaciones )) {

							$_Otros_Productos_Cantidad                 = $_Otros_Productos_Cantidad  															+ $Productos['cantidad'];

							$_Otros_Productos_Vr_Declarado             = $_Otros_Productos_Vr_Declarado 												+ $Productos['valor_declarado'];
							$_Otros_Productos_Vr_Declarado_ocasional   = $_Otros_Productos_Vr_Declarado_ocasional 		+ $Productos['valor_declarado_ocasional'];
							$_Otros_Productos_Vr_Declarado_tron        = $_Otros_Productos_Vr_Declarado_tron 							+ $Productos['valor_declarado_tron'];

							$_Otros_Productos_Peso_Gramos              = $_Otros_Productos_Peso_Gramos 													+ $Productos['peso_gramos'] * $Productos['cantidad'];
							$_Otros_Productos_Subsidio_Flete           = $_Otros_Productos_Subsidio_Flete 										+ $Productos['vr_ppto_fletes'];
							$_Otros_Productos_Subsidio_Flete_Ocasional = $_Otros_Productos_Subsidio_Flete_Ocasional + $Productos['vr_ppto_fletes_ocas'];
							$_Otros_Productos_Subsidio_Flete_Tron      = $_Otros_Productos_Subsidio_Flete_Tron 					+ $Productos['vr_ppto_fletes_tron'];

							$_Otros_Productos_Recaudo                  = $_Otros_Productos_Recaudo 																	+ $Productos['vr_anticipo_recaudo'];
							$_Otros_Productos_Recaudo_Ocasional        = $_Otros_Productos_Recaudo_Ocasional 							+ $Productos['vr_anticipo_recaudo_ocas'];
							$_Otros_Productos_Recaudo_Tron             = $_Otros_Productos_Recaudo_Tron 												+ $Productos['vr_anticipo_recaudo_tron'];

							$_Otros_Productos_Vr_Compra                = $_Otros_Productos_Vr_Compra 															+ $Productos['precio_unitario_produc_pedido'] * $Productos['cantidad'];
							$Productos['tipo_despacho_final']='COURRIER' ; // COURRIER
			             }

			        }// end foreach

			        	// REASIGNAR CARRITO A LA VARIABLE DE SESSION. CONTIENE UN NUEVO DATO DE ACUERDO A SU PRESENTACIÓN. tipo_despacho_final ( CARGA, CURRIER)
			        	Session::Set('carrito', $this->Datos_Carro)    ;

			        if ( $_04_Litros_Galon_Cantidad > 0 ){ 				// IF - 1						//// CALCULAR EL ESPECIO LIBRE
			        			$_04_Litros_Galon_Unidades  = $_04_Litros_Galon_Cantidad /6;
			        			if ( $_04_Litros_Galon_Unidades < 1 ){
			        				  $_04_Litros_Galon_Unidades  = 1 ;
			        			}else{
			        					$_04_Litros_Galon_Unidades   = Numeric_Functions::Valor_Absoluto(ceil( $_04_Litros_Galon_Cantidad / 6 ));
			        			}
			        			$Espacio_Libre	 = 24 - ((( $_04_Litros_Galon_Cantidad /6 - (int)($_04_Litros_Galon_Cantidad /6 ))) * 24 );
			        			if ( $Espacio_Libre	 == 24 ){
			        						$Espacio_Libre	 = 0;
			        			}
			        } //IF - 1

											$Carga_Fija_Unidades                 = $_04_Litros_Galon_Unidades 																				+ $_20_Litros_Garrafas_Cantidad ;
											$Carga_Fija_Vr_Declarado             = $_20_Litros_Garrafas_Vr_Declarado  											 + $_04_Litros_Galon_Vr_Declarado ;
											$Carga_Fija_Vr_Declarado_Ocasional   = $_20_Litros_Garrafas_Vr_Declarado_ocasional  		+ $_04_Litros_Galon_Vr_Declarado_ocasional ;
											$Carga_Fija_Vr_Declarado_Tron        = $_20_Litros_Garrafas_Vr_Declarado_tron  						 + $_04_Litros_Galon_Vr_Declarado_tron ;
											$Carga_Fija_Peso_Pedido_Temporal			  = $_20_Litros_Garrafas_Peso_Gramos 													 + $_04_Litros_Galon_Peso_Gramos;
											$Carga_Fija_Peso_Pedido              = Numeric_Functions::Redondear_Al_1000_Mas_Proximo($_20_Litros_Garrafas_Peso_Gramos) 	+ Numeric_Functions::Redondear_Al_1000_Mas_Proximo( $_04_Litros_Galon_Peso_Gramos ) ;
											$Carga_Fija_Subsidio_Flete           = $_20_Litros_Garrafas_Subsidio_Flete 											+ $_04_Litros_Galon_Subsidio_Flete;
											$Carga_Fija_Subsidio_Flete_Ocasional = $_20_Litros_Garrafas_Subsidio_Flete_Ocasional 	+ $_04_Litros_Galon_Subsidio_Flete_Ocasional;
											$Carga_Fija_Subsidio_Flete_Tron      = $_20_Litros_Garrafas_Subsidio_Flete_Tron 						+ $_04_Litros_Galon_Subsidio_Flete_Tron;
											$Carga_Fija_Recaudo                  = $_20_Litros_Garrafas_Recaudo  																	+ $_04_Litros_Galon_Recaudo  ;
											$Carga_Fija_Recaudo_Ocasional        = $_20_Litros_Garrafas_Recaudo_Ocasional  							+ $_04_Litros_Galon_Recaudo_Ocasional ;
											$Carga_Fija_Recaudo_Tron             = $_20_Litros_Garrafas_Recaudo_Tron  												+ $_04_Litros_Galon_Recaudo_Tron  ;
											$Carga_Fija_Vr_Compra                = $_20_Litros_Garrafas_Vr_Compra  															+ $_04_Litros_Galon_Vr_Compra;
											$Carga_Fija_Vr_Compra_Ocasional      = $_20_Litros_Garrafas_Vr_Compra_Ocasional  					+ $_04_Litros_Galon_Vr_Compra_Ocasional;
											$Peso_Total_Kg_Otros_Productos       = $_Otros_Productos_Peso_Gramos  / 1000;


			        if ( $Espacio_Libre >= $Peso_Total_Kg_Otros_Productos  ) {
			        		 Session::Set('Unidades_Adicionales', FALSE );
														$_Otros_Productos_Unidades           = 0;
														$Carga_Fija_Vr_Declarado             = $Carga_Fija_Vr_Declarado 													+ $_Otros_Productos_Vr_Declarado;
														$Carga_Fija_Vr_Declarado_Ocasional   = $Carga_Fija_Vr_Declarado_Ocasional 			+ $_Otros_Productos_Vr_Declarado_ocasional;
														$Carga_Fija_Vr_Declarado_Tron        = $Carga_Fija_Vr_Declarado_Tron									+ $_Otros_Productos_Vr_Declarado_tron;
														$Carga_Fija_Subsidio_Flete           = $Carga_Fija_Subsidio_Flete  										+ $_Otros_Productos_Subsidio_Flete ;
														$Carga_Fija_Subsidio_Flete_Ocasional = $Carga_Fija_Subsidio_Flete_Ocasional  + $_Otros_Productos_Subsidio_Flete_Ocasional ;
														$Carga_Fija_Subsidio_Flete_Tron      = $Carga_Fija_Subsidio_Flete_Tron  					+ $_Otros_Productos_Subsidio_Flete_Tron ;

														$Carga_Fija_Peso_Pedido              =  Numeric_Functions::Redondear_Al_1000_Mas_Proximo( $Carga_Fija_Peso_Pedido_Temporal + $_Otros_Productos_Peso_Gramos  ) ;
														$Carga_Fija_Recaudo                  = $Carga_Fija_Recaudo  						 										+ $_Otros_Productos_Recaudo  ;
														$Carga_Fija_Recaudo_Ocasional        = $Carga_Fija_Recaudo_Ocasional  						 + $_Otros_Productos_Recaudo_Ocasional  ;
														$Carga_Fija_Recaudo_Tron             = $Carga_Fija_Recaudo_Tron  						 					+ $_Otros_Productos_Recaudo_Tron  ;

														$Carga_Fija_Vr_Compra                = $Carga_Fija_Vr_Compra  															+ $_Otros_Productos_Vr_Compra ;
			        	 }
			        	  else{
			        	  	 Session::Set('Unidades_Adicionales', TRUE );
			        	  	 $_Courrier_Unidades 						= Numeric_Functions::Valor_Absoluto(ceil( $Peso_Total_Kg_Otros_Productos - $Espacio_Libre  ) / 4);
			        	  	 $_Carga_Variable_Unidades = Numeric_Functions::Valor_Absoluto(ceil( $Peso_Total_Kg_Otros_Productos - $Espacio_Libre  ) / 24);
			        	  }
			        	  Session::Set('Carga_Fija_Unidades',  																			$Carga_Fija_Unidades);

			        	  Session::Set('Carga_Fija_Vr_Declarado',   													 $Carga_Fija_Vr_Declarado);
			        	  Session::Set('Carga_Fija_Vr_Declarado_Ocasional',   				$Carga_Fija_Vr_Declarado_Ocasional);
			        	  Session::Set('Carga_Fija_Vr_Declarado_Tron',   							  $Carga_Fija_Vr_Declarado_Tron);

			        	  Session::Set('Carga_Fija_Subsidio_Flete',   											 $Carga_Fija_Subsidio_Flete);
			        	  Session::Set('Carga_Fija_Subsidio_Flete_Ocasional',   		$Carga_Fija_Subsidio_Flete_Ocasional);
			        	  Session::Set('Carga_Fija_Subsidio_Flete_Tron',   						 $Carga_Fija_Subsidio_Flete_Tron);

			        	  Session::Set('Carga_Fija_Peso_Pedido',    				$Carga_Fija_Peso_Pedido);
			        	  Session::Set('Carga_Fija_Recaudo',    			 				$Carga_Fija_Recaudo);
			        	  Session::Set('Carga_Fija_Recaudo_Ocasional',    			 				$Carga_Fija_Recaudo_Ocasional);
			        	  Session::Set('Carga_Fija_Recaudo_Tron',    			 				$Carga_Fija_Recaudo_Tron);

			        	  Session::Set('Carga_Fija_Vr_Compra', 									$Carga_Fija_Vr_Compra);
			        	  Session::Set('Carga_Fija_Vr_Compra_Ocasional', 									$Carga_Fija_Vr_Compra_Ocasional);
			        	  //---
			        	  Session::Set('Courrier_Unidades',  						 				$_Courrier_Unidades);
			        	  Session::Set('Carga_Variable_Unidades',   				$_Carga_Variable_Unidades);
			        	  Session::Set('Otros_Productos_Vr_Declarado',  $_Otros_Productos_Vr_Declarado_tron);
			        	  Session::Set('Otros_Productos_Vr_Declarado_Ocasional',  $_Otros_Productos_Vr_Declarado_ocasional);
			        	  Session::Set('Otros_Productos_Peso_Gramos',   $_Otros_Productos_Peso_Gramos);
			        	  Session::Set('Otros_Productos_Recaudo',    		 $_Otros_Productos_Recaudo );
			        	  Session::Set('Otros_Productos_Antic_Rcdo_Ocas',    		 $_Otros_Productos_Recaudo_Ocasional );
			        	  Session::Set('Otros_Productos_Antic_Rcdo_Tron',    		 $_Otros_Productos_Recaudo_Tron );
			        	  Session::Set('Otros_Productos_SubFlete_Ocas', $_Otros_Productos_Subsidio_Flete_Ocasional);
			        	  Session::Set('Otros_Productos_SubFlete_Tron', $_Otros_Productos_Subsidio_Flete_Tron);
			        	  Session::Set('Otros_Productos_Vr_Compra',     $_Otros_Productos_Vr_Compra );


							} //  Fin  Calcular_Numero_Unidades


						public function Presupuesto_Fletes_Productos_Tron( $valor_total_compra_tron, $cantidad, $valor_declarado ){
							 Session::Set('SubSidio_Flete_Unitario_Tron',0);
								$this->Transportadoras        = $this->Parametros->Transportadoras();
								Session::Set('subsisio_flete_valle', $this->Transportadoras [0]['subsidio_transporte_tron']);

								$subsisio_flete_valle         = Session::Get('subsisio_flete_valle');
								$SubSidio_Flete_Unitario_Tron = 0;

								if ( $cantidad > 0 ){
									if ( $valor_total_compra_tron >= $this->Transportadoras[0]['valor_minimo_pedido_productos']){
											//CALCULO DEL SEGURO

											if ( $valor_declarado >= $this->Transportadoras[0]['rt_courrier_seguro'] ){
														$Seguro  = $valor_declarado  * $this->Transportadoras[0]['rt_courrier_porciento_seguro_minimo']/100;
											}else{
												$Seguro  = $valor_declarado *  $this->Transportadoras[0]['rt_courrier_porciento_seguro_minimo']/100;
											}
											$SubSidio_Flete_Unitario_Tron = ($subsisio_flete_valle  + $Seguro ) / $cantidad;
									}
									Session::Set('SubSidio_Flete_Unitario_Tron',$SubSidio_Flete_Unitario_Tron);
						}

					} // Fin Func

	}
?>




