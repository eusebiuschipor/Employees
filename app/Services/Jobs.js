(function(app) {
    'use strict';

	app.service('GetAllJobs', ['$http', '$window', function ($http, $window) {
        var jobsList = null;
        
        this.get = function(callback) {
            $http.get(Global.getAllJobs)
                .success(function(data, status, headers, config) {
                    jobsList = new Array();

                    for (var i = 0; i < data.length; i++) {
                        var job = new Object();
                        job.id = data[i]['Job']['id'];
                        job.title = data[i]['Job']['title'];
                        jobsList.push(job);
                    }
                    
                    callback();
                })
                .error(function(data, status, headers, config) {
                    console.log('error');
                });
        }

        this.getJobsList = function() {
            return jobsList;
        }
    }]);
})(angular.module('Employees'));