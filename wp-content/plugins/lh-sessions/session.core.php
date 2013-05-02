<?php
/**
* The Core functions for the session planning
*
* @package lh-sessions
*/

class SessionCore {
	
	function __construct() {
		add_action( 'init', array($this, "setUpPostType") );
		add_action( 'init', array($this, "setUpTaxonomies") );
		
		add_filter( 'query_vars', array($this, 'create_query_vars') );
		
		add_filter(	'post_type_link', array($this, "event_in_permalink"), 1, 3);
		add_filter( 'user_contactmethods', array($this, 'extend_profile'), 100 );
		add_action( 'pre_get_posts', array($this, 'query_set_only_author') );
		add_action( 'plugins_loaded', array($this, 'plugin_init') );
		add_action( 'template_redirect', array($this, 'redirect_to_session_overview') );

	}
	
	
	
	
	
	/**
	*
	* Set up the custom post type for wordpress, is called by the 'init' action in __construct.
	*
	* @return void
	*
	*/
	public function setUpPostType(){
		$labels = array(
			'name' => _x('Sessions', 'post type general name', "lh-sessions"),
			'singular_name' => _x('Session', 'post type singular name', "lh-sessions"),
			'add_new' => _x('Add New', 'session', "lh-sessions"),
			'add_new_item' => __('Add New Session', "lh-sessions"),
			'edit_item' => __('Edit Session', "lh-sessions"),
			'new_item' => __('New Session', "lh-sessions"),
			'all_items' => __('All Sessions', "lh-sessions"),
			'view_item' => __('View Session', "lh-sessions"),
			'search_items' => __('Search Sessions', "lh-sessions"),
			'not_found' =>  __('No session found', "lh-sessions"),
			'not_found_in_trash' => __('No session found in Trash', "lh-sessions"), 
			'parent_item_colon' => '',
			'menu_name' => __('Sessions', "lh-sessions")
		
		  );
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => "session/%event%"),
			'capability_type' => 'session',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'author', 'comments' )
		  ); 	
		  
		register_post_type('session',$args);
	}
	
	
	
	
	
	/**
	*
	* Set up the custom taxonomies for the sessions, is called by the 'init' action in __construct.
	*
	* @return void
	*
	*/
	public function setUpTaxonomies(){
		
		$capabilities = array(
						"manage_terms"	=> "edit_others_sessions",
						"edit_terms"	=> "edit_others_sessions",
						"delete_terms"	=> "edit_others_sessions",
						"assign_terms"	=> "edit_session",
						);
		
		// Locations Taxonomy
		$labels = array(
			'name' => _x( 'Locations', 'taxonomy general name' ),
			'singular_name' => _x( 'Location', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Locations' ),
			'all_items' => __( 'All Locations' ),
			'parent_item' => __( 'Parent Location' ),
			'parent_item_colon' => __( 'Parent Location:' ),
			'edit_item' => __( 'Edit Location' ), 
			'update_item' => __( 'Update Location' ),
			'add_new_item' => __( 'Add New Location' ),
			'new_item_name' => __( 'New Location Name' ),
			'menu_name' => __( 'Locations' ),
		); 	
		
		register_taxonomy('location',array('session'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'capabilities' => $capabilities,
			'rewrite' => array( 'slug' => 'location' ),
		));	
		
		// Event Taxonomy
		$labels = array(
			'name' => _x( 'Events', 'taxonomy general name' ),
			'singular_name' => _x( 'Event', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Events' ),
			'all_items' => __( 'All Events' ),
			'parent_item' => __( 'Parent Event' ),
			'parent_item_colon' => __( 'Parent Event:' ),
			'edit_item' => __( 'Edit Event' ), 
			'update_item' => __( 'Update Event' ),
			'add_new_item' => __( 'Add New Event' ),
			'new_item_name' => __( 'New Event Name' ),
			'menu_name' => __( 'Events' ),
		); 	
		
		register_taxonomy('event',array('session'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'capabilities' => $capabilities,
			'rewrite' => array( 'slug' => 'event' ),
		));	
		
		// Topics Taxonomy
		$labels = array(
			'name' => _x( 'Topics', 'taxonomy general name' ),
			'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Topics' ),
			'all_items' => __( 'All Topics' ),
			'parent_item' => __( 'Parent Topic' ),
			'parent_item_colon' => __( 'Parent Topic:' ),
			'edit_item' => __( 'Edit Topic' ), 
			'update_item' => __( 'Update Topic' ),
			'add_new_item' => __( 'Add New Topic' ),
			'new_item_name' => __( 'New Topic Name' ),
			'menu_name' => __( 'Topics' ),
		); 	
		
		register_taxonomy('topics',array('session'), array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'capabilities' => $capabilities,
			'rewrite' => array( 'slug' => 'topics' ),
		));
		
		$config = array(
			'id' => 'add_info',          // meta box id, unique per meta box
			'title' => 'Location Info',          // meta box title
			'pages' => array('location'),        // taxonomy name, accept categories, post_tag and custom taxonomies
			'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
			'fields' => array(),            // list of meta fields (can be added by field arrays)
			'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
		);
		
		$location_metadata = new Tax_Meta_Class($config);
		$location_metadata->addText('lh_location_position',array('name'=> 'Position'));
		$location_metadata->Finish();
	}
	
	
	
	
	
	
	/**
	*
	* Make sure, that the event is used in the session permalink, 404 if no event is applied, is called by the 'post_type_link' filter in __construct.
	*
	* @return void
	*
	*/
	function event_in_permalink( $post_link, $id = 0 ) {
		$post = get_post($id);
		
		if ( strpos($post_link,'%event%') === FALSE || !is_object($post) || $post->post_type <> 'session')
			return $post_link;
	
		$event_terms = wp_get_object_terms($post->ID, 'event');
		if(is_array($event_terms) && !empty($event_terms)){
			$event = $event_terms[0]->slug;
			$post_link = str_replace("%event%", $event, $post_link);
			return $post_link;
		}
	
	
		$post_link = str_replace("%event%/", "", $post_link);
				
		return $post_link;
	}
	
	
	
	
	
	/**
	*
	* Make sure, that these extra profile fields are there, that are needed, is called by the 'user_contactmethods' filter in the __construct.
	*
	* @param array $contact The array with the already existing wordpress contact methods
	*
	* @return array The updated array with the wordpress contact methodes
	*
	*/
	function extend_profile($contact) {
	
		$contact['twitter'] = 'Twitter Username <span class="description">(without @)</span>';
		$contact['facebook'] = 'Facebook Username <span class="description">(or vanity name)</span>';
		
		unset($contact['aim'], $contact['yim'], $contact['jabber']);
		
		return $contact;

	}
	
	
	
	
	
	
	/**
	*
	* Make sure, that session speakers can only see and edit their own sessions, is called by the 'pre_get_posts' action in the __construct.
	*
	* @param array The Wordpress WP_QUERY array
	*
	* @return void
	*
	*/
	function query_set_only_author( $wp_query ) {
		global $current_user;
		if ( is_admin() && is_post_type_archive('session') && !current_user_can('edit_others_sessions') ) {
			$wp_query->set( 'author', $current_user->ID );
		}
	}
	
	
	function helper_save_post_meta( $post_id, $post, $nonce_name, $post_value, $meta_key, $custom_value = NULL ) {
	
	
		/* Verify the nonce before proceeding. */
		if ( !isset( $_POST[$nonce_name] ) || !wp_verify_nonce( $_POST[$nonce_name], "luehrsenheinrich" ) )
			return $post_id;
	
		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );
			
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
	
		/* Get the posted data and sanitize it for use as an HTML class. */
		if(isset($_POST[$post_value])){
			$new_meta_value = strip_tags($_POST[$post_value]);
		} elseif(isset($custom_value)) {
			$new_meta_value = strip_tags($custom_value);
		}
			
		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );
	
		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	
		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	
		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );
	}
	
	
	function plugin_init() {
	  	load_plugin_textdomain( 'lh-session', false, dirname( plugin_basename( __FILE__ ) )."/lang" ); 
	}
	
	
	function session_og_head() {
		global $post;
		
		$description = 'Session | '.date("d.m.Y - H:i", get_post_meta($post->ID, "_session_start", true));
		
		if($post->post_content){
			$description .= " | ".shorten_text(strip_tags(apply_filters("the_content", $post->post_content)), 130);	
		}
	
		$og_head[] = '<meta property="og:type"   content="gamecampmuc:session" />';
		$og_head[] = '<meta property="og:url"    content="'.get_permalink($post->ID).'" /> ';
		$og_head[] = '<meta property="og:title"  content="'.get_the_title($post->ID).'" />';
		$og_head[] = '<meta property="og:image"  content="'.WP_THEME_URL.'/img/gcmuc_meta.jpg" />';
		$og_head[] = '<meta property="og:description"  content="'.htmlspecialchars($description).'" />';

		
		echo implode("\r", $og_head);
	
	}
	
	
	
	
	
	
	/**
	* Creates the neccesary query vars
	*/
	public function create_query_vars($public_query_vars){
		
		$public_query_vars[] = 'session_overview';
		$public_query_vars[] = 'session_event';
			
		return $public_query_vars;
	}
	
	
	public function redirect_to_session_overview(){	
	
		
		$session_overview = get_query_var('session_overview');
		$session_event = get_query_var('session_event');


		if($session_overview == "json" && $session_event != ""){
			lh_session_overview_json($session_event);
			exit;
		}
	}
}



// End of Session Core