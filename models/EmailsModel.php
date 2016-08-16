<?php
		class EmailsModel extends Model
		{
				public $Cantidad_Registros;


				public function __construct()
				{
					parent::__construct();
				}

				public function Nuevos_Usuarios_Registrados()			{
						/** JUNIO 18 2016
						*		 CONSULTA LAS PERSONAS/USUARIOS A QUIENES SE INFORMA	SOBRE EL INGRESO DE UN NUEVO MIEMBRO A SU RED		*/
						$NuevosUsuarios                 = $this->Db->Ejecutar_Sp("mensajes_nuevos_usuarios_correos_pendientes () ");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return $NuevosUsuarios ;
				}

				public function Nuevos_Usuarios_Registrados_Borrar_Registro( $idregistro)			{
						/** JUNIO 18 2016
						*		 LUEGO DE ENVIAR EL CORREO SE BORRA EL REGISTRO DE LA TABLA EN LA BASE DE DATOS	*/
						$NuevosUsuarios                 = $this->Db->Ejecutar_Sp("mensajes_nuevos_usuarios_borrar_registro ( $idregistro) ");
				}

				public function Usuarios_Cumplen_Anios()
				{
						/** JUNIO 18 2016
						*		 CONSULTA LAS PERSONAS/USUARIOS A QUIENES SE INFORMA	SOBRE EL INGRESO DE UN NUEVO MIEMBRO A SU RED		*/
						$Usuarios                 = $this->Db->Ejecutar_Sp("mensajes_usuarios_cumplen_anios () ");
						return $Usuarios ;
				}

				public function Usuarios_Proximos_a_Comprimirse()
				{
						/** JUNIO 18 2016
						*		 CONSULTA LAS PERSONAS/USUARIOS A QUIENES SE INFORMA	SOBRE EL INGRESO DE UN NUEVO MIEMBRO A SU RED		*/
						$Usuarios                 = $this->Db->Ejecutar_Sp("terceros_compresion_preventiva_email () ");
						return $Usuarios ;
				}

  }
?>
