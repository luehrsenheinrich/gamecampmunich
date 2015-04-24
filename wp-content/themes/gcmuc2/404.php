<?php

/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();

?>

	<div class="container content-page error-wrapper">
			
			<div class="row">
		    	<div class="col-md-12 col-sm-12 col-xs-12 the_headline">
		        	<h1>Does this Page exist?</h1>
		        </div>
	
			</div>
	
			<div class="row">
	
		    	<div class="col-md-12 col-sm-12 col-xs-12 the_content">
		        	<p><img src="<?=WP_THEME_URL?>/img/rageface_no_404.jpg" /></p>
		        </div>
	
			</div>
	
	</div>

<?php

get_footer();

?>