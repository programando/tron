<?php

class ParametrosController extends Controller
	{

				 public function __construct()
				 {
				     parent::__construct();
				     $this->Parametros = $this->Load_Model('Parametros');
				 }

						public function Index() { }

						public function Consultar(){
								return $this->Parametros->Consultar();
						}

						public function Transportadoras()	{
									return $this->Parametros->Transportadoras();
						}

						public function Transportadoras_Vr_Kilo_Destino($idmcipio){
							 echo $idmcipio;
							 echo "valor";
								 if ( !isset( $idmcipio ) || empty( $idmcipio)){
								 	$idmcipio = 153;
								 }
							 echo $idmcipio;
							 echo "valor 2";
									return $this->Parametros->Transportadoras_Vr_Kilo_Destino($idmcipio);
						}
	  }
?>
