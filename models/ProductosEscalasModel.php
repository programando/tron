<?php
		class ProductosEscalasModel extends Model
		{
				public $Cantidad_Registros;

				public function __construct()
				{
					parent::__construct();
				}


    public function Escalas_Consultar($idescala)
    {
    		/** DIC 30 DE 2014.
							 CONSULTA LAS ESCALAS POR TIPO DE ESCALA. LAS ESCALAS PERMITEN TENER VALORES DE COMPRA DIFERENCIALES*/
        $Productos_Escalas = $this->Db->Ejecutar_Sp("productos_escalas_compras_consultar_x_id_escala($idescala)");
        return $Productos_Escalas;
    }

    public function Escalas_Consultar_Rangos($idescala)
    {
    		/** DIC 30 DE 2014.
							 CONSULTA LOS RANGOS DE LAS ESCALAS POR TIPO DE ESCALA*/
        $Productos_Escalas_Rangos = $this->Db->Ejecutar_Sp("productos_escalas_compras_consulta_rangos($idescala)");
        return $Productos_Escalas_Rangos;
    }


  }

?>
