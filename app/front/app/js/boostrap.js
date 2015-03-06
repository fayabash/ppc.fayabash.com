/***
 *    __________                       __                        
 *    \______   \ ____   ____  _______/  |_____________  ______  
 *     |    |  _//  _ \ /  _ \/  ___/\   __\_  __ \__  \ \____ \ 
 *     |    |   (  <_> |  <_> )___ \  |  |  | | \// __ \|  |_> >
 *     |______  /\____/ \____/____  > |__|  |__|  (____  /   __/ 
 *            \/                  \/                   \/|__|    
 */

// This is a function that bootstraps AngularJS, which is called from later code
function bootstrapAngular() {
    if(console) console.log("Bootstrapping AngularJS");
    // This assumes your app is named "app" and is on the body tag: <body ng-app="app">
    // Change the selector from "body" to whatever you need
    var domElement = document.querySelector('body');
    // Change the application name from "app" if needed
    angular.bootstrap(domElement, ['app']);
}

// This is my preferred Cordova detection method, as it doesn't require updating.
if (document.URL.indexOf( 'http://' ) === -1 
        && document.URL.indexOf( 'https://' ) === -1) {
    if(console) console.log("URL: Running in Cordova/PhoneGap");
    document.addEventListener("deviceready", bootstrapAngular, false);
} else {
    if(console) console.log("URL: Running in browser");
    bootstrapAngular();

}