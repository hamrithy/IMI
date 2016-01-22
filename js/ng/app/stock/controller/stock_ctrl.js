app.controller(
	'stock_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, function ($scope, Restful, Services){
		$scope.service = new Services();
		$scope.staff = {};
		$scope.product = {};
		$scope.qty_in_stock = 0;
		function initData() {
			Restful.get('api/Stock').success(function (data) {
				$scope.products = data;
			});
			Restful.get('api/Staff').success(function (data) {
				$scope.staffs = data;
			});
		};
		initData();
		var jQueryDatePickerOpts = {
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			showButtonPanel: false,
			showAnim: ''
		};
		$("#jQueryDatePicker").datepicker(jQueryDatePickerOpts);

		// Event for calculate qty with price when input
		$scope.calculate = function() {
			$scope.total = ($scope.qty * $scope.price).toFixed(2) ;
		};

		$scope.listData = [];
		// functional get total of all products
		$scope.getTotal = function(){
			$scope.sub_total = 0;
			for (var i = 0, l = $scope.listData.length; i < l; i++) {
				console.log($scope.listData[i]);
				var obj = $scope.listData[i];
				//var sub_total = obj.qty * obj.price;
				$scope.sub_total = $scope.sub_total + (obj.qty * obj.price);
			}
			$scope.sub_total.toFixed(2);
		};

		// calculate money
		$scope.input = function(){
			if($scope.sub_total){
				$scope.remaining = ($scope.sub_total - $scope.input_money).toFixed(2);
			}else{
				$scope.remaining = '';
			}
		};

		$scope.save = function(){
			if($scope.request_by = ''){
				alert('nnono');
			}
			console.log($scope.listData.length);
			if($scope.listData.length == 0){
				return $scope.service.message(
					'Warning:','No Product In List. Please Add Product.','warning'
				);
			}
			return;
			Restful.patch('api/Stock', $scope.listData).success(function (data) {
				//$.notify({
				//	title: '<strong>Success: </strong>',
				//	message: 'Update Success.'
				//}, {
				//	type: 'success'
				//});
				console.log(data);
			});
		};

		$scope.add = function(){
			var id = $('#pId').val();
			if(!id){
				return $scope.service.message(
					'Warning:','please input product name with id','warning'
				);
			}
			if(!angular.isDefined( $scope.qty ) ){
				return $scope.service.message(
					'warning:','Please Input Qty.','warning'
				);
			}
			if(!angular.isDefined( $scope.price ) ){
				return $scope.service.message(
					'warning:','Please Input Price.','warning'
				);
			}
			console.log('qty in stock => ',$scope.qty_in_stock);
			// check if qty has in stock add
			if($scope.qty < $scope.qty_in_stock ) {
				// check if exist in list
				for (var i = 0, l = $scope.listData.length; i < l; i++) {
					var obj = $scope.listData[i];
					if (obj.pid === id) {
						var old_qty = parseInt(obj.qty) + parseInt($scope.qty);
						console.log('old =>', old_qty);
						console.log('in stock: ',$scope.qty_in_stock);
						// check again in existing object
						if( old_qty < $scope.qty_in_stock){
							obj.qty = old_qty;
							obj.price = $scope.price;
							obj.total = obj.qty * obj.price;
							$scope.getTotal();
							clear();
							return;
						}else{
							return  $scope.service.message(
								'warning:','OPP! Out Off Stock. You Have Only ' + $scope.qty_in_stock +' Unit In Stock.','warning'
							);
						}
					}
				}
				$scope.listData.push({
					pid: $('#pId').val(),
					p_name: $('#product_name').val(),
					desciption: $('#description').val(),
					qty: $scope.qty,
					price: $scope.price,
					total: $scope.total
				});
				$scope.getTotal();
				clear();
			}else{
				return  $scope.service.message(
					'warning:','OPP! Out Off Stock. You Have Only ' + $scope.qty_in_stock +' Unit In Stock.','warning'
				);
			}
		};

		$scope.edit = function(params){
			$scope.editProduct = params;
			console.log(params);
			$('#popup').modal('show');
		};
		$scope.remove = function($index){
			$scope.listData.splice($index, 1);
		};
		function clear(){
			$('#pId').val('');
			$('#product_name').val('');
			$('#description').val('');
			$scope.qty = undefined;
			$scope.price = undefined;
			$scope.total = '';
		};

			$scope.address = {};
			$scope.refreshAddresses = function(address) {
				var params = {address: address, sensor: false};
				return Restful.get(
					'api/Staff',
					{params: params}
				).then(function(data) {
						$scope.staffs = data;
						console.log(data);
					});
			};

	}
]);
/**
 * AngularJS default filter with the following expression:
 * "person in people | filter: {name: $select.search, age: $select.search}"
 * performs a AND between 'name: $select.search' and 'age: $select.search'.
 * We want to perform a OR.
 */
app.filter('propsFilter', function() {
	return function(items, props) {
		var out = [];

		if (angular.isArray(items)) {
			items.forEach(function(item) {
				var itemMatches = false;

				var keys = Object.keys(props);
				for (var i = 0; i < keys.length; i++) {
					var prop = keys[i];
					var text = props[prop].toLowerCase();
					if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
						itemMatches = true;
						break;
					}
				}

				if (itemMatches) {
					out.push(item);
				}
			});
		} else {
			// Let the output be the input untouched
			out = items;
		}

		return out;
	}
});