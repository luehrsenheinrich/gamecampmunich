<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="viewport">

<div class="phone-menu-wrapper visible-xs">
	<?php
		/*
		 * Call the head nav menu
		 */

		$args = array(
				"theme_location"	=> "header_menu",
				'menu_class'     	=> 'menu clearfix',
				'container'      	=> 'nav',
				'container_class'   => 'phone-menu',
				'link_before'		=> '<i class="fa fa-caret-right"></i>',
				'fallback_cb'	 	=> false,
				'depth'				=> 2
		);

		wp_nav_menu($args);
	?>

</div>

<div class="page-wrapper">

	<?php get_template_part("sidebar"); ?>

<header>

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 head_logo">
				<div class="menu_button visible-xs">
					<a href="#phone-menu" class="menu-trigger-button"><i class="fa fa-bars"></i> Menu</a>
				</div>
				<?php if(is_single()){ ?>
                <div class="logo"><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2014.svg" alt="GameCamp Munich" title="GameCamp Munich"></a></div>
                <?php } else { ?>
                <h1 class="logo"><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2014.svg" alt="GameCamp Munich" title="GameCamp Munich"></a></h1>
                <?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 hidden-xs header-menu">
			
				<?php
					/*
					 * Call the head nav menu
					 */
			
					$args = array(
							"theme_location"	=> "header_menu",
							'menu_class'     	=> 'menu clearfix',
							'container'      	=> 'nav',
							'container_class'   => 'standard-menu',
							'fallback_cb'	 	=> false,
							'depth'				=> 2
					);
			
					wp_nav_menu($args);
				?>
			
			</div>
		</div>
	</div>

</header>

<div class="content-wrapper">