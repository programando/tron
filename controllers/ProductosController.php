<?php
	/* AGOSTO 24 DE 2014
			Realiza la llamada a la vista correspondiente y traslada los parametros que necesita
			a Cada controlador el corresponde una vista. en el proyecto se encuentran dentro de carpetas
			La extensión de estas vistras es PHTML, dentro del rectorio views
	 */
class ProductosController extends Controller
 {
    private $_Productos_Tron ;
    private $_Accesorios_Tron;

    public function __construct()
    {
        parent::__construct();
        $this->Productos          = $this->Load_Model('Productos');
        $this->Marcas             = $this->Load_Model('Marcas');
        $this->Escalas            = $this->Load_Controller('ProductosEscalas');
        $this->Email              = $this->Load_Controller('Emails');

        $this->Paginador          = $this->Load_External_Library('paginador');
        $this->Paginador          = new Paginador();


    }

    public function Index() {}

    public function Recomendar_Producto_a_Amigo()
    { /** ENERO 31 DE 2015
      **  PROCEDIMEINTO POR MEDIO DEL CUAL SE RECOMIENDA PRODUCTOS A AMIGOS
      */
      $IdProducto         = General_Functions::Validar_Entrada('idproducto','NUM');
      $Email_Amigo        = General_Functions::Validar_Entrada('email_amigo','TEXT');
      $Email_AmigoOk      = General_Functions::Validar_Entrada('email_amigo','EMAIL');
      $Nombre_Quien_Envia = General_Functions::Validar_Entrada('nombre_quien_envia','TEXT');
      $Mensaje_Enviado    = General_Functions::Validar_Entrada('mensaje_enviado','TEXT');
      $Nombre_Imagen      = General_Functions::Validar_Entrada('nombre_imagen','TEXT');
      $Nombre_Imagen      = General_Functions::Validar_Entrada('nombre_imagen','TEXT');

      $Texto_Respuesta    = '';
      if ($Email_AmigoOk==false)
      {
        $Texto_Respuesta  ='Email_Amigo_No_Ok';
      }else
      {
        $Texto_Respuesta = $this->Email->Recomendar_Producto_a_Amigo($Email_Amigo,$Nombre_Quien_Envia,$Mensaje_Enviado,$Nombre_Imagen,$IdProducto  );
      }

      echo $Texto_Respuesta ;
    }


    public function Busqueda_General()
    {
      /**  ENERO 22 DE 2015.    REALIZA BUSQUEDA DE PRODUCTOS TENIENDO EN CUENTA UN CRITERIO DADO POR EL USUARIO
      */
      $Id_Area_Consulta      = Session::Get('Id_Area_Consulta');
      $Texto_Busqueda        = General_Functions::Validar_Entrada('texto_busqueda','TEXT');
      $Tipo_Busqueda        = General_Functions::Validar_Entrada('tipo_busqueda','TEXT');

      if (strlen($Texto_Busqueda)>0){

      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
        $this->View->Productos = $this->Productos->Busqueda_General($Texto_Busqueda, $Tipo_Busqueda);


        $this->View->Mostrar_Vista('resultado_busqueda');
      }

    }

    public function Varias_Referencias($Id_Agrupacion)
    {
      /**  ENERO 22 DE 2015   MUESTRA PRODUCTOS AGRUPADOS EN VARIOS REFERENCIAS
      */
       $this->View->Productos_Varias_Referencias = $this->Productos->Productos_x_Agrupacion( $Id_Agrupacion );
       $this->View->Nombre_Agrupacion            = $this->View->Productos_Varias_Referencias[0]['nom_agrupacion'];
       $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA'));
       $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
       $this->View->Mostrar_Vista('varias_referencias');
    }




    public function Destacados_Index()
    {
        $this->View->Productos_Desatacados = $this->Productos->Destacados_Index();
    }


    public function Destacados()
    {
         $this->View->Productos_Destacados = $this->Productos->Destacados_Index();
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_destacados_active'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('destacados');
    }


    public function Ofertas_Index()
    {
         $this->View->Productos_Ofertas     = $this->Productos->Ofertas_Index();
    }

    public function Ofertas()
    {
         $this->View->Productos_Ofertas = $this->Productos->Ofertas_Index();
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_ofertas_active'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('ofertas');
    }


     public function Productos_Tron()
    {
         Session::Set('Id_Area_Consulta','2');
         $this->View->SetCss(array('tron_carrito','tron_estilos_productos_tron','tron_productos_tron_active'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','resumen_pedido_tron'));

         $this->Productos_Tron_Ropa();
         $this->View->Accesorios          = $this->_Accesorios_Tron;
         $this->View->Productos_Tron_Ropa = $this->_Productos_Tron;


         $this->View->Mostrar_Vista('productos_tron');
    }


    public function Productos_Tron_Ropa()
    {
      $Id_Categoria_Ropa = 1;
      $this->_Productos_Tron  = $this->Productos->Productos_Tron_x_Id_Categoria_Producto($Id_Categoria_Ropa);
      $this->_Accesorios_Tron = $this->Productos->Productos_Tron_Accesorios_x_Id_Categoria_Producto($Id_Categoria_Ropa);

    }

    public function Novedades_Index()
    {
         $this->View->Productos_Novedades    = $this->Productos->Novedades_Ofertas();
    }


    public function Novedades()
    {
         $this->View->Productos_Novedades = $this->Productos->Novedades_Ofertas();
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_novedades_active'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('novedades');
    }




    public function Hallar_Valor_Escala()
    {
        /** DIC 29 DE 2014
        * RECIBE COMO PARAMETROS DATOS DEL PRODUCTO Y OBTIENE EL VALOR FINAL DE COMPRA DE ACUERDO
        * A LA CANTIDAD DE COMPRA     */
         $IdEscala          = General_Functions::Validar_Entrada('IdEscala','NUM');
         $CantidadComprada  = General_Functions::Validar_Entrada('CantidadComprada','NUM');
         $Precio_Amigo_Tron = General_Functions::Validar_Entrada('Precio_Amigo_Tron','DEC');
         $Precio_Escala_A   = General_Functions::Validar_Entrada('Precio_Escala_A','DEC');
         $Precio_Escala_B   = General_Functions::Validar_Entrada('Precio_Escala_B','DEC');
         $Precio_Escala_C   = General_Functions::Validar_Entrada('Precio_Escala_C','DEC');


         $Precio_Final_Tron = $Precio_Amigo_Tron;
         $IdEscala_Compra   = 0;
         $Posiscion_Escala  = 0;
         // CONSULTA LAS ESCALAS DE ACUERDO AL ID ESCALA DEL PRODUCTO. RETORNA EL PRECIOS PARA EL AMIGO TRON DE ACUERDO
         // A LA CANTIDAD QUE ESTÁ COMPRANDO
         $this->Escalas->Escalas_Consultar($IdEscala,$CantidadComprada,$Precio_Amigo_Tron,$Precio_Escala_A,$Precio_Escala_B,$Precio_Escala_C );
         $Precio_Final_Tron = $this->Escalas->Precio_Final_Tron;
         $Precio_Final_Tron=  "$".number_format($Precio_Final_Tron,0,"",".");
         $Datos            = compact('Precio_Final_Tron');
         echo json_encode($Datos,256);
    }

    public function Vista_Ampliada($Idproducto , $Id_Area_Consulta)
    {
     /** DIC 31 DE 2014
     *  MUESTRA INFORMACIÓN AMPLIADA DEL PRODUCTOS. TAMBIÉN ES POSIBLE COMPRAR DESDE ESTE SITIO
     */
      Session::Set('Id_Area_Consulta',$Id_Area_Consulta) ; // 2, Corresponde a productos de la linea hogar
      $idproducto                          = $Idproducto ;
      $this->View->Producto                = $this->Productos->Buscar_por_IdProducto($idproducto);
      $this->View->Producto_Imagenes       = $this->Productos->Imagenes_Consultar($idproducto);
      $this->View->Cantidad_Registros      = $this->Productos->Cantidad_Registros;

      if ($this->View->Cantidad_Registros>0)
          {
            $this->View->Producto_Escalas_Rangos = $this->Escalas->Escalas_Consultar_Rangos($this->View->Producto[0]["idescala"]);
          }else
          {
            $this->View->Error ="No ha sido posible encontrar el producto indicado.";
          }
      $this->View->Productos_Tabs          = $this->Productos->Tabs_Consultar($idproducto);
      $this->View->Cantidad_Tabs           = $this->Productos->Cantidad_Registros;

      if ($Id_Area_Consulta ==2) // HOGAR
      {
          $this->View->SetCss(array('tron_carrito','tron_productos_vista_ampliada','font_styles','tron_ventana_modal'));
      } else
      {
        $this->View->SetCss(array('tron_carrito','tron-vista-industrial','tron_productos_vista_ampliada','tron_ventana_modal'));
      }
      $this->View->SetJs(array('jquery.elevatezoom','tron_carrito','tron_productos.jquery'));
      $this->View->Mostrar_Vista('vista_ampliada');

    }


    public function Categorias_Marcas ($pagina=false)
    {
     /** DIC 31 DE 2014
     *  MUSTRA EL MENU LATERAL DE DATOS RELACIONADOS CON CATEGORÍAS Y MARCAS
    */
     if ($pagina==false) {   $pagina = 1 ;};
      $Id_Area_Consulta  = Session::Get('Id_Area_Consulta');

      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_varias_referencias-ofertas-tecnologias_SA','tron_categorias_marcas_active'));
      $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','menu-accordion'));

      $this->View->Productos_Categorias_Nv_1 = $this->Productos->Categorias_Consultar($Id_Area_Consulta);
      $this->View->Productos_Categorias_Nv_2 = $this->Productos->SubCategorias_Consultar($Id_Area_Consulta);
      $this->View->Productos_Marcas          = $this->Marcas->Marcas_Consultar($Id_Area_Consulta);

      $this->View->Productos_Pagina          = $this->Productos->Listar_Poductos_Paginador($Id_Area_Consulta );
      $this->View->Productos_Pagina          = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion                = $this->Paginador->Mostrar_Paginacion('paginador','productos/Categorias_Marcas');

      $this->View->Mostrar_Vista('marcas_y_categorias');
    }

    public function new_productos_categorias()
    {
     /** DIC 31 DE 2014
     *  MUSTRA EL MENU LATERAL DE DATOS RELACIONADOS CON CATEGORÍAS Y MARCAS
    */
      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_varias_referencias-ofertas-tecnologias_SA'));
      $this->View->SetJs(array('menu-accordion'));
      $this->View->Mostrar_Vista('new_productos_categorias');
    }

    public function Productos_por_Categoria_Individual( )
    {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};


      $_idorden_nv_1    = $this->View->Argumentos[0];
      $nom_categoria    = $this->View->Argumentos[1];
      $Id_Area_Consulta = $this->View->Argumentos[2];

      Session::Set('Id_Area_Consulta', $Id_Area_Consulta);      // Reasiga el area de consulta
      $nom_categoria    = String_Functions::Mayusculas($nom_categoria);

      // Datos usados para la paginación ajax. Determina el nivel de profundidad en el que se encuenta el menú.
      Session::Set('IdCategoria_n1',$_idorden_nv_1);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);               // Segundo nivel
      Session::Set('IdMarca',0);                      // Deplegado el menú de marcas. tron-vista-industrial.css


      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));

      $this->View->Productos_Categorias_Nv_1 = $this->Productos->Categorias_Consultar($Id_Area_Consulta);
      $this->View->Productos_Categorias_Nv_2 = $this->Productos->SubCategorias_Consultar($Id_Area_Consulta);
      $this->View->Productos_Marcas          = $this->Marcas->Marcas_Consultar($Id_Area_Consulta);

      $this->View->Productos_Pagina          = $this->Productos->Productos_por_Categoria($Id_Area_Consulta,$_idorden_nv_1 );
      $this->View->Productos_Pagina          = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion                = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
      $this->View->nom_categoria             = $nom_categoria ;
      $this->View->idorden_nv_1              = $_idorden_nv_1;

      $this->View->Mostrar_Vista('marcas_y_categorias_individual');

    } // Fin Productos_por_Categoria


    public function Productos_por_Categoria()
    {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina = false;  };
      if ($pagina==false)  { $pagina = 1 ;     };
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $_idorden_nv_1    =  General_Functions::Validar_Entrada('idorden_nv_1','NUM');

      Session::Set('IdCategoria_n1',$_idorden_nv_1);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);
      Session::Set('IdMarca',0);


        $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
        $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));

        $this->View->Productos_Pagina = $this->Productos->Productos_por_Categoria($Id_Area_Consulta,$_idorden_nv_1 );
        $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
        $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');

        $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');

    } // Fin Productos_por_Categoria

    public function Productos_Mostrar_Via_Ajax()
    {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $pagina           =  General_Functions::Validar_Entrada('pagina','NUM');
      $IdOrden_nv_1     = Session::Get('IdCategoria_n1');
      $IdOrden_nv_2     = Session::Get('IdCategoria_n2');
      $IdMarca          = Session::Get('IdMarca');



        $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
        $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));

        if ($IdOrden_nv_1 > 0)
        {
          $this->View->Productos_Pagina = $this->Productos->Productos_por_Categoria($Id_Area_Consulta,$IdOrden_nv_1 );
        }
        if ($IdOrden_nv_2 > 0)
        {
          $this->View->Productos_Pagina = $this->Productos->Productos_por_Sub_Categoria($Id_Area_Consulta,$IdOrden_nv_2 );
        }
        if ($IdMarca > 0)
        {
          $this->View->Productos_Pagina = $this->Productos->Productos_por_Marca($Id_Area_Consulta,$IdMarca );
        }

        $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
        $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');

        $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');

    } // Fin Productos_por_Categoria




   public function Productos_por_Sub_Categoria()
    {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR SUB CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $_idorden_nv_2    =  General_Functions::Validar_Entrada('idorden_nv_2','NUM');

      Session::Set('IdCategoria_n1',0);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',$_idorden_nv_2);
      Session::Set('IdMarca',0);

      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));

      $this->View->Productos_Pagina = $this->Productos->Productos_por_Sub_Categoria($Id_Area_Consulta,$_idorden_nv_2);
      $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');

       $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');
    } // Fin Productos_por_Categoria




    public function Productos_por_Marca()
    {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */

      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};

      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $idmarca          =  General_Functions::Validar_Entrada('idmarca','NUM');

      Session::Set('IdCategoria_n1',0);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);
      Session::Set('IdMarca',$idmarca);

      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));

      $this->View->Productos_Pagina = $this->Productos->Productos_por_Marca($Id_Area_Consulta,$idmarca);
      $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
      $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');

    } // Fin Productos_por_Marca




 }
?>


