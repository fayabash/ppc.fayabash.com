// add a nl2br filter as nl2br in php
angular.module('appDep').filter('date', function($sce) {
    return function(dateString) {
        var dateObject = new Date(dateString);
         return dateObject.getDay() +'.'+ dateObject.getMonth() + '.' + dateObject.getFullYear(); 
    }
});