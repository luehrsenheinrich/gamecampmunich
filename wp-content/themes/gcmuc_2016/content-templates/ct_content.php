	<?php
/**
 * Content Name: Plain Text
 * Description: A general purpose template to display text.
 * Thumbnail: img/ct-icons/ct_plaintext.png
 */

global $post, $current_index, $query;


/*$ct_options = array_merge(array(
	"font-color" 			=> null,
	"bg-color"				=> null,
	"margin-bottom"			=> null,
), (array) get_post_meta($post->ID, "_ct_options", true));


$styles = array();
foreach($ct_options as $option => $val){
	if(in_array($option, array("color", "background-color")) && $val){
		$styles[] = $option . ": " . $val;
	}
}
$print_styles = esc_attr(implode("; ", $styles));

$mb_class = $ct_options['margin-bottom'] ? "no-margin-bottom" : null;*/

$ct_options = array_merge(array(
	"anchor"	=> null,
), (array) get_post_meta($post->ID, "_ctanchor", true));

?>

<div <?php post_class("ct-wrapper ct-content clearfix " . $mb_class); ?> id="<?php echo $post->post_name; ?>">
	<article class="container" style="<?php echo $print_styles; ?>" id="<?php echo $ct_options["anchor"]; ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-offset-3 col-lg-offset-3 content_wrapper">
				<div class="the_headline">
					<h2><?php the_title(); ?></h2>
				</div>
				<div class="the_content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</article>
</div>