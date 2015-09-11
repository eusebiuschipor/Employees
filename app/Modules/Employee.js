(function() {
    'use strict';

    var app = angular.module('Employee', []);

    app.controller('EmployeesController', ['$scope', '$http', '$window', 'GetAllEmployees', 'Form', function($scope, $http, $window, GetAllEmployees, Form) {
        var employees = new Array()
            offset = 0;

        $scope.getAllEmployees = function() {
            return employees;
        }

        $scope.deleteEmployee = function(employeeId) {
            dataObject = {
                id: employeeId
            }

            Form.sendDataToServer(Global.deleteEmployee, dataObject);
        }

        $window.onscroll = function() {
            if (($(window).scrollTop() + $(window).height() >= $(document).height() - 10)) {
                GetAllEmployees.get(
                    function() {
                        employees = GetAllEmployees.getEmployeesList();
                    },
                    offset += 9
                );
            }
        };

        GetAllEmployees.get(function() {
            employees = GetAllEmployees.getEmployeesList();
        });
    }]);

    app.controller('EmployeeDescriptionController', ['$scope', '$http', '$window', '$routeParams', 'GetEmployeeInformations', function($scope, $http, $window, $routeParams, GetEmployeeInformations) {
        $scope.employeeInformations = {};
        $scope.defaultEmployeeImage = Global.employeeImageSrc;

        $scope.getEmployeeInformations = function() {
            GetEmployeeInformations.get(
                function() {
                    $scope.employeeInformations = GetEmployeeInformations.getEmployeeInformations();
                },
                $routeParams.employeeId
            );            
        }

        $scope.getEmployeeInformations();
    }]);

    app.controller('AddEmployeeController', ['$scope', '$http', '$location', '$routeParams', 'GetAllJobs', 'Form', 'GetEmployeeInformations', function($scope, $http, $location, $routeParams, GetAllJobs, Form, GetEmployeeInformations){
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
