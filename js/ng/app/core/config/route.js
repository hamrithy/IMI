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
			// customer route
			.state('/customer_list', {
				url: '/customer_list',
				templateUrl: 'js/ng/app/customer_list/views/index.html',
				controller: 'customer_list_ctrl'
			})
			.state('/customer_type', {
				url: '/customer_type',
				templateUrl: 'js/ng/app/customer_type/views/index.html',
				controller: 'customer_type_ctrl'
			})
			.state('/create_invoice', {
				url: '/create_invoice',
				templateUrl: 'js/ng/app/create_invoice/views/index.html',
				controller: 'create_invoice_ctrl'
			})
			.state('/received_payment', {
				url: '/received_payment',
				templateUrl: 'js/ng/app/received_payment/views/index.html',
				controller: 'received_payment_ctrl'
			})
			.state('/sale_enter_sale_receive', {
				url: '/sale_enter_sale_receive',
				templateUrl: 'js/ng/app/sale_enter_sale_receive/views/index.html',
				controller: 'sale_enter_sale_receive_ctrl'
			})
			// user route
			.state('/user', {
				url: '/user',
				templateUrl: 'js/ng/app/user/views/index.html',
				controller: 'user_ctrl'
			})
			// doctor route
			.state('/doctor_type', {
				url: '/doctor_type',
				templateUrl: 'js/ng/app/doctor_type/views/index.html',
				controller: 'doctor_type_ctrl'
			})
			.state('/doctor_list', {
				url: '/doctor_list',
				templateUrl: 'js/ng/app/doctor_list/views/index.html',
				controller: 'doctor_list_ctrl'
			})
			// stock route
			.state('/product_type', {
				url: '/product_type',
				templateUrl: 'js/ng/app/stock_type/views/index.html',
				controller: 'stock_type_ctrl'
			})
			.state('/product_list', {
				url: '/product_list',
				templateUrl: 'js/ng/app/stock_list/views/index.html',
				controller: 'stock_list_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);