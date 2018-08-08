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



    public function __construct() {
        parent::__construct();
        $this->Productos          = $this->Load_Model('Productos');
        $this->Marcas             = $this->Load_Model('Marcas');
        $this->Escalas            = $this->Load_Controller('ProductosEscalas');
        $this->Email              = $this->Load_Controller('Emails');
        $this->Terceros           = $this->Load_Controller('Terceros');
        $this->Paginador          = $this->Load_External_Library('paginador');
        $this->Paginador          = new Paginador();
        Session::Set('Id_Area_Consulta','1')  ;
    }

    public function Index() {
      $this->Redireccionar();
    }


    public function Favoritos_Borrar_x_IdTercero_IdProducto(){
         $IdProducto         = General_Functions::Validar_Entrada('idproducto','NUM');
         $IdTercero          = General_Functions::Validar_Entrada('idtercero','NUM');
         $this->Productos->Favoritos_Borrar_x_IdTercero_IdProducto(   $IdTercero, $IdProducto    ) ;
         $this->Favoritos_Consulta_x_idTercero();
    }



    public function Favoritos_Consulta_x_idTercero(  ){
        $idtercero             = Session::Get('idtercero');
        $this->View->Productos =  $this->Productos->Favoritos_Consulta_x_idTercero(   $idtercero ) ;
        $this->View->Mostrar_Vista_Parcial('favoritos');
    }

    public function Productos_Comprados_x_Tercero(  ){
        $idtercero             = Session::Get('idtercero');

        $this->View->Productos =  $this->Productos->Productos_Comprados_x_IdTercero(   $idtercero ) ;
        $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_varias_referencias-ofertas-tecnologias_SA','tron_campo_2'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','menu-accordion'));

        $this->View->Mostrar_Vista('comprados_x_tercero');
    }


    public function Favoritos_Grabar( $idproducto, $idtercero ){
      $this->Productos->Favoritos_Grabar( $idproducto, $idtercero ) ;
      echo "FAVORITO-OK";
    }



    public function mostrar_resumen_producto() {

      $this->View->Mostrar_Vista_Parcial('productos_tron_resumen_productos');
    }



    public function Recomendar_Producto_a_Amigo() { /** ENERO 31 DE 2015
      **  PROCEDIMEINTO POR MEDIO DEL CUAL SE RECOMIENDA PRODUCTOS A AMIGOS
      */
      $IdProducto         = General_Functions::Validar_Entrada('idproducto','NUM');
      $Email_Amigo        = General_Functions::Validar_Entrada('email_amigo','TEXT');
      $Email_AmigoOk      = General_Functions::Validar_Entrada('email_amigo','EMAIL');
      $Nombre_Quien_Envia = General_Functions::Validar_Entrada('nombre_quien_envia','TEXT');
      $Mensaje_Enviado    = General_Functions::Validar_Entrada('mensaje_enviado','TEXT');
      $Nombre_Imagen      = General_Functions::Validar_Entrada('nombre_imagen','TEXT');
      $Nombre_Amigo       = General_Functions::Validar_Entrada('nombre_amigo','TEXT');
      $Productos          = $this->Productos->Buscar_por_IdProducto( $IdProducto );
      $nom_producto       = $Productos[0]['nom_producto'];
      $Texto_Respuesta    = '';

      if ($Email_AmigoOk==false)      {
        $Texto_Respuesta  ='Email_Amigo_No_Ok';
      }else      {
        $Texto_Respuesta = $this->Email->Recomendar_Producto_a_Amigo($Email_Amigo,$Nombre_Quien_Envia,$Mensaje_Enviado,$Nombre_Imagen,$IdProducto,$Nombre_Amigo , $nom_producto  );
      }
      echo $Texto_Respuesta ;
    }



    public function Busqueda_General(){
      /**  ENERO 22 DE 2015.    REALIZA BUSQUEDA DE PRODUCTOS TENIENDO EN CUENTA UN CRITERIO DADO POR EL USUARIO
      */
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $Texto_Busqueda   = General_Functions::Validar_Entrada('texto_busqueda','TEXT');
      $Tipo_Busqueda    = General_Functions::Validar_Entrada('tipo_busqueda','TEXT');
      $pagina           = General_Functions::Validar_Entrada('Pagina','NUM');

      if ( strlen($Texto_Busqueda) > 0 ){
        $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','mostrar_tabla_carrito'));
        $this->View->Productos = $this->Productos->Busqueda_General($Texto_Busqueda, $Tipo_Busqueda);
        $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos, $pagina);
        $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
        Session::Set('nom_categoria','');
        $this->View->Mostrar_Vista('resultado_busqueda');

      }

    }


    public function Compra_Online( $Texto_Busqueda ){
      /**  MARZO 22 DE 2017.
            ESTE METODO SE INVOCA DESDE BALQUIMIA.COM PARA INICIAR LA COMPRA DE PRODUCTO
      */
      $Id_Area_Consulta = 1;
      $pagina           = 1;
      if ( strlen($Texto_Busqueda) > 0 ){
        $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','mostrar_tabla_carrito'));
        $this->View->Productos = $this->Productos->Busqueda_Nombre($Texto_Busqueda, 0,$Id_Area_Consulta );
        $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos, $pagina);
        $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
        Session::Set('nom_categoria','');
        $this->View->Mostrar_Vista('resultado_busqueda');
      }
    }




    public function Busqueda_Productos (){
       $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
       $Texto_Busqueda   = General_Functions::Validar_Entrada('texto_busqueda','TEXT');

       if ( !empty( $Texto_Busqueda )){
        $Productos = $this->Productos->Busqueda_Nombre($Texto_Busqueda, '');
      }

       if ( !$Productos or empty( $Texto_Busqueda )) {
        echo json_encode('',256);
       }else{

          $html ='';
         foreach ($Productos as $Producto) {
           # code...
           $html = $html . '<li><a target="_blank" href="urlString">'. $Producto['nom_producto'] .'</a></li>';
           //$html = $html  . $Producto['nom_producto'] ;
         }

         echo json_encode($html,256);
       }

    }

    public function Varias_Referencias($Id_Agrupacion) {
      /**  ENERO 22 DE 2015   MUESTRA PRODUCTOS AGRUPADOS EN VARIOS REFERENCIAS
      */
       $this->View->Productos_Varias_Referencias = $this->Productos->Productos_x_Agrupacion( $Id_Agrupacion );
       $this->View->Nombre_Agrupacion            = $this->View->Productos_Varias_Referencias[0]['nom_agrupacion'];
       $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA'));
       $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
       $this->View->Mostrar_Vista('varias_referencias');
    }


    public function Destacados_Index() {
        $this->View->Productos_Desatacados = $this->Productos->Destacados_Index();
    }



    public function Destacados() {
         $this->View->Productos_Destacados = $this->Productos->Destacados_Index();
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_campo_3'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('destacados');
    }


    public function Ofertas_Index() {
         $this->View->Productos_Ofertas     = $this->Productos->Ofertas_Index();
    }


    public function Ofertas() {
         $this->View->Productos_Ofertas = $this->Productos->Productos_Ofertas();
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_campo_4'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('ofertas');
    }


     public function Productos_Tron() {
         Session::Set('Id_Area_Consulta','2');
         $this->View->SetCss(array('tron_carrito','tron_estilos_productos_tron','tron_productos_tron_active','tron_campo_1'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','tron_productos_tron'));
         $Id_Categoria_Ropa                = 1;
         $this->Productos_Tron_Consultar($Id_Categoria_Ropa);
         $this->View->Accesorios_Tron_Ropa = $this->_Accesorios_Tron;
         $this->View->Productos_Tron_Ropa  = $this->_Productos_Tron;
         $Id_Categoria_Banios                = 2;
         $this->Productos_Tron_Consultar($Id_Categoria_Banios);
         $this->View->Accesorios_Tron_Banios = $this->_Accesorios_Tron;
         $this->View->Productos_Tron_Banios  = $this->_Productos_Tron;
         $Id_Categoria_Pisos                = 3;
         $this->Productos_Tron_Consultar($Id_Categoria_Pisos );
         $this->View->Accesorios_Tron_Pisos = $this->_Accesorios_Tron;
         $this->View->Productos_Tron_Pisos  = $this->_Productos_Tron;
         $Id_Categoria_Loza                = 4;
         $this->Productos_Tron_Consultar( $Id_Categoria_Loza  );
         $this->View->Accesorios_Tron_Loza = $this->_Accesorios_Tron;
         $this->View->Productos_Tron_Loza  = $this->_Productos_Tron;
         $this->View->Productos_Carros_Motos = $this->Productos->Listar_Poductos_Carros_y_Motos();
         $this->View->Mostrar_Vista('productos_tron');
    }



    public function Productos_Tron_Consultar($Id_Categoria) {
      $this->_Productos_Tron  = $this->Productos->Productos_Tron_x_Id_Categoria_Producto($Id_Categoria);
      $this->_Accesorios_Tron = $this->Productos->Productos_Tron_Accesorios_x_Id_Categoria_Producto($Id_Categoria);
    }



    /*public function Novedades_Index() {
         $this->View->Productos_Novedades    = $this->Productos->Novedades_Ofertas();
         $this->View->Cantidad_Registros     = $this->Productos->Cantidad_Registros;
         Session::Set('Cantidad_Novedades' , $this->View->Cantidad_Registros );
    }
    */



    /*public function Novedades() {
         $this->View->Productos_Novedades = $this->Productos->Novedades_Ofertas();
         $this->View->Cantidad_Registros     = $this->Productos->Cantidad_Registros;
         Session::Set('Cantidad_Novedades' , $this->View->Cantidad_Registros );
         $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_estilos-titulos_destacados_novedades_ofertas','tron_varias_referencias-ofertas-tecnologias_SA','tron_campo_5'));
         $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
         $this->View->Mostrar_Vista('novedades');
    }
    */



    public function Hallar_Valor_Escala() {
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


    public function Vista_Ampliada($Idproducto , $Id_Area_Consulta,$reasigna_valores = 0, $idterceropresenta=0, $codigousuario_presenta='' ) {
     /** DIC 31 DE 2014
     *  MUESTRA INFORMACIÓN AMPLIADA DEL PRODUCTOS. TAMBIÉN ES POSIBLE COMPRAR DESDE ESTE SITIO
     */
      if( $reasigna_valores == TRUE){
          if ( $idterceropresenta > 0){
              $this->Terceros->Buscar_datos_x_Idtercero_Presenta( $idterceropresenta );
            }
        }
      Session::Set('Id_Area_Consulta',$Id_Area_Consulta) ; // 2, Corresponde a productos de la linea hogar
      $idproducto                          = $Idproducto ;
      $this->View->Favorito = FALSE ;
      if ( $_SESSION['logueado'] == TRUE ) {
          $Producto_Favorito                   = $this->Productos->Favoritos_Consulta_x_IdTercero_IdProducto(Session::Get('idtercero'),  $Idproducto );
          if ( empty(  $Producto_Favorito   )){
             $this->View->Favorito = FALSE ;
          }else{
            $this->View->Favorito = TRUE ;
          }
      }
      $ProductoBuscado               = $this->Productos->Buscar_por_IdProducto($idproducto);
      if ( $ProductoBuscado ){
            $this->View->Producto  = $ProductoBuscado ;
            $this->View->Producto_Imagenes       = $this->Productos->Imagenes_Consultar($idproducto);
            $this->View->Cantidad_Registros      = $this->Productos->Cantidad_Registros;

            $this->View->Productos_Tabs          = $this->Productos->Tabs_Consultar($idproducto);

            $this->View->Cantidad_Tabs           = $this->Productos->Cantidad_Registros;
            if ($Id_Area_Consulta ==2)   {// HOGAR
                $this->View->SetCss(array('tron_carrito','tron_productos_vista_ampliada','font_styles','tron_ventana_modal'));
            } else {
              $this->View->SetCss(array('tron_carrito','tron-vista-industrial','tron_productos_vista_ampliada','tron_ventana_modal'));
            }
            $this->View->SetJs(array('jquery.elevatezoom','tron_carrito','tron_productos.jquery','tron_tooltips'));
            $this->View->Producto_Encontrado = TRUE ;
    }else{
        $this->View->Producto_Encontrado = FALSE ;
    }

    if ( $this->View->Producto_Encontrado == TRUE ) {
          $this->View->Mostrar_Vista('vista_ampliada');
        }else {
          $this->View->Mostrar_Vista('vista_ampliada_no_existe');
        }

    }




    public function Detalle_Producto($Idproducto ,  $nombre_producto='') {
     /** DIC 31 DE 2014
     *  MUESTRA INFORMACIÓN AMPLIADA DEL PRODUCTOS. TAMBIÉN ES POSIBLE COMPRAR DESDE ESTE SITIO
     */
        Session::Set('IdProductoDetalle' , $Idproducto  );
        $nombre_producto = General_Functions::urls_amigables( $nombre_producto );
        $this->Redireccionar('productos/detalle/'.$nombre_producto .'/'.$Idproducto);
    }


 public function detalle( $nombre_producto='', $Idproducto=0    ){

    $Id_Area_Consulta = Session::Get('Id_Area_Consulta') ;
    $Idproducto = $this->View->Argumentos[1] ;
    if ( $Idproducto > 0 ) {
      $this->Vista_Ampliada ($Idproducto ,$Id_Area_Consulta );
      return ;
    }

     $idproducto                          = Session::Get('IdProductoDetalle') ;
      $this->View->Favorito = FALSE ;

      if ( $_SESSION['logueado'] == TRUE   ) {
          $Producto_Favorito                   = $this->Productos->Favoritos_Consulta_x_IdTercero_IdProducto(Session::Get('idtercero'),  $idproducto);
          if ( empty(  $Producto_Favorito   )){
             $this->View->Favorito = FALSE ;
          }else{
            $this->View->Favorito = TRUE ;
          }
      }

      $ProductoBuscado               = $this->Productos->Buscar_por_IdProducto($idproducto);

          if ( $ProductoBuscado ){
                $this->View->Producto  = $ProductoBuscado ;
                $this->View->Producto_Imagenes       = $this->Productos->Imagenes_Consultar($idproducto);
                $this->View->Cantidad_Registros      = $this->Productos->Cantidad_Registros;

                $this->View->Productos_Tabs          = $this->Productos->Tabs_Consultar($idproducto);

                $this->View->Cantidad_Tabs           = $this->Productos->Cantidad_Registros;
                if ($Id_Area_Consulta ==2)   {// HOGAR
                    $this->View->SetCss(array('tron_carrito','tron_productos_vista_ampliada','font_styles','tron_ventana_modal'));
                } else {
                  $this->View->SetCss(array('tron_carrito','tron-vista-industrial','tron_productos_vista_ampliada','tron_ventana_modal'));
                }
                $this->View->SetJs(array('jquery.elevatezoom','tron_carrito','tron_productos.jquery','tron_tooltips'));
                $this->View->Producto_Encontrado = TRUE ;
        }else{
            $this->View->Producto_Encontrado = FALSE ;
        }


      if ( $this->View->Producto_Encontrado == TRUE ) {
          $this->View->Mostrar_Vista('vista_ampliada');
        }else {
          $this->View->Mostrar_Vista('vista_ampliada_no_existe');
      }

 }








    public function Categorias_Marcas ( $pagina=false ){
     /** DIC 31 DE 2014
     *  MUSTRA EL MENU LATERAL DE DATOS RELACIONADOS CON CATEGORÍAS Y MARCAS
    */

           if ($pagina==false) {   $pagina = 1 ;};
            $Id_Area_Consulta  = Session::Get('Id_Area_Consulta');
            if ( !isset( $Id_Area_Consulta ) ){
              Session::Set('Id_Area_Consulta',2);
              $Id_Area_Consulta  = Session::Get('Id_Area_Consulta');
            }

            $this->View->Productos_Categorias_Nv_1 = $this->Productos->Categorias_Consultar($Id_Area_Consulta);
            $this->View->Productos_Categorias_Nv_2 = $this->Productos->SubCategorias_Consultar($Id_Area_Consulta);
            $this->View->Productos_Marcas          = $this->Marcas->Marcas_Consultar($Id_Area_Consulta);

            $this->View->Productos_Pagina          = $this->Productos->Listar_Poductos_Paginador($Id_Area_Consulta );
            $this->View->Productos_Pagina          = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
            $this->View->Paginacion                = $this->Paginador->Mostrar_Paginacion('paginador','productos/Categorias_Marcas');
            Session::Set('nom_categoria','');

            $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas','tron_varias_referencias-ofertas-tecnologias_SA','tron_campo_2'));
           $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias','menu-accordion'));

           //Debug::Mostrar( $this->View->Productos_Pagina ) ;
           $this->View->Mostrar_Vista('marcas_y_categorias');

    }// Fin Categorias_Marcas



    public function Productos_por_Categoria_Individual( ) {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};

      $_idorden_nv_1    = $this->View->Argumentos[0];
      $nom_categoria    = $this->View->Argumentos[1];
      $Id_Area_Consulta =  $this->View->Argumentos[2]; //Session::Get('Id_Area_Consulta');

      //if ($_idorden_nv_1 ='tron' ) {
        // Debug::Mostrar($this->View->Argumentos  );
      //}

      if ( empty($Id_Area_Consulta)){
          $Id_Area_Consulta = 2 ;
      }
      Session::Set('Id_Area_Consulta', $Id_Area_Consulta);      // Reasiga el area de consulta

      $nom_categoria    = String_Functions::Mayusculas($nom_categoria);
      // Datos usados para la paginación ajax. Determina el nivel de profundidad en el que se encuenta el menú.
      Session::Set('IdCategoria_n1',$_idorden_nv_1);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);               // Segundo nivel
      Session::Set('IdMarca',0);                      // Deplegado el menú de marcas. tron-vista-industrial.css

      $this->View->Productos_Categorias_Nv_1 = $this->Productos->Categorias_Consultar( $Id_Area_Consulta );
      $this->View->Productos_Categorias_Nv_2 = $this->Productos->SubCategorias_Consultar($Id_Area_Consulta);
      $this->View->Productos_Marcas          = $this->Marcas->Marcas_Consultar($Id_Area_Consulta);
      $this->View->Productos_Pagina          = $this->Productos->Productos_por_Categoria($Id_Area_Consulta,$_idorden_nv_1 );
      $this->View->Productos_Pagina          = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion                = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
      $this->View->nom_categoria             = $nom_categoria ;
      $this->View->idorden_nv_1              = $_idorden_nv_1;
      $this->View->Id_Area_Consulta          = $Id_Area_Consulta;
      Session::Set('nom_categoria', $nom_categoria);




      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));
      $this->View->Mostrar_Vista('marcas_y_categorias_individual');
    } // Fin Productos_por_Categoria

    public function Productos_por_Categoria( ) {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina = false;  };
      if ($pagina==false)  { $pagina = 1 ;     };

      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');


      $_idorden_nv_1    =  General_Functions::Validar_Entrada('idorden_nv_1','NUM');
      $nom_categoria    =  General_Functions::Validar_Entrada('nom_categoria','TEXT');


      Session::Set('IdCategoria_n1',$_idorden_nv_1);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);
      Session::Set('IdMarca',0);

      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));

      $this->View->Productos_Pagina = $this->Productos->Productos_por_Categoria( $Id_Area_Consulta, $_idorden_nv_1 );
      $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
      $this->View->nom_categoria    = strtoupper( $nom_categoria );
      Session::Set('nom_categoria',$nom_categoria );

       $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');

    } // Fin Productos_por_Categoria


    public function Productos_Mostrar_Via_Ajax() {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $pagina           =  General_Functions::Validar_Entrada('Pagina','NUM');
      $nom_categoria    =  General_Functions::Validar_Entrada('nombre_categoria','TEXT');
      $IdOrden_nv_1     = Session::Get('IdCategoria_n1');
      $IdOrden_nv_2     = Session::Get('IdCategoria_n2');
      $IdMarca          = Session::Get('IdMarca');



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
        if ( isset($this->View->Productos_Pagina)){
            $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
            $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
            $this->View->nom_categoria    = strtoupper($nom_categoria);
            Session::Set('nom_categoria', $nom_categoria);
            $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
            $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));
            $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');
        }else{
          echo "
                <h3> ¡Opps! <br> Parece que hemos tenido un inconveniente para mostrar los productos en la página que solicitaste. <br>Consúltalos por la categoría o la marca ubicadas en el lado izquierdo de nuestro sitio. Pronto solucionaremos esta utilidad.
                </h3>
                ";
        }

    } // Fin Productos_por_Categoria


   public function Productos_por_Sub_Categoria() {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR SUB CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');

      $_idorden_nv_2    =  General_Functions::Validar_Entrada('idorden_nv_2','NUM');
      $nom_categoria    =  General_Functions::Validar_Entrada('nom_categoria','TEXT');

      Session::Set('IdCategoria_n1',0);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',$_idorden_nv_2);
      Session::Set('IdMarca',0);
      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias'));
      $this->View->Productos_Pagina = $this->Productos->Productos_por_Sub_Categoria($Id_Area_Consulta,$_idorden_nv_2);
      $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
      $this->View->nom_categoria    = strtoupper( $nom_categoria );
      Session::Set('nom_categoria', $nom_categoria);
      $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');



    } // Fin Productos_por_Categoria


    private function Historial_Ultimo_Sitio_Visitado ( $Id_Area_Consulta, $Id_SubCategoria, $NomSubCategoria ) {

      if ( !isset( $_SESSION['ultimo_sitio_visitado'] )){
          $_SESSION['Ultimo_Sitio_Visitado']           = '';
          $_SESSION['Ultimo_Sitio_Id_Area_Consulta']   = 0;
          $_SESSION['Ultimo_Sitio_Id_SubCategoria']    = 0;
          $_SESSION['Ultimo_Sitio_Id_NomSubCategoria'] = '';
      }
       $_SESSION['Ultimo_Sitio_Visitado']           = $_GET['url'];
       $_SESSION['Ultimo_Sitio_Id_Area_Consulta']   = $Id_Area_Consulta;
       $_SESSION['Ultimo_Sitio_Id_SubCategoria']    = $Id_SubCategoria;
       $_SESSION['Ultimo_Sitio_Id_NomSubCategoria'] = $NomSubCategoria;

    }


    public function Productos_por_Marca() {
      /** ENERO 09 DE 2014
      *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
      *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
      */
      if (!isset($pagina)) { $pagina=false;}
      if ($pagina==false) {   $pagina = 1 ;};
      $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
      $idmarca          =  General_Functions::Validar_Entrada('idmarca','NUM');
      $nom_marca          =  General_Functions::Validar_Entrada('nom_marca','TEXT');
      Session::Set('IdCategoria_n1',0);  // Primer nivel menu lateral izquierdo
      Session::Set('IdCategoria_n2',0);
      Session::Set('IdMarca',$idmarca);
      $this->View->SetCss(array('tron_carrito' , 'tron_productos_categorias_marcas'));
      $this->View->SetJs(array('tron_marcas_categorias','tron_productos.jquery','tron_carrito'));
      $this->View->Productos_Pagina = $this->Productos->Productos_por_Marca($Id_Area_Consulta,$idmarca);
      $this->View->Productos_Pagina = $this->Paginador->Paginar($this->View->Productos_Pagina, $pagina);
      $this->View->Paginacion       = $this->Paginador->Mostrar_Paginacion('paginador_ajax');
       $this->View->nom_categoria    = strtoupper( $nom_marca );
       Session::Set('nom_categoria', $nom_marca);
      $this->View->Mostrar_Vista_Parcial('marcas_y_categorias_categoria');
    } // Fin Productos_por_Marca



 }
?>
