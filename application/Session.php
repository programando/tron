<?php
/**
 * SEP 15 DE 2014
 * CLASE ENCARGADA DEL MANEJO DE LAS SESSIONES DEL APLICATIVO
 * ESTABLECE Y RECUPERA DATOS DE LAS VARIABLES DE SESSION
 * CONTROLA EL TIEMPO QUE DURA  LA SESIÓN DE UN USUARIO UNA VEZ QUE SE HA LOGUEADO
 *Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36
 */
	class Session
	{
		public static function Init( ){

           $IpVisitante   = $_SERVER['REMOTE_ADDR'];
           $Navegador     = $_SERVER['HTTP_USER_AGENT'];
           $NombrePC      = gethostname() ;
           $Usuario       = get_current_user();

            /*
                $ok = @session_start();
                if(!$ok){
                    Debug::Mostrar(  "no iniciada" . rand(0,15));
                }else{
                    Debug::Mostrar( session_id() );
                }
            */


           $IpVisitante   = preg_replace('/[^A-Za-z0-9_]/', '', $IpVisitante);
           $Navegador     = preg_replace('/[^A-Za-z0-9_]/', '', $Navegador);
           $Usuario       = preg_replace('/[^A-Za-z0-9_]/', '', $Usuario );
           $NombrePC      = preg_replace('/[^A-Za-z0-9_]/', '', $NombrePC );

           $Identificador = $Usuario.$NombrePC.$IpVisitante.$Navegador;
           $Identificador = substr($Identificador,0,100);

           session_id(  $Identificador );
           session_start();
           Debug::Mostrar( $Identificador );
           Debug::Mostrar( 'SESION ID -> ' . session_id());


		}


        /**
         * SEP 27 DE 2014
         * DESTRE UNA VARIABLE(S) DE SESSION
         * @param boolean $clave [Nombre de la clave que se va a destruir]
         */
        public static function Destroy($clave = false){
            if($clave) {
                if(is_array($clave)) {
                    for($i = 0; $i < count($clave); $i++) {
                        if(isset($_SESSION[$clave[$i]])) {  unset($_SESSION[$clave[$i]]); }
                    }
                }
                else{
                    if(isset($_SESSION[$clave])) {
                        unset($_SESSION[$clave]);
                    }
                }
              } else {
                foreach($_SESSION as $key => $value) {
                        $_SESSION[$key] = NULL;
                        unset( $_SESSION[$key] );
                }

                $_SESSION           = array();
                session_unset();
                session_unset( $_SESSION );
                session_destroy();
            }
        }


        public static function Set( $clave, $valor )        {
            $clave = trim($clave);
            if(!empty($clave))
            $_SESSION[$clave] = $valor;

        }

        public static function Get( $clave ) {
            $clave = trim($clave);
            if(isset($_SESSION[$clave]))
            return $_SESSION[$clave];
        }


        /**
         * SEP 29 DE 204
         * CONTROLA EL TIEMPO QUE EL USAURIO PODRÁ TRABAJAR EN EL SISTEMA
         */
    public static function Tiempo()
    {
        if(!Session::Get('Tiempo') || !defined('SESSION_TIME'))
            {  throw new Exception('No se ha definido el tiempo de sesión.');  }

        if(SESSION_TIME == 0) // Tiempo se sesión indefinido
            {  return; }

        // si ha pasado más del tiempo establecido, se cierra la sessión
        if(time() - Session::Get('Tiempo') > (SESSION_TIME * 60))
        {
            Session::Destroy();
            header('location:' . BASE_URL . 'error/access/8080');
        }
        else
            {   Session::Set('Tiempo', time()); }
    }




}
?>
