			</div><? // content-wrapper ?>
			
			<footer>
				<div class="container">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer-nav clearfix">
						<nav class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-nav clearfix">
                            <div class="container">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 single-content">
                                    <?php
                                        $header_menu = array(
                                            'theme_location'    => 'footer_menu',
                                            'container'         => false,
                                            'menu_class'        => 'footer_menu',
                                            'echo'              => true,
                                            'fallback_cb'       => false,
                                            'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'link_after'      => '<i></i>',
                                            'depth'             => 2,
                                        );
                                        wp_nav_menu($header_menu);
                                    ?>
                                </div>
                            </div>
                        </nav>
                    </div>
				</div>
			</footer>
		</div><? // page-wrapper ?>
	</div><? // viewport ?>
	<?php wp_footer(); ?>
</body>
</html>