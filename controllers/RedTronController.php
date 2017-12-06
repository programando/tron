

<?php

class RedTronController extends Controller
{

    private $Cantidad_Registros;


    public function __construct()  {
        parent::__construct();
        $this->RedTron = $this->Load_Model('RedTron');
        $this->Index   = $this->Load_Controller('Index');
        $this->Index->Parametros_Iniciales();
    }

    public function index(){}



    public function red_de_amigos_tron()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba','tabs-prueba'));
            //$this->View->Mostrar_Vista("red_de_amigos_tron");
            $this->View->Mostrar_Vista("planes_de_registro");
        }


    public function pases_de_cortesia()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("pases_de_cortesia");
        }


    public function planes_registro()
        {
            $this->View->SetCss(array('tron_red_amigo_general','tron_Planes_funcionalidades','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("planes_de_registro");
        }

    public function funcionalidades_interesantes()
        {
            $this->View->SetCss(array('tron_red_amigo_general','tron_Planes_funcionalidades','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("funcionalidades_interesantes");
        }

    public function tron_medios_pago()
        {
            $this->View->SetCss(array('tron_red_amigo_general','tron_pagos_transporte','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("medios_pago");
        }

    public function tron_transporte()
        {
            $this->View->SetCss(array('tron_red_amigo_general','tron_pagos_transporte','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("transporte");
        }

    public function tron_productos()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("productos_tron");
        }



    public function comisiones()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("comisiones");
        }

    public function bonificaciones()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("Bonificaciones");
        }

    public function garantia_calidad()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("garantia_calidad");
        }

    public function tecnologias_SA()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("tecnologias_SA");
        }

    public function terminos_condiciones()
        {
            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('tron_btn_ir_arriba'));
            $this->View->Mostrar_Vista("terminos_condiciones");
        }

   public function contactanos()
        {

            $this->View->SetCss(array('tron_red_amigo_general','tron_campo_6','tron_indus_campo_3','unificar_botones'));
            $this->View->SetJs(array('tron_redtron_formulario','tron_btn_ir_arriba', 'tron_contactos'));
            $this->View->Mostrar_Vista("contactanos");
        }

    public function preguntas_frecuentes()
        {

            $this->View->Bonificacion_Cuotas        = $this->RedTron->Bonificaciones_Cuotas();
            $this->View->Bonificaciones_Porcentajes = $this->RedTron->Bonificaciones_Porcentajes();

            $this->View->SetCss(array('tron_red_amigo_general','unificar_botones'));
            $this->View->SetJs(array('preguntas_frecuentes','tron_btn_ir_arriba','menu-accordion'));
            $this->View->Mostrar_Vista("preguntas_frecuentes");
        }


}

?>

