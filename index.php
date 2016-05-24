
<?php
					define('DS', DIRECTORY_SEPARATOR);
					define('ROOT', realpath(dirname(__FILE__))                   . DS );
					define('LIBS',                 ROOT . 'libs'                 . DS );
					define('APP_PATH',             ROOT . 'application'          . DS );
					define('APPLICATION_SECTIONS', ROOT . 'application_sections' . DS );
					define('APPLICATION_CODS',     ROOT . 'application_cods'     . DS );

					try{
								// Archivo de configuración, variables generales
							 //------------------------------------------------
						  require_once APP_PATH . 'Config.php';
						  // Archivo de configuración de la base de datos
						  //------------------------------------------------
						  require_once APP_PATH . 'Database_config.php';

 						  /** OCTUBRE 11 DE 2015
 						  * 	 Archivo que se encarga de realizar la auto carga de las clases que tengo definicas
 						  				Condiciones :
 						  							1.			El nombre del archivo debe iniciar con mayúscula. 											 Ejemplo : Session
 						  							2.		 El nombre de la clase debe ser igual a la del archivo físico. Ejemplo class Session
 						  */
 						 require_once APP_PATH . 'Autoload.php';
 						 //foreach ( glob(APP_PATH  .    '*.php') as $file ) {  	require_once $file;     } //librerias/funciones de la aplicacion

 						 //Carga de las librerías externas, como por ejemplo la librería para PDF.
 						 //-----------------------------------------------------------------------
 						 foreach ( glob(LIBS .    '*.php') as $file ) {  	require_once $file;     } //librerias/funciones de la aplicacion
 			    	Session::Init();
					    $url_requerida = new Request();
					    Bootstrap::Run( $url_requerida );
					}
					catch(Exception $e){
					    echo $e->getMessage();
					}

?>
