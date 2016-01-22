app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/', {
				url: '/',
				templateUrl: 'js/ng/app/stock/partials/index.html',
                controller: 'stock_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
