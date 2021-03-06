<?php

  class InformesController extends Controller  {

      public function __construct() {
          parent::__construct();
          $this->Informes    = $this->Load_Model('Informes');
          $this->ComisPuntos = $this->Load_Model('ComisionesPuntos');
          $this->Terceros    = $this->Load_Controller('Terceros');
      }

      public function Index() { }


      public function Salida_Comisiones ( ){
              $idtercero             = General_Functions::Validar_Entrada('idtercero','NUM');
              $tipo_registro         = General_Functions::Validar_Entrada('tipo_registro','NUM');
              $numero_pedido         = General_Functions::Validar_Entrada('numero_pedido','NUM');
              $valor                 = General_Functions::Validar_Entrada('valor','NUM');
              $idtercero_destino     = General_Functions::Validar_Entrada('idtercero_destino','NUM');

              $idtipo_registro       = $tipo_registro ;
              $comisiones_utilizadas = $valor ;
              $observacion           = '' ;

              $this->ComisPuntos->Actualizar_Comisiones( $idtercero,$tipo_registro,$numero_pedido,$valor );

              $idtercero = $idtercero_destino;
              $datos     = compact('idtercero','idtipo_registro','comisiones_utilizadas','observacion');
              $this->ComisPuntos->Entrada_Comisiones ( $datos );

              echo "OK";
        }


      public function Salida_Puntos (){
              $idtercero         = General_Functions::Validar_Entrada('idtercero','NUM');
              $tipo_registro     = General_Functions::Validar_Entrada('tipo_registro','NUM');
              $numero_pedido     = General_Functions::Validar_Entrada('numero_pedido','NUM');
              $valor             = General_Functions::Validar_Entrada('valor','NUM');
              $idtercero_destino = General_Functions::Validar_Entrada('idtercero_destino','NUM');
              $idtipo_registro   = $tipo_registro ;
              $puntos_utilizados = $valor ;
              $observacion       = '';


              $this->ComisPuntos->Actualizar_Puntos( $idtercero,$tipo_registro,$numero_pedido,$valor );

              $idtercero = $idtercero_destino;
              $datos     = compact('idtercero','idtipo_registro','puntos_utilizados','observacion');

              $this->ComisPuntos->Puntos_Entrada ( $datos );
           echo "OK";
        }





      public function traslado_comisiones_puntos (){
             $this->Terceros->Buscar_Usuarios_Activos_x_Email();
             $this->View->Datos         = Session::Get('codigos_usuario');
             $this->View->SetJs(array('tron_informes'));
             $this->View->Mostrar_Vista("traslado_entre_cuentas");
         }



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

         public function Compras_Totales_Clientes($idtercero=false, $anio=0){
            //compras_totales_clientes ( js)
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

          public function Comisiones( ) {
              $meses = array("ENERO", "FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO",
                "AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

              $idtercero =  Session::Get('idtercero');
              $mes       =  General_Functions::Validar_Entrada('idmes','NUM');
              $anio      =  General_Functions::Validar_Entrada('anio','NUM');
              $nom_mes   =  General_Functions::Validar_Entrada('nom_mes','TEXT');
              $nom_mes   = strtoupper( $nom_mes );

              if ( empty( $nom_mes )   ) {
                  $mes  = $meses[date("n")-1] ;
                  $anio = date("Y");
                  $nom_mes = $mes .' - ' .  $anio;
                  $mes  = date("n");
              }
              $this->View->Comisiones         =  $this->Informes->Comisiones_Ganadas_x_IdTercero( $idtercero,$mes, $anio) ;
              if ( !isset( $this->View->Periodos )) {
                $this->View->Periodos =  $this->Informes->Periodos_Comisiones();
              }
              $this->View->nom_mes = 'COMISIONES  ' .  $nom_mes;
              $this->View->SetJs(array('tron_informes','tron_terceros_administrar_cuenta'));
              $this->View->Mostrar_Vista_Parcial("comisiones");
          }

          public function Comisiones_x_Pedido( $numero_pedido = 0) {
              $idtercero =  Session::Get('idtercero');
              $this->View->Comisiones    = $this->Informes->Comisiones_Ganadas_x_Pedido( $idtercero,$numero_pedido) ;
              $this->View->Numero_Pedido = $numero_pedido;
              $this->View->IdTercero     = $idtercero;
              $this->View->SetJs(array('tron_informes','tron_terceros_administrar_cuenta'));
              $this->View->Mostrar_Vista_Parcial("comisiones_x_pedido");

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
