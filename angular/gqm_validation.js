
  "use strict";
  angular
    .module('app', ['ngMessages'])
    .controller('MainCtrl', MainCtrl)
    .directive('passwordVerify', passwordVerify);

  function MainCtrl($scope) {
    // Some code
	
	$scope.checkErr = function(startDate,endDate) 
	{
		$scope.errMessage = '';
		var curDate = new Date();

		if(new Date(startDate) > new Date(endDate)){
		  $scope.errMessage = 'End Date should be greater than start date';
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
  }

  function passwordVerify() {
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
        };
      }
    }
  }
  
  
