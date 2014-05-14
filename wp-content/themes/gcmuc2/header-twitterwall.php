<!DOCTYPE html>
<html class="no-js" ng-app="socialwallApp" ng-controller="appController" ng-init="init()">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(); ?></title>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="viewport">

<div class="page-wrapper page-wrapper-twitter">

<header>

	<div class="container">
		<div class="row">
            <div class="searchterm hidden-xs hidden-sm">{{searchterm}}</div>
			<div class="col-md-12 col-sm-12 col-xs-12 head_logo">
				<? /* <div class="menu_button visible-xs">
					<a href="#phone-menu" class="btn btn-default"><i class="fa fa-bars"></i></a>
				</div> */?>
                <h1 class="logo"><img src="<?=WP_THEME_URL?>/img/gcmuc_logo_2014.svg" alt="Games / Bavaria" title="GameCamp Munich" ng-click="requestFullscreen()"></h1>
			</div>
            <div class="clock hidden-xs hidden-sm">{{currentTime | date:"HH:mm:ss"}}</div>
		</div>
	</div>

</header>

<div class="content-wrapper">