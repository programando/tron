<?php

  class EmailsController extends Controller
  {
  	  private $Email ;

      public function __construct()
      {
          parent::__construct();
          $this->Email    = $this->Load_External_Library('class.phpmailer');
          $this->Email    = new PHPMailer();
          $this->Terceros = $this->Load_Controller('Terceros');
      }

      public function Index() { }



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

      public function Recuperar_Password()
      {
         /** ENERO 31 DE 2015
         **  PROCEDIMIENTO PARA RECUPERAR CONTRASEÑA DE USUARIOS
         */
        $email   = General_Functions::Validar_Entrada('Email','TEXT');
        $Tercero = $this->Terceros->Consulta_Datos_Por_Email($email);

        if (!$Tercero)
        {
          $CorreoEnviado ='NoUsuario';
        }else
          {
            $email   = General_Functions::Validar_Entrada('Email','EMAIL');
            if ($email ==false)
            {
              $CorreoEnviado ='Correo_No_OK';
            }else
              {
                $idtercero = $Tercero[0]['idtercero'];
                $this->Configurar_Cuenta('Recuperación de Contraseña.');
                $this->Email->AddAddress($email );
                $codigo              = General_Functions::Generar_Codigo_Unico();
                $numero              = mt_rand(123456789,999999999);
                $codigo_confirmacion = md5($codigo.$numero.TOKEN_PASSWORDS);
                $enlace              = '<a href=' . BASE_URL .'terceros/cambiar_password/'. $codigo_confirmacion .'> Cambio de Contraseña </a>';
                $Texto_Correo        =  'Has solicitado que el sistema recuerde tu contraseña en la Red de Usuarios TRON. ';
                $Texto_Correo        = $Texto_Correo  .'Se ha generado una clave temporal que se usará para que puedas cambiar tu contraseña.<br>';
                $Texto_Correo        = $Texto_Correo  .'Presione Click en el siguiente enlace : ' . $enlace . "  para continuar con el proceso.";
                $this->Email->Body   = CORREO_HEADER ;
                $this->Email->Body   = $this->Email->Body .  $Texto_Correo;
                $this->Email->Body   = $this->Email->Body . CORREO_FOOTER_USER;
                if ( $this->Email->Send())
                  {
                    $this->Email->clearAddresses();
                    $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero ,$codigo_confirmacion);
                    $CorreoEnviado ='Ok';
                  }
                  else
                  {
                    $CorreoEnviado='NoOk';
                    //echo "Mailer Error: " . $this->Email->ErrorInfo;
                  }
              }
          }
         $Datos = compact('CorreoEnviado');
         echo  json_encode($Datos,256);
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
