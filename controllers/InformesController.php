<?php

  class InformesController extends Controller  {
      public function __construct()
      {
          parent::__construct();
          $this->Informes = $this->Load_Model('Informes');

      }

      public function Index() { }



         public function Compras_Totales($idtercero=false, $anio=0){
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
             $this->View->Datos_Compras = $this->Informes->Compras_Totales($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes");
         }


           public function Compras_Totales_x_IdTercero($idtercero=false, $anio=0){
             $this->View->Datos_Compras = $this->Informes->Compras_Totales($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes_x_idtercero");
         }




         public function Compras_Productos_Industriales($idtercero=false, $anio=0){
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
             $this->View->Datos_Compras = $this->Informes->Compras_Productos_Industriales($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes");
         }


           public function Compras_Productos_Industriales_x_IdTercero($idtercero=false, $anio=0){
             $this->View->Datos_Compras = $this->Informes->Compras_Productos_Industriales($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes_x_idtercero");
         }


         public function Compras_Otros_Productos($idtercero=false, $anio=0){
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
             $this->View->Datos_Compras = $this->Informes->Compras_Otros_Productos($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes");
         }

           public function Compras_Otros_Productos_x_IdTercero($idtercero=false, $anio=0){
             $this->View->Datos_Compras = $this->Informes->Compras_Otros_Productos($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes_x_idtercero");
         }


         public function Compras_Productos_Tron($idtercero=false, $anio=0){
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
             $this->View->Datos_Compras = $this->Informes->Compras_Productos_Tron($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes");
         }

           public function Compras_Productos_Tron_x_IdTercero($idtercero=false, $anio=0){
             $this->View->Datos_Compras = $this->Informes->Compras_Productos_Tron($idtercero ,$anio );
             $this->View->Anios         = $this->Informes->Anios_Disponibles_Consultas();
             $this->View->Mostrar_Vista_Parcial("compras_mes_a_mes_x_idtercero");
         }




          public function Saldos_Comisiones_Puntos() {
              $idtercero                    = Session::Get('idtercero');
              $this->View->Saldo_Comisiones = '$ 0';
              $this->View->Saldo_Puntos     = ' 0';
              $this->View->Comisiones       = $this->Informes->Comisiones_Saldos($idtercero);
              $this->View->Puntos           = $this->Informes->Puntos_Saldos($idtercero);
              if ( $this->View->Comisiones  ) {
                    $this->View->Saldo_Comisiones = Numeric_Functions::Formato_Numero( $this->View->Comisiones[0]['saldo_comisiones']);
                  }
              if ( $this->View->Puntos ) {
                  $this->View->Saldo_Puntos     = Numeric_Functions::Formato_Numero_SinSigno( $this->View->Puntos[0]['saldo_puntos_cantidad']);
                }

              $this->View->Mostrar_Vista_Parcial("comisiones_puntos");
          }

          public function Saldos_Comisiones_Puntos_x_IdTercero() {
              $idtercero =  General_Functions::Validar_Entrada('idtercero','NUM');
              $this->View->Saldo_Comisiones = '$ 0';
              $this->View->Saldo_Puntos     = ' 0';
              $this->View->Comisiones       = $this->Informes->Comisiones_Saldos($idtercero);
              $this->View->Puntos           = $this->Informes->Puntos_Saldos($idtercero);
              if ( $this->View->Comisiones  ) {
                    $this->View->Saldo_Comisiones = Numeric_Functions::Formato_Numero( $this->View->Comisiones[0]['saldo_comisiones']);
                  }
              if ( $this->View->Puntos ) {
                  $this->View->Saldo_Puntos     = Numeric_Functions::Formato_Numero_SinSigno( $this->View->Puntos[0]['saldo_puntos_cantidad']);
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

            $this->View->Terceros = $this->Informes->Participacion_En_La_Red($idtercero,$anio);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("participacion_la_red");
        }

        public function Participacion_En_La_Red_Ajax($idtercero =false, $anio=0) {
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


        public function Amigos_Presentados($idtercero =false, $anio=0) {
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
            $this->View->Anios              = $this->Informes->Anios_Disponibles_Consultas();
            $this->View->Terceros           = $this->Informes->Amigos_Presentados($idtercero,$anio);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("amigos_presentados");
        }

        public function Amigos_Presentados_Ajax($idtercero =false, $anio=0) {
            if ($anio == 0 ) {
                $anio = date('Y');
            }
            if ( $idtercero == FALSE ){
              $idtercero = Session::Get('idtercero');
            }
            $this->View->Anios              = $this->Informes->Anios_Disponibles_Consultas();
            $this->View->Terceros           = $this->Informes->Amigos_Presentados($idtercero,$anio);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("amigos_presentados_x_idtercero");
        }


        public function Clientes_Presentados($codigousuario='') {
            if ( $codigousuario == '' ){
              $codigousuario  = Session::Get('codigousuario');
            }
            $this->View->Clientes           = $this->Informes->Clientes_Presentados($codigousuario);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("clientes_presentados");
        }

        public function Clientes_Presentados_Ajax($codigousuario='') {

            $this->View->Clientes           = $this->Informes->Clientes_Presentados($codigousuario);
            $this->View->Cantidad_Registros = $this->Informes->Cantidad_Registros;
            $this->View->Mostrar_Vista_Parcial("clientes_presentados_x_idtercero");
        }

        public function Mi_Red_de_Usuarios(  $idtercero=0 ) {
          if ( $idtercero == 0 ){
              $idtercero = Session::Get('idtercero_pedido');
          }
          $this->View->SetCss(array("cuenta_informe_mi_red"));
          $this->View->row =   $this->Informes->Total_Amigos_Detallado_Por_Nivel ( $idtercero);

          $this->View->Mostrar_Vista_Parcial("mi_red_de_usuarios");
        }


        public function Mi_Red_de_Usuarios_x_IdTtercero(  $idtercero=0 ) {
          $this->View->SetCss(array("cuenta_informe_mi_red"));
          $this->View->row =   $this->Informes->Total_Amigos_Detallado_Por_Nivel ( $idtercero);
          $this->View->Mostrar_Vista_Parcial("mi_red_de_usuarios_x_idtercero");
        }

    }

?>
