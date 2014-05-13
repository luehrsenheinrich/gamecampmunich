var twitter_json_search = "/wp-content/themes/gcmuc2/twitter/gcmuc_search.php";
var flickr_json_search = "/wp-content/themes/gcmuc2/flickr/search.php";

var app = angular.module('socialwallApp', ['relativeDate']);
var searchterm = "%23gcmuc";


app.controller("appController", function($scope, $http){

});

app.controller("socalwallController", function($scope, $http){
	$scope.shownItems = [];
	$scope.socialContent = [];
	$scope.max_id_str = 0;

	$scope.init = function(){
		$scope.loadContent();
		$scope.runner = setInterval(function(){
			$scope.loadContent();
		}, 10000)
	}

	$scope.loadContent = function(){
		$scope.loadTwitter();
		$scope.loadFlickr();
	};

	// Load stuff from twitter
	$scope.loadTwitter = function(){

		var httpUrl = twitter_json_search + "?callback=JSON_CALLBACK";
		var config = {
			params: {
				q: searchterm,
			},
		};

		if($scope.shownItems.length > 0 && $scope.max_id_str != 0){
			config.params.since_id = $scope.max_id_str
		}

		$http.jsonp(httpUrl, config).success(function(data){
			$scope.max_id_str = data.search_metadata.max_id_str;

			for(i in data.statuses){
				var t = data.statuses[i];

				var tmp_image = null;

				if(typeof(t.entities.media) != "undefined"){
					tmp_image = t.entities.media[0].media_url;
				}

				$scope.addSocialContent({
					id: t.id_str,
					user_name: "@" + t.user.screen_name,
					display_name: t.user.name,
					user_image: t.user.profile_image_url,
					image: tmp_image,
					time: Date.parse(t.created_at),
					text: t.text,
					type: "twitter",
				})
			}
		});
	};

	// Load stuff from flickr
	$scope.loadFlickr = function(){

		var httpUrl = flickr_json_search + "?callback=JSON_CALLBACK";
		var config = {
			params: {
				q: searchterm.replace("%23", ""),
			},
		};

		$http.jsonp(httpUrl, config).success(function(data){
			for(i in data.photos.photo){
				var p = data.photos.photo[i];

				$scope.addSocialContent({
					id: p.id,
					user_name: null,
					display_name: p.ownername,
					user_image: null,
					image: p.url_l,
					time: p.dateupload*1000,
					text: null,
					type: "flickr",
				})
			}
		});
	};


	$scope.addSocialContent = function(obj){
		var item = {
			id: obj.id,
			user_name: obj.user_name,
			display_name: obj.display_name,
			user_image: obj.user_image,
			image: obj.image,
			time: obj.time,
			type: obj.type,
			text: obj.text,
		}

		if($scope.shownItems.indexOf(item.type+"_"+item.id) == -1){
			$scope.socialContent.unshift(item);
			$scope.shownItems.unshift(item.type+"_"+item.id);
		}
	};
});