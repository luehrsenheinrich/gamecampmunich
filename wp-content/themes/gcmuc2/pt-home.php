<?php
/*
 * Template Name: Home
 */

get_header();

?>

	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
			<div class="row">
	
		    	<div <?php post_class("col-md-12 the_content"); ?>>
		        	<?php the_content(); ?>
		        </div>
	
			</div>
	
	    <?php endwhile; endif; ?>
	</div>

<?php

get_footer();

?>