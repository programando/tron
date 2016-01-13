// JavaScript Document

// JavaScript Document

$(document).ready(function() {
	
	var alto = $(window).height();
	var ancho = $(window).width();
	
	$("#pedido-amigo").click(function(){
		$(".contFormPedAmig").slideDown(400);
	});
	
	$(".ingSeInf").click(function(){
		$(".contFormPedAmig").slideUp(400);
	});
	
		
	$('a.perfil_menu_link').on('click',function(){
		$("#columna_izquierdad").hide(400);
		$("#menuAppr").show(400);
		$("#columan_derecha").delay(600).removeClass("col-sm-10");
		$("#columan_derecha").delay(600).addClass("col-sm-12");
	});		
	$('#menuAppr').on('click',function(){
		$("#columan_derecha").removeClass("col-sm-12");
		$("#columan_derecha").addClass("col-sm-10");
		$("#columna_izquierdad").delay(600).show(400);
		$("#menuAppr").hide(400);
	});
	
	
	
	
	$(window).resize(function() {
		var alto = $(window).height();
		var ancho = $(window).width();
		
		var blockques = $(".blockques-opciones").width();
		if(ancho > 750){
			$( ".blockques-opciones" ).hover(function() {
				$(this).children("div").children(".blockques-opciones p").css('height', blockques+20);
			}, function() {
				$(this).children("div").children(".blockques-opciones p").css('height', 'auto');
			});
		}
		
		setTimeout('calcularAlturas()', 100);	
		
	});
	
	setTimeout('calcularAlturas()', 100);
	
	if(ancho<768) $('.oneX, .oneX2').trigger('click');
});


function calcularAlturas(){
	var alto = $(window).height();
	var ancho = $(window).width();
		
	
	//var hein1 = $(".hein1").height();
	//var hein2 = $(".hein2").height();
	//$(".contenido-index, .contenido-industrial").css('padding-top', (hein1+hein2));
	
			
	var mukSlide1 = $(".mukSlide1").height();
	if(ancho > 750){
		$(".mukSlideIn").css('height', (mukSlide1/4-3));
		$(".mukSlideIn img").css('max-height', (mukSlide1/4-3));
	}
	
	var columna_izquierdad = $("#columna_izquierdad").height();
	if(ancho > 750){
		$(".rgts_pasos").css('min-height', columna_izquierdad);
		
		$('a.perfil_menu_link').on('click',function(){
			$("#columna_izquierdad").hide(400);
			$("#menuAppr").show(400);
			$("#columan_derecha").delay(600).removeClass("col-sm-10");
			$("#columan_derecha").delay(600).addClass("col-sm-12");
		});		
		$('#menuAppr').on('click',function(){
			$("#columan_derecha").removeClass("col-sm-12");
			$("#columan_derecha").addClass("col-sm-10");
			$("#columna_izquierdad").delay(600).show(400);
			$("#menuAppr").hide(400);
		});
		
		
	}
	
	
	
	var blockques = $(".blockques-opciones").width();
	if(ancho > 750){
		$(".blockques-opciones").css('height', (blockques));

		$( ".blockques-opciones" ).hover(function() {
			
			$(this).children("div").children(".tion").stop().animate({'height': blockques},100).css('color', "#fff");
			
			
		}, function() {
			//$(this).children("div").children(".tion").stop().css('height', 'auto');
			//$(this).children("div").children(".tion").stop().css('color', '#003e90');
			$(this).children("div").children(".tion").stop().animate({'height': '30'},200).css('color', "#003e90");
		});
	}
	
	
}
