
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
					$id_forma_pago               = 1;
					$idtercero                   = 80026;
					$iddireccion_despacho        = 19526;
					$vr_compra_tron              = Session::Get('compra_productos_tron');
					$vr_compra_ta                = Session::Get('compra_productos_industriales');
					$vr_compra_acc               = Session::Get('compra_accesorios');
					$vr_compra_otros             = Session::Get('compra_otros_productos');
					$vr_comis_pago_pedidos       = 0 ;
					$vr_puntos_redimidos         = 0 ;
					$vr_inscripcion_red          = 0 ;
					$vr_fletes_tron              = 0 ;
					$vr_fletes_tron_otros        = 0 ;
					$vr_flete_seguro             = 0 ;
					$vr_flete_tron_otros_seguro  = 0 ;
					$vr_fletes_reserva           = 0 ;
					$vr_diferencia_recaudo       = 0 ;
					$vr_fletes_totales           = Session::Get('vr_transporte_cliente');
					$vr_total_pedido             = 0 ;
					$puntos_redimidos            = 0 ;
					$tipo_despacho               = 0 ;
					$id_transportadora           = 0 ;
					$solo_pago_inscripcion_red   = 0 ;
					$id_pase_cortesia            = 0 ;
					$idtercero_envia_pase        = 0 ;
					$pase_es_premium             = 0 ;
					$idtercero_recibe_comisiones = 0 ;
					$peso_gramos_pedido          = 0 ;
					$email_confirma_factura      = 0 ;
					$pagado_online               = 0 ;
					$pago_recibido               = 0 ;


    	$Datos                      = compact('id_forma_pago','idtercero','iddireccion_despacho', 'vr_compra_tron',
    																																							'vr_compra_ta','vr_compra_acc','vr_compra_otros','vr_comis_pago_pedidos',
    																																							'vr_puntos_redimidos','vr_inscripcion_red','vr_fletes_tron','vr_fletes_tron_otros',
    																																							'vr_flete_seguro','vr_flete_tron_otros_seguro','vr_fletes_reserva','vr_diferencia_recaudo',
    																																							'vr_fletes_totales','vr_total_pedido','puntos_redimidos','tipo_despacho',
    																																							'id_transportadora','solo_pago_inscripcion_red','id_pase_cortesia','idtercero_envia_pase',
    																																							'pase_es_premium','idtercero_recibe_comisiones','peso_gramos_pedido',
    																																							'email_confirma_factura','pagado_online','pago_recibido');
    	$Pedido = $this->Pedido->Grabar($Datos );
    	//Debug::Mostrar($Pedido);

    	$this->Datos_Carro = Session::Get('carrito');
					$Texto_SQL     = "INSERT INTO pedidos_dt (idpedido,idproducto,cantidad,vrunitario,vr_total,idescala_dt) VALUES ";
					$Valores       = '';
					$Datos         = '';

    	foreach ($this->Datos_Carro as $Productos)
    	{
    			$idpedido  		= $Pedido[0]['idpedido'];
    			$idproducto  = $Productos['idproducto'];
    			$cantidad    = $Productos['cantidad'];
    			$vrunitario  = 200 ;//$Productos['cantidad'];
    			$vr_total    = 400;
    			$idescala_dt = 0;
    			$Valores     = $idpedido .',' .$idproducto .',' . $cantidad .',' . $vrunitario  . ',' . $vr_total  . ',' . $idescala_dt  ;
    			$Valores     = '( ' . $Valores . ' ),';
    			$Datos 						= $Datos . $Valores ;
    	}
					$Texto_SQL = $Texto_SQL . $Datos;
					$Texto_SQL = substr($Texto_SQL, 0, strlen($Texto_SQL)-1);

					$Pedido_Dt = $this->Pedido->Grabar_Detalle($Texto_SQL );

					//Debug::Mostrar($Texto_SQL);
					    	//Debug::Mostrar($this->Datos_Carro);

    }

}
