angular.module('app', [
    'ui.router',
    'ui.bootstrap',
    'ngResource',
    'angular-images-loaded',
    'angular-growl',
    'cake',
    'appDep'
])

.value('server',{
    url: ''//'http://localhost:8888/github/awallef/climatec-sa.com/'//'http://climatec.3xwgr.ch/'
})

.controller('mainCtrl', ['$scope', function ($scope) {
    
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
    
    $scope.imgLoadedEvents = {

        always: function(instance) {
            $scope.loading = false;
        },

        done: function(instance) {
            $scope.error = false;
        },

        fail: function(instance) {
            $scope.error = false;
        }

    };
    
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
        url: "/app/accueil",
        templateUrl: 'theme/Front/partials/home/index.html',
        data : { pageTitle: 'Climatec : Accueil' },
        resolve: {
            cakePHP: 'cakePHP',
            partners: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'partners', action: 'index'}).$promise;
            },
            works: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'works', action: 'lasts', param: '4'}).$promise;
            }
        },
        controller: 'homeCtrl',
        controllerAs: 'controller'
    })

    .state("partenaires", {
        url: "/app/partenaires",
        templateUrl: 'theme/Front/partials/partners/index.html',
        data : { pageTitle: 'Climatec : Nos partenaires' },
        resolve: {
            cakePHP: 'cakePHP',
            partners: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'partners', action: 'index'}).$promise;
            },
            works: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'works', action: 'lasts', param: '4'}).$promise;
            }
        },
        controller: 'partnersCtrl',
        controllerAs: 'controller'
    })

    .state("contact", {
        url: "/app/contact",
        templateUrl: 'theme/Front/partials/pages/contact.html',
        data : { pageTitle: 'Climatec : Contact' },
        controller: 'contactCtrl',
        controllerAs: 'controller'
    })

    .state("entreprise", {
        url: "/app/entreprise",
        templateUrl: 'theme/Front/partials/pages/entreprise.html',
        data : { pageTitle: 'Climatec : Notre Entreprise' },
        controller: 'entrepriseCtrl',
        controllerAs: 'controller'
    })

    .state("works-index", {
        url: "/app/realisations",
        templateUrl: 'theme/Front/partials/works/index.html',
        data : { pageTitle: 'Climatec : La lsite de nos réalisations' },
        resolve: {
            cakePHP: 'cakePHP',
            customers: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'customers', action: 'index'}).$promise;
            },
            activities: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'activities', action: 'index'}).$promise;
            },
            activityTypes: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'activity_types', action: 'index'}).$promise;
            },
            works: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'works', action: 'index'}).$promise;
            }
        },
        controller: 'worksIndexCtrl',
        controllerAs: 'controller'
    })

    .state("activities-bytype-climatisation", {
        url: "/app/climatisation",
        templateUrl: 'theme/Front/partials/activities/bytype.html',
        data : { pageTitle: 'Climatec : Domaines d activité' },
        resolve: {
            title: function () {
                return 'Climatisation';
            },
            cakePHP: 'cakePHP',
            data: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'activities', action: 'bytype', id: 1}).$promise;
            }
        },
        controller: 'activityBytypeCtrl',
        controllerAs: 'controller'
    })

    .state("activities-bytype-ventilation", {
        url: "/app/ventilation",
        templateUrl: 'theme/Front/partials/activities/bytype.html',
        data : { pageTitle: 'Climatec : Domaines d activité' },
        resolve: {
            title: function () {
                return 'Ventilation';
            },
            cakePHP: 'cakePHP',
            data: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'activities', action: 'bytype', id: 2}).$promise;
            }
        },
        controller: 'activityBytypeCtrl',
        controllerAs: 'controller'
    })

    .state("works-view", {
        url: "/app/realisation/:workId/:workTitle",
        templateUrl: 'theme/Front/partials/works/view.html',
        data : { pageTitle: 'Climatec : En détail' },
        resolve: {
            cakePHP: 'cakePHP',
            work: function (cakePHP, $stateParams) {
                var workId = $stateParams.workId;
                return cakePHP.queryjsonp({controller: 'works', action: 'view', id: workId}).$promise;
            },
            works: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'works', action: 'lasts', param: '4'}).$promise;
            }
        },
        controller: 'worksViewCtrl',
        controllerAs: 'controller'
    })
    
    .state("clients-index", {
        url: "/app/clients",
        templateUrl: 'theme/Front/partials/customers/index.html',
        data : { pageTitle: 'Climatec : Nos clients' },
        resolve: {
            cakePHP: 'cakePHP',
            data: function (cakePHP) {
                return cakePHP.queryjsonp({controller: 'customers', action: 'index'}).$promise;
            }
        },
        controller: 'customersIndexCtrl',
        controllerAs: 'controller'
    });

    //$urlRouterProvider.otherwise('/app/accueil');

}]);