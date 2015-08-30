(function() {
    var app = angular.module('Employee', []);

    app.service('GetAllEmployees', ['$http', '$window', function ($http, $window) {
        var employeesList = null;
        
        this.get = function(callback) {
            $http.get(Global.getAllEmployees)
                .success(function(data, status, headers, config) {
                    employeesList = new Array();

                    for (var i = 0; i < data.length; i++) {
                        var employee = new Object();
                        employee.nr = i + 1;
                        employee.id = data[i]['employees']['id'];
                        employee.name = data[i]['employees']['name'];
                        employee.jobTitle = data[i]['jobs']['title'];
                        employee.email = data[i]['employees']['email'];
                        employee.address = data[i]['employees']['address'];
                        employeesList.push(employee);
                    }
                    
                    callback();
                })
                .error(function(data, status, headers, config) {
                    console.log('error');
                });
        }

        this.getEmployeesList = function() {
            return employeesList;
        }
    }]);

    app.service('GetEmployeeInformations', ['$http', '$window', function ($http, $window) {
        var employeeInformations = {};

        this.get = function(callback, employeeId) {
            $http.get(Global.getEmployeeInformations + employeeId)
                .success(function(data, status, headers, config) {
                    employeeInformations.name = data[0]['employees']['name'];
                    employeeInformations.email = data[0]['employees']['email'];
                    employeeInformations.address = data[0]['employees']['address'];
                    employeeInformations.jobTitle = data[0]['employees']['job_title'];

                    callback();
                })
                .error(function(data, status, headers, config) {
                    console.log('error');
                });
        }

        this.getEmployeeInformations =  function() {
            return employeeInformations;
        }
    }]);

    app.controller('EmployeesController', ['$scope', '$http', '$window', 'GetAllEmployees', 'Form', function($scope, $http, $window, GetAllEmployees, Form) {
        var employees = new Array();

        $scope.getAllEmployees = function() {
            return employees;
        }

        $scope.deleteEmployee = function(employeeId) {
            dataObject = {
                id: employeeId
            }

            Form.sendDataToServer(Global.deleteEmployee, dataObject);
        }

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
