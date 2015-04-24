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
            <header>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 logo">
                    <div class="container">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                            <img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2015_white-opt.svg" alt="Gamecamp Munich 2015">
                        </div>
                        <nav class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-nav clearfix">
                            <div class="container">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 single-content">
                                    <?php
                                        $header_menu = array(
                                            'theme_location'    => 'header_menu',
                                            'container'         => false,
                                            'menu_class'        => 'header-menu',
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
                
                
                
            </header>
            <div class="content-wrapper">