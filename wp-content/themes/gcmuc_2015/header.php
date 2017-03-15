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
    <script type="text/javascript">
    	// Check if JavaScript is available
	    document.documentElement.className =
	       document.documentElement.className.replace("no-js","js");
	</script>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <div class="viewport">
        <div class="page-wrapper">
            <header class="clearfix">
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 logo">
                        <?php if(is_front_page()) { ?>
                        	<h1 class="gcmuc-logo">
	                        	<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
									<img src="<?php echo get_option('header_logo'); ?>" alt="<?php bloginfo('name'); ?>">
	                        	</a>
                        	</h1>
                        <?php } else { ?>
                        	<div class="gcmuc-logo">
	                        	<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
									<img src="<?php echo get_option('header_logo'); ?>" alt="<?php bloginfo('name'); ?>">
	                        	</a>
                        	</div>
                        <?php } ?>
                    </div>
                </div>
                <nav class="header-nav clearfix">
                <?php
                    $header_menu = array(
                        'theme_location'    => 'header_menu',
                        'container'         => false,
                        'menu_class'        => 'header-menu',
                        'echo'              => true,
                        'fallback_cb'       => false,
                        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'link_after'     	=> '<i></i>',
                        'depth'             => 2,
                    );
                    wp_nav_menu($header_menu);
                ?>
                </nav>
            </header>
            
            <div class="content-wrapper">