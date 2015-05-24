<?php
		class PedidosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

 		public function Grabar($Pedido=array())
 		{/** MARZO 24 DE 2015
 			*					GRABAR PEDIDO EN LA BASE DE DATOS
 			*/
 				extract($Pedido);
					$Sql = $id_forma_pago .',' . $idtercero . ',' . $iddireccion_despacho . ',' . $vr_compra_tron. ',' . $vr_compra_ta .',';
					$Sql = $Sql . $vr_compra_acc .',' . $vr_compra_otros . ',' . $vr_comis_pago_pedidos . ',' . $vr_puntos_redimidos. ',' . $vr_inscripcion_red.',';
					$Sql = $Sql . $vr_fletes_tron .',' . $vr_fletes_tron_otros . ',' . $vr_flete_seguro . ',' . $vr_flete_tron_otros_seguro.',';
					$Sql = $Sql . $vr_fletes_reserva .',' . $vr_diferencia_recaudo . ',' . $vr_fletes_totales . ',' . $vr_total_pedido.',';
					$Sql = $Sql . $puntos_redimidos .',' . $tipo_despacho . ',' . $id_transportadora . ',' . $solo_pago_inscripcion_red.',';
					$Sql = $Sql . $id_pase_cortesia .',' . $idtercero_envia_pase . ',' . $pase_es_premium . ',' . $idtercero_recibe_comisiones.',';
					$Sql = $Sql . $peso_gramos_pedido .',' . $email_confirma_factura . ',' . $pagado_online. ',' . $pago_recibido;

 				$Registro = $this->Db->Ejecutar_Sp("pedidos_crear_modificar($Sql);");
 				return $Registro;
 		}

 		public function Grabar_Detalle($texto_sql)
 		{
 				$Registro = $this->Db->Ejecutar_SQL($texto_sql);
 		}

 		public function Actualizar_Forma_Pago($idpedido,$idformapago,$pagado_online)
 		{
 		/** MAYO 06 DE 2016
	 	* 	ACTUALIZA LA FORMA DE PAGO DEL PEDIDO UNA VEZ SE HA CONFIRMADO LA FORMA
	 	*/
	 	Debug::Mostrar($idpedido);
	 	Debug::Mostrar($idformapago);
	 	Debug::Mostrar($pagado_online);

 			$Registro = $this->Db->Ejecutar_Sp("pedidos_actualizar_forma_de_pago($idpedido,$idformapago,$pagado_online);");
 		}

 		public function Establercer_Comsiones_Por_Pedido($idpedido){
			/** MAYO 23 DE 2015
			 * 		OBJETIVO			:		CONSULTA Y ALMACENA LAS COMISIONES QUE SE PAGARÁN A LOS USUARIOS DE LA RED EN CADA UNA DE SUS COMPRAS
				*																	TENIENDO EN CUENTA LOS PARÁMETROS QUE EXISTAN EN ESE MOMENTO.
				* OBSEVACIONES	:		SE CREA TABLA TEMPORAL Y POSTERIORMENTE SE ALMANCENA EN LA TABLA DEFINITIVA.
			 */
 				$Registro = $this->Db->Ejecutar_Sp("pedidos_establecer_comisiones_x_pedido_producto($idpedido);");
 		}



  }
?>
