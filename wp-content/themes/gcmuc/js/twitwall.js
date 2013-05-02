/* Twitter Wall Script, handcraftet and arschgeklöppelt for the Gamecamp Munich */

var twitter_json_search = "http://search.twitter.com/search.json";
var search_term = "#gcmuc";
var refresh_url = null;
var n = 1;
var displayed_tweets = [];

function init(){
	
	var uhr_code = '<div id="uhr"></div>';
	jQuery(".headwrapper").append(uhr_code);
	
	var faces_left = '<div class="faces_left"></div>';
	jQuery("#main").prepend(faces_left);
	
	var faces_right = '<div class="faces_right"></div>';
	jQuery("#main").prepend(faces_right);
	
	var jqXHR = jQuery.getJSON(twitter_json_search+"?callback=?", {q: search_term}, function(data, textStatus, xhr){
		if(textStatus == "success"){
			data.results.reverse();
			refresh_url = data.refresh_url;
			jQuery(data.results).each(function(index, element) {
                post_to_wall(element, index);
            });
			
			setInterval(function(){ get_more_tweets() }, 5000);
		}
	});
}

function post_to_wall(element, index){
		
	console.log(displayed_tweets);
				
	if(jQuery.inArray(element.id, displayed_tweets) > 0){
		return null;	
	}

	displayed_tweets.push(element.id);
		
	var tweet_date = new Date(element.created_at);
	var tweet_date_print = pad(tweet_date.getDate(),2)+"."+pad((tweet_date.getMonth()+1),2)+"."+tweet_date.getFullYear()+" - "+pad(tweet_date.getHours(), 2)+":"+pad(tweet_date.getMinutes(), 2);
	
	if((n%2 == 0) ? true : false){
		var html = 	'<div class="tweet alt">';
	} else {
		var html = 	'<div class="tweet">';
	}
	
	n++;
	
		html +=	'<div class="author">'+element.from_user_name+'<span class="twitter_nick">@'+element.from_user+'</span><span class="date">'+tweet_date_print+' Uhr</span></div>';
		html += '<div class="message">'+element.text+'</div>';
		html += '<div class="avatar"><img src="'+element.profile_image_url+'" /></div>';
		html += '</div>';
		
	jQuery(html).hide().prependTo("#twitter_wall").slideDown(1000);
	
	var faces = '<img src="'+element.profile_image_url+'" />';
	
	jQuery(".faces_left").prepend(faces);
	jQuery(".faces_right").prepend(faces);
		
}

function get_more_tweets(){

	if(refresh_url != null){
		var jqXHR = jQuery.getJSON(twitter_json_search+refresh_url+"&callback=?", null, function(data, textStatus, xhr){

			if(textStatus == "success" && refresh_url != data.refresh_url){
				data.results.reverse();
				refresh_url = data.refresh_url;
				jQuery(data.results).each(function(index, element) {
					post_to_wall(element, index);
				});
			}
		});
	}
}

function get_sessions(){
	var jqXHR = jQuery.getJSON("http://www.gamecampmunich.de/index.php", {session_overview: "json", session_event: "2012"}, function(data, textStatus, xhr){

		var running_html = null;
		var upcoming_html = null;
		
		if(data == null){
			jQuery(".sp_right").hide();	
			return null;
		} else {
			jQuery(".sp_right").show();		
		}

		if(data.running.length > 0){
			running_html = '<h2> Laufende Sessions </h2>';
			jQuery(data.running).each(function(index,element){
				running_html +=		'<div class="session">';
					running_html +=		'<div class="title">'+element.post_title+'</div>';
					running_html +=		'<div class="meta clearfix"><div class="room">Raum '+element.room.name+'</div><div class="start">seit '+element.session_start_clean+'Uhr </div></div>';
				running_html +=		'</div>';
			});
			
		}
		jQuery("#running_sessions").html(running_html);
			
		
		if(data.upcoming.length > 0){
			upcoming_html = '<h2> Kommende Sessions </h2>';
			jQuery(data.upcoming).each(function(index,element){
				upcoming_html +=		'<div class="session">';
					upcoming_html +=		'<div class="title">'+element.post_title+'</div>';
					upcoming_html +=		'<div class="meta clearfix"><div class="room">Raum '+element.room.name+'</div><div class="start">ab '+element.session_start_clean+' Uhr</div></div>';
				upcoming_html +=		'</div>';
			});
			
		}
		jQuery("#upcoming_sessions").html(upcoming_html);
		
	});
}

function UR_Start() 
{
	UR_Nu = new Date;
	UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
	document.getElementById("uhr").innerHTML = UR_Indhold;
	setTimeout("UR_Start()",1000);
}
function showFilled(Value) 
{
	return (Value > 9) ? "" + Value : "0" + Value;
}

function pad(number, length) {
   
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
   
    return str;

}

jQuery(document).ready(function(e) {
    init();
	UR_Start();
	get_sessions();
	setInterval(function(){ get_sessions() }, 30*1000);
});