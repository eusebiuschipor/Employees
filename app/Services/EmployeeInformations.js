(function(app) {
    'use strict';
   
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
})(angular.module('Employees'));