// JavaScript Document

// JavaScript Document

$(document).ready(function() {
	
	var alto = $(window).height();
	var ancho = $(window).width();
	
	$(window).resize(function() {
		var alto = $(window).height();
		var ancho = $(window).width();
		
		setTimeout('calcularAlturas()', 100);	

	});
	
	setTimeout('calcularAlturas()', 100);	
});

function calcularAlturas(){
	var alto = $(window).height();
	var ancho = $(window).width();
		
	
	var hein1 = $(".hein1").height();
	var hein2 = $(".hein2").height();
	$(".contenido-index, .contenido-industrial").css('padding-top', (hein1+hein2));
	
			
	var mukSlide1 = $(".mukSlide1").height();
	if(ancho > 750){
		$(".mukSlideIn").css('height', (mukSlide1/4-3));
		$(".mukSlideIn img").css('max-height', (mukSlide1/4-3));
	}
	
}
