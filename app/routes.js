(function(app) {
	'use strict';

    app.config(function($routeProvider) {
        $routeProvider
            .when('/employees', {
                templateUrl: Global.viewsUrl + 'employees.html',
                controller: 'EmployeesController'
            })
            .when('/employee/:employeeId', {
                templateUrl: Global.viewsUrl + 'employee.html',
                controller: 'EmployeeDescriptionController'
            })
            .when('/add-employee', {
                templateUrl: Global.viewsUrl + 'add-employee.html',
                controller: 'AddEmployeeController'
            })
            .when('/edit-employee', {
                templateUrl: Global.viewsUrl + 'edit-employee.html',
                controller: 'EmployeesController'
            })
            .when('/edit-employees', {
                templateUrl: Global.viewsUrl + 'edit-employees.html',
                controller: 'AddEmployeeController'
            })
            .when('/delete-employees', {
                templateUrl: Global.viewsUrl + 'delete-employees.html',
                controller: 'EmployeesController'
            })
            .when('/edit-employee/:employeeId', {
                templateUrl: Global.viewsUrl + 'edit-employee.html',
                controller: 'AddEmployeeController'
            })
            .when('/delete-employee/:employeeId', {
                templateUrl: Global.viewsUrl + 'delete-employee.html',
                controller: 'DeleteEmployeeController'
            })
            .when('/success', {
                templateUrl: Global.viewsUrl + 'success.html',
                controller: 'AddEmployeeController'
            })
            .otherwise({
                redirectTo: Global.pageNotFound
            });
    });
})(angular.module('Employees'));