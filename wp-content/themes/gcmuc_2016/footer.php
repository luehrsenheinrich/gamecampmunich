<?php wp_footer(); ?>
			<footer class="page_footer">
				<div class="container">
					<div class="row nl_reg">
						<div class="xs-12">
							<h3><?php echo get_option('footer_text'); ?></h3>
							<div class="nl-wrapper">
								<?php echo get_option('nl_code'); ?>
							</div>
						</div>
					</div>
					<div class="row footer_nav">
						<div class="xs-12">
							<?php
		                        $args = array(
		                                "theme_location"    => "footer_nav",
		                                'menu_class'        => 'menu clearfix footer',
		                                'container'         => 'nav',
		                                'container_class'   => 'footer-menu',
		                                'fallback_cb'       => false,
		                                'depth'             => 1
		                        );
		                        wp_nav_menu($args);
		                    ?>
						</div>
					</div>
				</div>
			</footer>
		</div> <?php //page-wrapper ?>
	</div> <?php //viewport ?>
</body>
</html>
