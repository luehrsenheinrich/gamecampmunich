<?php
/*
 * Luehrsen // Heinrich - Wordpress Theme Functions
 *
 * A useful collection of great functions of daily usage in wordpress theme development.
 *
 */

class lhThemeFunctions {

	function __construct() {
		add_filter( 'admin_footer_text', 		array($this, 'lh_admin_footer') ); //change admin footer text
		add_action( 'admin_init', 				array($this, 'lh_remove_menu_pages' ) );
		add_action(	'admin_bar_menu', 			array($this, 'lh_change_toolbar') , 999 );
		add_filter( 'mod_rewrite_rules', 		array($this, 'lh_htaccess_contents') );
		add_action( 'login_enqueue_scripts', 	array($this, 'lh_login_logo' ) );
		add_filter( 'login_headerurl', 			array($this, 'lh_login_logo_url' ) );
		add_filter( 'login_headertitle', 		array($this, 'lh_login_logo_url_title' ) );
		add_filter( 'oembed_result', 			array($this, "change_oembed"), 10, 3);
		add_filter( 'the_password_form', 		array($this, 'custom_password_form') );

	}

	/**
	 * Echoes custom text in the admin footer, is called by "admin_footer_text" filter
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 * @return void
	 */
	function lh_admin_footer() {
		echo "Made with love by <a href='http://www.luehrsen-heinrich.de' target='_blank'>Luehrsen // Heinrich</a>. Powered by <a href='http://www.wordpress.org' target='_blank'>Wordpress</a>.";
	}

	/**
	 * Gracefully shortens text whithout cutting words
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 * @param $str string The text, that shall be shortened
	 * @param $length int The length to which the text should be shortened
	 * @param $minword int The minimum amount of words, that shall be displayed
	 *
	 * @return The shortened string with "..." attatched.
	 */
	function shorten_text($str, $length, $minword = 3)
	{
	    $sub = '';
	    $len = 0;

	    foreach (explode(' ', $str) as $word)
	    {
	        $part = (($sub != '') ? ' ' : '') . $word;
	        $sub .= $part;
	        $len += strlen($part);

	        if (strlen($word) > $minword && strlen($sub) >= $length)
	        {
	            break;
	        }
	    }

		if($len < strlen($str) and substr($sub, strlen($sub)-1) != "."){
			$end = " ...";
		}
		else{
			$end = NULL;
		}

	    return $sub . $end ;
	}

	/**
	 * Deactivates certain menu items from wordpress administration
	 * Called by wordpress action "admin_init"
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 */
	function lh_remove_menu_pages() {
		//remove_menu_page('link-manager.php');
	}

	/**
	 * Changes the wordpress toolbar the way we need it
	 * Called by wordpress action "admin_bar_menu"
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 */
	function lh_change_toolbar($wp_toolbar) {
		$wp_toolbar->remove_node('wp-logo');
	}

	/**
	 * Edit the .htacces File and add our needs
	 *
	 * @author Hendrik Luehrsen
	 * @since 1.0
	 *
	 * @param string $rules The predefined wordpress rules
	 *
	 * @return string The new rules
	 */
	function lh_htaccess_contents( $rules )
	{
		$my_content = "\n# BEGIN L//H Content
	<IfModule mod_deflate.c>
	 SetOutputFilter DEFLATE
	</IfModule>
	# END L//H Content \n\n\n
	";
	    return $my_content . $rules;
	}

	//
	// STYLING THE LOGIN PAGE
	//

	/*
	 * Add some css code to change the default logo
	 * Called by action "login_enqueue_scripts".
	 *
	 * @author Hendrik Luehrsen
	 * @since 3.1
	 *
	 * @return string The CSS Code for the head
	 */
	function lh_login_logo() { ?>
	    <style type="text/css">
	        body.login div#login h1 a {
		        background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/lh_logo.png);
				background-size: 274px 41px;
				background-repeat: no-repeat;
				background-position: center center;
	            padding-bottom: 0;
	            margin-bottom: 0;
	            width: 274px;
	        }
	    </style>
	<?php
	}

	/**
	 * Change the login logo url
	 *
	 * @author Hendrik Luehrsen
	 * @since 3.1
	 *
	 * @return string The new url
	 */
	function lh_login_logo_url() {
	    return "http://www.luehrsen-heinrich.de";
	}

	/**
	 * Change the login logo title
	 *
	 * @author Hendrik Luehrsen
	 * @since 3.1
	 *
	 * @return string The new title
	 */
	function lh_login_logo_url_title() {
	    return 'Luehrsen // Heinrich - Agentur für Medienkommunikation';
	}

	/**
	 * Change the embed code, so we can apply awesome css shit
	 * Called by filter "oembed_result"
	 *
	 * @author Hendrik Luehrsne
	 * @since 1.0
	 *
	 * @param $html string The oembed html to edit
	 *
	 * @return string The edited html
	 */
	function change_oembed($html, $url, $args){
		$video_pattern = "#(\W|^)(youtube|vimeo)(\W|$)#";
		$twitter_pattern = "#(\W|^)(twitter)(\W|$)#";

		if(preg_match($video_pattern, $url)){
			$new_html = '<div class="clearfix"></div><div class="oembed-wrapper"><img src="'.WP_THEME_URL.'/img/16_9_placeholder.png" />'.$html.'</div>';
		} elseif(preg_match($twitter_pattern, $url)) {
			$new_html = '<div class="clearfix"></div><div class="oembed-wrapper-twitter">'.$html.'</div>';
		} else {
			$new_html = $html;
		}

		return $new_html;
	}

	function custom_password_form() {
	    global $post;
	    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

	    $html = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="form-inline">';
	    $html .= '<div class="container"><div class="row">';
	    $html .= '<div class="col-md-6 col-md-offset-3">
	   				<h3>'.__( "Please enter the correct password!", LANG_NAMESPACE ).'<h3>
	    			<input class="form-control" name="post_password" id="' . $label . '" type="password" /><br /><br /><input type="submit" class="btn btn-default pull-right" name="Submit" value="' . esc_attr__( "Submit" ) . '" /></div>';
	    $html .= '</div></div>';
	    $html .= '</form>';

	    return $html;
	}

}
$_lh_theme_functions = new lhThemeFunctions();

/**
 * The custom walker to implement "wp_list_comments" into the bootstrap media layout
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function lh_comments($comment, $args, $depth){
	
	if($comment->user_id != 0){
		$user = get_user_by('id', $comment->user_id);
		$user_role = get_role(array_shift($user->roles));
		$user_caps = $user->allcaps;		
	}
	
	if(get_comment_type() == "comment" or get_comment_type() == "facebook"): ?>	
    
    <div <? comment_class('media')?> id="comment-<?php comment_ID() ?>">
        <div class="comment-thumbnail pull-left">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="media-object">
                <?=get_avatar($comment, $args['avatar_size'])?>
                <?php if($user_caps['level_3'] == true): ?>
                	<h4 class="staff_title">Orga</h4>
                <?php endif; ?>
            </a>
            <div class="arrow-left"></div>
        </div>
        <div class="media-body comment-body">
            <h4 class="media-heading author-info clearfix">
                <?php comment_author_link() ?>
                <span class="headline_meta pull-right">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                    <span class="datetime">
						<?php
                            /* translators: 1: date, 2: time */
                            printf( __('%1$s at %2$s', "gcmuc"), get_comment_date(),  get_comment_time());
                        ?>
                    </span>
                    <span class="datetime-phone">
                    	<?php
							echo get_comment_date(__("d.m.Y - H:i", "gcmuc"));
						?>
                    </span>
                    </a><?php edit_comment_link(__('(Edit)', "gcmuc"),'  ','' ); ?>
                </span>
            </h4>
            <div class="comment-message the_content"><?php comment_text() ?></div>
           
            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('add_below' => NULL, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="icon-reply"></i> '.__("Reply", "gcmuc") ))); ?>
            </div>
        </div>
    
    <?php else: ?>
    <div <? comment_class('media')?> id="comment-<?php comment_ID() ?>">
        <div class="media-body comment-body">
            <h4 class="media-heading author-info clearfix">
                <?php _e("Link", "gcmuc"); ?>: <?php comment_author_link() ?>
                <span class="headline_meta pull-right">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                    <span class="datetime">
						<?php
                            /* translators: 1: date, 2: time */
                            printf( __('%1$s at %2$s', "gcmuc"), get_comment_date(),  get_comment_time());
                        ?>
                    </span>
                    <span class="datetime-phone">
                    	<?php
							echo get_comment_date(__("d.m.Y - H:i", "gcmuc"));
						?>
                    </span>
                    </a><?php edit_comment_link(__('(Edit)', "gcmuc"),'  ','' ); ?>
                </span>
            </h4>
        </div>
    <?php endif;
}


//
// Helper Functions
//
if(!function_exists("shorten_text")){

	/**
	 * Register the helper function "shorten_text", it the function not yet exists.
	 *
	 * @access public
	 * @param mixed $str
	 * @param mixed $length
	 * @param int $minword (default: 3)
	 * @return void
	 */
	function shorten_text($str, $length, $minword = 3){
		global $_lh_theme_functions;
		return $_lh_theme_functions->shorten_text($str, $length, $minword = 3);
	}

}