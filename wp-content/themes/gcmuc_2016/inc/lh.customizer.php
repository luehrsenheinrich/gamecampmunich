<?php
/*
 * Luehrsen // Heinrich - Wordpress Theme Functions
 *
 * A useful collection of great functions of daily usage in wordpress theme development.
 *
 */

class lhThemeCustomizer {

	function __construct() {
		$this->action_dispatcher();
		$this->filter_dispatcher();
		//$this->init_header();
	}

	function action_dispatcher(){
		//add_action( 'init', array( $this, 'init_custom_header' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_preview_init', array($this, 'customize_preview_js') );

	}

	function filter_dispatcher(){

	}
	
	/*private function init_header(){
		$args = array(
			'width'         => 1400,
			'height'        => 600,
			'uploads'       => true,
		);
		add_theme_support( 'custom-header', $args );
	}*/
	
	public function customize_register($wp_customize){
		$wp_customize->remove_section('colors');

		// The HEADER section
		$wp_customize->add_section( 'lh_header' , array(
		    'title'      => __( 'Header', LANG_NAMESPACE ),
		    'priority'   => 30,
		) );


		// The Header Logo Setting
		$wp_customize->add_setting("header_logo", array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control(
				new WP_Customize_Image_Control(
				$wp_customize,
				'header_logo',
				array(
		        	'label'      	=> __("Header Logo", LANG_NAMESPACE),
			        'section'    	=> 'lh_header',
			        'settings'   	=> 'header_logo',
			    )
			)
	    );

	    // The Header Logo Setting
		$wp_customize->add_setting("header_logo_vernissage", array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control(
				new WP_Customize_Image_Control(
				$wp_customize,
				'header_logo',
				array(
		        	'label'      	=> __("Header Logo Vernissage", LANG_NAMESPACE),
			        'section'    	=> 'lh_header',
			        'settings'   	=> 'header_logo_vernissage',
			    )
			)
	    );

	    // Newsletter
		$wp_customize->add_section( 'nl_snippet' , array(
		    'title'      => __( 'Newsletter', LANG_NAMESPACE ),
		    'priority'   => 30,
		) );

		$wp_customize->add_setting("nl_code", array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'nl_code',
				array(
		        	'label'      	=> __("The Newsletter Code", LANG_NAMESPACE),
		        	'description' 	=> __("The Newsletter Code", LANG_NAMESPACE),
			        'section'    	=> 'nl_snippet',
			        'settings'   	=> 'nl_code',
			        'type'			=> 'textarea'
			    )
			)
	    );

	    // FOOTER
		$wp_customize->add_section( 'lh_footer' , array(
		    'title'      => __( 'Footer', LANG_NAMESPACE ),
		    'priority'   => 30,
		) );

		$wp_customize->add_setting("footer_text", array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_text',
				array(
		        	'label'      	=> __("The footer text", LANG_NAMESPACE),
		        	'description' 	=> __("The footer text.", LANG_NAMESPACE),
			        'section'    	=> 'lh_footer',
			        'settings'   	=> 'footer_text',
			        'type'			=> 'textarea'
			    )
			)
	    );
	}    
	    
	/*public function init_custom_header(){
		$args = array(
			'width'        				=> 1200,
			'height'        			=> 400,
			'default-image' 			=> '',
		);
		//add_theme_support( 'custom-header', $args );
	}*/

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_js() {
		wp_enqueue_script( 'customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1', true );
	}
}
$lh_Theme_Customizer = new lhThemeCustomizer();
