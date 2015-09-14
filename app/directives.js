(function(app) {
	'use strict';

    app.directive('navigation', function() {    
        return {
            restrict: 'E',
            templateUrl: Global.viewsUrl + 'navigation.html'
        }
    });

    app.directive('topnavigation', function() {
        return {
            restrict: 'E',
            templateUrl: Global.viewsUrl + 'top-navigation.html'
        }
    });
})(angular.module('Employees'));