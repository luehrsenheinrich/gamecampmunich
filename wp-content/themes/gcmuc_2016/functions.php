<?php

/*
 * Definition of needed Constants
 */
if(!defined('WP_THEME_URL')) {
	define( 'WP_THEME_URL', get_stylesheet_directory_uri());
}

if(!defined('WP_THEME_PATH')){
	define( 'WP_THEME_PATH', get_stylesheet_directory());
}

if(!defined('WP_JS_URL')) {
	define( 'WP_JS_URL' , get_template_directory_uri().'/js');
}

if(!defined('LANG_NAMESPACE')){
	define( 'LANG_NAMESPACE', LANG_NAMESPACE);
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

	// Register Scripts used by the theme
	wp_register_script('main', (WP_JS_URL . "/main.min.js"), array("jquery"), '2', true);

	wp_enqueue_script('main');

	wp_localize_script('main', 'lh', array(
		'ajaxurl'		=> admin_url('admin-ajax.php'),
		'themeurl'		=> WP_THEME_URL,
		'prev'			=> __("Previous (Left arrow key)", LANG_NAMESPACE),
		'next'			=> __('Next (Right arrow key)', LANG_NAMESPACE),
		'counter'		=> __('<span class="mfp-counter">%curr% of %total%</span>', LANG_NAMESPACE)
	));
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
 * lh_register_menus function.
 *
 * @access public
 * @return void
 */
function lh_register_menus(){
	register_nav_menus( array(
		'main_nav' 				=> __("Main", "gcm"),
		'main_nav_vernissage'	=> __("Main Vernissage", "gcm");
		'footer_nav'			=> __("Footer", "gcm")
	) );
}
add_action('init', 'lh_register_menus');