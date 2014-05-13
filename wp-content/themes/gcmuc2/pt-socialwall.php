<?
/*
	Template Name: Social-Wall
*/
session_start();
session_destroy();
session_start();

wp_enqueue_script("angular", "//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js", NULL, "1.2.15");
wp_enqueue_script("twitwall", WP_THEME_URL."/js/twitwall.ng.min.js", array("angular"), time());

get_header("twitterwall"); ?>

<div class="clearfix pt-socialwall">

	<div ng-controller="socalwallController" ng-init="init()">

		<ul class="social_wall_list" id="social_wall"  load-images="false">
			<li class="clearfix social_wall_item {{item.image ? 'has_image' : ''}} {{item.text ? 'has_text' : ''}} {{item.type}}" style="background-image: url({{item.image}})" ng-repeat="item in socialContent | orderBy:'time':true">
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