angular.module('appDep').controller('homeCtrl', ['$scope', 'partners', 'works', function($scope, partners, works){
    $scope.data = {
        partners : partners.partners,
        works: works.works
    };
}]);