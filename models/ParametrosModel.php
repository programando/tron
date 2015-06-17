<?php
		class ParametrosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Consultar()
				{
						/** ENERO 04 DE 2014
						*		 Consulta las marcas registradas en la base de datos			*/
						$Parametros               = $this->Db->Ejecutar_Sp("parametros_consultar()");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return 	$Parametros  ;
				}

				public function Transportadoras()
				{
						/** ENERO 04 DE 2014
						*		 CONSULTA LOS PARAMETROS DE LAS TRANSPORTADORAS		*/
						$Parametros                 = $this->Db->Ejecutar_Sp("parametros_especiales_transportadoras()");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return 	$Parametros  ;
				}

				public function Bancos_Para_Transferencias(){
						/** JUNIO 16 DE 2015
						*		 CONSULTA LOS BANCOS PARA TRANSFERENCIA ELECTRONICA	*/
						$Parametros                 = $this->Db->Ejecutar_Sp("bancos_para_transferencias_listado()");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return 	$Parametros  ;
				}

  }
?>
