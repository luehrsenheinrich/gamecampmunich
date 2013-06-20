<? 
/*
	Template Name: Twitter-Wall
*/

wp_enqueue_script("twitwall", WP_THEME_URL."/js/twitwall.js", array("jquery"), time());

get_header(); ?>

<div id="content" class="clearfix twitter">

	<div id="sponsoren">
        
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/gamesbavaria.jpg" alt="Games/Bavaria">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/microsoft.jpg" alt="Microsoft">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/travian.jpg" alt="Travian Games">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/cipsoft.png" alt="Cipsoft">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/sae.png" alt="SAE Institute">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/mdh.png" alt="Mediadesign Hochschule">
<img src="http://www.gamecampmunich.de/wp-content/themes/gcmuc/img/sponsoren/ravensburger.jpg" alt="Ravensburger Digital">

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