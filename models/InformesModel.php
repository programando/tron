<?php
		class InformesModel extends Model
		{
							public $Cantidad_Registros;

							public function __construct()
							{
								parent::__construct();
							}


						public function Comisiones_Saldos($idtercero)
						{
								/** ENERO 04 DE 2014
								*		 Consulta las marcas registradas en la base de datos			*/
								$Registro                = $this->Db->Ejecutar_Sp("comisiones_consultar_estado_cuenta_x_idtercero($idtercero)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}
						public function Puntos_Saldos($idtercero)
						{
								/** ENERO 04 DE 2014
								*		 Consulta las marcas registradas en la base de datos			*/
								$Registro                = $this->Db->Ejecutar_Sp("historial_puntos_consulta_mvto_x_idtercero($idtercero)");
								$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
								return 			$Registro   ;
						}




   }
?>
