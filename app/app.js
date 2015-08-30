(function() {
    var dependencies = [
        'ui.bootstrap', 
        'ngRoute',
        'Employee',
        'Job',
        'Form'
   ];

    var app = angular.module('Employees', dependencies);

    app.directive('navigation', function() {    
        return {
            restrict: 'E',
            templateUrl: Global.templatesUrl + 'navigation.html'
        }
    });

    app.directive('topnavigation', function() {
        return {
            restrict: 'E',
            templateUrl: Global.templatesUrl + 'top-navigation.html'
        }
    });
})();

