
<?php

			/*	 NOV 30 DIC 2016
							CON VARIALES CARGADAS DESDE EL CONTROLADOR A LA VISTA SE ASIGNAN LOS PRECIOS INDIVIDUALES DE CADA UNO
							DE LOS PRODUCTOS TRON EN VARIABLES. SI YA SE HAN ESTABLECIDO, MEDIANTE UNA VARIABLE DE SESSIÓN,
							SE TOMA ESTE VALOR Y SE ASIGNA.
			*/

			//ROPA
				$pv_comprador_ocasional      	= $this->Productos_Tron_Ropa[0]['pv_ocasional'];
				$pv_tron                     	= $this->Productos_Tron_Ropa[0]['pv_ocasional'];
				$text_pv_comprador_ocasional_ropa 	= Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
				$valor 							= Session::Get('vr_unitario_ropa')  ;
				Session::Set('text_pv_tron_ropa'			, $pv_comprador_ocasional );

				if ( isset( $valor ) && $valor > 0 ){
					$text_pv_tron_ropa                = Numeric_Functions::Formato_Numero($valor );
				} else{
					$text_pv_tron_ropa                = Numeric_Functions::Formato_Numero($pv_tron );

				}



			 // BANIOS
				$pv_comprador_ocasional      		= $this->Productos_Tron_Banios[0]['pv_ocasional'];
				$pv_tron                     		= $this->Productos_Tron_Banios[0]['pv_ocasional'];
				$text_pv_comprador_ocasional_banios 		= Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
				$valor 								= Session::Get('vr_unitario_banios')  ;
				Session::Set('text_pv_tron_banios'	, $pv_comprador_ocasional);

				if ( isset( $valor) && $valor > 0 ){
					$text_pv_tron_banios                	= Numeric_Functions::Formato_Numero($valor );

				} else{
					$text_pv_tron_banios                	= Numeric_Functions::Formato_Numero($pv_tron );
				}


			// PISOS
				$pv_comprador_ocasional      	= $this->Productos_Tron_Pisos[0]['pv_ocasional'];
				$pv_tron                     	= $this->Productos_Tron_Pisos[0]['pv_ocasional'];
				$text_pv_comprador_ocasional_pisos 	= Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
				$valor 							= Session::Get('vr_unitario_pisos')  ;
				Session::Set('text_pv_tron_pisos'		, $pv_comprador_ocasional);

				if ( isset( $valor) && $valor > 0){
				  $text_pv_tron_pisos                = Numeric_Functions::Formato_Numero($valor );

				} else{
				  $text_pv_tron_pisos                = Numeric_Functions::Formato_Numero($pv_tron );
				  Session::Set('text_pv_tron_pisos'		, $pv_tron);
				}


			// LOZA
				$pv_comprador_ocasional      	= $this->Productos_Tron_Loza[0]['pv_ocasional'];
				$pv_tron                     	= $this->Productos_Tron_Loza[0]['pv_ocasional'];
				$text_pv_comprador_ocasional_loza 	= Numeric_Functions::Formato_Numero($pv_comprador_ocasional);
				$valor 							= Session::Get('vr_unitario_loza')  ;
				Session::Set('text_pv_tron_loza'			,	$pv_comprador_ocasional );

				if ( isset( $valor) && $valor > 0  ){
					$text_pv_tron_loza               = Numeric_Functions::Formato_Numero($valor );

				} else{
					$text_pv_tron_loza               = Numeric_Functions::Formato_Numero($pv_tron );

				}






?>
