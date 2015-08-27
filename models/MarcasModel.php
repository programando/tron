<?php
		class MarcasModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Marcas_Consultar($Id_Area_Consulta)
				{
						/** ENERO 04 DE 2014
						*		 Consulta las marcas registradas en la base de datos			*/
						$Marcas                 = $this->Db->Ejecutar_Sp("productos_marcas_listado_general($Id_Area_Consulta)");
						$this->Cantidad_Registros = $this->Db->Cantidad_Registros;
						return $Marcas ;
				}
  }
?>
