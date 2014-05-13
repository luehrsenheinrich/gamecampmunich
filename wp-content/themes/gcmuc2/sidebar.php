<div class="sidebar hidden-xs clearfix" id="collapse-parent">
	<div class="sb-position1 sidebar-buttons">
		
		<?php
			/*
			 * Call the head nav menu
			 */
	
			$args = array(
					"theme_location"	=> "sidebar",
					'menu_class'     	=> 'menu clearfix',
					'container'      	=> 'div',
					'fallback_cb'	 	=> false,
					'depth'				=> 1
			);
	
			wp_nav_menu($args);
		?>
		
	</div>
	<div class="sb-position2 newsletter" id="nl_collapse">
		<!-- Begin MailChimp Signup Form -->
		
		<?php dynamic_sidebar( 'buttons' ); ?>
		
		<!--End mc_embed_signup-->
	</div>
	<div class="sb-position3 partner">
		<?php dynamic_sidebar( 'partner' ); ?>
	</div>
</div>