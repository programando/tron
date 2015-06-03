<?php

  class EmailsController extends Controller
  {
  	  private $Email ;

      public function __construct()
      {
          parent::__construct();
          $this->Email    = $this->Load_External_Library('class.phpmailer');
          $this->Email    = new PHPMailer();
      }

      public function Index() { }


      /** ENVIO DE CORREOS DESDE EL FORMULARIO DE CONTACTOS
       *    ABRIL 16 DE 2015
       */
      public function envio_correo_contactos(){
          $Respuesta = '';
          $nombre_usuario = General_Functions::Validar_Entrada('nombre_usuario', 'TEXT');
          $email          = General_Functions::Validar_Entrada('email', 'TEXT');
          $telefono       = General_Functions::Validar_Entrada('telefono', 'TEXT');
          $Es_email       = General_Functions::Validar_Entrada('email', 'EMAIL');
          $comentarios    = General_Functions::Validar_Entrada('comentarios', 'TEXT');
          if ( strlen($nombre_usuario) == 0 ){
              $Respuesta  = $Respuesta . 'Debe registrar el nombre de la persona que envía el correo.<br>';
          }
          if ( $Es_email == FALSE ){
              $Respuesta  = $Respuesta . 'la dirección de correo no tiene un formato válido.<br>';
          }
          if ( strlen($comentarios) == 0 ){
              $Respuesta  = $Respuesta . 'No ha escrito ningún comentario para ser enviado.<br>';
          }
          if ( strlen($Respuesta) > 0 ) {
            $Respuesta = compact('Respuesta' );
          } else{
              $Texto_Correo     = "Nombre de usuario : " .$nombre_usuario . '<br>';
              $Texto_Correo     = $Texto_Correo . "Dirección correo electrónico : " . strtolower( $email). '<br>';
              $Texto_Correo     = $Texto_Correo . "Número de teléfono : " . $telefono. '<br>';
              $Texto_Correo     = $Texto_Correo . "Comentario enviado : <br> " . $comentarios. '<br>';
              $this->Configurar_Cuenta('Correo de usuario red TRON' ). '<br>';
              $this->Email->AddAddress(CORREO_01). '<br>';
              $this->Email->Body = $Texto_Correo;
              $Respuesta = $this->Enviar_Correo();
              if ($Respuesta == 'correo_OK'){
                $Respuesta = 'El correo ha sido enviado satisfactoriamente. Pronto nos pondremos en contacto con usted. <br> <br>Gracias.<br><br>';
              }
              $Respuesta = compact('Respuesta' );
          }
            echo json_encode($Respuesta,256);
        }


     public function Enviar_Correo(){

        if ( $this->Email->Send()){
          $this->Email->clearAddresses();
            return "correo_OK";
        }else {
         return "correo_No_OK";
        }

     }


      public function Recomendar_Producto_a_Amigo($Email_Amigo,$Nombre_Quien_Envia,$Mensaje_Enviado,$Nombre_Imagen,$IdProducto   )
      { /** ENERO 31 DE 2015
        **  PROCEDIMEINTO POR MEDIO DEL CUAL SE RECOMIENDA PRODUCTOS A AMIGOS
        */
        $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
        $logo             = BASE_IMG_EMPRESA .'logo.png';
        $imagen           = BASE_IMG_PRODUCTOS_232x232 .$Nombre_Imagen;
        $Url_Imagen       = BASE_URL."productos/vista_ampliada/$IdProducto/$Id_Area_Consulta";
        $Texto_Correo     = file_get_contents(BASE_EMAILS.'productos_recomendar.html','r');
        $Texto_Correo     = str_replace("#Nombre_Quien_Envia#" , $Nombre_Quien_Envia ,$Texto_Correo);
        $Texto_Correo     = str_replace("#Nombre_Imagen#"      , $imagen,$Texto_Correo);
        $Texto_Correo     = str_replace("#logo#"               , $logo ,$Texto_Correo);
        $Texto_Correo     = str_replace("#Url#"                , $Url_Imagen ,$Texto_Correo);
        $Texto_Correo     = str_replace("#tron#"               , BASE_URL,$Texto_Correo);
        $Pie_Pagina       ='';
        if (strlen($Mensaje_Enviado)>0)
        {
          $Pie_Pagina = '<div> ';
          $Pie_Pagina = $Pie_Pagina . '<strong><p>Nota:  ' . $Nombre_Quien_Envia . ':</p></strong>';
          $Pie_Pagina = $Pie_Pagina . '<div class="campo-escrit"> ' . $Mensaje_Enviado .'</div></div>';
        }
        $Texto_Correo     = str_replace(" #Pie_Pagina#"    , $Pie_Pagina  ,$Texto_Correo);

        $this->Configurar_Cuenta('Recomendación de ' .$Nombre_Quien_Envia );
        $this->Email->AddAddress($Email_Amigo );

        $this->Email->Body = $Texto_Correo;

        if ( $this->Email->Send())
        {
          $this->Email->clearAddresses();
          return "correoOK";
        }else
        {
         return "correo_No_OK";
        }


      }

      public function Recuperar_Password($Tercero,$email)
      {
         /** ENERO 31 DE 2015
         **  PROCEDIMIENTO PARA RECUPERAR CONTRASEÑA DE USUARIOS
         */

          $codigo_confirmacion = General_Functions::Generar_Codigo_Confirmacion();
          $enlace              = '<a href=' . BASE_URL .'terceros/cambiar_password/'. $codigo_confirmacion .'> Cambio de Contraseña </a>';
          $Texto_Correo        =  'Has solicitado que el sistema recuerde tu contraseña en la Red de Usuarios TRON. ';
          $Texto_Correo        = $Texto_Correo  .'Se ha generado una clave temporal que se usará para que puedas cambiar tu contraseña.<br>';
          $Texto_Correo        = $Texto_Correo  .'Presione Click en el siguiente enlace : ' . $enlace . "  para continuar con el proceso.";

          $this->Configurar_Cuenta('Recuperación de Contraseña.');
          $this->Email->AddAddress($email );
          $this->Email->Body   = CORREO_HEADER ;
          $this->Email->Body   = $this->Email->Body .  $Texto_Correo;
          $this->Email->Body   = $this->Email->Body . CORREO_FOOTER_USER;

          if ( $this->Email->Send()) {
              $this->Email->clearAddresses();
              Session::Set('codigo_confirmacion',$codigo_confirmacion);
              $CorreoEnviado ='Ok';
            }
            else {
              $CorreoEnviado='NoOk';
            }
            return $CorreoEnviado ;
      }

      public function Activacion_Registro_Usuario($idtercero,$email, $nombre_usuario){

         $codigo_confirmacion = General_Functions::Generar_Codigo_Confirmacion();
         $enlace              = '<a href=' . BASE_URL .'terceros/activar_cuenta_usuario/' . $codigo_confirmacion .'/'.$email . '/'.$idtercero. '/> Activar mi cuenta y finalizar registro </a>';
         $Texto_Correo        = 'Bienvenido ' .  $nombre_usuario .'<br><br>';
         $Texto_Correo        = $Texto_Correo .'Para activar tu cuenta de usuario y finalizar el registro, presiona el siguiente enlace :' . $enlace ;
         $Texto_Correo        = $Texto_Correo . "desde donde podrás cambiar tu contraseña y a partir de allí, ingresar a la tienda virtual.";

         $this->Configurar_Cuenta('Activación Cuenta/Finalización Registro');
         $this->Email->AddAddress($email );
         $this->Email->Body   = CORREO_HEADER ;
         $this->Email->Body   = $this->Email->Body .  $Texto_Correo;
         $this->Email->Body   = $this->Email->Body . CORREO_FOOTER_USER;
         $Respuesta = $this->Enviar_Correo();
         Session::Set('codigo_confirmacion',$codigo_confirmacion);
         return $Respuesta;

      }

      private function Configurar_Cuenta($asunto)
      {
      		/** ENERO 30 DE 2015
      		*		 ESTABLECE LA CONFIGURACIÓN PARA EL ENVÍO DE CORREOS ELECTRÓNICOS
      		*/
									$this->Email->IsSMTP();
                  //$this->Email->SMTPDebug = 2;
									$this->Email->SMTPAuth    = true;
									$this->Email->IsHTML      = true;              								// enable SMTP authentication
									$this->Email->ContentType = "text/html";
									$this->Email->CharSet     = "utf-8";
									$this->Email->SMTPSecure  = 'ssl';                            // sets the prefix to the servier
									$this->Email->Host        = 'smtp.gmail.com';      				 		// sets GMAIL as the SMTP server
									$this->Email->Port        = '465';                              // set the SMTP port
									$this->Email->Username    = CORREO_01;								// GMAIL username
									$this->Email->Password    = CORREO_01_PASS;            	 					// GMAIL password
									$this->Email->From        = '';
									$this->Email->FromName    = '';
									$this->Email->Subject     = $asunto;
									$this->Email->AltBody     = ""; //Text Body
									$this->Email->WordWrap    = 50; // set word wrap																// send as HTML
      }




    }
?>
