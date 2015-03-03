/*
 * 3xw sàrl
 */
angular.module('cake',[
    'ngResource'
])

.controller('cakeCtrl', ['$scope', 'data', function($scope, data){
    $scope.data = data;
}])

.value('server',{
    url: 'http://localhost:8888/github/awallef/climatec-sa.com/'
})

.factory('cakePHP', ['$resource','server', function($resource, server) {
    return $resource( server.url + 'json/:custom1/:custom2/:controller/:action/:sort/:direction/:page/:id/:param.json', {custom1:'@custom1',custom2:'@custom2',controller:'@controller',action:'@action',sort:'@sort',direction:'@direction',page:'@page',id:'@id',param:'@param'}, {
         queryjsonp: { method: 'JSONP', params: {callback: 'JSON_CALLBACK'}, callback:"JSON_CALLBACK" },
         queryput:{method: 'PUT'},
         querypost:{method: 'POST'},
         querydelete:{method: 'DELETE'}
    })
}]);
