<?php
		class ComisionesPuntosModel extends Model
		{
							public $Cantidad_Registros;

							public function __construct()
							{
								parent::__construct();
							}

			 		public function Actualizar_Comisiones($idtercero,$tipo_registro,$numero_pedido,$valor){
			 			/** JUNIO 14 DE 2015
			 			 * 			REALIZA LA SALIDA DE COMISIONES LUEGO DE PAGAR PEDIDO
			 			 */
			 					$Registro = $this->Db->Ejecutar_Sp("comisiones_registro_salida_en_cuenta($idtercero,$tipo_registro,$numero_pedido,$valor);");
			 		}

			 		public function Actualizar_Puntos($idtercero,$tipo_registro,$numero_pedido,$valor){
			 			/** JUNIO 14 DE 2015
			 			 * 			REALIZA LA SALIDA DE COMISIONES LUEGO DE PAGAR PEDIDO
			 			 */
			 					$Registro = $this->Db->Ejecutar_Sp("puntos_registro_salida_en_cuenta($idtercero,$tipo_registro,$numero_pedido,$valor);");
			 		}

			 		public function Establercer_Comsiones_Por_Pedido($idpedido){
						/** MAYO 23 DE 2015
						 * 		OBJETIVO			:		CONSULTA Y ALMACENA LAS COMISIONES QUE SE PAGARÁN A LOS USUARIOS DE LA RED EN CADA UNA DE SUS COMPRAS
							*																	TENIENDO EN CUENTA LOS PARÁMETROS QUE EXISTAN EN ESE MOMENTO.
							* OBSEVACIONES	:		SE CREA TABLA TEMPORAL Y POSTERIORMENTE SE ALMANCENA EN LA TABLA DEFINITIVA.
						 */
			 				$Registro = $this->Db->Ejecutar_Sp("pedidos_establecer_comisiones_x_pedido_producto($idpedido);");
			 		}

			 		public function Entrada_Comisiones($campos=array()){
			 			/** JUNIO 15 DE 2015
			 			 * 			REGISTRA ENTRADA DE COMISIONES POR ALGÚN CONCEPTO COMISIONES
			 			 */
			 				extract($campos);
			 				$Registro = $this->Db->Ejecutar_Sp("historial_comisiones_registro_comisiones_ganadas ($idtercero,$idtipo_registro,$comisiones_utilizadas,'$observacion' );");
			 				$Registro = $this->Db->Ejecutar_Sp("historial_comisiones_registro_comisiones_ganadas_detalle ($idtercero,$idtipo_registro,$comisiones_utilizadas,'$observacion' );");
			 		}
			 		public function Puntos_Entrada($campos=array()){
			 			/** JUNIO 15 DE 2015
			 			 * 			REGISTRA ENTRADA DE PUNTOS POR ALGÚN CONCEPTO COMISIONES
			 			 */
			 				extract($campos);
			 				$Registro = $this->Db->Ejecutar_Sp("historial_comisiones_registro_puntos_ganados ($idtercero,$idtipo_registro,$puntos_utilizados,'$observacion' );");
			 				$Registro = $this->Db->Ejecutar_Sp("historial_comisiones_registro_puntos_ganados_detalle ($idtercero,$idtipo_registro,$puntos_utilizados,'$observacion' );");
			 		}


   }
?>
