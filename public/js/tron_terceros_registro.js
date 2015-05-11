
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

})

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



$numero_nit.on('focus',function(){
  if ( $numero_nit.val() == 'Registre el nombre') {
     $numero_nit.css('background','white') ;
     $numero_nit.css('color','black') ;
     $numero_nit.val('');
  }
});



// *** Pasar al siguente paso ***

//  Passo 1 => Continuar => paso 2
  $('#btn_continura').on('click',function(){

     $('#rgts_paso_1').slideUp();
     $('#rgts_paso_2').slideDown();

  });

// Passo 2 => Continuar => paso 3

  $('#btn_paso_2_continuar').on('click',function(){

      $('#rgts_paso_2').slideUp();
      $('#rgts_paso_3').slideDown();

  });

// Passo 2 => anterior => paso 1

  $('#btn_paso_2_anterior').on('click',function(){

      $('#rgts_paso_2').slideUp();
      $('#rgts_paso_1').slideDown();

  });

// Passo 3 => anterior => paso 2

  $('#btn_paso_3_anterior').on('click',function(){

      $('#rgts_paso_3').slideUp();
      $('#rgts_paso_2').slideDown();

  });














