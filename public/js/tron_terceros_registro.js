
//  Formulario de Registro PASO 1.

    var $numero_nit      = $('#identificacion');
    var $digito_dv       = $('#digitoverificacion');
    var $confirmar_nit   = $('#identificacion_confirm');
    var $confi_digito_dv = $('#digitoverificacion_confirm');
    var $razon_social    = $('#razonsocial');
    var $documento       = $('#identificacion_nat');
    var $nombre          = $('#pnombre');
    var $confi_documento = $('#identificacion_nat_confirm');
    var $apellido        = $('#papellido');
    var $dirrecion       = $('#direccion');
    var $barrio          = $('#barrio');
    var $e_mail          = $('#email');
    var $celular         = $('#celular1');
    var $confi_e_mail    = $('#email_confirm');
    var $Formulario_Paso_1_Validado = true;

// Tooltips => Paso 2
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
  $(document).ready(function(){
     simple_tooltip("a.nuvv","tooltip");
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
          data:  {'identificacion':$identificacion },
          dataType: 'json',
          url:      '/tron/terceros/Buscar_Por_Identificacion/',
          type:     'post',
     success:  function (respuesta)
       {

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
  if ($identificacion != $confirmacion  )
  {
    //Mensaje_Sistema('Los números de documento deben ser iguales !.')
    new Messi('Los números de identificación deben ser iguales.',
        {title: 'Mensaje del Sistema',modal: true, titleClass: 'anim warning', buttons: [{id: 0, label: 'Cerrar', val: 'X'}]});
    $Formulario_Paso_1_Validado = false;
    $('#identificacion_nat').val('');
    $('#identificacion_nat_confirm').val('');
  }
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
})


// *** Pasar al siguente paso ***
$('.li_pasos_registro:first').css('background','#003E90');

//  Passo 1 => Continuar => paso 2
  $('#btn_continura').on('click',function(){

     $('#rgts_paso_1').slideUp('200');
     $('#rgts_paso_2').slideDown('200');
     $('.li_pasos_registro').css('background','#85ABDD');
     $('#li_paso_2').css('background','#003E90');
     $('.barra_right').css('height','437px');

  });


// Passo 2 => anterior => paso 1

  $('#btn_paso_2_anterior').on('click',function(){

      $('#rgts_paso_2').slideUp('200');
      $('#rgts_paso_1').slideDown('200');
      $('.li_pasos_registro').css('background','#85ABDD');
      $('#li_paso_1').css('background','#003E90');
      $('.barra_right').css('height','618px');

  });





 437








