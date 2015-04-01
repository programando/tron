
$(document).ready(function(){

    $(window).scroll(function(){

       if($(this).scrollTop() > 0){

       $('.carrito-resumen-pedido').animate({

                'margin-top':'200px'
       },500);

      } else {

      	  $('.carrito-resumen-pedido').animate({

              'margin-top':'0px'
      },100);

      }

    });

});





