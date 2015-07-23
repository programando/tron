
$(document).ready(function(){

    $(window).scroll(function(){

       if($(this).scrollTop() > 0){
    	 $('.carrito-resumen-pedido').css('margin-top','0px');

    	      } else {
    	      	 $('.carrito-resumen-pedido').css('margin-top','0px');
    	      }

    	  if($(this).scrollTop() > 1500){
            $('.carrito-resumen-pedido').addClass('carrito-resumen-pedido-active');

    	     }else{
            $('.carrito-resumen-pedido').removeClass('carrito-resumen-pedido-active');
    	     }

    });

});



