<?php
	class ProductosModel extends Model
	{
		public $Cantidad_Registros;

		public function __construct(){
			parent::__construct();
        }


        public function Favoritos_Borrar_x_IdTercero_IdProducto (  $idtercero, $idproducto ){
            $Productos    = $this->Db->Ejecutar_Sp("productos_favoritos_borrar_x_idtercero_idproducto (  $idtercero, $idproducto  )");
            return $Productos;
        }



        public function Favoritos_Consulta_x_IdTercero_IdProducto (  $idtercero, $idproducto ){
            $Productos    = $this->Db->Ejecutar_Sp("productos_favoritos_consulta_x_idtercero_idproducto (  $idtercero, $idproducto  )");
            $this->Cantidad_Registros = $this->Db->Cantidad_Registros;
            return $Productos;
        }



        public function Favoritos_Consulta_x_idTercero (  $idtercero){
            $Productos    = $this->Db->Ejecutar_Sp("productos_favoritos_consulta_por_idtercero (  $idtercero  )");
             return $Productos;
        }


        public function Favoritos_Grabar ($idproducto, $idtercero){
            $Productos    = $this->Db->Ejecutar_Sp("productos_favoritos_grabar ($idproducto, $idtercero  )");
        }

        public function Busqueda_General($texto_a_buscar, $tipo_busqueda)        {
            /**ENERO 22 DE 2015
            * REALIZA BÚSQUEDA DE PRODUCTOS DE ACUERDO A UN CRITERIO DEL USUARIO EN EL CUADRO BUSCAR    */
            $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
            if ( empty( $Id_Area_Consulta ) ) {
                 Session::Set('Id_Area_Consulta', 2);
                }

            $Id_Area_Consulta = Session::Get('Id_Area_Consulta');

            $Productos        = $this->Db->Ejecutar_Sp("productos_busqueda_general($Id_Area_Consulta,'$texto_a_buscar')");
            return $Productos;
        }

        public function Busqueda_Nombre ($texto_a_buscar, $tipo_busqueda=0, $Id_Area_Consulta=0)        {
            /**ENERO 22 DE 2015
            * REALIZA BÚSQUEDA DE PRODUCTOS DE ACUERDO A UN CRITERIO DEL USUARIO EN EL CUADRO BUSCAR    */
            if ( $Id_Area_Consulta == 0 ){
                $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
            }
            if ( empty( $Id_Area_Consulta ) ) { Session::Set('Id_Area_Consulta', 2); }

           // $Id_Area_Consulta = Session::Get('Id_Area_Consulta');

            $Productos        = $this->Db->Ejecutar_Sp("productos_busqueda_nombre($Id_Area_Consulta,'$texto_a_buscar')");
            return $Productos;
        }



        public function Productos_Tron_x_Id_Categoria_Producto($id_categoria)        {
            /**ENERO 23 DE 2014
            * CONSULTA TODOS LOS PRODUCTOS TRON DISPONIBLES PARA LA VENTA   */
            $Productos_Tron = $this->Db->Ejecutar_Sp("productos_listado_productos_tron_x_id_categoria_producto($id_categoria)");
            return $Productos_Tron;
        }

        public function Productos_Tron_Todos()        {
            /**ENERO 23 DE 2014
            * CONSULTA TODOS LOS PRODUCTOS TRON DISPONIBLES PARA LA VENTA   */
            $Productos_Tron = $this->Db->Ejecutar_Sp("productos_listado_productos_tron_todos()");
            return $Productos_Tron;
        }

        public function Productos_Tron_Accesorios_Todos()        {
            /**ENERO 23 DE 2014
            * CONSULTA TODOS LOS PRODUCTOS TRON DISPONIBLES PARA LA VENTA   */
            $Productos_Tron_Acc = $this->Db->Ejecutar_Sp("productos_listado_productos_tron_accesorios_todos()");
            return $Productos_Tron_Acc;
        }

        public function Productos_Tron_Accesorios_x_Id_Categoria_Producto($id_categoria)        {
            /**ENERO 23 DE 2014
            * CONSULTA TODOS LOS PRODUCTOS TRON DISPONIBLES PARA LA VENTA   */
            $Productos_Tron_Acc = $this->Db->Ejecutar_Sp("productos_listado_productos_tron_accesorios_x_id_categ_producto($id_categoria)");
            return $Productos_Tron_Acc;
        }


        public function Productos_x_Agrupacion($id_agrupacion)        {
            /**ENERO 16 DE 2014
            * MUESTRA PRODUCTOS DE UNA AGRUPACIÓN EN PARTICULAR    */
            $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
            $Productos_Destacados = $this->Db->Ejecutar_Sp("productos_buscar_por_idagrupacion('$Id_Area_Consulta','$id_agrupacion')");
            return $Productos_Destacados;
        }

		public function Destacados_Index()		{
			/**DIC 27 2014
			* MUESTRA ALETORIAMENTE   PRODUCTOS MARCADOS COMO DESTACADOS HOGAR (Id_Area_Consulta=2) INDUSTRIAL (Id_Area_Consulta=1) 	*/
            $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
            $Productos_Destacados = $this->Db->Ejecutar_Sp("productos_listado_destacados_index( $Id_Area_Consulta )");
             $this->Cantidad_Registros = $this->Db->Cantidad_Registros;
			return $Productos_Destacados;
		}

		public function Ofertas_Index()		{
			/** DIC 30 DE 2014.
			   CONSULTA TODAS LAS OFERTAS DISPONIBLES EN LA PÁGINA 				*/
             $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
			 $Productos_Ofertas = $this->Db->Ejecutar_Sp("productos_listado_ofertas_index($Id_Area_Consulta)");
              $this->Cantidad_Registros = $this->Db->Cantidad_Registros;
			 return $Productos_Ofertas;
		}

		public function Novedades_Ofertas()	 {
			/** DIC 30 DE 2014.
				CONSULTA TODAS LAS NOVEDADES DISPONIBLES EN LA PÁGINA 				*/
            $Id_Area_Consulta         = Session::Get('Id_Area_Consulta');
            $Productos_Novedades      = $this->Db->Ejecutar_Sp("productos_listado_novedades_index($Id_Area_Consulta)");
            $this->Cantidad_Registros = $this->Db->Cantidad_Registros;
			return $Productos_Novedades;
		}

        public function Productos_Ofertas()  {
            /** DIC 30 DE 2014.
                CONSULTA TODAS LAS NOVEDADES DISPONIBLES EN LA PÁGINA               */
            $Id_Area_Consulta         = Session::Get('Id_Area_Consulta');
            $Productos_Novedades      = $this->Db->Ejecutar_Sp("productos_listado_ofertas_todos ( $Id_Area_Consulta )");
            $this->Cantidad_Registros = $this->Db->Cantidad_Registros;
            return $Productos_Novedades;
        }


        public function Buscar_por_IdProducto($idproducto)   {
        	/** DIC 30 DE 2014.
        	* CONSULTA INFORMACIÓN DETALLADA DEL PRODUCTO 	*/
        	$Producto = $this->Db->Ejecutar_Sp("productos_buscar_por_idproducto ( $idproducto )");
        	return $Producto;
        }

        public function Tabs_Consultar($idproducto)   {
        	/** DIC 30 DE 2014.
        	* CONSULTA INFORMACIÓN DE LAS TABS QUE ESTÁN ASOCIADAS AL PRODUCTO*/
        	$Producto_Tabs = $this->Db->Ejecutar_Sp("productos_tabs_consulta_por_id_producto($idproducto)");
        	return $Producto_Tabs;
        }

        Public function Imagenes_Consultar($idproducto) {
        	/** DIC 30 DE 2014.
        	* CONSULTA LAS IMAGENES QUE PUEDA TENER ASOCIADAS EL PRODUCTO	*/
    		$Producto_Imagenes        = $this->Db->Ejecutar_Sp("productos_imagenes_consulta_por_idproducto($idproducto)");
    		$this->Cantidad_Registros  = $this->Db->Cantidad_Registros;
        	return $Producto_Imagenes;
        }

         Public function Categorias_Consultar($id_area_consulta)  {
        	/** ENERO 06 DE 2014
        	* CONSULTA LAS CATEGORÍAS	DE PRODUCTOS. CORRESPONDEN AL PRIMER NIVEL EN EL MENU LATERAL IZQUIERDO
        	* PARAMETROS  : $id_area_consulta ==> CORRESPONDE A SI SE ESTÁN CONSULTADO PRODUCTOS DE LA LINEA HOGAR(1) O  LA LINEA INDUSTRIAL (1)
        	*/

    		$Producto_Categorias        = $this->Db->Ejecutar_Sp("productos_categorias_nivel_1( $id_area_consulta )");
        	return $Producto_Categorias ;
        }

         Public function SubCategorias_Consultar($id_area_consulta) {
            /** ENERO 06 DE 2014
            * CONSULTA LAS SUBCATEGORÍAS   DE PRODUCTOS. CORRESPONDEN AL SEGUNDO NIVEL EN EL MENU LATERAL IZQUIERDO
            * PARAMETROS  : $id_area_consulta ==> CORRESPONDE A SI SE ESTÁN CONSULTADO PRODUCTOS DE LA LINEA HOGAR(1) O  LA LINEA INDUSTRIAL (1)
            */
            $Producto_SubCategorias        = $this->Db->Ejecutar_Sp("productos_categorias_nivel_2( $id_area_consulta )");
            return $Producto_SubCategorias  ;
        }

        public function Listar_Poductos_Paginador($id_area_consulta) {
            /** ENERO 09 DE 2014
            *  CONSULTA LOS PRODUCTOS PARA LA PAGINACIÓN
            */
            $Productos = $this->Db->Ejecutar_Sp("productos_listado_general_para_paginacion( $id_area_consulta)");
            return $Productos  ;
        }

        public function Listar_Poductos_Carros_y_Motos( ) {
            /** ENERO 16 DE 2017
            *  CONSULTA LOS PRODUCTOS PARA LA PAGINACIÓN
            */
            $Productos = $this->Db->Ejecutar_Sp("productos_listado_carros_y_motos()");
            return $Productos  ;
        }

        public function Productos_por_Categoria($id_area_consulta, $_idorden_nv_1) {
            /** ENERO 09 DE 2014
            *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
            *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
            */

            $Productos = $this->Db->Ejecutar_Sp("productos_buscar_por_idcategoria( $id_area_consulta,$_idorden_nv_1)");
            $this->Cantidad_Registros  = $this->Db->Cantidad_Registros;
            return $Productos  ;
        }


        public function Productos_por_Marca($id_area_consulta, $idmarca) {
            /** ENERO 09 DE 2014
            *  CONSULTA LOS PRODUCTOS POR MARCA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
            */
            $Productos = $this->Db->Ejecutar_Sp("productos_buscar_por_idmarca( $id_area_consulta,$idmarca)");
            return $Productos  ;
        }

        public function Productos_por_Sub_Categoria($id_area_consulta, $_idorden_nv_2) {
            /** ENERO 09 DE 2014
            *  CONSULTA LOS PRODUCTOS POR CATEGORIA. TIENE EN CUENTA EL AREA DE CONSULTA ( HOGAR O INDUSTRIAL)
            *   Y EL TIPO DE CATEGORÍA ( _idorden_nv_1)
            */
            $Productos = $this->Db->Ejecutar_Sp("productos_buscar_por_idsub_categoria( $id_area_consulta,$_idorden_nv_2)");
            $this->Cantidad_Registros  = $this->Db->Cantidad_Registros;
            return $Productos  ;
        }


    }
?>
