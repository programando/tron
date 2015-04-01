<?php

  class MunicipiosController extends Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->Municpios = $this->Load_Model('Municipios');
      }

      public function Index() { }

      public function Consultar()
      {
      	 $IdDpto  = General_Functions::Validar_Entrada('iddpto','NUM');
      		$this->Municpios = $this->Municpios->Consultar($IdDpto );
          //Debug::Mostrar($this->Municpios);
      		echo json_encode($this->Municpios,256);
      }

    }
?>
