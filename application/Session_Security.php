	<?php
    class Session_Security
	{


        public static function Validate_Session( ){

            $Nombre_Archivo = sys_get_temp_dir()."TRON.txt";
            if ( !file_exists($Nombre_Archivo)) {
                $Session = md5(TOKEN_PASSWORDS . microtime().rand(1,9999999999999999999999999));
                $File    = fopen($Nombre_Archivo, "w");
                fwrite( $File, $Session. PHP_EOL );
                fclose( $File );
            }

            $File    = fopen($Nombre_Archivo, "r");
            $Session =  fgets($File) ;
            fclose( $File );

            $Long = strlen( $Session );

            //if ( !isset( $Session ) || empty( $Session ) || ( $Long < 32) ){
              //  $this->Validate_Session();
           // }

           return   $Session;

		}

}
