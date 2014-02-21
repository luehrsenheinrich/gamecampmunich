<?php

get_header();

?>

	<div class="container content-page">
		<?php
		
		 if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		 
		 	if(has_post_thumbnail()){
		        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "single");
		    } else {
		        $image = NULL;
		    }
		 
		 ?>
	
			<div class="row">
				
				<div <?php post_class("col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 the_thumbnail"); ?>>
		        	<img src="<?=$image[0]?>" />
		        </div>
				
		    	<div <?php post_class("col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 the_headline"); ?>>
		        	<h1><?php the_title(); ?></h1>
		        </div>
	
			</div>
	
			<div class="row">
	
		    	<div <?php post_class("col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 the_content"); ?>>
		        	<?php the_content(); ?>
		        </div>
	
			</div>
	
	    <?php endwhile; endif; ?>
	</div>

<?php

get_footer();

?>