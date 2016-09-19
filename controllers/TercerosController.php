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
        $this->Comisiones_Grupos   = $this->Load_Model('ComisionesPuntos');
        $this->Correos             = $this->Load_Controller('Emails');
    }

    public function Index() { }

    public function editar() {
      $this->View->Mostrar_Vista("modificacion_datos");
    }

    public function Cambio_Status(){
        Session::Set('ofertas_x_cambio_status_empresario', TRUE) ;
        echo "ok";
    }

    public function Consulta_Datos_Usuario( $idtercero ){
       $tercero       = $this->Terceros->Consulta_Datos_Usuario ( $idtercero);
       $nombre        = String_Functions::Formato_Texto( $tercero[0]['pnombre']);
       $apellido      = String_Functions::Formato_Texto( $tercero[0]['papellido']);
       $empresa       = String_Functions::Formato_Texto( $tercero[0]['razonsocial']);
       $nombre        = trim ( $nombre . ' ' .$apellido .' '.$empresa);
       $codigousuario = $tercero[0]['codigousuario'];
       $email         = $tercero[0]['email'];
       $celular       = $tercero[0]['celular1'];
       if ( $tercero[0]['mis_datos_son_privados'] == TRUE ){
          $email   = 'Dato Privado';
          $celular = 'Dato Privado' ;
       }
       $datos    = compact('nombre','codigousuario','email','celular' );
        echo json_encode($datos );
    }

    public function referidos( $idterero = 0, $codigousuario = '' ){
        Session::Set('idtercero_presenta',0);
        Session::Set('codigousuario','');

        Session::Set('idtercero_presenta' , $idterero);
        Session::Set('codigousuario'     , $codigousuario);   // Código del usario que presenta en en la red
        header('Location: ' . BASE_URL );
    }

    public function modificacion_datos_registro(){
        $this->View->SetCss(array("modificacion_datos_registro"));
        $this->View->SetJs(array('modificacion_datos_registro'));
        $this->View->Mostrar_Vista("modificacion_datos_registro");
    }

    public function Invitacion($reasigna_valores = 0,$idterceropresenta=0,$codigousuario_presenta=''){
        if( $reasigna_valores == TRUE){
          Session::Set('idtercero_presenta',0);
          Session::Set('codigousuario','');
          if ( $idterceropresenta > 0){
              Session::Set('idtercero_presenta',$idterceropresenta);
              Session::Set('codigousuario',$codigousuario_presenta);
            }
            header('Location: ' . BASE_URL );
        }
    }

    public function Terceros_Consultar_Datos_Identificacion_Codigo_Usuario(){
      /** SEPTIEMBRE 01 DE 2015
           CONSULTA DATOS DEL USUARIO CON  LA IDENTIFICACION Y EL CÓDIGO      */
       Session::Set('Generando_Pedido_Amigo', FALSE);
       $identificacion = strtoupper( General_Functions::Validar_Entrada('identificacion','TEXT') );
       $Respuesta      ='';
       if ( strlen( trim( $identificacion ) ) == 0 ) {
          $Respuesta ='NO VACIOS';
       }
       if ( strlen( trim( $identificacion ) ) > 0 ) {
        $Registro = $this->Terceros->Terceros_Consultar_Datos_Identificacion_Codigo_Usuario($identificacion );
        if ( !$Registro ){
          $Respuesta ='NO EXISTE';
        }else{
          $this->Validar_Ingreso_Usuario_Asignar_Datos( $Registro );
          Session::Set('Generando_Pedido_Amigo', TRUE);
          Session::Set('logueado', TRUE );
          $Respuesta ='SI EXISTE';
        }
       }

      echo $Respuesta;
    } //fin function

public function Terceros_Consultar_Datos_Identificacion_Pedido_Amigo(){
      /** SEPTIEMBRE 01 DE 2015
           CONSULTA DATOS DEL USUARIO CON  LA IDENTIFICACION Y EL CÓDIGO      */
       $identificacion = strtoupper( General_Functions::Validar_Entrada('identificacion','TEXT') );
       $Respuesta      ='';
       if ( strlen( trim( $identificacion ) ) == 0 ) {
          $Respuesta ='NO VACIOS';
       }
       if ( strlen( trim( $identificacion ) ) > 0 ) {
        $Registro = $this->Terceros->Buscar_Por_Identificacion($identificacion);
        if ( !$Registro ){
          $Respuesta ='NO EXISTE';
        }else{
          $this->Validar_Ingreso_Usuario_Asignar_Datos( $Registro );
          Session::Set('Generando_Pedido_Amigo', TRUE);
          $Respuesta ='SI EXISTE';
        }
       }
      echo $Respuesta;
    } //fin function

     public function Borrar_Lista_Suscripcion( $idconfirmacion){
      /** SEPTIEMBRE 13 DE 2015
       *    BORRA REGISTRO DE LA LISTA DE TERCEROS A QUIENES SE LES HA RECOMENDADO PRODUCTOS
       */
      $this->Terceros->Recomendacion_Amigo_Producto_Borrar($idconfirmacion);
      $this->View->SetCss(array('tron_eliminar_cuenta_correo'));
      $this->View->Mostrar_Vista('eliminar_cuenta_correo');


     }

    public function Comprobar_Tipo_Usuario(){
      //    JUNIO 25 2015
      //  COMPRUEBA QUE EL USUARIO NO SEA CLIENTE O EMPRESARIO PARA COMPRAR EL KIT DE INICIO
      if ( Session::Get('logueado') == TRUE ){
          $idtipo_plan_compras =  Session::Get('idtipo_plan_compras');
          $kit_comprado                   = Session::Get('kit_comprado');
      }else{
          $idtipo_plan_compras  = 0;
          $kit_comprado         = FALSE;
      }
      $datos=compact('idtipo_plan_compras','kit_comprado');
      echo json_encode($datos,256);
    }

    public function tabla_comisiones_tron(){
      /** AGOSTO 30 DE 2015
       *      CARGA LA TABLA DE COMISIONES QUE SE TIENEN ESTABLECIDAS POR PRODUCTO / GRUPO
       */
        $this->View->Comisiones_Grupos = $this->Comisiones_Grupos->Comisiones_x_Grupo_Producto();
        $this->View->Mostrar_Vista_Parcial("tabla_comisiones");
    }

    public function plan_compensacion(){
      /** AGOSTO 30 DE 2015
       *      CARGA LA TABLA DE COMISIONES QUE SE TIENEN ESTABLECIDAS POR PRODUCTO / GRUPO
       */
        $this->View->Comisiones_Grupos = $this->Comisiones_Grupos->Comisiones_x_Grupo_Producto();
        $this->View->Mostrar_Vista("tabla_comisiones");
    }


    public function transferencioa_comisiones_puntos()  {
        $this->View->SetCss(array("transferencia_comisiones"));
        $this->View->Mostrar_Vista("transferencia_comisiones");
    }

   public function pases_cortesia(){
       $this->View->Mostrar_Vista_Parcial("pases_cortesia");
   }

   public function recomendar_amigo(){
       $this->View->Mostrar_Vista_Parcial("recomendar_amigo");
   }


   public function plan_seleccionado(){
       $this->View->idtipo_plan_compras            = Session::Get('idtipo_plan_compras');
       $this->View->idtipo_plan_compras_confirmado = Session::Get('idtipo_plan_compras_confirmado');
       $this->View->kit_comprado                   = Session::Get('kit_comprado');
       $this->View->inscripcion_pagada             = Session::Get('inscripcion_pagada');
       $this->View->Mostrar_Vista_Parcial("plan_seleccionado");
   }



   public function administrar_cuenta(){
        $this->View->SetCss(array('tron_terceros_administrar_cuenta',"tron_modificacion_datos","password",'tron_carrito_identificacion',
                                  'tron_carrito_confi_envio','tron_barra_usuarios','tron_mis_pedidos','tron_informe_mi_cuenta','tron_confi_perfil',
                                  'tron_cuenta_pases_cortesia','tron_cuenta_info_partici_la_red','cuenta_informe_mi_red'));

        $this->View->SetJs(array('tron_terceros_administrar_cuenta',"password",'tron_terceros_edicion','tron_pasos_pagar',
                                 'tron_dptos_mcipios','tron_pedidos_historial','tron_informes','jquery.tablesorter',
                                 'tron_productos.jquery'));

        $this->View->idtipo_plan_compras            = Session::Get('idtipo_plan_compras');
        $this->View->idtipo_plan_compras_confirmado = Session::Get('idtipo_plan_compras_confirmado');
        $this->View->kit_comprado                   = Session::Get('kit_comprado');
        $this->View->inscripcion_pagada             = Session::Get('inscripcion_pagada');
        $this->View->Mostrar_Vista('administrar_mi_cuenta');
   }



    public function Actualizar_Datos_Cuenta(){

        $idtercero                                      = General_Functions::Validar_Entrada('idtercero','NUM') ;
        $idtpidentificacion                             = General_Functions::Validar_Entrada('idtpidentificacion','NUM') ;

        $pnombre                                        = strtoupper( General_Functions::Validar_Entrada('pnombre','TEXT') );
        $papellido                                      = strtoupper(General_Functions::Validar_Entrada('papellido','TEXT')) ;
        $razonsocial                                    = strtoupper(General_Functions::Validar_Entrada('razonsocial','TEXT')) ;
        $idmcipio                                       = General_Functions::Validar_Entrada('idmcipio','NUM') ;
        $direccion                                      = strtoupper(General_Functions::Validar_Entrada('direccion','TEXT')) ;
        $barrio                                         = strtoupper(General_Functions::Validar_Entrada('barrio','TEXT')) ;
        $celular1                                       = General_Functions::Validar_Entrada('celular1','TEXT') ;
        $email                                          = General_Functions::Validar_Entrada('email','TEXT-EMAIL') ;
        $Es_email                                       = General_Functions::Validar_Entrada('email','EMAIL') ;
        $pago_comisiones_transferencia                  = General_Functions::Validar_Entrada('pago_comisiones_transferencia','BOL') ;
        $param_idbanco_transferencias                   = General_Functions::Validar_Entrada('param_idbanco_transferencias','NUM') ;
        $param_nro_cuenta_transferencias                = General_Functions::Validar_Entrada('param_nro_cuenta_transferencias','TEXT') ;
        $param_tipo_cuenta_transferencias               = strtoupper(General_Functions::Validar_Entrada('param_tipo_cuenta_transferencias','TEXT')) ;
        $param_idmcipio_transferencias                  = General_Functions::Validar_Entrada('param_idmcipio_transferencias','NUM') ;

        $recibo_promociones_celular                     = General_Functions::Validar_Entrada('recibo_promociones_celular','BOL') ;
        $recibo_promociones_email                       = General_Functions::Validar_Entrada('recibo_promociones_email','BOL') ;
        $param_confirmar_nuevos_amigos_x_email          = General_Functions::Validar_Entrada('param_confirmar_nuevos_amigos_x_email','BOL') ;
        $mis_datos_son_privados                         = General_Functions::Validar_Entrada('mis_datos_son_privados','BOL') ;
        $declaro_renta                                  = General_Functions::Validar_Entrada('declaro_renta','BOL') ;
        $param_acepto_retencion_comis_para_pago_pedidos = General_Functions::Validar_Entrada('param_acepto_retencion_comis_para_pago_pedidos','BOL') ;
        $param_valor_comisiones_para_pago_pedidos       = General_Functions::Validar_Entrada('param_acepto_retencion_comis_para_pago_pedidos','NUM') ;
        $pago_comisiones_efecty                         = General_Functions::Validar_Entrada('pago_comisiones_efecty','BOL') ;
        $password                                       = General_Functions::Validar_Entrada('password','TEXT') ;
        $confirmar_password                             = General_Functions::Validar_Entrada('confirmar_password','TEXT') ;
        $param_nombre_titular_cuenta                    = General_Functions::Validar_Entrada('param_nombre_titular_cuenta','TEXT') ;
        $param_nombre_titular_cuenta                    = strtoupper($param_nombre_titular_cuenta );

        $param_idtpidentificacion_titular_cuenta        = General_Functions::Validar_Entrada('param_idtpidentificacion_titular_cuenta','TEXT') ;
        $param_identificacion_titular_cuenta            =  General_Functions::Validar_Entrada('param_identificacion_titular_cuenta','TEXT') ;

        $Texto = 'OK';


        if ( $idtpidentificacion  != 31 && ( strlen( $pnombre) == 0 || strlen($papellido ) == 0 ) ){
                $Texto = $Texto . 'Debe registrar nombre y el apellido para identificar el registro. <br>';
           }

        if ( $idtpidentificacion  == 31  && strlen($razonsocial) == 0 ){
              $Texto = $Texto . 'Debe registrar el nombre de la empresa. <br>';
            }


        if ($idmcipio  == 0){
            $Texto = $Texto . 'Seleccione el departamento y ciudad en donde reside. <br>';
        }

        if ( strlen($direccion ) == 0){
            $Texto = $Texto . 'Debe registrar la dirección de residencia. <br>';
        }

        if ( strlen($barrio ) == 0){
            $Texto = $Texto . 'Debe registrar el barrio en donde reside. <br>';
        }
       if ( strlen($celular1  ) == 0) {
            $Texto = $Texto . 'Registre un número de celular. <br>';
       }

       if ( $Es_email  == FALSE ){
           $Texto = $Texto . 'El correo electrónico no tiene un formato válido. <br>';
       }

       if ( $pago_comisiones_transferencia  == TRUE)  {
            if ( $param_idbanco_transferencias  == 0 ){
                $Texto = $Texto . 'Debe seleccionar el banco en donde recibirá el pago de comisiones. <br>';
            }
            if ( strlen($param_nro_cuenta_transferencias) == 0){
                $Texto = $Texto . 'Registre el número de cuenta. <br>';
            }
            if ( empty($param_tipo_cuenta_transferencias) ){
                $Texto = $Texto . 'Seleccione el tipo de cuenta en donde se le harán transferencias. <br>';
            }
            if ( $param_idmcipio_transferencias  == 0 ){
                $Texto = $Texto . 'Debe seleccionar el departamento y la ciudad en donde está radicada la cuenta para transferencias bancarias. <br>';
            }
       }

       if ( $param_acepto_retencion_comis_para_pago_pedidos == TRUE){
          if ( $param_valor_comisiones_para_pago_pedidos <= 0 ) {
              $Texto = $Texto . 'Registre el valor que autoriza descontar de sus cuenta dinero para el pago de pedidos. <br>';
          }
       }

       if (  trim( $password)  != trim($confirmar_password)  ){
          $Texto = $Texto . 'La contraseña y su confirmación deben ser iguales. <br>';
       }

       if ( (strlen(trim($password)) < 6 && $password !='') ){
          $Texto = $Texto . 'La contraseña debe tener una longitud de 6 caracteres como mínimo. <br>';
       }



       if ( $Texto == 'OK'){
        // ACTUALIZAR REGISTRO
        if ( strlen($password ) >0 ){
            $password   = md5($password);
        }
        $parametros = compact('idtercero', 'idtpidentificacion','pnombre', 'papellido', 'razonsocial','idmcipio','direccion','barrio','celular1',
                              'email','pago_comisiones_transferencia', 'param_idbanco_transferencias' ,'param_nro_cuenta_transferencias',
                              'param_tipo_cuenta_transferencias','param_idmcipio_transferencias', 'recibo_promociones_celular',
                              'recibo_promociones_email', 'param_confirmar_nuevos_amigos_x_email', 'mis_datos_son_privados',
                              'declaro_renta', 'param_acepto_retencion_comis_para_pago_pedidos', 'param_valor_comisiones_para_pago_pedidos',
                              'pago_comisiones_efecty','password','param_nombre_titular_cuenta','param_identificacion_titular_cuenta',
                              'param_idtpidentificacion_titular_cuenta');
        $this->Terceros->Actualizar_Datos_Usuario($parametros);

       }

       $Datos = compact('Texto');
       echo json_encode($Datos ,256);
    }

     private function modificacion_datos_asigna_datos_vista($Registro){
              $this->View->Departamentos = $this->Departamentos->Consultar();
              $this->View->Bancos        = $this->Parametros->Bancos_Para_Transferencias();
              $this->View->Direcciones   = $this->Terceros->Direcciones_Despacho( $Registro [0]['idtercero'] );

              $this->View->idtpidentificacion                             = $Registro [0]['idtpidentificacion'];
              $this->View->idtercero                                      = $Registro [0]['idtercero'];
              $this->View->identificacion_nat                             = $Registro [0]['identificacion'];
              $this->View->identificacion                                 = $Registro [0]['identificacion'];
              $this->View->digitoverificacion                             = $Registro [0]['digitoverificacion'];
              $this->View->pnombre                                        = $Registro [0]['pnombre'];
              $this->View->papellido                                      = $Registro [0]['papellido'];
              $this->View->razonsocial                                    = $Registro [0]['razonsocial'];
              $this->View->direccion                                      = $Registro [0]['direccion'];
              $this->View->barrio                                         = $Registro [0]['barrio'];
              $this->View->contacto                                       = $Registro [0]['contacto'];
              $this->View->celular1                                       = $Registro [0]['celular1'];
              $this->View->email                                          = $Registro [0]['email'];
              $this->View->idmcipio                                       = $Registro [0]['idmcipio'];
              $this->View->param_confirmar_nuevos_amigos_x_email          = $Registro [0]['param_confirmar_nuevos_amigos_x_email'];
              $this->View->param_acepto_pago_valor_transferencia          = $Registro [0]['param_acepto_pago_valor_transferencia'];
              $this->View->valor_minimo_transferencia                     = $Registro [0]['valor_minimo_transferencia'];
              $this->View->param_idbanco_transferencias                   = $Registro [0]['param_idbanco_transferencias'];
              $this->View->mis_datos_son_privados                         = $Registro [0]['mis_datos_son_privados'];
              $this->View->pago_comisiones_efecty                         = $Registro [0]['pago_comisiones_efecty'];
              $this->View->pago_comisiones_transferencia                  = $Registro [0]['pago_comisiones_transferencia'];
              $this->View->param_acepto_retencion_comis_para_pago_pedidos = $Registro [0]['param_acepto_retencion_comis_para_pago_pedidos'];
              $this->View->param_valor_comisiones_para_pago_pedidos       = $Registro [0]['param_valor_comisiones_para_pago_pedidos'];
              $this->View->declaro_renta                                  = $Registro [0]['declaro_renta'];
              $this->View->nommcipio                                      = $Registro [0]['nommcipio'];
              $this->View->iddpto                                         = $Registro [0]['iddpto'];
              $this->View->nomdpto                                        = $Registro [0]['nomdpto'];
              $this->View->recibo_promociones_email                       = $Registro [0]['recibo_promociones_email'];
              $this->View->recibo_promociones_celular                     = $Registro [0]['recibo_promociones_celular'];
              $this->View->param_idbanco_transferencias                   = $Registro [0]['param_idbanco_transferencias'];

              $this->View->nombre_banco_transferencias                    = $Registro [0]['nombre_banco_transferencias'];
              $this->View->param_nombre_titular_cuenta                    = $Registro [0]['param_nombre_titular_cuenta'];
              $this->View->param_nro_cuenta_transferencias                = $Registro [0]['param_nro_cuenta_transferencias'];
              $this->View->param_tipo_cuenta_transferencias               = $Registro [0]['param_tipo_cuenta_transferencias'];
              $this->View->nom_tipo_cuenta_transferencia                  = '';
              if ( $this->View->param_tipo_cuenta_transferencias  =='AH' ){
                $this->View->nom_tipo_cuenta_transferencia      ='AHORROS';
              }
              if ( $this->View->param_tipo_cuenta_transferencias  =='CO' ){
                $this->View->nom_tipo_cuenta_transferencia      ='CORRIENTE';
              }
              $this->View->param_idmcipio_transferencias                  = $Registro [0]['param_idmcipio_transferencias'];
              $this->View->nommcipio_transferencia                        = $Registro [0]['nommcipio_transferencia'];
              $this->View->iddpto_transferencia                           = $Registro [0]['iddpto_transferencia'];
              $this->View->nomdpto_transferencia                          = $Registro [0]['nomdpto_transferencia'];
              $this->View->idtipo_plan_compras                            = $Registro [0]['idtipo_plan_compras'];
              $this->View->param_idtpidentificacion_titular_cuenta        = $Registro [0]['param_idtpidentificacion_titular_cuenta'];
              $this->View->param_identificacion_titular_cuenta            = $Registro [0]['param_identificacion_titular_cuenta'];
      }

    public function modificacion_datos( $idtercero = 0 )  {
        //POR FDEFECTO CARGO LA VISTA PARCIAL PARA LA MODIFICACIÓN DE DATOS
        $Vista_Parcial = TRUE;
        if ( $idtercero > 0 ){
          $Vista_Parcial = FALSE;
        }

        if ( $idtercero == 0 ){
            $idtercero                 = Session::Get('idtercero');
          }

        $Registro                  = $this->Terceros->Consulta_Datos_x_Idtercero($idtercero);

        $this->modificacion_datos_asigna_datos_vista($Registro);

        $this->View->SetCss(array('tron_terceros_administrar_cuenta',"tron_modificacion_datos","password",'tron_carrito_identificacion',
                                  'tron_carrito_confi_envio','tron_barra_usuarios','tron_mis_pedidos','tron_informe_mi_cuenta','tron_confi_perfil',
                                  'tron_cuenta_pases_cortesia','tron_cuenta_info_partici_la_red','cuenta_informe_mi_red'));

        $this->View->SetJs(array('tron_terceros_administrar_cuenta',"password",'tron_terceros_edicion','tron_pasos_pagar',
                                 'tron_dptos_mcipios','tron_pedidos_historial','tron_informes','jquery.tablesorter'));

        $this->View->idtipo_plan_compras            = Session::Get('idtipo_plan_compras');
        $this->View->idtipo_plan_compras_confirmado = Session::Get('idtipo_plan_compras_confirmado');
        $this->View->kit_comprado                   = Session::Get('kit_comprado');
        $this->View->inscripcion_pagada             = Session::Get('inscripcion_pagada');


        if ( $Vista_Parcial  == TRUE ){
            $this->View->Mostrar_Vista_Parcial("modificacion_datos");
          } else{
            $this->View->Mostrar_Vista("modificacion_datos");
          }

      }


    public function Recuperar_Password(){
         $email     = General_Functions::Validar_Entrada('Email','TEXT');
         $Es_email  = General_Functions::Validar_Entrada('Email','EMAIL');
         $Tercero   = $this->Terceros->Consulta_Datos_Por_Email($email);
         if ($Es_email  == false) {
              $CorreoEnviado ='Correo_No_OK';
            } else {
                if (!$Tercero) {
                         $CorreoEnviado ='NoUsuario';
                    }else{
                     $CorreoEnviado = $this->Correos->Recuperar_Password($email);
                     $idtercero     = $Tercero[0]['idtercero'];
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
        $idtipo_plan_compras                   = $Registro[0]['idtipo_plan_compras'];
        $nombre_usuario                        = $Registro[0]['nombre_usuario_pedido'];
        $genero                                = $Registro[0]['genero'];
        $idtpidentificacion                    = $Registro[0]['idtpidentificacion'];
        $pedido_minimo_productos_fabricados_ta = $Registro[0]['pedido_minimo_productos_fabricados_ta'];
        $pedido_minimo_productos_fabricados_ta = "$ ".number_format($pedido_minimo_productos_fabricados_ta ,0,"",".");
        $pre                                   = '';  // USADO PARA DETERMINAR SI ES HOMBRE O MUJER EN LOS MENSAJES

        if ( $genero == 1){
          $pre = 'o';
        }
        if ($genero == 0 ){
          $pre = 'a';
        }
        // VERFICAR SI EL TIPO DE PLAN ES 2. SIRVE PARA QUE EN CASO DE BORRAR EL KIT DE INICIO DE ESTE PEDIDO, LUEGO DEL REGISTRO
        // SE LE DEGRADE DE PLAN. PASARÍA DE 2 A 1
        if ( $idtipo_plan_compras == 2 || $idtipo_plan_compras == 3) {  Session::Set('usuario_viene_del_registro',TRUE);    }
        if ( $idtpidentificacion != 31 ){ Session::Set('usuario_viene_del_registro_es_empresa',FALSE); }
        else {                            Session::Set('usuario_viene_del_registro_es_empresa',TRUE);  }
        $Respuesta = 'Tu registro ha finalizado con éxito !!! <br> Ahora prodrás disfrutar de los beneficios de pertenecer a la Tienda Virtual TRON.';
      }
      $Respuesta = compact('Respuesta','idtipo_plan_compras','nombre_usuario','idtpidentificacion','pedido_minimo_productos_fabricados_ta');
      echo json_encode($Respuesta ,256);
    }


    public function  Verificar_Registro_Inicial_Usuario(){
      /**  JUNIO 08 2015
       *      VERFICAR SI EL TIPO DE PLAN ES 2. SIRVE PARA QUE EN CASO DE BORRAR EL KIT DE INICIO DE ESTE PEDIDO, LUEGO DEL REGISTRO
       *      SE LE DEGRADE DE PLAN. PASARÍA DE 2 A 1
       */
      $usuario_viene_del_registro            = Session::Get('usuario_viene_del_registro');
      $idtipo_plan_compras                   = Session::Get('idtipo_plan_compras');
      $usuario_viene_del_registro_es_empresa = Session::Get('usuario_viene_del_registro_es_empresa');

      if ( !isset($usuario_viene_del_registro )){
          $usuario_viene_del_registro = false ;
      }
      $Respuesta = compact('usuario_viene_del_registro','idtipo_plan_compras','usuario_viene_del_registro_es_empresa');
      echo json_encode($Respuesta,256);
    }

    public function Cambio_Plan(){

      $tipo_proceso_en_plan =  General_Functions::Validar_Entrada('tipo_proceso_en_plan', 'TEXT');
      $idtecero             = Session::Get('idtercero_pedido');
      $idtipo_plan_compras  = General_Functions::Validar_Entrada('idtipo_plan_compras', 'NUM');
      $this->Terceros->Cambio_Plan($tipo_proceso_en_plan, $idtecero, $idtipo_plan_compras);
      echo "OK";
    }

   public function activar_cuenta_usuario($codigo_confirmacion,$email,$idtercero,$idtipo_plan_compras, $idtpidentificacion )   {

        Session::Set('usuario_viene_del_registro',TRUE);
        Session::Set('idtipo_plan_compras', $idtipo_plan_compras);


        $this->View->email               = $email;
        $this->View->codigo_confirmacion = $codigo_confirmacion;
        $this->View->idtercero           = $idtercero;
        $this->View->idtipo_plan_compras = $idtipo_plan_compras;

        $this->View->SetCss(array('tron_activacion_mi_cuenta','password'));
        $this->View->SetJs(array('tron_terceros_activar_cuenta','password'));
        $this->View->Mostrar_Vista("activar_cuenta_usuario");



    }

    public function Registro_Datos_Usuario() {
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
        //DATOS DIFERENCIALES EMPRESA
        $nit                = General_Functions::Validar_Entrada('nit','TEXT');
        $digitoverificacion = General_Functions::Validar_Entrada('digitoverificacion','TEXT');
        $razonsocial        = General_Functions::Validar_Entrada('razonsocial','TEXT');
      if ( strlen($identificacion) == 0){
        $identificacion = $nit ;
      }
      //
       $mes           = General_Functions::Validar_Entrada('mes','NUM');
       $dia           = General_Functions::Validar_Entrada('dia','NUM');
       if ($mes  < 9) { $mes  = '0'.$mes ; }
       if ($dia  < 9) { $dia  = '0'.$dia ; }

       if ( strlen($identificacion) == 0){
          $Texto_Respuesta =  $Texto_Respuesta . 'Debe registrar el número de identificación o N.I.T. para grabar el registro.<br>';
       }

       if ($idtpidentificacion != 31){
           if ( strlen( $pnombre)== 0 || strlen(  $papellido  ) == 0 ){
                $Texto_Respuesta =  $Texto_Respuesta . 'El nombre y apellido no pueden estar en blanco.<br>';
           }
         }else{
          if ( strlen( $razonsocial )== 0){
              $Texto_Respuesta =  $Texto_Respuesta . 'El nombre de la empresa no puede quedar en blanco.<br>';
            }
          if ( strlen($digitoverificacion) == 0 ){
               $Texto_Respuesta =  $Texto_Respuesta . 'Registre el dígito de verificación.<br>';
            }
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
            }
        }
        // GENERACIÓN CÓDIGO DE USUARIO. SI NO ES EMPRESA ->Generar_Codigo_Usuario .... SINO Generar_Codigo_Emmpresa
        if ( $idtpidentificacion != 31  )  {
            $Datos_Nuevo_Codigo      = $this->Terceros->Generar_Codigo_Usuario($pnombre ,$papellido, $dia, $mes);
            $codigo_usuario_generado = $Datos_Nuevo_Codigo [0]['codigo_generado'];
            $genero                  = 0;
          }
        if ( $idtpidentificacion == 31   ) {
            $Datos_Nuevo_Codigo      = $this->Terceros->Generar_Codigo_Emmpresa( $razonsocial);
            $codigo_usuario_generado = $Datos_Nuevo_Codigo [0]['codigo_generado'];
            $genero                  = 0;
          }



        $codigousuario                                  = $codigo_usuario_generado;
        $codautorizacionmenoredad                       = '';
        $dianacimiento                                  = intval($dia);
        $mesnacimiento                                  = intval($mes);
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
        $idtppersona                                    = 2;
        if ($idtpidentificacion != 31){ $idtppersona    = 1;}

        $pnombre     = strtoupper($pnombre);
        $papellido   = strtoupper($papellido);
        $razonsocial = strtoupper($razonsocial);
        $direccion   = strtoupper($direccion);
        $barrio      = strtoupper($barrio);


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
     $idtercero            =  $Registro[0]['idtercero'];
     $telefono             =  $celular1;
     $destinatario         =  $pnombre . ' ' . $papellido;
     $destinatario         = strtoupper($destinatario);
     $iddireccion_despacho = 0;

     // GRABAR DIRECCION DE DESPACHO
     //------------------------------
     $Datos_Direccion_Despacho = compact('iddireccion_despacho','idtercero','idmcipio','direccion','barrio','telefono','barrio','destinatario');
     $this->Terceros->Direcciones_Despacho_Grabar_Actualizar($Datos_Direccion_Despacho);
     // ESTABLECER VARIABLES DEL DESPACHO EN CASO DE QUE SE HAGA UN PEDIDO LUEGO DEL REGISTRO
     //--------------------------------------------------------------------------------------
     $this->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho(0,$idmcipio);

     $this->Registro_Datos_Usuario_Envio_Correo_Activacion($idtercero ,$email, $pnombre, $genero, $idtipo_plan_compras ,
                                                          $idtpidentificacion,$razonsocial,  $codigousuario);

     // DEJAR LAS VARIABLES EN BLANCO
     $this->Registro_Re_Establecer_Tercero_Presenta();
     Session::Destroy('idtipo_plan_compras');


     $Datos = compact('Texto_Respuesta' );
     echo json_encode($Datos,256);
    }

  public function Registro_Datos_Usuario_Envio_Correo_Activacion($idtercero ,$email, $pnombre, $genero, $idtipo_plan_compras ,
                  $idtpidentificacion,$razonsocial, $codigousuario)
  {
     // ENVIO CORREO PARA ACTIVACIÓN DE USUARIO
     $Res = $this->Correos->Activacion_Registro_Usuario($idtercero ,$email, $pnombre,$genero, $idtipo_plan_compras ,
                                                        $idtpidentificacion,$razonsocial, $codigousuario );
     // GENERA REGISTRO TEMPORAL PARA CONFIRMACIÓN DE CUENTA.
     $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero ,Session::Get('codigo_confirmacion'));

  }

    public function Registro_Buscar_Por_Codigo( $codigousuario_presenta='', $salida_jquery=TRUE){
      /** MAYO 24 DE 2015
       *      REALIZA LA BÚSQUEDA DE DATOS POR CÓDIGO DE USUARIO
       */
      $this->Registro_Re_Establecer_Tercero_Presenta();
      if ( $codigousuario_presenta == ''){
        $codigousuario  = General_Functions::Validar_Entrada('codigousuario','TEXT');
      }else{
        $codigousuario  =  $codigousuario_presenta ;
      }
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
      if ( $salida_jquery == TRUE ){
          echo json_encode($Datos,256);
          }
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

    public function Compra_Productos_Tron_Mes_Actual( $compras_tron_pedido_actual = 0, $compras_industrial_pedido_actual = 0)
    {/**  MARZO 17 DE 2015
      *       CONSULTA LAS COMPRAS QUE SE HAN REALIZADO DE PRODUCTOS TRON EN EL MES ACTUAL, CONDICIÓN NECESARIA PARA
      *       CONCEDER PRECIOS ESPECIALES
      */

      $Registro                             = $this->Terceros->Compra_Productos_Tron_Mes_Actual();
      $compra_minima_productos_tron         = $Registro[0]['minimo_compras_productos_tron'];
      $compra_minima_productos_industriales = $Registro[0]['minimo_compras_productos_ta'];

      $compras_este_mes_tron                = $Registro[0]['compras_productos_tron'];
      $compras_este_mes_industiales         = $Registro[0]['compras_productos_fabricados_ta'];

      $compras_este_mes_tron                = $compras_este_mes_tron  + $compras_tron_pedido_actual;
      $compras_este_mes_industiales         = $compras_este_mes_industiales + $compras_industrial_pedido_actual ;

      //Session::Set('minimo_compras_productos_tron',         $Registro[0]['minimo_compras_productos_tron']);
      //Session::Set('minimo_compras_productos_ta',           $Registro[0]['minimo_compras_productos_ta']);
      Session::Set('compras_realizadas_tron',               $Registro[0]['compras_productos_tron']);
      Session::Set('compras_productos_fabricados_ta',       $Registro[0]['compras_productos_fabricados_ta']);



      // ESTABLECER SI CUMPLE CONDICIONES DE COMPRAS MINIMAS
      if ($compras_este_mes_tron  >= $compra_minima_productos_tron ||  $compras_este_mes_industiales >= $compra_minima_productos_industriales){
        Session::Set('cumple_condicion_cpras_tron_industial', TRUE);
      }


    }

    public function Direcciones_Despacho_Grabar_Actualizar()
    {/** MARZO 05 DE 2015
          *         INSERTA O ACTUALIZA UNA DIRECCIÓN DE DESPACHO PARA UN TERCERO
          */
      $iddireccion_despacho = General_Functions::Validar_Entrada('iddireccion_despacho','NUM');
      $idtercero =  General_Functions::Validar_Entrada('idtercero','NUM');
      if ( !isset($idtercero) || $idtercero == 0){
       $idtercero            = Session::Get('idtercero_pedido');
      }
      $idmcipio             = General_Functions::Validar_Entrada('idmcipio','NUM');
      $direccion            = General_Functions::Validar_Entrada('direccion','TEXT');
      $telefono             = General_Functions::Validar_Entrada('telefono','TEXT');
      $barrio               = General_Functions::Validar_Entrada('barrio','TEXT');
      $destinatario         = General_Functions::Validar_Entrada('destinatario','TEXT');
      $Respuesta            = '';

      if ( $idtercero == 0){
        $Respuesta = $Respuesta . 'Seleccione el usuario al cual pertenece la dirección.<br>';
      }

      if (strlen($destinatario  )==0) {
        $Respuesta = $Respuesta . 'Debe registrar el destinatario.<br>';
      }

      if ($idmcipio ==0 ){
        $Respuesta = $Respuesta . 'Debe seleccionar departamento y municipio.<br>';
      }
      if (strlen($direccion)==0){
        $Respuesta = $Respuesta . 'Debe registrar la dirección para realizar los despachos.<br>';
      }
      if (strlen($barrio )==0){
        $Respuesta = $Respuesta . 'Registre el barrio en donde figura la dirección registrada.<br>';
      }
      if (strlen($telefono)==0){
        $Respuesta = $Respuesta . 'Es necesario que registre un número de teléfono.<br>';
      }
      $destinatario = strtoupper($destinatario);
      $direccion    = strtoupper($direccion);
      $barrio       = strtoupper($barrio);



      if (strlen($Respuesta) ==0 || $Respuesta =='' )  {
        $params = compact('iddireccion_despacho','idtercero','idmcipio','direccion','telefono','barrio','destinatario');
        $this->Terceros->Direcciones_Despacho_Grabar_Actualizar($params);
        $cantidad_direcciones = Session::Get('cantidad_direcciones') + 1 ;
        Session::Set('cantidad_direcciones', $cantidad_direcciones);
        $Respuesta = 'OK';
      }
      $Datos = compact('Respuesta');
      echo json_encode($Datos,256);

    }

    public function Direcciones_Despacho()
    {
      $this->Direcciones = $this->Terceros->Direcciones_Despacho();
      return $this->Direcciones;
    }

    public function Direcciones_Despacho_x_IdTercero()
    {
       $idtercero         = General_Functions::Validar_Entrada('idtercero','NUM');
       $json              = General_Functions::Validar_Entrada('json','NUM');
       $this->Direcciones = $this->Terceros->Direcciones_Despacho($idtercero );
      if ( $json  == 1 ){
            echo json_encode( $this->Direcciones ,256);
          }else{
              $this->View->Direcciones = $this->Direcciones ;
              $this->View->Mostrar_Vista_Parcial('modificacion_direcciones');
          }
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

    public function cuenta_pases_premium() {
        $this->View->SetCss(array("tron_cuenta_pases_cortesia","tron_barra_usuarios"));
        $this->View->Mostrar_Vista("cuenta_pases_premium");
    }

    public function cuenta_pases_de_cortesia() {
        $this->View->SetCss(array("tron_cuenta_pases_cortesia","tron_barra_usuarios"));
        $this->View->Mostrar_Vista("cuenta_pases_cortesia");
    }

    public function configuracion_perfil() {
        $this->View->SetCss(array("tron_confi_perfil"));
        $this->View->SetJs(array('cuenta_configuracion_perfil'));
        $this->View->Mostrar_Vista("confi_perfil");
    }

    public function comisiones_bonificaciones_pagadas() {
        $this->View->SetCss(array("tron_terceros_comis_bonifi"));
        $this->View->Mostrar_Vista("comisiones_bonificaciones_pagadas");
    }


    public function Validar_Ingreso_Usuario_Asignar_Datos( $Registro ){
      Session::Set('idtercero',                       $Registro[0]['idtercero']);
      Session::Set('identificacion' ,                 $Registro[0]['identificacion']);
      Session::Set('nombre_usuario',                  $Registro[0]["pnombre"]);
      Session::Set('idtpidentificacion',              $Registro[0]['idtpidentificacion']);
      Session::Set('cod_tp_identificacion',             $Registro[0]['cod_tp_identificacion']);
      Session::Set('email',                           $Registro[0]['email']);
      Session::Set('codigousuario',                   $Registro[0]['codigousuario']);
      Session::Set('vr_cupon_descuento'   ,     0);
      Session::Set('idtipo_plan_compras',             $Registro[0]["idtipo_plan_compras"]); // 1 ocasional, 2, cliente, 3 empresarios
      Session::Set('idtipo_plan_compras_confirmado',  $Registro[0]["idtipo_plan_compras_confirmado"]);
      Session::Set('kit_comprado',                    $Registro[0]["kit_comprado"]);
      Session::Set('inscripcion_pagada',              $Registro[0]["inscripcion_pagada"]);
      Session::Set('fecha_hora_acepta_convenio',      $Registro[0]["fecha_hora_acepta_convenio"]);
      // DATOS PARA ENTREGA DEL PEDIDO Y CALCULO DE FLETES
      Session::Set('idtercero_pedido',                $Registro[0]['idtercero']);
      Session::Set('pagado_online',                   0);
      Session::Set('nombre_usuario_pedido',           $Registro[0]["nombre_usuario_pedido"]);
      Session::Set('iddireccion_despacho',            0);
      Session::Set('cantidad_direcciones',            $Registro[0]["cantidad_direcciones"]);
      Session::Set('Generando_Pedido_Amigo',          FALSE);
      Session::Set('idmcipio',                        $Registro[0]["idmcipio"]);
      Session::Set('nommcipio_despacho',              $Registro[0]["nommcipio_despacho"]);
      Session::Set('nomdpto_despacho'  ,              $Registro[0]["nomdpto_despacho"]);
      Session::Set('iddpto'            ,              $Registro[0]["iddpto"]);
      Session::Set('cobrar_fletes'      ,             $Registro[0]["cobrar_fletes"]);

      $Usuarios             = $this->Terceros->Buscar_Usuarios_Activos_x_Email( $Registro[0]['email'] );
      Session::Set('codigos_usuario',                 $Usuarios);

      // CONSULTA DATOS PARA DETERMINAR SI SE CUMPLEN LAS CONDICIONES DE COMPRAS MÍNIMAS DE PRODUCTOS TRON O PINDUSTRIALES
      $this->Compra_Productos_Tron_Mes_Actual();
      $this->Consultar_Saldos_Comisiones_Puntos_x_Idtercero();

      // DETERMINAR SI ESTE ES SU DÍA DE CUMPLEAÑOS
      $FechaNace = trim($Registro[0]["dianacimiento"]) . trim($Registro[0]["mesnacimiento"]);
      $FechaHoy  = trim($Registro[0]["mes"])           . trim($Registro[0]["dia"]);
      if ( $FechaNace == $FechaHoy ){
        Session::Set('cumple_anios',TRUE);
      }

    }

    public function Validar_Ingreso_Usuario(){
       Session::Set('logueado',   FALSE);
       $Email                = General_Functions::Validar_Entrada('email','TEXT');
       $Password             = General_Functions::Validar_Entrada('Password','TEXT');
       $Password             = md5($Password );
       $Registro             = $this->Terceros->Consulta_Datos_Por_Password_Email($Email ,$Password);


       if (!$Registro ) {
         $Resultado_Logueo = "NO-Logueo_OK";
       }else {
            $this->Validar_Ingreso_Usuario_Asignar_Datos($Registro);      // ASIGNA LOS DATOS PROVENIENTES DEL LOGUEO
            $Resultado_Logueo = "Logueo_OK";
            Session::Set('logueado',   TRUE);
         }

         $Siguiente_Paso = Session::Get('finalizar_pedido_siguiente_paso');
         if (!isset( $Siguiente_Paso ) ) {
          $Siguiente_Paso='';
         }
         $Datos            = compact('Resultado_Logueo','Siguiente_Paso');
         echo json_encode($Datos,256);
      }


    public function Verificar_Activacion_Usuario(){
      /** JUNIO 13 DE 2015
       *      AL LOGUEARSE VERIFICA QUE EL USUARIO HAYA FINALIZADO Y CONFIRMADO EL REGISTRO
       */
       $Email               = General_Functions::Validar_Entrada('email','TEXT-EMAIL');
       $Es_Email            = General_Functions::Validar_Entrada('email','EMAIL');
       $Respuesta           = '';
       $passwordusuario     = '';
       $registroconfirmado  = FALSE ;
       $idtercero           = 0;
       $nombre_usuario      = '';
       $genero              = '';
       $idtipo_plan_compras = 0;
       $idtpidentificacion  = 0;
       $razonsocial         = '';

       if ( $Es_Email == FALSE ){
            $Respuesta = 'Correo_No_OK';
       }else{
        $Usuario_Activo = $this->Terceros->Verificar_Activacion_Usuario($Email);
        if ( !$Usuario_Activo ){
             $Respuesta = 'Correo_No_Existe';
        }else{
            $passwordusuario     = $Usuario_Activo[0]['passwordusuario'];
            $registroconfirmado  = $Usuario_Activo[0]['registroconfirmado'];
            $idtercero           = $Usuario_Activo[0]['idtercero'];
            $nombre_usuario      = $Usuario_Activo[0]['pnombre'];
            $genero              = $Usuario_Activo[0]['genero'];
            $idtipo_plan_compras = $Usuario_Activo[0]['idtipo_plan_compras'];
            $idtpidentificacion  = $Usuario_Activo[0]['idtpidentificacion'];
            $razonsocial         = $Usuario_Activo[0]['razonsocial'];
            if ( strlen($passwordusuario) == 0 ||  $registroconfirmado  == FALSE ){
                $Respuesta = 'Usuario_No_Activo';
            }else{
                $Respuesta = 'Usuario_Activo';
            }
        }
       }
       $Datos = compact('Respuesta','passwordusuario','registroconfirmado','idtercero','nombre_usuario','genero','idtipo_plan_compras','idtpidentificacion','razonsocial','Email');
       echo json_encode($Datos,256);
    }



      public function Consultar_Saldos_Comisiones_Puntos_x_Idtercero(){
         Session::Set('saldo_comisiones',                0);
         Session::Set('saldo_puntos_cantidad',           0);
         $Registro = $this->Terceros->Consultar_Saldos_Comisiones_Puntos_x_Idtercero();
         if (!$Registro ) { return ; }
         Session::Set('saldo_comisiones',               round( $Registro[0]["saldo_comisiones"]     , 0) );
         Session::Set('saldo_puntos_cantidad',          round( $Registro[0]["saldo_puntos_cantidad"], 0) );
      }

      public function Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($IdDireccion_Despacho, $idmcipio=153 )   {
      /** MARZO 12 DE 2015
        *       CONSULTA INFORMACIÓN DE LA CIUDAD, DEPARTAMENTO Y VARIABLES DE FLETES CON LA DIRECCIÓN DE DESPACHO SELECCIONADA
        *       ESTABLECE UN PARAMETRO idmcipio = 153 ( CALI ), PARA CONSULTAR DESDE EL INDEX CONTROLLER Y CARGAR CIERTAS VARIABLES
        */

        if ( empty( $idmcipio)  ){
            $idmcipio = 153 ;
          }

        if ($IdDireccion_Despacho > 0) {
          $Registro = $this->Terceros->Consultar_Datos_Mcipio_x_Id_Direccion_Despacho($IdDireccion_Despacho );
        }else  {
          $Registro = $this->Terceros->Consultar_Datos_Mcipio_x_IdMcipio( $idmcipio );
        }


        Session::Set('idmcipio',                        $Registro[0]["idmcipio"]);
        Session::Set('iddpto',                          $Registro[0]["iddpto"]);
        Session::Set('nommcipio_despacho',              ucfirst ($Registro[0]["nommcipio_despacho"]));
        //REDETRANS
        Session::Set('re_expedicion',                   $Registro[0]["re_expedicion"]);
        Session::Set('vr_kilo_idmcipio_redetrans',      $Registro[0]["vr_kilo"]);
        Session::Set('vr_re_expedicion_redetrans',      $Registro[0]["vr_re_expedicion"]);
        Session::Set('redetrans_tipo_despacho',         '');
        //SERVIENTREGA
        Session::Set('vr_kilo_idmcipio_servientrega',   $Registro[0]["vr_kilo_servientrega"]);
        Session::Set('re_expedicion_servientrega',      $Registro[0]["re_expedicion_servientrega"]);
        Session::Set('servientrega_tipo_despacho',      $Registro[0]["servientrega_tipo_despacho"]);

        if ( Session::Get('vr_kilo_idmcipio_redetrans') > 0 || Session::Get('vr_re_expedicion_redetrans') > 0 ){
          Session::Set('redetrans_tipo_despacho',         'aplica_redetrans');
        }


     }






    public function registrarse() {
        $this->View->SetCss(array("tron_registrarse"));
        $this->View->Mostrar_Vista("registrarse");
    }


    public function registro( $presentado_por_amigo = 0 )  {
        if ( $presentado_por_amigo == 0 ) {
            $this->Registro_Re_Establecer_Tercero_Presenta();
          }
        Session::Destroy('idtipo_plan_compras');

        $this->View->SetCss(array('tron_menu_footer','tron_dptos_mcipios','tron_registro','tron-registro-p2'));
        $this->View->SetJs(array('tron_terceros_registro','tron_dptos_mcipios'));

        $this->View->TiposDocumentos        = $this->TiposDocumentos->Consultar();
        $this->View->Departamentos          = $this->Departamentos->Consultar();
        $this->View->Total_Kit_Inscripcion  = Session::Get('kit_vr_venta_valle') ;

        if ( Session::Get('codigousuario') == 'JUANBAUTISTA'){
          $codigo = substr(Session::Get('codigousuario') ,0,4);
          $codigo_2 = substr(Session::Get('codigousuario') ,4,8);
          Session::Set('codigousuario',$codigo . ' ' .$codigo_2 );
        }
        $this->View->codigousuario          = Session::Get('codigousuario') ; // Es el usuario que presenta a la persona que se registra

        $this->View->Modifica_Codigo_Presenta = TRUE;
        if ( strlen($this->View->codigousuario) > 0 ){
            $this->Registro_Buscar_Por_Codigo($this->View->codigousuario, FALSE );
            $this->View->Modifica_Codigo_Presenta = FALSE;
        }
        $this->View->Mostrar_Vista('registro');
    }

    public function registro_paso_2() {
        $this->View->SetCss(array('tron_menu_footer','tron_registro','tron_registro','tron-regirtro-pasos','tron-registron-p2'));
        $this->View->SetJs(array('tron_terceros_registro'));
        $this->View->Mostrar_Vista('registro_paso_2');
    }

    public function Consulta_Datos_Por_Email($email) {
        $Terceros = $this->Terceros->Consulta_Datos_Por_Email($email);
        return $Terceros;
    }

    public function Consulta_Datos_Por_Email_Registro() {
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


    public function cambiar_password($numero_confirmacion) {

        $this->View->Numero_Confirmacion = $numero_confirmacion;
        $this->View->SetCss(array('tron_cambiar_password','tron_ventana_modal','password'));
        $this->View->SetJs(array('tron_login','tron_cambio_password','password'));
        $this->View->Mostrar_Vista('cambiar_password');
    }

    public function Clave_Temporal_Grabar_Cambio_Clave($idtercero,$password_temporal) {
        /** FEBRERO 03 DE 2015
        **  INSERTA EN LA TABLA UN REGISTRO TEMPORAL QUE SE USARÁ PARA LA VERIFICACIÓN EN EL CAMBIO DE CLAVE
        */
        $this->Terceros->Clave_Temporal_Grabar_Cambio_Clave($idtercero,$password_temporal);
    }

    public function Buscar_Por_Identificacion(){
     /** MAYO 05 DE 2015
     *   CONSULTA DATOS BÁSICO DE UN TERCERO POR IDENTIFICACION
     */
     $identificacion        = General_Functions::Validar_Entrada('identificacion','TEXT');
     $Tercero               = $this->Terceros->Buscar_Por_Identificacion($identificacion);
     $cant_pedidos_facturados = 0 ;
     $idtercero             = 0;

     if (!$Tercero){
          $Respuesta ='NO_EXISTE';
     }else{
        $Respuesta ='SI_EXISTE';
        $cant_pedidos_facturados = $Tercero[0]['cant_pedidos_facturados'];
        $idtercero             = $Tercero[0]['idtercero'];
     }
     $Datos = compact('Respuesta','cant_pedidos_facturados','idtercero' );
     echo json_encode($Datos ,256);
    }


    public function Compresion_Dinamica (){
       $this->Terceros->Compresion_Dinamica ();
    }






   }
?>






















