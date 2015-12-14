
<?php

class CarritoController extends Controller{
     private $Carrito_Vacio                   = false;
     private $Cantidad_Filas_Carrito          = 0;
     private $Datos_Carro;
     Private $flfl;

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
     // VARIABLES PARA PRODUCTOS TRON
     private $Tron_Peso_Total_Gramos          = 0;
     private $Tron_Cmv_Total                  = 0;
     private $Tron_Precio_Lista_Total         = 0;
     //VARIABLES PARA OPERACIONES TOTALES EN EL CARRITO
     private $Saldo_Puntos_Cantidad           = 0;
     private $Saldo_Comisiones                = 0;
     private $Vr_Cupon_Descuento              = 0;

     private $Vr_Total_Pedido_Ocasional       = 0;
     private $Vr_Total_Pedido_Tron            = 0;


     private $compras_tron                    = 0;
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
     private $Cant_Tot_Productos_Tron         =  0 ;

     private $Cantidad_Loza                   =  0 ;
     private $Peso_Loza                       =  0 ;
     private $Cmv_Loza                        =  0 ;
     private $Precio_Lista_Loza               =  0 ;
     private $Tengo_Productos_Tron            = FALSE;
     private $Cantidad_Productos_Tron         = 0;


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
           $Registro = $this->Pedidos->Pedido_Consulta_Datos_Cambio_Forma_Pago ( $idpedido );
           Session::Set('numero_pedido',      $Registro[0]['numero_pedido']);
           Session::Set('vr_total_pedido',    $Registro[0]['vr_total_pedido']);
           Session::Set('Vr_Base_Iva',        $Registro[0]['Vr_Base_Iva']);
           Session::Set('nombre_cliente',     $Registro[0]['nombre_cliente']);
           Session::Set('email',              $Registro[0]['email']);
           Session::Set('identificacion',     $Registro[0]['identificacion']);
        }
        if ( $Vr_Total_Pedido_Real > 0 ){
                $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
                $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_carrito_forma_pago','tron_estilos_linea_tiempo'));
                $this->View->Mostrar_Vista('finalizar_pedido_forma_pago');
                Session::Set('imagen_resumen_pedido',FALSE);
            }else{
              echo "Mostrar mensaje de pago pedido cero";
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
      $Texto_Error                            = 'Debes seleccionar uno de los usuarios y la dirección a donde enviarás el pedido para poder continuar...';


      $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($iddireccion_despacho);
      if (!isset($iddireccion_despacho) || ($iddireccion_despacho==0) || ($iddireccion_despacho== NULL))
      {
          $Texto_Resultado =$Texto_Error;
      }
      if (!isset($idtercero_pedido) || ($idtercero_pedido==0) || ($idtercero_pedido== NULL))
      {
          $Texto_Resultado =$Texto_Error;
      }
      echo $Texto_Resultado ;
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

     $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho( $IdDireccion_Despacho );
     Session::Set('codigousuario',  $codigousuario);
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
      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_identificacion','tron_carrito_confi_envio','tron_barra_usuarios','tron_estilos_linea_tiempo'));

      $this->View->Departamentos = $this->Departamentos->Consultar();
      Session::Set('iddireccion_despacho',   0 );
      Session::Set('finalizar_pedido_siguiente_paso','DIRECCION');
      if (Session::Get('autenticado')== FALSE ) {
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
        if (isset($_SESSION['carrito']))
        {
          $this->Datos_Carro                = $_SESSION['carrito'];
          $this->Cantidad_Filas_Carrito     = count($this->Datos_Carro  );
          $this->Carrito_Habilitado         = TRUE;

          if ($this->Cantidad_Filas_Carrito ==0)
          {
            $this->Cantidad_Filas_Carrito     = 0;
            $this->Carrito_Vacio = true;
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
        }else{
          $IdProducto  = $producto;
          $Cantidad    = $cantidad;
        }
      $i                 = 0;
      $NombreArray       = 'TRON'.$IdProducto;              // CAPTURA CANTIDAD DE PRODUCTO TRON COMPRADO

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
      }
      Session::Destroy('CarritoTron');
      $this->Cerrar_Procesos_Carro();
      $this->Hallar_Valor_Escalas_Productos();
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
      if ($this->Carrito_Habilitado==false)
      {
        return ;
      }

      foreach ($this->Datos_Carro as $Productos)
       {
           if ($Productos['cantidad'] ==0 )
             {
                array_splice($this->Datos_Carro, $i, 1);
             }
             $i++;
       }
      $this->Cerrar_Procesos_Carro();
    }



    public function Mostrar_Carrito() {
      /** ENERO 22 DE 2015
      *   MUSTRA EL CARRITO,LUEGO DE AGREGARLE PRODUCTOS
      */
      //VERIFICA SI DENTRO E CARRO EXITEN COMBOS O KIT DE INICIO LOS CUALES NO PUEDES SER COMPRADOS POR EMPRESARIOS O CLIENTES TRON

      $this->Borrar_Productos_Carro_Plan_2_3();
      //----------------------------------------------------------------------------------------------------------------------------

      $Tipo_Vista = $this->View->Argumentos[0]; // 1 = VISTA CARRO PIRNCIPAL   2= VISTA DE CARRO PARCIAL, AJAX
      $this->Iniciar_Procesos_Carro();
      $this->View->cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');

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
        //$this->Hallar_Valor_Escalas_Productos();
        $this->Totalizar_Carrito();
        $this->View->Datos_Carro                = $_SESSION['carrito'];
        $this->View->Puntos_Utilizados          = Session::Get('Puntos_Utilizados');
        $this->View->Comisiones_Utilizadas      = Session::Get('Comisiones_Utilizadas');

        //DATOS RELACIONADOS CON EL VALOR MÍNIMO DEL PEDIDO Y CONDICION PARA REALIZAR EL PAGO.
        if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE){
            Session::Set('valor_real_pedido', $this->Vr_Total_Pedido_Amigos );
            }else{
             Session::Set('valor_real_pedido', $this->Vr_Total_Pedido_Ocasional );
            }
        Session::Set('cumple_valor_minimo_pedido', TRUE);
        if ( Session::Get('pago_minimo_payulatam') > Session::Get('valor_real_pedido' ) ){
          Session::Set('cumple_valor_minimo_pedido', FALSE);
        }

        //Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento );

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
        if (Session::Get('cumple_valor_minimo_pedido') == TRUE ){
          $Respuesta ='CUMPLE';
        }else{
          $Respuesta ='NO-CUMPLE';
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

    if ( Session::Get('autenticado')== FALSE || Session::Get('idtipo_plan_compras') ==1 ||  Session::Get('usuario_viene_del_registro') == TRUE  ){
      return;
    }
    if (Session::Get('autenticado')== TRUE && Session::Get('kit_comprado') == FALSE){
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
   $this->Cant_Tot_Productos_Tron        = 0;


   $this->PayuLatam_Recaudo               =  Session::Get('py_porciento_recaudo');
   $this->PayuLatam_Valor_Minimo          =  Session::Get('py_vr_min_recaudo');
   $this->PayuLatam_Valor_Adicional       =  Session::Get('py_vr_adicional');

   Session::Set('REDETRANS_COURRIER_flete'           ,0);
   Session::Set('REDETRANS_CARGA_valor_flete'        ,0);
   Session::Set('SERVIENTREGA_PREMIER_valor_flete'   ,0);
   Session::Set('SERVIENTREGA_INDUS_valor_flete'     ,0);
   Session::Set('REDETRANS_COURRIER_seguro'          ,0);
   Session::Set('REDETRANS_CARGA_seguro'             ,0);
   Session::Set('SERVIENTREGA_PREMIER_seguro'        ,0);
   Session::Set('SERVIENTREGA_INDUS_seguro'          ,0);
   Session::Set('REDETRANS_COURRIER_flete_total'     ,0);
   Session::Set('REDETRANS_CARGA_flete_total'        ,0);
   Session::Set('SERVIENTREGA_PREMIER_flete_total'   ,0);
   Session::Set('SERVIENTREGA_INDUS_flete_total'     ,0);
   Session::Set('precio_especial'                    , 0);
   Session::Set('transporte_tron'                    ,0);
   Session::Set('descuento_especial'                 ,0);
   Session::Set('descuento_especial_porcentaje'      , 0);
   Session::Set('vr_unitario_ropa'                   ,0);
   Session::Set('vr_unitario_banios'                 ,0);
   Session::Set('vr_unitario_pisos'                  ,0);
   Session::Set('vr_unitario_loza'                   ,0);

   Session::Set('id_transportadora'        ,0 );
   Session::Set('tipo_despacho'            ,0 );
   Session::Set('vr_flete'                 ,0 );
   Session::Set('valor_declarado'          ,0 );

   Session::Set('id_transportadora_carga'  ,0 );
   Session::Set('tipo_despacho_carga'      ,0 );
   Session::Set('vr_flete_carga'           ,0 );
   Session::Set('valor_declarado_carga'    ,0 );
   Session::Set('Peso_Pedido_Courrier'     , 0);
   Session::Set('Peso_Pedido_Carga'        , 0 );

  $this->Vr_Transporte_Real              = 0;
  $this->Vr_Transporte_Ocasional         = 0;
  $this->Vr_Transporte_Tron              = 0;

}

private function Verificar_Compra_Derecho_Inscripcion($Array_Producto=array()){

  $this->Existe_Derecho_Inscripcion =  FALSE ;

  foreach ($Array_Producto as $Producto  ) {
    if ( $Producto['idproducto'] == 2071){
      $this->Existe_Derecho_Inscripcion = TRUE;

    }
  }
}

public function Totalizar_Carrito(){
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
     //------------------------------------------------------
     $i                                  = 0 ;
     $kit_inicio_peso_total              = 0;
     $kit_cantidad                       = 0;
     $cumple_condiciones_precio_especial = 0;

      // TOTALIZAR CARRITO POR CADA TIPO DE PRODUCTO
      $this->Totalizar_Pedido_x_Categoria_Producto();
      //-------------------------------------------------
      //EVALUAR SI CUMPLE CONDICIONES PARA DAR PRECIO ESPECIAL DEL PRODUCTO
      $cumple_condiciones_precio_especial = $this->Determinar_Cumple_Condiciones_Precio_Especial();
      //---------------------------------------------------------------------------------------------

      $this->compras_tron = 0;
      $this->Verificar_Compra_Derecho_Inscripcion( $this->Datos_Carro);

      foreach ($this->Datos_Carro as &$Productos){

          $cantidad                                   = $Productos['cantidad'];
          $idproducto                                 = $Productos['idproducto'];
          $id_categoria_producto                      = $Productos['id_categoria_producto'];
          $peso_gramos                                = $Productos['peso_gramos'];
          $cmv                                        = $Productos['cmv'];

          //Precio Diferencial del Kit de inicio según e compren o no los derechos de inscripción.
          if ( $this->Existe_Derecho_Inscripcion == TRUE && $idproducto == 10744 ){
            $Productos['pv_ocasional']        = $Productos['precio_kit_tron'];
            $Productos['pv_tron']             = $Productos['precio_kit_tron'];
          }
          if ( $this->Existe_Derecho_Inscripcion == FALSE && $idproducto == 10744 ){
           $Productos['pv_tron']             =  $Productos['precio_kit_ocasional'] ;
           $Productos['pv_ocasional']        =  $Productos['precio_kit_ocasional'];
          }

          $pv_tron                                    = $Productos['pv_tron'] ;
          $pv_ocasional                               = $Productos['pv_ocasional'];

          $peso_total_producto                        = $Productos['peso_gramos'] * $cantidad;
          $porciento_iva                              = 1 + $Productos['iva'] / 100;
          $porciento_ppto_fletes                      = $Productos['ppto_fletes'];
          $ID_Presentacion                            = $Productos['idpresentacion'];


          $Productos['sub_total_pv_tron']             = $cantidad     * $pv_tron;
          $Productos['sub_total_pv_ocasional']        = $cantidad     * $pv_ocasional ;
          $Productos['peso_gramos_total']             = $peso_gramos   * $cantidad ;

          $Productos['precio_unitario_produc_pedido'] = $pv_ocasional ;
          $_sub_total_pv_tron                         = $Productos['sub_total_pv_tron'] ;


          if ( $cumple_condiciones_precio_especial == TRUE ){
            $Productos['precio_unitario_produc_pedido'] = $pv_tron;
          }

          $precio_unitario_producto                      = $Productos['precio_unitario_produc_pedido'];
          $Productos['precio_total_produc_pedido']       = $precio_unitario_producto  * $cantidad;
          $Productos['precio_venta_antes_iva']           = $Productos['precio_unitario_produc_pedido'] / $porciento_iva ;
          $Productos['precio_venta_antes_iva_tron']      = $pv_tron             / $porciento_iva ;
          $Productos['precio_venta_antes_iva_ocasional'] = $pv_ocasional        / $porciento_iva ;

          //PRESUPUESTO DE FLETES

          if ( ($porciento_ppto_fletes > 0 && $id_categoria_producto > 4) && ( $cumple_condiciones_precio_especial == TRUE) ) {
            $Productos['vr_ppto_fletes']              = $precio_unitario_producto  * $cantidad  * $porciento_ppto_fletes;
            $Productos['vr_ppto_fletes_ocas']         = $pv_ocasional              * $cantidad  * $porciento_ppto_fletes;
            $Productos['vr_ppto_fletes_tron']         = $pv_tron                   * $cantidad  * $porciento_ppto_fletes;
          }else{
                  $Productos['vr_ppto_fletes']      = 0;
                  $Productos['vr_ppto_fletes_ocas'] = 0;
                  $Productos['vr_ppto_fletes_tron'] = 0;
          }

          // ANTICIPO DE RECAUDO
          if ( $id_categoria_producto > 4 ){ // AANTICIPO EXCEPTO PRODUCTOS TRON
            $Productos['vr_anticipo_recaudo']      = $precio_unitario_producto  * $cantidad  * $this->PayuLatam_Recaudo ;
            $Productos['vr_anticipo_recaudo_tron'] = $pv_tron                   * $cantidad  * $this->PayuLatam_Recaudo ;
            $Productos['vr_anticipo_recaudo_ocas'] = $pv_ocasional              * $cantidad  * $this->PayuLatam_Recaudo ;


          }else{                          // RECAUDO PRODUCTOS TRON
            $this->Cantidad_Productos_Tron    = $this->Cantidad_Productos_Tron + $cantidad;
          }

          $this->Vr_Base_Iva                    = $this->Vr_Base_Iva                    + ( $Productos['precio_total_produc_pedido'] / $porciento_iva );
          $this->SubTotal_Pedido_Ocasional      = $this->SubTotal_Pedido_Ocasional      + $Productos['sub_total_pv_ocasional'] ;
          $this->SubTotal_Pedido_Amigos         = $this->SubTotal_Pedido_Amigos         + $Productos['sub_total_pv_tron'] ;
          $this->SubTotal_Pedido_Real           = $this->SubTotal_Pedido_Real           + ( $precio_unitario_producto * $cantidad );
          $this->Tron_Peso_Total_Gramos         = $this->Tron_Peso_Total_Gramos         + ( $peso_gramos * $cantidad );

          // TOTALIZAR PRODUCTOS TRON POR CATEGORIAS
          $this->Totalizar_Carrito_Productos_Tron_Por_Categoria($id_categoria_producto, $cantidad, $_sub_total_pv_tron , $pv_ocasional, $peso_gramos , $cmv  );

          if ($idproducto == 10744){
              $kit_inicio_peso_total       = $kit_inicio_peso_total + $peso_gramos ;
              $kit_cantidad                = $kit_cantidad          + $cantidad;
          }

       }// Fin recorrido foreach carrito

       Session::Set('kit_inicio_peso_total',     $kit_inicio_peso_total);
       Session::Set('kit_cantidad',              $kit_cantidad);

       $this->Cerrar_Procesos_Carro();
        $this->Totalizar_Carrito_Hallar_Valor_Declarado();
       if ( $this->Tengo_Productos_Tron == TRUE) {
           $this->Hallar_Asignar_Precio_Especial_Productos_Tron();
        }


       $this->Totalizar_Presupuesto_Fletes_Productos_Tron();
       $this->Totalizar_Carrito_Hallar_Presupuesto_Fletes_Anticipo_Recaudo();
       $this->Totalizar_Pedido_x_Categoria_Producto();
       $this->Calcular_Valor_Recaudo( $this->SubTotal_Pedido_Real, $this->SubTotal_Pedido_Amigos , $this->SubTotal_Pedido_Ocasional  ) ;
       $this->Calcular_Valor_Flete_Transporte_Courrier();
       $this->Calcular_Valor_Flete_Transporte_Carga();
       $this->Totalizar_Carrito_Conformar_Resumen_Carrito_Tron();
       $this->Vr_Base_Iva               =  $this->Vr_Base_Iva               + $this->Vr_Transporte_Real;
       $this->Vr_Total_Pedido_Ocasional =  $this->SubTotal_Pedido_Ocasional + $this->Vr_Transporte_Ocasional;
       $this->Vr_Total_Pedido_Amigos    =  $this->SubTotal_Pedido_Amigos    + $this->Vr_Transporte_Tron;
       $this->Vr_Total_Pedido_Real      =  $this->SubTotal_Pedido_Real      + $this->Vr_Transporte_Real;
       $this->Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon();


       Session::Set('Vr_Total_Pedido_Real',      $this->Vr_Total_Pedido_Real);
       Session::Set('SubTotal_Pedido_Ocasional', $this->SubTotal_Pedido_Ocasional );
       Session::Set('SubTotal_Pedido_Amigos',    $this->SubTotal_Pedido_Amigos );
       Session::Set('presupuesto_flete_otros',   $this->vr_total_ppto_fletes );

       Session::Set('Vr_Recaudo',                $this->Vr_Recaudo);
       Session::Set('Vr_Base_Iva',               $this->Vr_Base_Iva);
       Session::Set('Valor_Declarado_Total',     $this->Valor_Declarado_Total);
} // Fin Tootalizar carrito temp


  private function Calcular_Valor_Flete_Transporte_Courrier (){

    //Calulo Transporte Comprador Ocasional - $this->vr_total_ppto_fletes_ocas
    Session::Set('CARGA_FLETES', 0 );
    Session::Set('CARGA_UNIDADES', 0 );
    Session::Set('CARGA_SUBSIDIO_FLETE',0);
    Session::Set('CARGA_FLETE_REAL',0);
    Session::Set('CARGA_VR_TRANSPORTE_FINAL',0);
    Session::Set('CARGA_TIPO_TARIFA','');
    Session::Set('VR_TRANS_OCASI_COURIER', 0)  ;
    Session::Set('VR_TRANS_TRON_COURIER', 0 )  ;
    Session::Set('VR_TRANS_OCASI_CARGA', 0)  ;
    Session::Set('VR_TRANS_TRON_CARGA', 0 )  ;
     if ( $this->Peso_Pedido_Courrier > 0 ){
          $this->Fletes->Calcular_Valor_Flete_Courrier( $this->Peso_Pedido_Courrier, $this->Vr_Declarado_Courrier_Ocas);
          $this->Vr_Fletes                    = Session::Get('flete_real_calculado');
          $this->Vr_Transporte_Ocasional      = $this->Vr_Fletes  + $this->Vr_Recaudo_ocas +
                                                $this->PayuLatam_Valor_Adicional -  $this->vr_total_anticipo_recaudo_ocas ;
          Session::Set('VR_TRANS_OCASI_COURIER', $this->Vr_Transporte_Ocasional )  ;
          // Calculo transporte Comprador TRON
          $this->Fletes->Calcular_Valor_Flete_Courrier( $this->Peso_Pedido_Courrier, $this->Vr_Declarado_Courrier_Tron );
          $this->Vr_Fletes                    = Session::Get('flete_real_calculado');
          $this->Vr_Transporte_Tron           = $this->Vr_Fletes  - $this->vr_total_ppto_fletes_tron + $this->Vr_Recaudo_tron +
                                                $this->PayuLatam_Valor_Adicional -  $this->vr_total_anticipo_recaudo_tron ;

          Session::Set('VR_TRANS_TRON_COURIER', $this->Vr_Transporte_Tron )  ;

          if ( Session::Get('cumple_condicion_cpras_tron_industial') == FALSE ){
              if ( $this->Vr_Transporte_Ocasional  > $this->Vr_Transporte_Tron  ){
                $this->Vr_Transporte_Tron  = $this->Vr_Transporte_Ocasional ;
              }
              if ( $this->Vr_Transporte_Tron  > $this->Vr_Transporte_Ocasional ){
                $this->Vr_Transporte_Ocasional = $this->Vr_Transporte_Tron;
              }
        }
          // Caculo con el precio real
          $this->Fletes->Calcular_Valor_Flete_Courrier( $this->Peso_Pedido_Courrier, $this->Vr_Declarado_Courrier_Total);
          $this->Vr_Fletes                    = Session::Get('flete_real_calculado');
          $this->Vr_Transporte_Real           = $this->Vr_Fletes - $this->vr_total_ppto_fletes + $this->Vr_Recaudo +
                                    						$this->PayuLatam_Valor_Adicional -  $this->vr_total_anticipo_recaudo;


          if ( $this->Vr_Transporte_Ocasional < 1 ){ $this->Vr_Transporte_Ocasional  = 0 ;}
          if ( $this->Vr_Transporte_Tron      < 1 ){ $this->Vr_Transporte_Tron       = 0 ;}
          if ( $this->Vr_Transporte_Real      < 1 ){ $this->Vr_Transporte_Real       = 0 ;}


          Session::Set('COURRIER_FLETES',                 $this->Vr_Fletes );
          Session::Set('COURRIER_UNIDADES',               Session::Get('Cant_Unidades_Despacho') );
          Session::Set('COURRIER_SUBSIDIO_FLETE',         $this->vr_total_ppto_fletes);
          Session::Set('COURRIER_FLETE_REAL',             $this->Vr_Fletes - $this->vr_total_ppto_fletes );
          Session::Set('COURRIER_VR_TRANSPORTE_FINAL',    $this->Vr_Transporte_Real);
          Session::Set('COURRIER_TIPO_TARIFA',            Session::Get('tipo_tarifa'));

      }


        if (  $this->Vr_Declarado_Courrier_Total > 0 ){
           Session::Set('id_transportadora'    , Session::Get('id_transportadora'));
           Session::Set('tipo_despacho'        , Session::Get('tipo_despacho_pedido'));
           Session::Set('vr_flete'             , Session::Get('flete_real_calculado'));
           Session::Set('valor_declarado'      , $this->Vr_Declarado_Courrier_Total);

           Session::Set('Vr_Transporte',             $this->Vr_Transporte_Real  );
           Session::Set('Vr_Transporte_Ocasional',   $this->Vr_Transporte_Ocasional  );
           Session::Set('Vr_Transporte_Amigo_Tron',  $this->Vr_Transporte_Tron );
          }
  }

   private function Calcular_Valor_Flete_Transporte_Carga(){
//$this->vr_total_ppto_fletes_ocas //$this->vr_total_ppto_fletes

				if ( $this->Peso_Pedido_Carga > 0){
						$this->Fletes->Calcular_Valor_Flete_Carga($this->Peso_Pedido_Carga, $this->Vr_Declarado_Carga_Ocas);
						$this->Vr_Fletes                = Session::Get('flete_real_calculado');
						$_Vr_Transporte_Ocasional       = $this->Vr_Fletes +
                                              $this->Vr_Recaudo_ocas + $this->PayuLatam_Valor_Adicional -
                                              $this->vr_total_anticipo_recaudo_ocas ;
            Session::Set('VR_TRANS_OCASI_CARGA', $_Vr_Transporte_Ocasional )  ;

		        // Calculo tranporte comprador tron
		   	    $this->Fletes->Calcular_Valor_Flete_Carga($this->Peso_Pedido_Carga, $this->Vr_Declarado_Carga_Tron);
						$this->Vr_Fletes                 = Session::Get('flete_real_calculado');
            $_Vr_Transporte_Tron       = $this->Vr_Fletes                 - 0 +
                                               $this->Vr_Recaudo_tron     + $this->PayuLatam_Valor_Adicional -
                                               $this->vr_total_anticipo_recaudo_tron;
            Session::Set('VR_TRANS_TRON_CARGA', $_Vr_Transporte_Tron )  ;

           if ( Session::Get('cumple_condicion_cpras_tron_industial') == FALSE ){
               if ( $_Vr_Transporte_Ocasional > $_Vr_Transporte_Tron )   {
                $_Vr_Transporte_Tron = $_Vr_Transporte_Ocasional;
               }
               if ( $_Vr_Transporte_Tron > $_Vr_Transporte_Ocasional  )  {
                $_Vr_Transporte_Ocasional  =  $_Vr_Transporte_Tron ;
               }
           }
           // Caculo con el precio real
  		     $this->Fletes->Calcular_Valor_Flete_Carga( $this->Peso_Pedido_Carga, $this->Vr_Declarado_Carga_Total);
  		     $this->Vr_Fletes                   = Session::Get('flete_real_calculado');
  		     $_Vr_Transporte_Real               = $this->Vr_Fletes                 - 0 +
                                                 $this->Vr_Recaudo          + $this->PayuLatam_Valor_Adicional -
                                                 $this->vr_total_anticipo_recaudo;

         Session::Set('CARGA_FLETES',               $this->Vr_Fletes );
         Session::Set('CARGA_UNIDADES',             Session::Get('Cant_Unidades_Despacho') );
         Session::Set('CARGA_SUBSIDIO_FLETE',       0);
         Session::Set('CARGA_FLETE_REAL',           $this->Vr_Fletes - $this->vr_total_ppto_fletes );
         Session::Set('CARGA_VR_TRANSPORTE_FINAL',  $_Vr_Transporte_Real );
         Session::Set('CARGA_TIPO_TARIFA',          Session::Get('tipo_tarifa'));

          if ( $_Vr_Transporte_Ocasional  < 1 ){ $_Vr_Transporte_Ocasional   = 0 ;}
          if (  $_Vr_Transporte_Tron      < 1 ){  $_Vr_Transporte_Tron       = 0 ;}
          if ( $_Vr_Transporte_Real       < 1 ){ $_Vr_Transporte_Real        = 0 ;}
          // Transporte acumulado
          $this->Vr_Transporte_Real      =  $this->Vr_Transporte_Real     + $_Vr_Transporte_Real;
          $this->Vr_Transporte_Ocasional = $this->Vr_Transporte_Ocasional + $_Vr_Transporte_Ocasional;
          $this->Vr_Transporte_Tron      = $this->Vr_Transporte_Tron      + $_Vr_Transporte_Tron ;
		     }

        if (  $this->Vr_Transporte_Real       < 0)      {  $this->Vr_Transporte_Real       = 0  ; };
        if (  $this->Vr_Transporte_Ocasional  < 0)      {  $this->Vr_Transporte_Ocasional  = 0  ; };
        if (  $this->Vr_Transporte_Tron       < 0)      {  $this->Vr_Transporte_Tron       = 0  ; };


        if (  $this->Vr_Declarado_Carga_Total > 0 ){
           Session::Set('id_transportadora_carga'    , Session::Get('id_transportadora'));
           Session::Set('tipo_despacho_carga'        , Session::Get('tipo_despacho_pedido'));
           Session::Set('vr_flete_carga'             , Session::Get('flete_real_calculado'));
           Session::Set('valor_declarado_carga'      , $this->Vr_Declarado_Carga_Total  );
          }

  		    Session::Set('Vr_Transporte',             $this->Vr_Transporte_Real  );
  		    Session::Set('Vr_Transporte_Ocasional',   $this->Vr_Transporte_Ocasional   );
  		    Session::Set('Vr_Transporte_Amigo_Tron',  $this->Vr_Transporte_Tron  );


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

     foreach ($this->Datos_Carro as $Productos){
        $id_categoria_producto = $Productos['id_categoria_producto'];
        if ( $id_categoria_producto >=1 && $id_categoria_producto  <= 5 ){
           $CarritoTron[$i_tron]['cantidad']     = $Productos['cantidad'] ;
           $CarritoTron[$i_tron]['pv_tron']      = $Productos['pv_tron'] ;
           $CarritoTron[$i_tron]['pv_ocasional'] = $Productos['pv_ocasional'] ;
           $CarritoTron[$i_tron]['nom_producto'] = $Productos['nom_producto'] ;
           $CarritoTron[$i_tron]['idproducto']   = $Productos['idproducto'] ;
           //
           $pv_tron_resumen     = $pv_tron_resumen + ( $CarritoTron[$i_tron]['pv_tron']      * $CarritoTron[$i_tron]['cantidad'] );
           $pv_ocas_resumen     = $pv_ocas_resumen + ( $CarritoTron[$i_tron]['pv_ocasional'] * $CarritoTron[$i_tron]['cantidad'] );
           $i_tron ++;
        }

     }// endforach
     $this->Cerrar_Procesos_Carro();

     Session::Set('CarritoTron',$CarritoTron);
     Session::Set('pv_tron_resumen',$pv_tron_resumen);
     Session::Set('pv_ocas_resumen',$pv_ocas_resumen);

}

private function Totalizar_Carrito_Hallar_Presupuesto_Fletes_Anticipo_Recaudo(){
    $this->Iniciar_Procesos_Carro();
    if ($this->Carrito_Habilitado == FALSE)  {
        return ;
     }
     $this->vr_total_anticipo_recaudo = 0;

     foreach ($this->Datos_Carro as &$Productos){
        $this->vr_total_ppto_fletes_tron      = $this->vr_total_ppto_fletes_tron       + $Productos['vr_ppto_fletes_tron'];
        $this->vr_total_ppto_fletes_ocas      = $this->vr_total_ppto_fletes_ocas       + $Productos['vr_ppto_fletes_ocas'];

        $this->vr_total_anticipo_recaudo_tron = $this->vr_total_anticipo_recaudo_tron  + $Productos['vr_anticipo_recaudo_tron'];
        $this->vr_total_anticipo_recaudo_ocas = $this->vr_total_anticipo_recaudo_ocas  + $Productos['vr_anticipo_recaudo_ocas'];
        $this->vr_total_anticipo_recaudo      = $this->vr_total_anticipo_recaudo       +  $Productos['vr_anticipo_recaudo'];

     }// fin foreach
      $this->Cerrar_Procesos_Carro();

     if ( Session::Get('cumple_condicion_cpras_tron_industial') == TRUE ) {
      $this->vr_total_ppto_fletes        = $this->vr_total_ppto_fletes_tron;
      }else{
        $this->vr_total_ppto_fletes        = $this->vr_total_ppto_fletes_ocas;
      }

  }


private function Totalizar_Carrito_Hallar_Valor_Declarado(){
    $factor_seguro_flete_otros_productos              = Session::Get('factor_seguro_flete_otros_productos');
    $porciento_seguro_flete_productos_industriales    = Session::Get('porciento_seguro_flete_productos_industriales'); // También es un Factor
    $factor_vr_declarado_productos_tron               = Session::Get('factor_vr_declarado_productos_tron');            // También es un Factor
    $valor_minimo_aplicar_vr_declarado_productos_tron = Session::Get('valor_minimo_aplicar_vr_declarado_productos_tron');
    $rt_courrier_seguro                               = Session::Get('rt_courrier_seguro');
    $Parametros                                       =  Session::Get('Parametros');


    /// ESTAS PRESENTACIONES ON DE INDUSTRIAL, PERO APLICAN EN COURRIER
    $presentaciones_aplican_courrier   = array(3, 6, 7, 9, 14, 85, 87, 90,144, 149, 158, 159, 165, 167, 168, 178, 180, 192 );

    $this->Iniciar_Procesos_Carro();
    if ($this->Carrito_Habilitado == FALSE)  {
        return ;
     }

    foreach ($this->Datos_Carro as &$Productos){
      $id_categoria_producto            =  $Productos['id_categoria_producto'];
      $idproducto                       =  $Productos['idproducto'];
      $precio_venta_antes_iva           =  $Productos['precio_venta_antes_iva'] ;
      $cantidad                         =  $Productos['cantidad'] ;
      $precio_venta_antes_iva_tron      =  $Productos['precio_venta_antes_iva_tron']  ;
      $precio_venta_antes_iva_ocasional =  $Productos['precio_venta_antes_iva_ocasional'] ;
      $porciento_iva                    =  1+ $Productos['iva']/100;
      $tipo_despacho                    =  $Productos['tipo_despacho'];
      $idpresentacion                   =  $Productos['idpresentacion'];
      $peso_gramos                      =  $Productos['peso_gramos']  ;
      $porciento_seguro_flete           = 0;



      // VALOR DECLARADO EXCEPTO KIT DE INICIO, DERECHOS DE INSCRIP. Y PASES DE CORTESÍA
      if ($idproducto != 10744 && $idproducto != 2071 && $idproducto != 14999 ){  // IF (1)

        $_precio_unitario_produc_pedido    = $precio_venta_antes_iva            *  $cantidad  ;
        $_precio_venta_antes_iva_tron      = $precio_venta_antes_iva_tron       *  $cantidad  ;
        $_precio_venta_antes_iva_ocasional = $precio_venta_antes_iva_ocasional  *  $cantidad  ;


        if ( ($tipo_despacho  == 1 && $id_categoria_producto > 4 ) || in_array( $idpresentacion, $presentaciones_aplican_courrier )== TRUE ){ // DESPACHO COURRIER
            $this->Vr_Declarado_Courrier_Ocas   = $this->Vr_Declarado_Courrier_Ocas  + ( $_precio_venta_antes_iva_ocasional  * $factor_seguro_flete_otros_productos );
            $this->Vr_Declarado_Courrier_Tron   = $this->Vr_Declarado_Courrier_Tron  + ( $_precio_venta_antes_iva_tron       * $factor_seguro_flete_otros_productos );
            $this->Vr_Declarado_Courrier_Total  = $this->Vr_Declarado_Courrier_Total + ( $_precio_unitario_produc_pedido     * $factor_seguro_flete_otros_productos );
            $this->Peso_Pedido_Courrier         = $this->Peso_Pedido_Courrier        + ( $peso_gramos * $cantidad );
            $porciento_seguro_flete             = $factor_seguro_flete_otros_productos;
        }

        if ( $tipo_despacho  == 2 && in_array( $idpresentacion, $presentaciones_aplican_courrier ) == FALSE && $id_categoria_producto > 4 ){ // DESPACHO CARGA
            $this->Vr_Declarado_Carga_Ocas  = $this->Vr_Declarado_Carga_Ocas  + ( $_precio_venta_antes_iva_ocasional  * $porciento_seguro_flete_productos_industriales );
            $this->Vr_Declarado_Carga_Tron  = $this->Vr_Declarado_Carga_Tron  + ( $_precio_venta_antes_iva_tron       * $porciento_seguro_flete_productos_industriales );
            $this->Vr_Declarado_Carga_Total = $this->Vr_Declarado_Carga_Total + ( $_precio_unitario_produc_pedido     * $porciento_seguro_flete_productos_industriales );
            $this->Peso_Pedido_Carga        = $this->Peso_Pedido_Carga        + ( $peso_gramos * $cantidad );
            $porciento_seguro_flete         = $porciento_seguro_flete_productos_industriales;
        }

        if (Session::Get('cumple_condicion_cpras_tron_industial') == TRUE ){
            $Productos['valor_declarado'] = $_precio_venta_antes_iva_tron        * $porciento_seguro_flete ;
          }else{
             $Productos['valor_declarado'] = $_precio_venta_antes_iva_ocasional  * $porciento_seguro_flete ;
          }



        // VALOR DECLARADO PRODUCTOS TRON
        if  ( $id_categoria_producto >= 1 &&  $id_categoria_producto <= 4) {
           $this->Peso_Pedido_Courrier         = $this->Peso_Pedido_Courrier        +  $peso_gramos * $cantidad ;
           $this->Cant_Tot_Productos_Tron      = $this->Cant_Tot_Productos_Tron     + $cantidad ;

           if ( $this->compras_tron  >= $valor_minimo_aplicar_vr_declarado_productos_tron && $this->Cantidad_Productos_Tron > 0  ){
                $_valor_declarado_item = $this->compras_tron/$porciento_iva * $factor_vr_declarado_productos_tron / $this->Cantidad_Productos_Tron ;
              }
           if ( $this->compras_tron  < $valor_minimo_aplicar_vr_declarado_productos_tron && $this->Cantidad_Productos_Tron > 0  ){
              $_valor_declarado_item  = $rt_courrier_seguro /  $this->Cantidad_Productos_Tron ;
           }

           $Productos['valor_declarado']         = $_valor_declarado_item * $cantidad;
           $this->Valor_Declarado_Productos_Tron = $this->Valor_Declarado_Productos_Tron + $Productos['valor_declarado'];
           /// CALCULAR EL PRESUPUESTO DE RECAUDO
           //----------------------------------------------------------------------------------------------------------------------------------------------
        if (  $this->compras_tron >=   $Parametros[0]['valor_minimo_pedido_productos']){
            $Recaudo_Productos_Tron   = $this->compras_tron * $this->PayuLatam_Recaudo;
            if ($Recaudo_Productos_Tron  < $this->PayuLatam_Valor_Minimo  ){
              $Recaudo_Productos_Tron = $this->PayuLatam_Valor_Minimo ;
            }
            $Productos['vr_anticipo_recaudo']     = ($Recaudo_Productos_Tron + $this->PayuLatam_Valor_Adicional) / $this->Cantidad_Productos_Tron ;
            $Productos['vr_anticipo_recaudo']     = $Productos['vr_anticipo_recaudo'] * $cantidad;
            $this->vr_total_anticipo_recaudo_tron = $this->vr_total_anticipo_recaudo_tron + $Productos['vr_anticipo_recaudo'];
          }
         }
      } // FIN (1)
    } // fin foreach


    $this->vr_total_anticipo_recaudo = $this->vr_total_anticipo_recaudo_tron  + $this->vr_total_anticipo_recaudo_ocas;
    $this->Cerrar_Procesos_Carro();
    $this->Vr_Declarado_Courrier_Ocas  = $this->Vr_Declarado_Courrier_Ocas  + $this->Valor_Declarado_Productos_Tron;
    $this->Vr_Declarado_Courrier_Tron  = $this->Vr_Declarado_Courrier_Tron  +  $this->Valor_Declarado_Productos_Tron;
    $this->Vr_Declarado_Courrier_Total = $this->Vr_Declarado_Courrier_Total + $this->Valor_Declarado_Productos_Tron;
    Session::Set('Peso_Pedido_Courrier', $this->Peso_Pedido_Courrier );
    Session::Set('Peso_Pedido_Carga'   , $this->Peso_Pedido_Carga );

} // fin functio Totalizar_Carrito_Hallar_Valor_Declarado


private function Totalizar_Presupuesto_Fletes_Productos_Tron(){
  /**  CALCULA EL PRESUPUPUESTO DE FLETES DE PRODUCTOS TRON
   * */

  $this->Fletes->Presupuesto_Fletes_Productos_Tron( $this->compras_tron, $this->Cant_Tot_Productos_Tron, $this->Valor_Declarado_Productos_Tron);
  $Presupuesto_Unitario = Session::Get('SubSidio_Flete_Unitario_Tron');

    $this->Iniciar_Procesos_Carro();
    if ($this->Carrito_Habilitado == FALSE)  {
        return ;
     }
    foreach ($this->Datos_Carro as &$Productos){
        if ( $Productos['id_categoria_producto'] <= 4 ){
            $Productos['vr_ppto_fletes_tron'] = $Presupuesto_Unitario * $Productos['cantidad'];
            $Productos['vr_ppto_fletes']      = $Productos['vr_ppto_fletes_tron'] ;
        }
    }
    $this->Cerrar_Procesos_Carro();
}

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

    $datos=compact('Cantidad_Ropa','Peso_Ropa','Cmv_Ropa','Precio_Lista_Ropa',
                   'Cantidad_Banios','Peso_Banios','Cmv_Banios','Precio_Lista_Banios',
                   'Cantidad_Pisos','Peso_Pisos','Cmv_Pisos','Precio_Lista_Pisos',
                   'Cantidad_Loza','Peso_Loza','Cmv_Loza','Precio_Lista_Loza');
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

      if ( $id_categoria_producto <= 4 ){
        $Productos['vr_ppto_fletes'] = $presupuesto_fletes_tron * $cantidad ;
      }
      if ( $idproducto == 10744 ){
        $Productos['vr_ppto_fletes'] = $presupuesto_fletes_kit * $cantidad ;
      }
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
         $this->Tengo_Productos_Tron = TRUE;
         $this->compras_tron  = $this->compras_tron + $sub_total_pv_tron ;

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

private function Determinar_Cumple_Condiciones_Precio_Especial(){
  /** JULIO 24 DE 2015
   *      DETERMINA SI CUMPLE LAS CONDICIONES PARA APLICAR EL PRECIO ESPECIAL EN LA COMPRA
   */
    $this->Terceros->Compra_Productos_Tron_Mes_Actual( $this->compras_tron  , $this->compras_industrial  );
    $Cumple_Condic_Cpras_Tron_Industial = FALSE;

    if ( Session::Get('autenticado') == TRUE ) {
      $Cumple_Condic_Cpras_Tron_Industial   = Session::Get('cumple_condicion_cpras_tron_industial');
      $compra_minima_productos_tron         = Session::Get('minimo_compras_productos_tron');
      $compra_minima_productos_industriales = Session::Get('minimo_compras_productos_ta');
      $compras_este_mes_tron                = Session::Get('compras_productos_tron');
      $compras_este_mes_industiales         = Session::Get('compras_productos_fabricados_ta');
      $usuario_viene_del_registro           = Session::Get('usuario_viene_del_registro');
      $kit_comprado                         = Session::Get('kit_comprado') ;
      $compras_totales_tron                 = $this->compras_tron + $compras_este_mes_tron ;
      $compras_totales_industrial           = $this->compras_industrial + $compras_este_mes_industiales ;

        if ( ($compras_totales_tron       >= $compra_minima_productos_tron)           ||
             ($compras_totales_industrial >= $compra_minima_productos_industriales )  ||
             ($usuario_viene_del_registro == TRUE && $kit_comprado  == FALSE)){

             $Cumple_Condic_Cpras_Tron_Industial   = TRUE;
          }else{
              $Cumple_Condic_Cpras_Tron_Industial   = FALSE;
          }
    }
      //$Cumple_Condic_Cpras_Tron_Industial  = TRUE;
      Session::Set('cumple_condicion_cpras_tron_industial', $Cumple_Condic_Cpras_Tron_Industial );
      return $Cumple_Condic_Cpras_Tron_Industial;

} // fin Determinar_Cumple_Condiciones_Precio_Especial


public function Totalizar_Pedido_x_Categoria_Producto() {
      /** MARZO 19 DE 2015
      *       TOTALIZA LOS VALORES DEL PEDIDO POR CATEGORIA DE PRODUCTO. TRON, INDUSTRIALES, ACCESORIOS, OTROS
      */
      $this->compras_tron            = 0;
      $this->compras_industrial      = 0 ;
      $this->compras_otros_productos = 0 ;
      $this->compras_accesorios      = 0 ;
      $i                             = 0;
      $peso_productos_tron           = 0;
      $peso_productos_industriales   = 0;
      $peso_otros_productos          = 0;
      $peso_accesorios               = 0; // Contine peso de accesorios y productos promocionales
      Session::Set('compra_productos_tron',0);
      Session::Set('compra_productos_industriales',0 );
      Session::Set('compra_otros_productos',0);
      Session::Set('compra_accesorios',0);
      //Peso de productos segun categoria
      Session::Set('peso_productos_tron',0);
      Session::Set('peso_productos_industriales',0);
      Session::Set('peso_otros_productos',0);
      Session::Set('peso_accesorios',0);
      $this->Depurar_Carrito();
      $this->Iniciar_Procesos_Carro();
      for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)  {
          // COMPRAS POR CADA TIPO DE PRODUCTO
          $id_categoria_producto = $this->Datos_Carro[$i]['id_categoria_producto'] ;
          $precio_unitario       = $this->Datos_Carro[$i]['precio_unitario_produc_pedido'] ;
          $cantidad              = $this->Datos_Carro[$i]['cantidad'] ;
          $total_item            = $precio_unitario *  $cantidad ;

          $peso_gramos           = $this->Datos_Carro[$i]['peso_gramos'] *  $cantidad  ;
          if ($id_categoria_producto >= 1 and $id_categoria_producto <= 4)
          {
               $this->compras_tron  = $this->compras_tron + $total_item  ;
               $peso_productos_tron = $peso_productos_tron  + $peso_gramos ;
          }
          if ($id_categoria_producto == 6) // Industiales
          {
                $this->compras_industrial   = $this->compras_industrial  + $total_item  ;
                $peso_productos_industriales  = $peso_productos_industriales  + $peso_gramos ;
          }
          if ($id_categoria_producto == 7) // otros productos
          {
               $this->compras_otros_productos = $this->compras_otros_productos  +  $total_item  ;
               $peso_otros_productos          = $peso_otros_productos  + $peso_gramos ;
          }
          if ($id_categoria_producto == 5 || $id_categoria_producto == 8 ) // Accesorios y productos promocionales
          {
               $this->compras_accesorios = $this->compras_accesorios  +  $total_item ;
               $peso_accesorios          = $peso_accesorios  + $peso_gramos ;
          }
        }

      Session::Set('compra_productos_tron', $this->compras_tron);
      Session::Set('compra_productos_industriales',$this->compras_industrial );
      Session::Set('compra_otros_productos',$this->compras_otros_productos);
      Session::Set('compra_accesorios',$this->compras_accesorios );
      //
      Session::Set('peso_productos_tron',$peso_productos_tron);
      Session::Set('peso_productos_industriales',$peso_productos_industriales );
      Session::Set('peso_otros_productos',$peso_otros_productos);
      Session::Set('peso_accesorios',$peso_accesorios );
      $this->Cerrar_Procesos_Carro();
    }

public function Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon()
    {/** FEBRERO 02 DE 2015
      *     REALIZA APLICACION DE DESCUENTOS POR CONCEPTO DE PUNTOS, COMISIONES Y CUPONES DE DESCUENTO
      */
            // Aplición de descuentos por concepto de puntos y comisiones pendientes por pagar
      // Si el pedido se realiza para un amigo, no se aplican descuentos de comisiones y puntos
      Session::Set('Vr_Usado_Cupon_Descuento',    0);
      Session::Set('Puntos_Utilizados',           0 );
      Session::Set('Comisiones_Utilizadas',       0 );

     $Pedido_Para_Amigo            = Session::Get('Generando_Pedido_Amigo');
     $Aplicacion_Puntos_Comisiones = Session::Get('Aplicacion_Puntos_Comisiones');

     if ( (isset($Pedido_Para_Amigo) == TRUE && $Pedido_Para_Amigo = FALSE ) || ( isset($Aplicacion_Puntos_Comisiones ) && $Aplicacion_Puntos_Comisiones == TRUE ) ){
          $Vr_Usado_Cupon_Descuento = 0;
          $Puntos_Utilizados        = 0;
          $Comisiones_Utilizadas    = 0;
          $autenticado              = false;
          $this->Terceros->Consultar_Saldos_Comisiones_Puntos_x_Idtercero();
          //Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento );
          $this->Saldo_Puntos_Cantidad      = Session::Get('saldo_puntos_cantidad');
          $this->Saldo_Comisiones           = Session::Get('saldo_comisiones');
          $this->Vr_Cupon_Descuento         = Session::Get('vr_cupon_descuento');
          if ( $this->Vr_Total_Pedido_Real > 0 ){
              if ( $this->Saldo_Puntos_Cantidad >= $this->Vr_Total_Pedido_Real ){
                 $Puntos_Utilizados               =  $this->Vr_Total_Pedido_Real;
                 $this->Vr_Total_Pedido_Real      = 0;
                 $this->Vr_Total_Pedido_Ocasional = 0;
                 $this->Vr_Total_Pedido_Amigos    = 0;
              }else{
                $this->Vr_Total_Pedido_Real      = $this->Vr_Total_Pedido_Real      - $this->Saldo_Puntos_Cantidad;
                $this->Vr_Total_Pedido_Ocasional = $this->Vr_Total_Pedido_Ocasional - $this->Saldo_Puntos_Cantidad;
                $this->Vr_Total_Pedido_Amigos    = $this->Vr_Total_Pedido_Amigos    - $this->Saldo_Puntos_Cantidad;
                $Puntos_Utilizados          =  $this->Saldo_Puntos_Cantidad ;
              }
          }
          if ( $this->Vr_Total_Pedido_Real > 0 ){
              if ( $this->Saldo_Comisiones >= $this->Vr_Total_Pedido_Real ){
                 $Comisiones_Utilizadas           =  $this->Vr_Total_Pedido_Real;
                 $this->Vr_Total_Pedido_Real      = 0;
                 $this->Vr_Total_Pedido_Ocasional = 0;
                 $this->Vr_Total_Pedido_Amigos    = 0;
              }else{
                $this->Vr_Total_Pedido_Real = $this->Vr_Total_Pedido_Real - $this->Saldo_Comisiones;
                $this->Vr_Total_Pedido_Ocasional = $this->Vr_Total_Pedido_Ocasional - $this->Saldo_Comisiones;
                $this->Vr_Total_Pedido_Amigos    = $this->Vr_Total_Pedido_Amigos    - $this->Saldo_Comisiones;
                $Comisiones_Utilizadas           =  $this->Saldo_Comisiones;
              }
            }
            Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento );
            Session::Set('Puntos_Utilizados',           $Puntos_Utilizados );
            Session::Set('Comisiones_Utilizadas',       $Comisiones_Utilizadas );
        }
    }

  public function Calcular_Valor_Recaudo( $valor_total_pedido,$valor_total_pedido_tron, $valor_total_pedido_ocas  ) {
      /** ABRIL 25 DE 2015
       *   CALCULA EL VALOR DE RECAUDO DE ACUERDO AL PEDIDO
       */
      Session::Set('recaudo_total',0);
      Session::Set('vr_diferencia_recaudo', 0);

      $this->Vr_Recaudo = $valor_total_pedido *  $this->PayuLatam_Recaudo ;
      if ( $this->Vr_Recaudo < $this->PayuLatam_Valor_Minimo ){
        $this->Vr_Recaudo = $this->PayuLatam_Valor_Minimo;
      }
      Session::Set('recaudo_total',$this->Vr_Recaudo);
      // Calculos Ocasional
      $this->Vr_Recaudo_ocas = $valor_total_pedido_ocas *  $this->PayuLatam_Recaudo ;
      if ( $this->Vr_Recaudo_ocas < $this->PayuLatam_Valor_Minimo ){
        $this->Vr_Recaudo_ocas = $this->PayuLatam_Valor_Minimo;
      }
      // Calculos tron
      $this->Vr_Recaudo_tron = $valor_total_pedido_tron *  $this->PayuLatam_Recaudo ;
      if ( $this->Vr_Recaudo_tron < $this->PayuLatam_Valor_Minimo ){
        $this->Vr_Recaudo_tron = $this->PayuLatam_Valor_Minimo;
      }

    }






    public function Hallar_Valor_Escalas_Productos() {
        $this->Iniciar_Procesos_Carro();

        $i   = 0;
        for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)   {
            $this->Datos_Carro[$i]['pv_tron']           = $this->Datos_Carro[$i]['pv_tron_real'];
            $this->Datos_Carro[$i]['sub_total_pv_tron'] = $this->Datos_Carro[$i]['cantidad'] *  $this->Datos_Carro[$i]['pv_tron'];
            $this->Datos_Carro[$i]['idescala_dt']       = 0;

            if ($this->Datos_Carro [$i]['cantidad'] >0 and $this->Datos_Carro[$i]['idescala'] > 0)
             {
              $cantidad         = $this->Datos_Carro[$i]['cantidad'];
              $idescala         = $this->Datos_Carro[$i]['idescala'];
              $idproducto       = $this->Datos_Carro[$i]['idproducto'];
              $pv_tron          = $this->Datos_Carro[$i]['pv_tron'];
              $pv_tron_escala_a = $this->Datos_Carro[$i]['pv_tron_escala_a'];
              $pv_tron_escala_b = $this->Datos_Carro[$i]['pv_tron_escala_b'];
              $pv_tron_escala_c = $this->Datos_Carro[$i]['pv_tron_escala_c'];
              //

              // CONSULTA LAS ESCALAS DE ACUERDO AL ID ESCALA DEL PRODUCTO. RETORNA EL PRECIOS PARA EL AMIGO TRON DE ACUERDO
              // A LA CANTIDAD QUE ESTÁ COMPRANDO
              //---------------------------------------------------------------------------------------------------------------------
              $this->Escalas->Escalas_Consultar($idescala,$cantidad,$pv_tron,$pv_tron_escala_a,$pv_tron_escala_b,$pv_tron_escala_c );
              $this->Escalas->Precio_Final_Tron;

              $this->Datos_Carro[$i]['pv_tron']           = $this->Escalas->Precio_Final_Tron;
              $this->Datos_Carro[$i]['posicion_escala']   = $this->Escalas->Posicion_Escala;  // PUEDE SER 0, 1, 2, 3 .. IMPORTANTE PARA LOS PRESUPUESTOS
              $this->Datos_Carro[$i]['idescala_dt']       = $this->Escalas->IdEscala_Compra;  // IDENTIFICADOR DE LA ESCALA CON LA QUE SE OMPRA}
              $this->Datos_Carro[$i]['sub_total_pv_tron'] = $this->Datos_Carro[$i]['cantidad'] *  $this->Datos_Carro[$i]['pv_tron'];

            }
          }


        $this->Cerrar_Procesos_Carro();
    } // Fin Hallar_Valor_Escalas_Productos



  public function Agregar_Producto()  {
      /** ENERO 06 DE 2014
      *   REALIZA LA ENTRADA DE PRODUCTOS AL CARRO DE COMPRA DE ACUERDO A LAS COMPRAS QUE ESTÁ REALIZANDO EL USUARIO
      */

        $IdProducto       = General_Functions::Validar_Entrada('IdProducto','NUM');
        $CantidadComprada = General_Functions::Validar_Entrada('CantidadComprada','NUM');
        $ProdTron         = General_Functions::Validar_Entrada('es_tron','BOL');
        $ProdTronAcc      = General_Functions::Validar_Entrada('es_tron_acc','BOL');
        $NombreArray      = 'TRON'.$IdProducto ;
        Session::Set($NombreArray,$CantidadComprada); // CAPTURA EN ARRAY LA CANTIDA DE PRODUCTOS TRON COMPRADOS
        //

        if (!isset($_SESSION['carrito'])) {
          $_SESSION['carrito'] = array();
        }
        $Carrito_Actual     = $_SESSION['carrito'];
        $Ultima_Compra      = array('idproducto'=>$IdProducto ,'cantidad'=>$CantidadComprada);
        $Existe_Id_Producto = false;
        $Pos                = 0;
        $Cantidad_Filas     = count($Carrito_Actual);
        $i                  = 0;
        for ($i=0; $i<$Cantidad_Filas; $i++)  {
            $IdProducto_Carro = $Carrito_Actual[$i]['idproducto'];

          if ($IdProducto_Carro==$IdProducto )      {
              $Carrito_Actual[$i]['cantidad'] = $Carrito_Actual[$i]['cantidad'] + $CantidadComprada;
              $Cantidad_Total                 = $Carrito_Actual[$i]['cantidad'] ;
              $i                              = $Cantidad_Filas+1;
              $Existe_Id_Producto             = true;
              Session::Set($NombreArray,$Cantidad_Total); // CAPTURA EN ARRAY LA CANTIDA DE PRODUCTOS TRON COMPRADOS
            }
          }

         if ($Existe_Id_Producto==false)
          {
            array_push($Carrito_Actual, $Ultima_Compra);
          }

        $_SESSION['carrito'] = $Carrito_Actual;

        $this->Depurar_Carrito();
        $this->Complementar_Datos_Productos_Carrito($ProdTron,$ProdTronAcc );
        $this->Hallar_Valor_Escalas_Productos();
        $this->Totalizar_Carrito();
        $this->Retornar_Totales_Carro_Json();
    }



    public function Retornar_Totales_Carro_Json()  {
      $SubTotal_Pedido_Amigos        =  "$ ".number_format($this->SubTotal_Pedido_Amigos ,0,"",".");
      $SubTotal_Pedido_Ocasional     =  "$ ".number_format($this->SubTotal_Pedido_Ocasional ,0,"",".");
      // DATOS DE PRODUCTOS TRON
      $descuento_especial            =  "$ ".number_format(Session::Get('descuento_especial'),0,"",".");
      $descuento_especial_porcentaje =  Session::Get('descuento_especial_porcentaje');
      $descuento_especial_porcentaje =  number_format((float)$descuento_especial_porcentaje, 2, '.', '') .'%';

      $vr_unitario_ropa              =  "$ ".number_format(Session::Get('vr_unitario_ropa'),0,"",".");
      $vr_unitario_banios            =  "$ ".number_format(Session::Get('vr_unitario_banios'),0,"",".");
      $vr_unitario_pisos             =  "$ ".number_format(Session::Get('vr_unitario_pisos'),0,"",".");
      $vr_unitario_loza              =  "$ ".number_format(Session::Get('vr_unitario_loza'),0,"",".");

      $pv_tron_resumen               =  "$ ".number_format(Session::Get('pv_tron_resumen'),0,"",".");
      $pv_ocas_resumen               =  "$ ".number_format(Session::Get('pv_ocas_resumen'),0,"",".");

      $Datos    = compact('SubTotal_Pedido_Amigos','SubTotal_Pedido_Ocasional','descuento_especial','descuento_especial_porcentaje',
                          'vr_unitario_ropa','vr_unitario_banios','vr_unitario_pisos','vr_unitario_loza',
                          'pv_ocas_resumen','pv_tron_resumen');
      echo json_encode($Datos,256);
    }


    public function Complementar_Datos_Productos_Carrito($ProdTron=false, $ProdTronAcc=false) {
      /** ENERO 07 DE 2015
      * COMPLEMENTA LOS DATOS NECESARIOS DE PRODUCTOS EN EL CARRO DE COMPRAS PARA REALIZAR TODAS LAS OPERACIONES CORRESPONDIENTES
      * Y POSTERIORMENTE FINALIZAR EL PEDIDO
      */
        if (!isset($_SESSION['carrito']))
        {
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
                                      'peso_gramos'=>0,'tipo_despacho'=>0,'ppto_fletes'=>0, 'ppto_fletes_escala_a'=>0, 'ppto_fletes_escala_b'=>0,
                                       'ppto_fletes_escala_c'=>0, 'costo_sin_iva'=>0,'fabricado_x_ta'=>0,'idescala'=>0, 'idescala_dt'=>0,
                                       'iva' =>0,'cmv'=>0,'idgrupo'=>0,'id_agrupacion'=>0,'idpresentacion'=>0, 'nompresentacion'=>'','fragancia'=>'',
                                        'nombre_imagen'=>'','pv_tron_escala_a'=>0, 'pv_tron_escala_b'=>0, 'pv_tron_escala_c'=>0,
                                        'sub_total_pv_ocasional'=>0, 'sub_total_pv_tron'=>0,'posicion_escala'=>0,
                                        'es_tron'=>false, 'es_tron_acc'=>false,'es_industrial'=>false,
                                        'costofijo'=>0, 'costovariable'=>0,'correctorvariacion'=>0,'descuentomaximo'=>0,
                                        'vrpedidominimo_con_dscto'=>0, 'porciento_recaudador'=>0,
                                        'dscto_precio_mercado_1_ropa'=>0, 'dscto_precio_mercado_2_banos'=>0,
                                        'dscto_precio_mercado_3_pisos'=>0, 'dscto_precio_mercado_4_loza'=>0,
                                        'id_categoria_producto'=>0, 'margen_bruta_inicial'=>0 , 'valor_declarado'=>0,
                                        'precio_unitario_produc_pedido'=>0, 'precio_total_produc_pedido'=>0, 'sub_total_pedido_Tron'=>0,
                                        'sub_total_pedido_Otros'=>0, 'codigo_grupo'=>'', 'pv_tron_real'=>0,
                                        'precio_venta_antes_iva'=>0, 'peso_gramos_total'=>0, 'vr_ppto_fletes'=>0,
                                        'vr_anticipo_recaudo'=>0,'precio_venta_antes_iva_tron'=>0, 'precio_venta_antes_iva_ocasional'=>0,
                                        'vr_ppto_fletes_tron'=>0, 'vr_ppto_fletes_ocas'=>0, 'vr_anticipo_recaudo_tron'=>0,
                                        'vr_anticipo_recaudo_ocas'=>0, 'precio_kit_ocasional'=>0, 'precio_kit_tron'=>0);

        if (!isset( $Parametros)) {
          $Parametros = $this->Parametros->Consultar();
        }



        $CarroFinalCompleto = array();
        $Datos_Carro        = $_SESSION['carrito'];
        foreach ($Datos_Carro as $ProductosCarro) {
            $Cantidad     = $ProductosCarro['cantidad'] ;
            $IdProducto   = $ProductosCarro['idproducto'];

            if ($Cantidad>0)   {
                $ProductoComprado                       = $this->Productos->Buscar_por_IdProducto($IdProducto );

                $CarroTemporal['idproducto']            = $IdProducto;
                $CarroTemporal['cantidad']              = $Cantidad ;

                $CarroTemporal['cmv']                    = $ProductoComprado[0]['cmv'];
                $CarroTemporal['costo_sin_iva']          = $ProductoComprado[0]['costo_sin_iva'];
                $CarroTemporal['fabricado_x_ta']         = $ProductoComprado[0]['fabricado_x_ta'];
                $CarroTemporal['id_agrupacion']          = $ProductoComprado[0]['id_agrupacion'];
                $CarroTemporal['idescala']               = $ProductoComprado[0]['idescala'];;
                $CarroTemporal['idescala_dt']            = 0;
                $CarroTemporal['idgrupo']                = $ProductoComprado[0]['idgrupo'];
                $CarroTemporal['codigo_grupo']                = $ProductoComprado[0]['codigo_grupo'];
                $CarroTemporal['idtipo_producto']        = $ProductoComprado[0]['idtipo_producto'];
                $CarroTemporal['id_categoria_producto']  = $ProductoComprado[0]['id_categoria_producto'];
                $CarroTemporal['idpresentacion']         = $ProductoComprado[0]['idpresentacion'];


                $CarroTemporal['iva']                    = $ProductoComprado[0]['iva'];
                $CarroTemporal['nom_producto']           = $ProductoComprado[0]['nom_producto'];
                $CarroTemporal['nombre_imagen']          = $ProductoComprado[0]['nombre_imagen'];
                $CarroTemporal['nompresentacion']        = $ProductoComprado[0]['nompresentacion'];
                $CarroTemporal['fragancia']              = $ProductoComprado[0]['fragancia'];

                $CarroTemporal['peso_gramos']            = $ProductoComprado[0]['peso_gramos'];
                $CarroTemporal['ppto_fletes']            = $ProductoComprado[0]['ppto_fletes'] /100;
                $CarroTemporal['ppto_fletes_escala_a']   = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['ppto_fletes_escala_b']   = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['ppto_fletes_escala_c']   = $ProductoComprado[0]['ppto_fletes'] / 100;


                $CarroTemporal['pv_ocasional']           = $ProductoComprado[0]['pv_ocasional'];
                $CarroTemporal['pv_tron']                = $ProductoComprado[0]['pv_tron'];
                $CarroTemporal['pv_tron_real']           = $ProductoComprado[0]['pv_tron'];
                $CarroTemporal['precio_kit_ocasional']   = $ProductoComprado[0]['pv_ocasional'];
                $CarroTemporal['precio_kit_tron']        = $ProductoComprado[0]['pv_tron'];

                $CarroTemporal['pv_tron_escala_a']       = $ProductoComprado[0]['pv_tron_escala_a'];
                $CarroTemporal['pv_tron_escala_b']       = $ProductoComprado[0]['pv_tron_escala_b'];
                $CarroTemporal['pv_tron_escala_c']       = $ProductoComprado[0]['pv_tron_escala_c'];
                $CarroTemporal['tipo_despacho']          = $ProductoComprado[0]['tipo_despacho'];
                $CarroTemporal['margen_bruta_inicial']   = $ProductoComprado[0]['margen_bruta_inicial'] / 100 ;

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




