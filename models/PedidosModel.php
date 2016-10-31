<?php
		class PedidosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Eliminar($idpedido){
					$Registro   =  $this->Db->Ejecutar_Sp("pedidos_eliminar_x_idpedido($idpedido)");
				}


				public function Consulta_Detalle_x_IdPedido($idpedido){
					/** JUNIO
					 *				COSULTA DEL DETALLE DEL PRODUCTO DE UN PEDIDO POR SU ID
					 */
					$Registro   =  $this->Db->Ejecutar_Sp("pedidos_consulta_detalle_x_idpedido($idpedido)");
					return $Registro;
				}


			public function Historial_x_Idtercero($idtecero){
				/**JUNIO 14 DE 2015
				 * 		RETORNA EL HISTORIAL DE LOS PEDIDOS DE UN USUARIO
				 */
 				$Registro = $this->Db->Ejecutar_Sp("pedidos_historial_x_idtercero($idtecero);");
 				$this->Cantidad_Registros  = $this->Db->Cantidad_Registros;
 				return $Registro;
			}

 		public function Grabar($Pedido=array())	{
 		/** MARZO 24 DE 2015
 			*					GRABAR PEDIDO EN LA BASE DE DATOS
 			*/
 				extract($Pedido);
					$Sql = $id_forma_pago .',' . $idtercero . ',' . $iddireccion_despacho . ',' . $vr_compra_tron. ',' . $vr_compra_ta .',';
					$Sql = $Sql . $vr_compra_acc .',' . $vr_compra_otros . ',' . $vr_comis_pago_pedidos . ',' . $vr_puntos_redimidos. ',' . $vr_inscripcion_red.',';
					$Sql = $Sql . $vr_fletes_tron .',' . $vr_fletes_tron_otros . ',' . $vr_flete_seguro . ',' . $vr_flete_tron_otros_seguro.',';
					$Sql = $Sql . $vr_fletes_reserva .',' . $vr_diferencia_recaudo . ',' . $vr_fletes_totales . ',' . $vr_total_pedido.',';
					$Sql = $Sql . $puntos_redimidos .',' . $tipo_despacho . ',' . $id_transportadora . ',' . $solo_pago_inscripcion_red.',';
					$Sql = $Sql . $id_pase_cortesia .',' . $idtercero_envia_pase . ',' . $pase_es_premium . ',' . $idtercero_recibe_comisiones.',';
					$Sql = $Sql . $peso_gramos_pedido .',' . $email_confirma_factura . ',' . $pagado_online. ',' . $pago_recibido . ',' . $valor_declarado .',';
					$Sql = $Sql . $vr_flete .','.$tipo_despacho_carga . ',' .$peso_gramos_pedido_carga .','.$id_transportadora_carga .',' ;
					$Sql = $Sql . $vr_flete_transportadora_carga . ',' .$vr_declarado_carga . ',' . $vr_payu_latam  ;
					Debug::Mostrar( $Sql );
 				$Registro = $this->Db->Ejecutar_Sp("pedidos_crear_modificar($Sql);");
 				return $Registro;

 		}

 		public function Grabar_Detalle($texto_sql)		{
 				$Registro = $this->Db->Ejecutar_SQL($texto_sql);
 		}

 		public function Actualizar_Forma_Pago($idpedido,$idformapago,$pagado_online)
 		{
 		/** MAYO 06 DE 2016
	 	* 	ACTUALIZA LA FORMA DE PAGO DEL PEDIDO UNA VEZ SE HA CONFIRMADO EL PAGO
	 	*/

 			$Registro = $this->Db->Ejecutar_Sp("pedidos_actualizar_forma_de_pago($idpedido,$idformapago,$pagado_online);");
 		}

 		public function Pedido_Consulta_Datos_Cambio_Forma_Pago ( $idpedido ){

				$Registro = $this->Db->Ejecutar_Sp("pedidos_consulta_datos_cambio_forma_pago ( $idpedido );");
 			return $Registro;
 		}

 		public function Genera_Consecutivo(){
	 			$Registro = $this->Db->Ejecutar_Sp("pedidos_genera_consecutivo ();");
	 			return $Registro;
 		}


 		public function Cambiar_Numero_Pedido( $numero_pedido_old=0, $numero_pedido=0 ){
 			 $Registro = $this->Db->Ejecutar_Sp("pedidos_actualizar_numero_pedido ( $numero_pedido_old, $numero_pedido );");
 		}

}
?>
