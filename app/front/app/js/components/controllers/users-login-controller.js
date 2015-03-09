angular.module('appDep').controller('usersLoginCtrl', ['$scope','$state','cakeQuery','growl', function($scope, $state, cakeQuery, growl){
        
    $scope.user = {
        email: 'votre@email.com',
        password: '',
        message: ''
    };
    
    
    $scope.displayError = function(){
        growl.error('Mauvais email/mot de passe');
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
                
                if(!value.data)
                    return $scope.displayError();
                
                if(!value.data.state)
                    return $scope.displayError();
                
                if( value.data.state != 'success' )
                    return $scope.displayError();
                
                $state.go('bookings',{});
               
            },
            //error
            function( error ){
                growl.error('Le serveur n\'a pas répondu, veuillez essayer à nouveau!');
            }
        );
    }
    
}]);