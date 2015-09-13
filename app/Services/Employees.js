(function(app) {
    'use strict';

    app.service('GetAllEmployees', ['$http', '$window', function ($http, $window) {
        var employeesList = null;
        
        this.get = function(callback, limit, offset) {
            $http.get(
                Global.getAllEmployees, {
                    params: {
                        limit: limit, 
                        offset: offset
                    }
                })
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
})(angular.module('Employees'));
