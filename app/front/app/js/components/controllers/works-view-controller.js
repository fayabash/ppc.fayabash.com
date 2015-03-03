angular.module('appDep').controller('worksViewCtrl', ['$scope', 'work','works', function($scope, work, works){
    
    // retrieve json data
    $scope.data = {};
    $scope.data.work = work.work;
    $scope.data.works = works.works;
    
}])