
$(document).ready(function(){

    $(window).scroll(function(){

       if($(this).scrollTop() > 0){

       $('.carrito-resumen-pedido').css('margin-top','150px');

      } else {

      	  $('.carrito-resumen-pedido').css('margin-top','0px');

      }

    });

});





