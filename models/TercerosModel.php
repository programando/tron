<?php
		class TercerosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()	{
					parent::__construct();
				}


				public function Recomendacion_Amigo_Producto_Grabar($nombre, $email, $idproducto, $idconfirmacion){
					/** SEPTIEMBRE 13 DE 2015
					 * 		ALMACENA INFORMACIÓN DE LA PERSONA A LA QUE SE RECOMIENDA PRODUCTOS
					 */
 				$SQL 								= "'$nombre', '$email', $idproducto,'$idconfirmacion'";
 				$Registro    =  $this->Db->Ejecutar_Sp("terceros_productos_recomendados_grabar(".$SQL.")");

				}

				public function Recomendacion_Amigo_Producto_Borrar( $idconfirmacion){
					$SQL         ="'$idconfirmacion'";
					$Registro    =  $this->Db->Ejecutar_Sp("terceros_productos_recomendados_borrar(".$SQL.")");
				}

				public function Actualizar_Datos_Usuario($params=array()){
						extract($params);

						$SQL = "$idtercero, $idtpidentificacion,'$pnombre', '$papellido', '$razonsocial','$idmcipio','$direccion','$barrio','$celular1',";
						$SQL = $SQL."'$email','$pago_comisiones_transferencia', '$param_idbanco_transferencias' ,'$param_nro_cuenta_transferencias',";
						$SQL = $SQL."'$param_tipo_cuenta_transferencias','$param_idmcipio_transferencias', '$recibo_promociones_celular',";
						$SQL = $SQL."'$recibo_promociones_email', '$param_confirmar_nuevos_amigos_x_email', '$mis_datos_son_privados',";
						$SQL = $SQL."'$declaro_renta', '$param_acepto_retencion_comis_para_pago_pedidos', '$param_valor_comisiones_para_pago_pedidos',";
						$SQL = $SQL."'$pago_comisiones_efecty','$password'";
						$Registro    =  $this->Db->Ejecutar_Sp("terceros_actualizar_registro(".$SQL.")");

				}


				public function Consulta_Datos_x_Idtercero ($idtercero){
						 $Registro   =  $this->Db->Ejecutar_Sp("terceros_consulta_datos_x_idtercero($idtercero)");
							return $Registro;

				}
				public function Consulta_Datos_Usuario ($idtercero ){
						 $Registro   =  $this->Db->Ejecutar_Sp("terceros_consulta_datos_x_idtercero ( $idtercero )");
							return $Registro;

				}




				public function Consultar_Saldos_Comisiones_Puntos_x_Idtercero(){
						  $idtercero = Session::Get('idtercero_pedido');
        if ( !isset($idtercero)) { $idtercero = 0 ;}
							 $Registro   =  $this->Db->Ejecutar_Sp("terceros_consulta_saldos_comisiones_puntos($idtercero)");
							return $Registro;
				}

				public function Grabar($params=array()){
					extract($params);
					$SQL = "$idtpidentificacion,'$identificacion','$digitoverificacion','$pnombre','$papellido','$razonsocial',";
				 $SQL = $SQL."$genero,$dianacimiento,$mesnacimiento,'$passwordusuario', '$direccion','$barrio','$contacto','$telefono',";
				 $SQL = $SQL."'$celular1','$email',$idmcipio,'$codigousuario','$codautorizacionmenoredad','$codigoterceropresenta_inicial',";
				 $SQL = $SQL."'$codigoterceropresenta',$idterceropresenta,$registroconfirmado,$registro_organizado,$param_tiene_compras,";
				 $SQL = $SQL."$registro_inactivo,$param_confirmar_nuevos_amigos_x_email,$param_acepto_pago_valor_transferencia,";
				 $SQL = $SQL."$valor_minimo_transferencia,$param_idtpidentificacion_titular_cuenta,'$param_identificacion_titular_cuenta',";
				 $SQL = $SQL."'$param_nombre_titular_cuenta',$param_idbanco_transferencias,'$param_nro_cuenta_transferencias',";
				 $SQL = $SQL."'$param_tipo_cuenta_transferencias',$param_idmcipio_transferencias,$param_acepto_retencion_comis_para_pago_pedidos,";
				 $SQL = $SQL."$param_valor_comisiones_para_pago_pedidos,$nadie_presenta,$idtipo_plan_compras,$idtppersona ";
						$Registro    =  $this->Db->Ejecutar_Sp("terceros_crear_modificar(".$SQL.")");
						return $Registro ;
				}

				public function Finalizar_Registro_Usuario_Ocasional($idtercero,$password){

							$Registro                 =  $this->Db->Ejecutar_Sp("terceros_finalizar_registro_ocasional($idtercero,'$password')");
				}

				public function Verificar_Activacion_Usuario($email){
						 $Registro   =  $this->Db->Ejecutar_Sp("terceros_verificar_activacion_cuenta('$email')");
							return $Registro;
				}


				public function Cambio_Plan($tipo_proceso_en_plan,$idtercero,$idtipo_plan_compras){
						 $Registro   =  $this->Db->Ejecutar_Sp("terceros_cambio_plan_compras('$tipo_proceso_en_plan',$idtercero,$idtipo_plan_compras )");
							return $Registro;
				}

				public function Generar_Codigo_Registro_Nadie_Presenta(){
						/** JUNIO 05 2015
 						 * 		CUANDO NADIE PRESENTA SE CORRE PROCESO AUTOMATICO PARA ASIGNAR A UN INTEGRANTE DE LA RED
						 */
							$Registro         =  $this->Db->Ejecutar_Sp("terceros_genera_codigo_asigna_codigo_nadie_presenta()");
							return $Registro;
				}

				public function Generar_Codigo_Usuario($pnombre, $papellido,$dia,$mes){
						/** JUNIO 05 2015
 						 * 		CUANDO NADIE PRESENTA SE CORRE PROCESO AUTOMATICO PARA ASIGNAR A UN INTEGRANTE DE LA RED
						 */
							$Registro         =  $this->Db->Ejecutar_Sp("terceros_genera_codigo_usuario('$pnombre', '$papellido','$dia','$mes')");
							return $Registro;
				}
				public function Generar_Codigo_Emmpresa($razonsocial){
						/** JUNIO 05 2015
 						 * 		CUANDO NADIE PRESENTA SE CORRE PROCESO AUTOMATICO PARA ASIGNAR A UN INTEGRANTE DE LA RED
						 */
							$Registro         =  $this->Db->Ejecutar_Sp("terceros_genera_codigo_empresa('$razonsocial')");
							return $Registro;
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

				public function Direcciones_Despacho( $idtercero = false)
				{
					if ( $idtercero == false ) {
							$idtercero                = Session::Get('idtercero_pedido');
						}
					$Registro                 =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_idtercero( $idtercero )");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}


				public function Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($iddireccion_despacho)
				{
			 	$Registro =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_iddireccion_despacho($iddireccion_despacho)");
					$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
					return $Registro;
				}

				public function Consultar_Datos_Mcipio_x_IdMcipio($idmcipio )	{

			 	$Registro =  $this->Db->Ejecutar_Sp("terceros_direcciones_despacho_x_idmcipio( $idmcipio )");
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

				public function Terceros_Consultar_Datos_Identificacion_Codigo_Usuario($identificacion)
				{
						/** SEPTIEMBRE 01 DE 2015
								 CONSULTA DATOS DEL USUARIO CON  LA IDENTIFICACION Y EL CÓDIGO			*/
						$Terceros                 = $this->Db->Ejecutar_Sp("terceros_consultar_datos_identific_codigo_usuario('$identificacion')");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return $Terceros;
				}





  }
?>
