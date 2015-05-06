<?php
/**
 * Template Name: CT Social
 */

global $post, $current_index, $_longpage_elements;

/*
 * Make sure this file never gets called alone.
 * If so, we redirect to the post parent/home page
 */
if(!defined("IN_LONG_PAGE")) {
	if($post->post_parent){
		$url = get_permalink($post->post_parent)."#".$post->post_name;
	} else {
		$url = get_bloginfo('url');
	}
	wp_redirect($url, 301);
}

$ct_settings = get_post_meta($post->ID, "_ct_settings", true);
if(!is_array($ct_settings)){
	$ct_settings = array();
}

// padding-top: 66px;
$style_tag = pickerStyles($post);

?>

<div <? post_class("ct-wrapper ct-content clearfix"); ?> id="<?=$post->post_name?>" <?php echo $style_tag; ?>> 
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 social-plugin">
					<div class="fb-page" data-href="https://www.facebook.com/gamecampmunich" data-width="280" data-height="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/gamecampmunich"><a href="https://www.facebook.com/gamecampmunich">GameCamp Munich</a></blockquote></div></div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 social-plugin">
					<a class="twitter-timeline" href="https://twitter.com/gamecampmunich" data-widget-id="595969778101149698">Tweets von @gamecampmunich </a>
				</div>
			</div>
		</div>
	</div>
</div>