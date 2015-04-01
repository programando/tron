<?php
		class FletesModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Consultar_Fletes_Productos_Tron()
				{
						/** ENERO 04 DE 2014
						*		 Consulta las marcas registradas en la base de datos			*/
						$Fletes                 = $this->Db->Ejecutar_Sp("fletes_consulta_para_productos_tron()");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return 		$Fletes   ;
				}


  }
?>
