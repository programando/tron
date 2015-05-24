<?php

		class SessionesController extends Controller
		{


		    public function __construct()
		    {
		        parent::__construct();

		    }

		    public function index(){}

		    public function Pedidos_Reiniciar_Variables(){
											Session::Destroy('descuento_especial');
											Session::Destroy('descuento_especial_porcentaje');
											Session::Destroy('precio_especial');
											Session::Destroy('transporte_tron');
											Session::Destroy('vr_unitario_banios');
											Session::Destroy('vr_unitario_loza');
											Session::Destroy('vr_unitario_pisos');
											Session::Destroy('vr_unitario_ropa');
											//COLOCAR EN CERO LA CANTIDAD DE PRODUCTOS TRON
									  $carro = Session::Get('carrito');
							    foreach ($carro as $Productos) {
							        $NombreArray      = 'TRON'.$Productos['idproducto'] ;
							        Session::Destroy($NombreArray );
							      }
							    Session::Destroy('carrito');
							    Session::Destroy('CarritoTron');
							    Session::Destroy('Comisiones_Utilizadas');
							    Session::Destroy('compra_accesorios');
							    Session::Destroy('compra_otros_productos');
							    Session::Destroy('compra_productos_industriales');
							    Session::Destroy('compra_productos_tron');
							    Session::Destroy('compras_productos_fabricados_ta');
							    Session::Destroy('compras_realizadas_tron');
							    Session::Destroy('cumple_condicion_cpras_tron_industial');
							    Session::Destroy('flete_cobrado_otros');
							    Session::Destroy('Fletes_Cobrados_Transportadoras');
							    Session::Destroy('id_transportadora');
							    Session::Destroy('iddireccion_despacho');
							    Session::Destroy('tipo_despacho_pedido');
							    Session::Destroy('tipo_tarifa');

							    Session::Destroy('peso_accesorios');
							    Session::Destroy('peso_otros_productos');
							    Session::Destroy('peso_productos_industriales');
							    Session::Destroy('peso_productos_tron');
							    Session::Destroy('Puntos_Utilizados');
							    Session::Destroy('saldo_comisiones');
							    Session::Destroy('saldo_puntos_cantidad');
							    Session::Destroy('SubTotal_Pedido_Amigos');
							    Session::Destroy('SubTotal_Pedido_Ocasional');
							    Session::Destroy('vr_cupon_descuento');
							    Session::Destroy('Vr_Usado_Cupon_Descuento');
							    Session::Destroy('compras_productos_tron');

							    Session::Destroy('pv_tron_resumen');
           Session::Destroy('pv_ocas_resumen');

							    Session::Set('iddpto',32);
							    Session::Set('re_expedicion',FALSE);
							    Session::Set('nommcipio_despacho', 'CALI');
							    Session::Set('idmcipio', 153);
		    }




		 }
 ?>
