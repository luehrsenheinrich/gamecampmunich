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
uasort($rooms, "lh_sort_rooms");
$time_dimensions = get_time_dimensions($sessions);

global $lh_session_dates;

?>

<div class="container content-page">
	<div class="row">
	
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div id="content" class="sessionplan clearfix page">
			
				<h1>Sessions für <?=date_i18n("l, d.m.Y", $sessionplan_date)?></h1>
			    <? if(is_array($lh_session_dates)): ?>
			    <div class="event_dates">
			    	<? foreach($lh_session_dates as $d): if($d != $sessionplan_date):?>
			        	<a class="editor_buttons button btn btn-default btn-warning" href="<?=get_term_link($event->slug, "event")?>?sessionplan_date=<?=$d?>"><?=date_i18n("l, d.m.Y", $d)?></a>
			        <? endif; endforeach; ?>
			    </div>
			   	<? endif; ?>
			    
			    <div class="sessions_wrapper">
				    <? if(is_array($rooms)): foreach($rooms as $r): 
				    ?>
				    
				    	<div class="room-row">
			            	<h3><?=$r->name?></h3>
			            </div>
								
				    	<? 
				    	
				    	if(is_array($sessions)): foreach($sessions as $room => $sess): if($room == $r->slug):
				    	?>
					        	
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
				        
				        <? endif; endforeach; else: ?>
					        
					        	<p>Keine Sessions für diesen Raum zu dieser Zeit im System.</p>
					        
					        <? endif; ?>
					<? endforeach; endif; ?>
			    </div>
				
			        <p class="session-disclaimer"> <a href="/wp-login.php">Login / Registrieren</a> - Um den angezeigten Inhalt einer Session selbst zu verwalten sprecht auf dem Event entweder jemand vom Orgateam an, oder schickt eine Mail an <a href="mailto:sessions@gamecampmunich.de">sessions@gamecampmunich.de</a>.</p>
			    
			</div><!-- content -->
			
		</div>
		
	</div>
	
</div>
 
<? get_footer(); ?>