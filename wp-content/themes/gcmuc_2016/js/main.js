// @depend "plugins.js"

jQuery(document).ready(function($) {
	$(".nav-trigger").click(function(){
		$("body").toggleClass("nav_open");
	});

	$(window).scroll(function(){
		clearTimeout(this.scrollDelayer);

		this.scrollDelayer = setTimeout( function(){
			console.log($('nav').offset().top);
		}, 50);
	});
})