<?php

/*
 * Definition of needed Constants
 */
if(!defined('WP_THEME_URL')) {
	define( 'WP_THEME_URL', get_bloginfo('stylesheet_directory'));
}
if(!defined('WP_JS_URL')) {
	define( 'WP_JS_URL' , get_bloginfo('template_url').'/js');
}
if(!defined('LANG_NAMESPACE')){
	define( 'LANG_NAMESPACE', "rfid");
}

add_editor_style();

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
	wp_enqueue_style('style', WP_THEME_URL.'/style_less.css', NULL, '2.0', 'all');

	// Use the jQuery Version from Google
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false, '1.9.1', true);

	// Register Scripts used by the theme
	wp_register_script('plugins', (WP_JS_URL . "/plugins.min.js"), array("jquery"), '1', true);
	wp_register_script('main', (WP_JS_URL . "/main.min.js"), array("jquery", "plugins"), '1', true);

	wp_enqueue_script("main");

}
add_action("wp_enqueue_scripts", "lh_enqueue_scripts");


/**
 * Define what the theme supports.
 * Called by action "after_setup_theme".
 *
 * @author Hendrik Luehrsen
 * @since 1.0
 * 
 * @access public
 * @return void
 */
function theme_supports(){
	add_theme_support( 'post-thumbnails' );
}
add_action("after_setup_theme", "theme_supports");


/*
 * Images
 */
set_post_thumbnail_size(500, 250, true);
add_image_size("single", 820, 410, true);


/*
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
 * lh_register_menus function.
 *
 * @access public
 * @return void
 */
function lh_register_menus(){
	register_nav_menus( array(
		'header_menu' 	=> __("The Header Menu", "gcmuc"),
		'mobile_trigger'=> __("The Trigger for Mobile Menu & Partners", "gcmuc"),
		'sidebar' 	=> __("The Sidebar Buttons", "gcmuc"),
		'footer' 	=> __("The Footer Links", "gcmuc"),
	) );
}
add_action('init', 'lh_register_menus');


/**
 * Define the Sidebars
 */
function define_sidebars(){
	$args = array(
		'name'          => __( 'Partner' ),
		'id'            => 'partner',
		'description'   => 'Paste here the Logos of the sponsors and orgas',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>' );
	register_sidebar($args);
	
	$args = array(
		'name'          => __( 'Buttons' ),
		'id'            => 'buttons',
		'description'   => 'Paste here the Newsletter Form',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>' );
	register_sidebar($args);
}

add_action("widgets_init", "define_sidebars"); 

