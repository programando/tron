
<?php

class CarritoController extends Controller{
 private $Carrito_Vacio                   = false;
 private $Cantidad_Filas_Carrito          = 0;
 private $Datos_Carro;


     private $SubTotal_Pedido_Amigos          = 0;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
     private $SubTotal_Pedido_Ocasional       = 0;
     private $SubTotal_Pedido_Real            = 0;
     private $SubTotal_Aplica_Recaudo         = 0;

     private $Vr_Fletes                       = 0;
     private $Vr_Fletes_Amigo_Tron            = 0;
     private $Vr_Fletes_Ocasional             = 0;

     private $Presupuesto_Fletes              = 0;
     private $Vr_Recaudo                      = 0;
     private $Vr_Recaudo_tron                 = 0;
     private $Vr_Recaudo_ocas                 = 0;

     private $Vr_Transporte                   = 0;
     private $Vr_Total_Pedido_Amigos          = 0;
     private $Vr_Total_Pedido_Real            = 0;
     private $Vr_Base_Iva                     = 0;


     private $Carrito_Habilitado              = false;
     // VARIABLES PARA PRODUCTOS TRON.LSJS
     private $Tron_Peso_Total_Gramos          =   0;
     private $Tron_Cmv_Total                  = 0;
     private $Tron_Precio_Lista_Total         = 0;
     //VARIABLES PARA OPERACIONES TOTALES EN EL CARRITO
     private $Saldo_Puntos_Cantidad           = 0;
     private $Saldo_Comisiones                = 0;
     private $Vr_Cupon_Descuento              = 0;

     private $Vr_Total_Pedido_Ocasional       = 0;
     private $Vr_Total_Pedido_Tron            = 0;


     private $compras_tron                    = 0;
     private $compras_tron_sin_iva            = 0;
     private $compras_industrial              = 0;
     private $compras_otros_productos         = 0;
     private $compras_accesorios              = 0;

     private $PayuLatam_Recaudo               = 0;
     private $PayuLatam_Valor_Minimo          = 0;
     private $PayuLatam_Valor_Adicional       = 0;

     private $Cantidad_Ropa                   =  0 ;
     private $Peso_Ropa                       =  0 ;
     private $Cmv_Ropa                        =  0 ;
     private $Precio_Lista_Ropa               =  0 ;

     private $Cantidad_Banios                 =  0 ;
     private $Peso_Banios                     =  0 ;
     private $Cmv_Banios                      =  0 ;
     private $Precio_Lista_Banios             =  0 ;

     private $Cantidad_Pisos                  =  0 ;
     private $Peso_Pisos                      =  0 ;
     private $Cmv_Pisos                       =  0 ;
     private $Precio_Lista_Pisos              =  0 ;


     private $Cantidad_Loza                   =  0 ;
     private $Peso_Loza                       =  0 ;
     private $Cmv_Loza                        =  0 ;
     private $Precio_Lista_Loza               =  0 ;
     private $Tengo_Productos_Tron            = FALSE;
     private $Cantidad_Productos_Tron         = 0;
     private $Cantidad_Registros_Prod_Tron    = 0;


     private $Valor_Declarado_Total           = 0;
     private $Valor_Declarado                 = 0;

     private $vr_total_ppto_fletes            = 0;
     private $vr_total_ppto_fletes_tron       = 0;
     private $vr_total_ppto_fletes_ocas       = 0;

     private $vr_total_anticipo_recaudo       = 0;
     private $vr_total_anticipo_recaudo_tron       = 0;
     private $vr_total_anticipo_recaudo_ocas      = 0;

     private $Vr_Declarado_Courrier_Ocas      = 0;
     private $Vr_Declarado_Courrier_Tron      = 0;
     private $Vr_Declarado_Courrier_Total     = 0;
     private $Peso_Pedido_Courrier            = 0;

     private $Vr_Declarado_Carga_Ocas         = 0;
     private $Vr_Declarado_Carga_Tron         = 0;
     private $Vr_Declarado_Carga_Total        = 0;
     private $Peso_Pedido_Carga               = 0;


     private $Vr_Transporte_Cliente           = 0;

     private $Vr_Transporte_Real              = 0;
     private $Vr_Transporte_Ocasional         = 0;
     private $Vr_Transporte_Tron              = 0;
     private $Existe_Derecho_Inscripcion      = FALSE;

     private $Id_Transportador_Carga           = 0;
     private $Id_Transportador_Courrier        = 0;







     public function __construct()  {

       parent::__construct();
       $this->Escalas        = $this->Load_Controller('ProductosEscalas');
       $this->Parametros     = $this->Load_Controller('Parametros');
       $this->Terceros       = $this->Load_Controller('Terceros');
       $this->Productos_Tron = $this->Load_Controller('ProductosTron');
       $this->Pedidos        = $this->Load_Controller('Pedidos');
       $this->Fletes         = $this->Load_Controller('Fletes');
       $this->Departamentos  = $this->Load_Model('Departamentos');
       $this->Productos      = $this->Load_Model('Productos');
       $this->MdlTerceros    = $this->Load_Model('Terceros');

     }

     public function index() {}


     public function Finalizar_Pedido_Forma_Pago( $idpedido = 0)  {
        /** JULIO 02 DE 2015
         *      MUESTRA VISTA PARA ELEGIR LA FORMA DE PAGO DEL PEDIDO
         *      SI $idpedido > 0, INDICA QUE VENGO DE LA CONSULTA DE PEDIDOS Y VOY A CAMBIAR LA FORMA DE PAGO
         */


        $Vr_Total_Pedido_Real = Session::Get('Valor_Final_Pedido_Real');


        if ( $idpedido > 0 ){
         $Vr_Total_Pedido_Real = 1;
         Session::Set('idpedido_temporal', $idpedido);
         $this->Pedidos->Datos_Cambio_Forma_Pago ( $idpedido );

       }

       if ( $Vr_Total_Pedido_Real > 0 ){

        $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
        $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_carrito_forma_pago','tron_estilos_linea_tiempo'));
        Session::Set('imagen_resumen_pedido',FALSE);

        $this->View->Mostrar_Vista('finalizar_pedido_forma_pago');
      }else{
        $this->View->Mostrar_Vista('pedido_pago_cero');
      }
    }



    public function Finalizar_Pedido_Finalizar_Direccion() {
      /** MARZO 04 DE 2015
      *     VALIDA QUE SE HAYA ELEGIDO UN USUARIO PARA EL PEDIDO
      */

      Session::Set('imagen_resumen_pedido',TRUE);
      $iddireccion_despacho                   = Session::Get('iddireccion_despacho');
      $idtercero_pedido                       = Session::Get('idtercero_pedido');
      $cpras_tron_prod_indus_este_pedido      = Session::Get('compras_tron_prod_indus_este_pedido'); // compra de tron e industriales en el pedido actual
      $Cumple_Condicion_Cpras_Tron_Industial  = Session::Get('cumple_condicion_cpras_tron_industial');

      $Texto_Resultado                        = 'Siguente_Paso_OK';
      $Texto_Error                            = 'Debes la dirección a donde enviarás el pedido para poder continuar...';


      $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho( $iddireccion_despacho );
      if (!isset($iddireccion_despacho) || ($iddireccion_despacho==0) || ($iddireccion_despacho== NULL)) {
        $Texto_Resultado =$Texto_Error;
      }
      if (!isset($idtercero_pedido) || ($idtercero_pedido==0) || ($idtercero_pedido== NULL)) {
        $Texto_Resultado =$Texto_Error;
      }
      echo $Texto_Resultado ;
    }

    public function Finalizar_Pedido_Seleccionar_Direccion() {
    /**  MARZO 04 DE 2015
      *   REALIZA EL CAMBIO DE LOS DATOS DE UBICACIÓN PARA ENTREGA DEL PEDIDO
      */
    $IdDireccion_Despacho =  General_Functions::Validar_Entrada('iddirecciondespacho','NUM');
    $IdMcipio             =  General_Functions::Validar_Entrada('idmcipio','NUM');
    $IdDpto               =  General_Functions::Validar_Entrada('iddpto','NUM');
    $Re_Expedicion        =  General_Functions::Validar_Entrada('reexpedicion','BOL');
    $codigousuario        =  General_Functions::Validar_Entrada('codigousuario','TEXT');
    $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho( $IdDireccion_Despacho,$IdMcipio  );
    Session::Set('codigousuario',  $codigousuario);
  }

  public function Finalizar_Pedido_Direccion_Final() {
    /**  MARZO 04 DE 2015
      *   REALIZA EL CAMBIO DE LOS DATOS DE UBICACIÓN PARA ENTREGA DEL PEDIDO
      */
    $IdDireccion_Despacho =  General_Functions::Validar_Entrada('iddirecciondespacho','NUM');
    $IdMcipio             =  General_Functions::Validar_Entrada('idmcipio','NUM');
    $IdDpto               =  General_Functions::Validar_Entrada('iddpto','NUM');
    $Re_Expedicion        =  General_Functions::Validar_Entrada('reexpedicion','BOL');
    $codigousuario        =  General_Functions::Validar_Entrada('codigousuario','TEXT');
    $Cobrar_Fletes        =  General_Functions::Validar_Entrada('cobrar_fletes','BOL');

    $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho( $IdDireccion_Despacho,$IdMcipio  );
    Session::Set('codigousuario',  $codigousuario);
    Session::Set('iddireccion_despacho',            $IdDireccion_Despacho);


  }

  public function Finalizar_Pedido_Direccion_Envio() {
      /** FEBRERO 28 DE 2015
          DETERMINA EL SIGUIENTE PASO EN LA FINALIZACIÓN DEL PEDIDO.  IDENTIFICACION O CONFIRMACIÓN DE ENVÍO
      */
          $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
          $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_barra_usuarios','tron_estilos_linea_tiempo'));
          $this->View->Direcciones   = $this->Terceros->Direcciones_Despacho();
          $this->View->Departamentos = $this->Departamentos->Consultar();
          $this->View->Mostrar_Vista('finalizar_pedido_direccion');
        }

        public function Finalizar_Pedido_Direccion_Cambio_Usuario() {
          $Idtercero            =  General_Functions::Validar_Entrada('idtercero','NUM');
          $Cantidad_Direcciones =  General_Functions::Validar_Entrada('cantidad_direcciones','NUM');
          Session::Set('idtercero_pedido',$Idtercero );
      Session::Set('iddireccion_despacho',   0 ); // REESTABLECEMOS PARA VALIDAR QUE SEA SELECCIONADA DE NUEVO
      Session::Set('cantidad_direcciones', $Cantidad_Direcciones);
      echo "OK";
    }


    public function Finalizar_Pedido_Direccion_Mostrar_Direcciones()    {
      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_barra_usuarios','tron_estilos_linea_tiempo'));
      $this->View->Direcciones = $this->Terceros->Direcciones_Despacho();
      Session::Set('iddireccion_despacho',   0 );
      $this->View->Mostrar_Vista_Parcial('finalizar_pedido_direccion_usuario');
    }

    public function Finalizar_Pedido_Identificacion()  {
        /** FEBRERO 28 DE 2015
          DETERMINA EL SIGUIENTE PASO EN LA FINALIZACIÓN DEL PEDIDO.
          IDENTIFICACION O CONFIRMACIÓN DE ENVÍO
      */
          $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios','tron_productos.jquery'));
          $this->View->SetCss(array('tron_carrito','tron_carrito_identificacion','tron_carrito_confi_envio','tron_barra_usuarios','tron_estilos_linea_tiempo'));

          $this->View->Departamentos = $this->Departamentos->Consultar();
          Session::Set('iddireccion_despacho',   0 );
          Session::Set('finalizar_pedido_siguiente_paso','DIRECCION');

          if ( $_SESSION['logueado'] == FALSE ) {
            $this->View->Mostrar_Vista('finalizar_pedido_identificacion');
          }else      {
            $this->View->Direcciones = $this->Terceros->Direcciones_Despacho();
            $this->View->Mostrar_Vista('finalizar_pedido_direccion');
          }

        }



        private function Iniciar_Procesos_Carro()  {
          $this->Cantidad_Filas_Carrito     = 0;
          $this->Carrito_Habilitado         =  FALSE;
          $this->Carrito_Vacio              =  FALSE;

          if (isset($_SESSION['carrito'])) {
            $this->Datos_Carro                = $_SESSION['carrito'];
            $this->Cantidad_Filas_Carrito     = count($this->Datos_Carro  );
            $this->Carrito_Habilitado         = TRUE;

            if ($this->Cantidad_Filas_Carrito == 0)    {
              $this->Cantidad_Filas_Carrito = 0;
              $this->Carrito_Vacio          = TRUE;
            }
          }

        }

        private function Cerrar_Procesos_Carro() {

          $_SESSION['carrito']     = $this->Datos_Carro ;
        }



        public  function Borrar_Producto_Carrito($producto=0, $cantidad=0) {
      /** ENERO 15 DE 2015
      *   BORRA UN PRODUCTO INDICADO POR EL USUARIO
      */
      $this->Iniciar_Procesos_Carro();

      Session::Set('pv_tron_resumen',0);
      Session::Set('pv_ocas_resumen',0);
      if ( $producto == 0 &&  $cantidad == 0){
        $IdProducto        = General_Functions::Validar_Entrada('IdProducto','NUM');
        $Cantidad          = General_Functions::Validar_Entrada('Cantidad','NUM');
        $IdProductoCombo   = General_Functions::Validar_Entrada('idproductocombo','NUM');

      }else{
        $IdProducto      = $producto;
        $Cantidad        = $cantidad;
        $IdProductoCombo = 0;
      }
      $i                 = 0;
      $NombreArray       = 'TRON'.$IdProducto;              // CAPTURA CANTIDAD DE PRODUCTO TRON COMPRADO


      if ( $IdProductoCombo == 0 ){

        foreach ($this->Datos_Carro as $key => $productos) {
          if ($productos['idproducto'] == $IdProducto)  {
            $cantidad_producto = $this->Datos_Carro[$key]['cantidad'];
            $cantidad_producto = $cantidad_producto - $Cantidad;

            Session::Set($NombreArray,$cantidad_producto);

            if ($cantidad_producto <= 0) {
              array_splice($this->Datos_Carro, $i, 1);
              Session::Set($NombreArray,0);
            }else   {
             $this->Datos_Carro[$key]['cantidad'] = $cantidad_producto;
           }
         }
         $i++;
       } // end foreach
     }
     $i=0;
     if ( $IdProductoCombo > 0 ){
       foreach ($this->Datos_Carro as $key => $productos) {
        if ($productos['idproductocombo'] == $IdProductoCombo)  {
          unset( $this->Datos_Carro[$i] );
        }
        $i++;

       } // end foreach
     }

     Session::Destroy('CarritoTron');
     $this->Cerrar_Procesos_Carro();

     $this->Totalizar_Carrito();
      if ( $producto == 0 ){      /// SI HE ENVIADO UN PRODUCTO COMO PARÁMETRO
        $this->Retornar_Totales_Carro_Json();
      }
    }


    private function Depurar_Carrito()   {
      /** ENERO 15 DE 2015
      *   REALIZA DEPURACIÓN EN LOS DATOS DEL CARRITO. BORRA ELEMENTO CON CANTIDAD =0
      */
      $this->Iniciar_Procesos_Carro();
      $i=0;
      if ($this->Carrito_Habilitado==false) {
        return ;
      }

      foreach ($this->Datos_Carro as $Productos) {
       if ($Productos['cantidad'] == 0 )  {
        array_splice($this->Datos_Carro, $i, 1);
      }
      $i++;
    }
    $this->Cerrar_Procesos_Carro();
  }


  public function Verificacion_Condiciones_Establecidas_Compras() {
        /** JUIO 22 DE 2016
         *    REALIZA VERIFICACIONE Y ESTABLECIMIENTO DE VARIABLES PARA CONTROL DE COMPRAS
         */
        //DATOS RELACIONADOS CON EL VALOR MÍNIMO DEL PEDIDO Y CONDICION PARA REALIZAR EL PAGO.
        if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE){
          Session::Set('valor_real_pedido', $this->Vr_Total_Pedido_Amigos );
        }else{
         Session::Set('valor_real_pedido', $this->Vr_Total_Pedido_Ocasional );
       }


        // VERIFICACIÓN DE SI CUMPLE CON EL VALOR MÍNIMO DE PEDIDO PARA PAGO EN PAYU LATAM
       if ( Session::Get('pago_minimo_payulatam') > Session::Get('valor_real_pedido' ) && Session::Get('valor_real_pedido' ) > 0 ){
        Session::Set('cumple_valor_minimo_pedido', FALSE);
      }else{
       Session::Set('cumple_valor_minimo_pedido', TRUE);
     }


        // VERIFICACIÓN DE SI CUMPLE O NO CON LAS COMPRAS MÍNIMAS DE PRODUCTOS TRON
        //Session::Get('minimo_compras_productos_tron')
     Session::Set('Cumple_Minimo_Compras_Productos_Tron', TRUE);
     if ( $this->Tengo_Productos_Tron == TRUE ){
      if ( ( $this->compras_tron + $this->compras_industrial ) <  Session::Get('minimo_compras_productos_tron')  ){
        Session::Set('Cumple_Minimo_Compras_Productos_Tron', FALSE);
      }else{
        Session::Set('Cumple_Minimo_Compras_Productos_Tron', TRUE);
      }
    }


  }


  public function Mostrar_Carrito() {
      /** ENERO 22 DE 2015
      *   MUSTRA EL CARRITO,LUEGO DE AGREGARLE PRODUCTOS
      */
      //VERIFICA SI DENTRO E CARRO EXITEN COMBOS O KIT DE INICIO LOS CUALES NO PUEDES SER COMPRADOS POR EMPRESARIOS O CLIENTES TRON

      //----------------------------------------------------------------------------------------------------------------------------
      $Tipo_Vista = $this->View->Argumentos[0]; // 1 = VISTA CARRO PIRNCIPAL   2= VISTA DE CARRO PARCIAL, AJAX

      $this->Iniciar_Procesos_Carro();



      $this->View->SetJs(array('tron_carrito','tron_productos.jquery','tron_pasos_pagar'));
      $this->View->SetCss(array('tron_carrito' , 'tron_carrito_pgn','tron_carrito_vacio','tron_carrito_linea_tiempo', 'tron_carrito_confi_envio'));

      if ($this->Cantidad_Filas_Carrito == 0)  {
        if ($Tipo_Vista==1){
          $this->View->Mostrar_Vista('carrito_vacio');
        }
        if ( $Tipo_Vista ==2 ) {
          $this->View->Mostrar_Vista_Parcial('carrito_vacio');
        }
      }



      if ($this->Cantidad_Filas_Carrito > 0)  {
        $iddireccion_despacho  = Session::Get('iddireccion_despacho') ;

        $this->Totalizar_Carrito();


        Session::Set('iddireccion_despacho',$iddireccion_despacho );
        $this->View->Datos_Carro                           = $_SESSION['carrito'];
        $this->View->Puntos_Utilizados                     = Session::Get('Puntos_Utilizados');
        $this->View->Comisiones_Utilizadas                 = Session::Get('Comisiones_Utilizadas');
        $this->View->cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');


        //REALIZA VERIFICACIONE Y ESTABLECIMIENTO DE VARIABLES PARA CONTROL DE COMPRAS
        $this->Verificacion_Condiciones_Establecidas_Compras();



        $this->View->SubTotal_Pedido_Ocasional  = $this->SubTotal_Pedido_Ocasional;
        $this->View->SubTotal_Pedido_Amigos     = $this->SubTotal_Pedido_Amigos;
        $this->View->Vr_Total_Pedido_Real       = $this->Vr_Total_Pedido_Real;
        $this->View->Vr_Cupon_Descuento         = $this->Vr_Cupon_Descuento;


        $this->View->Vr_Total_Pedido_Ocasional  = $this->Vr_Total_Pedido_Ocasional;
        $this->View->Vr_Total_Pedido_Tron       = $this->Vr_Total_Pedido_Amigos;

        $this->View->Vr_Transporte_Real      =   $this->Vr_Transporte_Real   ;
        $this->View->Vr_Transporte_Ocasional =   $this->Vr_Transporte_Ocasional  ;
        $this->View->Vr_Transporte_Tron      =   $this->Vr_Transporte_Tron  ;

        if ($Tipo_Vista==1)  {  //SE CARGA LA VISTA PRINCIPAL DE CARRO DE COMPRAS
          $this->View->Mostrar_Vista('mostrar_carrito');

        }
        if ($Tipo_Vista==2) {// SE CARGA LA VISTA ACTUALIZADA ( PARCIAL ) DE CARRO DE COMPRAS ( AJAX)
          Session::Set('imagen_resumen_pedido',FALSE);
          $this->View->Mostrar_Vista_Parcial('mostrar_carrito_actualizado');
        }
      }

    }


    public function Verificar_Valor_Minimo_A_Pagar(){

      if ( Session::Get('cumple_valor_minimo_pedido') == TRUE ){
        $Respuesta ='CUMPLE';
      }else{
        $Respuesta ='NO-CUMPLE';
      }
      echo trim($Respuesta);
    }

    public function Verificar_Compra_Minima_Productos_Tron(){
      if ( Session::Get('Cumple_Minimo_Compras_Productos_Tron') == TRUE ){
        $Respuesta ='CUMPLE-COMPRAS-TRON';
      }else{
        $Respuesta ='NO-CUMPLE-COMPRAS-TRON';
      }

      echo trim($Respuesta);
    }


    public function Verificar_Valor_Minimo_A_Pagar_Procesar_Eleccion_Usuario( $Segir_Comprando, $No_Usar_Comis_Puntos ){
      if ( $Segir_Comprando == TRUE ){
        Session::Set('Aplicacion_Puntos_Comisiones', TRUE);
      }
      if ( $No_Usar_Comis_Puntos  == TRUE ){
       Session::Set('Aplicacion_Puntos_Comisiones', FALSE);
     }
   }



   public function Borrar_Productos_Carro_Plan_2_3(){
    /** JULIO 07 DE 2015
     *    VERIFICA SI DENTRO E CARRO EXITEN COMBOS O KIT DE INICIO LOS CUALES NO PUEDES SER COMPRADOS POR EMPRESARIOS O CLIENTES TRON
     */
    Session::Set('kit_combos_eliminados', FALSE);

    if ( $_SESSION['logueado'] == FALSE || Session::Get('idtipo_plan_compras') ==1 ||  Session::Get('usuario_viene_del_registro') == TRUE  ){
      return;
    }
    if ( $_SESSION['logueado'] == TRUE && Session::Get('kit_comprado') == FALSE){
      return;
    }

    $this->Iniciar_Procesos_Carro();
    $Productos_a_Borrar = array();
    $Id = 0;
    for ($pos=0; $pos < $this->Cantidad_Filas_Carrito; $pos++) {
      $id_categoria_producto = $this->Datos_Carro [$pos]['id_categoria_producto'];
      $idproducto            = $this->Datos_Carro [$pos]['idproducto'];
      $Cantidad              = $this->Datos_Carro [$pos]['cantidad'];
      if ( $id_categoria_producto == 8 || $idproducto  == 10744){
        $Productos_a_Borrar[$Id]['idproducto'] = $idproducto ;
        $Productos_a_Borrar[$Id]['cantidad'] =$Cantidad   ;
        Session::Set('kit_combos_eliminados', TRUE);
        $Id++;
      }
    }// Fin for
    $this->Cerrar_Procesos_Carro();
    if ( Session::Get('kit_combos_eliminados') == TRUE ){
      for ($pos=0; $pos < $Id; $pos++) {
        $this->Borrar_Producto_Carrito($Productos_a_Borrar[$pos]['idproducto']  , $Productos_a_Borrar[$pos]['cantidad']);
            }// fin for
          }
        }


        private function Totalizar_Carrito_Inicializar_Propiedades(){
   // PROPIEDADES RELACIONADAS CON PRODUCTOS TRON
         $this->Cantidad_Ropa                   =  0 ;
         $this->Peso_Ropa                       =  0 ;
         $this->Cmv_Ropa                        =  0 ;
         $this->Precio_Lista_Ropa               =  0 ;

         $this->Cantidad_Banios                 =  0 ;
         $this->Peso_Banios                     =  0 ;
         $this->Cmv_Banios                      =  0 ;
         $this->Precio_Lista_Banios             =  0 ;

         $this->Cantidad_Pisos                  =  0 ;
         $this->Peso_Pisos                      =  0 ;
         $this->Cmv_Pisos                       =  0 ;
         $this->Precio_Lista_Pisos              =  0 ;

         $this->Cantidad_Loza                   =  0 ;
         $this->Peso_Loza                       =  0 ;
         $this->Cmv_Loza                        =  0 ;
         $this->Precio_Lista_Loza               =  0 ;
         $this->Tengo_Productos_Tron            =  FALSE;
         $this->Cantidad_Productos_Tron         =  0;

   $this->SubTotal_Pedido_Amigos          =  0 ;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
   $this->SubTotal_Pedido_Ocasional       =  0 ;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS

   $this->Tron_Peso_Total_Gramos          =  0 ;
   $this->Tron_Cmv_Total                  =  0 ;
   $this->Tron_Precio_Lista_Total         =  0 ;
   $this->SubTotal_Pedido_Real            =  0 ;

   $this->compras_tron                    =  0 ;
   $this->compras_industrial              =  0 ;
   $this->compras_otros_productos         =  0 ;
   $this->compras_accesorios              =  0 ;



   $this->Valor_Declarado_Productos_Tron            =  0 ;
   $this->Valor_Declarado_Total                     =  0 ;

   $this->Vr_Fletes                      = 0;
   $this->Vr_Fletes_Amigo_Tron           = 0;
   $this->Vr_Fletes_Ocasional            = 0;

   $this->Vr_Base_Iva                    = 0;
   $this->Vr_Recaudo                     = 0;
   $this->Vr_Recaudo_tron                    = 0;
   $this->Vr_Recaudo_ocas                    = 0;

   $this->vr_total_ppto_fletes           = 0;
   $this->vr_total_ppto_fletes_tron      = 0;
   $this->vr_total_ppto_fletes_ocas      = 0;

   $this->vr_total_anticipo_recaudo      = 0;
   $this->vr_total_anticipo_recaudo_tron = 0;
   $this->vr_total_anticipo_recaudo_ocas = 0;

   $this->Vr_Declarado_Courrier_Ocas     = 0;
   $this->Vr_Declarado_Courrier_Tron     = 0;
   $this->Vr_Declarado_Courrier_Total    = 0;
   $this->Peso_Pedido_Courrier           = 0;

   $this->Vr_Declarado_Carga_Ocas        = 0;
   $this->Vr_Declarado_Carga_Tron        = 0;
   $this->Vr_Declarado_Carga_Total       = 0;
   $this->Peso_Pedido_Carga              = 0;



   $this->PayuLatam_Recaudo               =  Session::Get('py_porciento_recaudo');
   $this->PayuLatam_Valor_Minimo          =  Session::Get('py_vr_min_recaudo');
   $this->PayuLatam_Valor_Adicional       =  Session::Get('py_vr_adicional');

   $this->Id_Transportador_Carga          = 0;
   $this->Id_Transportador_Courrier       = 0;



   Session::Set('SERVIENTREGA_PREMIER_seguro'        ,0);
   Session::Set('SERVIENTREGA_INDUS_seguro'          ,0);
   Session::Set('REDETRANS_COURRIER_flete_total'     ,0);

   Session::Set('SERVIENTREGA_PREMIER_flete_total'   ,0);

   Session::Set('precio_especial'                    , 0);
   Session::Set('transporte_tron'                    ,0);
   Session::Set('descuento_especial'                 ,0);
   Session::Set('descuento_especial_porcentaje'      , 0);
   Session::Set('vr_unitario_ropa'                   ,0);
   Session::Set('vr_unitario_banios'                 ,0);
   Session::Set('vr_unitario_pisos'                  ,0);
   Session::Set('vr_unitario_loza'                   ,0);
   Session::Set('Sobre_Precio_Prod_Tron'   , 0 );

   Session::Set('id_transportadora'        ,0 );  // TRANSPORTADORA COURRIER
   Session::Set('tipo_despacho'            ,0 );
   Session::Set('vr_flete'                 ,0 );
   Session::Set('valor_declarado'          ,0 );
   Session::Set('Peso_Pedido_Courrier'     , 0);

   Session::Set('id_transportadora_carga'  ,0 );
   Session::Set('tipo_despacho_carga'      ,0 );
   Session::Set('vr_flete_carga'           ,0 );
   Session::Set('valor_declarado_carga'    ,0 );
   Session::Set('Peso_Pedido_Carga'        , 0 );
   Session::Set('vr_payu_latam'            , 0 );



   $this->Vr_Transporte_Real              = 0;
   $this->Vr_Transporte_Ocasional         = 0;
   $this->Vr_Transporte_Tron              = 0;

 }

 public  function Verificar_Aplicacion_Impuestos(){

  Session::Set('vr_rte_ica', 0) ;
  Session::Set('vr_rte_fte', 0) ;
  $iddireccion_despacho     = Session::Get('iddireccion_despacho');
  $idmcipio     = Session::Get('idmcipio');

  if ( Session::Get('logueado') == FALSE)    { return ; }
    if ( !isset( $iddireccion_despacho  ) || $iddireccion_despacho  == 0 ) { return ; }


    $basereteica  = Session::Get('basereteica');
    $vr_rte_ica   = 0 ;
    $vr_rte_fte   = 0 ;
    $vr_base      = $this->Vr_Base_Iva - $this->Vr_Transporte_Real ;

  // SI ES CALI Y APLICA BASE, CALCULO RETE-ICA
    if ( $vr_base >= $basereteica && $idmcipio  = 153){
      $vr_rte_ica = $vr_base * Session::Get('porcentajeica')/1000;
    }
  //SI REGIMEN COMNUN O SIMPLIFICADO Y APLICA BASE, CALCULO RETEFUENTE
    if ( ( Session::Get('regimen') == 1 || Session::Get('regimen') == 2 ) && $vr_base >= Session::Get('baserteftecpras') ){
      $vr_rte_fte = $vr_base* Session::Get('porcrteftecpras')/100 ;
    }

    Session::Set('vr_rte_ica', $vr_rte_ica ) ;
    Session::Set('vr_rte_fte', $vr_rte_fte ) ;

  //Debug::Mostrar( Session::Get('porcentajeica')/1000 );

  }


  public function Totalizar_Carrito (  ){
  /** JULIO 24 DE 2015
   *      REALIA LOS CALCULOS NECESARIOS PARA HALLAR LOS TOTALES EN EL CARRITO
   */
  $this->Depurar_Carrito();
  $this->Iniciar_Procesos_Carro();
  if ($this->Carrito_Habilitado == FALSE)  {
    return ;
  }

     // INICIALIZA VARIABLES
  $this->Totalizar_Carrito_Inicializar_Propiedades();
  $i                                  = 0 ;
  $kit_inicio_peso_total              = 0;
  $kit_cantidad                       = 0;
  $cumple_condicion_cpras_tron_industial = 0;

      $this->Totalizar_Pedido_x_Categoria_Producto();              // TOTALIZAR CARRITO POR CADA TIPO DE PRODUCTO
      $cumple_condicion_cpras_tron_industial = $this->Determinar_Cumple_Condicion_Cpras_Tron_Industial();   // EVALUAR SI CUMPLE CONDICIONES PARA DAR PRECIO ESPECIAL DEL PRODUCTO
      //Debug::Mostrar('CUMPLE ' . $cumple_condicion_cpras_tron_industial );

      foreach ( $this->Datos_Carro as &$Productos ){    //  EL SIGNO & SE USA PARA PASAR LOS VALORES POR REFERENCIA. SON CAMBIADOS EN EL RECORRIDO DEL CICLO

        $cantidad              = $Productos['cantidad'];
        $cmv                   = $Productos['cmv'];
        $id_categoria_producto = $Productos['id_categoria_producto'];
        $ID_Presentacion       = $Productos['idpresentacion'];
        $idproducto            = $Productos['idproducto'];
        $peso_gramos           = $Productos['peso_gramos'];
        $peso_total_producto   = $Productos['peso_gramos'] * $cantidad;
        $porciento_iva         = 1 + $Productos['iva'] / 100;
        $porciento_ppto_fletes = 0;
        $pv_ocasional          = $Productos['pv_ocasional'];
        $pv_tron               = $Productos['pv_tron'] ;

        if ($idproducto == 10744){
          $kit_inicio_peso_total       = $kit_inicio_peso_total + $peso_gramos ;
          $kit_cantidad                = $kit_cantidad          + $cantidad;
        }

        $Productos['sub_total_pv_tron']             = $cantidad     * $pv_tron;
        $Productos['sub_total_pv_ocasional']        = $cantidad     * $pv_ocasional ;
        $Productos['peso_gramos_total']             = $peso_gramos   * $cantidad ;
        $Productos['precio_unitario_produc_pedido'] = $pv_ocasional ;
        $_sub_total_pv_tron                         = $Productos['sub_total_pv_tron'] ;

        if ( $cumple_condicion_cpras_tron_industial == TRUE ){
          $Productos['precio_unitario_produc_pedido'] = $pv_tron;
        }

        $precio_unitario_producto                      = $Productos['precio_unitario_produc_pedido'];

        $Productos['precio_total_produc_pedido']       = $precio_unitario_producto  * $cantidad;
        $Productos['precio_venta_antes_iva']           = $precio_unitario_producto / $porciento_iva ;
        $Productos['precio_venta_antes_iva_tron']      = $pv_tron                  / $porciento_iva ;
        $Productos['precio_venta_antes_iva_ocasional'] = $pv_ocasional             / $porciento_iva ;

        $this->Vr_Base_Iva                    = $this->Vr_Base_Iva                    + ( $Productos['precio_total_produc_pedido'] / $porciento_iva );

        $this->SubTotal_Pedido_Ocasional      = $this->SubTotal_Pedido_Ocasional      + $Productos['sub_total_pv_ocasional'] ;
        $this->SubTotal_Pedido_Amigos         = $this->SubTotal_Pedido_Amigos         + $Productos['sub_total_pv_tron'] ;
        $this->SubTotal_Pedido_Real           = $this->SubTotal_Pedido_Real           + ( $precio_unitario_producto * $cantidad );
          //***




          // TOTALIZAR PRODUCTOS TRON POR CATEGORIAS
        $this->Totalizar_Carrito_Productos_Tron_Por_Categoria($id_categoria_producto, $cantidad, $_sub_total_pv_tron , $pv_ocasional, $peso_gramos , $cmv  );
       }// Fin recorrido foreach carrito



       $this->Cerrar_Procesos_Carro();

       Session::Set('kit_inicio_peso_total',     $kit_inicio_peso_total);
       Session::Set('kit_cantidad',              $kit_cantidad);

       $this->Totalizar_Pedido_x_Categoria_Producto();
       $this->Totalizar_Carrito_Valor_Declarado();


       if ( $this->Tengo_Productos_Tron == TRUE) {
         $this->Hallar_Asignar_Precio_Especial_Productos_Tron();
       }else{
        Session::Set('precio_especial',0);
      }

      $this->Fletes->Numero_Unidades_Despacho();
        /// CALCULO DE FLETES
        //----------------------------------------------------
      $this->Fletes_Carga_Fija();
      $this->Fletes_Courrier_Carga_Variable();
      $this->Totalizar_Carrito_Conformar_Resumen_Carrito_Tron();

       //***
      $this->Vr_Transporte_Real      =   $this->Vr_Transporte_Real        ;
      $this->Vr_Transporte_Ocasional =   $this->Vr_Transporte_Ocasional   ;
      $this->Vr_Transporte_Tron      =   $this->Vr_Transporte_Tron        ;


      $this->Vr_Base_Iva               =  $this->Vr_Base_Iva               + $this->Vr_Transporte_Real;
      $this->Vr_Total_Pedido_Ocasional =  $this->SubTotal_Pedido_Ocasional + $this->Vr_Transporte_Ocasional;
      $this->Vr_Total_Pedido_Amigos    =  $this->SubTotal_Pedido_Amigos    + $this->Vr_Transporte_Tron;
      $this->Vr_Total_Pedido_Real      =  $this->SubTotal_Pedido_Real      + $this->Vr_Transporte_Real;

      $this->Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon();
      $this->Asignar_Transportadora_a_Productos();
      $this->Verificar_Aplicacion_Impuestos() ;


    /*
          $vr_rte_ica = Session::Get('vr_rte_ica') ;
          $vr_rte_fte = Session::Get('vr_rte_fte') ;

          if ( $vr_rte_ica >0 || $vr_rte_fte ){
              $this->SubTotal_Pedido_Amigos    = $this->SubTotal_Pedido_Amigos       - ( $vr_rte_ica + $vr_rte_fte ) ;
              $this->Vr_Total_Pedido_Ocasional =  $this->Vr_Total_Pedido_Ocasional - ( $vr_rte_ica + $vr_rte_fte ) ;
          }
    */


          Session::Set('Vr_Total_Pedido_Real',      $this->Vr_Total_Pedido_Real);
          Session::Set('SubTotal_Pedido_Ocasional', $this->SubTotal_Pedido_Ocasional );
          Session::Set('SubTotal_Pedido_Amigos',    $this->SubTotal_Pedido_Amigos );
          Session::Set('presupuesto_flete_otros',   $this->vr_total_ppto_fletes );

          Session::Set('Vr_Recaudo',                $this->Vr_Recaudo);
          Session::Set('Vr_Base_Iva',               $this->Vr_Base_Iva);
          Session::Set('Valor_Declarado_Total',     $this->Valor_Declarado_Total);

} // Fin Tootalizar carrito tem


private function Asignar_Transportadora_a_Productos(){
      /*  MAYO 24 2015
      *       ASIGNA A PRODUCTO EL TRANSPORTADOR QUE FINALMENTE LLEVARÁ EL PRODUCTO
      */
      $this->Iniciar_Procesos_Carro();
      $IdTerceroTransporte_Carga    = $this->Id_Transportador_Carga ;
      $IdTerceroTransporte_Courrier = $this->Id_Transportador_Courrier ;

      foreach ($this->Datos_Carro as &$Productos){
        $tipo_despacho_final = $Productos['tipo_despacho_final'];

        if ( $IdTerceroTransporte_Carga > 0 && $IdTerceroTransporte_Courrier > 0 ){
          if ( $tipo_despacho_final == 'CARGA' )    {  $Productos['id_transportadora']    = $IdTerceroTransporte_Carga     ; }
          if ( $tipo_despacho_final == 'COURRIER' ) {  $Productos['id_transportadora']    = $IdTerceroTransporte_Courrier  ; }
        }

        if ( $IdTerceroTransporte_Carga > 0 && $IdTerceroTransporte_Courrier == 0 ){
          $Productos['id_transportadora']    = $IdTerceroTransporte_Carga  ;
        }

        if ( $IdTerceroTransporte_Courrier > 0 && $IdTerceroTransporte_Carga == 0 ){
          $Productos['id_transportadora']    = $IdTerceroTransporte_Courrier  ;
        }
      }
      $this->Cerrar_Procesos_Carro();

    }



    private function Fletes_Carga_Fija(){
      $_Carga_Fija_Unidades       =  Session::Get('Carga_Fija_Unidades');
      $_Carga_Fija_Vr_Declarado   =  Session::Get('Carga_Fija_Vr_Declarado')  ;
      $_Carga_Fija_Peso_Pedido    =  Session::Get('Carga_Fija_Peso_Pedido') ;

      $Subsidio_Flete_Ocasional   =   Session::Get('Carga_Fija_Subsidio_Flete_Ocasional')  ;
      $Anticipo_Recaudo_Ocasional =   Session::Get('Carga_Fija_Recaudo_Ocasional') ;
      $Recaudo_Pedido_Ocasional   =  Session::Get('Recaudo_Pedido_Tron') ;

      $Subsidio_Flete_Tron        =  Session::Get('Carga_Fija_Subsidio_Flete_Tron') ;
      $Anticipo_Recaudo_Tron      =   Session::Get('Carga_Fija_Recaudo_Tron') ;
      $Recaudo_Pedido_Tron        =  Session::Get('Recaudo_Pedido_Tron') ;




      $this->Fletes->Calcular_Valor_Fletes_Inicializacion_Variables();
      if ( $_Carga_Fija_Unidades  > 0 && $_Carga_Fija_Vr_Declarado  > 0 && $_Carga_Fija_Peso_Pedido > 0 ){
        $this->Fletes->Redetrans_Carga         ( $_Carga_Fija_Unidades    , $_Carga_Fija_Vr_Declarado , $_Carga_Fija_Peso_Pedido );
         // $this->Fletes->Servientrega_Industrial ( $_Carga_Fija_Unidades    , $_Carga_Fija_Vr_Declarado , $_Carga_Fija_Peso_Pedido );
         // $this->Fletes->Sevientrega_Premier     ( $_Carga_Fija_Peso_Pedido , $_Carga_Fija_Vr_Declarado );
      }

     //Debug::Mostrar( Session::Get('Fletes_Cobrados_Transportadoras') );



      $this->Fletes->Encontrar_Mejor_Flete();
      $Valor_Flete_Ocasional         = Session::Get('flete_real_calculado');
      $this->Id_Transportador_Carga  = Session::Get('id_transportadora');



      $Valor_Flete_Ocasional  =  $Valor_Flete_Ocasional    ;
      if (  Session::Get('cumple_compras_tron') ==  FALSE ) {
        $Valor_Flete_Ocasional        = $Valor_Flete_Ocasional  ;
      }

      if ( $Valor_Flete_Ocasional > 0 ){
       $this->Vr_Transporte_Ocasional = $Valor_Flete_Ocasional  ;
       $Valor_Flete_Tron              = $Valor_Flete_Ocasional ;
       $this->Vr_Transporte_Tron      = $Valor_Flete_Tron   ;
     }

     $iddireccion_despacho = Session::Get('iddireccion_despacho');
     if ( $iddireccion_despacho == 0 ){
      $this->Vr_Transporte_Ocasional = 0;
      $this->Vr_Transporte_Tron      = 0;
    }


    Session::Set('tipo_despacho_carga',         Session::Get('tipo_despacho_pedido' ) );
    Session::Set('id_transportadora_carga',     Session::Get('id_transportadora')   );
    Session::Set('vr_flete_carga',              $Valor_Flete_Ocasional      );
    Session::Set('valor_declarado_carga',       $_Carga_Fija_Vr_Declarado) ;
    Session::Set('Peso_Pedido_Carga',           $_Carga_Fija_Peso_Pedido );

  }





  private function Fletes_Courrier_Carga_Variable(){

    $Mejor_Flete_Elejido_1 = 0;
    $Tipo_Despacho_1       = 0;
    $Mejor_Flete_Elejido_2 = 0;
    $Tipo_Despacho_2       = 0;
    $IdTransportador_1     = 0;
    $IdTransportador_2     = 0;

    $_Otros_Productos_Peso_Gramos            =   Session::Get('Otros_Productos_Peso_Gramos');
    $_Courrier_Unidades                      =   Session::Get('Courrier_Unidades');
    $Subsidio_Flete_Ocasional                = Session::Get('Otros_Productos_SubFlete_Ocas');
    $Recaudo_Pedido_Ocasional                = Session::Get('Otros_Productos_Antic_Rcdo_Ocas');
    $Anticipo_Recaudo_Ocasional              = Session::Get('Otros_Productos_Antic_Rcdo_Ocas');

    $Subsidio_Flete_Tron                     = Session::Get('Otros_Productos_SubFlete_Tron');
    $Recaudo_Pedido_Tron                     = Session::Get('Otros_Productos_Antic_Rcdo_Tron');
    $Anticipo_Recaudo_Tron                   = Session::Get('Otros_Productos_Antic_Rcdo_Tron');


    if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE ) {
      $Valor_Declarado = Session::Get('Otros_Productos_Vr_Declarado');

    }else{
     $Valor_Declarado = Session::Get('Otros_Productos_Vr_Declarado_Ocasional');
   }
   $Valor_Declarado =   $Valor_Declarado ;

        Session::Set('FLETE_VARIABLE_1_OCASIONAL', 0 );  // CORRESPONDE A LOS FLETES COURRIER Y PREMIER                  ( OTROS PRODUCTOS )
        Session::Set('FLETE_VARIABLE_1_AMIGO',     0 );  // CORRESPONDE A LOS FLETES COURRIER Y PREMIER                  ( OTROS PRODUCTOS )


        if ( Session::Get('Unidades_Adicionales') == TRUE){
            //--------------------------------------------------------------------------------------------------------------------
          $this->Fletes->Calcular_Valor_Fletes_Inicializacion_Variables();

          $this->Fletes->Redetrans_Courrier     ( $_Otros_Productos_Peso_Gramos , $Valor_Declarado );
            //$this->Fletes->Sevientrega_Premier    ( $_Otros_Productos_Peso_Gramos , $Valor_Declarado );
            //Debug::Mostrar( Session::Get('Fletes_Cobrados_Transportadoras') );
          $this->Fletes->Encontrar_Mejor_Flete();

          $Mejor_Flete_Elejido_1 = Session::Get('flete_real_calculado')  ;
          $Tipo_Despacho_1       = Session::Get('tipo_despacho_pedido') ;
          $IdTransportador_1     = Session::Get('id_transportadora');

      //Debug::Mostrar( $Mejor_Flete_Elejido_1 );
            //--------------------------------------------------------------------------------------------------------------------
          $this->Fletes->Calcular_Valor_Fletes_Inicializacion_Variables();
          $this->Fletes->Redetrans_Carga         ( $_Courrier_Unidades     , $Valor_Declarado , $_Otros_Productos_Peso_Gramos );
            //$this->Fletes->Servientrega_Industrial ( $_Courrier_Unidades     , $Valor_Declarado , $_Otros_Productos_Peso_Gramos );
          $this->Fletes->Encontrar_Mejor_Flete();
          $Mejor_Flete_Elejido_2 = Session::Get('flete_real_calculado')  ;
          $Tipo_Despacho_2       = Session::Get('tipo_despacho_pedido') ;
          $IdTransportador_2     = Session::Get('id_transportadora');

            //--------------------------------------------------------------------------------------------------------------------
        }


        //
        $Flete_Ocasional                 = $Mejor_Flete_Elejido_1 ;
        $Tipo_Despacho_Final             = $Tipo_Despacho_1  ;
        $this->Id_Transportador_Courrier = $IdTransportador_1  ;
        if ( $Mejor_Flete_Elejido_2 < $Mejor_Flete_Elejido_1 && $Mejor_Flete_Elejido_2 > 0 ){
          $Flete_Ocasional                 = $Mejor_Flete_Elejido_2;
          $Tipo_Despacho_Final             = $Tipo_Despacho_2  ;
          $this->Id_Transportador_Courrier = $IdTransportador_2  ;
        }

        $Flete_Ocasional = $Flete_Ocasional ;
        $Flete_Amigo     = $Flete_Ocasional ;



        if ( $Flete_Ocasional > 0 ) {
          $Flete_Ocasional               = $Flete_Ocasional  ;
          $this->Vr_Transporte_Ocasional = $this->Vr_Transporte_Ocasional                + $Flete_Ocasional;
          //--------------------------------------------------------------------------------------------------------
          $this->Vr_Transporte_Tron      = $this->Vr_Transporte_Tron  + $Flete_Amigo ;
        }


        // CALCULO DEL RECAUDO
        $this->Calcular_Valor_Recaudo();

        $Vrs_Adicionales_Fletes        = Session::Get('Recaudo_Flete') + Session::Get('Recaudo_Fijo') + Session::Get('Recaudo_Fijo_Adicional');
        $Vrs_Adicionales_Fletes        = $Vrs_Adicionales_Fletes +  Session::Get('Recaudo_Diferen_Rcdo_Real') + Session::Get('Sobre_Precio_Prod_Tron');
        $Vrs_Payu_Latam                = $Vrs_Adicionales_Fletes - Session::Get('Sobre_Precio_Prod_Tron') ;
        $Vrs_Payu_Latam                = $Vrs_Payu_Latam  ;



        if ( Session::Get('cobrar_fletes') == FALSE ){
          $this->Vr_Transporte_Ocasional  = 0;
          $this->Vr_Transporte_Tron       = 0;
          $Vrs_Payu_Latam = 0;
          $Vrs_Adicionales_Fletes  = 0 ;
        }
        $this->Vr_Transporte_Ocasional = $this->Vr_Transporte_Ocasional  +  $Vrs_Adicionales_Fletes ;
        $this->Vr_Transporte_Tron      = $this->Vr_Transporte_Tron       +  $Vrs_Adicionales_Fletes ;



        if ( $_SESSION['logueado'] == FALSE ){
          if ( $this->Vr_Transporte_Ocasional  > $this->Vr_Transporte_Tron )     {
            $this->Vr_Transporte_Tron      = $this->Vr_Transporte_Ocasional ;
            $this->Vr_Transporte_Real      = $this->Vr_Transporte_Tron ;
          }
          if ( $this->Vr_Transporte_Tron       > $this->Vr_Transporte_Ocasional ) {
           $this->Vr_Transporte_Ocasional = $this->Vr_Transporte_Tron ;
           $this->Vr_Transporte_Real      = $this->Vr_Transporte_Ocasional;
         }
       }

       $iddireccion_despacho = Session::Get('iddireccion_despacho');
       if ( $iddireccion_despacho == 0 ){
        $this->Vr_Transporte_Ocasional = 0;
        $this->Vr_Transporte_Tron      = 0;
      }


      if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE  ){
       $this->Vr_Transporte_Real      = $this->Vr_Transporte_Tron ;
     }else{
      $this->Vr_Transporte_Real      = $this->Vr_Transporte_Ocasional ;
    }
    Session::Set('Vr_Transporte',  $this->Vr_Transporte_Real  );

    Session::Set('tipo_despacho'            , $Tipo_Despacho_Final);
    Session::Set('vr_flete'                 ,  $this->Vr_Transporte_Real -  $Vrs_Adicionales_Fletes );
    Session::Set('valor_declarado'          , $Valor_Declarado );
    Session::Set('Peso_Pedido_Courrier'     , $_Otros_Productos_Peso_Gramos );
    Session::Set('vr_payu_latam'            , $Vrs_Payu_Latam );



  }




  private function Calcular_Valor_Recaudo (){
   Session::Set('Recaudo_Flete'               , 0 ) ;
   Session::Set('Recaudo_Fijo'                , 0 ) ;
   Session::Set('Recaudo_Fijo_Adicional'      , 0) ;
         Session::Set('Recaudo_Diferen_Rcdo_Real'   , 0) ; /// Diferencia sobre el recaudo real


         $Flete_Real                   = $this->Vr_Transporte_Ocasional ;
         $Compras_Tron_Otros_Productos = Session::Get('precio_especial') + $this->compras_otros_productos;

         $Recaudo_Flete          = 0 ;
         $Recaudo_Fijo           = 0 ;
         $Recaudo_Fijo_Adicional = 0 ;

         $Recaudo_Flete          = ( $Flete_Real *  $this->PayuLatam_Recaudo) / ( 1 -  $this->PayuLatam_Recaudo) ;
         $Recaudo_Fijo           = $this->PayuLatam_Valor_Adicional ;
         $Recaudo_Fijo_Adicional = ( $Recaudo_Fijo *  $this->PayuLatam_Recaudo)/ ( 1 -  $this->PayuLatam_Recaudo );

         if ( $Compras_Tron_Otros_Productos > Session::Get('vr_minimo_para_recaudo') || ( $Compras_Tron_Otros_Productos == 0 ) ){
          $Recaudo_Diferen_Rcdo_Real = 0 ;
        }else{
          $Recaudo_Diferen_Rcdo_Real = $this->PayuLatam_Valor_Minimo - ( $Compras_Tron_Otros_Productos * $this->PayuLatam_Recaudo ) ;
        }

        Session::Set('Recaudo_Flete'               ,  $Recaudo_Flete                 ) ;
        Session::Set('Recaudo_Fijo'                ,  $Recaudo_Fijo                  ) ;
        Session::Set('Recaudo_Fijo_Adicional'      ,  $Recaudo_Fijo_Adicional        ) ;
        Session::Set('Recaudo_Diferen_Rcdo_Real'   ,  $Recaudo_Diferen_Rcdo_Real    ) ;


      }




      private function Totalizar_Carrito_Conformar_Resumen_Carrito_Tron(){
        $this->Iniciar_Procesos_Carro();
        if ($this->Carrito_Habilitado == FALSE)  {
          return ;
        }
        $pv_tron_resumen  = 0;
        $pv_ocas_resumen = 0;
        $CarritoTron     = array();
        $i_tron          = 0;

        $pv_tron_acc = 0;
        $pv_ocas_acc = 0;


        foreach ($this->Datos_Carro as $Productos){
          $id_categoria_producto = $Productos['id_categoria_producto'];
          $aplica_proceso_tron   = $Productos['aplica_proceso_tron'];
          if ( ( $id_categoria_producto >=1 && $id_categoria_producto  <= 4) ||  $aplica_proceso_tron  == TRUE ){
           $CarritoTron[$i_tron]['cantidad']     = $Productos['cantidad'] ;
           $CarritoTron[$i_tron]['pv_tron']      = $Productos['pv_tron'] ;
           $CarritoTron[$i_tron]['pv_ocasional'] = $Productos['pv_ocasional'] ;
           $CarritoTron[$i_tron]['nom_producto'] = $Productos['nom_producto'] ;
           $CarritoTron[$i_tron]['idproducto']   = $Productos['idproducto'] ;
           //

           $pv_tron_resumen     = $pv_tron_resumen + ( $CarritoTron[$i_tron]['pv_tron']      * $CarritoTron[$i_tron]['cantidad'] );
           $pv_ocas_resumen     = $pv_ocas_resumen + ( $CarritoTron[$i_tron]['pv_ocasional'] * $CarritoTron[$i_tron]['cantidad'] );

            // ACCESORIOS
           if ( $id_categoria_producto == 5 ){
             $pv_tron_acc     = $pv_tron_acc + ( $CarritoTron[$i_tron]['pv_tron']      * $CarritoTron[$i_tron]['cantidad'] );
             $pv_ocas_acc     = $pv_ocas_acc + ( $CarritoTron[$i_tron]['pv_ocasional'] * $CarritoTron[$i_tron]['cantidad'] );
           }
           $i_tron ++;
         }


     }// endforach



     $this->Cerrar_Procesos_Carro();


     $pv_tron_resumen = $pv_tron_resumen - $pv_tron_acc ;
     $pv_ocas_resumen = $pv_ocas_resumen - $pv_ocas_acc ;



     Session::Set('CarritoTron',$CarritoTron);
     Session::Set('pv_tron_resumen',$pv_tron_resumen);
     Session::Set('pv_ocas_resumen',$pv_ocas_resumen);


   }



   private function Totalizar_Carrito_Valor_Declarado(){
    $factor_seguro_flete_otros_productos              = Session::Get('factor_seguro_flete_otros_productos');
        $porciento_seguro_flete_productos_industriales    = Session::Get('porciento_seguro_flete_productos_industriales'); // También es un Factor
        $factor_vr_declarado_productos_tron               = Session::Get('factor_vr_declarado_productos_tron');            // También es un Factor
        $valor_minimo_aplicar_vr_declarado_productos_tron = Session::Get('valor_minimo_aplicar_vr_declarado_productos_tron');
        $rt_courrier_seguro                               = Session::Get('rt_courrier_seguro');
        $this->Valor_Declarado_Productos_Tron             = 0;

        $this->Iniciar_Procesos_Carro();
        if ($this->Carrito_Habilitado == FALSE)  {
          return ;
        }

        foreach ($this->Datos_Carro as &$Productos){
          $cantidad                                    =  $Productos['cantidad'] ;
          $id_categoria_producto                       =  $Productos['id_categoria_producto'];
          $aplica_proceso_tron                         =  $Productos['aplica_proceso_tron'];
          $idproducto                                  =  $Productos['idproducto'];
          $porciento_iva                               =  1+ $Productos['iva']/100;
          $precio_venta_antes_iva                      =  $Productos['precio_venta_antes_iva'] ;
          $precio_venta_antes_iva_ocasional            =  $Productos['precio_venta_antes_iva_ocasional'] ;
          $precio_venta_antes_iva_tron                 =  $Productos['precio_venta_antes_iva_tron']  ;
          $Productos['valor_declarado']                =  0;
          $Productos['valor_declarado_ocasional']      =  0 ;
          $Productos['valor_declarado_tron']           =  0 ;



          if ( $idproducto != 2071 && $idproducto != 14999 ){                // IF (1) // VALOR DECLARADO EXCEPTO KIT DE INICIO, DERECHOS DE INSCRIP. Y PASES DE CORTESÍA
            $_precio_unitario_produc_pedido    = $precio_venta_antes_iva            *  $cantidad  ; // PRECIO REAL QUE SE DAR{A AL CLIENTE
              $_precio_venta_antes_iva_tron      = $precio_venta_antes_iva_tron       *  $cantidad  ;
              $_precio_venta_antes_iva_ocasional = $precio_venta_antes_iva_ocasional  *  $cantidad  ;

              if ( $id_categoria_producto == 5 || $id_categoria_producto  == 7 || $id_categoria_producto  == 8 ){
                $Productos['valor_declarado']           = $_precio_unitario_produc_pedido     *  $factor_seguro_flete_otros_productos ;
                $Productos['valor_declarado_ocasional'] = $_precio_venta_antes_iva_ocasional  *  $factor_seguro_flete_otros_productos ;
                $Productos['valor_declarado_tron']      = $_precio_venta_antes_iva_tron       *  $factor_seguro_flete_otros_productos ;
              }
              if ( $id_categoria_producto == 6  ){
                $Productos['valor_declarado']           = $_precio_unitario_produc_pedido    *  $porciento_seguro_flete_productos_industriales ;
                $Productos['valor_declarado_ocasional'] = $_precio_venta_antes_iva_ocasional *  $porciento_seguro_flete_productos_industriales;
                $Productos['valor_declarado_tron']      = $_precio_venta_antes_iva_tron        *  $porciento_seguro_flete_productos_industriales ;
              }
//IF (2)       VALOR DECLARADO PRODUCTOS TRON
              if  (  $id_categoria_producto <= 4  && $this->Cantidad_Productos_Tron > 0 ) {

               if ( $this->compras_tron_sin_iva  >= $valor_minimo_aplicar_vr_declarado_productos_tron  ){
                $_valor_declarado_item = $this->compras_tron_sin_iva  * $factor_vr_declarado_productos_tron / $this->Cantidad_Registros_Prod_Tron ;

              }else{
               $_valor_declarado_item  = $rt_courrier_seguro /  $this->Cantidad_Registros_Prod_Tron ;
             }

             $Productos['valor_declarado']        =   $_valor_declarado_item  ;
             $Productos['valor_declarado_tron']  =   $_valor_declarado_item  ;
             $this->Valor_Declarado_Productos_Tron = $this->Valor_Declarado_Productos_Tron + $_valor_declarado_item ;
             }// FIN (2)
          } // FIN (1)

        } // fin foreach


        $this->Cerrar_Procesos_Carro();
    } // fin functio Totalizar_Carrito_Hallar_Valor_Declarado





    private function Hallar_Asignar_Precio_Especial_Productos_Tron(){

      $Cantidad_Ropa         = $this->Cantidad_Ropa           ;
      $Peso_Ropa             = $this->Peso_Ropa               ;
      $Cmv_Ropa              = $this->Cmv_Ropa                ;
      $Precio_Lista_Ropa     = $this->Precio_Lista_Ropa       ;

      $Cantidad_Banios       = $this->Cantidad_Banios         ;
      $Peso_Banios           = $this->Peso_Banios             ;
      $Cmv_Banios            = $this->Cmv_Banios              ;
      $Precio_Lista_Banios   = $this->Precio_Lista_Banios     ;

      $Cantidad_Pisos        = $this->Cantidad_Pisos          ;
      $Peso_Pisos            = $this->Peso_Pisos              ;
      $Cmv_Pisos             = $this->Cmv_Pisos               ;
      $Precio_Lista_Pisos    = $this->Precio_Lista_Pisos      ;

      $Cantidad_Loza         = $this->Cantidad_Loza           ;
      $Peso_Loza             = $this->Peso_Loza               ;
      $Cmv_Loza              = $this->Cmv_Loza                ;
      $Precio_Lista_Loza     = $this->Precio_Lista_Loza       ;
      $Vr_Declarado_ProdTron = $this->Valor_Declarado_Productos_Tron;

      $datos=compact('Cantidad_Ropa','Peso_Ropa','Cmv_Ropa','Precio_Lista_Ropa',
       'Cantidad_Banios','Peso_Banios','Cmv_Banios','Precio_Lista_Banios',
       'Cantidad_Pisos','Peso_Pisos','Cmv_Pisos','Precio_Lista_Pisos',
       'Cantidad_Loza','Peso_Loza','Cmv_Loza','Precio_Lista_Loza','Vr_Declarado_ProdTron');

      $this->Productos_Tron->Hallar_Precio_Especial( $this->Parametros->Transportadoras(), $datos);



      $this->Depurar_Carrito();
      $this->Iniciar_Procesos_Carro();
      if ($this->Carrito_Habilitado == FALSE)  {
        return ;
      }
      $presupuesto_fletes_kit  = 0;
      $presupuesto_fletes_tron = 0;
      $Seguro_Productos_Tron   = 0;
    // CALCULO DEL SEGURO PARA APLICAR AL SUBSIDIO DE TRANSPORTE DE PRODUCTOS TRON

      if ( $this->Valor_Declarado_Productos_Tron > Session::Get('rt_courrier_seguro')){
        $Seguro_Productos_Tron = $this->Valor_Declarado_Productos_Tron  * Session::Get('rt_courrier_porciento_seguro_minimo');
      }
      else{
        $Seguro_Productos_Tron = Session::Get('rt_courrier_seguro') * Session::Get('rt_courrier_porciento_seguro_minimo');
      }

      if ( $this->Cantidad_Productos_Tron > 0 ){
        $presupuesto_fletes_tron     = (Session::Get('subsisio_flete_valle') + $Seguro_Productos_Tron) / $this->Cantidad_Productos_Tron  ;
      }

      if ( Session::Get('kit_cantidad') > 0 ){
        $presupuesto_fletes_kit      = Session::Get('subsisio_flete_valle')/ Session::Get('kit_cantidad')   ;
      }
      foreach ( $this->Datos_Carro as &$Productos ){
        $id_categoria_producto       = $Productos['id_categoria_producto'];
        $cantidad                    = $Productos['cantidad'];
        $idproducto                  = $Productos['idproducto'];
        switch ($id_categoria_producto ) {
          case 1:
          $Productos['pv_tron']  = Session::Get('vr_unitario_ropa');
          break;
          case 2:
          $Productos['pv_tron']  = Session::Get('vr_unitario_banios');
          break;
          case 3:
          $Productos['pv_tron']  = Session::Get('vr_unitario_pisos');
          break;
          case 4:
          $Productos['pv_tron']  = Session::Get('vr_unitario_loza');
          break;
      } // switch
    } // fin foreach
    $this->Cerrar_Procesos_Carro();



} // fin function Hallar_Asignar_Precio



private function Totalizar_Carrito_Productos_Tron_Por_Categoria($id_categoria_producto ,$cantidad,$sub_total_pv_tron, $pv_ocasional,$peso_gramos,$cmv  ){
    // COMPRAS POR CADA TIPO DE PRODUCTO
  if ( $id_categoria_producto >= 1 &&  $id_categoria_producto <= 4) {

          // CALCULO CANTIDADES Y PESOS DE LOS PRODUCTOS TRON ( 1= ROPA   2 = BAÑOS   3 = PISOS       4 = LOZA)
   if ( $id_categoria_producto == 1) {
    $this->Cantidad_Ropa     = $this->Cantidad_Ropa     + $cantidad ;
    $this->Peso_Ropa         = $this->Peso_Ropa         + ( $peso_gramos  *  $cantidad  );
    $this->Cmv_Ropa          = $this->Cmv_Ropa          + ( $cmv          *  $cantidad );
    $this->Precio_Lista_Ropa = $this->Precio_Lista_Ropa + ( $pv_ocasional *  $cantidad );
  }
  if ( $id_categoria_producto == 2) {
    $this->Cantidad_Banios     = $this->Cantidad_Banios     + $cantidad ;
    $this->Peso_Banios         = $this->Peso_Banios         + ( $peso_gramos  *  $cantidad  );
    $this->Cmv_Banios          = $this->Cmv_Banios          + ( $cmv          * $cantidad );
    $this->Precio_Lista_Banios = $this->Precio_Lista_Banios + ( $pv_ocasional *  $cantidad );
  }
  if ( $id_categoria_producto == 3) {
    $this->Cantidad_Pisos     = $this->Cantidad_Pisos     + $cantidad ;
    $this->Peso_Pisos         = $this->Peso_Pisos         + ( $peso_gramos  *  $cantidad  );
    $this->Cmv_Pisos          = $this->Cmv_Pisos          + ( $cmv          * $cantidad );
    $this->Precio_Lista_Pisos = $this->Precio_Lista_Pisos + ( $pv_ocasional *  $cantidad );
  }
  if ( $id_categoria_producto == 4) {
    $this->Cantidad_Loza     = $this->Cantidad_Loza     + $cantidad ;
    $this->Peso_Loza         = $this->Peso_Loza         + ( $peso_gramos  *  $cantidad  );
    $this->Cmv_Loza          = $this->Cmv_Loza          + ( $cmv          * $cantidad );
    $this->Precio_Lista_Loza = $this->Precio_Lista_Loza + ( $pv_ocasional *  $cantidad );
  }
}
}

private function Determinar_Cumple_Condicion_Cpras_Tron_Industial(){
  /** JULIO 24 DE 2015
   *      DETERMINA SI CUMPLE LAS CONDICIONES PARA APLICAR EL PRECIO ESPECIAL EN LA COMPRA
   */

  $Registro = $this->MdlTerceros->Compra_Productos_Tron_Mes_Actual();

  $Cumple_Condic_Cpras_Tron_Industial = FALSE;
  $compra_minima_productos_tron         = Session::Get('minimo_compras_productos_tron');
  $compra_minima_productos_industriales = Session::Get('minimo_compras_productos_ta');
  $compras_este_mes_tron                = Session::Get('compras_productos_tron');
  $compras_este_mes_industiales         = Session::Get('compras_productos_fabricados_ta');
  $usuario_viene_del_registro           = Session::Get('usuario_viene_del_registro');
  $kit_comprado                         = Session::Get('kit_comprado') ;

  $compras_este_mes_tron                = $Registro[0]['compras_productos_tron'];
  $compras_este_mes_industiales         = $Registro[0]['compras_productos_fabricados_ta'];
  $compras_totales_tron                = 0;

  $compras_totales_tron                 = $this->compras_tron + $compras_este_mes_tron ;
  $compras_totales_industrial           = $this->compras_industrial + $compras_este_mes_industiales ;
  $compras_totales_tron               =  $compras_totales_tron + $compras_totales_industrial;
  $aplica_pago_adicional_payu_latam     = FALSE;
  $cumple_compras_tron                  = FALSE;



  if ( $_SESSION['logueado'] == TRUE ) {
    if ( ($compras_totales_tron       >= $compra_minima_productos_tron)           ||
     ($compras_totales_industrial >= $compra_minima_productos_industriales )  ||
     ($usuario_viene_del_registro == TRUE && $kit_comprado  == FALSE)){

     $Cumple_Condic_Cpras_Tron_Industial   = TRUE;
 }else{
  $Cumple_Condic_Cpras_Tron_Industial   = FALSE;
}
}

if ( $_SESSION['logueado'] == FALSE ) {
  if ( ($compras_totales_tron >= $compra_minima_productos_tron)  || ($compras_totales_industrial >= $compra_minima_productos_industriales ) ) {
   $Cumple_Condic_Cpras_Tron_Industial   = TRUE;
 }else{
  $Cumple_Condic_Cpras_Tron_Industial   = FALSE;
}
}
if ( $this->compras_tron  >= $compra_minima_productos_tron ){
  $aplica_pago_adicional_payu_latam  = TRUE ;
  $cumple_compras_tron               = TRUE ;
}

Session::Set('cumple_condicion_cpras_tron_industial'   , $Cumple_Condic_Cpras_Tron_Industial );
Session::Set('aplica_pago_adicional_payu_latam'        , $aplica_pago_adicional_payu_latam );
Session::Set('cumple_compras_tron'                     , $cumple_compras_tron );


return $Cumple_Condic_Cpras_Tron_Industial;

    } // fin Determinar_cumple_condicion_cpras_tron_industial


    public function Totalizar_Pedido_x_Categoria_Producto() {
      /** MARZO 19 DE 2015
      *       TOTALIZA LOS VALORES DEL PEDIDO POR CATEGORIA DE PRODUCTO. TRON, INDUSTRIALES, ACCESORIOS, OTROS
      */
      $i                                    = 0;

      $this->Cantidad_Productos_Tron        = 0;
      $this->Cantidad_Registros_Prod_Tron   = 0;
      $this->compras_accesorios             = 0 ;
      $this->compras_industrial             = 0 ;
      $this->compras_otros_productos        = 0 ;
      $this->compras_tron                   = 0;
      $this->compras_tron_sin_iva           = 0;
      $this->Tengo_Productos_Tron           = FALSE;

      Session::Set('compra_productos_tron',0);
      Session::Set('compra_productos_industriales',0 );
      Session::Set('compra_otros_productos',0);
      Session::Set('compra_accesorios',0);

      $this->Depurar_Carrito();
      $this->Iniciar_Procesos_Carro();
      for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)  {
        $id_categoria_producto = $this->Datos_Carro[$i]['id_categoria_producto'] ;
        $aplica_proceso_tron    =$this->Datos_Carro[$i]['aplica_proceso_tron'] ;


        if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE ){
          $precio_unitario       = $this->Datos_Carro[$i]['pv_tron'] ;
        }
        else {
          $precio_unitario       = $this->Datos_Carro[$i]['pv_ocasional'] ;
        }


        $cantidad              = $this->Datos_Carro[$i]['cantidad'] ;
        $total_item            = $precio_unitario *  $cantidad ;
        $total_item_tron       = $this->Datos_Carro[$i]['pv_tron'] * $cantidad  ;


        if ($id_categoria_producto  <= 4 || $aplica_proceso_tron == TRUE) {
               $this->compras_tron                 = $this->compras_tron            + $total_item_tron;//$total_item  ;
               $this->compras_tron_sin_iva         = $this->compras_tron_sin_iva    +  ( $total_item_tron )  / ( 1 +  $this->Datos_Carro[$i]['iva']/100 ) ;

               $this->Cantidad_Productos_Tron      = $this->Cantidad_Productos_Tron + $cantidad    ;
               $this->Cantidad_Registros_Prod_Tron = $this->Cantidad_Registros_Prod_Tron + 1; // Cantidad de Registros-  Productos tron
               $this->Tengo_Productos_Tron         = TRUE;

             }
            // Productos industriales
             if ($id_categoria_producto == 6) {
              $this->compras_industrial   = $this->compras_industrial  + $total_item  ;

            }
            if ($id_categoria_producto == 7) {
             $this->compras_otros_productos = $this->compras_otros_productos  +  $total_item  ;

           }
           if ($id_categoria_producto == 5 || $id_categoria_producto == 8 ) {
             $this->compras_accesorios = $this->compras_accesorios  +  $total_item ;
           }
         }

         $compra_minima_productos_tron         = Session::Get('minimo_compras_productos_tron');

         Session::Set('compra_productos_tron'            , $this->compras_tron);
         Session::Set('compra_productos_industriales'    , $this->compras_industrial );
         Session::Set('compra_otros_productos'           , $this->compras_otros_productos);
         Session::Set('compra_accesorios'                , $this->compras_accesorios );
         $this->Cerrar_Procesos_Carro();

       }



       public function Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon()    {
       /** FEBRERO 02 DE 2015
      *     REALIZA APLICACION DE DESCUENTOS POR CONCEPTO DE PUNTOS, COMISIONES Y CUPONES DE DESCUENTO
      */
            // Aplición de descuentos por concepto de puntos y comisiones pendientes por pagar
      // Si el pedido se realiza para un amigo, no se aplican descuentos de comisiones y puntos
       Session::Set('Vr_Usado_Cupon_Descuento',    0);
       Session::Set('Puntos_Utilizados',           0 );
       Session::Set('Comisiones_Utilizadas',       0 );

       $Vr_Usado_Cupon_Descuento  = 0;
       $Puntos_Utilizados         = 0;
       $Comisiones_Utilizadas     = 0;
      //Debug::Mostrar( 'Comisiones_punto ' . $this->Vr_Total_Pedido_Ocasional  );

       $Pedido_Para_Amigo            = Session::Get('Generando_Pedido_Amigo');
       $Aplicacion_Puntos_Comisiones = Session::Get('Aplicacion_Puntos_Comisiones');
       $VrRealPedido = 0;
       $NoDescontar  = 0;

    // (isset($Pedido_Para_Amigo) == TRUE && $Pedido_Para_Amigo = FALSE ) ||

       if ( ( isset($Aplicacion_Puntos_Comisiones ) && $Aplicacion_Puntos_Comisiones == TRUE ) ){
        $Vr_Usado_Cupon_Descuento = 0;
        $Puntos_Utilizados        = 0;
        $Comisiones_Utilizadas    = 0;
        $this->Terceros->Consultar_Saldos_Comisiones_Puntos_x_Idtercero();
          //Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento );
        $this->Saldo_Puntos_Cantidad      = Session::Get('saldo_puntos_cantidad');
        $this->Saldo_Comisiones           = Session::Get('saldo_comisiones');
        $this->Vr_Cupon_Descuento         = Session::Get('vr_cupon_descuento');


        if ( $this->Saldo_Puntos_Cantidad  > 0 ) {
          if ( $this->Vr_Total_Pedido_Real > 0 ){
            if ( $this->Saldo_Puntos_Cantidad >= $this->Vr_Total_Pedido_Real ){
             $Puntos_Utilizados               =  $this->Vr_Total_Pedido_Real;
             $this->Vr_Total_Pedido_Real      = 0;
             $this->Vr_Total_Pedido_Ocasional = 0;
             $this->Vr_Total_Pedido_Amigos    = 0;
           }else{
            //Para que si se descuentan puntos pueda pagar el pedido
            $VrRealPedido = $this->Vr_Total_Pedido_Real      - $this->Saldo_Puntos_Cantidad;
            if (  $VrRealPedido < 20000 ){
              $NoDescontar = 20000 - $VrRealPedido;
              $this->Saldo_Puntos_Cantidad = $this->Saldo_Puntos_Cantidad - $NoDescontar;
            }

            $this->Vr_Total_Pedido_Real      = $this->Vr_Total_Pedido_Real      - $this->Saldo_Puntos_Cantidad;
            $this->Vr_Total_Pedido_Ocasional = $this->Vr_Total_Pedido_Ocasional - $this->Saldo_Puntos_Cantidad;
            $this->Vr_Total_Pedido_Amigos    = $this->Vr_Total_Pedido_Amigos    - $this->Saldo_Puntos_Cantidad;
            $Puntos_Utilizados               =  $this->Saldo_Puntos_Cantidad ;
          }
        }
      }

      if ( $this->Saldo_Comisiones > 0) {
        if ( $this->Vr_Total_Pedido_Real > 0 ){
          if ( $this->Saldo_Comisiones >= $this->Vr_Total_Pedido_Real ){
           $Comisiones_Utilizadas           =  $this->Vr_Total_Pedido_Real;
           $this->Vr_Total_Pedido_Real      = 0;
           $this->Vr_Total_Pedido_Ocasional = 0;
           $this->Vr_Total_Pedido_Amigos    = 0;
         }else{

            //Para que si se descuentan comisiones pueda pagar el pedido
          $VrRealPedido = $this->Vr_Total_Pedido_Real      - $this->Saldo_Comisiones;
          if (  $VrRealPedido < 20000 ){
            $NoDescontar = 20000 - $VrRealPedido;
            $this->Saldo_Comisiones = $this->Saldo_Comisiones - $NoDescontar;
          }


          $this->Vr_Total_Pedido_Real      = $this->Vr_Total_Pedido_Real - $this->Saldo_Comisiones;
          $this->Vr_Total_Pedido_Ocasional = $this->Vr_Total_Pedido_Ocasional - $this->Saldo_Comisiones;
          $this->Vr_Total_Pedido_Amigos    = $this->Vr_Total_Pedido_Amigos    - $this->Saldo_Comisiones;
          $Comisiones_Utilizadas           =  $this->Saldo_Comisiones;
        }
      }
    }
  }

  Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento );
  Session::Set('Puntos_Utilizados',           $Puntos_Utilizados );
  Session::Set('Comisiones_Utilizadas',       $Comisiones_Utilizadas );

}

public function Retornar_Totales_Carro_Json()  {



 /*if ( Session::Get('vr_unitario_ropa')    == 0 ||  Session::Get('vr_unitario_ropa')  > Session::Get('text_pv_tron_ropa') ) {
  Session::Set('vr_unitario_ropa', Session::Get('text_pv_tron_ropa'))     ;
}
if ( Session::Get('vr_unitario_banios')  == 0 || Session::Get('vr_unitario_banios')  > Session::Get('text_pv_tron_banios')) {
  Session::Set('vr_unitario_banios', Session::Get('text_pv_tron_banios')) ;
}
if ( Session::Get('vr_unitario_pisos')   == 0 || Session::Get('vr_unitario_pisos')  > Session::Get('text_pv_tron_pisos')) {
  Session::Set('vr_unitario_pisos', Session::Get('text_pv_tron_pisos'))   ;
}
if ( Session::Get('vr_unitario_loza')    == 0 ||  Session::Get('vr_unitario_loza')  >  Session::Get('text_pv_tron_loza')) {
  Session::Set('vr_unitario_loza', Session::Get('text_pv_tron_loza'))     ;
}
*/

$Descuento_Especial 					 = Session::Get('descuento_especial');
$descuento_especial_porcentaje = Session::Get('descuento_especial_porcentaje');
if ( Session::Get('pv_tron_resumen') == Session::Get('pv_ocas_resumen')){
 $Descuento_Especial  = 0 ;
 $descuento_especial_porcentaje = 0;
}



$SubTotal_Pedido_Amigos        =  "$ ".number_format($this->SubTotal_Pedido_Amigos ,0,"",".");
$SubTotal_Pedido_Ocasional     =  "$ ".number_format($this->SubTotal_Pedido_Ocasional ,0,"",".");
      // DATOS DE PRODUCTOS TRON
$descuento_especial            =  "$ ".number_format($Descuento_Especial ,0,"",".");
      //$descuento_especial_porcentaje =  Session::Get('descuento_especial_porcentaje');
$descuento_especial_porcentaje =  number_format((float)$descuento_especial_porcentaje, 2, '.', '') .'%';

$vr_unitario_ropa              =  "$ ".number_format(Session::Get('vr_unitario_ropa'),0,"",".");
$vr_unitario_banios            =  "$ ".number_format(Session::Get('vr_unitario_banios'),0,"",".");
$vr_unitario_pisos             =  "$ ".number_format(Session::Get('vr_unitario_pisos'),0,"",".");
$vr_unitario_loza              =  "$ ".number_format(Session::Get('vr_unitario_loza'),0,"",".");

$pv_tron_resumen               =  "$ ".number_format(Session::Get('precio_especial'),0,"",".");
$pv_ocas_resumen               =  "$ ".number_format(Session::Get('pv_ocas_resumen'),0,"",".");
$text_pv_tron_ropa             =   Session::Get('text_pv_tron_ropa');
$precio_especial               =  "$ ".number_format(Session::Get('precio_especial'),0,"",".");



$Datos    = compact('SubTotal_Pedido_Amigos','SubTotal_Pedido_Ocasional','descuento_especial','descuento_especial_porcentaje',
  'vr_unitario_ropa','vr_unitario_banios','vr_unitario_pisos','vr_unitario_loza',
  'pv_ocas_resumen','pv_tron_resumen','text_pv_tron_ropa');
echo json_encode($Datos,256);
}


public function Agregar_Producto ()  {
      /** ENERO 06 DE 2014
      *   REALIZA LA ENTRADA DE PRODUCTOS AL CARRO DE COMPRA DE ACUERDO A LAS COMPRAS QUE ESTÁ REALIZANDO EL USUARIO
      */


      $TipoCombo        = General_Functions::Validar_Entrada('tipo_combo','TEXT');
      $IdProducto       = General_Functions::Validar_Entrada('IdProducto','NUM');
      $CantidadComprada = General_Functions::Validar_Entrada('CantidadComprada','NUM');
      $ProdTron         = General_Functions::Validar_Entrada('es_tron','BOL');
      $ProdTronAcc      = General_Functions::Validar_Entrada('es_tron_acc','BOL');
      $ProdEnOferta     = General_Functions::Validar_Entrada('en_oferta','BOL');
      $NombreArray      = 'TRON'.$IdProducto ;
      $IdProductoCombo  = $IdProducto ;


        Session::Set($NombreArray,$CantidadComprada); // CAPTURA EN ARRAY LA CANTIDA DE PRODUCTOS TRON COMPRADOS


        if ( !isset( $_SESSION['carrito'])) {
          $_SESSION['carrito'] = array();
        }
        $Carrito_Actual     = $_SESSION['carrito'];

        if ( $TipoCombo == '') {
          $Ultima_Compra  = array( 'idproducto'      => $IdProducto , 'cantidad' => $CantidadComprada,
           'en_oferta'       => $ProdEnOferta, 'idproductocombo' => 0,
           'tipo_combo'      => '', 'pv_ocasional' =>0, 'pv_tron' => 0   );
          $Existe_Id_Producto = false;
          $Pos                = 0;
          $Cantidad_Filas     = count($Carrito_Actual);
          $i                  = 0;

          for ($i=0; $i < $Cantidad_Filas;  $i++)  {
            $IdProducto_Carro = $Carrito_Actual[$i]['idproducto'];
            if ( $IdProducto_Carro == $IdProducto )      {
              $Carrito_Actual[$i]['cantidad']  = $Carrito_Actual[$i]['cantidad'] + $CantidadComprada;
              $Cantidad_Total                  = $Carrito_Actual[$i]['cantidad'] ;
              $i                               = $Cantidad_Filas+1;
              $Existe_Id_Producto              = true;
                    Session::Set($NombreArray,$Cantidad_Total); // CAPTURA EN ARRAY LA CANTIDA DE PRODUCTOS TRON COMPRADOS
                  }
                }
                if ($Existe_Id_Producto == FALSE)  {
                  array_push($Carrito_Actual, $Ultima_Compra);
                }
              }

              if ( $TipoCombo == 'IND' ){
                $Productos = $this->Productos->ProductosxCombo( $IdProducto  );
                foreach ($Productos as $Producto)  {
                  $idproducto        = $Producto['idproducto'];
                  $cantidad          = $Producto['cantidad'] * $CantidadComprada ;
                  if ( $cantidad  > 0 ){
                    $vrunitario        = $Producto['precio_web'] / $cantidad ;
                  }else{
                    $vrunitario        = $Producto['precio_web'] ;
                  }
                  $vr_total          = $cantidad  * $vrunitario ;
                  $idescala_dt       = 0;
                  $id_transportadora = 0;
                  $en_oferta         = 0;
                  $idgrupo           = $Producto['idgrupo'];

                  $Ultima_Compra  = array( 'idproducto' => $idproducto ,
                   'cantidad'         => $cantidad,
                   'en_oferta'        => 0,
                   'idproductocombo'  => $IdProducto,
                   'tipo_combo'       => 'IND',
                   'pv_ocasional'     => $vrunitario,
                   'pv_tron'          => $vrunitario);
                  array_push($Carrito_Actual, $Ultima_Compra);
                }  // Fin Foreach
              }


              $_SESSION['carrito'] = $Carrito_Actual;


              $this->Depurar_Carrito();
              $this->Complementar_Datos_Productos_Carrito($ProdTron,$ProdTronAcc, $IdProducto,  $ProdEnOferta  );
              $this->Totalizar_Carrito(   );
              $this->Retornar_Totales_Carro_Json();

            }





            public function Complementar_Datos_Productos_Carrito($ProdTron=false, $ProdTronAcc=false, $IdProductoAgregado,  $ProdEnOferta   ) {
      /** ENERO 07 DE 2015
      * COMPLEMENTA LOS DATOS NECESARIOS DE PRODUCTOS EN EL CARRO DE COMPRAS PARA REALIZAR TODAS LAS OPERACIONES CORRESPONDIENTES
      * Y POSTERIORMENTE FINALIZAR EL PEDIDO
      */
      if (!isset($_SESSION['carrito']))  {
        $this->View->Carrito_Vacio = true;
        return ;
      }
      if ( count( $_SESSION['carrito'])==0)
      {
        $this->View->Carrito_Vacio = true;
        return ;
      }
        // margen_bruta_inicial = corresponde al % incial dentro de la clasificación de grupos para caclular
        // el valor declarado de la marcancía que corresponde a precio tron * el porcentaje
      $CarroTemporal     =    array('idproducto'=>0, 'cantidad' =>0,'nom_producto'=>"",'pv_ocasional'=>0,'pv_tron'=>0,'idtipo_producto'=>'',
        'peso_gramos'=>0,'tipo_despacho'=>0, 'costo_sin_iva'=>0,'fabricado_x_ta'=>0,'idescala'=>0, 'idescala_dt'=>0,
        'iva' =>0,'cmv'=>0,'idgrupo'=>0,'id_agrupacion'=>0,'idpresentacion'=>0, 'nompresentacion'=>'','fragancia'=>'',
        'nombre_imagen'=>'',
        'sub_total_pv_ocasional'=>0, 'sub_total_pv_tron'=>0,'posicion_escala'=>0,
        'es_tron'=>false, 'es_tron_acc'=>false,'es_industrial'=>false,
        'costofijo'=>0, 'costovariable'=>0,'correctorvariacion'=>0,'descuentomaximo'=>0,
        'vrpedidominimo_con_dscto'=>0, 'porciento_recaudador'=>0,
        'dscto_precio_mercado_1_ropa'=>0, 'dscto_precio_mercado_2_banos'=>0,
        'dscto_precio_mercado_3_pisos'=>0, 'dscto_precio_mercado_4_loza'=>0,
        'id_categoria_producto'=>0, 'margen_bruta_inicial'=>0 , 'valor_declarado'=>0,
        'valor_declarado_ocasional'=>0,'valor_declarado_tron'=>0,
        'precio_unitario_produc_pedido'=>0, 'precio_total_produc_pedido'=>0, 'sub_total_pedido_Tron'=>0,
        'sub_total_pedido_Otros'=>0, 'codigo_grupo'=>'', 'pv_tron_real'=>0,
        'precio_venta_antes_iva'=>0, 'peso_gramos_total'=>0, 'vr_ppto_fletes'=>0,
        'vr_anticipo_recaudo'=>0,'precio_venta_antes_iva_tron'=>0, 'precio_venta_antes_iva_ocasional'=>0,
        'vr_ppto_fletes_tron'=>0, 'vr_ppto_fletes_ocas'=>0, 'vr_anticipo_recaudo_tron'=>0,
        'vr_anticipo_recaudo_ocas'=>0, 'precio_kit_ocasional'=>0, 'precio_kit_tron'=>0,
        'tipo_despacho_final'=>'', 'id_transportadora'=>0, 'en_oferta'=> 0,
        'aplica_proceso_tron' => 0, 'tipo_combo' =>'', 'idproductocombo'=>0 );

      if (!isset( $Parametros)) {
        $Parametros = $this->Parametros->Consultar();
      }

      $CarroFinalCompleto = array();
      $Datos_Carro        = $_SESSION['carrito'];

        //Debug::Mostrar( $Datos_Carro);
      foreach ( $Datos_Carro as $ProductosCarro ) {
        $Cantidad        = $ProductosCarro['cantidad'] ;
        $IdProducto      = $ProductosCarro['idproducto'];
        $en_oferta       = $ProductosCarro['en_oferta'];
        $Pv_Tron         = $ProductosCarro['pv_tron'];
        $Pv_Ocasional    = $ProductosCarro['pv_ocasional'];
        $IdProductoCombo = $ProductosCarro['idproductocombo'];

        if ( $Cantidad > 0 )   {
          $ProductoComprado                       = $this->Productos->Buscar_por_IdProducto( $IdProducto );

          if ( $IdProductoAgregado === $IdProducto  &&  $ProdEnOferta == 1 ){
            $CarroTemporal['en_oferta'] = 1;
          }else{
            $CarroTemporal['en_oferta'] = $en_oferta;
          }

          $CarroTemporal['idproductocombo']        = $IdProductoCombo;
          $CarroTemporal['idproducto']             = $IdProducto;
          $CarroTemporal['cantidad']               = $Cantidad ;
          $CarroTemporal['cmv']                    = $ProductoComprado[0]['cmv'];
          $CarroTemporal['costo_sin_iva']          = $ProductoComprado[0]['costo_sin_iva'];
          $CarroTemporal['fabricado_x_ta']         = $ProductoComprado[0]['fabricado_x_ta'];
          $CarroTemporal['idgrupo']                = $ProductoComprado[0]['idgrupo'];
          $CarroTemporal['codigo_grupo']           = $ProductoComprado[0]['codigo_grupo'];

        /*
          $CarroTemporal['tipo_combo']
            Marcador para los combos.
              MARZO 22 2018
                IND = COMBOS INDUSTRIALES
                OTR = COMBOS DE OTROS PRODUCTOS
                NOTA:
                  COMBOS INDUSTRIALES, SE DESBOBLAN EN EL MOMENTO DE GRABAR EL PEDIDO, ES DECIR,
                  SE GRABAN LOS PRODUCTOS INDIVIDUALES QUE LO COMPONEN.
          */
                  $CarroTemporal['tipo_combo']             = $ProductoComprado[0]['tipo_combo'];

                  $CarroTemporal['idtipo_producto']        = $ProductoComprado[0]['idtipo_producto'];
                  $CarroTemporal['id_categoria_producto']  = $ProductoComprado[0]['id_categoria_producto'];
                  $CarroTemporal['idpresentacion']         = $ProductoComprado[0]['idpresentacion'];


                  $CarroTemporal['iva']                    = $ProductoComprado[0]['iva'];
                  $CarroTemporal['nom_producto']           = $ProductoComprado[0]['nom_producto'];
                  $CarroTemporal['nombre_imagen']          = $ProductoComprado[0]['nombre_imagen'];
                  $CarroTemporal['nompresentacion']        = $ProductoComprado[0]['nompresentacion'];
                  $CarroTemporal['fragancia']              = $ProductoComprado[0]['fragancia'];

                  $CarroTemporal['peso_gramos']            = $ProductoComprado[0]['peso_gramos'];
                  $CarroTemporal['pv_ocasional']           = $ProductoComprado[0]['pv_ocasional'];
                  if ( $Pv_Ocasional == 0 ){
                    $CarroTemporal['pv_ocasional']           = $ProductoComprado[0]['pv_ocasional'];
                  }else {
                    $CarroTemporal['pv_ocasional']           = $Pv_Ocasional;
                  }
                  if ( $Pv_Tron == 0 ){
                   $CarroTemporal['pv_tron']                = $ProductoComprado[0]['pv_tron'];
                 }else           {
                   $CarroTemporal['pv_tron']                = $Pv_Tron;
                 }


                 $CarroTemporal['tipo_despacho']          = $ProductoComprado[0]['tipo_despacho'];
                 $CarroTemporal['margen_bruta_inicial']   = $ProductoComprado[0]['margen_bruta_inicial'] / 100 ;
                 $CarroTemporal['aplica_proceso_tron']    = $ProductoComprado[0]['aplica_proceso_tron']  ;



                 $CarroTemporal['sub_total_pv_ocasional'] = 0;
                 $CarroTemporal['sub_total_pv_tron']      = 0;


                //------------------------------------------------------------------------------------------------------
                // DATOS PUESTOS PARA PRODUCTOS TRON
                 $CarroTemporal['es_tron']                      = $ProdTron ;
                 $CarroTemporal['es_tron_acc']                  = $ProdTronAcc ;
                 $CarroTemporal['costofijo']                    = $Parametros[0]['costofijo'];
                 $CarroTemporal['costovariable']                = $Parametros[0]['costovariable'];
                 $CarroTemporal['correctorvariacion']           = $Parametros[0]['correctorvariacion'];
                 $CarroTemporal['descuentomaximo']              = $Parametros[0]['descuentomaximo'];
                 $CarroTemporal['vrpedidominimo_con_dscto']     = $Parametros[0]['vrpedidominimo_con_dscto'];
                 $CarroTemporal['porciento_recaudador']         = $Parametros[0]['porciento_recaudador'];
                 $CarroTemporal['dscto_precio_mercado_1_ropa']  = $Parametros[0]['dscto_precio_mercado_1_ropa']/100;
                 $CarroTemporal['dscto_precio_mercado_2_banos'] = $Parametros[0]['dscto_precio_mercado_2_banos']/100;
                 $CarroTemporal['dscto_precio_mercado_3_pisos'] = $Parametros[0]['dscto_precio_mercado_3_pisos']/100;
                 $CarroTemporal['dscto_precio_mercado_4_loza']  = $Parametros[0]['dscto_precio_mercado_4_loza']/100;

                 array_push( $CarroFinalCompleto, $CarroTemporal);

               }
             }
             $_SESSION['carrito'] = $CarroFinalCompleto;


    } // Fin Complementar_Datos_Productos_Carrito

  }



  ?>





