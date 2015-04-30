<?php

class lh_shortcodes {

	public function __construct(){
		// The Button Shortcode
		add_shortcode( 'ecosystem_form', array($this, "ecosystem_form") );

		// The Accordion Shortcode for initializing a group
		add_shortcode( 'accordion', array($this, "accordion_shortcode") );

		// The Accordion-Item Shortcode
		add_shortcode( 'acc_item', array($this, "accordionItem_shortcode") );

		// The Schedule-Wrapper Shortcode
		add_shortcode( 'schedule', array($this, "schedule_shortcode") );

		// The Schedule-Wrapper Shortcode
		add_shortcode( 'sched_item', array($this, "scheduleItem_shortcode") );
	}

	/**
	 * The shortcode for the ecosystem form.
	 * Usage: [ecosystem_form]
	 *
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	public function ecosystem_form($atts){
		$atts = shortcode_atts( array(
			'foo' => 'no foo',
			'baz' => 'default baz'
		), $atts, 'ecosystem_form' );

		return '<ecosystemform class="side_margins"></ecosystemform>';
	}

	/**
	 * The shortcode wrapper for the accordion.
	 * usage: [accordion] foobar [/accordion]
	 * where foobar should be [acc_item title="bar" id="foo" controller="foobar"]captiontext[/acc_item]
	 * @param $atts none
	 * @return void
	 */
	function accordion_shortcode( $atts, $content = null ) {
		return '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * The shortcode wrapper for a accordion-item.
	 * for use within [accordion]-shortcode only.
	 * usage: [accordion][acc_item title="bar" id="foo" controller="foobar"]captiontext[/accordion]
	 * @param $atts:
	 *				- title -> just a title for the accordion item
	 * 				- id -> a specific string to seperate different items. first item should be id="titleOne" or keep it empty to set by default.
	 *				- controller -> specific string to seperate different item contents.
	 * Captiontext should be within acc_item-wrapper
	 * @return void
	 */
	function accordionItem_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'title' => '',
			'id' => '',
			'controller' => '',
		), $atts, 'teaseritem' );

		$title = $atts['title'];
		$titleID = md5($atts['title'] . "ID");
		$itemController = md5($atts['title'] . "CONTROLLER");
		$text = do_shortcode( $content );


		//Set the first-item collapsed.
		//be sure, that the title matches!
		$firstitem = '';
		if($titleID == 'titleOne')
			$firstitem = 'in';

		$output = '<div class="panel panel-default"><div class="panel-heading" role="tab" id="' . $titleID . '"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#' . $itemController . '" aria-expanded="true" aria-controls="' . $itemController . '">' . $title . '</a></h4></div><div id="' . $itemController . '" class="panel-collapse collapse ' . $firstitem . '" role="tabpanel" aria-labelledby="' . $titleID . '"><div class="panel-body">' . $text . '</div></div></div>';

		/*

		<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="' . $titleID . '">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#' . $itemController . '" aria-expanded="true" aria-controls="' . $itemController . '">
		          ' . $title . '
		        </a>
		      </h4>
		    </div>
		    <div id="' . $itemController . '" class="panel-collapse collapse ' . $firstitem . '" role="tabpanel" aria-labelledby="' . $titleID . '">
		      <div class="panel-body">
		        ' . $text . '
		      </div>
		    </div>
		  </div>

		*/

		return $output;
	}

	function schedule_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'align' => NULL,
			'date'	=> '',
		), $atts, 'schedule');

		$align = $atts['align'];
		$date = $atts['date'];
		$alignClasses = '';

		if($align == NULL) {
			return "ohne links/rechts wird das nix, kumpel";
		}

		if($align == "left" || $align == "links") {
			$alignClasses = 'col-xs-12 col-sm-12 col-md-5 col-lg-5 sched-left schedule';
		} else if ($align == "right" || $align == "rechts") {
			$alignClasses = 'col-xs-12 col-sm-12 col-md-5 col-lg-5 col-md-offset-1 col-lg-offset-1 sched-right schedule';
		} else {
			return "vertippt?";
		}

		$output = '<div class="' . $alignClasses . '"><h3>' . $date . '</h3>' . do_shortcode( $content ) . '</div>';

		return $output;


		/*

		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="margin-left:22px;">
			<h3>Samstag, 06.07.2015</h3>
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 time" style="border-radius:50%; border:1px solid; height:66px; width:66px; -webkit-backface-visibility: hidden;">5<span>Uhr</span></div>
				<div class="col-cs-11 col-sm-11 col-md-4 col-lg-4"><p>asdfsafdasdfsf</p></div>
			</div>
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="border-radius:50%; border:1px solid; height:66px; width:66px;">5<span>Uhr</span></div>
				<div class="col-cs-11 col-sm-11 col-md-4 col-lg-4"><p>asdfsafdasdfsf</p></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-md-offset-1 col-lg-offset-1">
			<h3>Samstag, 06.07.2015</h3>
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="border-radius:50%; border:1px solid; height:66px; width:66px;">5<span>Uhr</span></div>
				<div class="col-cs-11 col-sm-11 col-md-4 col-lg-4"><p>asdfsafdasdfsf</p></div>
			</div>
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="border-radius:50%; border:1px solid; height:66px; width:66px;">5<span>Uhr</span></div>
				<div class="col-cs-11 col-sm-11 col-md-4 col-lg-4"><p>asdfsafdasdfsf</p></div>
			</div>
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="border-radius:50%; border:1px solid; height:66px; width:66px;">5<span>Uhr</span></div>
				<div class="col-cs-11 col-sm-11 col-md-4 col-lg-4"><p>asdfsafdasdfsf</p></div>
			</div>
		</div>

		*/
	}

	function scheduleItem_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'time' => NULL,
			'title' => 'dude, you forgot the title :/',
		), $atts, 'schedule');

		$time = $atts['time'];
		$title = $atts['title'];
		$text = do_shortcode( $content );

		$output = '<div class="row"><div class="time"><span>' . $time . '</span></div><h4>' . $title . '</h4><p>' . $text . '</p></div>';

		return $output;
	}
}
$lh_shortcodes = new lh_shortcodes();