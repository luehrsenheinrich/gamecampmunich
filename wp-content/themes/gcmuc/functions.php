<?php
if(!defined('WP_THEME_URL')) {
	define( 'WP_THEME_URL', get_bloginfo('stylesheet_directory'));
}
if(!defined('WP_JS_URL')) {
	define( 'WP_JS_URL' , get_bloginfo('template_url').'/js');
}	

setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

// LESS CSS PHP COMPILER 
require_once( dirname(__FILE__)."/less/lib/less.inc.php");

try {
    lessc::ccompile( dirname(__FILE__).'/less/style.less', dirname(__FILE__).'/style_less.css');
    lessc::ccompile( dirname(__FILE__).'/less/editor_style.less', dirname(__FILE__).'/editor-style.css');

} catch (exception $ex) {
    exit($ex->getMessage());
}
// END LESS CSS PHP COMPILER

add_editor_style();

// Requirements
require_once("sources/get_social_media.php");
require_once("sources/theme_functions.php");
require_once("sources/dashboard_widget.php");


// Load the textdomain
$theme_url = get_bloginfo('template_url')."/lang";
$theme_url = str_replace(get_bloginfo("url"), $_SERVER['DOCUMENT_ROOT'], $theme_url);
load_theme_textdomain('gcmuc', $theme_url);


// Implement the basic files, but not within the admin 
if(!is_admin()){
	wp_enqueue_style('style', WP_THEME_URL.'/style_less.css', NULL, '2.0', 'all');
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1', false);
	wp_enqueue_script('jquery');
	wp_enqueue_script('twitter', 'http://widgets.twimg.com/j/2/widget.js', NULL, 2, false);
	wp_enqueue_script('fancybox', WP_JS_URL.'/libs/jquery.fancybox.pack.js', array('jquery'), '1', false);
	wp_enqueue_script('nanoscroller', WP_JS_URL.'/libs/jquery.nanoscroller.min.js', array('jquery'), '1', false);
	wp_enqueue_script('plugins', WP_JS_URL.'/plugins.js', array('jquery'), '1', false);
	wp_enqueue_script('script', WP_JS_URL.'/script.js', array('jquery'), '1', false);
}

// Clean up the header 
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); 

// Post Thumbnails
add_theme_support( 'post-thumbnails' );
add_image_size( 'screenshot', 454, 255, true );
set_post_thumbnail_size( 908, 510, true );

// Sidebars 
$args = array(
	'name'          => __("Sidebar Main", "gcmuc"),
	'id'            => 'sidebar-main',
	'description'   => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' );
register_sidebar($args);


// Menus
register_nav_menu( 'primary', 'Primary Menu' );

add_filter( 'wpseo_use_page_analysis', '__return_false' );




function rewriteAuthorBase(){
	global $wp_rewrite;
	$wp_rewrite->author_base = "speaker";	
}
add_action('init', 'rewriteAuthorBase');


// Shorten Text //

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
		$end = "...";
	}
	else{
		$end = NULL;
	}
	
    return $sub . $end ;
}

/* End of functions.php */
/************************/
/************************/