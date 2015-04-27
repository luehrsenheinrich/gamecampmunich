			</div><? // content-wrapper ?>
			
			<footer>
				<div class="container">
					<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 footer-nav clearfix">

                                    <?php
                                        $footer_menu = array(
                                            'theme_location'    => 'footer_menu',
                                            'container'         => false,
                                            'menu_class'        => 'footer_menu',
                                            'echo'              => true,
                                            'fallback_cb'       => false,
                                            'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'link_after'      => '<i></i>',
                                            'depth'             => 2,
                                        );
                                        wp_nav_menu($footer_menu);
                                    ?>
                    </div>
				</div>
			</footer>
		</div><? // page-wrapper ?>
	</div><? // viewport ?>
	<?php wp_footer(); ?>
</body>
</html>