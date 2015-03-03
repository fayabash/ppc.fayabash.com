angular.module('appDep').controller('CarouselCtrl', function ($scope) {
    $scope.myInterval = 5000;
    var slides = $scope.slides = [
        {
            image: 'img/static/banner_3.jpeg',
            text: 'Climatisation & Ventilation'
        },
        {
            image: 'img/static/banner_4.jpeg',
            text: 'Climatisation & Ventilation'
        }
    ];
});