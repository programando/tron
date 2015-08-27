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
      $this->Calcular_Flete_Courrier   = TRUE;
      $this->Tron_Peso_Total_Gramos    = 0 ;
      $this->Tron_Cmv_Total            = 0 ;
      $this->Tron_Precio_Lista_Total   = 0 ;
      $kit_inicio_peso_total           = 0;
      $kit_cantidad                    = 0;

      $this->compras_tron               = 0 ;     $this->compras_industrial         = 0 ;      $this->compras_otros_productos    = 0 ;
      $this->compras_accesorios         = 0 ;

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
          $idproducto                          = $Productos['idproducto'];

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
           }
           ;
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
        }
        if ( $id_categoria_producto == 6) {  // Industriales
            $this->compras_industrial = $this->compras_industrial  + $Productos['sub_total_pv_tron'] ;
            $this->Calcular_Flete_Courrier = FALSE ;
        }
        if ($idproducto == 10744){
            $kit_inicio_peso_total = $kit_inicio_peso_total + $Productos['peso_gramos'];
            $kit_cantidad          =  $kit_cantidad + $cantidad;
        }

      } // Final foreach

        if ( $tengo_productos_tron == TRUE) {
            $datos=compact('Cantidad_Ropa','Peso_Ropa','Cmv_Ropa','Precio_Lista_Ropa',
                         'Cantidad_Banios','Peso_Banios','Cmv_Banios','Precio_Lista_Banios',
                         'Cantidad_Pisos','Peso_Pisos','Cmv_Pisos','Precio_Lista_Pisos',
                         'Cantidad_Loza','Peso_Loza','Cmv_Loza','Precio_Lista_Loza');
          $this->Productos_Tron->Hallar_Precio_Especial( $this->Parametros->Transportadoras(), $datos);
        }

        Session::Set('kit_inicio_peso_total',     $kit_inicio_peso_total);
        Session::Set('kit_cantidad',              $kit_cantidad);

        $this->Determinar_Precio_Real_Producto( $this->compras_tron , $this->compras_industrial );
        $this->Totalizar_Pedido_x_Categoria_Producto();              // Totaliza categorias de productos, para grabar en el pedido
        $this->Fletes->Calcular_Flete($this->Valor_Declarado, $this->Calcular_Flete_Courrier );
        $this->Calcular_Valor_Recaudo($aplica_vr_recaudo);

        //TOTALES DEL CARRITO
        //-----------------------
        $this->Vr_Fletes = Session::Get('flete_cobrado_otros');
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

        $this->Totalizar_Carrito_Aplicacion_Puntos_Comisiones_Cupon();

        Session::Set('Peso_Total_Pedido_Kilos',   $this->Peso_Total_Pedido_Kilos);
        Session::Set('SubTotal_Pedido_Ocasional', $this->SubTotal_Pedido_Ocasional );
        Session::Set('SubTotal_Pedido_Amigos',    $this->SubTotal_Pedido_Amigos );
        Session::Set('presupuesto_flete_otros',   $this->Presupuesto_Fletes );
        Session::Set('Vr_Transporte',             $this->Vr_Transporte);
        Session::Set('Vr_Total_Pedido_Real',      $this->Vr_Total_Pedido_Real);
        Session::Set('Vr_Recaudo',                $this->Vr_Recaudo);
        Session::Set('Vr_Base_Iva',               $this->Vr_Base_Iva);

        $this->Peso_Total_Pedido_Kilos   = (int)$this->Peso_Total_Pedido_Kilos ;
        $this->Cerrar_Procesos_Carro();
    }
