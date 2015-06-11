<?php

class TercerosController extends Controller
{
    private $Cantidad_Registros;
    public function __construct()
    {
        parent::__construct();
        $this->Terceros            = $this->Load_Model('Terceros');
        $this->Departamentos       = $this->Load_Model('Departamentos');
        $this->TiposDocumentos     = $this->Load_Model('Tiposdocumentos');
        $this->Parametros          = $this->Load_Model('Parametros');
        $this->Correos             = $this->Load_Controller('Emails');
    }

    public function Index() { }

        public function modificacion_datos()
    {
        $this->View->SetCss(array("tron_modificacion_datos","password"));
        $this->View->Mostrar_Vista("modificacion_datos");
    }

        public function mejor_experiencia_usuario()
    {
        $this->View->SetCss(array("tron_mejor_experiencia_usuario"));
        $this->View->Mostrar_Vista("mejor_experiencia_usuario");
    }

    public function Recuperar_Password(){
         $email     = General_Functions::Validar_Entrada('Email','TEXT');
         $Es_email  = General_Functions::Validar_Entrada('Email','EMAIL');
         $Tercero   = $this->Terceros->Consulta_Datos_Por_Email($email);
         $idtercero = $Tercero[0]['idtercero'];
         if ($Es_email  == false) {
              $CorreoEnviado ='Correo_No_OK';
            } else {
                if (!$Tercero) {
                         $CorreoEnviado ='NoUsuario';
                    }else{
                     $CorreoEnviado = $this->Correos->Recuperar_Password($Tercero,$email);
                     if (  $CorreoEnviado =='Ok'){
                        $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero ,Session::Get('codigo_confirmacion'));
                        Session::Destroy('codigo_confirmacion');
                        }
                      }
                    }
       $Datos = compact('CorreoEnviado');
       echo  json_encode($Datos,256);
    }

  public function activar_cuenta_usuario_finalizar_registro(){
      $Respuesta           = '';
      $idtecero            = General_Functions::Validar_Entrada('idtecero','NUM');
      $codigo_verificacion = General_Functions::Validar_Entrada('codigo_verificacion','TEXT');
      $password            = General_Functions::Validar_Entrada('password','TEXT');
      $password_confirm    = General_Functions::Validar_Entrada('password_confirm','TEXT');
      $email               = General_Functions::Validar_Entrada('email','TEXT');
      $idtipo_plan_compras = 0;
      $nombre_usuario      = '';

     $Registro = $this->Terceros->Clave_Temporal_Buscar($idtecero,$codigo_verificacion);
       if ( !$Registro ){
          $Respuesta = 'El código de verificación no corresponde al usuario registrado. <br>';
      }
      if ( $password  != $password_confirm){
            $Respuesta = $Respuesta . 'Las contraseñas deben ser iguales para finalizar el registro.<br>';
      }
      if ( (strlen( $password) == 0) ||  (strlen( $password_confirm) == 0)) {
            $Respuesta = $Respuesta . 'Las contraseñas no pueden estar vacías.<br>';
      }
      if ( $Respuesta == ''){
        $password = md5( $password ); // COMPLEMENTA REGISTRO DE USUARIO. ASIGNA CLAVE VE USUARIO
        $this->Terceros->Finalizar_Registro_Usuario_Ocasional($idtecero , $password );
        // CONSULTA DATOS POR PASSSWRORD Y EMAIL PARA ESTABLECER LOGUEO AUTOMÁTICO Y DEFINE VARIABLES DE ENTORNO
        $Registro = $this->Terceros->Consulta_Datos_Por_Password_Email($email ,$password);
        $this->Validar_Ingreso_Usuario_Asignar_Datos($Registro );  // ASIGNA LAS VARIABLES DE ENTORNO
        Session::Set('idtipo_plan_compras', $Registro[0]['idtipo_plan_compras']);
        $idtipo_plan_compras = $Registro[0]['idtipo_plan_compras'];
        $nombre_usuario      = $Registro[0]['nombre_usuario_pedido'];
        $genero              = $Registro[0]['genero'];
        $pre                 = '';  // USADO PARA DETERMINAR SI ES HOMBRE O MUJER EN LOS MENSAJES

        if ( $genero == 1){
          $pre = 'o';
        }
        if ($genero == 0 ){
          $pre = 'a';
        }
        // VERFICAR SI EL TIPO DE PLAN ES 2. SIRVE PARA QUE EN CASO DE BORRAR EL KIT DE INICIO DE ESTE PEDIDO, LUEGO DEL REGISTRO
        // SE LE DEGRADE DE PLAN. PASARÍA DE 2 A 1
        if ( $idtipo_plan_compras == 2 ){
            Session::Set('usuario_viene_del_registro',TRUE); // VIENE DEL REGISTRO
        }
        $this->Correos->Activacion_Registro_Usuario_Exitoso($email, $Registro[0]["pnombre"],$pre );
        $Respuesta = 'El registro ha finalizado con éxito !!! <br> Ahora prodrás disfrutar de los beneficios de pertenecer a la Tienda Virtual TRON.';
      }
      $Respuesta = compact('Respuesta','idtipo_plan_compras','nombre_usuario');
      echo json_encode($Respuesta ,256);
    }


    public function  Verificar_Registro_Inicial_Usuario(){
      /**  JUNIO 08 2015
       *      VERFICAR SI EL TIPO DE PLAN ES 2. SIRVE PARA QUE EN CASO DE BORRAR EL KIT DE INICIO DE ESTE PEDIDO, LUEGO DEL REGISTRO
       *      SE LE DEGRADE DE PLAN. PASARÍA DE 2 A 1
       */
      $usuario_viene_del_registro = Session::Get('usuario_viene_del_registro');
      $idtipo_plan_compras        = Session::Get('idtipo_plan_compras');

      if ( !isset($usuario_viene_del_registro )){
          $usuario_viene_del_registro = false ;
      }
      $Respuesta = compact('usuario_viene_del_registro','idtipo_plan_compras');
      echo json_encode($Respuesta,256);
    }

    public function Cambio_Plan(){

      $tipo_proceso_en_plan =  General_Functions::Validar_Entrada('tipo_proceso_en_plan', 'TEXT');
      $idtecero             = Session::Get('idtercero_pedido');
      $idtipo_plan_compras  = General_Functions::Validar_Entrada('idtipo_plan_compras', 'NUM');
      $this->Terceros->Cambio_Plan($tipo_proceso_en_plan, $idtecero, $idtipo_plan_compras);
      echo "OK";
    }


   public function activar_cuenta_usuario_prueba()
    {
        $this->View->email               = '';
        $this->View->codigo_confirmacion = 1;
        $this->View->idtercero           = 1;
        $this->View->idtipo_plan_compras = 3;

        $this->View->SetCss(array('tron_activacion_mi_cuenta', 'messi.min','password'));
        $this->View->SetJs(array('tron_terceros_activar_cuenta','messi.min'));
        $this->View->Mostrar_Vista("activar_cuenta_usuario");
    }


   public function activar_cuenta_usuario($codigo_confirmacion,$email,$idtercero,$idtipo_plan_compras)   {

        Session::Set('usuario_viene_del_registro',TRUE);
        Session::Set('idtipo_plan_compras', $idtipo_plan_compras);


        $this->View->email               = $email;
        $this->View->codigo_confirmacion = $codigo_confirmacion;
        $this->View->idtercero           = $idtercero;
        $this->View->idtipo_plan_compras = $idtipo_plan_compras;

        $this->View->SetCss(array('tron_activacion_mi_cuenta', 'messi.min'));
        $this->View->SetJs(array('tron_terceros_activar_cuenta','messi.min'));
        $this->View->Mostrar_Vista("activar_cuenta_usuario");
    }

    public function Registro_Plan_Ocasional_Natural() {
      /** MAYO 30 2015
       *      REALIZA REGISTRO DE DATOS DEL REGISTRO OCASIONAL PERSONA NATURAL
       */
       $Texto_Respuesta               = '';
       $codigoterceropresenta         = Session::Get('codigousuario_presenta');
       $codigoterceropresenta_inicial = $codigoterceropresenta;
       $idterceropresenta             = Session::Get('idtercero_presenta');
       $idtipo_plan_compras           = Session::Get('idtipo_plan_compras');
       $codigo_usuario_generado       = '';
      if ( $idterceropresenta == 0 ){  /// SI NADIE LO  PRESENTA, DEJÓ EN BLANCO DEBO ASIGNARLO
          $nadie_presenta = 1;
        }else{
          $nadie_presenta = 0;
        }

        // SI NADIE PRESENTE Y EL DEL PLAN 2, ASIGNO CODIGO AUTOMATICO
        if ( ($idtipo_plan_compras == 2 && $nadie_presenta == 1) || ($idtipo_plan_compras == 3 && $nadie_presenta == 1) ){
          $Datos_Codigo                  = $this->Terceros->Generar_Codigo_Registro_Nadie_Presenta();
          $idterceropresenta             = $Datos_Codigo[0]['idtercero'];
          $codigoterceropresenta         = $Datos_Codigo[0]['codigousuario'];
          $codigoterceropresenta_inicial = $codigoterceropresenta ;
          Session::Set('codigousuario_presenta',$codigoterceropresenta);
          Session::Set('idtercero_presenta', $idterceropresenta);
        }


      $idtpidentificacion = General_Functions::Validar_Entrada('idtpidentificacion','NUM');
      $identificacion     = General_Functions::Validar_Entrada('identificacion','TEXT');
      $pnombre            = General_Functions::Validar_Entrada('pnombre','TEXT');
      $papellido          = General_Functions::Validar_Entrada('papellido','TEXT');
      $genero             = General_Functions::Validar_Entrada('genero','TEXT');
      $idmcipio           = General_Functions::Validar_Entrada('idmcipio','NUM');
      $direccion          = General_Functions::Validar_Entrada('dirrecion','TEXT');
      $barrio             = General_Functions::Validar_Entrada('barrio','TEXT');
      $celular1           = General_Functions::Validar_Entrada('celular1','TEXT');
      $e_mail             = General_Functions::Validar_Entrada('e_mail','TEXT');
      $es_e_mail          = General_Functions::Validar_Entrada('e_mail','EMAIL');
      $email_confirm      = General_Functions::Validar_Entrada('email_confirm','TEXT');
      $es_email_confirm   = General_Functions::Validar_Entrada('email_confirm','EMAIL');
      //
       $mes           = General_Functions::Validar_Entrada('mes','NUM');
       $dia           = General_Functions::Validar_Entrada('dia','NUM');
       if ($mes  < 9) { $mes  = '0'.$mes ; }
       if ($dia  < 9) { $dia  = '0'.$dia ; }


       if ( strlen( $pnombre)== 0 || strlen(  $papellido  ) == 0 ){
            $Texto_Respuesta =  $Texto_Respuesta . 'El nombre y apellido no pueden estar en blanco.<br>';
       }
       if ( $idmcipio ==0 ){
            $Texto_Respuesta =  $Texto_Respuesta . 'Debe seleccionar el municipio o ciudad en donde recide.<br>';
       }
       if ( strlen( $direccion)== 0  ){
            $Texto_Respuesta =  $Texto_Respuesta . 'La dirección no puede quedar vacía.<br>';
       }
       if ( strlen( $barrio)== 0  ){
            $Texto_Respuesta =  $Texto_Respuesta . 'Registre el barrio en donde reside.<br>';
       }
       if ( strlen( $celular1)== 0  ){
            $Texto_Respuesta =  $Texto_Respuesta . 'Debe registrar un número de celular.<br>';
       }
       if ( $es_e_mail == FALSE || $es_email_confirm = FALSE ){
           $Texto_Respuesta =  $Texto_Respuesta . 'La dirección de correo electrónico y su confirmación no pueden estar vacías y contener un formato válido.<br>';
       }
       if ( strlen( $Texto_Respuesta) == 0){
            $Texto_Respuesta ='<strong>Ya casi hemos terminado !!!</strong><br><br>Hemos enviado un enlace a tu cuenta de correo desde el cual podrás finalizar tu registro.<br><br>';
       }
       // PLAN 3 , PERSONAS NATURALES.
       if ( $idtipo_plan_compras == 3 && ( $idtpidentificacion == 13 || $idtpidentificacion == 42) ){
            if ( $mes == 0 || $dia == 0 ){
                 $Texto_Respuesta ='<strong>Es necesario que registre el día y mes de nacimiento ya que estos datos se utilizan para generar su código de usuario.<br><br>';
            }else{
                  $Datos_Nuevo_Codigo      = $this->Terceros->Generar_Codigo_Usuario($pnombre ,$papellido, $dia, $mes);
                  $codigo_usuario_generado = $Datos_Nuevo_Codigo [0]['codigo_generado'];
            }
       }

      $codigousuario                                  = $codigo_usuario_generado;
      $codautorizacionmenoredad                       = '';
      $digitoverificacion                             = '';
      $razonsocial                                    = '';
      $dianacimiento                                  = $dia;
      $mesnacimiento                                  = $mes;
      $email                                          = strtolower($e_mail);
      $passwordusuario                                = '';
      $contacto                                       = '';
      $telefono                                       = '';
      $registroconfirmado                             = 0;
      $registro_organizado                            = 0;
      $param_tiene_compras                            = 0;
      $registro_inactivo                              = 0;
      $param_confirmar_nuevos_amigos_x_email          = 1 ;
      $param_acepto_pago_valor_transferencia          = 1;
      $valor_minimo_transferencia                     = 0;
      $param_idtpidentificacion_titular_cuenta        = 0;
      $param_identificacion_titular_cuenta            = '';
      $param_nombre_titular_cuenta                    = '';
      $param_idbanco_transferencias                   = '0';
      $param_nro_cuenta_transferencias                = '';
      $param_tipo_cuenta_transferencias               = '';
      $param_idmcipio_transferencias                  = 0;
      $param_acepto_retencion_comis_para_pago_pedidos = 0 ;
      $param_valor_comisiones_para_pago_pedidos       = 0 ;
      $idtppersona                                    = 1;


      $Datos_Terceros = compact('idtpidentificacion' ,'identificacion' ,'digitoverificacion' ,'pnombre' ,'papellido' , 'razonsocial' ,'genero' ,
                              'dianacimiento' ,'mesnacimiento' ,'passwordusuario' , 'direccion' ,'barrio' ,'contacto' ,'telefono' ,'celular1' ,
                            'email' ,'idmcipio' ,'codigousuario' ,'codautorizacionmenoredad' ,'codigoterceropresenta_inicial' ,
                            'codigoterceropresenta' ,'idterceropresenta' ,'registroconfirmado' ,'fechahoraregistro' ,'registro_organizado' ,
                            'param_tiene_compras' ,'registro_inactivo' , 'param_confirmar_nuevos_amigos_x_email' ,
                            'param_acepto_pago_valor_transferencia' ,'valor_minimo_transferencia' ,'param_idtpidentificacion_titular_cuenta' ,
                            'param_identificacion_titular_cuenta' ,'param_nombre_titular_cuenta' ,'param_idbanco_transferencias' ,
                            'param_nro_cuenta_transferencias' ,'param_tipo_cuenta_transferencias' ,'param_idmcipio_transferencias' ,
                            'param_acepto_retencion_comis_para_pago_pedidos' , 'param_valor_comisiones_para_pago_pedidos' ,
                            'idtppersona','nadie_presenta', 'idtipo_plan_compras');

    // GRABAR DATOS DEL TERCERO
     $Registro             =  $this->Terceros->Grabar($Datos_Terceros);
     $idtercero             = $Registro[0]['idtercero'];
     $telefono             =  $celular1;
     $destinatario         =  $pnombre . ' ' . $papellido;
     $iddireccion_despacho = 0;
     // GRABAR DIRECCION DE DESPACHO
     //------------------------------
     $Datos_Direccion_Despacho = compact('iddireccion_despacho','idtercero','idmcipio','direccion','barrio','telefono','barrio','destinatario');
     $this->Terceros->Direcciones_Despacho_Grabar_Actualizar($Datos_Direccion_Despacho);
     // ESTABLECER VARIABLES DEL DESPACHO EN CASO DE QUE SE HAGA UN PEDIDO LUEGO DEL REGISTRO
     //--------------------------------------------------------------------------------------
     $pre = '';
     if ( $genero == 1){
      $pre = 'o';
     }
     if ( $genero == 0 ){
      $pre = 'a';
     }
     $this->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho(0,$idmcipio);
     // ENVIO CORREO PARA ACTIVACIÓN DE USUARIO
     $this->Correos->Activacion_Registro_Usuario($idtercero ,$email, $pnombre, $pre, $idtipo_plan_compras  );
     // GENERA REGISTRO TEMPORAL PARA CONFIRMACIÓN DE CUENTA.
     $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero ,Session::Get('codigo_confirmacion'));
     // DEJAR LAS VARIABLES EN BLANCO
     $this->Registro_Re_Establecer_Tercero_Presenta();
     Session::Destroy('idtipo_plan_compras');

     $Datos = compact('Texto_Respuesta' );
     echo json_encode($Datos,256);

    }

    public function Registro_Buscar_Por_Codigo(){
      /** MAYO 24 DE 2015
       *      REALIZA LA BÚSQUEDA DE DATOS POR CÓDIGO DE USUARIO
       */
      $this->Registro_Re_Establecer_Tercero_Presenta();
      $codigousuario  = General_Functions::Validar_Entrada('codigousuario','TEXT');
      $Registro       = $this->Terceros->Buscar_Por_Codigo($codigousuario);
      $Respuesta      = '';

      if (!$Registro){
            $Respuesta ='CODIGO_NO_EXISTE';
            $Datos = compact('Respuesta');
      }else{
        $idtercero      = $Registro[0]['idtercero'];
        $nombre_usuario = $Registro[0]['nombre_usuario'];
        $codigousuario  = $Registro[0]['codigousuario'];
        //
        Session::Set('idtercero_presenta'         ,$idtercero);
        Session::Set('nombre_usuario_presenta'    ,$nombre_usuario);
        Session::Set('codigousuario_presenta'     ,$codigousuario);
        $Respuesta ='CODIGO_SI_EXISTE';
        $Datos = compact('idtercero','nombre_usuario','codigousuario','Respuesta');
      }
      echo json_encode($Datos,256);
    }

      public function Registro_Re_Establecer_Tercero_Presenta(){
          Session::Set('idtercero_presenta',0);
          Session::Set('nombre_usuario_presenta','');
          Session::Set('codigousuario_presenta','');
      }
    public function Registro_Establecer_Tipo_Plan_Seleccionado(){
      /** MAYO 24 de 2015
       *      ESTABLECE EL TIPO PLAN DE COMPRAS EN EL REGISTRO DE DATOS INICIALES
       */
        $idtipo_plan_compras = General_Functions::Validar_Entrada('idtipo_plan_compras','NUM');
        Session::Set('idtipo_plan_compras',$idtipo_plan_compras);
        $Datos    = compact('idtipo_plan_compras');
        echo json_encode($Datos,256);
    }

    public function Compra_Productos_Tron_Mes_Actual()
    {/**  MARZO 17 DE 2015
      *       CONSULTA LAS COMPRAS QUE SE HAN REALIZADO DE PRODUCTOS TRON EN EL MES ACTUAL, CONDICIÓN NECESARIA PARA
      *       CONCEDER PRECIOS ESPECIALES
      */
      $Registro                             = $this->Terceros->Compra_Productos_Tron_Mes_Actual();
      $compra_minima_productos_tron         = $Registro[0]['minimo_compras_productos_tron'];
      $compra_minima_productos_industriales = $Registro[0]['minimo_compras_productos_ta'];
      $compras_este_mes_tron                = $Registro[0]['compras_productos_tron'];
      $compras_este_mes_industiales         = $Registro[0]['compras_productos_fabricados_ta'];

      Session::Set('minimo_compras_productos_tron',         $Registro[0]['minimo_compras_productos_tron']);
      Session::Set('minimo_compras_productos_ta',           $Registro[0]['minimo_compras_productos_ta']);
      Session::Set('compras_realizadas_tron',               $Registro[0]['compras_productos_tron']);
      Session::Set('compras_productos_fabricados_ta',       $Registro[0]['compras_productos_fabricados_ta']);
      Session::Set('cumple_condicion_cpras_tron_industial', FALSE);

      // ESTABLECER SI CUMPLE CONDICIONES DE COMPRAS MINIMAS
      if ($compras_este_mes_tron  >= $compra_minima_productos_tron ||  $compras_este_mes_industiales >= $compra_minima_productos_industriales)
      {
        Session::Set('cumple_condicion_cpras_tron_industial', TRUE);
      }

    }

    public function Direcciones_Despacho_Grabar_Actualizar()
    {/** MARZO 05 DE 2015
          *         INSERTA O ACTUALIZA UNA DIRECCIÓN DE DESPACHO PARA UN TERCERO
          */
      $iddireccion_despacho = General_Functions::Validar_Entrada('iddireccion_despacho','NUM');
      $idtercero            = Session::Get('idtercero_pedido');
      $idmcipio             = General_Functions::Validar_Entrada('idmcipio','NUM');
      $direccion            = General_Functions::Validar_Entrada('direccion','TEXT');
      $telefono             = General_Functions::Validar_Entrada('telefono','TEXT');
      $barrio               = General_Functions::Validar_Entrada('barrio','TEXT');
      $destinatario         = General_Functions::Validar_Entrada('destinatario','TEXT');
      $Resultado            = 'OK';


      if (strlen($destinatario  )==0)
      {
        $Resultado ='Destinatario_No_OK';
        echo $Resultado;
        return ;
      }

      if ($idmcipio ==0 )
      {
        $Resultado ='Municipio_No_OK';
        echo $Resultado;
        return ;
      }
      if (strlen($direccion)==0)
      {
        $Resultado ='Direccion_No_OK';
        echo $Resultado;
        return ;
      }
      if (strlen($barrio )==0)
      {
        $Resultado ='Barrio_No_OK';
        echo $Resultado;
        return ;
      }
      if (strlen($telefono)==0)
      {
        $Resultado ='Telefono_No_OK';
        echo $Resultado;
        return ;
      }


      if ($Resultado =='OK')
      {
        $params = compact('iddireccion_despacho','idtercero','idmcipio','direccion','telefono','barrio','destinatario');
        $this->Terceros->Direcciones_Despacho_Grabar_Actualizar($params);
        echo $Resultado;
      }

    }

    public function Direcciones_Despacho()
    {
      $this->Direcciones = $this->Terceros->Direcciones_Despacho();
      return $this->Direcciones;
    }


    public function Actualizar_Password()
    {/** FEBRERO 03 DE 2015
     *      REALIZA ACTUALIZACIÓN DEL PASSWORD DEL USUARIO
     */
      $idtercero          = 0; // no es necesario en este contexto
      $password_temporal  = General_Functions::Validar_Entrada('password_temporal','TEXT');
      $new_password       = General_Functions::Validar_Entrada('new_password','TEXT');
      $confirmar_password = General_Functions::Validar_Entrada('confirmar_password','TEXT');
      $Resultado          ='';

      $Registro = $this->Terceros->Clave_Temporal_Buscar($idtercero,$password_temporal  );

      if ($this->Terceros->Cantidad_Registros==0)
        {
          $Resultado = "PasswordTemporal_No_OK";
        }else
        {
          $idtercero  = $Registro[0]['idtercero'];
        }
      if (strlen($new_password)==0 and strlen($confirmar_password)==0)
        {
          $Resultado = "Password_en_Blanco";
        }
      if ($new_password!=$confirmar_password)
        {
          $Resultado = "Password_Diferentes";
        }
      if (strlen( $Resultado )==0)
        {
          $Resultado ="TodoOK";
        }
      $new_password     = md5($new_password);
      $this->Terceros->Actualizar_Password_Usuario($idtercero ,$new_password ,$password_temporal);
      echo $Resultado ;
    }

        public function historial_mis_pedidos()
    {
        $this->View->SetCss(array("tron_mis_pedidos","tron_barra_usuarios"));
        $this->View->Mostrar_Vista("mis_pedidos");
    }

    public function mi_red()
    {
        $this->View->SetCss(array("tron_barra_usuarios","cuenta_navbar_informe",'cuenta_informe_mi_red'));
        $this->View->Mostrar_Vista("cuenta_informe_mi_red");
    }

        public function participacion_en_la_red()
    {
        $this->View->SetCss(array("tron_barra_usuarios","tron_cuenta_info_partici_la_red","cuenta_navbar_informe"));
        $this->View->Mostrar_Vista("cuenta_info_participacion_la_red");
    }

        public function informacion_mi_cuenta()
    {
        $this->View->SetCss(array("tron_informe_mi_cuenta","tron_barra_usuarios","cuenta_navbar_informe"));
        $this->View->Mostrar_Vista("informe_mi_cuenta");
    }

    public function cuenta_pases_premium()
    {
        $this->View->SetCss(array("tron_cuenta_pases_cortesia","tron_barra_usuarios"));
        $this->View->Mostrar_Vista("cuenta_pases_premium");
    }

    public function cuenta_pases_de_cortesia()
    {
        $this->View->SetCss(array("tron_cuenta_pases_cortesia","tron_barra_usuarios"));
        $this->View->Mostrar_Vista("cuenta_pases_cortesia");
    }

    public function configuracion_perfil()
    {
        $this->View->SetCss(array("tron_confi_perfil"));
        $this->View->SetJs(array('cuenta_configuracion_perfil'));
        $this->View->Mostrar_Vista("confi_perfil");
    }

    public function comisiones_bonificaciones_pagadas()
    {
        $this->View->SetCss(array("tron_terceros_comis_bonifi"));
        $this->View->Mostrar_Vista("comisiones_bonificaciones_pagadas");
    }


    public function Validar_Ingreso_Usuario_Asignar_Datos($Registro ){
      $Usuarios             = $this->Terceros->Buscar_Usuarios_Activos_x_Email( $Registro[0]['email'] );
      Session::Set('autenticado',               true);
      Session::Set('idtercero',                       $Registro[0]['idtercero']);
      Session::Set('nombre_usuario',                  $Registro[0]["pnombre"]);
      Session::Set('saldo_comisiones',                $Registro[0]["saldo_comisiones"]);
      Session::Set('saldo_puntos_cantidad',           $Registro[0]["saldo_puntos_cantidad"]);
      Session::Set('vr_cupon_descuento'   ,     0);
      Session::Set('idtipo_plan_compras',             $Registro[0]["idtipo_plan_compras"]); // 1 ocasional, 2, cliente, 3 empresarios
      Session::Set('idtipo_plan_compras_confirmado',  $Registro[0]["idtipo_plan_compras_confirmado"]);
      Session::Set('kit_comprado',                    $Registro[0]["kit_comprado"]);

      // DATOS PARA ENTREGA DEL PEDIDO Y CALCULO DE FLETES
      Session::Set('idtercero_pedido',                $Registro[0]['idtercero']);
      Session::Set('pagado_online',                   0);
      Session::Set('nombre_usuario_pedido',           $Registro[0]["nombre_usuario_pedido"]);
      Session::Set('iddireccion_despacho',            0);
      Session::Set('cantidad_direcciones',            0);
      Session::Set('nommcipio_despacho',              ucfirst ($Registro[0]["nommcipio_despacho"]));

      Session::Set('idmcipio',                        $Registro[0]["idmcipio"]);
      Session::Set('iddpto',                          $Registro[0]["iddpto"]);
      Session::Set('re_expedicion',                   $Registro[0]["re_expedicion"]);
      Session::Set('vr_kilo_idmcipio_redetrans',      $Registro[0]["vr_kilo"]);
      Session::Set('vr_re_expedicion_redetrans',      $Registro[0]["vr_re_expedicion"]);
      Session::Set('vr_kilo_idmcipio_servientrega',   $Registro[0]["vr_kilo_servientrega"]);
      Session::Set('re_expedicion_servientrega',   $Registro[0]["re_expedicion_servientrega"]);

      Session::Set('codigos_usuario',                 $Usuarios);
      // CONSULTA DATOS PARA DETERMINAR SI SE CUMPLEN LAS CONDICIONES DE COMPRAS MÍNIMAS DE PRODUCTOS TRON O PINDUSTRIALES
      $this->Compra_Productos_Tron_Mes_Actual();

    }

    public function Validar_Ingreso_Usuario()
    {
       $Email                = General_Functions::Validar_Entrada('email','TEXT');
       $Password             = General_Functions::Validar_Entrada('Password','TEXT');
       $Password             = md5($Password );
       $Registro             = $this->Terceros->Consulta_Datos_Por_Password_Email($Email ,$Password);

       if (!$Registro )
       {
         $Resultado_Logueo = "NO-Logueo_OK";
       }else
           {
            $this->Validar_Ingreso_Usuario_Asignar_Datos($Registro);
            $Resultado_Logueo = "Logueo_OK";
         }
         $Siguiente_Pago = Session::Get('finalizar_pedido_siguiente_paso');
         if (!isset($Siguiente_Pago))
         {
          $Siguiente_Pago='';
         }
         $Datos            = compact('Resultado_Logueo','Siguiente_Pago');
         echo json_encode($Datos,256);
      }

      public function Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($IdDireccion_Despacho, $idmcipio=153 )
      {/** MARZO 12 DE 2015
        *       CONSULTA INFORMACIÓN DE LA CIUDAD, DEPARTAMENTO Y VARIABLES DE FLETES CON LA DIRECCIÓN DE DESPACHO SELECCIONADA
        *       ESTABLECE UN PARAMETRO idmcipio = 153 ( CALI ), PARA CONSULTAR DESDE EL INDEX CONTROLLER Y CARGAR CIERTAS VARIABLES
        */
        if ($IdDireccion_Despacho > 0)
        {
          $Registro = $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($IdDireccion_Despacho );
        }else
        {
          $Registro = $this->Terceros->Consultar_Datos_Mcipio_x_IdMcipio($idmcipio);
        }
        Session::Set('iddireccion_despacho',            $IdDireccion_Despacho);
        Session::Set('idmcipio',                        $Registro[0]["idmcipio"]);
        Session::Set('iddpto',                          $Registro[0]["iddpto"]);
        Session::Set('re_expedicion',                   $Registro[0]["re_expedicion"]);
        Session::Set('vr_kilo_idmcipio_redetrans',      $Registro[0]["vr_kilo"]);
        Session::Set('vr_re_expedicion_redetrans',      $Registro[0]["vr_re_expedicion"]);
        Session::Set('vr_kilo_idmcipio_servientrega',   $Registro[0]["vr_kilo_servientrega"]);
        Session::Set('re_expedicion_servientrega',   $Registro[0]["re_expedicion_servientrega"]);
        Session::Set('nommcipio_despacho',               ucfirst ($Registro[0]["nommcipio_despacho"]));
      }

    public function registrarse()
    {
        $this->View->SetCss(array("tron_registrarse"));
        $this->View->Mostrar_Vista("registrarse");
    }

    public function registro()
    {
        $this->Registro_Re_Establecer_Tercero_Presenta();
        Session::Destroy('idtipo_plan_compras');
        $Parametros = $this->Parametros->Transportadoras();
        Session::Set('kit_vr_venta_valle',                $Parametros[0]['kit_vr_venta_valle']);
        Session::Set('kit_vr_venta_valle_reexpedidion',   $Parametros[0]['kit_vr_venta_valle_reexpedidion']);
        Session::Set('kit_vr_venta_nacional',             $Parametros[0]['kit_vr_venta_nacional']);
        Session::Set('kit_vr_venta_nacional_reexpedicion',$Parametros[0]['kit_vr_venta_nacional_reexpedicion']);
        Session::Set('cuota_1_inscripcion',               $Parametros[0]['cuota_1_inscripcion']);
        Session::Set('kit_id', 10744);
        $this->View->Total_Kit_Inscripcion = $Parametros[0]['kit_vr_venta_valle'] + $Parametros[0]['cuota_1_inscripcion'] ;

        $this->View->TiposDocumentos = $this->TiposDocumentos->Consultar();
        $this->View->Departamentos   = $this->Departamentos->Consultar();
        $this->View->SetCss(array('tron_menu_footer','tron_dptos_mcipios','tron_registro','tron-registro-p2','messi.min'));
        $this->View->SetJs(array('tron_terceros_registro','tron_dptos_mcipios','messi.min'));
        $this->View->Mostrar_Vista('registro');
    }






    public function registro_paso_2()
    {
        $this->View->SetCss(array('tron_menu_footer','tron_registro','tron_registro','tron-regirtro-pasos','tron-registron-p2'));
        $this->View->SetJs(array('tron_terceros_registro'));
        $this->View->Mostrar_Vista('registro_paso_2');
    }

    public function Consulta_Datos_Por_Email($email)
    {
        $Terceros = $this->Terceros->Consulta_Datos_Por_Email($email);
        return $Terceros;
    }

    public function Consulta_Datos_Por_Email_Registro()
    {
        $Respuesta ='';
        $email     = General_Functions::Validar_Entrada('email','TEXT');
        $Es_email  = General_Functions::Validar_Entrada('email','EMAIL');
        if ($Es_email == FALSE){
            $Respuesta = "EMAIL-NO-OK";
        }else {
            $Terceros = $this->Terceros->Consulta_Datos_Por_Email($email);
            if ($Terceros){
              $Respuesta = "EMAIL-EXISTE";
            }else{
              $Respuesta = "EMAIL-NO-EXISTE";
            }
      }
        $Respuesta= compact('Respuesta');
        echo json_encode($Respuesta,256);
    }

    public function cambiar_password_prueba()
    {

        $this->View->SetCss(array('tron_cambiar_password','tron_ventana_modal','password'));
        $this->View->SetJs(array('tron_login','bootstrap-show-password','tron_cambio_password','password'));
        $this->View->Mostrar_Vista('cambiar_password');
    }

    public function cambiar_password($numero_confirmacion)
    {

        $this->View->Numero_Confirmacion = $numero_confirmacion;

        $this->View->SetCss(array('tron_cambiar_password','tron_ventana_modal','password'));
        $this->View->SetJs(array('tron_login','bootstrap-show-password','tron_cambio_password','password'));


        $this->View->Mostrar_Vista('cambiar_password');
    }

    public function Clave_Temporal_Grabar_Cambio_Clave($idtercero,$password_temporal)
    {
        /** FEBRERO 03 DE 2015
        **  INSERTA EN LA TABLA UN REGISTRO TEMPORAL QUE SE USARÁ PARA LA VERIFICACIÓN EN EL CAMBIO DE CLAVE
        */
        $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero,$password_temporal);
    }

    public function Buscar_Por_Identificacion(){
     /** MAYO 05 DE 2015
     *   CONSULTA DATOS BÁSICO DE UN TERCERO POR IDENTIFICACION
     */
     $identificacion = General_Functions::Validar_Entrada('identificacion','TEXT');
     $Tercero        = $this->Terceros->Buscar_Por_Identificacion($identificacion);
     if (!$Tercero){
          $Respuesta ='NO_EXISTE';
     }else{
        $Respuesta ='SI_EXISTE';
     }

     $Datos = compact('Respuesta');
     echo json_encode($Datos ,256);

    }

}




?>






















