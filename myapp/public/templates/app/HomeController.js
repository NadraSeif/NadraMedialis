

angular.module('myApp.controllers', []).
  controller('HomeController', ['$scope','$http', function ($scope ,$http) {
	  
	  $http.get("http://localhost/slimapp/public/api/lists")
        .success(function(response) {
          $scope.lists = response;
		  console.log("data  : ", response) ; 
        })
        .error(function(response) {
          $scope.message = "Error!!";
        });
		
		// delete list
	
	$scope.deleteList = function(id){
		$http.delete("http://localhost/slimapp/public/api/list/delete/"+id)
        .success(function(response) {
		 $location.path( "/home" );		
        })
        .error(function(response) {
          $scope.message = "Error!!";
        });
	}

	  
    
  }]).
  controller('ItemController', ['$scope','$http','$location', function ($scope,$http,$location) {
    $http.get("http://localhost/slimapp/public/api/items")
        .success(function(response) {
          $scope.items = response;
		  console.log("data  : ", response) ; 
        })
        .error(function(response) {
          $scope.message = "Error!!";
        });
		
	
		
	// delete item
	
	$scope.deleteItem = function(id){
		$http.delete("http://localhost/slimapp/public/api/item/delete/"+id)
        .success(function(response) {
		 $location.path( "/home" );		
        })
        .error(function(response) {
          $scope.message = "Error!!";
        });
	}
    
  }]).
  controller('AddItemController', ['$scope','$http', function ($scope,$http) {
	  $http.get("http://localhost/slimapp/public/api/alllists")
        .success(function(response) {
          $scope.lists = response;
        })
        .error(function(response) {
          $scope.message = "Error!!";
        });
		
		$scope.validate = function(){
			
			 var data = {
                id_list : $scope.list_id, 
				title : $scope.title ,
				date_create : '',
				date_update : '' , 
				date_delete : ''
            };
        
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
			console.log(data) ; 
			$http.post("http://localhost/slimapp/public/api/item/add" , data , config)
			.success(function(response) {
			  $location.path( "/items" );
			})
			.error(function(response) {
			  $scope.message = "Error!!";
			}); 
		}
    
  }]).
  controller('AddListController', ['$scope', function ($scope) {
   
		
		$scope.validate = function(){
			
			 var data = {
                author : $scope.author, 
				title : $scope.title ,
				date_create : '',
				date_update : '' , 
				date_delete : ''
            };
        
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
			console.log(data) ; 
			$http.post("http://localhost/slimapp/public/api/list/add" , data , config)
			.success(function(response) {
			  $location.path( "/home" );
			})
			.error(function(response) {
			  $scope.message = "Error!!";
			}); 
		}
  }]);