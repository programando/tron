

$(document).ready(function(){

	$('.btn-ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.btn-ir-arriba').slideDown(300);
		} else {
			$('.btn-ir-arriba').slideUp(300);
		}
	});

});
