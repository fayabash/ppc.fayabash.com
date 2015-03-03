angular.module('appDep').controller('partnersCtrl', ['$scope', 'partners', 'works', function($scope, partners, works){
    $scope.data = {
        partners : partners.partners,
        works: works.works
    };
}]);