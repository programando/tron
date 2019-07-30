<?php

  class EmailsController extends Controller
  {
  	  private $Email ;

      public function __construct()
      {
          parent::__construct();
          $this->Terceros = $this->Load_Model('Terceros');
          $this->Mensajes = $this->Load_Model('Emails');
          $this->Email    = $this->Load_External_Library('class.phpmailer');
          $this->Email    = new PHPMailer();
      }

      public function Index() { }



      public function Compresion_Dinamica_Preventiva(){
        /** JUNIO 18 2016
         *    GENERA CORREO ELECTRONICO PARA INFORMAR A LOS USUARIOS SOBRE UN NUEVO INGRESO A SU RED
         */
        $nuevos_usuarios = $this->Mensajes->Usuarios_Proximos_a_Comprimirse();

        $this->Configurar_Cuenta('¡ AVISO Red de Usuarios TRON !' );

        foreach ( $nuevos_usuarios as $usuario ) {
            $email              = $usuario['email'];
            $cant_usuarios_nv_1 = $usuario['cant_usuarios_nv_1'];

            if ( $cant_usuarios_nv_1 == 0 ) {
                 $Texto_Correo    = file_get_contents(BASE_EMAILS.'compresion_preventiva_sin_red.phtml','r');
            }else{
                $Texto_Correo    = file_get_contents(BASE_EMAILS.'compresion_preventiva_con_red.phtml','r');
                $Texto_Correo    = str_replace("#_CANT_USUARIOS_#"       , $cant_usuarios_nv_1 ,$Texto_Correo);
            }

            $this->Email->Body = $this->Unir_Partes_Correo ($Texto_Correo  );
            $this->Email->AddAddress( $email  );
            $Respuesta              = $this->Enviar_Correo();
        }


      }


      public function FacturaElectronicaError ( $TextoErrores, $IdFacturaElectronica ) {
          $email             = 'jhonjamesmg@hotmail.com';
          $nombre_usuario    = 'Jhon James';
          $this->Configurar_Cuenta(  "Error - Factura no enviada ". $IdFacturaElectronica );
          $this->Email->Body = $TextoErrores  ;
          $this->Email->AddAddress( $email  );
          $Respuesta         = $this->Enviar_Correo();
      }




      public function Usuarios_Cumplen_Anios(){
        /** JUNIO 18 2016
         *    GENERA CORREO ELECTRONICO PARA SALUDAR A LOS USUARIOS QUE COMPLEN ANIOS
         */
        $nuevos_usuarios = $this->Mensajes->Usuarios_Cumplen_Anios();
        $Texto_Correo    = file_get_contents(BASE_EMAILS.'usuarios_cumplen_anios.phtml','r');

        foreach ( $nuevos_usuarios as $usuario ) {
            $email             = $usuario['email'];
            $nombre_usuario    = $usuario['pnombre'];
            $this->Configurar_Cuenta($nombre_usuario . '... ¡ Felicidades en tu día !' );
            $this->Email->Body = $this->Unir_Partes_Correo ($Texto_Correo  );
            $this->Email->AddAddress( $email  );
            $Respuesta         = $this->Enviar_Correo();
        }
      }



      public function Nuevos_Usuarios_Registrados(){
        /** JUNIO 18 2016
         *    GENERA CORREO ELECTRONICO PARA INFORMAR A LOS USUARIOS SOBRE UN NUEVO INGRESO A SU RED
         */
        $nuevos_usuarios = $this->Mensajes->Nuevos_Usuarios_Registrados();
        $Texto_Correo    = file_get_contents(BASE_EMAILS.'usuarios_nuevos_en_red.phtml','r');

        $this->Configurar_Cuenta('Nuevo usuario registrado en tu Red' );

        foreach ( $nuevos_usuarios as $usuario ) {
            $idregistro        = $usuario['idregistro'];
            $email             = $usuario['email'];
            $nombre_usuario    = $usuario['nuevo_usuario'];
            $Texto_Correo      = str_replace("#_NOMBRE_NUEVO_USUARIO_#"       , $nombre_usuario ,$Texto_Correo);
            $this->Email->Body = $this->Unir_Partes_Correo ($Texto_Correo  );

            $this->Email->AddAddress( $email  );
            $Respuesta              = $this->Enviar_Correo();
            // SI EL CORREO ES ENVIADO SE BORRA EL REGISTRO.
            if (  $Respuesta  == 'correo_OK' ){
              $nuevos_usuarios = $this->Mensajes->Nuevos_Usuarios_Registrados_Borrar_Registro( $idregistro  );
            }

        }
      }




      public function Recomendar_Negocio_Amigo(){
        /** SEPTIEMBRE 14 DE 2015
         *    GENERA CORREO ELECTRONICO PARA RECOMENDAR MODELO DE NEGOCIO A AMIGO.
         */
          $Respuesta                = 'OK';
          $nombre_usuario           = General_Functions::Validar_Entrada('recomendar_nombre', 'TEXT');
          $email                    = General_Functions::Validar_Entrada('recomendar_email', 'TEXT');
          $Es_email                 = General_Functions::Validar_Entrada('recomendar_email', 'EMAIL');
          $recomendar_mnsj_personal = General_Functions::Validar_Entrada('recomendar_mnsj_personal', 'TEXT');
          $recomendar_mnsj_personal = General_Functions::Validar_Entrada('recomendar_mnsj_personal', 'TEXT');
          $recomendado_por  = General_Functions::Validar_Entrada('recomendar_nombre_envia', 'TEXT');

          if ( strlen($nombre_usuario) == 0 ){
              $Respuesta  = 'Debes registrar el nombre de la persona a quien envías la recomendación.<br>';
            }
          if ( $Es_email == FALSE ){
              $Respuesta  =  'La dirección de correo no tiene un formato válido.<br>';
          }

          if ( $Respuesta  == 'OK'){
              $this->Configurar_Cuenta('Recomendación de : ' . $recomendado_por );
              $this->Email->AddAddress($email );
              $recomendado_por        = strtoupper ($recomendado_por);
              $nombre_usuario         = strtoupper( $nombre_usuario);
              $logo                   = BASE_IMG_EMPRESA .'logo.png';
              $idtercero_presenta     = Session::Get('idtercero');
              $codigousuario_presenta = Session::Get('codigousuario');
              $Enlace                 = BASE_URL."terceros/invitacion/1/$idtercero_presenta/$codigousuario_presenta/";;
              $Texto_Correo           = file_get_contents(BASE_EMAILS.'recomendar_modelo_negocio.phtml','r');
              $Texto_Correo           = str_replace("#_NOMBRE_AMIGO_#"                     , $nombre_usuario ,$Texto_Correo);
              $Texto_Correo           = str_replace("#_NOMBRE_QUIEN_ENVIA_INVITACION_#"    , $recomendado_por ,$Texto_Correo);
              $Texto_Correo           = str_replace("#_ENLACE_#"                           , $Enlace ,$Texto_Correo);
              $Texto_Correo           = str_replace("#_MENSAJE_OPCIONAL_#"                 , $recomendar_mnsj_personal,$Texto_Correo);
              $Texto_Correo           = str_replace("#_LOGO_#"                             , $logo ,$Texto_Correo);

              $this->Email->Body      = $this->Unir_Partes_Correo ($Texto_Correo  );
              $Respuesta              = $this->Enviar_Correo();
          }
          $Respuesta = compact('Respuesta');
          echo json_encode($Respuesta,256);
      }

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
              $this->Email->AddAddress( CORREO_CONTACTOS );
              $this->Email->Body = $this->Unir_Partes_Correo ($Texto_Correo  );
              $Respuesta = $this->Enviar_Correo();
              if ($Respuesta == 'correo_OK'){
                $Respuesta = 'El correo ha sido enviado satisfactoriamente. Pronto nos pondremos en contacto con usted. <br> <br>Gracias.<br><br>';
                }else{
                  $Respuesta = 'El correo no pudo ser enviado. Puede deberse a un fallo en el servidor. Inténtelo más tarde. <br> <br>Gracias.<br><br>' ;
                }
              $Respuesta = compact('Respuesta' );
          }
            echo json_encode($Respuesta,256);
        }


      public function Recomendar_Producto_a_Amigo( $Email_Amigo,$Nombre_Quien_Envia,$Mensaje_Enviado,$Nombre_Imagen,$IdProducto,$Nombre_Amigo, $Nom_Producto=''    ){
       /** ENERO 31 DE 2015
        **  PROCEDIMEINTO POR MEDIO DEL CUAL SE RECOMIENDA PRODUCTOS A AMIGOS
        */
          $this->Configurar_Cuenta('Recomendación de ' .$Nombre_Quien_Envia );
          $this->Email->AddAddress($Email_Amigo );
          $Id_Area_Consulta = Session::Get('Id_Area_Consulta');
          if ( $_SESSION['logueado'] == TRUE ) {
            $idtercero_presenta     = Session::Get('idtercero');
            $codigousuario_presenta =  Session::Get('codigousuario') ;
            $Url_Imagen        = BASE_URL."productos/vista_ampliada/$IdProducto/$Id_Area_Consulta/1/$idtercero_presenta/$codigousuario_presenta/";
          }else{
            $Url_Imagen       = BASE_URL."productos/Detalle_Producto/$IdProducto/$Nom_Producto/";
          }


          $codigo_confirmacion = General_Functions::Generar_Codigo_Confirmacion();

          $logo             = BASE_IMG_EMPRESA .'logo.png';
          $imagen           = BASE_IMG_PRODUCTOS_232x232 .$Nombre_Imagen;

          $Borrar_Registro  = BASE_URL."terceros/Borrar_Lista_Suscripcion/".$codigo_confirmacion;

          $Texto_Correo     = file_get_contents(BASE_EMAILS.'productos_recomendar.html','r');
          $Texto_Correo     = str_replace("#Nombre_Amigo#"          , ucfirst($Nombre_Amigo) ,$Texto_Correo);
          $Texto_Correo     = str_replace("#Nombre_Quien_Envia#"    , $Nombre_Quien_Envia ,$Texto_Correo);
          $Texto_Correo     = str_replace("#Nombre_Imagen#"         , $imagen,$Texto_Correo);
          $Texto_Correo     = str_replace("#logo#"                  , $logo ,$Texto_Correo);
          $Texto_Correo     = str_replace("#Url#"                   , $Url_Imagen ,$Texto_Correo);
          $Texto_Correo     = str_replace("#tron#"                  , BASE_URL,$Texto_Correo);
          $Texto_Correo     = str_replace("#_CERRAR_SUSCIPCIÓN_#"   , $Borrar_Registro,$Texto_Correo);

          $Pie_Pagina       ='';

          if (strlen($Mensaje_Enviado)>0) {
            $Pie_Pagina = '<div> ';
            $Pie_Pagina = $Pie_Pagina . '<strong><p>Nota:  </strong>';
            $Pie_Pagina = $Pie_Pagina . '<div class="campo-escrit"> ' . $Mensaje_Enviado .'</div></div>';
          }
          $Texto_Correo     = str_replace(" #Pie_Pagina#"    , $Pie_Pagina  ,$Texto_Correo);
          $this->Email->Body = $Texto_Correo  ;
          // GRABAR RECOMENDACION
          $this->Terceros->Recomendacion_Amigo_Producto_Grabar ( $Nombre_Amigo ,$Email_Amigo,$IdProducto,$codigo_confirmacion );
          //-------------------
          return $this->Enviar_Correo();
      }

      public function Recuperar_Password( $email ) {
         /** ENERO 31 DE 2015
         **  PROCEDIMIENTO PARA RECUPERAR CONTRASEÑA DE USUARIOS
         */
          $this->Configurar_Cuenta('Recuperación de Contraseña.');
          $this->Email->AddAddress($email );

          $codigo_confirmacion = General_Functions::Generar_Codigo_Confirmacion();
          $enlace              = '<a href=' . BASE_URL .'terceros/cambiar_password/'. $codigo_confirmacion .'> Cambio de Contraseña </a>';
          $logo                = BASE_IMG_EMPRESA .'logo.png';

          $Pagina_Correo       = file_get_contents(BASE_EMAILS.'recuperar_password.phtml','r');
          $Pagina_Correo       = str_replace("#_PAGINA_TRON_#"                , BASE_URL,$Pagina_Correo);
          $Pagina_Correo       = str_replace("#_LOGO_#"                       , $logo ,$Pagina_Correo);
          $Pagina_Correo       = str_replace("#_ENLACE_RECUPERA_PASSWORD_#"   , $enlace  ,$Pagina_Correo);

          $this->Email->Body   = $this->Unir_Partes_Correo ($Pagina_Correo );

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

      public function Activacion_Registro_Usuario($idtercero,$email, $nombre_usuario, $genero, $idtipo_plan_compras,
                                                  $idtpidentificacion , $razonsocial, $codigousuario ){
         $this->Configurar_Cuenta('Activación Cuenta/Registro de Usuario');
         $this->Email->AddAddress($email );
         $logo                = BASE_IMG_EMPRESA .'logo.png';
         $codigo_confirmacion = General_Functions::Generar_Codigo_Confirmacion();

         $pre = '';
         if (   $idtpidentificacion != 31 ){
            $nombre = $nombre_usuario ;
         }else{
          $nombre = $razonsocial  ;
         }
         $codigo_generado = '';
         if ( $idtipo_plan_compras == 3 ){
            $codigo_generado = 'Para que lo tengas en cuenta, tu código de usuario es : <strong>'. $codigousuario .'</strong><br />';
            $codigo_generado = $codigo_generado . 'Este será el código que entregarás a tus clientes para que al comprar te generen comisiones.';
         }
         $Saludo  = $nombre .' , Te damos una cordial bienvenida !!!';
         $enlace   = '<a href=' . BASE_URL .'terceros/activar_cuenta_usuario/' . $codigo_confirmacion .'/';
         $enlace   = $enlace .  $email . '/'.$idtercero. '/' .$idtipo_plan_compras . '/';
         $enlace   = $enlace .  $idtpidentificacion . '/ > Activar mi cuenta y finalizar registro </a>';

         $Texto_Correo      = file_get_contents(BASE_EMAILS.'activacion_registro_usuario.phtml','r');
         $Texto_Correo      = str_replace("#_SALUDO_#"                  , $Saludo            ,$Texto_Correo);
         $Texto_Correo      = str_replace("#_ENLACE_ACTIVA_CUENTA_#"    , $enlace            ,$Texto_Correo);
         $Texto_Correo      = str_replace("#_LOGO_#"                    , $logo              ,$Texto_Correo);
         $Texto_Correo      = str_replace("#_CODIGO_GENERADO_#"         , $codigo_generado   ,$Texto_Correo);
         $this->Email->Body =  $this->Unir_Partes_Correo ($Texto_Correo);

         $Respuesta         = $this->Enviar_Correo();
         Session::Set('codigo_confirmacion',$codigo_confirmacion);
         return $Respuesta;
      }


      public function Informar_Codigo_Empresario($email, $codigousuario ){
         $this->Configurar_Cuenta('Registro Nuevo Empresario');
         $this->Email->AddAddress($email );
         $logo                = BASE_IMG_EMPRESA .'logo.png';

            $codigo_generado = 'Para que lo tengas en cuenta, tu código de usuario es : <strong>'. $codigousuario .'</strong><br />';
            $codigo_generado = $codigo_generado . 'Este será el código que entregarás a tus clientes para que al comprar te generen comisiones.';

         $Saludo  = 'Te damos una cordial bienvenida !!!';



         $Texto_Correo      = file_get_contents(BASE_EMAILS.'nuevo_empresario.phtml','r');
         $Texto_Correo      = str_replace("#_SALUDO_#"                  , $Saludo            ,$Texto_Correo);
         $Texto_Correo      = str_replace("#_LOGO_#"                    , $logo              ,$Texto_Correo);
         $Texto_Correo      = str_replace("#_CODIGO_GENERADO_#"         , $codigo_generado   ,$Texto_Correo);
         $this->Email->Body =  $this->Unir_Partes_Correo ($Texto_Correo);

         $Respuesta         = $this->Enviar_Correo();

         return $Respuesta;
      }



    public function Configurar_Cuenta( $asunto ) {

       $this->Email->IsSMTP();
       $this->Email->SMTPDebug     =0;
       $this->Email->SMTPAuth      = true;
       $this->Email->IsHTML        = true;                      // enable SMTP authentication
       $this->Email->ContentType   = "text/html";
       $this->Email->CharSet       = "utf-8";
       $this->Email->SMTPSecure    = 'ssl';                     // sets the prefix to the servier
       $this->Email->Host          = 'smtp.gmail.com';         // sets GMAIL as the SMTP server
       $this->Email->Port          = 465;
       $this->Email->SMTPKeepAlive = true;
       $this->Email->Mailer        = "smtp";                   // set the SMTP port
       $this->Email->Username      = CORREO_CONTACTOS;         // GMAIL username
       $this->Email->Password      = PASS_CORREO_CONTACTOS;    // GMAIL password
       $this->Email->From          = 'contactos@balquimia.com';
       $this->Email->FromName      = 'TRON Entre amigos alcanzamos';
       $this->Email->Subject       = $asunto;
       $this->Email->AltBody       = ""; //Text Body
       $this->Email->WordWrap      = 50; // set word wrap                                // send as HTML

    }


    public function Enviar_Correo(){
        if ( $this->Email->Send()){
            $this->Email->ClearBCCs();
            $this->Email->clearAddresses();
            return "correo_OK";
        }else {
          $this->Email->ClearBCCs();
          $this->Email->clearAddresses();
          echo "Error: " . $this->Email->ErrorInfo;
         return "correo_No_OK";
        }

     }

   private function Unir_Partes_Correo (   $Body ){
       $Logo_Empresa       = BASE_IMG_EMPRESA .'logo.png';
       $Header             = file_get_contents(APPLICATION_SECTIONS . 'emails/header.php','r');
       $Footer             = file_get_contents(APPLICATION_SECTIONS . 'emails/footer.php','r');
       $Texto_Final_Correo = $Header.$Body.$Footer;

       return $Texto_Final_Correo ;
    }


/* PAGINAS QUE HABILITAN EL EVÍO DE CORREOS EN CUENTAS
    https://www.google.com/settings/u/1/security/lesssecureapps
    https://accounts.google.com/b/0/DisplayUnlockCaptcha
    https://security.google.com/settings/security/activity?hl=en&pli=1

    ndrryejncsgzycvs

*/
 }
?>



