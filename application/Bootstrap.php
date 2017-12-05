<?php
/**
 * SEP 10 DE 2014
 * SE ENCARGA DE DETERMINAR EL CONTROLADOR QUE EL USUARIO ESTA REQUIRIENDO
 * OBTIENE EL METODO Y LOS PARAMETROS NECESARIOS PARA EJECUTARSE
 */
class Bootstrap
{

    public static function Run( Request $peticion )
    {

        error_reporting(E_ALL);
        $Controller      = $peticion->getControlador(). 'Controller';
        $Controller      = String_Functions::Camel($Controller);
        $RutaControlador = ROOT . 'controllers'       . DS . $Controller . '.php';
        $Metodo          = $peticion->getMetodo();
        $args            = $peticion->getArgs();



        /* CAMBIO IMPLEMENTADO EL 03 DE OCTUBRE
           OBJETIVO:    CONSULTAR DATOS BÁSICOS ( PARÁMETROS) SI ES QUE NO SE HABÍAN CARGADO.
        */
        $IndexController        = 'IndexController';
        $IndexRuta              = ROOT . 'controllers'       . DS . $IndexController. '.php';
        require_once $IndexRuta ;
        $ControllerIndex        = new $IndexController;
        $ControllerIndex->Parametros_Iniciales();



        if( is_readable( $RutaControlador ) )    {
            echo $Controller;

            echo '<br>';
            echo $RutaControlador;
            echo '<br> Siguiente 22 <br>';

           require_once $RutaControlador;
            $Controller = new $Controller;
            echo '<br> Siguiente 23 <br>';

            if( is_callable(array( $Controller, $Metodo ) ) ) {
                $Metodo = $peticion->getMetodo();
            }
            else{
                $Metodo = DEFAULT_CONTROLLER;
            }

            echo '<br> Siguiente 23 <br>';
            echo $Metodo ;

/*
            // Desde aqui se carga el contraolador con o sin argumentos.... carpeta controllers
            if(isset($args)){
                call_user_func_array(array( $Controller, $Metodo ), $args);
            }
            else{
                call_user_func(array($Controller, $Metodo));
            }

            */

        } else {


            //throw new Exception(header('Location: ' . BASE_URL  ));

            throw new Exception(header('Location: ' . BASE_URL .'views/error/404.php'));



        }
    }
}

?>
