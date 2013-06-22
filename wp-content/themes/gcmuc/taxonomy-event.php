<?php
get_header(); 

global $post;

$event = get_queried_object();

if(!isset($_GET['sessionplan_date'])){
	$args = array(	
		'post_type' => 'session',
		'event' => $event->slug,
		'posts_per_page' => 1,
		'orderby'=>'meta_value_num',
		'meta_key' => '_session_start',
		'order'=>'ASC'
	);
	$first_post_array = get_posts($args);
	
	if(is_array($first_post_array)){
		$first_post = array_pop($first_post_array);
		$sessionplan_date = date_to_day(intval(get_post_meta($first_post->ID, "_session_start", true)));
	}
} else {
	$sessionplan_date = date_to_day(intval($_GET['sessionplan_date']));	
}




$sessions = lh_get_sessions($event->slug, date("Y", $sessionplan_date), date("m", $sessionplan_date), date("d", $sessionplan_date));
$rooms = lh_get_rooms($sessions);
$time_dimensions = get_time_dimensions($sessions);

global $lh_session_dates;

?>

<div id="content" class="sessionplan clearfix page">

	<h1> Sessions für <?=date_i18n("l, d.m.Y", $sessionplan_date)?></h1>
    <? if(is_array($lh_session_dates)): ?>
    <div class="event_dates">
    	<? foreach($lh_session_dates as $d): if($d != $sessionplan_date):?>
        	<a class="editor_buttons" href="<?=get_term_link($event->slug, "event")?>?sessionplan_date=<?=$d?>"><?=date_i18n("l, d.m.Y", $d)?></a>
        <? endif; endforeach; ?>
    </div>
   	<? endif; ?>

	<div class="rooms">
    	<? if(is_array($rooms)): foreach($rooms as $r): ?>
        	<div class="room">
            	<h3><?=$r->name?></h3>
                <p><?=$r->description?></p>
            </div>
        <? endforeach; endif; ?>
    </div>
    
    <div class="sessions_wrapper">
    	<? if(is_array($sessions)): foreach($sessions as $room => $sess): ?>
        
        	<div class="room_<?=$room?> sessions">
            	<? if(is_array($sess)): foreach($sess as $s): ?>
                	<?
						$session_duration = intval($s->session_end - $s->session_start);
						$percentage = $session_duration*$time_dimensions[0];
						$start_offset_per = ($s->session_start - $time_dimensions[1]) * $time_dimensions[0];
					?>
                	<div class="session" style="width: <?=str_replace(",", ".", $percentage)?>%; left: <?=str_replace(",", ".", $start_offset_per)?>%">
                    	<a href="<?=get_permalink($s->ID)?>"><table><tr><td><h4><?=$s->post_title?></h4></td></tr></table></a>
                        <div class="session_start"><?=date_i18n("H:i", $s->session_start)?></div>
                        <div class="session_end"><?=date_i18n("H:i", $s->session_end)?></div>
                    </div>
                <? endforeach; endif; ?>
            </div>
        
        <? endforeach; else: ?>
        
        	<p> Keine Sessions für dieses Datum im System. </p>
        
        <? endif; ?>
    </div>
	
        <p style="font-size: 0.75em; color: #666; margin: 50px 0 0 0"> <a href="/wp-login.php">Login / Registrieren</a> - Um eine Session zu beanspruchen sprecht auf dem Event entweder Sandra oder Hendrik an, oder schickt eine Mail an <a href="mailto:sessions@gamecampmunich.de">sessions@gamecampmunich.de</a>.</p>
    
</div><!-- content -->
 
<? get_footer(); ?>