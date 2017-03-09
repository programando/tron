
var  Funciones = {


  Mostrar_Mensajes : function( $Titulo, $Contenido ){
   $('.modal-header #contenido').html($Titulo);
   $('.modal-body #contenido').html($Contenido);
   $('#modal_error').modal('show');
    },// fin  Mostrar_Mensajes


    // RELACIONAS CON TERCEROS
    // -------------------------
    Terceros_Buscar_x_Identificacion : function (  ){
      var $identificacion = $('#identificacion').val();
      if ($identificacion.length==0){ return ;}

      $.ajax({
        data:  {'identificacion':$identificacion},
        dataType: 'json',
        url:      '/terceros/Buscar_Por_Identificacion',
        type:     'post',
        success:  function (respuesta)     {
          if (respuesta.Respuesta == 'SI_EXISTE' && respuesta.cant_pedidos_facturados == 0){
           Funciones.Mostrar_Mensajes('Información de Cuenta', 'La identificación ya se encuentra registrada en nuestro sistema de información.<br>Inicie sesión si desea modificar sus datos.');
           $('#identificacion').val('');
         }
         if (respuesta.Respuesta == 'SI_EXISTE' && respuesta.cant_pedidos_facturados > 0){
          Funciones.Mostrar_Mensajes('Información de Control', 'La identificación ya se encuentra registrada en nuestro sistema de información.');
          $('#identificacion').val('');
        }
      }
    });
        },//    Buscar_Por_Identificacion

        Terceros_Grabar_Datos_Registro : function( $Parametros ) {

              var $img_cargando        = $('#img_cargando');
              $.ajax({
                data:  $Parametros,
                dataType: 'json',
                url:      '/terceros/Registro_Nuevo_Usuario',
                type:     'post',
                success:  function (resultado) {

                  if ( resultado.idtipo_plan_compras == '2' ) {
                      $("#modal-registro-cliente").modal('show');
                    }

                  if ( resultado.idtipo_plan_compras == '3' ) {
                      $("#modal-registro-empresario").modal('show');
                    }



                },
                beforeSend: function(){
                          $img_cargando.css('display','block');
                        },
                complete: function(){
                          $img_cargando.css('display','none');
                           //alert("completado");
                         },
                error: function(xhr){
                           Funciones.Mostrar_Mensajes('Información del Sistema',  xhr.responseText );
                         }
                       });

          },//    Terceros_Grabar_Datos_Registro


          Terceros_Validar_Email : function ( ){
            $email = $("#email").val();
            //
            if ( $email.length == 0 ){
              return ;
            }

            $Texto        = '';
            $Texto.length = 0;
            $.ajax({
              data:  {'email':$email},
              dataType: 'json',
              url:      '/terceros/Consulta_Datos_Por_Email_Registro/' ,
              type:     'post',
              success:  function (respuesta) {
                //alert($email  );
                if (respuesta.Respuesta == 'EMAIL-NO-OK'){
                  $Texto = 'El correo electrónico  <strong>' + $email + '</strong> tiene un formato no válido. Por favor escríbalo nuevamente.';
                }
                if (respuesta.Respuesta == 'EMAIL-EXISTE'){
                  $Texto = 'El correo electrónico  <strong>' +  $email + '</strong> ya se encuentra registrado en nuestra base de datos.';
                }
                if ( $Texto.length > 0){
                 Funciones.Mostrar_Mensajes('Información del Sistema',$Texto  );
                 $("#email").val('');

               }
             }
           });
          },// Terceros_Validar_Email





}// Fin Funciones

