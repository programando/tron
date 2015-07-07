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
        $this->Terceros   =  $this->Load_Controller('Terceros');
        $this->Parametros =  $this->Load_Model('Parametros');

    }

    public function Index()
    {
        Session::Set('Id_Area_Consulta','2') ; // 2, Corresponde a productos de la linea hogar

        // SE LLAMA EL MÉTODO EN EL CONTROLADOR PARA QUE CARGUE INFORMACIÓN DE LA CIUDAD DE CALI kit_vr_venta_valle

        $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho(0,153);
        $this->Terceros->Compra_Productos_Tron_Mes_Actual();
        $Parametros = $this->Parametros->Transportadoras();

        Session::Set('kit_vr_venta_valle',                $Parametros[0]['kit_vr_venta_valle']);            // Precio de venta del kit de inicio
        Session::Set('cuota_1_inscripcion',               $Parametros[0]['cuota_1_inscripcion']);           // valor de la 1 cuota de inscripcion
        Session::Set('subsidio_transporte_tron',          $Parametros[0]['subsidio_transporte_tron']);      // Subsidio de transporte productos tron
        Session::Set('kit_vr_transporte'                  ,0);
        // VALORES PAYU LATAM
        Session::Set('py_porciento_recaudo',          $Parametros[0]['py_porciento_recaudo']/100);
        Session::Set('py_vr_min_recaudo',             $Parametros[0]['py_vr_min_recaudo']);
        Session::Set('py_vr_adicional',               $Parametros[0]['py_vr_adicional']);
        Session::Set('valor_transferencia_bancaria',  Numeric_Functions::Formato_Numero($Parametros[0]['valor_transferencia_bancaria']));
        Session::Set('valor_minimo_transferencias',   Numeric_Functions::Formato_Numero($Parametros[0]['valor_minimo_transferencias']));
        Session::Set('factor_seguro_flete_otros_productos',             $Parametros[0]['factor_seguro_flete_otros_productos']);
        Session::Set('porciento_seguro_flete_productos_industriales',   $Parametros[0]['porciento_seguro_flete_productos_industriales']);

        if (Session::Get('autenticado') == FALSE ){
             Session::Set('usuario_viene_del_registro',     FALSE);
         }

        $this->View->Productos_Destacados_Index = $this->Productos->Destacados_Index();
        $this->View->Productos_Ofertas_Index    = $this->Productos->Ofertas_Index();
        $this->View->Productos_Novedades_Index  = $this->Productos->Novedades_Ofertas();

        $this->View->SetCss(array('tron_index','tron_carrito','tron_varias_referencias-ofertas-tecnologias_SA',
                                  'tron_estilos_slider','tron_estilos-titulos_destacados_novedades_ofertas'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias')); //'tron_login'

        $this->View->Mostrar_Vista('index');


        //factor_seguro_flete_otros_productos :
        //                      Factor que reduce el valor declarado en otros productos para efectos del cálculo del seguro...
        //porciento_seguro_flete_productos_industriales :
        //                      Porcentaje que se aplica al costo del productos para efectos del cálculo del seguro en los fletes del producto...


    }

    public function Cerrar_Sesion()
    {
        Session::Destroy();
        $this->Redireccionar();
    }

    public function industrial()
    {
        Session::Set('Id_Area_Consulta','1') ; // 1, Corresponde a la linea de productos industriales
        $this->View->Productos_Destacados_Index = $this->Productos->Destacados_Index();
        $this->View->Productos_Ofertas_Index    = $this->Productos->Ofertas_Index();
        $this->View->Productos_Novedades_Index  = $this->Productos->Novedades_Ofertas();
        $this->View->SetCss(array('tron_menu_footer','tron_index','tron_carrito',
                                  'tron_varias_referencias-ofertas-tecnologias_SA',
                                  'tron-vista-industrial','tron_estilos_slider',
                                  'tron_estilos-titulos_destacados_novedades_ofertas'));
        $this->View->SetJs(array('tron_productos.jquery','tron_carrito','tron_marcas_categorias')); //,'tron_login'
        $this->View->Mostrar_Vista('industrial');
    }


}



?>

