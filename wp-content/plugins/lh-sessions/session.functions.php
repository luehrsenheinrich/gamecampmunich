<?php


function lh_get_sessions($event = NULL, $year = NULL, $month = NULL, $day = NULL){
	global $lh_session_dates;
	
	if($event == NULL){
		return NULL;	
	}
	
	$min_date = mktime(0,0,0,$month,$day,$year);
	$max_date = mktime(23,59,59,$month,$day,$year);
	
	$event_term = get_term( get_term_by("slug", $event, "event") , "event" );
	
	$args = array(
	'post_type' => 'session',
	'taxonomy' => 'event',
	'term' => $event_term->slug,
	'nopaging'=>true,
	'orderby'=>'meta_value_num',
	'meta_key' => '_session_start',
	'order'=>'ASC',
	);

	$event_sessions = new WP_Query($args);
	
	$sessions = NULL;
	
	while ( $event_sessions->have_posts() ) : $event_sessions->the_post();
		global $post;
		
		$locations = get_the_terms($post->ID, "location");
		
		$session_start = intval(get_post_meta($post->ID, "_session_start", true));
		$session_end = intval(get_post_meta($post->ID, "_session_end", true));
		
		$lh_session_dates[date_to_day($session_start)] = date_to_day($session_start);
		$lh_session_dates[date_to_day($session_end)] = date_to_day($session_end);
						
		if(is_array($locations) && $session_start > $min_date && $session_start < $max_date && $session_end > $min_date && $session_end < $max_date){
			$locations = array_values($locations);
			$post->session_start = $session_start;
			$post->session_end = $session_end;
			$post->room = $locations[0];
			$post->session_start_clean = date("H:i", $session_start);
			$sessions[$locations[0]->slug][] = $post;
		}
		
	endwhile;
		
	wp_reset_postdata();
	
	if(is_array($sessions)){
		$lh_session_dates = array_values($lh_session_dates);
		
		
		uksort($sessions, "_sort_sessions");
	}
	
	
	return $sessions;
}


function lh_get_rooms($sessions = NULL){
	
	if($sessions == NULL){
		return NULL;	
	}
	
	$rooms = array();
	
	if(is_array($sessions)){
		foreach($sessions as $key => $value){
			$rooms[$key] = get_term_by("slug", $key, "location");	
		}
	}

	return array_values($rooms);
}


function lh_sort_rooms($room_A, $room_B){
	$a = get_tax_meta($room_A->term_id,'lh_location_position');
	$b = get_tax_meta($room_B->term_id,'lh_location_position');
	
	if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
	
}


function get_time_dimensions($sessions = NULL){
	
	$earliest_date = 0;
	$latest_date = 0;
	$first = true;

	if(!is_array($sessions)){
		return NULL;	
	}
	
	foreach($sessions as $rooms){
		
		foreach($rooms as $s){
			
			if($first == true){
				$earliest_date = $s->session_start;
				$latest_date = $s->session_end;	
				$first = false;
			}
			
			if($earliest_date > $s->session_start){
				$earliest_date = $s->session_start;	
			}
			
			if($earliest_date > $s->session_end){
				$earliest_date = $s->session_end;	
			}
			
			if($latest_date < $s->session_end){
				$latest_date = $s->session_end;	
			}
			
			if($latest_date < $s->session_start){
				$latest_date = $s->session_start;	
			}
			
		}
		
	}
		
		$timespan = $latest_date - $earliest_date;
		$onesecond = 100/$timespan;	
			
	return array($onesecond, $earliest_date, $latest_date);
}



function date_to_day($timestamp){
	$day_timestamp = mktime(0,0,0, date("m", $timestamp), date("d", $timestamp), date("Y", $timestamp));
	
	return $day_timestamp;
}


function _sort_sessions($a, $b){
	$a_term = get_term_by("slug", $a, "location");
	$b_term = get_term_by("slug", $b, "location");
	
	$a_val = intval(get_tax_meta($a_term->term_id, "lh_location_position"));
	$b_val = intval(get_tax_meta($b_term->term_id, "lh_location_position"));
	
	if ($a_val == $b_val) {
        return 0;
    }
    return ($a_val < $b_val) ? -1 : 1;
}


function lh_session_overview_json($event){
	$sessions = lh_get_sessions($event, date("Y"), date("m"), date("d"));
	
	$now = time()+3600*2;
	$upcoming_limit = $now+60*35;
	
	$running_sessions = array();
	$upcoming_sessions = array();
	
	if(is_array($sessions)){
		foreach($sessions as $room => $sess){
			foreach($sess as $s){
				$start = $s->session_start;
				$end = $s->session_end;
				
				if($start < $now && $end > $now){
					$running_sessions[]	= $s;
				} elseif ( $start > $now && $start < $upcoming_limit){
					$upcoming_sessions[] = $s;	
				}
			}
		}
		
		$json_array = array(
								"upcoming" 	=> $upcoming_sessions,
								"running"	=>	$running_sessions,
							);
							
		echo json_encode($json_array);	
	}
}


///
///
/// EOF