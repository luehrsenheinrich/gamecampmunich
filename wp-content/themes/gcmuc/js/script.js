/* Author: Hendrik Luhersen

*/

$(document).ready(function($){

	console.log("ready");

	$("a[href*='.jpg']").each(function(){
		$(this).addClass("fancybox");
	});
	$("a[href*='.png']").addClass("fancybox");
	$("a[href*='.gif']").addClass("fancybox");
	
	// Fancybox
	$(".fancybox").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
	});
	
});



function trigger_attendence(url, start, end){
	
	FB.getLoginStatus(function(response){
		if (response.status === 'connected') {
			
			console.log(response);

			FB.api('/me/gamecampmuc:attend', 'post', 
				{ 
					session : url,
					end_time: end,
				},
				function(response){
					if (!response || response.error) {
						console.log(response);
					} 
					else {
						jQuery("#attend_action").css("opacity", 0.5);
						return null;
					}	
				}
			);
		} else {
			 FB.login(function(response) {
				 if (response.authResponse) {
					facebook.trigger_attendence();
				 } 
			 }, {"scope": "publish_actions"});
		}
	});
	

	
}