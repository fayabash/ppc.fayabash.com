/*
 * 3xw sàrl
 */
angular.module('cake',[
    'ngResource'
])

.controller('cakeCtrl', ['$scope', 'data', function($scope, data){
    $scope.data = data;
}])

.controller('cakeLoginCtrl', ['$scope','cakePHP','growl', function($scope, cakePHP, growl){
        
    $scope.user = {
        name: 'Votre Nom Complet',
        email: 'votre@email.com',
        message: ''
    };
    
    $scope.sendMessage = function( evt ){
        
        cakePHP.querypost({
            controller: 'users',
            action: 'json_login'
        },{
            user : $scope.message
        }).$promise.then(
            //success
            function( value ){
                if( value.success ){
                    growl.success("Votre message a bien été envoyé!");
                }else{
                    growl.error('Une erreure est survenue, veuillez essayer à nouveau!');
                }
            },
            //error
            function( error ){
                growl.error('Le serveur n\'a pas répondu, veuillez essayer à nouveau!');
            }
        );
    }
    
}])

.value('server',{
    url: 'http://exemple.com'
})

.factory('cakeQuery', ['$resource','server', function($resource, server) {
        
    return $resource(
         server.url + 'json/:custom1/:custom2/:controller/:action/:sort/:direction/:page/:id/:param.json', {custom1:'@custom1',custom2:'@custom2',controller:'@controller',action:'@action',sort:'@sort',direction:'@direction',page:'@page',id:'@id',param:'@param'}, {
         queryjsonp: { method: 'JSONP', params: {callback: 'JSON_CALLBACK'}, callback:"JSON_CALLBACK" },
         queryget: { method: 'GET'},
         queryput:{method: 'PUT'},
         querypost:{method: 'POST'},
         querydelete:{method: 'DELETE'}
    })
}]);
