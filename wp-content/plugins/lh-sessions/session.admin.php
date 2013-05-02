<?php
/**
* The Administrative functions for the session planning
*
* @package lh-sessions
*/

class SessionAdmin extends SessionCore {
	
	function __construct() {
		parent::__construct();
		
		/* Fire our meta box setup function on the post editor screen. */
		add_action( 'load-post.php', array($this, 'post_meta_boxes_setup') );
		add_action( 'load-post-new.php', array($this, 'post_meta_boxes_setup') );
		add_action( 'save_post', array($this, 'save_session_meta'), 10, 2 );
	}
	
	
	/* Meta box setup function. */
	public function post_meta_boxes_setup() {
	
		/* Add meta boxes on the 'add_meta_boxes' hook. */
		add_action( 'add_meta_boxes', array($this, 'add_post_meta_boxes') );
	}
	
	/* Create one or more meta boxes to be displayed on the post editor screen. */
	public function add_post_meta_boxes() {
	
		add_meta_box(
			'lh-session',								// Unique ID
			esc_html__( 'Session', 'lh-session' ),		// Title
			array($this, 'session_meta_box'),			// Callback function
			'session',									// Admin page (or post type)
			'normal',									// Context
			'high'										// Priority
		);
	}
	
	
	/**
	*
	* Echo the HTML Code for the Session post meta box, called by "add_meta_box" ind SessionAdmin::add_post_meta_boxes.
	*
	* @return void
	*/
	public function session_meta_box(){
		global $post;
		?>
        <?php wp_nonce_field( "luehrsenheinrich", 'session_data_nonce' ); ?>
        <table style="width: 100%;">
        	<tr>
            	<td>
                
                	<h4> Session Start </h4>
                    <?=$this->_helper_date_dropdown("session_start", get_post_meta($post->ID, "_session_start", true) )?>
                    <h4> Session End </h4>
                	<?=$this->_helper_date_dropdown("session_end", get_post_meta($post->ID, "_session_end", true))?>
                </td>
         
            	<td>
                </td>
            </td>
        </table>
        
        <?		
	}
	
	
	public function save_session_meta($post_id, $post){
		
		$session_start = mktime($_POST['session_start_hours'], $_POST['session_start_minutes'], 0, $_POST['session_start_month'], $_POST['session_start_day'], $_POST['session_start_year']);
		$session_end = mktime($_POST['session_end_hours'], $_POST['session_end_minutes'], 0, $_POST['session_end_month'], $_POST['session_end_day'], $_POST['session_end_year']);
		
		$this->helper_save_post_meta($post_id, $post, 'session_data_nonce', NULL, '_session_start', $session_start);
		$this->helper_save_post_meta($post_id, $post, 'session_data_nonce', NULL, '_session_end', $session_end);

	}
	
	
	
	// HELPER FUNCTIONS //
	
	private function _helper_date_dropdown($id, $predefined_date = NULL){
		$now = current_time("timestamp");
		
		if($predefined_date == NULL || $predefined_date == false){
			$predefined_date = $now;	
		}
		
		// get the years, +1 year, -9 years
		$base_year = date("Y", $now+31556926);
		$years = array();
		for($i = 0; $i <= 10; $i++){
			$years[] = $base_year - $i;
		}
		
		$years_options = array();
		foreach($years as $y){
			
			if(date("Y", $predefined_date) == $y){
				$selected = 'selected="selected"';	
			} else {
				$selected = NULL;	
			}
			
			$years_options[] = '<option value="'.$y.'" '.$selected.'>'.$y.'</option>';	
		}
		$years_select = '<select name="'.$id.'_year" id="'.$id.'_year">'.implode("", $years_options).'</select>';

		// get the months
		$months = array();
		for($i = 1; $i <= 12; $i++){
			$months[] = $i;
		}
		
		$months_options = array();
		foreach($months as $m){
			
			if(date("n", $predefined_date) == $m){
				$selected = 'selected="selected"';	
			} else {
				$selected = NULL;	
			}
			
			$months_options[] = '<option value="'.$m.'" '.$selected.'>'.date("M", mktime(0,0,0,$m, 12, 2010)).'</option>';	
		}
		$months_select = '<select name="'.$id.'_month" id="'.$id.'_month">'.implode("", $months_options).'</select>';
		
		// get the days
		$days = array();
		for($i = 1; $i <= 31; $i++){
			$days[] = $i;
		}
		
		$days_options = array();
		foreach($days as $d){
			
			if(date("j", $predefined_date) == $d){
				$selected = 'selected="selected"';	
			} else {
				$selected = NULL;	
			}
			
			$days_options[] = '<option value="'.$d.'" '.$selected.'>'.date("d", mktime(0,0,0,5, $d, 2010)).'</option>';	
		}
		$days_select = '<select name="'.$id.'_day" id="'.$id.'_day">'.implode("", $days_options).'</select>';
		
		
		// get the hours
		$hours = array();
		for($i = 0; $i <= 23; $i++){
			$hours[] = $i;
		}
		
		$hours_options = array();
		foreach($hours as $h){
			
			if(date("G", $predefined_date) == $h){
				$selected = 'selected="selected"';	
			} else {
				$selected = NULL;	
			}
			
			$hours_options[] = '<option value="'.$h.'" '.$selected.'>'.date("H", mktime($h,0,0,5, 15, 2010)).'</option>';	
		}
		$hours_select = '<select name="'.$id.'_hours" id="'.$id.'_hours">'.implode("", $hours_options).'</select>';
	
		// get the minutes
		$minutes = array(0, 15, 30, 45);
		
		$minutes_options = array();
		foreach($minutes as $m){
			
			$current_quarter = round(intval(date("i", $predefined_date))/60*4)*15;
			
			if($current_quarter == $m){
				$selected = 'selected="selected"';	
			} else {
				$selected = NULL;	
			}
			
			$minutes_options[] = '<option value="'.$m.'" '.$selected.'>'.date("i", mktime(0,$m,0,5, 15, 2010)).'</option>';	
		}
		$minutes_select = '<select name="'.$id.'_minutes" id="'.$id.'_minutes">'.implode("", $minutes_options).'</select>';
	
		return $days_select.$months_select.$years_select." - ".$hours_select.$minutes_select;
	}
}