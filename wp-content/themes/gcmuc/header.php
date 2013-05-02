<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=1200">
    
    <meta property="fb:app_id" content="364461830288428">
    
	<title><?php wp_title(''); ?></title>
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script>window.html5 || document.write('<script src="<?=WP_JS_URL?>/libs/html5.js"><\/script>')</script>
	<![endif]-->
    <? wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
	<div class="headwrapper">
		<div class="headdiv">
        	<div class="twitterbutton">
        		<a href="https://twitter.com/gamecampmunich" class="twitter-follow-button" data-show-count="false" data-lang="de" data-show-screen-name="false">@gamecampmunich folgen</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<div class="headlogo">
				<?php if(is_single()){ ?>
					<div><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_whi.svg" alt="GameCamp Munich" title="GameCamp Munich"></a></div>
				<?php } else { ?>
					<h1><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_whi.svg" alt="GameCamp Munich" title="GameCamp Munich"></a></h1>
				<?php } ?>
			</div>
            <div class="facebookbutton">
            	<div class="fb-like" data-href="https://www.facebook.com/GameCampMunich" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false" data-colorscheme="dark"></div>
            </div>
        	<div class="headnavi">
        		<?php
					$args = array(
									"theme_location"	=>	"primary",
									"container"			=>	false,
									"menu_class"		=> 	"primary_menu clearfix",
								);
					wp_nav_menu($args);
				?>
        	</div>
		</div> <!-- headdiv -->
    </div> <!-- headwrapper -->
</header>
<div role="main" id="main">
<div id="wrapper">