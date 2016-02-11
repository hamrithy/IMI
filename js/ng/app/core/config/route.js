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
			// staff route
			.state('/staff_list', {
				url: '/staff_list',
				templateUrl: 'js/ng/app/staff_list/views/index.html',
				controller: 'staff_list_ctrl'
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
			// product route
			.state('/product_type', {
				url: '/product_type',
				templateUrl: 'js/ng/app/products_type/views/index.html',
				controller: 'products_type_ctrl'
			})
			.state('/product_list', {
				url: '/product_list',
				templateUrl: 'js/ng/app/products_list/views/index.html',
				controller: 'products_list_ctrl'
			})
			// vendor route
			.state('/vendor_type', {
				url: '/vendor_type',
				templateUrl: 'js/ng/app/vendor_type/views/index.html',
				controller: 'vendor_type_ctrl'
			})
			.state('/vendor_list', {
				url: '/vendor_list',
				templateUrl: 'js/ng/app/vendor_list/views/index.html',
				controller: 'vendor_list_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);