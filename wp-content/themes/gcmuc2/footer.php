

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
	</div>
</footer>

<div class="phone-menu-lightbox"></div>

</div> <? #Page-Wrapper ?>

</div> <? #Viewport ?>

<?php wp_footer(); ?>
</body>
</html>
