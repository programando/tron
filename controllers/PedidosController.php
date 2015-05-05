
<?php


class PedidosController extends Controller
{

		 private $Datos_Carro;
    public function __construct()
    {
      parent::__construct();
      $this->Carrito       = $this->Load_Controller('Carrito');
      $this->Pedido        = $this->Load_Model('Pedidos');
    }
    public function index() {}

    public function Grabar()
    {
					$id_forma_pago               = 0;
					$idtercero                   = Session::Get('idtercero_pedido');
					$iddireccion_despacho        = Session::Get('iddireccion_despacho');
					$vr_compra_tron              = Session::Get('compra_productos_tron');
					$vr_compra_ta                = Session::Get('compra_productos_industriales');
					$vr_compra_acc               = Session::Get('compra_accesorios');
					$vr_compra_otros             = Session::Get('compra_otros_productos');
					$vr_comis_pago_pedidos       = Session::Get('Comisiones_Utilizadas') ;
					$vr_puntos_redimidos         = Session::Get('Puntos_Utilizados') ;
					$vr_inscripcion_red          = 0 ;
					$vr_fletes_tron              = 0 ;
					$vr_fletes_tron_otros        = 0 ;
					$vr_flete_seguro             = 0 ;
					$vr_flete_tron_otros_seguro  = 0 ;
					$vr_fletes_reserva           = 0 ;
					$vr_diferencia_recaudo       = 0 ;
					$vr_fletes_totales           = Session::Get('Vr_Transporte');
					$vr_total_pedido             = Session::Get('Vr_Total_Pedido_Real');
					$puntos_redimidos            = Session::Get('Puntos_Utilizados') ;
					$tipo_despacho               = 0 ;
					$id_transportadora           = 0 ;
					$solo_pago_inscripcion_red   = 0 ;
					$id_pase_cortesia            = 0 ;
					$idtercero_envia_pase        = 0 ;
					$pase_es_premium             = 0 ;
					$idtercero_recibe_comisiones = 0 ;
					$peso_gramos_pedido          = Session::Get('Peso_Total_Pedido_Kilos') * 1000 ;
					$email_confirma_factura      = 0 ;
					$pagado_online               = 0 ;
					$pago_recibido               = 0 ;
    	$Datos                      = compact('id_forma_pago','idtercero','iddireccion_despacho', 'vr_compra_tron',																		'vr_compra_ta','vr_compra_acc','vr_compra_otros','vr_comis_pago_pedidos',  																        'vr_puntos_redimidos','vr_inscripcion_red','vr_fletes_tron','vr_fletes_tron_otros',														        'vr_flete_seguro','vr_flete_tron_otros_seguro','vr_fletes_reserva','vr_diferencia_recaudo',													    'vr_fletes_totales','vr_total_pedido','puntos_redimidos','tipo_despacho',																	    'id_transportadora','solo_pago_inscripcion_red','id_pase_cortesia','idtercero_envia_pase',												        'pase_es_premium','idtercero_recibe_comisiones','peso_gramos_pedido',																		    'email_confirma_factura','pagado_online','pago_recibido');

    	$Pedido 											= $this->Pedido->Grabar($Datos );
    	$this->Datos_Carro = Session::Get('carrito');
     $Texto_SQL         = "INSERT INTO pedidos_dt (idpedido,idproducto,cantidad,vrunitario,vr_total,idescala_dt) VALUES ";
     $IdPedido_Generado = $Pedido[0]['idpedido'];

     Session::Set('idpedido', 							$IdPedido_Generado);
     Session::Set('numero_pedido', 		$Pedido[0]['numero_pedido'] );
     Session::Set('vr_total_pedido', $vr_total_pedido );
     Session::Set('nombre_cliente',  $Pedido[0]['nombre_cliente'] );
     Session::Set('email',           $Pedido[0]['email'] );
     Session::Set('identificacion',  $Pedido[0]['identificacion'] );

     $Valores           = '';
     $Datos             = '';

    	foreach ($this->Datos_Carro as $Productos)
    	{
							$idpedido  	 = $IdPedido_Generado;
							$idproducto  = $Productos['idproducto'];
							$cantidad    = $Productos['cantidad'];
							$vrunitario  = $Productos['precio_unitario_produc_pedido'];   ;
							$vr_total    = $Productos['precio_total_produc_pedido'];
							$idescala_dt = $Productos['idescala_dt'];
							$Valores     = $idpedido .',' .$idproducto .',' . $cantidad .',' . $vrunitario  . ',' . $vr_total  . ',' . $idescala_dt  ;
							$Valores     = '( ' . $Valores . ' ),';
							$Datos 		    = $Datos . $Valores ;
    	}
				$Texto_SQL = $Texto_SQL . $Datos;
				$Texto_SQL = substr($Texto_SQL, 0, strlen($Texto_SQL)-1);
				$Pedido_Dt = $this->Pedido->Grabar_Detalle($Texto_SQL );

    Session::Set('SubTotal_Pedido_Ocasional',0);
    Session::Set('SubTotal_Pedido_Amigos',0);
    Session::Destroy('carrito');

    echo "OK";
    }



}
