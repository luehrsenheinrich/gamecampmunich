	<?php
/**
 * Content Name: Full Width
 * Description: A general purpose template to display text.
 * Thumbnail: img/ct-icons/ct_plaintext.png
 */

global $post, $current_index, $query;
?>

<div <?php post_class("ct-wrapper ct-content ct-fullwidth clearfix " . $mb_class); ?> id="<?php echo $post->post_name; ?>">
	<article class="container" style="<?php echo $print_styles; ?>" id="<?php echo $ct_options["anchor"]; ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content_wrapper">
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