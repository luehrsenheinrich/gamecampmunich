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
			<h1><?php the_title(); ?></h1>
			<div class="row social-plugin-row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 social-plugin">
					<div class="fb-page" data-href="https://www.facebook.com/gamecampmunich" data-width="280" data-height="500" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/gamecampmunich"><a href="https://www.facebook.com/gamecampmunich">GameCamp Munich</a></blockquote></div></div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 social-plugin">
					<a class="twitter-timeline" href="https://twitter.com/gamecampmunich" data-widget-id="595969778101149698">Tweets von @gamecampmunich </a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
					<form action="//gamecampmunich.us4.list-manage.com/subscribe/post?u=5d3e6f58ed4d30ea452c04f3e&amp;id=8f10ee5f62" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
						<label for="mce-EMAIL">GameCamp Newsletter</label>
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
					    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_5d3e6f58ed4d30ea452c04f3e_8f10ee5f62" tabindex="-1" value=""></div>
					    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
					    </div>
					</form>
					</div>
					
					<!--End mc_embed_signup-->
				</div>
			</div>
		</div>
	</div>
</div>