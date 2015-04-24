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




$numero_nit.on('focus',function(){
  if ( $numero_nit.val() == 'Registre el nombre') {
     $numero_nit.css('background','white') ;
     $numero_nit.css('color','black') ;
     $numero_nit.val('');
  }
});





//  Passo 1 => Continuar => paso 2
  $('#btn_continura').on('click',function(){


   if ($numero_nit.val()=='' ) {
        $numero_nit.css('background','#FF3333') ;
        $numero_nit.css('color','white') ;
        $numero_nit.val('Registre el nombre');
        $campos_validados= false;

        $('#rgts_paso_1').fadeIn();
        $('#rgts_paso_2').fadeOut();
   }else{

        $('#rgts_paso_1').fadeOut();
        $('#rgts_paso_2').fadeIn();
    }

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














