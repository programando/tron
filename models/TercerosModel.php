<?php
		class TercerosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}


				public function Grabar($params=array()){
					extract($params);

						$SQL = "$idtpidentificacion , '$identificacion' ,'$digitoverificacion' ,'$pnombre' ,'$papellido' ,'$razonsocial',$genero ,$dianacimiento ,$mesnacimiento ,'$passwordusuario' ,'$direccion' ,'$barrio' ,'$contacto' ,'$telefono' ,'$celular1' ,'$email' ,$idmcipio ,'$codigousuario' ,'$codautorizacionmenoredad' ,'$codigoterceropresenta_inicial' ,'$codigoterceropresenta' ,$idterceropresenta ,$registroconfirmado , $registro_organizado ,$param_tiene_compras , $registro_inactivo ,$param_confirmar_nuevos_amigos_x_email ,$param_acepto_pago_valor_transferencia ,$valor_minimo_transferencia ,$param_idtpidentificacion_titular_cuenta ,'$param_identificacion_titular_cuenta' ,'$param_nombre_titular_cuenta' , $param_idbanco_transferencias ,'$param_nro_cuenta_transferencias' , $param_tipo_cuenta_transferencias' ,$param_idmcipio_transferencias ,$param_acepto_retencion_comis_para_pago_pedidos , $param_valor_comisiones_para_pago_pedidos ,$cant_max_amigos_nivel_1 ,$cant_max_amigos_nivel_2 ,$cant_max_amigos_otros_niveles ,$sesion_amigo_activo , $mis_datos_son_privados ,$pago_comisiones_efecty ,$pago_comisiones_cuenta_empresa ,$pago_comisiones_transferencia ,$pago_comisiones_caja ,$idtppersona , $regimen ,$declaro_renta ,$nadie_presenta ,$id_pago_primer_pedido ,$fecha_hora_acepta_convenio ,$fecha_pago_inscripcion ,$no_correos_ley_1581_2012 , $idtipo_plan_compras ,$idtipo_plan_compras_confirmado ,$otrosi_firmado , $fecha_otrosi_firmado ,$kit_comprado , $inscripcion_pagada ,$recibo_promociones_email , $recibo_promociones_celular ,$empresario_provisional ";
						Debug::Mostrar($SQL);
						$Registro    =  $this->Db->Ejecutar_Sp("terceros_crear_modificar($SQL)");
						return $Registro ;





				}




				public function Buscar_Por_Codigo($codigousuario){
					/** MAYO 05 DE 2015
					 * 				CONSULTA DATOS BÁSICO DE UN TERCERO POR IDENTIFICACION
					 */
							$Registro                 =  $this->Db->Ejecutar_Sp("terceros_buscar_por_codigo_usuario('$codigousuario')");
							return $Registro;
				}



				public function Buscar_Por_Identificacion($identificacion){
					/** MAYO 05 DE 2015
					 * 				CONSULTA DATOS BÁSICO DE UN TERCERO POR IDENTIFICACION
					 */
							$Registro                 =  $this->Db->Ejecutar_Sp("terceros_buscar_por_identificacion('$identificacion')");
							return $Registro;
				}


				public function Compra_Productos_Tron_Mes_Actual()
				{
					$idtercero                = Session::Get('idtercero_pedido');
					if (!isset($idtercero))	{
						$idtercero = 0;
					}
					$Registro                 =  $this->Db->Ejecutar_Sp("terceros_consultar_compras_tron_mes_actual($idtercero)");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}


				public function Direcciones_Despacho_Grabar_Actualizar($params=array())
				{/** MARZO 05 DE 2015
					*					INSERTA O ACTUALIZA UNA DIRECCIÓN DE DESPACHO PARA UN TERCERO
					*/
						extract($params);
					 $this->Db->Ejecutar_Sp("
					 																								terceros_direcciones_despacho_crear_modificar(
					 																									$iddireccion_despacho,$idtercero,$idmcipio,'$direccion','$telefono',
					 																									'$barrio','$destinatario')");
				}

				public function Direcciones_Despacho()
				{
					$idtercero                = Session::Get('idtercero_pedido');
					$Registro                 =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_idtercero($idtercero)");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}

				public function Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($iddireccion_despacho)
				{
			 	$Registro =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_iddireccion_despacho($iddireccion_despacho)");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}

				public function Consultar_Datos_Mcipio_x_IdMcipio($idmcipio)
				{
			 	$Registro =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_idmcipio($idmcipio)");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}


				public function Buscar_Usuarios_Activos_x_Email($email)
				{
			 	$Registro =  $this->Db->Ejecutar_Sp("terceros_buscar_usuarios_activos_x_email('$email')");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}

				public function Actualizar_Password_Usuario($idtercero,$new_password,$password_temporal)
				{/** FEBRERO 03 DE 2015
				 * 			REALIZAR LA ACTUALIZACIÓN DEL PASSWORD DE USUARIO
				 */
					$this->Db->Ejecutar_Sp("terceros_actualizacion_password($idtercero ,'$new_password','$password_temporal')");
				}

				public function Clave_Temporal_Buscar($idtercero,$password_temporal)
				{/**FEBRERO 03 DE 2015
				 *   CONSULTA QUE EL PASSWORTEMPORAL EXISTA DENTRO DE LA BASE DE DATOS
				 */
					$Registro =  $this->Db->Ejecutar_Sp("terceros_passwords_temporales_consultar($idtercero ,'$password_temporal')");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;

				}

				public function Clave_Temporal_Grabar_Cambio_Clave($idtercero, $password_temporal)
				{/** FEBRERO 03 DE 2015
        **  INSERTA EN LA TABLA UN REGISTRO TEMPORAL QUE SE USARÁ PARA LA VERIFICACIÓN EN EL CAMBIO DE CLAVE
        **		NOTA:  EN ESTE CASO NO ES NECESARIO idtercero ni plan de compras.
        */
						$idtipo_plan_compras =0;
					 $this->Db->Ejecutar_Sp("terceros_passwords_temporales_registro($idtercero , $idtipo_plan_compras,'$password_temporal')");

				}

				public function Consulta_Datos_Por_Password_Email($email,$password)
				{
						/** ENERO 04 DE 2014
								 CONSULTA DATOS DEL USUARIO CON PASSWORD + EMAIL. DESDE EL LOGIN				*/
						$Terceros                 = $this->Db->Ejecutar_Sp("terceros_consulta_datos_x_password_email('$password','$email')");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;

						return $Terceros;
				}

				public function Consulta_Datos_Por_Email($email)
				{
						/** ENERO 31DE 2014
								 CONSULTA DATOS DEL USUARIO CON  EMAIL. DESDE EL LOGIN				*/
						$Terceros                 = $this->Db->Ejecutar_Sp("terceros_consulta_datos_x_email('$email')");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;

						return $Terceros;
				}
  }
?>
