
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */




 var app = angular.module('app', ['ngImgCrop']);

 var url = "http://localhost/elifestyle/public/index.php/";

  


app.config(function ($interpolateProvider) {

    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');

});

app.controller('usergroupCtrl',function($scope, $http){

  $scope.usergroupDatas = [];

  $scope.usergroupData = {
        id : '',
        group_title: ''

       };

  $scope.errors = [];

  $scope.index='';

 


  $http.get(url+"api/admin/add/usergroup").then(function(response){

    $scope.usergroupDatas = response.data.data;
    console.log($scope.usergroupDatas);
    // console.log(JSON.parse(response.data.data));
  });


  $scope.initUsergroup = function() {
    console.log("initUsergroup");

  	$scope.resetForm();
  	$("#add_new_usergroup").modal('show');
  };

  //Add new TAsk
  $scope.addUsergroup = function () {
  	$http.post(url+"/api/admin/add/usergroup", {
  			group_title: $scope.usergroupData.group_title }).then(function success(e){
  				$scope.resetForm();
  				console.log("status "+e.data.status);
          if(e.data.status==200){
              console.log($scope.usergroupData.group_title);
              $scope.usergroupDatas.push(e.data.data);
              $("#add_new_usergroup").modal('hide');
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

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
  };


  //update

  $scope.editUsergroup = {};
    //initialize update action
    $scope.initEdit = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      $scope.index = index;
      // console.log("edit usergroup "+ $scope.usergroupDatas[index]);
      $scope.editUsergroup = $scope.usergroupDatas[index];
      $("#edit_usergroup").modal('show');
    };



    //update the give usergroup
    $scope.updateUsergroup = function () {
      $http.patch(url+"api/admin/add/usergroup/"+$scope.editUsergroup.id,{
        group_title: $scope.editUsergroup.group_title
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        $("#edit_usergroup").modal('hide');

        if(e.data.status==200){
              $("#add_new_usergroup").modal('hide');
              console.log($scope.index);
              $scope.usergroupDatas[index].group_title = $scope.usergroupData.group_title;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    };


    //deleter the usergroup
    $scope.deleteUsergroup = function (index){
      var conf = confirm("Do you really want to delete "+$scope.usergroupDatas[index].group_title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/add/usergroup/"+$scope.usergroupDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.usergroupDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 




});



/***********************************************************************************************************************************/

//user
app.controller('userCtrl', function($scope, $http){
  
  $scope.usergroupDatas = [];

  $scope.userDatas = [];

  $scope.plans = [];

  $scope.subscriptionDatas = [];

  $scope.userData = {
    email : '',
    id:'',
    fname:'',
    lname: '',
    sex: 'male',
    dob: '',
    contact_no: '',
    device_id: '',
    is_active: '',
    is_plan: '',
    valid_till: '',
    is_blocked: '',
    group_title: '',
    plan_title: '',
    usergroup_id: '',
    password:'',
    plan_id: '',
    subscription_title: '',
    subscription_id : '',
    subscription_months: '',
    plan_amount: ''
  };

  url_user = url+"api/admin/add/user";

    $scope.errors = [];

    $http.get(url+"api/admin/add/usergroup").then(function(response){

    $scope.usergroupDatas = response.data.data;
    console.log($scope.usergroupDatas);
    // console.log(JSON.parse(response.data.data));
    });

    $http.get(url+"api/plan").then(function(response){

    $scope.plans = response.data.data;
    console.log($scope.plans);
    // console.log(JSON.parse(response.data.data));
    });


  $http.get(url+"api/subscription-month").then(function(response){

    $scope.subscriptionDatas = response.data.data;
    console.log($scope.subscriptionDatas);
    // console.log(JSON.parse(response.data.data));
  });


    $http.get(url_user).then( function(response){

      $scope.userDatas = response.data.data;
      console.log($scope.userDatas);
    });


  //add neew user
  $scope.initUser= function() {
    console.log("initUser");

    $scope.resetForm();
    $("#add_new_user").modal('show');
  };



  //Add new TAsk
  $scope.addUser = function () {
    $http.post(url_user, {
      email: $scope.userData.email,
      fname: $scope.userData.fname,
      lname:$scope.userData.lname,
      sex:$scope.userData.sex,
      dob:$scope.userData.dob,
      contact_no:$scope.userData.contact_no,
      usergroup:$scope.userData.usergroup_id,
      password:$scope.userData.password,
      plan_id:$scope.userData.plan_id,
      subscription_id:$scope.userData.subscription_id,
      is_plan:1

      }).then(function success(e){
          
          console.log("status "+e.data.status);
          if(e.data.status==200){
              // console.log($scope.usergroupData.group_title);
              $scope.usergroupDatas.push(e.data.data);
              $scope.resetForm();
              $("#add_new_user").modal('hide');
          }else if(e.data.status==500){
              console.log("errors "+e.data.message);
              
              $scope.recordErrors(e);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

        }, function error(error){
          $scope.recordErrors(error);
        });
  };

  $scope.recordErrors = function (error) {
    $scope.errors = [];
    
    if(error.data.errors.usergroup){
      $scope.errors.push(error.data.errors.usergroup[0]);
    }
    if(error.data.errors.email){
      $scope.errors.push(error.data.errors.email[0]);
    }
    if(error.data.errors.password){
      $scope.errors.push(error.data.errors.password[0]);
    }
    if(error.data.errors.fname){
      $scope.errors.push(error.data.errors.fname[0]);
    }
    if(error.data.errors.sex){
      $scope.errors.push(error.data.errors.sex[0]);
    }
    if(error.data.errors.contact_no){
      $scope.errors.push(error.data.errors.contact_no[0]);
    }



  };

  $scope.resetForm = function () {
    $scope.userData.fname = '';
    $scope.userData.lname = '';
    $scope.userData.sex = '';
    $scope.userData.dob = '';
    $scope.userData.contact_no = '';
    $scope.userData.usergroup_id = '';
    $scope.userData.password = '';
    $scope.userData.email = '';
    $scope.userData.subscription_id='';
    $scope.userData.plan_id='';
    $scope.errors = [];
  };





});






//----------------------------------------------------------------------------------------------------------------

app.controller('planCtrl',function($scope, $http){


  $scope.planDatas = [];
  $scope.subscriptionMonthDatas = [];
  $scope.errors = [];
  $scope.selection = 'plan';
  $scope.planData = {
    'plan_title' : '',
    'amount' : '',
    'id' : ''
  };

  $scope.subscriptionData = {
    'subscription_title' : '',
    'months' : '',
    'id' : ''
  };

  $http.get(url+"api/plan").then(function(response){

    $scope.planDatas = response.data.data;
    console.log($scope.planDatas);
    // console.log(JSON.parse(response.data.data));
  });

  $http.get(url+"api/subscription-month").then(function(response){

    $scope.subscriptionMonthDatas = response.data.data;
    console.log($scope.subscriptionMonthDatas);
    // console.log(JSON.parse(response.data.data));
  });

  $scope.selectedPart = function (select) {
    $scope.selection = select;
    console.log("selection "+select);
  };


  $scope.initPlan = function() {
    // console.log("initUsergroup");

    $scope.resetPlanForm();
    $("#add_new_plan").modal('show');
  };

  //Add new TAsk
  $scope.addPlan = function () {
    $http.post(url+"/api/admin/add/plan", {
        plan_title: $scope.planData.plan_title,
        amount: $scope.planData.amount
         }).then(function success(e){
          $scope.resetPlanForm();
          console.log("status "+e.data.status);
          if(e.data.status==200){
              // console.log($scope.planData.group_title);
              $scope.planDatas.push(e.data.data);
              $("#add_new_plan").modal('hide');
          }else if(e.data.status==500){
              $scope.recordPlanErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

        }, function error(error){
          $scope.recordPlanErrors(error);
        });
  };

  $scope.recordPlanErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.plan_title){
      $scope.errors.push(error.data.errors.plan_title[0]);
    }
    if(error.data.errors.amount){
      $scope.errors.push(error.data.errors.amount[0]);
    }


  };

  $scope.resetPlanForm = function () {
    $scope.planData.plan_title = '';
    $scope.planData.id = '';
    $scope.planData.amount = '';
    $scope.errors = [];
  };


  //update

  $scope.editPlan = {};
    //initialize update action
    $scope.initEditPlan = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      // console.log("edit usergroup "+ $scope.usergroupDatas[index]);
      $scope.editPlan = $scope.planDatas[index];
      $("#edit_plan").modal('show');
    };



    //update the give usergroup
    $scope.updatePlan = function () {
      $http.patch(url+"api/admin/update/plan/"+$scope.editPlan.id,{
        plan_title: $scope.editPlan.plan_title,
        amount: $scope.editPlan.amount
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        // $("#edit_plan").modal('hide');

        if(e.data.status==200){
              $("#edit_plan").modal('hide');
              console.log($scope.index);
              $scope.planDatas[index].plan_title = e.data.data.plan_title;
              $scope.planDatas[index].amount = e.data.data.amount;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    };


    //deleter the plan
    $scope.deletePlan = function (index){
      var conf = confirm("Do you really want to delete "+$scope.planDatas[index].plan_title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/plan/"+$scope.planDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.planDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 


  $scope.initSubscription = function() {
    // console.log("initUsergroup");

    $scope.resetSubscriptionForm();
    $("#add_new_subscription").modal('show');
  };

  //Add new TAsk
  $scope.addSubscription = function () {
    console.log('sub '+$scope.subscriptionData.subscription_title);
    $http.post(url+"api/admin/add/subscription-month", {
        subscription_title: $scope.subscriptionData.subscription_title,
        months: $scope.subscriptionData.months
         }).then(function success(e){
          $scope.resetSubscriptionForm();
          console.log("status "+e.data.data);
          if(e.data.status==200){
              // console.log($scope.subscriptionData.group_title);
              $scope.subscriptionMonthDatas.push(e.data.data);
              $("#add_new_subscription").modal('hide');
          }else if(e.data.status==500){
              $scope.recordSubscriptionErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

        }, function error(error){
          $scope.recordSubscriptionErrors(error);
        });
  };

  $scope.recordSubscriptionErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.subscription_title){
      $scope.errors.push(error.data.errors.subscription_title[0]);
    }
    if(error.data.errors.months){
      $scope.errors.push(error.data.errors.months[0]);
    }


  };

  $scope.resetSubscriptionForm = function () {
    $scope.subscriptionData.subscription_title = '';
    $scope.subscriptionData.id = '';
    $scope.subscriptionData.months = '';
    $scope.errors = [];
  };



  //update

  $scope.editSubscription = {};
    //initialize update action
    $scope.initEditSubscription = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      // console.log("edit usergroup "+ $scope.usergroupDatas[index]);
      $scope.editSubscription = $scope.subscriptionMonthDatas[index];
      $("#edit_subscription").modal('show');
    };



    //update the give usergroup
    $scope.updateSubscription = function () {
      console.log($scope.editSubscription);
      $http.patch(url+"api/admin/update/subscription-month/"+$scope.editSubscription.id,{
        subscription_title: $scope.editSubscription.subscription_title,
        months: $scope.editSubscription.months
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        // $("#edit_plan").modal('hide');
        console.log(e.data);
        if(e.data.status==200){
              $("#edit_subscription").modal('hide');
              console.log(e.data.data);
              $scope.subscriptionMonthDatas[index].subscription_title = e.data.data.subscription_title;
              $scope.subscriptionMonthDatas[index].months = e.data.data.months;
          }else if(e.data.status==500){
              $scope.recordSubscriptionErrors(e);
              console.log("errors "+e.data.message);
               console.log(e.data.data);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
            $scope.errors.push(e.data.errors);
          }
      },  function error(error){
        $scope.recordSubscriptionErrors(error);
      });
    };


    //deleter the plan
    $scope.deleteSubscription = function (index){
      var conf = confirm("Do you really want to delete "+$scope.subscriptionMonthDatas[index].plan_title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/subscription-month/"+$scope.subscriptionMonthDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.subscriptionMonthDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 




});




/************************************************************************************************************************************/


app.controller('appPermissionCtrl',function($scope, $http){

  $scope.appPerDatas = [];

  $scope.appPerData = {
        id : '',
        permission_title: ''

       };

  $scope.errors = [];

  $scope.index='';

 


  $http.get(url+"api/app-permission").then(function(response){

    $scope.appPerDatas = response.data.data;
    console.log($scope.appPerDatas);
    // console.log(JSON.parse(response.data.data));
  });


  $scope.initAppPermission = function() {
    console.log("initUsergroup");

    $scope.resetForm();
    $("#add_new_app_permission").modal('show');
  };

  //Add new TAsk
  $scope.addAppPermission = function () {
    $http.post(url+"/api/admin/add/app-permission", {
        permission_title: $scope.appPerData.permission_title }).then(function success(e){
          $scope.resetForm();
          console.log("status "+e.data.status);
          if(e.data.status==200){
              console.log($scope.appPerData.permission_title);
              $scope.appPerDatas.push(e.data.data);
              $("#add_new_app_permission").modal('hide');
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

        }, function error(error){
          $scope.recordErrors(error);
        });
  };

  $scope.recordErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.permission_title){
      $scope.errors.push(error.data.errors.permission_title[0]);
    }

  };

  $scope.resetForm = function () {
    $scope.appPerData.permission_title = '';
    $scope.appPerData.id = '';
    $scope.errors = [];
  };


  //update

  $scope.editAppPermission = {};
    //initialize update action
    $scope.initEdit = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      $scope.index = index;
      // console.log("edit usergroup "+ $scope.appPerDatas[index]);
      $scope.editAppPermission = $scope.appPerDatas[index];
      $("#edit_app_permission").modal('show');
    };



    //update the give usergroup
    $scope.updateAppPermission = function () {
      $http.patch(url+"api/admin/update/app-permission/"+$scope.editAppPermission.id,{
        permission_title: $scope.editAppPermission.permission_title
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        $("#edit_app_permission").modal('hide');

        if(e.data.status==200){
              $("#add_new_app_permission").modal('hide');
              console.log($scope.index);
              $scope.appPerDatas[index].permission_title = $scope.appPerData.permission_title;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    };


    //deleter the usergroup
    $scope.deleteAppPermission = function (index){
      var conf = confirm("Do you really want to delete "+$scope.appPerDatas[index].permission_title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/app-permission/"+$scope.appPerDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.appPerDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 




});



/***********************************************************************************************************************************/


/************************************************************************************************************************************/


app.controller('appCategoryCtrl',function($scope, $http){

  $scope.appCatDatas = [];

  $scope.appCatData = {
        id : '',
        title: ''

       };

  $scope.errors = [];

  $scope.index='';

 


  $http.get(url+"api/app-cat").then(function(response){

    $scope.appCatDatas = response.data.data;
    console.log($scope.appCatDatas);
    // console.log(JSON.parse(response.data.data));
  });


  $scope.initAppcategory = function() {
    // console.log("initUsergroup");

    $scope.resetForm();
    $("#add_new_app_category").modal('show');
  };

  //Add new TAsk
  $scope.addAppcategory = function () {
    $http.post(url+"/api/admin/add/app-cat", {
        title: $scope.appCatData.title }).then(function success(e){
          $scope.resetForm();
          console.log("status "+e.data.status);
          if(e.data.status==200){
              console.log($scope.appCatData.title);
              $scope.appCatDatas.push(e.data.data);
              $("#add_new_app_category").modal('hide');
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }

        }, function error(error){
          $scope.recordErrors(error);
        });
  };

  $scope.recordErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.title){
      $scope.errors.push(error.data.errors.title[0]);
    }

  };

  $scope.resetForm = function () {
    $scope.appCatData.title = '';
    $scope.appCatData.id = '';
    $scope.errors = [];
  };


  //update

  $scope.editAppcategory = {};
    //initialize update action
    $scope.initEdit = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      $scope.index = index;
      // console.log("edit usergroup "+ $scope.appCatDatas[index]);
      $scope.editAppcategory = $scope.appCatDatas[index];
      $("#edit_app_category").modal('show');
    };



    //update the give usergroup
    $scope.updateAppcategory = function () {
      $http.patch(url+"api/admin/update/app-cat/"+$scope.editAppcategory.id,{
        title: $scope.editAppcategory.title
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        $("#edit_app_category").modal('hide');

        if(e.data.status==200){
              $("#add_new_app_category").modal('hide');
              console.log($scope.index);
              $scope.appCatDatas[index].title = $scope.appCatData.title;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    };


    //deleter the usergroup
    $scope.deleteAppcategory = function (index){
      var conf = confirm("Do you really want to delete "+$scope.appCatDatas[index].title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/app-cat/"+$scope.appCatDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.appCatDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 




});



/***********************************************************************************************************************************/

/************************************************************************************************************************************/


app.controller('app-registerCtrl',function($scope, $http){

  $scope.appRegDatas = [];

  $scope.appRegData = {
        id : '',
        title: '',
        description:'',
        logo_path:'',
        logo:'',
        plan_id:'',
        plan_title:'',
        app_category_id:'',
        app_category_title:'',
        is_active:'',
        app_package_name: ''
       };

  $scope.selection ='app-register';

  $scope.errors = [];

  $scope.appCatDatas = [];

  $scope.appCatData = {
        id : '',
        title: ''

       };

  $scope.appPlanDatas = [];

  $scope.appPlanData = {
        id : '',
        plan_title: ''

       };

  $scope.appDetailDatas = [];



  $scope.selectedPart = function (select) {
    $scope.selection = select;
    console.log("selection "+select);
  };



$scope.myImage='';
        $scope.myCroppedImage='';

        var handleFileSelect=function(evt) {
          var file=evt.currentTarget.files[0];
          var reader = new FileReader();
          reader.onload = function (evt) {
            $scope.$apply(function($scope){
              $scope.myImage=evt.target.result;
              console.log($scope.myCroppedImage);
            });
          };
          reader.readAsDataURL(file);
        };
        angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);

  $scope.uploadImg = function(){
      $('#crop-img').modal('show');
  }

  $http.get(url+"api/app-cat").then(function(response){

    $scope.appCatDatas = response.data.data;
    console.log($scope.appCatDatas);
    // console.log(JSON.parse(response.data.data));
  });

  $http.get(url+"api/plan").then(function(response){

    $scope.appPlanDatas = response.data.data;
    console.log($scope.appPlanDatas);
    // console.log(JSON.parse(response.data.data));
  });


  $http.get(url+"api/app").then(function(response){

    $scope.appRegDatas = response.data.data;
    console.log($scope.appRegDatas);
    // console.log(JSON.parse(response.data.data));
  });



  $scope.recordErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.title){
      $scope.errors.push(error.data.errors.title[0]);
    }
    if(error.data.errors.plan_id){
      $scope.errors.push(error.data.errors.plan_id[0]);
    }
    if(error.data.errors.category_id){
      $scope.errors.push(error.data.errors.category_id[0]);
    }

  };



  $scope.resetForm = function () {
    $scope.appRegData.title = '';
    $scope.appRegData.id = '';
    $scope.errors = [];
    $scope.appRegData.description = '';
        
    $scope.appRegData.app_plan_id = '';
    $scope.appRegData.app_category_id ='';

  };


  //update

  $scope.editAppReg = {};
    //initialize update action
    $scope.initEditAppReg = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      $scope.index = index; 
      // console.log("edit usergroup "+ $scope.appRegDatas[index]);
      $scope.editAppReg = $scope.appRegDatas[index];
      $("#edit_app_reg").modal('show');
    };


   
  $scope.initaddAppDetail = function(index){
    $scope.errors = [];
    $scope.editDetail = $scope.appRegDatas[index];
    console.log('dfgh'+$scope.editDetail);
    $('#add_detail').modal('show');
  }

  $scope.appRegDetail = {};

  $scope.initAppDetail = function(index){
    $scope.errors = [];
    // console.log('jgvhnj');
      $http.get(url+"api/app-detail/"+$scope.appRegDatas[index].id).then(function(response){

    $scope.appDetailsDatas = response.data.data;
    $scope.appRegDetail = $scope.appRegDatas[index];
    console.log($scope.appDetailsDatas);
    // console.log(JSON.parse(response.data.data));
    $('#app_detail_show').modal('show');
     });

  }




    $scope.addAppDetail = function(){
      $http.post(url+"api/admin/add/app-detail",{
        version: $scope.editDetail.version,
        app_id: $scope.editDetail.id,
        apk_path: $scope.editDetail.apk_path,
        developer: $scope.editDetail.developer,
        app_package_name: $scope.editDetail.app_package_name
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        // $("#add_detail").modal('hide');

        if(e.data.status==200){
              $("#add_detail").modal('hide');
              window.location.reload(true);
              console.log($scope.index);
              $scope.appRegDatas[index].title = $scope.appRegData.title;
          }else if(e.data.status==500){
              $scope.recordAppDetailErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordAppDetailErrors(error);
      });
    };


    $scope.addMoreAppDetails = function($value){
      $('#app_detail_show').modal('hide');
      // $scope.editDetail = $scope.appRegDatas[].;
      $scope.editDetail = $scope.appRegDetail;
      console.log($scope.appRegDetail);
      $('#add_detail').modal('show');
    }

  $scope.editDetail ={};
  $scope.selectionEdit = "app_detail_list";
  
  $scope.selectedPartEdit = function (index){

    $scope.selectionEdit = "edit_detail";
    $scope.editDetail = $scope.appDetailsDatas[index];
    console.log('hsb'+$scope.editDetail);

  }

  $scope.selectedPartback = function(index){

   
    $scope.selectionEdit = "app_detail_list";

  }
  



    //update the give usergroup
    $scope.updateAppcategory = function () {
      $http.patch(url+"api/admin/update/app/"+$scope.appRegDetail.id,{
        title: $scope.editAppReg.title
      }).then(function success(e){
        $scope.errors = [];
        // console.log("edit "+e.data.message);
        $("#edit_app_category").modal('hide');

        if(e.data.status==200){
              $("#add_new_app_category").modal('hide');
              console.log($scope.index);
              $scope.appRegDatas[index].title = $scope.appRegData.title;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    };


    //update the give appdetail
    $scope.updateAppDetail = function () {
      $http.patch(url+"api/admin/update/app-detail/"+$scope.editDetailsData.id,{
        app_id: $scope.editDetail.app_id,
        version: $scope.editDetail.version,
        apk_path: $scope.editDetail.apk_path,
        developer: $scope.editDetail.developer,
        app_package_name: $scope.editDetail.app_package_name
      }).then(function success(e){
        $scope.errors = [];

        if(e.data.status==200){
              // $("#add_new_app_category").modal('hide');
              $scope.selectionEdit = "app_detail_list";
              // console.log($scope.index);
              // $scope.appRegDatas[index].title = $scope.appRegData.title;
          }else if(e.data.status==500){
              $scope.recordAppDetailErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            $scope.errors.push(e.data.message);
          }
      },  function error(error){
        $scope.recordAppDetailErrors(error);
      });
    };


    //deleter the AppReg
    $scope.deleteAppReg = function (index){
      var conf = confirm("Do you really want to delete "+$scope.appRegDatas[index].title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/app/"+$scope.appRegDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.appRegDatas.splice(index,1);
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 

    //deleter the deleteAppDetail
    $scope.deleteAppDetail = function (index){
      var conf = confirm("Do you really want to delete "+$scope.appDetailsDatas[index].title+"  ?");
      if(conf == true){
        $http.delete(url+"api/admin/delete/app-detail/"+$scope.appDetailsDatas[index].id)
        .then(function success(e){
          if(e.data.status==200){
            $scope.appDetailsDatas.splice(index,1);
            $('#app_detail_show').modal('hide');
            window.location.reload(true);
   
          }else if(e.data.status==500){
              // $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            console.log("errors "+e.data.message);

          }  
        });
      }
    }; 


    $scope.recordAppDetailErrors = function (error) {
        $scope.errors = [];
        if(error.data.errors.app_id){
          $scope.errors.push(error.data.errors.app_id[0]);
        }
        if(error.data.errors.version){
          $scope.errors.push(error.data.errors.version[0]);
        }
        if(error.data.errors.apk_path){
          $scope.errors.push(error.data.errors.apk_path[0]);
        }
        if(error.data.errors.developer){
          $scope.errors.push(error.data.errors.developer[0]);
        }
        if(error.data.errors.app_package_name){
          $scope.errors.push(error.data.errors.app_package_name[0]);
        }


    };




});




/***********************************************************************************************************************************/



