var twitter_json_search = wpData.themeRoot + "/ng.socialwall/twitter/search.php";
var flickr_json_search = wpData.themeRoot + "/ng.socialwall/flickr/search.php";

var app = angular.module('socialwallApp', ['relativeDate', 'ngAnimate']);
var searchterm = "%23gcmuc";

app.controller("appController", function($scope, $http, $interval){
	$scope.currentTime = 0;
	$scope.searchterm = decodeURIComponent(searchterm);

	$scope.init = function(){
		console.log("test");
		$interval(function(){
			$scope.getCurrentTime();
		}, 1000);
	}

	$scope.requestFullscreen = function(){
		$("body").requestFullScreen();
	}

	$scope.getCurrentTime = function(){
		$scope.currentTime = new Date();
	}

});

app.controller("socialwallController", function($scope, $http, $interval, $sce){
	$scope.shownItems = [];
	$scope.socialContent = [];
	$scope.max_id_str = 0;
	$scope.socialWall = null;
	$scope.loading = false;

	$scope.init = function(){

		$scope.socialWall = $("#social_wall");

		var opts = {
			itemSelector: ".social_wall_item",
			masonry: {
				columnWidth: ".twitter",
			},
		};
		$scope.socialWall.isotope(opts);

		$scope.loadContent();
		$scope.runner = $interval(function(){
			$scope.loadContent();
		}, 30000)


		$scope.$watchCollection("socialContent", function(newValue, oldValue){
			setTimeout(function(){
				//$scope.socialWall.isotope('destroy');
				$scope.socialWall.isotope('reloadItems').isotope(opts);
			}, 0);
		});
	}

	$scope.loadContent = function(){
		$scope.startLoading();
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
			if(typeof(data.errors) != "undefined"){
				return false;
			}

			$scope.max_id_str = data.search_metadata.max_id_str;

			for(i in data.statuses){
				var t = data.statuses[i];

				var tmp_image = null;

				if(typeof(t.entities.media) != "undefined"){
					tmp_image = t.entities.media[0].media_url;
				}

				console.log();

				if(typeof(t.retweeted_status) === "undefined"){
					$scope.addSocialContent({
						id: t.id_str,
						user_name: "@" + t.user.screen_name,
						display_name: t.user.name,
						user_image: t.user.profile_image_url,
						image: tmp_image,
						time: Date.parse(t.created_at),
						text: $sce.trustAsHtml(t.text),
						type: "twitter",
					});
				}
			}

			$scope.stopLoading();
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
			if(data.stat == "fail"){
				return false;
			};
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

			$scope.stopLoading();
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

	$scope.startLoading = function(){
		$scope.loading = true;
	}

	$scope.stopLoading = function(){
		clearTimeout($scope.loadingDelayer);
		$scope.loadingDelayer = setTimeout(function(){
			$scope.loading = false;
		}, 10)
	}
});


app.controller("socialItemCtrl", function($scope, $http, $interval){
	$scope.thisItem = {};
	$scope.thisItem.textHidden = false;
	$scope.baseInterval = 30000;

	$scope.itemInit = function(){
		$scope.thisItem = $scope.$parent.item;

		var tick = $scope.baseInterval * Math.random() + $scope.baseInterval;

		if($scope.thisItem.text != null && $scope.thisItem.image != null){
			$interval(function(){
				$scope.toggleImage();
			}, tick);
		}
	}

	$scope.toggleImage = function(){
		$scope.thisItem.textHidden = !$scope.thisItem.textHidden;
	}
});


(function() {
    var
        fullScreenApi = {
            supportsFullScreen: false,
            isFullScreen: function() { return false; },
            requestFullScreen: function() {},
            cancelFullScreen: function() {},
            fullScreenEventName: '',
            prefix: ''
        },
        browserPrefixes = 'webkit moz o ms khtml'.split(' ');

    // check for native support
    if (typeof document.cancelFullScreen != 'undefined') {
        fullScreenApi.supportsFullScreen = true;
    } else {
        // check for fullscreen support by vendor prefix
        for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
            fullScreenApi.prefix = browserPrefixes[i];

            if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
                fullScreenApi.supportsFullScreen = true;

                break;
            }
        }
    }

    // update methods to do something useful
    if (fullScreenApi.supportsFullScreen) {
        fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';

        fullScreenApi.isFullScreen = function() {
            switch (this.prefix) {
                case '':
                    return document.fullScreen;
                case 'webkit':
                    return document.webkitIsFullScreen;
                default:
                    return document[this.prefix + 'FullScreen'];
            }
        }
        fullScreenApi.requestFullScreen = function(el) {
            return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
        }
        fullScreenApi.cancelFullScreen = function(el) {
            return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
        }
    }

    // jQuery plugin
    if (typeof jQuery != 'undefined') {
        jQuery.fn.requestFullScreen = function() {

            return this.each(function() {
                if (fullScreenApi.supportsFullScreen) {
                    fullScreenApi.requestFullScreen(this);
                }
            });
        };
    }

    // export api
    window.fullScreenApi = fullScreenApi;
})();