
<?php


class CarritoController extends Controller
{
     private $Carrito_Vacio             = false;
     private $Cantidad_Filas_Carrito    = 0;
     private $Datos_Carro;

     private $SubTotal_Pedido_Amigos    = 0;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
     private $SubTotal_Pedido_Ocasional = 0;
     private $SubTotal_Pedido_Real      = 0;
     private $Vr_Fletes                 = 0;
     private $Presupuesto_Fletes        = 0;
     private $Vr_Recaudo                = 0;
     private $Vr_Transporte             = 0;
     private $Vr_Total_Pedido_Amigos    = 0;
     private $Vr_Total_Pedido_Real      = 0;
     private $Vr_Base_Iva               = 0;

     private $Peso_Total_Pedido_Kilos   = 0;
     private $Carrito_Habilitado        = false;
     // VARIABLES PARA PRODUCTOS TRON
     private $Tron_Peso_Total_Gramos    = 0;
     private $Tron_Cmv_Total            = 0;
     private $Tron_Precio_Lista_Total   = 0;
     //VARIABLES PARA OPERACIONES TOTALES EN EL CARRITO
     private $Saldo_Puntos_Cantidad     = 0;
     private $Saldo_Comisiones          = 0;
     private $Vr_Cupon_Descuento        = 0;


     private $Vr_Transporte_Tron        = 0;
     private $Vr_Transporte_Cliente     = 0; // CONTIENE LA SUMA DE TRANSPORTE TRON Y TRANSPORTE OTROS PRODUCTOS

     private $Vr_Total_Pedido_Ocasional = 0;
     private $Vr_Total_Pedido_Tron      = 0;
     private $Valor_Declarado           = 0;
     private $Cant_Unidades_Despacho    = 0;
     private $compras_tron              = 0;
     private $compras_industrial        = 0;
     private $compras_otros_productos   = 0;
     private $compras_accesorios        = 0;

     private $PayuLatam_Recaudo         = 0;
     private $PayuLatam_Valor_Minimo    = 0;
     private $PayuLatam_Valor_Adicional = 0;



    public function __construct()
    {
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



    public function Finalizar_Pedido_Forma_Pago()
    {
      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_carrito_forma_pago','tron_estilos_linea_tiempo'));
      $this->View->Mostrar_Vista('finalizar_pedido_forma_pago');
    }



    public function Finalizar_Pedido_Finalizar_Direccion()
    {
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

    public function Finalizar_Pedido_Direccion_Final()
    {/**  MARZO 04 DE 2015
      *   REALIZA EL CAMBIO DE LOS DATOS DE UBICACIÓN PARA ENTREGA DEL PEDIDO
      */
     $IdDireccion_Despacho =  General_Functions::Validar_Entrada('iddirecciondespacho','NUM');
     $IdMcipio             =  General_Functions::Validar_Entrada('idmcipio','NUM');
     $IdDpto               =  General_Functions::Validar_Entrada('iddpto','NUM');
     $Re_Expedicion        =  General_Functions::Validar_Entrada('reexpedicion','BOL');

     $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($IdDireccion_Despacho);

    }

    public function Finalizar_Pedido_Direccion_Envio()
    {
      /** FEBRERO 28 DE 2015
          DETERMINA EL SIGUIENTE PASO EN LA FINALIZACIÓN DEL PEDIDO.  IDENTIFICACION O CONFIRMACIÓN DE ENVÍO
      */
      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_barra_usuarios','tron_estilos_linea_tiempo'));
      $this->View->Direcciones   = $this->Terceros->Direcciones_Despacho();
      $this->View->Departamentos = $this->Departamentos->Consultar();
      $this->View->Mostrar_Vista('finalizar_pedido_direccion');

    }

    public function Finalizar_Pedido_Direccion_Cambio_Usuario()
    {
      $Idtercero            =  General_Functions::Validar_Entrada('idtercero','NUM');
      $Cantidad_Direcciones =  General_Functions::Validar_Entrada('cantidad_direcciones','NUM');
      Session::Set('idtercero_pedido',$Idtercero );
      Session::Set('iddireccion_despacho',   0 ); // REESTABLECEMOS PARA VALIDAR QUE SEA SELECCIONADA DE NUEVO
      Session::Set('cantidad_direcciones', $Cantidad_Direcciones);
      echo "OK";
    }


    public function Finalizar_Pedido_Direccion_Mostrar_Direcciones()
    {
        $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
        $this->View->SetCss(array('tron_carrito','tron_carrito_confi_envio','tron_carrito_identificacion','tron_barra_usuarios','tron_estilos_linea_tiempo'));
        $this->View->Direcciones = $this->Terceros->Direcciones_Despacho();
         Session::Set('iddireccion_despacho',   0 );
        $this->View->Mostrar_Vista_Parcial('finalizar_pedido_direccion_usuario');
    }

    public function Finalizar_Pedido_Identificacion()
    {
        /** FEBRERO 28 DE 2015
          DETERMINA EL SIGUIENTE PASO EN LA FINALIZACIÓN DEL PEDIDO.
          IDENTIFICACION O CONFIRMACIÓN DE ENVÍO
      */

      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_identificacion','tron_carrito_confi_envio','tron_barra_usuarios','tron_estilos_linea_tiempo'));
      $this->View->Departamentos = $this->Departamentos->Consultar();
      if (Session::Get('autenticado')==false) {
        Session::Set('finalizar_pedido_siguiente_paso','DIRECCION');
        $this->View->Mostrar_Vista('finalizar_pedido_identificacion');
      }else      {
        $this->View->Direcciones = $this->Terceros->Direcciones_Despacho();
        Session::Set('iddireccion_despacho',   0 );
        $this->View->Mostrar_Vista('finalizar_pedido_direccion');
      }

    }



    private function Iniciar_Procesos_Carro()
    {
        $this->Cantidad_Filas_Carrito     = 0;
        $this->Carrito_Habilitado         = false;
        $this->Carrito_Vacio              = false;
        if (isset($_SESSION['carrito']))
        {
          $this->Datos_Carro                = $_SESSION['carrito'];
          $this->Cantidad_Filas_Carrito     = count($this->Datos_Carro  );
          $this->Carrito_Habilitado         = true;

          if ($this->Cantidad_Filas_Carrito ==0)
          {
            $this->Cantidad_Filas_Carrito     = 0;
            $this->Carrito_Vacio = true;
          }
        }

    }

    private function Cerrar_Procesos_Carro()
    {
      $_SESSION['carrito']     = $this->Datos_Carro ;
    }



    public  function Borrar_Producto_Carrito()
    {
      /** ENERO 15 DE 2015
      *   BORRA UN PRODUCTO INDICADO POR EL USUARIO
      */
      $this->Iniciar_Procesos_Carro();

      $IdProducto        = General_Functions::Validar_Entrada('IdProducto','NUM');
      $Cantidad          = General_Functions::Validar_Entrada('Cantidad','NUM');
      $i                 = 0;
      $NombreArray       = 'TRON'.$IdProducto;              // CAPTURA CANTIDAD DE PRODUCTO TRON COMPRADO

      foreach ($this->Datos_Carro as $key => $productos)
      {
        if ($productos['idproducto'] == $IdProducto)
        {
            $cantidad_producto = $this->Datos_Carro[$key]['cantidad'];
            $cantidad_producto = $cantidad_producto - $Cantidad;
            Session::Set($NombreArray,$cantidad_producto);
            if ($cantidad_producto <= 0)
            {
              array_splice($this->Datos_Carro, $i, 1);
              Session::Set($NombreArray,0);
            }else
            {
             $this->Datos_Carro[$key]['cantidad'] = $cantidad_producto;
            }
        }
        $i++;
      }
      Session::Destroy('CarritoTron');
      $this->Cerrar_Procesos_Carro();
      $this->Hallar_Valor_Escalas_Productos();
      $this->Totalizar_Carrito();
      $this->Retornar_Totales_Carro_Json();

    }


    private function Depurar_Carrito()
    {
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



    public function Mostrar_Carrito()
    {
      /** ENERO 22 DE 2015
      *   MUSTRA EL CARRITO,LUEGO DE AGREGARLE PRODUCTOS
      */

      $Tipo_Vista = $this->View->Argumentos[0]; // 1 = VISTA CARRO PIRNCIPAL   2= VISTA DE CARRO PARCIAL, AJAX
      $this->Iniciar_Procesos_Carro();
      $this->View->cumple_condicion_cpras_tron_industial = Session::Get('cumple_condicion_cpras_tron_industial');

      $this->View->SetJs(array('tron_carrito','tron_productos.jquery','tron_pasos_pagar'));
      $this->View->SetCss(array('tron_carrito' , 'tron_carrito_pgn','tron_carrito_vacio','tron_carrito_linea_tiempo', 'tron_carrito_confi_envio'));

      if ($this->Cantidad_Filas_Carrito == 0)
      {
        if ($Tipo_Vista==1)
        {
          $this->View->Mostrar_Vista('carrito_vacio');
        }
        if ($Tipo_Vista==2)
        {
          $this->View->Mostrar_Vista_Parcial('carrito_vacio');
        }
      }

     if ($this->Cantidad_Filas_Carrito > 0)
      {
        $this->Hallar_Valor_Escalas_Productos();
        $this->Totalizar_Carrito();
        $this->View->Datos_Carro                = $_SESSION['carrito'];
        $this->View->Saldo_Puntos_Cantidad      = $this->Saldo_Puntos_Cantidad;
        $this->View->Saldo_Comisiones           = $this->Saldo_Comisiones;
        $this->View->SubTotal_Pedido_Ocasional  = $this->SubTotal_Pedido_Ocasional;
        $this->View->SubTotal_Pedido_Amigos     = $this->SubTotal_Pedido_Amigos;
        $this->View->Vr_Cupon_Descuento         = $this->Vr_Cupon_Descuento;
        $this->View->Vr_Transporte_Otros        = $this->Vr_Transporte;
        $this->View->Vr_Total_Pedido_Ocasional  = $this->Vr_Total_Pedido_Ocasional;
        $this->View->Vr_Total_Pedido_Tron       = $this->Vr_Total_Pedido_Amigos;
        $this->View->Vr_Transporte_Cliente      = $this->Vr_Transporte;


        if ($Tipo_Vista==1)  // SE CARGA LA VISTA PRINCIPAL DE CARRO DE COMPRAS
          {
            $this->View->Mostrar_Vista('mostrar_carrito');
          }
        if ($Tipo_Vista==2) // SE CARGA LA VISTA ACTUALIZADA ( PARCIAL ) DE CARRO DE COMPRAS ( AJAX)
          {
            Session::Set('imagen_resumen_pedido',FALSE);
            $this->View->Mostrar_Vista_Parcial('mostrar_carrito_actualizado');
          }
      }
    }


    public function Totalizar_Carrito()
    {
      /** ENERO 15 DE 2015
      *   CALCULA LOS TOTALES EN EL CARRITO DE COMPRAS
      */
      $this->Depurar_Carrito();
      $this->Iniciar_Procesos_Carro();
      $i                               = 0 ;
      $this->SubTotal_Pedido_Amigos    = 0 ;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
      $this->SubTotal_Pedido_Ocasional = 0 ;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
      $this->Peso_Total_Pedido_Kilos   = 0 ;
      $this->Valor_Declarado           = 0 ;

      $this->Tron_Peso_Total_Gramos    = 0 ;
      $this->Tron_Cmv_Total            = 0 ;
      $this->Tron_Precio_Lista_Total   = 0 ;

      $this->compras_tron               = 0 ;     $this->compras_industrial         = 0 ;      $this->compras_otros_productos    = 0 ;     $this->compras_accesorios         = 0 ;

      $tengo_productos_tron             = FALSE ;
      $aplica_vr_recaudo                = FALSE;

      $Cantidad_Ropa       =  0 ; $Cantidad_Banios     =  0 ;         $Cantidad_Pisos      =  0 ;     $Cantidad_Loza       =  0 ;
      $Peso_Ropa           =  0 ; $Peso_Banios         =  0 ;         $Peso_Pisos          =  0 ;     $Peso_Loza           =  0 ;
      $Cmv_Ropa            =  0 ; $Cmv_Banios          =  0 ;         $Cmv_Pisos           =  0 ;     $Cmv_Loza            =  0 ;
      $Precio_Lista_Ropa   =  0 ; $Precio_Lista_Banios =  0 ;         $Precio_Lista_Pisos  =  0 ;     $Precio_Lista_Loza   =  0 ;

      Session::Set('precio_especial', 0);
      Session::Set('transporte_tron',0);
      Session::Set('descuento_especial',0);
      Session::Set('descuento_especial_porcentaje', 0);
      Session::Set('vr_unitario_ropa',0);
      Session::Set('vr_unitario_banios',0);
      Session::Set('vr_unitario_pisos',0);
      Session::Set('vr_unitario_loza',0);


      if ($this->Carrito_Habilitado == false)
      {
        return ;
      }

       foreach ($this->Datos_Carro as $Productos)
        {
          $cantidad                            = $Productos['cantidad'];
          $id_categoria_producto               = $Productos['id_categoria_producto'];
          $peso_gramos                         = $Productos['peso_gramos'] * 1000 ;
          $cmv                                 = $Productos['cmv'];
          $pv_ocasional                        = $Productos['pv_ocasional'];
          $peso_total_producto                 = ($Productos['peso_gramos'] * $cantidad)  / 1000   ;
          $Productos['sub_total_pv_ocasional'] = $Productos['cantidad']     * $Productos['pv_ocasional'];
          $Productos['sub_total_pv_tron']      = $Productos['cantidad']     * $Productos['pv_tron'] ;

          $this->SubTotal_Pedido_Ocasional    = $this->SubTotal_Pedido_Ocasional   + $Productos['sub_total_pv_ocasional'] ;
          $this->SubTotal_Pedido_Amigos       = $this->SubTotal_Pedido_Amigos      + $Productos['sub_total_pv_tron'] ;
          $this->Peso_Total_Pedido_Kilos      = $this->Peso_Total_Pedido_Kilos     + $peso_total_producto ;


          if ($Productos['idtipo_producto'] != 'PRD' ) // PRODUCTOS QUE NO SON TRON ( OTROS, ACC, INDUSTRIALES, PROMOCIONALES)
          {
              $this->Tron_Peso_Total_Gramos  = $this->Tron_Peso_Total_Gramos    + $peso_total_producto  ;
              $this->Tron_Cmv_Total          = $this->Tron_Cmv_Total            + $Productos['cmv'];
              $this->Tron_Precio_Lista_Total = $this->Tron_Precio_Lista_Total   + $Productos['sub_total_pv_tron'] ;
              $aplica_vr_recaudo = TRUE;
              if ( $id_categoria_producto == 7 ){
                  $this->Valor_Declarado  =     $this->Valor_Declarado  + $Productos['cmv'] * $cantidad ;
                }
              if ( $id_categoria_producto == 6 ){
                  $this->Valor_Declarado  =    $this->Valor_Declarado +  $Productos['sub_total_pv_tron'] / 2 ;
              }
           }
            // COMPRAS POR CADA TIPO DE PRODUCTO
          if ( $id_categoria_producto >= 1 and  $id_categoria_producto <= 4)
          {
             $tengo_productos_tron = TRUE;
             $this->compras_tron  = $this->compras_tron + $Productos['sub_total_pv_tron'] ;
              // CALCULO CANTIDADES Y PESOS DE LOS PRODUCTOS TRON ( 1= ROPA   2 = BAÑOS   3 = PISOS       4 = LOZA)
             if ( $id_categoria_producto == 1) {
                $Cantidad_Ropa     = $Cantidad_Ropa     + $cantidad ;
                $Peso_Ropa         = $Peso_Ropa         + ( $peso_gramos *  $cantidad  );
                $Cmv_Ropa          = $Cmv_Ropa          + ( $cmv         *  $cantidad );
                $Precio_Lista_Ropa = $Precio_Lista_Ropa + ( $pv_ocasional *  $cantidad );
             }
             if ( $id_categoria_producto == 2) {
                $Cantidad_Banios = $Cantidad_Banios + $cantidad ;
                $Peso_Banios     = $Peso_Banios     + ( $peso_gramos *  $cantidad  );
                $Cmv_Banios      = $Cmv_Banios      + ( $cmv         * $cantidad );
                $Precio_Lista_Banios = $Precio_Lista_Banios + ( $pv_ocasional *  $cantidad );
             }
             if ( $id_categoria_producto == 3) {
                $Cantidad_Pisos = $Cantidad_Pisos + $cantidad ;
                $Peso_Pisos     = $Peso_Pisos     + ( $peso_gramos *  $cantidad  );
                $Cmv_Pisos      = $Cmv_Pisos      + ( $cmv         * $cantidad );
                $Precio_Lista_Pisos = $Precio_Lista_Pisos + ( $pv_ocasional *  $cantidad );
             }
             if ( $id_categoria_producto == 4) {
                $Cantidad_Loza = $Cantidad_Loza + $cantidad ;
                $Peso_Loza     = $Peso_Loza     + ( $peso_gramos *  $cantidad  );
                $Cmv_Loza      = $Cmv_Loza      + ( $cmv         * $cantidad );
                $Precio_Lista_Loza = $Precio_Lista_Loza + ( $pv_ocasional *  $cantidad );
             }

            if ( $id_categoria_producto == 6) {  // Industriales
                $this->compras_industrial = $this->compras_industrial  + $Productos['sub_total_pv_tron'] ;
            }
        }
      }

        if ( $tengo_productos_tron == TRUE) {
            $datos=compact('Cantidad_Ropa','Peso_Ropa','Cmv_Ropa','Precio_Lista_Ropa',
                         'Cantidad_Banios','Peso_Banios','Cmv_Banios','Precio_Lista_Banios',
                         'Cantidad_Pisos','Peso_Pisos','Cmv_Pisos','Precio_Lista_Pisos',
                         'Cantidad_Loza','Peso_Loza','Cmv_Loza','Precio_Lista_Loza');
          $this->Productos_Tron->Hallar_Precio_Especial( $this->Parametros->Transportadoras(), $datos);
        }

        $this->Determinar_Precio_Real_Producto( $this->compras_tron , $this->compras_industrial );
        $this->Totalizar_Pedido_x_Categoria_Producto();              // Totaliza categorias de productos, para grabar en el pedido
        $this->Calcular_Flete($this->Valor_Declarado );
        $this->Encontrar_Mejor_Flete();
        $this->Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon();
        $this->Calcular_Valor_Recaudo($aplica_vr_recaudo);


        //TOTALES DEL CARRITO
        //-----------------------
        $Suma_Conceptos = $this->Vr_Fletes - $this->Presupuesto_Fletes + $this->Vr_Recaudo;
        if ( $Suma_Conceptos < 0 ){
            $Suma_Conceptos = 0;
        }
        $this->Vr_Total_Pedido_Ocasional =  $this->SubTotal_Pedido_Ocasional + $Suma_Conceptos;
        $this->Vr_Total_Pedido_Amigos    =  $this->SubTotal_Pedido_Amigos    + $Suma_Conceptos;
        $this->Vr_Total_Pedido_Real      =  $this->SubTotal_Pedido_Real      + $Suma_Conceptos;
        $this->Vr_Transporte             =  $this->Vr_Total_Pedido_Real - $this->SubTotal_Pedido_Real   ;
        if ( $this->Vr_Transporte   < 0){
          $this->Vr_Transporte   = 0;
        }
        $this->Vr_Base_Iva               = $this->Vr_Base_Iva + $this->Vr_Transporte ;
        Session::Set('Peso_Total_Pedido_Kilos',   $this->Peso_Total_Pedido_Kilos);
        Session::Set('SubTotal_Pedido_Ocasional', $this->SubTotal_Pedido_Ocasional );
        Session::Set('SubTotal_Pedido_Amigos',    $this->SubTotal_Pedido_Amigos );
        Session::Set('presupuesto_flete_otros',   $this->Presupuesto_Fletes );
        Session::Set('Vr_Transporte',             $this->Vr_Transporte);
        Session::Set('Vr_Total_Pedido_Real',      $this->Vr_Total_Pedido_Real);
        Session::Set('Vr_Recaudo',                $this->Vr_Recaudo);
        Session::Set('Vr_Base_Iva', $this->Vr_Base_Iva);

        $this->Peso_Total_Pedido_Kilos   = (int)$this->Peso_Total_Pedido_Kilos ;

        $this->Cerrar_Procesos_Carro();
    }

  public function Determinar_Precio_Real_Producto($compras_tron,$compras_industrial)
    { /** MARZO 20 DE 2015
      *     DETERMINA EL PRECIO A DAR POR LA COMPRA ACTUAL TENIENDO EN CUENTA LOS MÍNIMOS DE COMPRA PARA PRODUCTOS TRON
      */
      $CarritoTron                = array();
      $precio_unitario_producto   = 0;
      $precio_total_producto      = 0;
      $sub_total_pedido_Tron      = 0;
      $sub_total_pedido_Otros     = 0;
      $this->SubTotal_Pedido_Real = 0 ;
      $this->Presupuesto_Fletes   = 0;
      $this->Vr_Base_Iva          = 0;

      Session::Set('compra_productos_tron',0);
      Session::Set('compra_productos_industriales',0);
      Session::Set('compra_otros_productos',0);
      Session::Set('compra_accesorios',0);
      Session::Set('cumple_condicion_cpras_tron_industial', FALSE);

      $Logueado                             = Session::Get('autenticado');
      $Cumple_Condic_Cpras_Tron_Industial   = Session::Get('cumple_condicion_cpras_tron_industial');
      $compra_minima_productos_tron         = Session::Get('minimo_compras_productos_tron');
      $compra_minima_productos_industriales = Session::Get('minimo_compras_productos_ta');
      $compras_este_mes_tron                = Session::Get('compras_productos_tron');
      $compras_este_mes_industiales         = Session::Get('compras_productos_fabricados_ta');

      $this->Iniciar_Procesos_Carro();
      $i      = 0;
      $i_tron = 0 ;
      $pv_tron_resumen = 0;
      $pv_ocas_resumen = 0;

      for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)
       {
           $id_categoria_producto  = $this->Datos_Carro [$i]['id_categoria_producto'];
           $cantidad               = $this->Datos_Carro [$i]['cantidad'];
           $porciento_iva          = 1 + $this->Datos_Carro [$i]['iva']/100;
           $porciento_ppto_fletes  = $this->Datos_Carro[$i]['ppto_fletes'];
           $costo_sin_iva          = $this->Datos_Carro[$i]['cmv'];
           $pv_tron                = $this->Datos_Carro[$i]['pv_tron'];

           if ( $id_categoria_producto == 1){
                $this->Datos_Carro[$i]['pv_tron'] = Session::Get('vr_unitario_ropa');
            }
           if ( $id_categoria_producto == 2){
                $this->Datos_Carro[$i]['pv_tron'] = Session::Get('vr_unitario_banios');
            }
           if ( $id_categoria_producto == 3){
                $this->Datos_Carro[$i]['pv_tron'] = Session::Get('vr_unitario_pisos');
            }
           if ( $id_categoria_producto == 4){
                $this->Datos_Carro[$i]['pv_tron'] = Session::Get('vr_unitario_loza');
            }



           if ( $this->Datos_Carro [$i]['cantidad'] > 0 )
           {
            // INCLUIR LAS COMPRAS DE ESTE PEDIDO Y ESTABLECER SI CUMPLE CONDICIONES DE COMPRAS MINIMAS
            if ( (( $compras_este_mes_tron        + $compras_tron       )  >= $compra_minima_productos_tron ||
                 ( $compras_este_mes_industiales  + $compras_industrial )  >= $compra_minima_productos_industriales) )
              {
                Session::Set('cumple_condicion_cpras_tron_industial', TRUE);
                $Cumple_Condic_Cpras_Tron_Industial   = TRUE;
              }else
              {
                Session::Set('cumple_condicion_cpras_tron_industial', FALSE);
                $Cumple_Condic_Cpras_Tron_Industial   = FALSE;
              }

              if ($Cumple_Condic_Cpras_Tron_Industial  == FALSE)
              {
                $precio_unitario_producto  = $this->Datos_Carro[$i]['pv_ocasional'];
              }else
              {
                $precio_unitario_producto  = $this->Datos_Carro[$i]['pv_tron'];
            }

          $this->Datos_Carro[$i]['precio_unitario_produc_pedido'] = $precio_unitario_producto;
          $this->Datos_Carro[$i]['precio_total_produc_pedido']    = $precio_unitario_producto * $cantidad;
          $base_iva                                               = $this->Datos_Carro[$i]['precio_total_produc_pedido'] / $porciento_iva;
          $this->SubTotal_Pedido_Real                             = $this->SubTotal_Pedido_Real + $precio_unitario_producto *$cantidad;
          $sub_total_pedido_Tron                                  = $sub_total_pedido_Tron  + $pv_tron * $cantidad  ;
          $this->Datos_Carro[$i]['sub_total_pedido_Tron']         = $sub_total_pedido_Tron;


          $this->Vr_Base_Iva                   = $this->Vr_Base_Iva  + $base_iva;


          if ( $id_categoria_producto >= 1 and $id_categoria_producto <= 5)
          {
             $CarritoTron[$i_tron]['cantidad']               = $this->Datos_Carro [$i]['cantidad'] ;
             $CarritoTron[$i_tron]['pv_tron']                = $this->Datos_Carro [$i]['pv_tron'] ;
             $CarritoTron[$i_tron]['pv_ocasional']           = $this->Datos_Carro [$i]['pv_ocasional'] ;
             $CarritoTron[$i_tron]['nom_producto']           = $this->Datos_Carro [$i]['nom_producto'] ;
             $CarritoTron[$i_tron]['idproducto']             = $this->Datos_Carro [$i]['idproducto'] ;
             //
             $pv_tron_resumen     = $pv_tron_resumen + ( $CarritoTron[$i_tron]['pv_tron'] * $CarritoTron[$i_tron]['cantidad'] );
             $pv_ocas_resumen     = $pv_ocas_resumen + ( $CarritoTron[$i_tron]['pv_tron'] * $CarritoTron[$i_tron]['cantidad'] );

             $i_tron ++;
          } else
          {
            $sub_total_pedido_Otros                          = $sub_total_pedido_Otros  + $this->Datos_Carro[$i]['precio_total_produc_pedido'] ;
            $this->Datos_Carro[$i]['sub_total_pedido_Otros'] = $sub_total_pedido_Otros ;
            $this->Presupuesto_Fletes  = $this->Presupuesto_Fletes + ( $costo_sin_iva  *  $porciento_ppto_fletes  );
          }
        }

        Session::Set('sub_total_pedido_Tron' ,  $sub_total_pedido_Tron);
        Session::Set('sub_total_pedido_Otros' , $sub_total_pedido_Otros);
        Session::Set('CarritoTron',$CarritoTron);
        //
        Session::Set('pv_tron_resumen',$pv_tron_resumen);
        Session::Set('pv_ocas_resumen',$pv_ocas_resumen);





        $this->SubTotal_Pedido_Amigos = $sub_total_pedido_Tron;
        $this->Cerrar_Procesos_Carro();

      }
    }




    public function Totalizar_Pedido_x_Categoria_Producto()
    {/** MARZO 19 DE 2015
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
      for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)
       {
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


      Session::Set('compra_productos_tron',$this->compras_tron);
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


    public function Calcular_Flete( $valor_declarado)
    {/** MARZO 09 DE 2015
      *     REALIZA CALCULO DEL VALOR DEL FLETE DE LAS DIFERNTES TRANSPORTADORAS QUE TENEMOS
      */
      $this->Cant_Unidades_Despacho = 0;
      $peso_kilos_pedido            = 0;

      $Fletes_Cobrados_Transportadoras = array(array('idtercero'=>0, 'valor_flete'=>0, 'aplica'=>FALSE,
                                               'transportador'=>'', 'tipo_tarifa'=>'','tipo_despacho'=>0));
      Session::Set('Fletes_Cobrados_Transportadoras',$Fletes_Cobrados_Transportadoras);

      $peso_kilos_pedido  = Session::Get('peso_productos_industriales') + Session::Get('peso_otros_productos') + Session::Get('peso_accesorios');
      $peso_kilos_pedido  = $peso_kilos_pedido /1000;  // PASAR A KILOS

      if ( $valor_declarado >0 ){
        $this->Fletes->Redetrans_Courrier         ($peso_kilos_pedido,$valor_declarado);
        $this->Fletes->Redetrans_Carga            ($peso_kilos_pedido,$valor_declarado);
        $this->Fletes->Servientrega_Industrial    ($peso_kilos_pedido,$valor_declarado);
        $this->Fletes->Sevientrega_Premier        ($peso_kilos_pedido,$valor_declarado);
      }

    }



    public function Encontrar_Mejor_Flete()
      {/**  MARZO 12 DE 2015
      *       VERIFICA DE LOS FLETES ENCONTRADOS EL MEJOR PARA ASIGNARLO AL PEDIDO
      */
      $i                               = 0;
      $Fletes_Cobrados_Transportadoras = Session::Get('Fletes_Cobrados_Transportadoras');
      $Asignar_Flete                   = TRUE;
      $this->Vr_Fletes                 = 0;

      foreach ($Fletes_Cobrados_Transportadoras as $Fletes)
      {
        if ($Fletes['valor_flete'] >0 )
        {
            if ($Asignar_Flete == TRUE)
            {
              $Mejor_Flete                     = $Fletes_Cobrados_Transportadoras[$i];
              $Asignar_Flete = FALSE;
            }
            if ($Fletes['valor_flete'] < $Mejor_Flete['valor_flete'] )
            {
                $Mejor_Flete['idtercero']     = $Fletes['idtercero']   ;
                $Mejor_Flete['valor_flete']   = $Fletes['valor_flete'] ;
                $Mejor_Flete['tipo_tarifa']   = $Fletes['tipo_tarifa'] ;
                $Mejor_Flete['tipo_despacho'] = $Fletes['tipo_despacho'] ;
            }
        }
      }
      if ( isset($Mejor_Flete)){
          $this->Vr_Fletes                  = $Mejor_Flete['valor_flete'] + Session::Get('transporte_tron');
          Session::Set('flete_cobrado_otros', $this->Vr_Fletes);
          Session::Set('id_transportadora',   $Mejor_Flete['idtercero']);
          Session::Set('tipo_despacho_pedido', $Mejor_Flete['tipo_despacho'] );
          Session::Set('tipo_tarifa', $Mejor_Flete['tipo_tarifa']);
        }else{
          $this->Vr_Fletes                  = Session::Get('transporte_tron');
          Session::Set('flete_cobrado_otros', $this->Vr_Fletes);
          Session::Set('id_transportadora',   '1572'); // 1572 REDETRANS
          Session::Set('tipo_despacho_pedido', 1 );     /// REDETRANS COURRIER
          Session::Set('tipo_tarifa', 'REDETRANS COURRIER');
        }
    }

    public function Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon()
    {/** FEBRERO 02 DE 2015
      *     REALIZA APLICACION DE DESCUENTOS POR CONCEPTO DE PUNTOS, COMISIONES Y CUPONES DE DESCUENTO
      */

      $Vr_Usado_Cupon_Descuento_Ocasional = 0;
      $Puntos_Utilizados_Ocasional        = 0;
      $Comisiones_Utilizadas_Ocasional    = 0;

      $Vr_Usado_Cupon_Descuento_Tron      = 0;
      $Puntos_Utilizados_Tron             = 0;
      $Comisiones_Utilizadas_Tron         = 0;

      $this->Saldo_Puntos_Cantidad      = Session::Get('saldo_puntos_cantidad');
      $this->Saldo_Comisiones           = Session::Get('saldo_comisiones');
      $this->Vr_Cupon_Descuento         = Session::Get('vr_cupon_descuento');

        $SubTotal_Pedido_Ocasional          = $this->SubTotal_Pedido_Real;  // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS

        // ( 1 ) TOTALES DEL PEDIDO --- APLICACIÓN DE BONO DE DESCUENTO (1) -- COMPRADOR OCASIONAL
        if ($this->Vr_Cupon_Descuento > 0 && $SubTotal_Pedido_Ocasional  > 0 )
        {
          if ($this->Vr_Cupon_Descuento >= $SubTotal_Pedido_Ocasional )
          {
            $SubTotal_Pedido_Ocasional          = 0;
            $Vr_Usado_Cupon_Descuento_Ocasional = $SubTotal_Pedido_Ocasional;
          }else
          {
            $SubTotal_Pedido_Ocasional          = $SubTotal_Pedido_Ocasional - $this->Vr_Cupon_Descuento ;
            $Vr_Usado_Cupon_Descuento_Ocasional = $this->Vr_Cupon_Descuento;
          }
        }

        // ( 2 ) TOTALES DEL PEDIDO --- APLICACIÓN  PUNTOS ( 2 )-- COMPRADOR OCASIONAL
        if ($this->Saldo_Puntos_Cantidad > 0 && $SubTotal_Pedido_Ocasional  > 0 )
        {
          if ($this->Saldo_Puntos_Cantidad >= $SubTotal_Pedido_Ocasional )
          {
            $SubTotal_Pedido_Ocasional          = 0;
            $Puntos_Utilizados_Ocasional        = $SubTotal_Pedido_Ocasional;
          }else
          {
            $SubTotal_Pedido_Ocasional       = $SubTotal_Pedido_Ocasional - $this->Saldo_Puntos_Cantidad ;
            $Puntos_Utilizados_Ocasional     = $this->Saldo_Puntos_Cantidad;
          }
        }

        // ( 3) TOTALES DEL PEDIDO --- APLICACIÓN COMISIONES ( 3 )-- COMPRADOR OCASIONAL
        if ($this->Saldo_Comisiones > 0 && $SubTotal_Pedido_Ocasional  > 0 )
        {
          if ($this->Saldo_Comisiones >= $SubTotal_Pedido_Ocasional )
          {
            $SubTotal_Pedido_Ocasional       = 0;
            $Comisiones_Utilizadas_Ocasional = $SubTotal_Pedido_Ocasional;
          }else
          {
            $SubTotal_Pedido_Ocasional       = $SubTotal_Pedido_Ocasional - $this->Saldo_Comisiones;
            $Comisiones_Utilizadas_Ocasional = $this->Saldo_Comisiones;
          }
        }


        Session::Set('Vr_Usado_Cupon_Descuento',    $Vr_Usado_Cupon_Descuento_Ocasional );
        Session::Set('Puntos_Utilizados',           $Puntos_Utilizados_Ocasional );
        Session::Set('Comisiones_Utilizadas',       $Comisiones_Utilizadas_Ocasional );

    }


  public function Calcular_Valor_Recaudo($aplica_vr_recaudo)
    {
      /** ABRIL 25 DE 2015
       *   CALCULA EL VALOR DE RECAUDO DE ACUERDO AL PEDIDO
       */
        $subsidio_flete = Session::Get('presupuesto_flete_otros');
        $flete_real     = Session::Get('flete_cobrado_otros');

        $this->Vr_Recaudo        = 0;
        if ( $aplica_vr_recaudo == FALSE)  {
            return ;
          }
        $Parametros                      = $this->Parametros->Transportadoras();
        $this->PayuLatam_Recaudo         = $Parametros[0]['py_porciento_recaudo'] / 100;
        $this->PayuLatam_Valor_Minimo    = $Parametros[0]['py_vr_min_recaudo'];
        $this->PayuLatam_Valor_Adicional = $Parametros[0]['py_vr_adicional'];


        $sub_total_pedido_otros  = $this->SubTotal_Pedido_Real;

        $Recaudo_A = $sub_total_pedido_otros  + $flete_real - $subsidio_flete ;
        $Recaudo_A  = $Recaudo_A  * $this->PayuLatam_Recaudo;
        $Recaudo_A  = $Recaudo_A  / ( 1 - $this->PayuLatam_Recaudo );

        $Recaudo_B  = $this->PayuLatam_Valor_Adicional /( 1 - $this->PayuLatam_Recaudo );
        $Recaudo_Total = $Recaudo_A + $Recaudo_B ;
        if ($Recaudo_Total < ( $this->PayuLatam_Valor_Minimo + $this->PayuLatam_Valor_Adicional) ){
          $Recaudo_Total  = $this->PayuLatam_Valor_Minimo + $this->PayuLatam_Valor_Adicional ;
        }

        $this->Vr_Recaudo  = $Recaudo_Total;


    }






    public function Hallar_Valor_Escalas_Productos()
    {
        $this->Iniciar_Procesos_Carro();
        //Debug::Mostrar($this->Cantidad_Filas_Carrito);
        //Debug::Mostrar($this->Datos_Carro);
        $i   = 0;
        for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)
         {
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



  public function Agregar_Producto()
    {
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


        if (!isset($_SESSION['carrito']))
        {
          $_SESSION['carrito'] = array();
        }
        $Carrito_Actual     = $_SESSION['carrito'];
        $Ultima_Compra      = array('idproducto'=>$IdProducto ,'cantidad'=>$CantidadComprada);
        $Existe_Id_Producto = false;
        $Pos                = 0;
        $Cantidad_Filas     = count($Carrito_Actual);
        $i                  = 0;
        for ($i=0; $i<$Cantidad_Filas; $i++)
         {
            $IdProducto_Carro = $Carrito_Actual[$i]['idproducto'];

            if ($IdProducto_Carro==$IdProducto )
            {
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



    public function Retornar_Totales_Carro_Json()
    {

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

      $pv_tron_resumen              =  "$ ".number_format(Session::Get('pv_tron_resumen'),0,"",".");
      $pv_ocas_resumen              =  "$ ".number_format(Session::Get('pv_ocas_resumen'),0,"",".");



      $Datos    = compact('SubTotal_Pedido_Amigos','SubTotal_Pedido_Ocasional','descuento_especial','descuento_especial_porcentaje',
                          'vr_unitario_ropa','vr_unitario_banios','vr_unitario_pisos','vr_unitario_loza',
                          'pv_ocas_resumen','pv_tron_resumen');
      echo json_encode($Datos,256);
    }


    public function Complementar_Datos_Productos_Carrito($ProdTron=false, $ProdTronAcc=false)
    {
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
                                       'iva' =>0,'cmv'=>0,'idgrupo'=>0,'id_agrupacion'=>0,'idpresentacion'=>0, 'nompresentacion'=>'',
                                        'nombre_imagen'=>'','pv_tron_escala_a'=>0, 'pv_tron_escala_b'=>0, 'pv_tron_escala_c'=>0,
                                        'sub_total_pv_ocasional'=>0, 'sub_total_pv_tron'=>0,'posicion_escala'=>0,
                                        'es_tron'=>false, 'es_tron_acc'=>false,'es_industrial'=>false,
                                        'costofijo'=>0, 'costovariable'=>0,'correctorvariacion'=>0,'descuentomaximo'=>0,
                                        'vrpedidominimo_con_dscto'=>0, 'porciento_recaudador'=>0,
                                        'dscto_precio_mercado_1_ropa'=>0, 'dscto_precio_mercado_2_banos'=>0,
                                        'dscto_precio_mercado_3_pisos'=>0, 'dscto_precio_mercado_4_loza'=>0,
                                        'id_categoria_producto'=>0, 'margen_bruta_inicial'=>0 , 'valor_declarado'=>0,
                                        'precio_unitario_produc_pedido'=>0, 'precio_total_produc_pedido'=>0, 'sub_total_pedido_Tron'=>0,
                                        'sub_total_pedido_Otros'=>0, 'codigo_grupo'=>'', 'pv_tron_real'=>0);

        if (!isset( $Parametros))
        {
          $Parametros = $this->Parametros->Consultar();
        }



        $CarroFinalCompleto = array();
        $Datos_Carro        = $_SESSION['carrito'];
        foreach ($Datos_Carro as $ProductosCarro)
          {
            $Cantidad     = $ProductosCarro['cantidad'] ;
            $IdProducto   = $ProductosCarro['idproducto'];

            if ($Cantidad>0)
            {
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
                $CarroTemporal['peso_gramos']            = $ProductoComprado[0]['peso_gramos'];
                $CarroTemporal['ppto_fletes']            = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['ppto_fletes_escala_a']   = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['ppto_fletes_escala_b']   = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['ppto_fletes_escala_c']   = $ProductoComprado[0]['ppto_fletes'] / 100;
                $CarroTemporal['pv_ocasional']           = $ProductoComprado[0]['pv_ocasional'];
                $CarroTemporal['pv_tron']                = $ProductoComprado[0]['pv_tron'];
                $CarroTemporal['pv_tron_real']           = $ProductoComprado[0]['pv_tron'];

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





