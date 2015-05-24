
//  Formulario de Registro PASO 1.

    var Establecer_Tipo_Plan = function(Parametros){
        $.ajax({
              data:  Parametros,
              dataType: 'json',
              url:      '/tron/terceros/Registro_Establecer_Tipo_Plan_Seleccionado/',
              type:     'post',
         success:  function (respuesta)
           {
              $Tipo_Plan_Seleccionado = respuesta.idtipo_plan_compras
           }
           });
    }

    var Re_Establecer_Tipo_Plan = function(){
        $.ajax({
            data: {} ,
            dataType: 'json',
            url:      '/tron/terceros/Registro_Re_Establecer_Tercero_Presenta/',
            type:     'post',
            success:  function (respuesta) { }
         });

    }

  var Buscar_Codigo_Usuario = function(codigousuario){
           $.ajax({
              data:  {'codigousuario':codigousuario},
              dataType: 'json',
              url:      '/tron/terceros/Registro_Buscar_Por_Codigo/',
              type:     'post',
         success:  function (respuesta)
           {
              $Respuesta = respuesta.Respuesta;
              if ($Respuesta == 'CODIGO_NO_EXISTE'){
                new Messi('Código de usuario no registrado en nuestra base de datos.<br>Por favor corrija los datos e inténtelo nuevamente.',
                         {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error', buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
                    Re_Establecer_Tipo_Plan();
              }else{
                    new Messi('Confirma que desea vincularse a la red del siguiente usuario :<br> <br><strong>' + respuesta.nombre_usuario + '</strong><br>        Código de Usuario : <strong>' + respuesta.codigousuario + '</strong><br>',
                    {title: 'Mensaje del sistema.',titleClass: 'info',modal: true,
                    buttons: [
                              {id: 0, label: 'La información de Usuario es Correcta', val: 'Y',class: 'btn-success'},
                              {id: 1, label: 'Opps !!!, Espere !!! deseo corregir', val: 'N', class: 'btn-danger'}
                              ],
                    callback: function(val) {
                      if (val=='N')
                      {
                        $('#input_codigo').val('');
                        Re_Establecer_Tipo_Plan();
                      }
                    }});
              }
           }
           });
  }

// Tooltips => Paso 1
  function simple_tooltip(target_items, name){
    $(target_items).each(function(i){
      $("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
      var my_tooltip = $("#"+name+i);

      $(this).removeAttr("title").mouseover(function(){
          my_tooltip.css({opacity:0.9, display:"none"}).fadeIn(400);
      }).mousemove(function(kmouse){
          my_tooltip.css({left:kmouse.pageX-160, top:kmouse.pageY+20});
      }).mouseout(function(){
          my_tooltip.fadeOut(400);
      });
    });
  }


simple_tooltip("a.nuvv","tooltip");


// Fucntion = Tooltip del input-codigo
$(function(){
     $('#input_codigo').mouseover(function(){
          $('#ventana_modal_mensaje_codigo').fadeIn();
     });
     $('#input_codigo').mouseout(function(){
          $('#ventana_modal_mensaje_codigo').fadeOut();
     });
});



//TIPO IDENTIFICACION
$('#idtpidentificacion').on('change',function(){
  $tipo_documento = $(this).val();
  if ( $tipo_documento == 13 || $tipo_documento == 42 || $tipo_documento == 0)
    {
      $('.campos-nit').fadeOut();
      $('.campos-cedu-ciudadana').fadeIn();
    }
    if ( $tipo_documento == 31)
    {
      $('.campos-nit').fadeIn();
      $('.campos-cedu-ciudadana').fadeOut();
    }
});



/// IDENTIFICACION
$('#identificacion_nat').on('blur',function(){
    var $identificacion = $('#identificacion_nat').val();
    $.ajax({
          data:  {'identificacion':$identificacion},
          dataType: 'json',
          url:      '/tron/terceros/Buscar_Por_Identificacion/',
          type:     'post',
     success:  function (respuesta)
       {
          if (respuesta.Respuesta == 'SI_EXISTE'){
                  new Messi('La identificación digitada ya se encuentra registrada en nuestra base de datos.',
                    {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                      buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
                  $('#identificacion_nat').val('');
            $Formulario_Validado = false;
          }
       }
       });
});

$('#identificacion_nat').on('focusout',function(){
  $(this).get(0).type='password';
});

$('#identificacion_nat').on('focus',function(){
  $(this).get(0).type='text';
});

$('#identificacion_nat_confirm').on('focus',function(){
  $(this).get(0).type='text';
});


/// VALIDAR QUE LAS IDENTIFICACION SEAN IGUALES
$('#identificacion_nat_confirm').on('focusout',function(){
  $(this).get(0).type ='password';
  $identificacion     = $('#identificacion_nat').val();
  $confirmacion       = $('#identificacion_nat_confirm').val();
  if ($identificacion != $confirmacion && ($identificacion.length>0 && $confirmacion.length>0 ) )
  {
    new Messi('Los números de identificación deben ser iguales.',
        {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
    $Formulario_Validado = false;
    $('#identificacion_nat').val('');
    $('#identificacion_nat_confirm').val('');
  }
});


$('#input_codigo').on('blur',function(){
    $input_codigo = $('#input_codigo');
    $codigousuario = $.trim($input_codigo.val().toUpperCase()) ;
    $input_codigo.val($codigousuario);
    if ($codigousuario.length == 0){
        new Messi('Ha dejado en blanco el código del amigo que lo presenta. <br> Está seguro(a) que nadie lo presenta a la Red de Usuarios TRON ? <br>',
            {title: 'Mensaje del sistema.',titleClass: 'info',modal: true,
            buttons: [
                      {id: 0, label: 'Es correcto, nadie me presenta', val: 'Y',class: 'btn-success'},
                      {id: 1, label: 'Opps !!!, Espere !!! deseo corregir', val: 'N', class: 'btn-danger'}
                      ],
            callback: function(val) {
              if (val=='N')
              {
                Re_Establecer_Tipo_Plan();
              }
            }});
    }else{
      Buscar_Codigo_Usuario($codigousuario);
    }
});

// TABS = Registro ( paso 1 , paso 2).
$('.rgts_pasos').hide();
$('.rgts_pasos:first').show();
$('.li_pasos_registro:first').css('background','#003E90');


/// VALIDACIONES EMAIL
$('#email').on('focusout',function(){
  $(this).get(0).type='password';
});

$('#email').on('focus',function(){
  $(this).get(0).type='text';
});

$('#email_confirm').on('focus',function(){
  $(this).get(0).type='text';
});
$('#email_confirm').on('focusout',function(){
   $(this).get(0).type ='password';
   $email              = $('#email').val();
   $email_confirm      = $('#email_confirm').val();
   if ($email.length >0 &&  $email_confirm.length >0 )
   {
      if ($email != $email_confirm  )
      {
          new Messi('Los correos electrónicos deben ser iguales.',
              {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim error',
                buttons: [{id: 0, label: 'Cerrar', val: 'X', class: 'btn-danger'}]});
          $Formulario_Validado = false;
          $('#email').val('');
          $('#email_confirm').val('');
      }
   }
});

//BOTON FINALIZAR
$('#btn_finalizar').on('click',function(){
    var $input_codigo       = $('#input_codigo');
    var $idtpidentificacion = $('#idtpidentificacion');
    var $identificacion     = $('#identificacion');
    var $digitoverificacion = $('#digitoverificacion');
    var $razonsocial        = $('#razonsocial');
    var $identificacion_nat = $('#identificacion_nat');
    var $pnombre            = $('#pnombre');
    var $papellido          = $('#papellido');
    var $mes                = $('#mes');
    var $dia                = $('#dia');
    var $genero             = $('#genero');
    var $idmcipio           = $('#idmcipio');
    var $dirrecion          = $('#direccion');
    var $barrio             = $('#barrio');
    var $e_mail             = $('#email');
    var $celular1           = $('#celular1');
    // TRABAJO CON DATOS DE PERSONAS NATURALES
    if ( $idtpidentificacion.val()== 13 || $idtpidentificacion.val() == 42 )
    {

    }


});





//
/*
$('#li_paso_2').on('click',function(){

     $('#rgts_paso_1').slideUp('200');
     $('#rgts_paso_2').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $(this).css('background','#003E90');
     $('.barra_right').css('height','437px');
     $('#input_codigo').focus();
});

$('#li_paso_1').on('click',function(){
     $('#rgts_paso_2').slideUp('200');
     $('#rgts_paso_1').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $(this).css('background','#003E90');
     $('.barra_right').css('height','580px');
     alert("paso1");
});

*/
// *** Pasar al siguente paso por = button***

//  #btn_plan1 = Compreador Ocasional
//  #btn_plan2 = Cliente Tron
//  #btn_plan3 = Empresario Tron
//

  $('#btn_plan1').on('click',function(){
     $IdBoton = $(this).attr('idplan');
     $('#rgts_paso_1').slideUp('200');
     $('#rgts_paso_2').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $('#li_paso_2').css('background','#003E90');
     $('.barra_right').css('height','437px');
     $Parametros = {'idtipo_plan_compras':$IdBoton};
     Establecer_Tipo_Plan($Parametros)
     $('#mes_dia').hide();
     $('#input_codigo').focus();

  });

  $('#btn_plan2').on('click',function(){
     $IdBoton = $(this).attr('idplan');
     $('#rgts_paso_1').slideUp('200');
     $('#rgts_paso_2').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $('#li_paso_2').css('background','#003E90');
     $('.barra_right').css('height','437px');
     $Parametros = {'idtipo_plan_compras':$IdBoton};
     Establecer_Tipo_Plan($Parametros)
     $('#mes_dia').hide();
     $('#input_codigo').focus();

  });

    $('#btn_plan3').on('click',function(){
     $IdBoton = $(this).attr('idplan');
     $('#rgts_paso_1').slideUp('200');
     $('#rgts_paso_2').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $('#li_paso_2').css('background','#003E90');
     $('.barra_right').css('height','437px');
     $Parametros = {'idtipo_plan_compras':$IdBoton};
     Establecer_Tipo_Plan($Parametros)
     $('#mes_dia').show();
     $('#input_codigo').focus();


  });
// Passo 2 => anterior => paso 1

  $('#btn_paso_2_anterior').on('click',function(){
      $('#rgts_paso_2').slideUp('200');
      $('#rgts_paso_1').slideDown('200');
      $('.li_pasos_registro').css('background','#85ABDD');
      $('#li_paso_1').css('background','#003E90');
      $('.barra_right').css('height','580px');

  });



// CARGAR LAS CIUDADES POR DEPARTAMENTO
$('#iddpto').on('change',function(){
  var $IdDpto     = $(this).val();
  var $Municipios = $('#idmcipio');
  if ($IdDpto==0)
  {
    $Municipios.empty();
    $Municipios.append("<option>Seleccione un departamento</option>");
   }else
   {
    $.ajax({
          data:  {'iddpto':$IdDpto},
          dataType: 'json',
          url:      '/tron/municipios/Consultar/',
          type:     'post',
     success:  function (municipios)
       {
        $Municipios.empty();
          for(var i = 0; i < municipios.length; i++)
          {
              $Municipios.append('<option value="' + municipios[i].idmcipio + '">' + municipios[i].nommcipio + '</option>');
         }
       }
          });
   }
});










