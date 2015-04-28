<?php

/*
 * Definition of needed Constants
 */
if(!defined('WP_THEME_URL')) {
	define( 'WP_THEME_URL', get_bloginfo('stylesheet_directory'));
}

if(!defined('WP_THEME_PATH')){
	define( 'WP_THEME_PATH', get_stylesheet_directory());
}

if(!defined('WP_JS_URL')) {
	define( 'WP_JS_URL' , get_bloginfo('template_url').'/js');
}

if(!defined('LANG_NAMESPACE')){
	define( 'LANG_NAMESPACE', "lh");
}


/*
 * Include needed files from the inc directory
 */
foreach ( glob( dirname( __FILE__ )."/inc/*.php" ) as $file )
    require_once( $file );


/**
 * Enqueue the needed scripts and styles in the frontend
 * Called by action "wp_enqueue_scripts"
 *
 * @author Hendrik Luehrsen
 * @since 1.0
 *
 * @return void
 */
function lh_enqueue_scripts(){
	// CSS
	wp_enqueue_style('style', WP_THEME_URL.'/style.css', NULL, '1.0', 'all');

	// Use the jQuery Version from Google
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"), false, '1.11.2', true);
	/**/

	// Register Scripts used by the theme
	wp_register_script('main', (WP_JS_URL . "/main.min.js"), array("jquery"), '1', true);

	wp_enqueue_script('main');
}
add_action("wp_enqueue_scripts", "lh_enqueue_scripts");

/**
 * Add language support
 * Called by action "after_setup_theme"
 *
 * @author Hendrik Luehrsen
 * @since 1.0
 *
 * @return void
 */
function lh_load_theme_textdomain(){
    load_theme_textdomain(LANG_NAMESPACE, get_template_directory() . '/lang');
}
add_action('after_setup_theme', 'lh_load_theme_textdomain');

/**
 * Register Menus
 * @access public
 * @return void
*/

function define_menus() {

$menus = array(
		'header_menu' => __('Header Menü'),
		'footer_menu' => __('Footer Menü'),
	);

	register_nav_menus($menus);
}
add_action('init', 'define_menus');

/**
 * Add post-thumbnails
 * Called by action "after_setup_theme"
 *
 * @author Hendrik Luehrsen
 * @since 1.0
 *
 * @return void
 */
function theme_supports(){
	add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme', 'theme_supports');

add_filter( 'use_default_gallery_style', '__return_false' );


/*
 * Images
 */
set_post_thumbnail_size(900, 600, true);
add_image_size("frontpage", 1200, 675, true);