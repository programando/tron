<?php
		class TiposdocumentosModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}

				public function Consultar()
				{
					$TiposDocumentos = $this->Db->Ejecutar_Sp("tipos_identificacion_listado()");
					return $TiposDocumentos;
				}


  }
?>
