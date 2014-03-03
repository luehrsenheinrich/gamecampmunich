

</div> <? #Content-Wrapper ?>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 footer_left">
				<?php
				$defaults = array(
					'theme_location'  => 'footer',
					'container'       => 'nav',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
				);

				wp_nav_menu( $defaults );
				?>
			</div>
			<div class="col-md-4 col-sm-4 footer_right">
				<p class="disclaimer">
					Design & Development by <a href="http://www.luehrsen-heinrich.de"> Luehrsen // Heinrich </a>
				</p>
			</div>
		</div>
		<div class="row fb-like-face">
			<div class="col-md-12 col-sm-12 col-xs-sm-12">
				<div class="fb-like" data-href="https://www.facebook.com/GameCampMunich" data-width="100%" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
			</div>
		</div>
	</div>
</footer>

<div class="phone-menu-lightbox sidebar-lightbox"></div>

</div> <? #Page-Wrapper ?>

</div> <? #Viewport ?>

<?php wp_footer(); ?>

<? // Social Media Scripts ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=364461830288428";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</body>
</html>
