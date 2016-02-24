// @depend "plugins.js"

WebFontConfig = {
	google: { families: [ 'Open+Sans:400,700,400italic,600,600italic,700italic:latin' ] }
};

(function() {
	var wf = document.createElement('script');
	wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	wf.type = 'text/javascript';
	wf.async = 'true';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);
})();

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