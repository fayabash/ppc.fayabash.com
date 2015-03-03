angular.module('appDep').controller('customersIndexCtrl', ['$scope', '$window', '$filter', 'data',function($scope, $window, $filter, data){
    $scope.data = data;
    
    $scope.customerListClick = function( id ){
        var anchor = $filter('slug')(id);
        var elem = $window.document.getElementById(anchor);
        var bounding = elem.getBoundingClientRect();
        var y = ( $window.innerWidth < 678 )? bounding.top - 61 : bounding.top - 114;
        y = y - 10; 
        $window.scrollTo(0, y );
    }
    
}]);


