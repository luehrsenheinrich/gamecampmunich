<!DOCTYPE html>
<html class="no-js" ng-app="socialwallApp" ng-controller="appController">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="viewport">

<div class="page-wrapper page-wrapper-twitter">

<header>

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 head_logo">
				<? /* <div class="menu_button visible-xs">
					<a href="#phone-menu" class="btn btn-default"><i class="fa fa-bars"></i></a>
				</div> */?>
				<?php if(is_single()){ ?>
                <div class="logo"><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2014.svg" alt="Games / Bavaria" title="GameCamp Munich"></a></div>
                <?php } else { ?>
                <h1 class="logo"><a href="<?php bloginfo('url'); ?>" title="GameCamp Munich"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2014.svg" alt="Games / Bavaria" title="GameCamp Munich"></a></h1>
                <?php } ?>
			</div>
		</div>
	</div>

</header>

<div class="content-wrapper">