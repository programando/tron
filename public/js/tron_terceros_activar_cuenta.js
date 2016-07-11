var Agregar_Producto_a_Carrito= function (NomProducto,Parametros)
{
    $.ajax({
          data:  Parametros,
          dataType: 'json',
          url:      '/tron/carrito/Agregar_Producto/',
          type:     'post',
           success:  function (resultado)
             {
               $('.carrito-Total_Parcial_pv_ocasional').html( resultado.VrOcasional );
               $('.carrito-Total_Parcial_pv_tron').html( resultado.VrTron );

             }
          });
}

var Paso_Final_Registro_Plan_1 = function(Texto){
     new Messi(Texto,
      {title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
        buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-success'}],
        callback: function(val){
          window.location.href = "/tron/index/";
        }
      });
}

var Paso_Final_Registro_Plan_2 = function( nombre_usuario,idtpidentificacion,pedido_minimo_productos_fabricados_ta){
      var $Texto = '';
    // AGREGO KIT DE INICIO AL PEDIDO
     $Parametros  = {"IdProducto" :10744, "CantidadComprada": 1, "es_tron": true , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);
     if (idtpidentificacion != 31 ){
        $Texto = "<stron><h4>" + nombre_usuario + "</h4></stron><br>Bienvenido(a) a la red TRON.<br>Para finalizar tu registro como cliente debes pagar ahora o seguir comprando...<br>";
     }else{
       $Texto = "Por haber registrado un NIT como documento de identidad, pensamos que pueden interesarte nuestras líneas de productos especializados en la limpieza, la desinfección y el mantenimiento preventivo y correctivo del sector industrial. <br><br>Si este es tu caso, no es necesario que para registrarte compres el Kit de Inicio pues éste está orientado hacia el hogar. Puedes reemplazarlo por una compra de " + pedido_minimo_productos_fabricados_ta +" en productos industriales fabricados por Balquima S.A.S., los cuales encontrarás en la pestaña INDUSTRIAL, al lado de HOGAR en la página de inicio, arriba, sobre la barra de menús. Si estás de acuerdo con lo anterior, acepta el Plan de tu conveniencia y pasa al carrito de compras. <br><br>Agrega "+pedido_minimo_productos_fabricados_ta +" en productos industriales fabricados por Balquimia S.A.S. y después, elimina el Kit de Inicio. El sistema reconocerá la sustitución y te permitirá el registro. <br> Mayores informes en contactos@balquimia.com <br>";
     }
     new Messi($Texto,
      {title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
        buttons: [{id: 0, label: 'Seguir Comprando', val: 'S', class: 'btn-success'},
                  {id: 1, label: 'Pagar Ahora', val: 'P', class: 'btn-danger'}],
        callback: function(val){
              if ( val== 'S'){
                window.location.href = "/tron/index/";
              }
              if ( val== 'P'){
                window.location.href = '/tron/carrito/Mostrar_Carrito/1';
              }

             }
      });
}

var Paso_Final_Registro_Plan_3 = function( nombre_usuario, idtpidentificacion,pedido_minimo_productos_fabricados_ta){
    // AGREGO KIT DE INICIO AL PEDIDO
     $Parametros  = {"IdProducto" :10744, "CantidadComprada": 1, "es_tron": true , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);

     new Messi("<stron><h4>" + nombre_usuario + "</h4></stron><br>Bienvenido(a) a la red TRON.<br>Para finalizar tu registro como empresario debes pagar ahora o seguir comprando...<br>",
      {title: 'Mensaje del Sistema',modal: true, titleClass: 'info',
        buttons: [{id: 0, label: 'Seguir Comprando', val: 'S', class: 'btn-success'},
                  {id: 1, label: 'Pagar Ahora', val: 'P', class: 'btn-danger'}],
        callback: function(val){
              if ( val== 'S'){
                window.location.href = "/tron/index/";
              }
              if ( val== 'P'){
                window.location.href = '/tron/carrito/Mostrar_Carrito/1';
              }

             }
      });
}



$('#btn-activar_cta_ocasional').on('click',function(){

  var $codigo_verificacion = $('#codigo-verificacion').val();
  var $idtecero            = $(this).attr('idtercero');
  var $password            = $.trim( $('#password').val());
  var $password_confirm    = $.trim($('#confirmar-password').val());
  var $img_cargando        = $('#img_cargando');
  var $email               = $('#email_activar_cuenta').val();
  var $Texto               = '';
  var $idtipo_plan_compras = 0;
  var $nombre_usuario      = '';
  var $acepto_terminos     = $('#acepto_terminos_y_condiciones').is(':checked');

  if ( $acepto_terminos == false ){
     new Messi('Debe aceptar los términos y condiciones.',
               {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}],
               callback: function(val) {}
               });
     return ;
  }

	var $Parametros = {'idtecero':$idtecero,'codigo_verificacion':$codigo_verificacion,
	                   'password':$password,'password_confirm':$password_confirm,'email':$email };

        $.ajax({
              data:  $Parametros,
              dataType: 'json',
              url:      '/tron/terceros/activar_cuenta_usuario_finalizar_registro/',
              type:     'post',
          success:  function (resultado)
           {
             $Texto                                 = resultado.Respuesta;
             $idtipo_plan_compras                   =  resultado.idtipo_plan_compras;
             $nombre_usuario                        = resultado.nombre_usuario;
             $idtpidentificacion                    = resultado.idtpidentificacion;
             $pedido_minimo_productos_fabricados_ta = resultado.pedido_minimo_productos_fabricados_ta;

             if ( $idtipo_plan_compras == 1){  Paso_Final_Registro_Plan_1 ($Texto )         ; }
             if ( $idtipo_plan_compras == 2){  Paso_Final_Registro_Plan_2 ($nombre_usuario,$idtpidentificacion,$pedido_minimo_productos_fabricados_ta ) ; }
             if ( $idtipo_plan_compras == 3){  Paso_Final_Registro_Plan_3 ($nombre_usuario,$idtpidentificacion,$pedido_minimo_productos_fabricados_ta ) ; }

             if ( $idtipo_plan_compras == 0){
              new Messi($Texto,
                     {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}],
                     callback: function(val) {}
                     });
             }
           },
           beforeSend: function(){
              $img_cargando.css('display','block');
           },
           complete: function(){
              $img_cargando.css('display','none');

           },
           error: function(xhr){
                  new Messi('Se ha presentado el siguiente error : <br>' + xhr.responseText,
                         {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});

           }
        });
});


