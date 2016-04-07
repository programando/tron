<?php
	/* AGOSTO 24 DE 2014
			Realiza la llamada a la vista correspondiente y traslada los parametros que necesita
			a Cada controlador el corresponde una vista. en el proyecto se encuentran dentro de carpetas
			La extensión de estas vistas es PHTML, dentro del rectorio views
	 */
class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Productos  =  $this->Load_Model('Productos');
        $this->Parametros =  $this->Load_Model('Parametros');

        $this->Terceros   =  $this->Load_Controller('Terceros');
        $this->Sessiones   = $this->Load_Controller('Sessiones');

    }

    public function industrial(){
        Session::Set('Id_Area_Consulta','1') ; // 1, Corresponde a la linea de productos industriales
        $this->View->Productos_Destacados_Index = $this->Productos->Destacados_Index();
        Session::Set('Cantidad_Destacados_Industrial', $this->Productos->Cantidad_Registros);
        $this->View->SetCss(array('tron_menu_footer','tron_index','tron_carrito',
                                  'tron_varias_referencias-ofertas-tecnologias_SA',
                                  'tron-vista-industrial','tron_estilos_slider',
                                  'tron_estilos-titulos_destacados_novedades_ofertas'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias')); //,'tron_login'
        $this->View->Mostrar_Vista('industrial');
    }



    public function Index() {
        //$info               = General_Functions::Datos_Navegador();
        //$Tipo_Navegador     = $info['browser'];
        //$Tipo_Navegador_2   = $info['browser'];
        //$Version_Navegador  = (int)$info['version'];


        $this->Parametros_Iniciales();

        $usuario_logueado = Session::Get('logueado');
        if ( !isset( $usuario_logueado )){
            Session::Set('logueado',FALSE);
            Session::Set('idtipo_plan_compras',1);
        }
        // SE LLAMA EL MÉTODO EN EL CONTROLADOR PARA QUE CARGUE INFORMACIÓN DE LA CIUDAD DE CALI kit_vr_venta_valle
        if ( $usuario_logueado == FALSE){
            Session::Set('usuario_viene_del_registro',     FALSE);
        }else{
                $this->Terceros->Compra_Productos_Tron_Mes_Actual();
            }

        $this->View->Productos_Destacados_Index = $this->Productos->Destacados_Index();
        Session::Set('Cantidad_Destacados',     $this->Productos->Cantidad_Registros );

        $this->View->Productos_Ofertas_Index    = $this->Productos->Ofertas_Index();
        Session::Set('Cantidad_Ofertas',        $this->Productos->Cantidad_Registros );

        $this->View->Productos_Novedades_Index  = $this->Productos->Novedades_Ofertas();
        Session::Set('Cantidad_Novedades' ,     $this->Productos->Cantidad_Registros );

        // Categorias  del footer
        //------------------------
        $this->Footer_Categorias_Personal_Industrial();

        $this->View->SetCss(array('tron_index','tron_carrito','tron_varias_referencias-ofertas-tecnologias_SA',
                                  'tron_estilos_slider','tron_estilos-titulos_destacados_novedades_ofertas'));
        $this->View->SetJs(array('tron_productos.jquery','tron_marcas_categorias','tron_carrito')); //'tron_login'

         $this->View->Mostrar_Vista('index');

        //factor_seguro_flete_otros_productos :
        //                      Factor que reduce el valor declarado en otros productos para efectos del cálculo del seguro...
        //porciento_seguro_flete_productos_industriales :
        //                      Porcentaje que se aplica al costo del productos para efectos del cálculo del seguro en los fletes del producto...

       /*if ( $Tipo_Navegador == 'IE' && $Version_Navegador <= 8){
            $this->View->SetCss(array("tron_mejor_experiencia_usuario"));
            $this->View->Mostrar_Vista("mejor_experiencia_usuario");
       }
       */

    }

    private function Footer_Categorias_Personal_Industrial(){
        $Categorias_Hogar      = $this->Productos->Categorias_Consultar(2);
        $Categorias_Industrial = $this->Productos->Categorias_Consultar(1);
        Session::Set('Categorias_Hogar',         $Categorias_Hogar);
        Session::Set('Categorias_Industrial',    $Categorias_Industrial);
    }

private function Parametros_Iniciales(){

        // VALORES PARA CALCULO DE TRANSPORTE
        $redetrans_tipo_despacho = Session::Get('redetrans_tipo_despacho');
        if ( !isset( $redetrans_tipo_despacho )) {
             $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho( 0, 153);
        }

        $Parametros = $this->Parametros->Transportadoras();

        Session::Set('Id_Area_Consulta','2') ; // 2, Corresponde a productos de la linea hogar
        Session::Set('Parametros',$Parametros );

        Session::Set('kit_vr_venta_valle',                $Parametros[0]['kit_vr_venta_valle']);            // Precio de venta del kit de inicio

        Session::Set('valor_kit_inicio_ocasional',        $Parametros[0]['valor_kit_inicio_ocasional']);
        Session::Set('valor_kit_inicio_empresario',       $Parametros[0]['valor_kit_inicio_empresario']);

        Session::Set('cuota_1_inscripcion',               $Parametros[0]['cuota_1_inscripcion']);
                // valor de la 1 cuota de inscripcion
        Session::Set('subsidio_transporte_tron',          $Parametros[0]['subsidio_transporte_tron']);      // Subsidio de transporte productos tron
        Session::Set('kit_vr_transporte'                  ,0);

        // VALORES PAYU LATAM
        Session::Set('py_porciento_recaudo',          $Parametros[0]['py_porciento_recaudo']/100);
        Session::Set('py_vr_min_recaudo',             $Parametros[0]['py_vr_min_recaudo']);
        Session::Set('py_vr_adicional',               $Parametros[0]['py_vr_adicional']);

        Session::Set('py_vr_min_recaudo_', $Parametros[0]['py_vr_min_recaudo']);

        Session::Set('valor_transferencia_bancaria',  Numeric_Functions::Formato_Numero($Parametros[0]['valor_transferencia_bancaria']));
        Session::Set('valor_minimo_transferencias',   Numeric_Functions::Formato_Numero( $Parametros[0]['valor_minimo_transferencias'] ));
        Session::Set('factor_seguro_flete_otros_productos',             $Parametros[0]['factor_seguro_flete_otros_productos']);
        Session::Set('porciento_seguro_flete_productos_industriales',   $Parametros[0]['porciento_seguro_flete_productos_industriales']);

        Session::Set('rt_courrier_seguro'                  ,  $Parametros[0]['rt_courrier_seguro']);          // Valor seguro mínimo para couurier. Aplica para productos TRON

        // VALORES PAYU LATAM
        Session::Set('py_porciento_recaudo'                                 ,   $Parametros[0]['py_porciento_recaudo']/100);
        Session::Set('py_vr_min_recaudo'                                    ,   $Parametros[0]['py_vr_min_recaudo']);
        Session::Set('py_vr_adicional'                                      ,   $Parametros[0]['py_vr_adicional']);
        Session::Set('valor_minimo_pedido_productos',          Numeric_Functions::Formato_Numero( $Parametros[0]['valor_minimo_pedido_productos'] ));
        Session::Set('pedido_minimo_productos_fabricados_ta',  Numeric_Functions::Formato_Numero( $Parametros[0]['pedido_minimo_productos_fabricados_ta']));
        Session::Set('pago_minimo_payulatam',                  Numeric_Functions::Formato_Numero( $Parametros[0]['pago_minimo_payulatam'] ));
        Session::Set('Aplicacion_Puntos_Comisiones', TRUE);


}


    public function Cerrar_Sesion() {
        Session::Set('logueado', FALSE );
        session_unset($_SESSION['logueado']);
        $this->Sessiones->Pedidos_Reiniciar_Variables();
        Session::Destroy();


        echo '

			<!DOCTYPE html>
			<html lang="es">
			<head>
			<meta charset="UTF-8">
				<title>Cerrando Sesión</title>
				<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,400italic" rel="stylesheet" type="text/css">
				<!-- CSS de Bootstrap -->
				<link type="text/css" rel="stylesheet" href="../public/css/bootstrap.min.css" media="screen" />
				<link type="text/css" rel="stylesheet" href="../public/css/custom.css" media="screen" />

				<link type="text/css" rel="stylesheet" href="../public/css/super_css.css"  />
				<link type="text/css" rel="stylesheet" href="../public/css/super_css_responsive.css"  />

				<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
				<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
				<script src ="../public/js/super_jquerion.js" type="text/javascript" ></script>

				<script language="JavaScript" type="text/javascript">
					setTimeout(\'self.location=\"../\"\', 500)
				</script>
			</head>
			<body>

				<div class="closeSesssion">
					<div class="tabAll">
						<div class="tabIn taC">
							<span class="t24 ff0">Estamos cerrando tu sesión...</span>
							<br /><br />
							<img src="../public/images/tienda/ring.gif">
						</div>
					</div>
				</div>

			</body>
			</html> '
		;
    }



}



?>

