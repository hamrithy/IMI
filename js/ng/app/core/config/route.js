app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
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
			.state('/customer_type', {
				url: '/customer_type',
				templateUrl: 'js/ng/app/customer_type/views/index.html',
				controller: 'customer_type_ctrl'
			})
			.state('/user', {
				url: '/user',
				templateUrl: 'js/ng/app/user/views/index.html',
				controller: 'user_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);