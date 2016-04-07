<?php
/**
 * SEP 15 DE 2014
 * CLASE ENCARGADA DEL MANEJO DE LAS SESSIONES DEL APLICATIVO
 * ESTABLECE Y RECUPERA DATOS DE LAS VARIABLES DE SESSION
 * CONTROLA EL TIEMPO QUE DURA  LA SESIÓN DE UN USUARIO UNA VEZ QUE SE HA LOGUEADO
 */
	class Session
	{
		public static function Init( ){
			 session_start();
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
