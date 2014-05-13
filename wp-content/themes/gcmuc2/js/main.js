$(document).ready(function(){

	$(".open-contact-popup").magnificPopup({});

	/**
	 * Lightbox
	 */
	$("a[href*='.jpg']").addClass("lightbox");
	$("a[href*='.png']").addClass("lightbox");
	$("a[href*='.gif']").addClass("lightbox");
	$(".lightbox").magnificPopup({
		type: "image",
	});

	$("h1.brand-headline, h2.brand-headline").each(function(){
		var $h = $(this);
		$h.html('<span class="brand-headline">' + $h.html() + '</span>').removeClass("brand-headline").addClass("brand-headline-wrapper");
	});

	/**
	 * Mobile Nav
	 */

	$(".head_logo").click(function(){
		$("body").toggleClass("mobile_nav_open");
	});

	$(".phone-menu-lightbox").click(function(){
		$("body").removeClass("mobile_nav_open");
	});
	
	$(".nl-trigger").click(function(){
		$("#nl_collapse").toggleClass("height_transition");
	});
});
