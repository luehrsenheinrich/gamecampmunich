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
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=206538582722215";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</body>
</html>