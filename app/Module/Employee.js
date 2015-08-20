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

    app.controller('EmployeesController', ['$scope', '$http', '$window', 'GetAllEmployees', 'Form', function($scope, $http, $window, GetAllEmployees, Form) {
        var employees = new Array();

        this.getAllEmployees = function() {
            return employees;
        }

        this.deleteEmployee = function(employeeId) {
            dataObject = {
                id: employeeId
            }

            Form.sendDataToServer(Global.deleteEmployee, dataObject);
        }

        GetAllEmployees.get(function() {
            employees = GetAllEmployees.getEmployeesList();
        });
    }]);

    app.controller('EmployeeDescriptionController', ['$scope', '$http', '$window', '$routeParams', function($scope, $http, $window, $routeParams) {
        this.employeeInformations = {};
        this.defaultEmployeeImage = Global.employeeImageSrc;

        var self = this,
            employeeId = $routeParams.employeeId;

        this.getEmployeeInformations = function() {
            $http.get(Global.getEmployeeDescription + employeeId)
                .success(function(data, status, headers, config) {
                    self.employeeInformations.name = data[0]['employees']['name'];
                    self.employeeInformations.address = data[0]['employees']['address'];
                    self.employeeInformations.email = data[0]['employees']['email'];
                    self.employeeInformations.jobTitle = data[0]['jobs']['title'];
                })
                .error(function(data, status, headers, config) {
                    console.log('error');
                });
        }
    }]);

    app.controller('AddEmployeeController', ['$scope', '$http', '$location', '$routeParams', 'GetAllJobs', 'Form', function($scope, $http, $location, $routeParams, GetAllJobs, Form){
        this.addEmployeeForm = {};

        var jobs = null,
            dataObject = null,
            self = this,
            employeeId = $routeParams.employeeId;

        this.getAllJobs = function() {
            return jobs;
        }

        this.submitTheForm = function() {
            dataObject = {
                id: employeeId,
                name: self.addEmployeeForm.name,
                email: self.addEmployeeForm.email,
                address: self.addEmployeeForm.address,
                password: self.addEmployeeForm.password,
                job_title: self.addEmployeeForm.jobTitle
            };

            Form.sendDataToServer(Global.addEmployee, dataObject);
            self.addEmployeeForm = {};
            $location.path('/success');
        }

        this.getEmployeeInformation = function() {
            $http.get(Global.getEmployeeInformations + employeeId)
                .success(function(data, status, headers, config) {
                    self.addEmployeeForm.name = data[0]['employees']['name'];
                    self.addEmployeeForm.email = data[0]['employees']['email'];
                    self.addEmployeeForm.address = data[0]['employees']['address'];
                    self.addEmployeeForm.jobTitle = data[0]['employees']['job_title'];
                })
                .error(function(data, status, headers, config) {
                    console.log('error');
                });
        }

        GetAllJobs.get(function() {
            jobs = GetAllJobs.getJobsList();
        });
    }]);
})();
