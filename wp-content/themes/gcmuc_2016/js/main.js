// @depend "plugins.js"

jQuery(document).ready(function($) {
	$(".nav-trigger").click(function(){
		$("body").toggleClass("nav_open");
	});

	$(window).scroll(function(){
		clearTimeout(this.scrollDelayer);

		this.scrollDelayer = setTimeout( function(){
			//console.log($('.one-page-wrapper').offset().top, $(window).scrollTop());
			if( $(window).scrollTop() >= ( $('.one-page-wrapper').offset().top - 50) ) {
				$('.nav-btn-wrapper').addClass('fixed');
			} else {
				$('.nav-btn-wrapper').removeClass('fixed');
			}
		}, 5);
	});
})