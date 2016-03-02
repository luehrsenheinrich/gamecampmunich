<?php
/**
 * Template Name: One Page Vernissage
 */

define("IN_LONG_PAGE", true);
$_longpage_elements = array();
global $post;

get_header('vernissage');

?>

<div class="one-page-wrapper">
	<?php
	// Build the query for child pages with content templates
	$args = array(
		'post_parent'	=> get_the_ID(),
		'post_type'		=> 'page',
		'orderby'		=> 'menu_order date',
		'order'			=> 'ASC',
		'posts_per_page'=> -1,
		'meta_key'		=> '_lh_content_template',
	);
	$query = new WP_Query( $args );
	$current_index = 0;
	if($query->have_posts()): while ( $query->have_posts() ) : $query->the_post();
		// We will load the custom templates now
		$page_template = get_post_meta($post->ID, "_lh_content_template", true); // Get the template file path (relative to the theme root)

		if(file_exists(trailingslashit(WP_THEME_PATH).$page_template)){ // Check if the template file really exists
			load_template(trailingslashit(WP_THEME_PATH).$page_template, false); // Load the template file
			$current_index++; // Interate the index
		}
	endwhile; endif;
	?>
</div>

<?php
	get_footer();
?>