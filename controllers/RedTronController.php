

<?php

class RedTronController extends Controller
{

    private $Cantidad_Registros;
    public function __construct()
    {
        parent::__construct();

    }

    public function index(){}


    public function red_de_amigos_tron()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba','tabs-prueba'));
        $this->View->Mostrar_Vista("red_de_amigos_tron");

    }


        public function pases_de_cortesia()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("pases_de_cortesia");
    }


        public function planes_de_registro()
    {
        $this->View->SetCss(array('tron_red_amigo_general','tron_Planes_funcionalidades'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("planes_de_registro");
    }

        public function funcionalidades_interesantes()
    {
        $this->View->SetCss(array('tron_red_amigo_general','tron_Planes_funcionalidades'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("funcionalidades_interesantes");
    }

        public function tron_medios_pago()
    {
        $this->View->SetCss(array('tron_red_amigo_general','tron_pagos_transporte'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("medios_pago");
    }

            public function tron_transporte()
    {
        $this->View->SetCss(array('tron_red_amigo_general','tron_pagos_transporte'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("transporte");
    }

            public function tron_productos()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("productos_tron");
    }

           public function kint_de_inicio()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("kit_de_inicio");
    }

           public function comisiones()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("comisiones");
    }

           public function bonificaciones()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("Bonificaciones");
    }

            public function garantia_calidad()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("garantia_calidad");
    }

            public function tecnologias_SA()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("tecnologias_SA");
    }

            public function terminos_condiciones()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("terminos_condiciones");
    }

            public function contactanos()
    {
        $this->View->SetCss(array('tron_red_amigo_general','tron_campo_6','tron_indus_campo_3'));
        $this->View->SetJs(array('tron_redtron_formulario','tron_btn_ir_arriba'));
        $this->View->Mostrar_Vista("contactanos");
    }

            public function preguntas_frecuentes()
    {
        $this->View->SetCss(array('tron_red_amigo_general'));
        $this->View->SetJs(array('preguntas_frecuentes','tron_btn_ir_arriba','menu-accordion'));
        $this->View->Mostrar_Vista("preguntas_frecuentes");
    }


}

?>

