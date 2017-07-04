var myApp = angular.module('app', ['ngMessages']);

 myApp.controller('CodeCtrl', function($scope) {

  $scope.dev_list = [{dev : '0'}];
  $scope.rev_list = [{rev: '0'}];

  $scope.item_dev = $scope.dev_list.length; // check button
  $scope.item_rev = $scope.rev_list.length;
  
  $scope.addNewDev = function() {
	$scope.item_dev = $scope.dev_list.length+1;
    $scope.dev_list.push({'dev':$scope.dev});
  };
    
  $scope.removeDev = function() {
	$scope.item_dev = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
	$scope.item_rev = $scope.rev_list.length+1;
    $scope.rev_list.push({'rev':$scope.rev});
  };
    
  $scope.removeRev = function() {
	$scope.item_rev = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
    
});

  myApp.controller('UTPCtrl', function($scope) {

  $scope.dev_list = [{dev : '0'}];
  $scope.rev_list = [{rev: '0'}];

  $scope.item_dev = $scope.dev_list.length; // check button
  $scope.item_rev = $scope.rev_list.length;
  
  $scope.addNewDev = function() {
	$scope.item_dev = $scope.dev_list.length+1;
    $scope.dev_list.push({'dev':$scope.dev});
  };
    
  $scope.removeDev = function() {
	$scope.item_dev = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
	$scope.item_rev = $scope.rev_list.length+1;
    $scope.rev_list.push({'rev':$scope.rev});
  };
    
  $scope.removeRev = function() {
	$scope.item_rev = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
  
});

myApp.controller('UTECtrl', function($scope) {

  $scope.dev_list = [{dev : '0'}];
  $scope.rev_list = [{rev: '0'}];

  $scope.item_dev = $scope.dev_list.length; // check button
  $scope.item_rev = $scope.rev_list.length;
  
  $scope.addNewDev = function() {
	$scope.item_dev = $scope.dev_list.length+1;
    $scope.dev_list.push({'dev':$scope.dev});
  };
    
  $scope.removeDev = function() {
	$scope.item_dev = $scope.dev_list.length-1;
    $scope.dev_list.splice(lastItem);
  };
  
  $scope.addNewRev = function() {
	$scope.item_rev = $scope.rev_list.length+1;
    $scope.rev_list.push({'rev':$scope.rev});
  };
    
  $scope.removeRev = function() {
	$scope.item_rev = $scope.rev_list.length-1;
    $scope.rev_list.splice(lastItem);
  };
  
});

myApp.controller('MainCtrl',function ($scope) {	
	

	$scope.checkErr = function(startDate,endDate) 
	{
		$scope.errMessage = '';
		var curDate = new Date();

		if(new Date(startDate) > new Date(endDate)){
		  $scope.errMessage = 'End Date should be greater than start date';
		  return false;
		}
		else
		{
			$scope.errMessage = '';
			return false;
		}
	};
	
	$scope.set_pnx =  function(proj_name)
	{
		if($scope.main.p_name)
		{
			$scope.td_name = 'Accenture Intralot - ' + proj_name + ' - Technical Design ver.1';
			$scope.ee_name = proj_name + ' - Entry-Exit Criteria';
		}
		else
		{
			$scope.td_name = '';
			$scope.ee_name = '';
		}
	}
	
	
	$scope.regex = RegExp('^((https?|ftp)://)?([a-z]+[.])?[a-z0-9-]+([.][a-z]{1,4}){1,2}(/.*[?].*)?$', 'i');
  });

myApp.directive('passwordVerify',function () {
    return {
      restrict: 'A', // only activate on element attribute
      require: '?ngModel', // get a hold of NgModelController
      link: function(scope, elem, attrs, ngModel) {
        if (!ngModel) return; // do nothing if no ng-model

        // watch own value and re-validate on change
        scope.$watch(attrs.ngModel, function() {
          validate();
        });

        // observe the other value and re-validate on change
        attrs.$observe('passwordVerify', function(val) {
          validate();
        });

        var validate = function() {
          // values
          var val1 = ngModel.$viewValue;
          var val2 = attrs.passwordVerify;

          // set validity
          ngModel.$setValidity('passwordVerify', val1 === val2);
        }
      }
    };
  });