<?
/*
	Template Name: Social-Wall
*/
session_start();
session_destroy();
session_start();

wp_enqueue_script("isotope", WP_THEME_URL . "/ng.socialwall/isotope.js", array("jquery"), "2.0.0", true);
wp_enqueue_script("angular", "//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js", NULL, "1.2.15", true);
wp_enqueue_script("angularAnimate", "//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-animate.min.js", NULL, "1.2.15", true);
wp_enqueue_script("twitwall", WP_THEME_URL."/ng.socialwall/twitwall.ng.min.js", array("angular", "jquery"), "1", true);
wp_localize_script("twitwall", "wpData", array(
	"themeRoot"			=> WP_THEME_URL,
));

get_header("twitterwall"); ?>

<div class="clearfix pt-socialwall">

	<div ng-controller="socialwallController" ng-init="init()">

		<ul class="social_wall_list" id="social_wall">

			<li class="clearfix social_wall_item {{item.image ? 'has_image' : ''}} {{item.textHidden ? 'text_hidden' : ''}} {{item.text ? 'has_text' : ''}} {{item.type}}" style="background-image: url({{item.image}})" ng-repeat="item in socialContent | orderBy:'time':true | limitTo:20" ng-animate ng-controller="socialItemCtrl" ng-init="itemInit()">
				<div class="main">
					<div class="user clearfix">
						<img ng-show="item.user_image" ng-src="{{item.user_image}}" />
						<h3>{{item.display_name}}</h3>
						{{item.user_name}}
					</div>
					<div ng-show="item.text" class="text">
						{{item.text}}
					</div>
					<div class="meta">
						<span class="text">{{item.time | date:'dd.MM.yy HH:mm'}}</span>
						<span class="fa-stack">
							<i class="fa fa-square fa-stack-2x"></i>
							<i class="fa fa-{{item.type}} fa-inverse fa-stack-1x"></i>
						</span>
					</div>
				</div>
			</li>
		</ul>

    </div>

	<div id="sponsoren" class="sp_right">
		<div id="upcoming_sessions">
        </div>

        <div id="running_sessions">
        </div>
    </div>

</div><!-- content -->

<? get_footer(); ?>