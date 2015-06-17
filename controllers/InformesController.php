<?php

  class InformesController extends Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->Informes = $this->Load_Model('Informes');

      }

      public function Index() { }


    public function Saldos_Comisiones_Puntos() {
        $idtercero = Session::Get('idtercero');

        $this->View->Comisiones       = $this->Informes->Comisiones_Saldos($idtercero);
        $this->View->Puntos           = $this->Informes->Puntos_Saldos($idtercero);
        $this->View->Saldo_Comisiones = Numeric_Functions::Formato_Numero( $this->View->Comisiones[0]['saldo_comisiones']);
        $this->View->Saldo_Puntos     = Numeric_Functions::Formato_Numero( $this->View->Puntos[0]['saldo_puntos_cantidad']);


        $this->View->SetCss(array("tron_informe_mi_cuenta","tron_barra_usuarios","cuenta_navbar_informe"));
        $this->View->SetJs(array('tron_informes'));
        $this->View->Mostrar_Vista("comisiones_puntos");
    }


    }
?>
