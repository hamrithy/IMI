app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		// remember mentioned function for later use
		app.registerCtrl = $urlRouterProvider.register;
		app.resolveScriptDeps = function(dependencies){
			return function($q,$rootScope){
				var deferred = $q.defer();
				$script(dependencies, function() {
					// all dependencies have now been loaded by $script.js so resolve the promise
					$rootScope.$apply(function()
					{
						deferred.resolve();
					});
				});

				return deferred.promise;
			}
		};
		$stateProvider.
			state('/', {
				url: '/',
				templateUrl: 'js/ng/app/index/partials/index.html',
				//views: {
				//	"lazyLoadView": {
				//		controller: 'index_ctrl', // This view will use AppCtrl loaded below in the resolve
				//		templateUrl: 'js/ng/app/index/partials/index.html'
				//	}
				//},
				//resolve: { // Any property in resolve should return a promise and is executed before the view is loaded
				//	loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
				//		// you can lazy load files for an existing module
				//		$ocLazyLoad.load('js/ng/app/index/controller/index_ctrl.js');
				//		console.log('load', $ocLazyLoad.load('js/ng/app/index/controller/index_ctrl.js') );
				//	}]
				//}
				//templateUrl: 'js/ng/app/index/partials/index.html',
				//resolve: {
				//	load: function () {
				//		controllers(['js/ng/app/index/controller/index_ctrl.js']) //you can load multiple
				//		// controller files
				//	}
				//}
				//resolve: {deps: app.resolveScriptDeps(['js/ng/app/index/controller/index_ctrl.js'])},
				//controller: 'index_ctrl',
			})
			.state('/stock', {
				url: '/stock',
				templateUrl: 'js/ng/app/stock/partials/index.html',
				//controller: 'stock_ctrl'
			})
			.state('/account', {
				url: '/account',
				templateUrl: 'js/ng/app/account/partials/manage.html',
				controller: 'manage_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);

app.controller('LargeAppController',function(){});