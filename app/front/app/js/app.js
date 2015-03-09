angular.module('app', [
    'ui.router',
    'ui.bootstrap',
    'ngResource',
    'angular-growl',
    'cake',
    'appDep'
])

.value('server',{
    url: ''//'http://localhost:8888/github/awallef/climatec-sa.com/'//'http://climatec.3xwgr.ch/'
})

.value('headers',{
    Authorization : "BASIC token"
})

.controller('mainCtrl', ['$scope','headers','$http', function ($scope, headers, $http) {
    
    headers = {
       Authorization : "BASIC youpi" 
    };
    
    $scope.loading = false;
    $scope.error = false;
    
    
    // state listeners
    $scope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
        
        if (toState.resolve) {
            $scope.loading = true;
            $scope.error = false;
        }
    });
    
    $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
        if (toState.resolve) {
            // let image loader decide...
        }
    });
    
    $scope.$on('$stateNotFound', function (event, toState, toParams, fromState, fromParams) {
        if (toState.resolve) {
            $scope.loading = false;
            $scope.error = true;
        }
    });
    
    $scope.$on('$stateChangeError', function (event, toState, toParams, fromState, fromParams) {
        if (toState.resolve) {
            $scope.loading = false;
            $scope.error = true;
        }
    });
    
}])

.run([ '$rootScope', '$state', '$stateParams', function ($rootScope, $state, $stateParams) {
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
}])

.config(['$locationProvider', '$stateProvider', '$urlRouterProvider', function ($locationProvider, $stateProvider, $urlRouterProvider) {

    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('!');

    $stateProvider
    
    .state("home", {
        url: "/app/home",
        templateUrl: 'theme/Front/partials/pitches/pitches_list.html',
        data : { pageTitle: 'PPC : Home' },
        resolve: {
            cakeQuery: 'cakeQuery',
            data: function (cakeQuery) {
                return cakeQuery.queryget({controller: 'pitches', action: 'pitches_list'}).$promise;
            }
        },
        controller: 'pitchesListCtrl',
        controllerAs: 'controller'
    })
    
    .state("bookings", {
        url: "/app/bookings",
        templateUrl: 'theme/Front/partials/users/bookings.html',
        data : { pageTitle: 'PPC : Réservations' },
        resolve: {
            cakeQuery: 'cakeQuery',
            data: function (cakeQuery) {
                return cakeQuery.queryget({controller: 'users', action: 'bookings'}).$promise;
            }
        },
        controller: 'usersBookingsCtrl',
        controllerAs: 'controller'
    })
    
    .state("logout", {
        url: "/app/logout",
        templateUrl: 'theme/Front/partials/users/login.html',
        data : { pageTitle: 'PPC : Login' },
        resolve: {
            cakeQuery: 'cakeQuery',
            data: function (cakeQuery) {
                return cakeQuery.queryget({controller: 'users', action: 'logout'}).$promise;
            }
        },
        controller: 'usersLoginCtrl',
        controllerAs: 'controller'
    })
    
    .state("login", {
        url: "/app/login",
        templateUrl: 'theme/Front/partials/users/login.html',
        data : { pageTitle: 'PPC : Login' },
        controller: 'usersLoginCtrl',
        controllerAs: 'controller'
    });
    
    $urlRouterProvider.otherwise('/app/home');

}]);