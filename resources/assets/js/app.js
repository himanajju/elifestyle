
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */





 var app = angular.module('app', []);

       $scope.errors = [];

       
app.config(function ($interpolateProvider) {

    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});

app.controller('myCtrl',function($scope, $http){

  $scope.usergroupDatas = [];

  $scope.usergroupData = {
        id : '',
        group_title: ''

       };


  $http.get("{{ url('/api/admin/add/usergroup')}}").then(function(response){

    $scope.usergroupDatas = response.data.data;
    // console.log(JSON.parse(response.data.data));
  });


  $scope.initUsergroup = function() {
  	$scope.resetForm();
  	$("#add_new_usergroup").modal('show');
  };

  //Add new TAsk
  $scope.addUsergroup = function () {
  	$http.post("{{ url('/api/admin/add/usergroup')}}", {
  			group_title: $scope.usergroupData.group_title }).then(function success(e){
  				$scope.resetForm();
  				$scope.usergroupDatas.push('e.data.data');
  				$("#add_new_usergroup").modal('hide');
  			}, function error(error){
  				$scope.recordErrors(error);
  			});
  };

  $scope.recordErrors = function (error) {
  	$scope.errors = [];
  	if(error.data.errors.group_title){
  		$scope.errors.push(error.data.errors.group_title[0]);
  	}

  };

  $scope.resetForm = function () {
  	$scope.usergroupData.group_title = '';
  	$scope.usergroupData.id = '';
  	$scope.errors = [];
  }



});