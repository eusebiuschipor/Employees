(function() {
    'use strict';

    var app = angular.module('Employee', []);

    app.controller('EmployeesController', ['$scope', '$http', '$window', 'GetAllEmployees', 'Form', function($scope, $http, $window, GetAllEmployees, Form) {
        var employees = new Array(),
            offset = 0,
            limit = 11,
            newEmployeesList = null;

        $scope.getAllEmployees = function() {
            return employees;
        }

        $scope.deleteEmployee = function(employeeId) {
            var dataObject = {
                id: employeeId
            }

            Form.sendDataToServer(Global.deleteEmployee, dataObject);
        }

        $scope.callbackGetAllEmployees = function() {
            newEmployeesList = null;

            if (employees.length == 0) {
                employees = GetAllEmployees.getEmployeesList();
            } else {
                newEmployeesList = GetAllEmployees.getEmployeesList();

                for (var i = 0; i < newEmployeesList.length; i++) {
                    employees.push(newEmployeesList[i]);
                }
            }
        }

        $window.onscroll = function() {
            if (($(window).scrollTop() + $(window).height() >= $(document).height() - 10)) {
                GetAllEmployees.get($scope.callbackGetAllEmployees, limit, offset += limit);
            }
        };

        GetAllEmployees.get($scope.callbackGetAllEmployees, limit, offset);
    }]);

    app.controller('EmployeeDescriptionController', ['$scope', '$http', '$window', '$routeParams', 'ViewEmployee', function($scope, $http, $window, $routeParams, ViewEmployee) {
        $scope.employeeInformations = {};
        $scope.defaultEmployeeImage = Global.employeeImageSrc;

        $scope.getEmployeeInformations = function() {
            ViewEmployee.get(
                function() {
                    $scope.employeeInformations = ViewEmployee.getEmployeeInformations();
                },
                $routeParams.employeeId
            );            
        }

        $scope.getEmployeeInformations();
    }]);

    app.controller('AddEmployeeController', ['$scope', '$http', '$location', '$routeParams', 'GetAllJobs', 'Form', 'GetEmployeeInformations', function($scope, $http, $location, $routeParams, GetAllJobs, Form, GetEmployeeInformations) {
        $scope.addEmployeeForm = {};

        var jobs = null,
            dataObject = null;

        $scope.getAllJobs = function() {
            return jobs;
        }

        $scope.submitTheForm = function() {
            dataObject = {
                id: $routeParams.employeeId,
                name: $scope.addEmployeeForm.name,
                email: $scope.addEmployeeForm.email,
                address: $scope.addEmployeeForm.address,
                password: $scope.addEmployeeForm.password,
                job_title: $scope.addEmployeeForm.jobTitle
            };

            Form.sendDataToServer(Global.addEmployee, dataObject);
            $scope.addEmployeeForm = {};
            $location.path('/success');
        }

        $scope.getEmployeeInformations = function() {
            GetEmployeeInformations.get(
                function() {
                    $scope.addEmployeeForm = GetEmployeeInformations.getEmployeeInformations();
                },
                $routeParams.employeeId
            );            
        }

        GetAllJobs.get(function() {
            jobs = GetAllJobs.getJobsList();
        });
    }]);
})();
