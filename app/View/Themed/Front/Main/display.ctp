<!-- header -->
<div  class="app-header" ng-include="'theme/Front/partials/elements/header.html'"></div>

<div class="app-wrapper" images-loaded="imgLoadedEvents" ui-view autoscroll="true">
    <div class="bg--blue full-stage" ng-show="loading">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>
    
    <div class="bg--blue full-stage" ng-show="error">
        <div class="spinner">
            <div>
                Une erreure est survenue, veuillez essayer à nouveau!
            </div>
        </div>
    </div>
    
</div>

<!-- footer -->
<div ng-include="'theme/Front/partials/elements/footer.html'"></div>