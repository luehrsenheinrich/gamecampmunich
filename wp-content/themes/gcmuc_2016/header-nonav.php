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
    <div class="viewport" id="top">
        <div class="page-wrapper">
            <header class="page-header">
                <div class="container">
                    <div class="row"> 
                        <!--<div class="logo"></div>-->
                        <div class="mask" style="position:absolute;left:0;top:0;right:0;bottom:0;height:100%;">
                             <a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo WP_THEME_URL; ?>/img/mask.svg"></a>
                        </div>
                        <img src="<?php echo get_option('header_logo'); ?>">
                        <!--<div class="claim"></div>-->
                    </div>
                </div>
            </header>