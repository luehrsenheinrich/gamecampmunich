<?php
/**
 * Template Name: CT Sponsors
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

<div <? post_class("ct-wrapper ct-sponsors clearfix"); ?> id="<?=$post->post_name?>" <?php echo $style_tag; ?>> 
	<div class="container">
		<div class="col-xs-12 single-content">
			<div class="the_content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>