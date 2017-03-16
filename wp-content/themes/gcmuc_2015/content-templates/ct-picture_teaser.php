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

if(has_post_thumbnail()){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "frontpage");
    $style = 'style="background-image: url('. $image[0] .');"';
} else {
    $style= NULL;
}

$float = get_post_meta($post->ID, '_float_picture_text', false);

if($float[0] == "right") {
	$textClasses = "col-xs-12 col-sm-12 col-md-4 col-md-offset-6 col-lg-4 col-lg-offset-6 single-content";
} else {
	$textClasses = "col-xs-12 col-sm-12 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 single-content";
}
?>

<div <? post_class("ct-wrapper ct-content ct-picture_teaser clearfix"); ?> id="<?=$post->post_name?>" <?=$style?>> 
	<div class="container">
		<div class="<?=$textClasses?>">
			<h1 class="the_title"><?php the_title(); ?></h1>
			<div class="the_content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>