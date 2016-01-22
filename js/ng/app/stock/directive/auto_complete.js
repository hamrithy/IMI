app.directive('autoComplete',[
	'Restful',
	'$timeout',
	'$scope',
	function(Restful,$timeout,$scope){
	return {
		restrict: 'EA',
		link: function ($scope, element, $attr) {
			//$scope.names = ["john", "bill", "charlie", "robert", "alban", "oscar", "marie", "celine", "brad", "drew", "rebecca", "michel", "francis", "jean", "paul", "pierre", "nicolas", "alfred", "gerard", "louis", "albert", "edouard", "benoit", "guillaume", "nicolas", "joseph"];
			//var urlLocation = 'api/Location';
			//Restful.get(urlLocation).success(function(data){
			//	$scope.location = data;console.log(data);
			//});
			//element.autocomplete({
			//	source: scope[$attr.uiItems],
			//	select: function() {
			//		$timeout(function() {
			//			element.trigger('input');
			//		}, 0);
			//	}
			//});
		}
	};
	
}]);