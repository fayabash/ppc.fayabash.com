angular.module('appDep').controller('worksIndexCtrl', ['$scope', 'customers','works', 'activities','activityTypes', function($scope, customers, works, activities, activityTypes){
    
    // retrieve json data
    $scope.data = {};
    $scope.data.customers = customers.customers;
    $scope.data.works = works.works;
    $scope.data.activities = activities.activities;
    $scope.data.activityTypes = activityTypes.activityTypes;
    
    // set models
    $scope.myFilter = {
        activityTypes: 'id-0-id',
        activities : 'id-0-id',
        customers: 'id-0-id'
    };
    
    // create a link between customers id and activities that is stored in works!
    var customers = {};
    
    // add properties to works
    for( var i in $scope.data.works ){
        var work = $scope.data.works[i];
        var activity;
        
        work.customers = work.activityTypes = work.activities = ['id-0-id'];
        
        // add customer dependency in .customers
        for( var customer in work.Customer ){
            var customerId = work.Customer[customer].id;
            work.customers.push( 'id-'+customerId+'-id' );
            
            // create link between customers and activity
            if( !customers.hasOwnProperty(customerId) ){
                customers[customerId] = {
                    activities: [],
                    activityTypes: []
                };
            }
            for( activity in work.Activity ){
                customers[customerId].activities.push('id-'+work.Activity[activity].id+'-id');
                customers[customerId].activityTypes.push('id-'+work.Activity[activity].activity_type_id+'-id');
            }
        }
        
        // add activity dependency in .activities
        // add activityType dependency in .activityTypes
        for( activity in work.Activity ){
            work.activities.push( 'id-'+work.Activity[activity].id+'-id' );
            work.activityTypes.push( 'id-'+work.Activity[activity].activity_type_id+'-id' );
        }
        
        $scope.data.works[i] = work;
    }
    
    // add properties to activitiy Types
    for( i in $scope.data.activityTypes ){
        var activityType = $scope.data.activityTypes[i];
        activityType.listId = 'id-'+activityType.ActivityType.id+'-id';
        
        $scope.data.activityTypes[i] = activityType;
    }
    
    $scope.data.activityTypes.unshift({listId: 'id-0-id',ActivityType:{name:'Toutes'}});
    
    // add properties to activities
    for( i in $scope.data.activities ){
        activity = $scope.data.activities[i];
        activity.listId = 'id-'+activity.Activity.id+'-id';
        activity.activityTypes = [];
        activity.activityTypes.push('id-'+activity.Activity.activity_type_id+'-id');
        
        $scope.data.activities[i] = activity;
    }
    
    // add properties to customers
    for( var i in $scope.data.customers ){
        var customer = $scope.data.customers[i];
        customerId = customer.Customer.id;
        customer.listId = 'id-'+customerId+'-id';
        customer.activities = [];
        customer.activityTypes = [];
        
        for( var key in customers[customerId].activities ){
            var activityId = customers[customerId].activities[key];
            var activityTypeId = customers[customerId].activityTypes[key];
            if(customer.activities.indexOf(activityId) == -1){
                customer.activities.push(activityId);
                customer.activityTypes.push(activityTypeId);
            }
        }
        
        $scope.data.customers[i] = customer;
    }
    
    //console.log( $scope.data.activityTypes );
    
}])