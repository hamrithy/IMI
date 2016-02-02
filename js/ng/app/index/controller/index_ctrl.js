app.controller(
	'index_ctrl', [
	'$scope'
	, 'Restful'
	, function ($scope, Restful){
		$scope.title = 'Dashboard';
	}
]);