<? 
/*
	Template Name: Twitter-Wall
*/

wp_enqueue_script("twitwall", WP_THEME_URL."/js/twitwall.js", array("jquery"), time());

get_header(); ?>

<div id="content" class="clearfix twitter">

	<div id="sponsoren">
    	<img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/travian.jpg">
        <img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/microsoft.jpg">
        <img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/google.jpg" />
    	<img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/mdh.jpg" style="width: 120px; height: auto">
        <img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/bneun.jpg" >
        <img src="http://gcmuc.luehrsen-heinrich.de/wp-content/themes/gcmuc/img/sponsoren/cipsoft.jpg" />
    </div>

	<div id="twitter_wall">
    </div> 
    
	<div id="sponsoren" class="sp_right">
		<div id="upcoming_sessions">
        </div>
        
        <div id="running_sessions">
        </div>
    </div> 

</div><!-- content -->
 
<? get_footer(); ?>