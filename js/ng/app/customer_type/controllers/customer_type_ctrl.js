app.controller(
	'customer_type_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, function ($scope, Restful, Services){
		'use strict';
		$scope.service = new Services();
		var url = 'api/CustomerType/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.customerType = data;
			});
		};
		$scope.init();

		$scope.edit = function(params){
			$scope.params = angular.copy(params);
			$scope.name = $scope.params.name;
			$scope.description = $scope.params.description;
			$scope.id = $scope.params.id;
			$('#customer-type-popup').modal('show');
		};
		$scope.disable = true;
		$scope.save = function(){
			var data = {name: $scope.name, description: $scope.description};
			$scope.disable = false;
			if($scope.id) {console.log($scope.id);
				Restful.put( url + $scope.id, data).success(function (data) {
					$scope.init();
					$scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
					$('#customer-type-popup').modal('hide');
					clear();
					$scope.disable = true;
				});
			}else {
				Restful.save( url , data).success(function (data) {
					$scope.init();
					$('#customer-type-popup').modal('hide');
					clear();
					$scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
					$scope.disable = true;
				});
			}
		};

		$scope.remove = function(id){
			if (confirm('Are you sure you want to delete this customer type?')) {
				console.log(url + id );
				Restful.delete(url + id ).success(function(data){console.log(data);
					$scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
					$scope.init();
				});
			}
		};

		function clear(){
			$scope.disable = true;
			$scope.name = '';
			$scope.description = '';
			$scope.id = '';
		};
	}
]);