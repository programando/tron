
var  Funciones = {


  Mostrar_Mensajes : function( $Titulo, $Contenido ){
   $('.modal-header #contenido').html($Titulo);
   $('.modal-body #contenido').html($Contenido);
   $('#modal_error').modal('show');
    },// fin  Mostrar_Mensajes


    // RELACIONAS CON TERCEROS
    // -------------------------
    Terceros_Buscar_x_Identificacion : function(  ){
      var $identificacion = $('#identificacion').val();
      if ($identificacion.length==0){ return ;}

      $.ajax({
        data:  {'identificacion':$identificacion},
        dataType: 'json',
        url:      '/terceros/Buscar_Por_Identificacion',
        type:     'post',
        success:  function (respuesta)     {
          if (respuesta.Respuesta == 'SI_EXISTE' && respuesta.cant_pedidos_facturados == 0){
           window.location.href = "/terceros/edicion/"+respuesta.idtercero;
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
                    window.location.href = "/";

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


          Terceros_Validar_Email_Edicion : function ( ){
            $email = $("#email-edit").val();
            //
            if ( $email.length == 0 ){
              return ;
            }

            $Texto        = '';
            $Texto.length = 0;
            $.ajax({
              data:  {'email':$email},
              dataType: 'json',
              url:      '/terceros/Actualizar_Datos_Basicos/' ,
              type:     'post',
              success:  function (respuesta) {
                //alert($email  );
                if (respuesta.Respuesta == 'EMAIL-NO-OK'){
                  $Texto = 'El correo electrónico  <strong>' + $email + '</strong> tiene un formato no válido. Por favor escríbalo nuevamente.';
                }
                if ( $Texto.length > 0){
                 Funciones.Mostrar_Mensajes('Información del Sistema',$Texto  );
                 $("#email-edit").val('');

               }
             }
           });
          },// Terceros_Validar_Email

      Terceros_Actualizar_Datos_Registro : function( $Parametros ) {
              var $img_cargando        = $('#img_cargando');
              $.ajax({
                data:  $Parametros,
                dataType: 'json',
                url:      '/terceros/Registro_Actualizar_Datos_Basicos',
                type:     'post',
                success:  function (resultado) {
                    if ( resultado.Texto_Respuesta = 'ACTUALIZADO-OK'){
                        window.location.href ="/index"
                      } else {
                        Funciones.Mostrar_Mensajes('Información del Sistema',  "La modificación de datos no pudo ejecutarse correctamente.");
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
          },//    Terceros_Actualizar_Datos_Registro


  Formato_Numero (amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
},




}

