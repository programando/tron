
<?php


class CarritoController extends Controller
{
    private $Carrito_Vacio              = false;
    private $Cantidad_Filas_Carrito     = 0;
    private $Datos_Carro;
    private $Total_Parcial_pv_tron      = 0;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
    private $Total_Parcial_pv_ocasional = 0;
    private $Peso_Total_Pedido_Kilos    = 0;
    private $Carrito_Habilitado         = false;
    // VARIABLES PARA PRODUCTOS TRON
    private $Tron_Peso_Total_Gramos     = 0;
    private $Tron_Cmv_Total             = 0;
    private $Tron_Precio_Lista_Total    = 0;
    //VARIABLES PARA OPERACIONES TOTALES EN EL CARRITO
    private $Saldo_Puntos_Cantidad      = 0;
    private $Saldo_Comisiones           = 0;
    private $Vr_Cupon_Descuento         = 0;
    private $Vr_Transporte_Cliente      = 0;
    private $Vr_Total_Pedido_Ocasional  = 0;
    private $Vr_Total_Pedido_Tron       = 0;
    private $Valor_Declarado            = 0;
    private $Cant_Unidades_Despacho     = 0;
    private $compras_tron               = 0;
    private $compras_industrial         = 0;
    private $compras_otros_productos    = 0;
    private $compras_accesorios         = 0;





    public function __construct()
    {
        parent::__construct();

        $this->Escalas       = $this->Load_Controller('ProductosEscalas');
        $this->Parametros    = $this->Load_Controller('Parametros');
        $this->Terceros      = $this->Load_Controller('Terceros');
        $this->Fletes        = $this->Load_Controller('Fletes');
        $this->Departamentos = $this->Load_Model('Departamentos');
        $this->Productos     = $this->Load_Model('Productos');

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
    {/** FEBRERO 28 DE 2015
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
    {/** FEBRERO 28 DE 2015
          DETERMINA EL SIGUIENTE PASO EN LA FINALIZACIÓN DEL PEDIDO.
          IDENTIFICACION O CONFIRMACIÓN DE ENVÍO
      */
      $this->View->SetJs(array('tron_pasos_pagar','tron_dptos_mcipios'));
      $this->View->SetCss(array('tron_carrito','tron_carrito_identificacion','tron_carrito_confi_envio','tron_barra_usuarios','tron_estilos_linea_tiempo'));
      $this->View->Departamentos = $this->Departamentos->Consultar();
      if (Session::Get('autenticado')==false)
      {
        Session::Set('finalizar_pedido_siguiente_paso','DIRECCION');
        $this->View->Mostrar_Vista('finalizar_pedido_identificacion');

      }else
      {
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

      $i=0;
      $IdProducto        = General_Functions::Validar_Entrada('IdProducto','NUM');
      $Cantidad          = General_Functions::Validar_Entrada('Cantidad','NUM');

      foreach ($this->Datos_Carro as $key => $productos)
      {
        if ($productos['idproducto'] == $IdProducto)
        {
            $cantidad_producto = $this->Datos_Carro[$key]['cantidad'];
            $cantidad_producto = $cantidad_producto - $Cantidad;
            if ($cantidad_producto<=0)
            {
              unset($this->Datos_Carro[$key]);
            }else
            {
             $this->Datos_Carro[$key]['cantidad'] = $cantidad_producto;
            }
        }
      }

      $this->Cerrar_Procesos_Carro();
      $this->Hallar_Valor_Escalas_Productos();
      $this->Totalizar_Carrito();
      $this->Retornar_Totales_Carro_Json(); // Retorna totales en formato JSON

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
               unset($Productos['idproducto']);
             }
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

      $this->View->SetJs(array('tron_carrito','tron_productos.jquery','tron_pasos_pagar'));
      $this->View->SetCss(array('tron_carrito' , 'tron_carrito_pgn','tron_carrito_vacio','tron_carrito_linea_tiempo', 'tron_carrito_confi_envio'));

      if ($this->Cantidad_Filas_Carrito==0)
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

     if ($this->Cantidad_Filas_Carrito>0)
      {
        $this->Hallar_Valor_Escalas_Productos();
        $this->Totalizar_Carrito();
        $this->View->Datos_Carro                = $_SESSION['carrito'];

        $this->View->Saldo_Puntos_Cantidad      = $this->Saldo_Puntos_Cantidad;
        $this->View->Saldo_Comisiones           = $this->Saldo_Comisiones;
        $this->View->Total_Parcial_pv_ocasional = $this->Total_Parcial_pv_ocasional;
        $this->View->Total_Parcial_pv_tron      = $this->Total_Parcial_pv_tron;
        $this->View->Vr_Cupon_Descuento         = $this->Vr_Cupon_Descuento;
        $this->View->Vr_Transporte_Cliente      = $this->Vr_Transporte_Cliente;
        $this->View->Vr_Total_Pedido_Ocasional  = $this->Vr_Total_Pedido_Ocasional;
        $this->View->Vr_Total_Pedido_Tron       = $this->Vr_Total_Pedido_Tron;


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

        $SubTotal_Pedido_Ocasional          = $this->Total_Parcial_pv_ocasional;  // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
        $SubTotal_Pedido_Tron               = $this->Total_Parcial_pv_tron;       // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS

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

      //-------------------------------------------------------------------------------------------------------
      // ( 1 ) TOTALES DEL PEDIDO --- APLICACIÓN DE BONO DE DESCUENTO (1) -- CLIENTE / EMPRESARIO TRON
        if ($this->Vr_Cupon_Descuento > 0 && $SubTotal_Pedido_Tron  > 0 )
        {
          if ($this->Vr_Cupon_Descuento >= $SubTotal_Pedido_Tron  )
          {
            $SubTotal_Pedido_Tron           = 0;
            $Vr_Usado_Cupon_Descuento_Tron  = $SubTotal_Pedido_Tron;
          }else
          {
            $SubTotal_Pedido_Tron          = $SubTotal_Pedido_Tron - $this->Vr_Cupon_Descuento ;
            $Vr_Usado_Cupon_Descuento_Tron = $this->Vr_Cupon_Descuento;
          }
        }

        // ( 2 ) TOTALES DEL PEDIDO --- APLICACIÓN DE BONO DE PUNTOS ( 2 )-- CLIENTE / EMPRESARIO TRON
        if ($this->Saldo_Puntos_Cantidad > 0 && $SubTotal_Pedido_Tron  > 0 )
        {
          if ($this->Saldo_Puntos_Cantidad >= $SubTotal_Pedido_Tron )
          {
            $SubTotal_Pedido_Tron          = 0;
            $Puntos_Utilizados_Tron        = $SubTotal_Pedido_Tron;
          }else
          {
            $SubTotal_Pedido_Tron       = $SubTotal_Pedido_Tron - $this->Saldo_Puntos_Cantidad ;
            $Puntos_Utilizados_Tron     = $this->Saldo_Puntos_Cantidad;
          }
        }

        // ( 3) TOTALES DEL PEDIDO --- APLICACIÓN DE BONO DE COMISIONES ( 3 )-- CLIENTE / EMPRESARIO TRON
        if ($this->Saldo_Comisiones > 0 && $SubTotal_Pedido_Tron  > 0 )
        {
          if ($this->Saldo_Comisiones >= $SubTotal_Pedido_Tron )
          {
            $SubTotal_Pedido_Tron       = 0;
            $Comisiones_Utilizadas_Tron = $SubTotal_Pedido_Tron;
          }else
          {
            $SubTotal_Pedido_Tron       = $SubTotal_Pedido_Tron - $this->Saldo_Comisiones;
            $Comisiones_Utilizadas_Tron = $this->Saldo_Comisiones;
          }
        }

        $this->Vr_Total_Pedido_Ocasional = $SubTotal_Pedido_Ocasional + $this->Vr_Transporte_Cliente ;
        $this->Vr_Total_Pedido_Tron      = $SubTotal_Pedido_Tron      + $this->Vr_Transporte_Cliente ;

        Session::Set('Vr_Usado_Cupon_Descuento_Ocasional',    $Vr_Usado_Cupon_Descuento_Ocasional );
        Session::Set('Puntos_Utilizados_Ocasional',           $Puntos_Utilizados_Ocasional );
        Session::Set('Comisiones_Utilizadas_Ocasional',       $Comisiones_Utilizadas_Ocasional );

        Session::Set('Vr_Usado_Cupon_Descuento_Tron',         $Vr_Usado_Cupon_Descuento_Tron );
        Session::Set('Puntos_Utilizados_Tron',                $Puntos_Utilizados_Tron );
        Session::Set('Comisiones_Utilizadas_Tron',            $Comisiones_Utilizadas_Tron );

    }

    public function Totalizar_Carrito()
    {
      /** ENERO 15 DE 2015
      *   CALCULA LOS TOTALES EN EL CARRITO DE COMPRAS
      */
      $this->Depurar_Carrito();
      $this->Iniciar_Procesos_Carro();
      $i                                = 0;
      $this->Total_Parcial_pv_tron      = 0;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
      $this->Total_Parcial_pv_ocasional = 0;    // SON PARCIALES PORQUE AÚN NO SE APLIAN DESCUENTOS
      $this->Peso_Total_Pedido_Kilos    = 0;
      $this->Valor_Declarado            = 0;

      $this->Tron_Peso_Total_Gramos     = 0;
      $this->Tron_Cmv_Total             = 0;
      $this->Tron_Precio_Lista_Total    = 0;

      $this->compras_tron               = 0;
      $this->compras_industrial         = 0 ;
      $this->compras_otros_productos    = 0 ;
      $this->compras_accesorios         = 0 ;


      if ($this->Carrito_Habilitado == false)
      {
        return ;
      }

       foreach ($this->Datos_Carro as $Productos)
        {
          $cantidad                            = $Productos['cantidad'];
          $peso_total_producto                 = ($Productos['peso_gramos'] * $cantidad)  / 1000   ;
          $Productos['sub_total_pv_ocasional'] = $Productos['cantidad']     * $Productos['pv_ocasional'];
          $Productos['sub_total_pv_tron']      = $Productos['cantidad']     * $Productos['pv_tron'] ;
          $this->Total_Parcial_pv_ocasional    = $this->Total_Parcial_pv_ocasional   + $Productos['sub_total_pv_ocasional'] ;
          $this->Total_Parcial_pv_tron         = $this->Total_Parcial_pv_tron        + $Productos['sub_total_pv_tron'] ;
          $this->Peso_Total_Pedido_Kilos       = $this->Peso_Total_Pedido_Kilos      + $peso_total_producto ;

          if ($Productos['idtipo_producto'] !='PRD' ) // PRODUCTOS QUE NO SON TRON ( OTROS, ACC, INDUSTRIALES, PROMOCIONALES)
          {
            $this->Tron_Peso_Total_Gramos  = $this->Tron_Peso_Total_Gramos    + $peso_total_producto  ;
            $this->Tron_Cmv_Total          = $this->Tron_Cmv_Total            + $Productos['cmv'];
            $this->Tron_Precio_Lista_Total = $this->Tron_Precio_Lista_Total   + $Productos['sub_total_pv_tron'] ;
            $this->Valor_Declarado         = $Productos['sub_total_pv_tron']  * $Productos['margen_bruta_inicial']/100;
          }

          // COMPRAS POR CADA TIPO DE PRODUCTO
          if ($Productos['id_categoria_producto'] >= 1 and $Productos['id_categoria_producto'] <= 4)
          {
               $this->compras_tron  = $this->compras_tron + $Productos['sub_total_pv_tron'] ;
          }
          if ($Productos['id_categoria_producto'] == 6) // Industiales
          {
               $this->compras_industrial   = $this->compras_industrial  + $Productos['sub_total_pv_tron'] ;
          }
        }

        $this->Determinar_Precio_Real_Producto($this->compras_tron ,$this->compras_industrial );
        $this->Totalizar_Pedido_x_Categoria_Producto();         // Totaliza categorias de productos, para grabar en el pedido
        $this->Calcular_Flete($this->Valor_Declarado );
        $this->Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon();
        $this->Peso_Total_Pedido_Kilos   = (int)$this->Peso_Total_Pedido_Kilos ;

        Session::Set('Peso_Total_Pedido_Kilos',     $this->Peso_Total_Pedido_Kilos);
        Session::Set('Total_Parcial_pv_ocasional',  $this->Total_Parcial_pv_ocasional );
        Session::Set('Total_Parcial_pv_tron',       $this->Total_Parcial_pv_tron );
        Session::Set('vr_transporte_cliente',       $this->Vr_Transporte_Cliente );



        $this->Cerrar_Procesos_Carro();
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

    public function Determinar_Precio_Real_Producto($compras_tron,$compras_industrial)
    {/** MARZO 20 DE 2015
      *     DETERMINA EL PRECIO A DAR POR LA COMPRA ACTUAL TENIENDO EN CUENTA LOS MÍNIMOS DE COMPRA PARA PRODUCTOS TRON
      */


      $precio_unitario_producto           = 0;
      $precio_total_producto              = 0;

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
      $i   = 0;
      for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)
       {
           if ($this->Datos_Carro [$i]['cantidad']>0)
           {
            // INCLUIR LAS COMPRAS DE ESTE PEDIDO Y ESTABLECER SI CUMPLE CONDICIONES DE COMPRAS MINIMAS
            if ( ( $compras_este_mes_tron        + $compras_tron       )  >= $compra_minima_productos_tron ||
                 ( $compras_este_mes_industiales + $compras_industrial )  >= $compra_minima_productos_industriales)
              {
                Session::Set('cumple_condicion_cpras_tron_industial', TRUE);
                $Cumple_Condic_Cpras_Tron_Industial   = TRUE;
              }else
              {
                Session::Set('cumple_condicion_cpras_tron_industial', FALSE);
                $Cumple_Condic_Cpras_Tron_Industial   = FALSE;
              }

              // DETERMINA EL PRECIO QUE SE DARÁ AL USUARIO
              if ($Logueado == FALSE)
              {
                  $precio_unitario_producto  = $this->Datos_Carro[$i]['pv_ocasional'];
              }

              if ($Logueado == TRUE)// LOGUEADO PERO NO CUMPLE COMPRA MÍNIMA DE COMPRA TRON O COMPRA INDUSTRIAL, SE DA PRECIO NORMAL
              {
                  if ($Cumple_Condic_Cpras_Tron_Industial  == FALSE)
                  {
                    $precio_unitario_producto  = $this->Datos_Carro[$i]['pv_ocasional'];
                  }else
                  {
                    $precio_unitario_producto  = $this->Datos_Carro[$i]['pv_tron'];
                  }
            }
          $this->Datos_Carro[$i]['precio_unitario_produc_pedido'] = $precio_unitario_producto;
          $this->Datos_Carro[$i]['precio_total_produc_pedido']    = $precio_unitario_producto * $this->Datos_Carro [$i]['cantidad'];
          }
        }
        //Debug::Mostrar($this->Datos_Carro);
        $this->Cerrar_Procesos_Carro();
    } // Fin Hallar_Valor_Escalas_Productos




    public function Calcular_Flete( $valor_declarado)
    {/** MARZO 09 DE 2015
      *     REALIZA CALCULO DEL VALOR DEL FLETE DE LAS DIFERNTES TRANSPORTADORAS QUE TENEMOS
      */
      $this->Cant_Unidades_Despacho = 0;
      $peso_kilos_pedido            = 0;

      $Fletes_Cobrados_Transportadoras = array(array('idtercero'=>0, 'valor_flete'=>0, 'aplica'=>FALSE,
                                               'transportador'=>'', 'tipo_tarifa'=>''));
      Session::Set('Fletes_Cobrados_Transportadoras',$Fletes_Cobrados_Transportadoras);

      $peso_kilos_pedido  = Session::Get('peso_productos_industriales') + Session::Get('peso_otros_productos') + Session::Get('peso_accesorios');
      $peso_kilos_pedido  = $peso_kilos_pedido /1000;  // PASAR A KILOS

      $this->Calcular_Numero_Unidades_Despacho  ($peso_kilos_pedido);
      $this->Fletes->Redetrans_Courrier         ($peso_kilos_pedido,$valor_declarado);
      $this->Fletes->Redetrans_Carga            ($peso_kilos_pedido,$valor_declarado,$this->Cant_Unidades_Despacho);
      $this->Fletes->Servientrega_Industrial    ($peso_kilos_pedido,$valor_declarado,$this->Cant_Unidades_Despacho);
      $this->Fletes->Sevientrega_Premier        ($peso_kilos_pedido,$valor_declarado);
      $this->Encontrar_Mejor_Flete();
      //ind_ot_acc_pp = Productos industriales, otros productos, accesorio y productos promocionales
      $mis_fletes = array("fletes"   => array("tron","ind_ot_acc_pp"),
                          "subsidio" => array("tron","ind_ot_acc_pp"),
                          "recaudo"  => array("tron","ind_ot_acc_pp"));

      /*$mis_fletes["fletes"]['0']          = 100;
      $mis_fletes["fletes"]['industrial']    = 200;
      $mis_fletes["fletes"]['otros']         = 300;
      $mis_fletes["fletes"]['accesorios']    = 400;
      $mis_fletes["fletes"]['promocionales'] = 500;
      //
      $mis_fletes["subsidio"]['tron']          = 100;
      $mis_fletes["subsidio"]['industrial']    = 200;
      $mis_fletes["subsidio"]['otros']         = 300;
      $mis_fletes["subsidio"]['accesorios']    = 400;
      $mis_fletes["subsidio"]['promocionales'] = 500;

      foreach ($mis_fletes as $key) {
       Debug::Mostrar($key[0]);
      }
*/

    }



    public function Encontrar_Mejor_Flete()
    {/**  MARZO 12 DE 2015
      *       VERIFICA DE LOS FLETES ENCONTRADOS EL MEJOR PARA ASIGNARLO AL PEDIDO
      */
      $this->Vr_Transporte_Cliente     = 0;
      $i                               = 0;
      $Fletes_Cobrados_Transportadoras = Session::Get('Fletes_Cobrados_Transportadoras');
      $Asignar_Flete                   = TRUE;
      Debug::Mostrar($Fletes_Cobrados_Transportadoras);
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
                $Mejor_Flete['idtercero']   = $Fletes['idtercero']   ;
                $Mejor_Flete['valor_flete'] = $Fletes['valor_flete'] ;
                $Mejor_Flete['tipo_tarifa'] = $Fletes['tipo_tarifa'] ;
            }
        }
      }
      $this->Vr_Transporte_Cliente = $Mejor_Flete['valor_flete'];
      Session::Set('flete_cobrado', $Mejor_Flete);
      Debug::Mostrar($Mejor_Flete);
    }



    public function Calcular_Numero_Unidades_Despacho($peso_kilos_pedido)
    {/** MARZO 12 de 2015
      *         CALCULA LA CANTIDAD DE UNIDES DE DESPACHO QUE RESULTAN
      */
      /*  38  4 kg.   39  4 kg.   42  4 lts.    122 4 lts(1)    123 4 lts(1)    124 4 lts(1)    145 4 lts.      148 4 lts.
          151 4 kg.   155 4 kg.   160 4 lts.    162 4 lts(1)    163 4 lts.      164 4 lts.(1)   195 4 lts (1)
      */
      $Cant_Unid_No_04_20_Litros = 0;       // Cantidad de productos que no son 4 y 20 litros
      $Cant_Unid_Si_04_Litros    = 0;      // Cantidad de presentaciones que son 4 litros
      $Cant_Unid_Si_20_Litros    = 0;      // Cantidad de presentaciones que son 20 litros
      $Cant_Unid_No_Industriales = 0;     // Cantidad de productos que no son industriales

      $presentaciones_4_litros   = array(38, 39, 42, 122, 123, 124, 145, 148, 151, 155, 160, 162, 163, 164, 195 );
      $presentaciones_20_litros  = array(57, 59, 61, 153, 171, 184, 185 );

      $this->Iniciar_Procesos_Carro();

      if ($this->Carrito_Habilitado==false)
      {
        return ;
      }

       foreach ($this->Datos_Carro as $Productos)
        {
          if ($Productos['id_categoria_producto']==6) // Productos industriales
          {
            $ID_Presentacion = $Productos['idpresentacion'];

            // Presentaciones diferentes a 4 litros
            if (!in_array($ID_Presentacion, $presentaciones_4_litros) and !in_array($ID_Presentacion, $presentaciones_20_litros))
              {
                  $Cant_Unid_No_04_20_Litros = $Cant_Unid_No_04_20_Litros + $Productos['cantidad'];
              }
            if (in_array($ID_Presentacion, $presentaciones_4_litros))  // presentaciones iguales a 4 litros
              {
                  $Cant_Unid_Si_04_Litros = $Cant_Unid_Si_04_Litros + $Productos['cantidad'];
              }
            if (in_array($ID_Presentacion,  $presentaciones_20_litros))  // presentaciones iguales a 4 litros
              {
                  $Cant_Unid_Si_20_Litros = $Cant_Unid_Si_20_Litros + $Productos['cantidad'];
              }
          }
          if ($Productos['id_categoria_producto']==7) // Productos que no son industriales
          {
              $Cant_Unid_No_Industriales = $Cant_Unid_No_Industriales + $peso_kilos_pedido;
          }

        }// end foreach
        $Cant_Unid_Si_04_Litros       = Numeric_Functions::Valor_Absoluto($Cant_Unid_Si_04_Litros);
        $Cant_Unid_No_Industriales    = $Cant_Unid_No_Industriales*1000/4000;  // Viene en kilos, lo paso a gramos ( * 1000 )
        $Cant_Unid_No_Industriales    = Numeric_Functions::Valor_Absoluto($Cant_Unid_No_Industriales);

        $this->Cant_Unidades_Despacho = $Cant_Unid_No_04_20_Litros + $Cant_Unid_Si_04_Litros + $Cant_Unid_Si_20_Litros + $Cant_Unid_No_Industriales;

    }




    public function Hallar_Valor_Escalas_Productos()
    {
        $this->Iniciar_Procesos_Carro();
        $i   = 0;
        for ($i=0; $i < $this->Cantidad_Filas_Carrito; $i++)
         {
             if ($this->Datos_Carro [$i]['cantidad'] >0 and $this->Datos_Carro[$i]['idescala']>0)
             {
              $cantidad         = $this->Datos_Carro[$i]['cantidad'];
              $idescala         = $this->Datos_Carro[$i]['idescala'];
              $idproducto       = $this->Datos_Carro[$i]['idproducto'];
              $pv_tron          = $this->Datos_Carro[$i]['pv_tron'];
              $pv_tron_escala_a = $this->Datos_Carro[$i]['pv_tron_escala_a'];
              $pv_tron_escala_b = $this->Datos_Carro[$i]['pv_tron_escala_b'];
              $pv_tron_escala_c = $this->Datos_Carro[$i]['pv_tron_escala_c'];

              // CONSULTA LAS ESCALAS DE ACUERDO AL ID ESCALA DEL PRODUCTO. RETORNA EL PRECIOS PARA EL AMIGO TRON DE ACUERDO
              // A LA CANTIDAD QUE ESTÁ COMPRANDO
              //---------------------------------------------------------------------------------------------------------------------
              $this->Escalas->Escalas_Consultar($idescala,$cantidad,$pv_tron,$pv_tron_escala_a,$pv_tron_escala_b,$pv_tron_escala_c );
              $this->Escalas->Precio_Final_Tron;
              $this->Datos_Carro[$i]['pv_tron']           = $this->Escalas->Precio_Final_Tron;
              $this->Datos_Carro[$i]['posicion_escala']   = $this->Escalas->Posicion_Escala;  // PUEDE SER 0, 1, 2, 3 .. IMPORTANTE PARA LOS PRESUPUESTOS
              $this->Datos_Carro[$i]['idescala_dt']       = $this->Escalas->IdEscala_Compra;  // IDENTIFICADOR DE LA ESCALA CON LA QUE SE COMPRA
              $this->Datos_Carro[$i]['sub_total_pv_tron'] = $this->Datos_Carro[$i]['cantidad']  * $this->Datos_Carro[$i]['pv_tron'] ;

              $this->Datos_Carro[$i]['precio_unitario_produc_pedido'] = 50;
              $this->Datos_Carro[$i]['precio_total_produc_pedido']    = 100;


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
              $i                              = $Cantidad_Filas+1;
              $Existe_Id_Producto             = true;
            }

          }
         if ($Existe_Id_Producto==false)
         {
          array_push($Carrito_Actual, $Ultima_Compra);
         }

        $_SESSION['carrito'] = $Carrito_Actual;

        //

        $this->Depurar_Carrito();
        $this->Complementar_Datos_Productos_Carrito($ProdTron,$ProdTronAcc );
        $this->Hallar_Valor_Escalas_Productos();
        $this->Totalizar_Carrito();
        $this->Retornar_Totales_Carro_Json();

    } // Fin Agregar_Producto



    public function Retornar_Totales_Carro_Json()
    {
      $Total_Parcial_pv_tron      =  "$".number_format($this->Total_Parcial_pv_tron ,0,"",".");
      $Total_Parcial_pv_ocasional =  "$".number_format($this->Total_Parcial_pv_ocasional ,0,"",".");
      $Datos                      = compact('Total_Parcial_pv_tron','Total_Parcial_pv_ocasional');
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
                                        'precio_unitario_produc_pedido'=>0, 'precio_total_produc_pedido'=>0);

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
                $CarroTemporal['idtipo_producto']        = $ProductoComprado[0]['idtipo_producto'];
                $CarroTemporal['id_categoria_producto']  = $ProductoComprado[0]['id_categoria_producto'];
                $CarroTemporal['idpresentacion']         = $ProductoComprado[0]['idpresentacion'];


                $CarroTemporal['iva']                    = $ProductoComprado[0]['iva'];
                $CarroTemporal['nom_producto']           = $ProductoComprado[0]['nom_producto'];
                $CarroTemporal['nombre_imagen']          = $ProductoComprado[0]['nombre_imagen'];
                $CarroTemporal['nompresentacion']        = $ProductoComprado[0]['nompresentacion'];
                $CarroTemporal['peso_gramos']            = $ProductoComprado[0]['peso_gramos'];
                $CarroTemporal['ppto_fletes']            = $ProductoComprado[0]['ppto_fletes'];
                $CarroTemporal['ppto_fletes_escala_a']   = $ProductoComprado[0]['ppto_fletes_escala_a'];
                $CarroTemporal['ppto_fletes_escala_b']   = $ProductoComprado[0]['ppto_fletes_escala_b'];
                $CarroTemporal['ppto_fletes_escala_c']   = $ProductoComprado[0]['ppto_fletes_escala_c'];
                $CarroTemporal['pv_ocasional']           = $ProductoComprado[0]['pv_ocasional'];
                $CarroTemporal['pv_tron']                = $ProductoComprado[0]['pv_tron'];
                $CarroTemporal['pv_tron_escala_a']       = $ProductoComprado[0]['pv_tron_escala_a'];
                $CarroTemporal['pv_tron_escala_b']       = $ProductoComprado[0]['pv_tron_escala_b'];
                $CarroTemporal['pv_tron_escala_c']       = $ProductoComprado[0]['pv_tron_escala_c'];
                $CarroTemporal['tipo_despacho']          = $ProductoComprado[0]['tipo_despacho'];
                $CarroTemporal['margen_bruta_inicial']   = $ProductoComprado[0]['margen_bruta_inicial'];

                $CarroTemporal['sub_total_pv_ocasional'] = 0;
                $CarroTemporal['sub_total_pv_tron']      = 0;

                //$CarroTemporal['precio_unitario_produc_pedido'] =  $CarroTemporal['pv_ocasional'];
                //$CarroTemporal['precio_total_produc_pedido']    = $CarroTemporal['cantidad']  * $CarroTemporal['pv_ocasional'] ;

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





