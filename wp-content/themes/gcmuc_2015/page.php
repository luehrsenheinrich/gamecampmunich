<?php

get_header();

?>

	<div class="container content-page">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
			<div class="row">
	
		    	<div <?php post_class("col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 the_headline"); ?>>
		        	<h1><?php the_title(); ?></h1>
		        </div>
	
			</div>
	
			<div class="row">
		    	<div <?php post_class(""); ?>>
		        	<?php the_content(); ?>
		        </div>
	
			</div>
	
	    <?php endwhile; endif; ?>
	</div>

<?php

get_footer();

?>