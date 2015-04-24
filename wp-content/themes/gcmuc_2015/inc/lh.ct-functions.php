<?php 

function pickerStyles($post) {

	$styles = array();
	if(get_post_meta($post->ID, '_cp_bgcolor', true)) {
		$bg_color = get_post_meta($post->ID, '_cp_bgcolor', true);
		$styles[] = "background-color: $bg_color;";

		if(get_post_meta($post->ID, '_cp_fontcolor', true)) {
			$font_color = get_post_meta($post->ID, '_cp_fontcolor', true);
			$styles[] = "color: $font_color;";
		};
	}

	if($current_index == 0 && get_post_meta($post->ID, '_cp_bgcolor', true)){
		$styles[] = "padding-top: 66px;";
	}

	if(count($styles > 0)){
		$style_tag = 'style="' . implode(" ", $styles) . '"';
	} else {
		$style_tag = NULL;
	}	

	return $style_tag;
}

?>