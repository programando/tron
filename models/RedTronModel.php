<?php
		class RedTronModel extends Model
		{


				public function __construct()
				{
					parent::__construct();
				}

				public function Bonificaciones_Cuotas()	{
						/** OCTUBRE 02 DE 2015
						*		 Consulta las marcas registradas en la base de datos			*/
						$Registro                 = $this->Db->Ejecutar_Sp("parametros_bonificaciones_cuotas_consultar()");
						return 		$Registro  ;
				}

				public function Bonificaciones_Porcentajes()	{
						/** OCTUBRE 02 DE 2015
						*		 Consulta las marcas registradas en la base de datos			*/
						$Registro                 = $this->Db->Ejecutar_Sp("parametros_bonificaciones_porcentajes_consulta()");
						return 		$Registro  ;
				}




  }
?>
