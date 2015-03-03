angular.module('appDep').controller('elementsHeaderCtrl', ['$scope', '$window',function($scope, $window){
        
        $scope.navCollapsed = true;
        
        $scope.navClick = function(){
            if( $window.innerWidth < 678 ){
                $scope.navCollapsed = true;
            }
        }
}]);
