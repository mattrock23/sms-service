'use strict';

/* App Module */

angular.module('sms-service', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider
      .when('/messages', {templateUrl: 'partials/message-list.html',   controller: MessageListCtrl})
      .when('/messages/:type', {templateUrl: 'partials/message-list.html',   controller: MessageListCtrl})
      .when('/subscribers', {templateUrl: 'partials/subscriber-list.html', controller: SubscriberListCtrl})
      .when('/subscribers/:subscriberId', {templateUrl: 'partials/subscriber-detail.html', controller: SubscriberDetailCtrl})
      .when('/analytics', {templateUrl: 'partials/analytics.html', controller: AnalyticsCtrl})
      .otherwise({redirectTo: '/messages'});
}]);

/* Controllers */

function MessageListCtrl($scope, $http, $routeParams) {
  var getVar = 'data/message-list.php';
  if($routeParams.type) {
    getVar += '&type=' + $routeParams.type;
    $scope.type = capitalizeFirstLetter($routeParams.type);
  } else {
    $scope.type = "All";
  }
  $http.get(getVar).success(function(data) {
    $scope.messageList = data;
  });
}

function SubscriberListCtrl($scope, $routeParams) {

}

function SubscriberDetailCtrl($scope, $routeParams) {
  $scope.subscriberId = $routeParams.subscriberId;
}

function AnalyticsCtrl($scope, $routeParams) {

}

/* Custom Functions */

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}