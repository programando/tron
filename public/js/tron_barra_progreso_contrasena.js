 $(document).ready(function(){

						var $contrasena = $('#password');
						var $pogreso    = $('#progresador');
						var $definicion = $('#definicion_contrasena');

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
 });
