var app = angular.module('myModule', ['angularUtils.directives.dirPagination']);
app.controller('myController', function($scope, $http){
	$http.get('newsData.php').then(function(response){
		$scope.news = response.data;
		
	});
	
	
});