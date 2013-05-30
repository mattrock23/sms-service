'use strict';

/* App Module */

angular.module('sms-service', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider
      .when('/messages', {templateUrl: 'partials/message-list.html',   controller: MessageListCtrl})
      .when('/messages/:type', {templateUrl: 'partials/message-list.html',   controller: MessageListCtrl})
      .when('/subscribers', {templateUrl: 'partials/subscriber-list.html', controller: SubscriberListCtrl})
      .when('/subscribers/:groupName', {templateUrl: 'partials/subscriber-list.html', controller: SubscriberListCtrl})
      .when('/analytics', {templateUrl: 'partials/analytics.html', controller: AnalyticsCtrl})
      .otherwise({redirectTo: '/messages'});
}]);

/* Controllers */

function MessageListCtrl($scope, $http, $routeParams) {
  var getVar = 'data/message-list.php';
  if($routeParams.type) {
    getVar += '?type=' + $routeParams.type;
    $scope.type = capitalizeFirstLetter($routeParams.type);
  } else {
    $scope.type = "All";
  }
  $http.get(getVar).success(function(data) {
    $scope.messageList = data;
  });
  $scope.dateSorter = function(message) {
    var newDate = new Date(message.date);
    return newDate.toISOString();
  }
}

function SubscriberListCtrl($scope, $http, $routeParams) {
  var getVar = 'data/subscriber-list.php';
  if($routeParams.groupName) {
    getVar += '?groupName=' + $routeParams.groupName;
    $scope.groupName = capitalizeFirstLetter($routeParams.groupName);
  }
  $http.get(getVar).success(function(data) {
    $scope.subscriberList = data;
  });
  $scope.dateSorter = function(message) {
    var newDate = new Date(message.date);
    return newDate.toISOString();
  }
}

function AnalyticsCtrl($scope, $http) {
  $http.get('data/analytics.php').success(function(d) {
    graph(jQuery, preparePlotPoints(d));
  });
}

/* Custom Functions */

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function groupNameDisplay(string) {
  var strings = string.split("_");
  var result = "";
  strings.forEach(function(x) {
    result += capitalizeFirstLetter(x) + " ";
  });
  result.length = result.length - 1;
  return result;
}
function preparePlotPoints(data) {
  var result = [], runningTotal = 0, highest = 0;
  for (var i = 1; i <= data['daysInMonth']; i++) {//go through data and make a plot point for each day
    if (data['subscriptions'][i]) {
      runningTotal += data['subscriptions'][i];
    }
    if (data['unsubscriptions'][i]) {
      runningTotal -= data['unsubscriptions'][i];
    }
    result[i] = runningTotal;
    if (runningTotal > highest) {
      highest = runningTotal;
    }
  };
  result['highest'] = highest;
  return result;
}