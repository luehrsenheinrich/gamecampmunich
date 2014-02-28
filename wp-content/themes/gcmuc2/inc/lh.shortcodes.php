<?php


class lh_shortcodes {

	public function __construct(){

		// The Button Shortcode
		add_shortcode( 'button', array($this, "button") );

		// The Featureset Shortcode
		add_shortcode( 'featureset_row', array($this, "featureset_row") );
		add_shortcode( 'featureset', array($this, "featureset") );
		
		// The Flickr Galleryteaser Shortcode
		add_shortcode( 'flickr_row', array($this, "flickr_row") );
		add_shortcode( 'flickr_teaser', array($this, "flickr_teaser") );

		// Remove empty tags in shortcodes
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 99);
		add_filter( 'the_content', 'shortcode_unautop',100 );
	}

	/**
	 * button function.
	 * Usage: [button]Button Text[/button]
	 * Attributes: href - The button link target; type - the color of the button (orange or blue)
	 *
	 * @access public
	 * @param mixed $atts
	 * @param mixed $content (default: NULL)
	 * @return void
	 */
	public function button($atts, $content = NULL){
		extract( shortcode_atts( array(
			'href' => '#',
			'type' => "orange", // orange, blue
		), $atts ) );

		if($type == "blue"){
			$typeclass = "blue_button";
		} else {
			$typeclass = NULL;
		}

		$html = '<a href="'.$href.'" class="lh_btn '.$typeclass.'">'.$content.'</a>';


		return $html;
	}

	/**
	 * Featureset function.
	 *
	 * @access public
	 * @param mixed $atts
	 * @param mixed $content (default: NULL)
	 * @return void
	 */

	public function featureset_row($atts, $content = NULL){
		$html  = '<div class="lh_featureset row">';

		$html .= do_shortcode(trim($content));

		$html .= '</div>';

		return $html;
	}
	
	public function featureset($atts, $content = NULL){
		extract( shortcode_atts( array(
			'col'	=> "6", // 6, 12
		), $atts ) );

		$html  = '<div class="col-xs-12 col-sm-'.$col.' col-md-'.$col.' shortcode_content"><div class="featureset-inner">';

		$html .= do_shortcode(trim($content));

		$html .= '</div></div>';

		return $html;
	}
	
	/**
	 * Gallery teaser function.
	 *
	 * @access public
	 * @param mixed $atts
	 * @param mixed $content (default: NULL)
	 * @return void
	 */

	public function flickr_row($atts, $content = NULL){
		$html  = '<div class="lh_flickr_teaser row">';

		$html .= do_shortcode(trim($content));

		$html .= '</div>';

		return $html;
	}
	
	public function flickr_teaser($atts, $content = NULL){
		extract( shortcode_atts( array(
			'col'	=> "4", // 4, 6
			'img'	=> "http://farm8.staticflickr.com/7387/9142921049_26a44b7513.jpg", // img url
			'href'	=> "http://www.flickr.com/groups/gcmuc09/pool",
		), $atts ) );

		$html  = '<div class="col-xs-12 col-sm-'.$col.' col-md-'.$col.' shortcode_content"><a href="'.$href.'" target="_blank"><div style="background-image: url('.$img.');" class="featureset-inner">';

		$html .= do_shortcode(trim($content));

		$html .= '</div></a></div>';

		return $html;
	}

}
$lh_shortcodes = new lh_shortcodes();