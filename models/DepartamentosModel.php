<?php
		class DepartamentosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Consultar()
				{
					$Departamentos = $this->Db->Ejecutar_Sp("departamentos_consultar()");
					return 	$Departamentos ;
				}


  }
?>
