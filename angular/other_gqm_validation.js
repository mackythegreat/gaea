var myApp = angular.module('app', []);
  myApp.controller('CodeCtrl', function($scope) {

  $scope.dev_list = [{id: 'dev1'}];
  $scope.rev_list = [{id: 'rev1'}];
  
  $scope.addNewDev = function() {
    var newItemNo = $scope.dev_list.length+1;
    $scope.dev_list.push({'id':'dev'+newItemNo});
  };
    
  $scope.removeDev = function() {
    var lastItem = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
    var newItemNo = $scope.rev_list.length+1;
    $scope.rev_list.push({'id':'rev'+newItemNo});
  };
    
  $scope.removeRev = function() {
    var lastItem = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
  
});

  myApp.controller('UTPCtrl', function($scope) {

  $scope.dev_list = [{id: 'dev1'}];
  $scope.rev_list = [{id: 'rev1'}];
  
  $scope.addNewDev = function() {
    var newItemNo = $scope.dev_list.length+1;
    $scope.dev_list.push({'id':'dev'+newItemNo});
  };
    
  $scope.removeDev = function() {
    var lastItem = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
    var newItemNo = $scope.rev_list.length+1;
    $scope.rev_list.push({'id':'rev'+newItemNo});
  };
    
  $scope.removeRev = function() {
    var lastItem = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
  
});

  myApp.controller('UTECtrl', function($scope) {

  $scope.dev_list = [{id: 'dev1'}];
  $scope.rev_list = [{id: 'rev1'}];
  
  $scope.addNewDev = function() {
    var newItemNo = $scope.dev_list.length+1;
    $scope.dev_list.push({'id':'dev'+newItemNo});
  };
    
  $scope.removeDev = function() {
    var lastItem = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
    var newItemNo = $scope.rev_list.length+1;
    $scope.rev_list.push({'id':'rev'+newItemNo});
  };
    
  $scope.removeRev = function() {
    var lastItem = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
  
});