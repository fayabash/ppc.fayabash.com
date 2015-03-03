angular.module('appDep').controller('activityBytypeCtrl', ['$scope', 'data', 'title',function($scope, data, title){
    $scope.data = data;
    //console.log( data.activities );
    $scope.title = title;
}]);


