console.log('load first...');
app.controller(
	'index_ctrl', [
	'$scope'
	, 'Restful'
	, function ($scope, Restful){
		console.log('load...!!!! gooo->');
	}
]);