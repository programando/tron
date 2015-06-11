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
               thism$mensaje = '';
         }else if (total <= 1) {
																			$mensaje = 'Muy Insegura !!!';
         } else if (total == 2){
         									$mensaje = 'Insegura';
         } else if(total == 3){
         			$mensaje = 'Segura.';
         } else {
													$mensaje = 'Muy Segura !!!';
         }
         return $mensaje;
     }


        function Verificar_Password(thisval){
            if (thisval.length > 5) 							{ characters 				= 1; }  else { characters      = 0; };
            if (thisval.match(upperCase)) 	{ capitalletters = 1; }  else { capitalletters  = 0; };
            if (thisval.match(lowerCase)) 	{ loweletters 			= 1; }  else { loweletters     = 0; };
            if (thisval.match(numbers)) 			{ number 								= 1; }  else { number          = 0; };

												var longitud   = characters + capitalletters + loweletters + number + special;
												var porcentaje = Porcentaje(4, longitud).toFixed(0);
												var mensaje    = Mensaje_Password(longitud);
												$Datos         = {'porcentaje':porcentaje, 'mensaje':mensaje };
            return $Datos;

        }


$('#password').on('keyup',function(){

		$Resutlado  = Verificar_Password($(this).val());
		$($definicion).text($Resutlado.mensaje);


});

/*
 	 $($contrasena).keyup(function(){

 	    	var $longitud = $contrasena.val().length;

 	    if ( $longitud >= 1 && $longitud <= 5){
 	    	 $($definicion).text('Muy Insegura');
  		    $($pogreso).css('background','#D6001C');
  		    $($pogreso).animate({ 'width':'25%' });
 	    	 }

    	if ( $longitud >5 && $longitud <= 10){
 	    	 $($definicion).text('Insegura');
    		  $($pogreso).css('background','#D3D000');
 	    		$($pogreso).animate({  'width':'50%'  });
 	    	}
 	     if ( $longitud >10 && $longitud <= 15){
 	    	 $($definicion).text('Segura');
  		    $($pogreso).css('background','#003E90');
 	    		$($pogreso).animate({  'width':'75%'  });
 	    	}
 	    	if ( $longitud >15 ){
 	    	 $($definicion).text('Muy Segura');
  		    $($pogreso).css('background','#008E04');
 	    		$($pogreso).animate({  'width':'100%'  });
 	    	}
 	    });
*/
