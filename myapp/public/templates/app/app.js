//Main module view routing and state routing
var myApp = angular.module('myApp', [
    'ui.router',
    'ngRoute',
    'myApp.services',
    'myApp.directives',
    'myApp.controllers'
])
    .config(['$routeProvider', '$httpProvider', function ($routeProvider, $httpProvider) {
        $routeProvider.when('/home', {
            templateUrl: 'templates/partials/home.html',
            controller: 'HomeController',
            controllerAs: 'controller'
        }).when('/items', {
            templateUrl: 'templates/partials/items.html',
            controller: 'ItemController',
            controllerAs: 'controller'
        })
		.when('/test', {templateUrl: 'templates/partials/addItems.html', controller: 'AddItemController'})
            .when('/addList', {
                templateUrl: 'templates/partials/addIlist.html',
                controller: 'AddListController',
                controllerAs: 'post'
            })
            .when('/create', {templateUrl: 'partials/addPost.html', controller: 'PostController', controllerAs: 'post'})
            .otherwise({redirectTo: '/post'});
 }]);
