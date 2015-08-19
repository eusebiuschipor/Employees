(function() {
    var dependencies = [
        'ui.bootstrap', 
        'ngRoute',
        'Employee',
        'Job',
        'Form'
   ];

    var app = angular.module('Employees', dependencies);

    app.config(function($routeProvider) {
        $routeProvider
            .when('/employees', {
                templateUrl: Global.viewsUrl + 'employees.html',
                controller: 'EmployeesController'
            })
            .when('/add-employee', {
                templateUrl: Global.viewsUrl + 'add-employee.html',
                controller: 'AddEmployeeController'
            })
            .when('/edit-employee', {
                templateUrl: Global.viewsUrl + 'edit-employee.html',
                controller: 'AddEmployeeController'
            })
            .when('/edit-employees', {
                templateUrl: Global.viewsUrl + 'edit-employees.html',
                controller: 'AddEmployeeController'
            })
            .when('/edit-employee/:employeeId', {
                templateUrl: Global.viewsUrl + 'edit-employee.html',
                controller: 'AddEmployeeController'
            })
            .when('/success', {
                templateUrl: Global.viewsUrl + 'success.html',
                controller: 'AddEmployeeController'
            })
            .otherwise({
                redirectTo: Global.pageNotFound
            });
    });

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

