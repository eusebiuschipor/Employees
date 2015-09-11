(function(app) {
    'use strict'

	app.service('ApiService', ['$http', '$window', '$location', function ($http, $window, $location) {
        this.get = function(url, success, failure) {    
            $http.get(url)          
                .then(function (result) {   
                    success(result);                                                       
                }, function (error) {    
                    if (error.status == '401') {       
                        $location.path('/401');    
                    } else if (failure != null) {   
                        failure(error);  
                    }     
                });      
      	}

      	this.post = function(url, data, success, failure) {    
            $http.get(url, data)          
                .then(function (result) {   
                    success(result);                                                       
                }, function (error) {    
                    if (error.status == '401') {       
                        $location.path('/401');      
                    } else if (failure != null) {   
                        failure(error);  
                    }     
                });      
      	}
    }]);
})(angular.module('Employees'));