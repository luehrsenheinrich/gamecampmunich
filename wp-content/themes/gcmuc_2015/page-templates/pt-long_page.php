<?php
/**
 * Template Name: Long Page
 */

define("IN_LONG_PAGE", true);
$_longpage_elements = array();

get_header();
?>


<div class="long_page_wrapper">
	<?php
	// Build the query for child pages
	$args = array(
		'post_parent'	=> get_the_ID(),
		'post_type'		=> 'page',
		'orderby'		=> 'menu_order date',
		'order'			=> 'ASC',
		'posts_per_page'=> -1,
	);
	$query = new WP_Query( $args );

	if($query->have_posts()): while ( $query->have_posts() ) : $query->the_post();
		// We will load the custom templates now


		$page_template = get_post_meta($post->ID, "_wp_page_template", true);
		if(preg_match("#(content-templates/ct-)#i", $page_template) && file_exists(trailingslashit(WP_THEME_PATH).$page_template)){
			$_longpage_elements[] = $post;
		}

	endwhile; endif;

	$query->rewind_posts();
	
	if($query->have_posts()): while ( $query->have_posts() ) : $query->the_post();
		// We will load the custom templates now


		if(in_array($post, $_longpage_elements)){
			$page_template = get_post_meta($post->ID, "_wp_page_template", true);
			$current_index = array_search($post, $_longpage_elements);
			include(trailingslashit(WP_THEME_PATH).$page_template);
		}

	endwhile; endif;
	?>
</div>
<?php
	get_footer();
?>