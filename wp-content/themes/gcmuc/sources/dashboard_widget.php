<?

// Create the function to output the contents of our Dashboard Widget

function gcmuc_dashboard_widget_function() {
	?>
    
    <div class="gcmuc_logo" style="margin: 10px 25px 15px;">
    	<img src="<?=get_bloginfo('template_directory')?>/img/gcmuc_dashboard_logo.png" style="width: 100%; height: auto;" />
    </div>
    
   	<p> Willkommen im Backend des Gamecamp Munich. Bei Fragen zum Backend und wie du deine Session editierst, wende dich einfach an die <strong>Session Manager</strong> vor Ort, oder <a href="mailto:support@gamecampmunich.de">schreibe dem eMail Support</a>, oder kontaktiere uns via <a href="http://www.twitter.com/gamecampmunich">Twitter (@gamecampmunich)</a>.</p>
    
    <?
} 

// Create the function use in the action hook

function gcmuc_add_dashboard_widgets() {
	wp_add_dashboard_widget('gcmuc_dashboard_widget', 'Gamecamp Munich', 'gcmuc_dashboard_widget_function');	
	
	// Globalize the metaboxes array, this holds all the widgets for wp-admin

	global $wp_meta_boxes, $user_id;
	
	// Get the regular dashboard widgets array 
	// (which has our new widget already but at the end)

	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashbaord widget from the end of the array

	$gcmuc_widget_backup = array('gcmuc_dashboard_widget' => $normal_dashboard['gcmuc_dashboard_widget']);
	unset($normal_dashboard['gcmuc_dashboard_widget']);

	// Merge the two arrays together so our widget is at the beginning

	$sorted_dashboard = array_merge($gcmuc_widget_backup, $normal_dashboard);

	// Save the sorted array back into the original metaboxes 

	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		
	delete_user_meta(get_current_user_id(), "meta-box-order_dashboard");
	
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions

add_action('wp_dashboard_setup', 'gcmuc_add_dashboard_widgets' ); // Hint: For Multisite Network Admin Dashboard use wp_network_dashboard_setup instead of wp_dashboard_setup.