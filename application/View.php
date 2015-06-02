<?php
/**
 * AGOSTO 24 DE 2014
 * CONTROLA/ADMINISTRA EL TRABAJO CON LAS VISTAS
 */

    class View
    {
        protected $Controlador;
        protected $Vars = array();
        public    $Mensaje_Error;
        protected    $Css    = array();
        protected    $Js     = array();
        public   $Argumentos = array();




        public function __construct(Request $peticion)
        {
            $this->Controlador = $peticion->getControlador();
            $this->Argumentos  = $peticion->getArgs();
            $this->Css         = array();
            $this->Js          = array();
            //Debug::Mostrar($this->Argumentos);
        }



        public function Mostrar_Vista($vista,$View_Vars=array())
        {
         /**
         * REALIZA LA LLAMADA A LA VISTA DE ACUERDO A SU CONTROLADOR
         * @param [text] $vista     [nombre de la vista]
         * @param array  $View_Vars [parámetros para la vista]
         */
         $this->Controlador = strtolower( $this->Controlador);
         $vista             = strtolower($vista );
         $RutaView     = ROOT .  'views' . DS  . $this->Controlador. DS . $vista . '.phtml';
         $RutaTemplate = ROOT .  'views' . DS . 'template.phtml';
         $RutaFooter   = ROOT .  'views' . DS . 'footer.phtml';

         Debug::Mostrar($RutaView );

             if(is_readable($RutaView))
            {

               extract($View_Vars);
               ob_start();
               require_once ($RutaView);
               $ContenidoBody = ob_get_clean();
               require_once ($RutaTemplate);

            }
            else {
                //throw new Exception(header('Location: ' . BASE_URL .'error/404.php'));
              Debug::Mostrar($RutaView );
            }

          }

        public function Mostrar_Vista_Parcial($vista)
        {
         /**
         * REALIZA LA LLAMADA A LA VISTA DE ACUERDO A SU CONTROLADOR
         * @param [text] $vista     [nombre de la vista]
         * @param array  $View_Vars [parámetros para la vista]
         */
         $RutaView     = ROOT .  'views' . DS  . $this->Controlador. DS . $vista . '.phtml';
         $RutaTemplate = $RutaView;


            if(is_readable($RutaView))
            {
               require_once ($RutaView);
            }
            else {
                throw new Exception(header('Location: ' . BASE_URL .'error/404.php'));
              //Debug::Mostrar($RutaView );
            }
          }


        public function SetCss($Archivos_Css=array())
        {

        /**
         * OCTUBRE 14 DE 2014
         * CARGA ARCHIVOS CSS INDEPENDIENTES EN CADA UNA DE LAS VISTAS
         * @param array $Archivos_Css : ARRAY DE ARCHIVOS QUE SE CARGARÁN CON LA VISTA
         *                              DESDE LOS CONTROLADORES
         */
           extract($Archivos_Css);
           foreach ($Archivos_Css as $Archivo_css)
           {
               $this->Css[]= BASE_CSS . $Archivo_css . '.css';
           }
        }

        /**
         * OCTUBRE 14 DE 2014
         * CARGA ARCHIVOS JS INDEPENDIENTES EN CADA UNA DE LAS VISTAS
         * @param array $Archivos_Css : ARRAY DE ARCHIVOS JS QUE SE CARGARÁN CON LA VISTA
         *                              LOS CONTROLADORES
         */
        public function SetJs($Archivos_Js=array())
        {
           extract($Archivos_Js);
           foreach ($Archivos_Js as $Archivo_Js)
           {
               $this->Js[]= BASE_JS . $Archivo_Js . '.js';
           }
        }


 }
?>
