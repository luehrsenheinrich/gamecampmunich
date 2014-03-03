$(document).ready(function(){

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
	 * Sidebar Trigger
	 */

	$(".sidebar-trigger").click(function(){
		$(".sidebar").toggleClass("sidebar-open");
	});
	
	/**
	 * Mobile Nav
	 */

	$(".menu_trigger").click(function(){
		$("body").toggleClass("mobile_nav_open");
	});
	
	$(".sidebar-trigger-button").click(function(){
		$("body").toggleClass("sidebar_open");
	});
	

	$(".phone-menu-lightbox").click(function(){
		$("body").removeClass("mobile_nav_open");
	});
	
	$(".sidebar-lightbox").click(function(){
		$("body").removeClass("sidebar_open");
	});
	
	$(".nl-trigger").click(function(){
		$("#nl_collapse").toggleClass("height_transition");
	});
	
});