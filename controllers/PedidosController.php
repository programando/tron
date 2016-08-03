
<?php


class PedidosController extends Controller
{

		private $Datos_Carro;
    public function __construct()
    {
      parent::__construct();
      $this->Sessiones   = $this->Load_Controller('Sessiones');
      $this->Index       = $this->Load_Controller('Index');
      $this->Pedidos     = $this->Load_Model('Pedidos');
      $this->ComisPuntos = $this->Load_Model('ComisionesPuntos');
    }
    public function index() {}


    public function Genera_Consecutivo( $numero_pedido_anterior = 0 ){

        $Registro               = $this->Pedidos->Genera_Consecutivo();
        $numero_pedido          = $Registro[0]['numero_pedido'];
        Session::Set('numero_pedido', $numero_pedido);
        $this->Cambiar_Numero_Pedido ( $numero_pedido_anterior ,$numero_pedido  );

        $Datos = compact('numero_pedido');
        echo json_encode($Datos,256);
    }

    private function Cambiar_Numero_Pedido( $numero_pedido_anterior = 0, $numero_pedido_nuevo = 0 ){
      $this->Pedidos->Cambiar_Numero_Pedido( $numero_pedido_anterior, $numero_pedido_nuevo ) ;
    }

    public function historial_mis_pedidos()  {
        $idtercero = Session::Get('idtercero');
        $this->View->Pedidos            = $this->Pedidos->Historial_x_Idtercero($idtercero);
        $this->View->Cantidad_Registros = $this->Pedidos->Cantidad_Registros;
        $this->View->Mostrar_Vista_Parcial("mis_pedidos");
    }

    public function historial_mis_pedidos_x_tercero(){
        $idtercero = General_Functions::Validar_Entrada('idtercero','NUM');
        $this->View->Pedidos            = $this->Pedidos->Historial_x_Idtercero($idtercero);
        $this->View->Cantidad_Registros = $this->Pedidos->Cantidad_Registros;
        $this->View->Mostrar_Vista_Parcial("mis_pedidos_x_tercero");
    }

    public function historial_mis_pedidos_x_idpedido(){
           $idpedido                   = General_Functions::Validar_Entrada('idpedido','NUM');
           $this->View->Detalle_Pedido = $this->Pedidos->Consulta_Detalle_x_IdPedido($idpedido);
           $this->View->numero_pedido  = $this->View->Detalle_Pedido[0]['numero_pedido'];
           $this->View->idtercero      = $this->View->Detalle_Pedido[0]['idtercero'];

           $this->View->Mostrar_Vista_Parcial("mis_pedidos_x_id_pedido");
    }



    public function Eliminar(){
      /** JUNIO 15 DE 2015
       *        PERMITE LA ELIMINACIÓN DE PEDIDOS Y EL RETORNO DE LAS COMISIONES O PUNTOS QUE SE HAYAN UTILIZADO
       */
      $idtercero             = General_Functions::Validar_Entrada('idtercero','NUM');
      $idpedido              = General_Functions::Validar_Entrada('idpedido','NUM');
      $comisiones_utilizadas = General_Functions::Validar_Entrada('comisiones_utilizadas','DEC');
      $puntos_utilizados     = General_Functions::Validar_Entrada('puntos_utilizados','DEC');
      $numero_pedido         = General_Functions::Validar_Entrada('numero_pedido','NUM');
      $idtipo_registro       = 12 ; // REINTEGRO POR ELIMINACIÓN MANUAL DE PEDIDO
      $observacion           = 'ELIMINACIÓN DE PEDIDO NÚMERO : ' .  $numero_pedido;

      $this->Pedidos->Eliminar($idpedido );

      // REALIZA LA ENTRADA DE COMISIONES
      if ( isset($comisiones_utilizadas) && $comisiones_utilizadas > 0 ) {
          $datos           = compact('idtercero','idtipo_registro','comisiones_utilizadas','observacion');
          $this->ComisPuntos->Entrada_Comisiones($datos);
      }
      // REALIZA ENTRADA DE PUNTOS
      if( isset($puntos_utilizados) && $puntos_utilizados>0 ){
        $datos           = compact('idtercero','idtipo_registro','puntos_utilizados','observacion');
        $this->ComisPuntos->Puntos_Entrada($datos);
      }

      $this->View->Pedidos = $this->Pedidos->Historial_x_Idtercero($idtercero);
      $this->View->Mostrar_Vista_Parcial("mis_pedidos_x_tercero");
    }


    public function Grabar() {
					$id_forma_pago               = 0;
					$idtercero                   = Session::Get('idtercero_pedido');
					$iddireccion_despacho        = Session::Get('iddireccion_despacho');

					$vr_compra_tron              = Session::Get('precio_especial');
					$vr_compra_ta                = Session::Get('compra_productos_industriales');
					$vr_compra_acc               = Session::Get('compra_accesorios');
					$vr_compra_otros             = Session::Get('compra_otros_productos');

					$vr_comis_pago_pedidos       = Session::Get('Comisiones_Utilizadas') ;
					$vr_puntos_redimidos         = Session::Get('Puntos_Utilizados') ;
					$vr_inscripcion_red          = Session::Get('vr_inscripcion_red') ;

          $valor_declarado_pedido      = Session::Get('Valor_Declarado_Total') ;


          if ( !isset($vr_inscripcion_red))     { $vr_inscripcion_red    = 0 ;     }
          if ( !isset($vr_comis_pago_pedidos))  { $vr_comis_pago_pedidos = 0 ;     }
          if ( !isset($vr_puntos_redimidos))    { $vr_puntos_redimidos   = 0 ;     }

					$vr_fletes_tron              = 0 ;
					$vr_fletes_tron_otros        = 0 ;
					$vr_flete_seguro             = 0 ;
					$vr_flete_tron_otros_seguro  = 0 ;
					$vr_fletes_reserva           = 0 ;
					$vr_diferencia_recaudo       = 0 ;
					$vr_fletes_totales           = Session::Get('Vr_Transporte');
					$vr_total_pedido             = Session::Get('Vr_Total_Pedido_Real');

          Session::Set('Valor_Final_Pedido_Real',$vr_total_pedido );

					$puntos_redimidos            = $vr_puntos_redimidos;
					$solo_pago_inscripcion_red   = 0 ;
					$id_pase_cortesia            = 0 ;
					$idtercero_envia_pase        = 0 ;
					$pase_es_premium             = 0 ;
					$idtercero_recibe_comisiones = 0 ;

					$email_confirma_factura      = 0 ;
					$pagado_online               = 0 ;
					$pago_recibido               = 0 ;
          //Transporte Courrier
          $tipo_despacho               = Session::Get('tipo_despacho');
          $id_transportadora           = Session::Get('id_transportadora');
          $vr_flete                    = Session::Get('vr_flete');
          $valor_declarado             = Session::Get('valor_declarado');
          $peso_gramos_pedido          = Session::Get('Peso_Pedido_Courrier');

          $tipo_despacho_carga               = Session::Get('tipo_despacho_carga');
          $id_transportadora_carga           = Session::Get('id_transportadora_carga');
          $vr_flete_transportadora_carga     = Session::Get('vr_flete_carga');
          $vr_declarado_carga                = Session::Get('valor_declarado_carga');
          $peso_gramos_pedido_carga          = Session::Get('Peso_Pedido_Carga');
          $vr_payu_latam                     = Session::Get('vr_payu_latam');
          if ( !isset($id_transportadora_carga))    { $id_transportadora_carga   = 0 ;     }
          if ( !isset($tipo_despacho_carga))        { $tipo_despacho_carga   = 0 ;     }



    	  $Datos  = compact('id_forma_pago','idtercero','iddireccion_despacho', 'vr_compra_tron','vr_compra_ta','vr_compra_acc','vr_compra_otros','vr_comis_pago_pedidos',
          'vr_puntos_redimidos','vr_inscripcion_red','vr_fletes_tron','vr_fletes_tron_otros','vr_flete_seguro','vr_flete_tron_otros_seguro','vr_fletes_reserva','vr_diferencia_recaudo',
          'vr_fletes_totales','vr_total_pedido','puntos_redimidos','tipo_despacho','id_transportadora','solo_pago_inscripcion_red','id_pase_cortesia','idtercero_envia_pase',	'pase_es_premium',
        'idtercero_recibe_comisiones','peso_gramos_pedido',	'email_confirma_factura','pagado_online','pago_recibido','valor_declarado',
        'vr_flete','tipo_despacho_carga','peso_gramos_pedido_carga','id_transportadora_carga','vr_flete_transportadora_carga','vr_declarado_carga','vr_payu_latam');


      $Pedido            = $this->Pedidos->Grabar($Datos );
      $this->Datos_Carro = Session::Get('carrito');
      $IdPedido_Generado = $Pedido[0]['idpedido'];


     Session::Set('idpedido', 							$IdPedido_Generado);
     Session::Set('idpedido_temporal', 							$IdPedido_Generado);
     Session::Set('numero_pedido', 		$Pedido[0]['numero_pedido'] );
     Session::Set('vr_total_pedido', $vr_total_pedido );
     Session::Set('nombre_cliente',  $Pedido[0]['nombre_cliente'] );
     Session::Set('email',           $Pedido[0]['email'] );
     Session::Set('identificacion',  $Pedido[0]['identificacion'] );
     Session::Set('fecha_vence',     $Pedido[0]['fecha_vence'] );
     $numero_pedido = $Pedido[0]['numero_pedido'] ;

     $Valores           = '';
     $Datos             = '';
     $Texto_SQL         = "INSERT INTO pedidos_dt (idpedido,idproducto,cantidad,vrunitario,vr_total,idescala_dt,id_transportadora) VALUES ";

    	foreach ($this->Datos_Carro as $Productos)	{
          $idpedido          = $IdPedido_Generado;
          $idproducto        = $Productos['idproducto'];
          $cantidad          = $Productos['cantidad'];
          $vrunitario        = $Productos['precio_unitario_produc_pedido'];   ;
          $vr_total          = $Productos['precio_total_produc_pedido'];
          $idescala_dt       = $Productos['idescala_dt'];
          $tipo_despacho     = $Productos['tipo_despacho'];
          $id_transportadora = $Productos['id_transportadora'];

          $Valores           = $idpedido .',' .$idproducto .',' . $cantidad .',' . $vrunitario  . ',' . $vr_total  . ',' . $idescala_dt  ;
          $Valores           = $Valores  .',' . $id_transportadora ;
          $Valores           = '( ' . $Valores . ' ),';
          $Datos             = $Datos . $Valores ;
    	}

				$Texto_SQL = $Texto_SQL . $Datos;
				$Texto_SQL = substr($Texto_SQL, 0, strlen($Texto_SQL)-1);
				$Pedido_Dt = $this->Pedidos->Grabar_Detalle($Texto_SQL );

				// ESTABLECER COMISIONES POR PEDIDO
				$this->ComisPuntos->Establercer_Comsiones_Por_Pedido($IdPedido_Generado); // Directo con el modelo
        $this->Comisiones_Puntos_Actualizar($idtercero ,$numero_pedido , $vr_puntos_redimidos,$vr_comis_pago_pedidos);

				// VERIFICAR SI ESTOY GENERADON PEDIDO PARA UN AMIGO
        $Generando_Pedido_Amigo = Session::Get('Generando_Pedido_Amigo');

        /// REINICIAR TODAS LAS VARIABLES DE SESSIONES RELACIONADAS CON PEDIDOS
				$this->Sessiones->Pedidos_Reiniciar_Variables();
        $this->Index->Consultar_Datos_Transportadoras();
        Session::Set('Generando_Pedido_Amigo', $Generando_Pedido_Amigo); // Restablecer valor de esta variable
        echo "OK";
    }




    public function Comisiones_Puntos_Actualizar($idtercero,$numero_pedido , $Puntos_Utilizados, $Comisiones_Utilizadas){
      /** JUNIO 14 DE 2015
       *        REALIZA ACTUALIZACION DE COMISIONES Y PUNTOS
       */
        if ( $Comisiones_Utilizadas > 0 ){
            $tipo_registro = 3 ; // PAGO TOTAL/PARCIAL PEDIDO CON SALDO CTA. DINERO
            $this->ComisPuntos->Actualizar_Comisiones($idtercero,$tipo_registro,$numero_pedido ,$Comisiones_Utilizadas);
        }
        if ( $Puntos_Utilizados > 0 ){
            $tipo_registro = 16 ; // PAGO TOTAL/PARCIAL PEDIDO CON SALDO CTA. PUNTOS
            $this->ComisPuntos->Actualizar_Puntos($idtercero,$tipo_registro,$numero_pedido ,$Puntos_Utilizados);
        }


    }



    public function Forma_Pago_Efecty()  {
    /**
     * MAYO 01 DE 2015
     *      ESTABLECE LA FORMA DE PAGO PARA EL PEDIDO
     */
      $IdFormaPago         = 2;
      $IdPedido            = Session::Get('idpedido_temporal');
      $Pagado_Online 						= 0;
      $this->View->Mostrar_Vista('finalizar_pedido_pago_efecty');
      $this->Pedidos->Actualizar_Forma_Pago($IdPedido ,$IdFormaPago,$Pagado_Online);
    }

    public function ConfirmacionPayuLatam() {
      $this->View->Mostrar_Vista('finalizar_pedido_pago_payu_confirmacion');
    }

    public function Forma_Pago_Pedido_Payu_Latam() {/**
     * MAYO 01 DE 2015
     *      ESTABLECE LA FORMA DE PAGO PARA EL PEDIDO
     */
      $IdFormaPago   = 4;  // PAYU LATAM
      $IdPedido      = Session::Get('idpedido_temporal');
      $Pagado_Online = 1;
      Session::Set('idformapago',$IdFormaPago);
      $this->Pedidos->Actualizar_Forma_Pago($IdPedido ,$IdFormaPago,$Pagado_Online);
      $this->View->Mostrar_Vista_Parcial('finalizar_pedido_pago_payu_latam');
    }

    public function Pedido_Consulta_Datos_Cambio_Forma_Pago ( $idpedido ){
      return $this->Pedidos->Pedido_Consulta_Datos_Cambio_Forma_Pago($idpedido );
    }

}
?>
