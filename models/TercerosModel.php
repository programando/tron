<?php
		class TercerosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
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
