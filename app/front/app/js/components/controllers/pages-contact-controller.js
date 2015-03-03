angular.module('appDep').controller('contactCtrl', ['$scope','cakePHP','growl', function($scope, cakePHP, growl){
        
    $scope.message = {
        name: 'Votre Nom Complet',
        email: 'votre@email.com',
        message: ''
    };
    
    $scope.sendMessage = function( evt ){
        
        cakePHP.querypost({
            controller: 'main',
            action: 'email'
        },{
            message : $scope.message
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