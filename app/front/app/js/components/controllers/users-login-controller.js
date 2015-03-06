angular.module('appDep').controller('usersLoginCtrl', ['$scope','cakeQuery','growl', function($scope, cakeQuery, growl){
        
    $scope.user = {
        email: 'votre@email.com',
        password: '',
        message: ''
    };
    
    $scope.login = function( evt ){
        
        cakeQuery.querypost({
            controller: 'users',
            action: 'login'
        },{
            User : $scope.user
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
    
}]);