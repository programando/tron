// JavaScript Document

// JavaScript Document

$(document).ready(function() {

	//$(".table").tablesorter();


	$(".ionix").on('click','th', function(){
			$(".table").tablesorter();
			$(this).click();
	})




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

		setTimeout('calcularAlturas()', 100);
		setTimeout('calcularAlturas()', 2000);

	});

	setTimeout('calcularAlturas()', 100);
	setTimeout('calcularAlturas()', 2000);

	if(ancho<768) $('.oneX, .oneX2').trigger('click');
});


function calcularAlturas(){
	var alto = $(window).height();
	var ancho = $(window).width();

	$(".closeSesssion").css('height',alto);
	$(".closeSesssion").css('width',ancho);

	var iififi = $(".artOpt").width();
	$(".counttis").css('width', iififi+56);
	
	
	var altoAllion		= $(".allion").height();
	var altoAllionIn	= $(".allionIn").height();
	
	if(ancho < 768)	{
		$(".allion").height("auto");
		$(".nodoa").height("auto");
	} else {
		$(".allion").height(alto-100);
		$(".nodoa").height((alto-100)/10);
	}
	
	if(ancho < 768)	{
		$(".allionIn").height("auto");
	} else {
		$(".allionIn").height(alto-150);
	}

	

	var mukSlide1	= $(".mukSlide1").height();
	var lationT1	= $(".lationT1").height();
	var carresped	= $(".carrito-resumen-pedido").height();

	if(ancho > 750){
		$(".mukSlideIn").css('height', (mukSlide1/4-3));
		$(".mukSlideIn img").css('max-height', (mukSlide1/4-3));
		$(".lationT2").css('height', lationT1);
		
		$(".ionWin").css('height', carresped+60);
		
	}else{
		$(".lationT2").css('height', 'auto');
		$(".ionWin").css('height', carresped+60);
	}
	
	$('*').on('click',function(){
		var carresped	= $(".carrito-resumen-pedido").height();
		$(".ionWin").css('height', carresped+60);	
	});



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


	//if(ancho > 750){

		//$(window).scroll( function () {
			//var altuus = 200;
			//if(altuus < $(window).scrollTop()) 	var aaa = $(window).scrollTop() - altuus;
			//else								var aaa = 0;

			//$('.carrito-resumen-pedido').stop().animate({'top': aaa}, 100);
		//});

	//}
	
	if(ancho > 750){

		$(window).scroll( function () {
			var altuus = 300;
			if(altuus < $(window).scrollTop()) 	{ $('.ionIIid').addClass("slelel"); }
			else								{ $('.ionIIid').removeClass("slelel"); }
 
			
		});

	}
	
	

}
