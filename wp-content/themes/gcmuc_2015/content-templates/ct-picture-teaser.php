<?php
/**
 * Template Name: CT Picture Teaser
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
$style_tag = pickerStyles($post);	$style_tag = NULL;


?>

<div <? post_class("ct-wrapper ct-content clearfix"); ?> id="<?=$post->post_name?>" <?php echo $style_tag; ?>> 
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 single-content">
			<h1><?php the_title(); ?></h1>
			<div class="the_content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>