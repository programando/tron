<?php

  class InformesController extends Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->Informes = $this->Load_Model('Informes');

      }

      public function Index() { }

         public function compras_tron(){
             $this->View->Mostrar_Vista_Parcial("compras_tron");
         }

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

              $this->View->Mostrar_Vista_Parcial("comisiones_puntos");
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

        public function Participacion_En_La_Red($idtercero =false, $anio=0)
        {
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
            $this->View->Anios    = $this->Informes->Anios_Disponibles_Consultas();
            $this->View->Terceros = $this->Informes->Participacion_En_La_Red($idtercero,$anio);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("participacion_la_red");
        }

        public function Participacion_En_La_Red_Ajax($idtercero =false, $anio=0)
        {
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
             $this->View->Terceros = $this->Informes->Participacion_En_La_Red($idtercero,$anio);
             $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("participacion_la_red_x_idtercero");
        }


        public function Mi_Red_de_Usuarios()
        {

            $this->View->Mostrar_Vista_Parcial("mi_red_de_usuarios");
        }
    }

?>
