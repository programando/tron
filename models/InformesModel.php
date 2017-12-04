<?php
		class InformesModel extends Model
		{
							public $Cantidad_Registros;

							public function __construct()
							{
								parent::__construct();
							}


						public function Comisiones_Ganadas_x_IdTercero( $idtercero, $mes, $anio ){
										$Registro                = $this->Db->Ejecutar_Sp("terceros_comisiones_mes_anio( $idtercero, $mes, $anio)");
									$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
									return 			$Registro   ;
						}

						public function Comisiones_Ganadas_x_Pedido( $idtercero, $numero_pedido ){
								$Registro   = $this->Db->Ejecutar_Sp("terceros_comisiones_mes_anio_x_pedido ( $idtercero,$numero_pedido)");
								return 			$Registro   ;
						}

						public function Periodos_Comisiones(){
									$Registro                = $this->Db->Ejecutar_Sp("terceros_comisiones_ultimos_periodos_liquidados()");
									return 			$Registro   ;
						}
						public function Comisiones_Saldos($idtercero)			{
								/** ENERO 04 DE 2014
								*		 Consulta las marcas registradas en la base de datos			*/
								$Registro                = $this->Db->Ejecutar_Sp("comisiones_consultar_estado_cuenta_x_idtercero($idtercero)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}
						public function Puntos_Saldos($idtercero)		{
								/** ENERO 04 DE 2014
								*		 Consulta las marcas registradas en la base de datos			*/
								$Registro                = $this->Db->Ejecutar_Sp("historial_puntos_consulta_mvto_x_idtercero($idtercero)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Participacion_En_La_Red($idtercero, $anio){
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_amigos_presentados_mes_a_mes($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Amigos_Presentados($idtercero, $anio){
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_amigos_presentados_mes_a_mes($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Clientes_Presentados($codigo_usuario){
								$Registro                 = $this->Db->Ejecutar_Sp("terceros_informes_clientes_listado_general('$codigo_usuario')");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Anios_Disponibles_Consultas(){
								$Registro                = $this->Db->Ejecutar_Sp("anios_disponibles_consultas()");
								return 			$Registro   ;
						}

						public function Compras_Productos_Tron($idtercero,$anio)
						{
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_compras_productos_tron($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Compras_Otros_Productos($idtercero,$anio)
						{
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_compras_productos_otros($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Compras_Productos_Industriales($idtercero,$anio)
						{
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_compras_productos_industriales($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}
						public function Compras_Totales($idtercero,$anio)
						{
								$Registro                = $this->Db->Ejecutar_Sp("terceros_informes_red_total_y_compras_productos_totales($idtercero,$anio)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}

						public function Total_Amigos_Detallado_Por_Nivel( $idtercero ){
						  $Registro   =  $this->Db->Ejecutar_Sp("terceros_total_amigos_red_insert_tabla_terceros_temporal( $idtercero )");
		 				 $Registro   =  $this->Db->Ejecutar_Sp("terceros_total_amigos_red_detallado_por_nivel( $idtercero )");
								return $Registro;
				}


   }
?>
