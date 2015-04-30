<?php
/**
 * Template Name: CT Frontpage
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

if(has_post_thumbnail()){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "frontpage");
    $style = 'style="background-image: url('. $image[0] .');"';
} else {
    $style= NULL;
}

?>

<div <? post_class("ct-wrapper ct-frontpage clearfix"); ?> id="<?=$post->post_name?>" <?=$style?>>
	<div class="container">
		<div class="<?=$textClasses; ?>">
			<div class="the_content">
				<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 single-content">
					<h1><?php the_title(); ?></h1>
					
				</div>
			</div>
		</div>
	</div>
	<div class="ct-frontpage-content">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>