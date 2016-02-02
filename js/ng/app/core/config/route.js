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
				controller: 'index_ctrl'
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