app.controller(
	'user_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, function ($scope, Restful, Services){
		'use strict';
		$scope.service = new Services();
		var url = 'api/User/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.users = data;
			});
		};
		$scope.init();

		$scope.edit = function(params){
			$scope.params = angular.copy(params);
			$scope.user_name = $scope.params.user_name;
			$scope.id = $scope.params.id;
			$('#user-popup').modal('show');
		};
		$scope.disable = true;
		$scope.save = function(){
			$scope.disable = false;
			if($scope.id) {
				Restful.put( url + $scope.id, $scope.params).success(function (data) {
					$scope.init();console.log(data);
					$scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
					$('#user-popup').modal('hide');
					clear();
					$scope.disable = true;
				});
			}else {
				var data = {user_name: $scope.user_name, user_password: $scope.user_password};
				Restful.save( url , data).success(function (data) {
					if(data.id){
						$scope.init();
						console.log('save: ', data);
						$('#user-popup').modal('hide');
						clear();
						$scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
					}else{
						$scope.disable = true;
						$scope.error = true;
					}

				});
			}
		};

		$scope.remove = function(id){
			if (confirm('Are you sure you want to delete this User?')) {
				Restful.delete(url + id ).success(function(data){
					$scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
					$scope.init();
				});
			}
		};

		function clear(){
			$scope.error = false;
			$scope.disable = true;
			$scope.user_name = '';
			$scope.user_password = '';
			$scope.id = '';
		};
	}
]);