      var characters     = 0;
      var capitalletters = 0;
      var loweletters    = 0;
      var number         = 0;
      var special        = 0;

      var upperCase    = new RegExp('[A-Z]');
      var lowerCase    = new RegExp('[a-z]');
      var numbers      = new RegExp('[0-9]');
      var specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~])');


						var $contrasena = $('#password');
						var $pogreso    = $('#progresador');
						var $definicion = $('#definicion_contrasena');

     function Porcentaje(a, b) {
             return ((b / a) * 100);
         }


     function Mensaje_Password(total){
     		  var $mensaje = '';

         if(total == 0){
               $mensaje = '';
               $ancho   = 0;
         }else if (total <= 1) {
                $mensaje = 'Contraseña Muy Insegura !!!';
         } else if (total == 2){
                 $mensaje = 'Contraseña Insegura';
         } else if(total == 3){
         			$mensaje = 'Contraseña Segura.';
         } else {
                $mensaje = 'Contraseña Muy Segura !!!';
         }
         return $mensaje;
     }


        function Verificar_Password(thisval){
            if (thisval.length > 5) 				{ characters     = 1; }  else { characters      = 0; };
            if (thisval.match(upperCase)) 	{ capitalletters = 1; }  else { capitalletters  = 0; };
            if (thisval.match(lowerCase)) 	{ loweletters    = 1; }  else { loweletters     = 0; };
            if (thisval.match(numbers)) 		{ number         = 1; }  else { number          = 0; };

            var longitud   = characters + capitalletters + loweletters + number + special;
            var porcentaje = Porcentaje(4, longitud).toFixed(0);
            var $mensaje   = Mensaje_Password(longitud);

						$Datos         = {'porcentaje':porcentaje, 'mensaje':$mensaje};

            return $Datos;

        }


$('#password').on('keyup',function(){
    var $porcentaje = 0;
    $Resutlado      = Verificar_Password($(this).val());
    $porcentaje     = $Resutlado.porcentaje;
    if ( $porcentaje == 0 ){
        $('.Info-contrasena').hide();
        return ;
    }
    $('.Info-contrasena').show();
    $('#definicion_contrasena').html($Resutlado.mensaje);


    if ($porcentaje  == 25 ){
        $($pogreso).animate({ 'width': '25%'});
        $($pogreso).css({'background':'red'});
      }
    if ($porcentaje  == 50 ){
        $($pogreso).animate({ 'width': '50%'});
        $($pogreso).css({'background':'yellow'});
      }
    if ($porcentaje  == 75 ){
        $($pogreso).animate({ 'width': '75%'});
        $($pogreso).css({'background':'blue'});
      }

    if ($porcentaje  == 100 ){
        $($pogreso).animate({ 'width': '100%'});
        $($pogreso).css({'background':'#9ff430'});
      }



});


$('#password').on('mouseover',function(){
  $('#ventana_modal_mensaje_codigo').fadeIn();
});

$('#password').on('mouseout',function(){
  $('#ventana_modal_mensaje_codigo').fadeIn();
});



