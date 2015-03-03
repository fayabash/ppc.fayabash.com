angular.module('appDep').filter('slug', function ($sce) {
    return function (input) {
        
        if (input) {
            return input
            .toLowerCase()
            .replace(/[^a-z\-]/g, '-')
            .replace(' ', '-');
        }
    }
});