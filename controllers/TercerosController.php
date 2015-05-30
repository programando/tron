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
    }

    public function Index() { }


    public function Registro_Plan_Ocasional_Natural() {
      /** MAYO 30 2015
       *      REALIZA REGISTRO DE DATOS DEL REGISTRO OCASIONAL PERSONA NATURAL
       */
      $Texto_Respuesta               = '';
      $codigoterceropresenta         = Session::Get('codigousuario_presenta');
      $codigoterceropresenta_inicial = $codigoterceropresenta;
      $idterceropresenta             = 0 ;//Session::Get('idtercero_presenta');

      $idtpidentificacion            = General_Functions::Validar_Entrada('idtpidentificacion','NUM');
      $identificacion                = General_Functions::Validar_Entrada('identificacion','NUM');
      $pnombre                       = General_Functions::Validar_Entrada('pnombre','TEXT');
      $papellido                     = General_Functions::Validar_Entrada('papellido','TEXT');
      $genero                        = General_Functions::Validar_Entrada('genero','TEXT');
      $idmcipio                      = General_Functions::Validar_Entrada('idmcipio','NUM');
      $direccion                     = General_Functions::Validar_Entrada('dirrecion','TEXT');
      $barrio                        = General_Functions::Validar_Entrada('barrio','TEXT');
      $celular1                      = General_Functions::Validar_Entrada('celular1','NUM');
      $e_mail                        = General_Functions::Validar_Entrada('e_mail','TEXT');
      $es_e_mail                     = General_Functions::Validar_Entrada('e_mail','EMAIL');


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
     if ( $es_e_mail == FALSE ){
         $Texto_Respuesta =  $Texto_Respuesta . 'La dirección de correo electrónico no tiene un formato válido.<br>';
     }
     if ( strlen( $Texto_Respuesta) == 0){
          $Texto_Respuesta ='OK';
     }

    $codigousuario                                  = '';
    $codautorizacionmenoredad                       = '';
    $digitoverificacion                             = '';
    $razonsocial                                    = '';
    $dianacimiento                                  = '0';
    $mesnacimiento                                  = '0';
    $email                                          = $e_mail;
    $passwordusuario                                = '';
    $contacto                                       = '';
    $telefono                                       = '';
    $registroconfirmado                             = 1;
    $fechahoraregistro                              = '';
    $registro_organizado                            = 0;
    $param_tiene_compras                            = 0;
    $registro_inactivo                              = 0;
    $param_confirmar_nuevos_amigos_x_email          = 1 ;
    $param_acepto_pago_valor_transferencia          = 1;
    $valor_minimo_transferencia                     = 0;            //**-------------------- REVISAR DESDE AQUI LO CAMPOS Y SUS VALORES POR DEFECTO
    $param_idtpidentificacion_titular_cuenta        = 0;
    $param_identificacion_titular_cuenta            = '';
    $param_nombre_titular_cuenta                    = '';
    $param_idbanco_transferencias                   = '0';
    $param_nro_cuenta_transferencias                = '';
    $param_tipo_cuenta_transferencias               = '';
    $param_idmcipio_transferencias                  = 0;
    $param_acepto_retencion_comis_para_pago_pedidos = 0 ;
    $param_valor_comisiones_para_pago_pedidos       = 0 ;
    $cant_max_amigos_nivel_1                        = 0 ;
    $cant_max_amigos_nivel_2                        = 0;
    $cant_max_amigos_otros_niveles                  = 0;
    $sesion_amigo_activo                            = 0;
    $mis_datos_son_privados                         = 1 ;
    $pago_comisiones_efecty                         = 0;
    $pago_comisiones_cuenta_empresa                 = 0;
    $pago_comisiones_transferencia                  = 0;
    $pago_comisiones_caja                           = 0;
    $idtppersona                                    = 1;
    $regimen                                        = 0;
    $declaro_renta                                  = 0;
    $nadie_presenta                                 = 0;
    $id_pago_primer_pedido                          = 0;
    $fecha_hora_acepta_convenio                     = '';
    $fecha_pago_inscripcion                         = '';
    $no_correos_ley_1581_2012                       = 0;
    $idtipo_plan_compras                            = 1 ;
    $idtipo_plan_compras_confirmado                 = 0;
    $otrosi_firmado                                 = 1 ;
    $fecha_otrosi_firmado                           = '';
    $kit_comprado                                   = 0;
    $inscripcion_pagada                             = 0;
    $recibo_promociones_email                       = 1 ;
    $recibo_promociones_celular                     = 1 ;
    $empresario_provisional                         = 0;
    $Datos_Terceros = compact('idtpidentificacion' ,'identificacion' ,'digitoverificacion' ,'pnombre' ,'papellido' ,
                            'razonsocial' ,'genero' ,'dianacimiento' ,'mesnacimiento' ,'passwordusuario' ,
                            'direccion' ,'barrio' ,'contacto' ,'telefono' ,'celular1' ,
                            'email' ,'idmcipio' ,'codigousuario' ,'codautorizacionmenoredad' ,'codigoterceropresenta_inicial' ,
                            'codigoterceropresenta' ,'idterceropresenta' ,'registroconfirmado' ,
                            'fechahoraregistro' ,'registro_organizado' ,'param_tiene_compras' ,'registro_inactivo' ,'param_confirmar_nuevos_amigos_x_email' ,
                            'param_acepto_pago_valor_transferencia' ,'valor_minimo_transferencia' ,'param_idtpidentificacion_titular_cuenta' ,'param_identificacion_titular_cuenta' ,'param_nombre_titular_cuenta' ,
                            'param_idbanco_transferencias' ,'param_nro_cuenta_transferencias' ,'param_tipo_cuenta_transferencias' ,'param_idmcipio_transferencias' ,'param_acepto_retencion_comis_para_pago_pedidos' ,
                            'param_valor_comisiones_para_pago_pedidos' ,'cant_max_amigos_nivel_1' ,'cant_max_amigos_nivel_2' ,'cant_max_amigos_otros_niveles' ,'sesion_amigo_activo' ,
                            'mis_datos_son_privados' ,'pago_comisiones_efecty' ,'pago_comisiones_cuenta_empresa' ,'pago_comisiones_transferencia' ,'pago_comisiones_caja' ,
                            'idtppersona' ,'regimen' ,'declaro_renta' ,'nadie_presenta' ,'id_pago_primer_pedido' ,'fecha_hora_acepta_convenio' ,'fecha_pago_inscripcion' ,'no_correos_ley_1581_2012' ,
                            'idtipo_plan_compras' ,'idtipo_plan_compras_confirmado' ,'otrosi_firmado' ,'fecha_otrosi_firmado' ,'kit_comprado' ,
                            'inscripcion_pagada' ,'recibo_promociones_email' ,'recibo_promociones_celular' ,'empresario_provisional' );

     $Registro = $this->Terceros->Grabar($Datos_Terceros);

     // GRABAR DATOS
     // GRABAR DIRECCION
     // ENVIAR CORREO
     // REDIRECCIOAR USUARIO

     $Datos = compact('Texto_Respuesta' );
     echo json_encode($Datos,256);

    }

    public function Registro_Buscar_Por_Codigo(){
      /** MAYO 24 DE 2015
       *      REALIZA LA BÚSQUEDA DE DATOS POR CÓDIGO DE USUARIO
       */
      $codigousuario  = General_Functions::Validar_Entrada('codigousuario','TEXT');
      $Registro       = $this->Terceros->Buscar_Por_Codigo($codigousuario);
      $Respuesta      = '';

      $this->Registro_Re_Establecer_Tercero_Presenta();

      if (!$Registro){
            $Respuesta ='CODIGO_NO_EXISTE';
            $Datos = compact('Respuesta');
      }else{
        $idtercero      = $Registro[0]['idtercero'];
        $nombre_usuario = $Registro[0]['nombre_usuario'];
        $codigousuario  = $Registro[0]['codigousuario'];
        //
        Session::Set('idtercero_presenta',$Registro[0]['idtercero']);
        Session::Set('nombre_usuario_presenta',$Registro[0]['nombre_usuario']);
        Session::Set('codigousuario_presenta',$Registro[0]['codigousuario']);
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

    public function Validar_Ingreso_Usuario()
    {
       $Email                = General_Functions::Validar_Entrada('email','TEXT');
       $Password             = General_Functions::Validar_Entrada('Password','TEXT');
       $Password             = md5($Password );
       $Usuarios             = $this->Terceros->Buscar_Usuarios_Activos_x_Email($Email );
       $Registro             = $this->Terceros->Consulta_Datos_Por_Password_Email($Email ,$Password);

       if (!$Registro )
       {
         $Resultado_Logueo = "NO-Logueo_OK";
       }else
           {
            Session::Set('autenticado',               true);
            Session::Set('idtercero',                       $Registro[0]['idtercero']);
            Session::Set('nombre_usuario',                  $Registro[0]["pnombre"]);
            Session::Set('saldo_comisiones',                $Registro[0]["saldo_comisiones"]);
            Session::Set('saldo_puntos_cantidad',           $Registro[0]["saldo_puntos_cantidad"]);
            Session::Set('vr_cupon_descuento'   ,     0);
            Session::Set('idtipo_plan_compras',             $Registro[0]["idtipo_plan_compras"]); // 1 ocasional, 2, cliente, 3 empresarios
            Session::Set('idtipo_plan_compras_confirmado',  $Registro[0]["idtipo_plan_compras_confirmado"]);

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
        $Parametros = $this->Parametros->Transportadoras();
        Session::Set('kit_vr_venta_valle',$Parametros[0]['kit_vr_venta_valle']);
        Session::Set('kit_vr_venta_valle_reexpedidion',$Parametros[0]['kit_vr_venta_valle_reexpedidion']);
        Session::Set('kit_vr_venta_nacional',$Parametros[0]['kit_vr_venta_nacional']);
        Session::Set('kit_vr_venta_nacional_reexpedicion',$Parametros[0]['kit_vr_venta_nacional_reexpedicion']);
        Session::Set('cuota_1_inscripcion',$Parametros[0]['cuota_1_inscripcion']);
        Session::Set('kit_id', 10744);
        $this->View->Total_Kit_Inscripcion = $Parametros[0]['kit_vr_venta_valle'] + $Parametros[0]['cuota_1_inscripcion'] ;

        $this->View->TiposDocumentos = $this->TiposDocumentos->Consultar();
        $this->View->Departamentos   = $this->Departamentos->Consultar();
        $this->View->SetCss(array('tron_menu_footer','tron_dptos_mcipios','tron_registro','tron-registro-p2','messi.min'));
        $this->View->SetJs(array('tron_terceros_registro','tron_dptos_mcipios','registrodos','messi.min'));
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

    public function cambiar_password($numero_confirmacion)
    {

        $this->View->Numero_Confirmacion = $numero_confirmacion;
        $this->View->SetCss(array('tron_cambiar_password','tron_ventana_modal'));
        $this->View->SetJs(array('tron_login','bootstrap-show-password','tron_cambio_password'));

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






















