// @depend "plugins.js"
// @depend "../bower_components/magnific-popup/dist/jquery.magnific-popup.min.js";
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

	// Initialization of Magnific Popup
	$("a[href*='.png']").addClass("image-link");
	$("a[href*='.gif']").addClass("image-link");
	$("a[href*='.jpg']").addClass("image-link");
	$("a[href*='.jpeg']").addClass("image-link");


	$('.image-link').magnificPopup({
		type:'image',
		image: {
			titleSrc: function(item){
				return $(item.el).parents(".gallery-item").find(".gallery-caption").text();
			}
		},
		gallery: {
			enabled: true, // set to true to enable gallery

			preload: [0,2], // read about this option in next Lazy-loading section

			navigateByImgClick: true,

			arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

			tPrev: lh.prev, // title for left button
			tNext: lh.next, // title for right button
			tCounter: lh.counter // markup of counter
		}
	});
})