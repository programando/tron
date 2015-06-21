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
              $idtercero                    = Session::Get('idtercero');
              $this->View->Saldo_Comisiones = '$ 0';
              $this->View->Saldo_Puntos     = '$ 0';
              $this->View->Comisiones       = $this->Informes->Comisiones_Saldos($idtercero);
              $this->View->Puntos           = $this->Informes->Puntos_Saldos($idtercero);
              if ( $this->View->Comisiones  ) {
                    $this->View->Saldo_Comisiones = Numeric_Functions::Formato_Numero( $this->View->Comisiones[0]['saldo_comisiones']);
                  }
              if ( $this->View->Puntos ) {
                  $this->View->Saldo_Puntos     = Numeric_Functions::Formato_Numero( $this->View->Puntos[0]['saldo_puntos_cantidad']);
                }

              $this->View->SetCss(array("tron_informe_mi_cuenta","tron_barra_usuarios","cuenta_navbar_informe"));
              $this->View->SetJs(array('tron_informes'));
              $this->View->Mostrar_Vista("comisiones_puntos");
          }

          public function Saldos_Comisiones_Puntos_x_IdTercero() {
              $idtercero =  General_Functions::Validar_Entrada('idtercero','NUM');
              $this->View->Saldo_Comisiones = '$ 0';
              $this->View->Saldo_Puntos     = '$ 0';
              $this->View->Comisiones       = $this->Informes->Comisiones_Saldos($idtercero);
              $this->View->Puntos           = $this->Informes->Puntos_Saldos($idtercero);
              if ( $this->View->Comisiones  ) {
                    $this->View->Saldo_Comisiones = Numeric_Functions::Formato_Numero( $this->View->Comisiones[0]['saldo_comisiones']);
                  }
              if ( $this->View->Puntos ) {
                  $this->View->Saldo_Puntos     = Numeric_Functions::Formato_Numero( $this->View->Puntos[0]['saldo_puntos_cantidad']);
                }
              $this->View->Mostrar_Vista_Parcial("comisiones_puntos_x_idtercero");
          }

    public function Participacion_En_La_Red($idtercero=80021, $anio=0)
    {
        if ($anio == 0 ) {
            $anio = date('Y');
        }

        $this->View->Anios    = $this->Informes->Anios_Disponibles_Consultas();
        $this->View->Terceros = $this->Informes->Participacion_En_La_Red(80021,$anio);
        $this->View->SetCss(array("tron_barra_usuarios","tron_cuenta_info_partici_la_red","cuenta_navbar_informe"));
        $this->View->Mostrar_Vista("participacion_la_red");
    }


    }
?>
