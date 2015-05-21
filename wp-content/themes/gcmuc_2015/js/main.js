// @depend "plugins.js"
// @depend "../bower_components/bootstrap/js/transition.js"
// @depend "../bower_components/bootstrap/js/collapse.js"
// @depend "../bower_components/magnific-popup/dist/jquery.magnific-popup.js"


$(document).ready(function(){

	/**
	 * Lightbox
	 */
	$("a[href*='.jpg']").addClass("lightbox");
	$("a[href*='.jpeg']").addClass("lightbox");
	$("a[href*='.png']").addClass("lightbox");
	$("a[href*='.gif']").addClass("lightbox");
	$(".lightbox").magnificPopup({
		type: "image",
		image: {
			titleSrc: function(item){

				var text = null;
				if($("p.wp-caption-text", $(item.el).parent()).text()){
					return $("p.wp-caption-text", $(item.el).parent()).text();
				} else if( $("div.wp-caption-text", $(item.el).parents(".gallery-item")).text() ){
					return $("div.wp-caption-text", $(item.el).parents(".gallery-item")).text();
				} else if( $("h3.media-title", $(item.el).parents("article")).text() ){
					return $("h3.media-title", $(item.el).parents("article")).text();
				}
				return text;
			},
		},
		gallery: {
			enabled: true,
			tPrev: lh_var.tPrev, // title for left button
			tNext: lh_var.tNext, // title for right button
			tCounter: lh_var.tCounter // markup of counter
		}
	});
});