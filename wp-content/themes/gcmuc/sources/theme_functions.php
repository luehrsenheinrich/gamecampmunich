<?php

function gcmuc_comments_walker($comment, $args, $depth){
	
	if($comment->comment_type == "pingback" or $comment->comment_type == "trackback"){
		// Pingback
		$GLOBALS['comment'] = $comment; ?>
		<div <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
        			<div class="commentmetadata clearfix">
						<div class="author"><?=__("Pingback", "gcmuc")?>: <?=get_comment_author_link()?></div>
						<div class="datetime"><?php edit_comment_link(__('(Edit)', "gcmuc"),'  ','') ?></div>
					</div>
        <?
	} else {
		
		if($comment->comment_type == "facebook"){
			$is_facebook = true;	
			$author_class = " facebook_author";
		} else {
			$is_facebook = false;
			$author_class = NULL;
		}
	
		// Normal Comment
		$GLOBALS['comment'] = $comment; ?>
   			<div <?php comment_class('comment'); ?> id="comment-<?php comment_ID() ?>-wrapper">
				<div id="comment-<?php comment_ID(); ?>" class="comment-body">
					<?=get_avatar( $comment, 50 )?>
					<div class="commentmetadata">
						<div class="datetime"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', "gcmuc"), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', "gcmuc"),'  ','') ?></div>
   						<div class="author<?=$author_class?>"><?=get_comment_author_link()?></div>
					</div>
					<div class="commentbody the-content">
						<?php comment_text() ?>
					</div>
				</div>
		<?	
	
	}
}

function gcmuc_comment_walker_end($comment, $args, $dempth){
	?>
    
    </div>
	<div class="trenner grey"></div>
    
    <?	
}



// We use just one function for both jobs.
add_action( 'comment_form_defaults', 'gcmuc_move_textarea' );
add_action( 'comment_form_top', 'gcmuc_move_textarea' );

/**
 * Take the textarea code out of the default fields and print it on top.
 *
 * @param  array $input Default fields if called as filter
 * @return string|void
 */
function gcmuc_move_textarea( $input = array () )
{
    static $textarea = '';

    if ( 'comment_form_defaults' === current_filter() )
    {
        // Copy the field to our internal variable …
        $textarea = $input['comment_field'];
        // … and remove it from the defaults array.
        $input['comment_field'] = '';
        return $input;
    }

    print $textarea;
}



// Admin Logo 
function my_custom_login_logo() {
    echo '
	<style type="text/css">
        h1 a { 
			background-image:url('.get_bloginfo('template_directory').'/img/admin_header.png) !important; 
			background-size: contain !important;
			width: 320px !important;
			height: 50px !important;
		}
    </style>';
}

add_action('login_head', 'my_custom_login_logo');


// WP Logo aus der Admin Bar entfernen
function abwlmr_remove_wp_logo() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'abwlmr_remove_wp_logo' );

// Admin Footer
add_filter('admin_footer_text', 'remove_footer_admin'); //change admin footer text
function remove_footer_admin () {
	echo "<img src='".get_bloginfo('template_directory')."/img/footer_icon.png' style='vertical-align: bottom; margin: 0 5px 0 0;' />Powered by <a href='http://www.luehrsen-heinrich.de' target='_blank'>Luehrsen // Heinrich</a> &amp; <a href='http://www.wordpress.org'>Wordpress</a>. Handcrafted for the Gamecamp Munich.";
}

function change_dashboard_primary_title () {
  return "Luehrsen // Heinrich";
}
function change_dashboard_primary_feed() {
  return "http://www.luehrsen-heinrich.de/feed/";
}
function change_dashboard_primary_link() {
  return "http://www.luehrsen-heinrich.de/";
}

function change_dashboard_secondary_title () {
  return "Daily Business Inspiration";
}
function change_dashboard_secondary_feed() {
  return "http://www.dailybusinessinspiration.com/feed/";
}
function change_dashboard_secondary_link() {
  return "http://www.dailybusinessinspiration.com/";
}

add_filter("dashboard_primary_feed","change_dashboard_primary_feed");
add_filter("dashboard_primary_title","change_dashboard_primary_title");
add_filter("dashboard_primary_link", "change_dashboard_primary_link");
add_filter("dashboard_secondary_feed","change_dashboard_secondary_feed");
add_filter("dashboard_secondary_title","change_dashboard_secondary_title");
add_filter("dashboard_secondary_link","change_dashboard_secondary_link");


/**
 * Replace links in text with html links
 *
 * @param  string $text
 * @return string
 */
function auto_link_text($text)
{
   $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
   $callback = create_function('$matches', '
       $url       = array_shift($matches);
       $url_parts = parse_url($url);

       $text = parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH);
       //$text = preg_replace("/^www./", "", $text);

       $last = -(strlen(strrchr($text, "/"))) ;
       if ($last < 0) {
           $text = substr($text, 0, $last);
       }

       return sprintf(\'<a rel="nofollow" href="%s">%s</a>\', $url, $text);
   ');

   return preg_replace_callback($pattern, $callback, $text);
}

?>