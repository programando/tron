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

var Paso_Final_Registro_Plan_2 = function( nombre_usuario){
    // AGREGO KIT DE INICIO AL PEDIDO
     $Parametros  = {"IdProducto" :10744, "CantidadComprada": 1, "es_tron": false , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);


     new Messi("<stron><h4>" + nombre_usuario + "</h4></stron><br>Bienvenido(a) a la red TRON.<br>Para finalizar tu registro como cliente debes pagar ahora o seguir comprando...",
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

var Paso_Final_Registro_Plan_3 = function( nombre_usuario){
    // AGREGO KIT DE INICIO AL PEDIDO
     $Parametros  = {"IdProducto" :10744, "CantidadComprada": 1, "es_tron": false , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Kit de Inicio',$Parametros);

     $Parametros  = {"IdProducto" :2071, "CantidadComprada": 1, "es_tron": false , "es_tron_acc": false };
     Agregar_Producto_a_Carrito('Derechos de Inscripción',$Parametros);


     new Messi("<stron><h4>" + nombre_usuario + "</h4></stron><br>Bienvenido(a) a la red TRON.<br>Para finalizar tu registro como empresario debes pagar ahora o seguir comprando...",
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
             $Texto               = resultado.Respuesta;
             $idtipo_plan_compras =  resultado.idtipo_plan_compras;
             $nombre_usuario      = resultado.nombre_usuario;

             if ( $idtipo_plan_compras == 1){  Paso_Final_Registro_Plan_1 ($Texto )         ; }
             if ( $idtipo_plan_compras == 2){  Paso_Final_Registro_Plan_2 ($nombre_usuario) ; }
             if ( $idtipo_plan_compras == 3){  Paso_Final_Registro_Plan_3 ($nombre_usuario) ; }

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


