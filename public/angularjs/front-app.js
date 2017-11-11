var app = angular.module('app', ['LocalStorageModule','ngRoute']);

var url = "http://localhost/elifestyle/public/";

  


app.config(function ($interpolateProvider) {

    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');

});


app.config(function (localStorageServiceProvider) {
  localStorageServiceProvider
    .setPrefix('app')
    .setNotify(true, true)
});

app.controller('mainCtrl',function($scope, $http, localStorageService,$window, $route, $routeParams){

  $scope.userDetailData = [];

  $scope.appCatData = {
        id : '',
        title: ''

       };

  $scope.appPlanDatas = [];
  $scope.appAppDatas = [];

  $scope.errors = [];

  // $scope.mysession='';
  $scope.login = {
    email: '',
    password: '',
    token: ''
  }

  $scope.planDetail = {
    id: '',
    plan_title: '',
    amount: ''
  }

  $scope.subscribeMonth = {
    id: '',
    subscription_title: '',
    months: ''
  }

  $scope.subscribeMonths = [];

  $scope.register = {};

  $scope.userLoged = {
    id: '',
    fname : '',
    lname : '',
    sex : '',
    dob: '',
    contact_no: '',
    is_active : '',
    is_plan : '',
    valid_till : '',
    email: '',
    group_title: '',
    plan_title: '',
    usergroup_id: '',
    plan_id: ''

  };


  $scope.userLoged = localStorageService.cookie.get("userDetail");
  console.log("loged");
  // console.log($scope.userLoged.plan_id);
  // console.log($scope.userLoged);
  if($scope.userLoged!=null ){
    if($scope.userLoged.plan_id==null){
    console.log("plan null");
    console.log($scope.userLoged);
    $scope.userLoged.plan_id=1;
  }
  }

$http.get(url+"api/subscription-month").then(function(response){

        $scope.subscribeMonths = response.data.data;
        console.log($scope.subscribeMonths);
        // console.log(JSON.parse(response.data.data));
    });

  $scope.showApp = function (index){
    console.log(index);
  };


  $scope.subscriPlan = function($id){
    $http.get(url+"api/plan/"+$id).then(function(response){

        $scope.planDetail = response.data.data;
        console.log($scope.planDetail);
        // console.log(JSON.parse(response.data.data));
    });
    
  };


  $scope.registerUser = function(){
    console.log($scope.register);
    if($scope.register.email==null){
         Materialize.toast("email password required", 4000);
    }else if($scope.register.fname==null){
         Materialize.toast("first name required", 4000);
    }else if($scope.register.lname==null){
         Materialize.toast("last lname required", 4000);
    }else if($scope.register.sex == null){
          Materialize.toast("Gender required", 4000);
    }else if($scope.register.password==null){
         Materialize.toast("new password required", 4000);
    }else if($scope.register.confpassword==null){
         Materialize.toast("Re-confirm password required", 4000);
    }else if($scope.register.password != $scope.register.confpassword){
          Materialize.toast("new password and Re-confirm password not match try again", 4000);
    }else if($scope.register.dob==null){
         Materialize.toast("Date of Birth required", 4000);
    }else if($scope.register.contact_no==null){
         Materialize.toast("Re-confirm contact number", 4000);
    }else{
        $http.post(url+"/api/admin/add/user", {
        usergroup: 2,
        email: $scope.register.email,
        fname: $scope.register.fname,
        lname: $scope.register.lname,
        contact_no: $scope.register.contact_no,
        sex: $scope.register.sex,
        password: $scope.register.password,
        dob: $scope.register.dob
         }).then(function success(e){
          // $scope.resetForm();
          console.log("status "+e.data.status);
          if(e.data.status==200){
            // $window.location.href = url;
            $scope.logout();
          }else if(e.data.status==500){
            $scope.recordErrors(e);
            console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
            Materialize.toast(e.data.message, 4000);
  
          }

        }, function error(error){
          // $scope.recordErrors(error);
          console.log(error);
        });
    }
  };


  $scope.checkPlanAuth = function($appId,$appPlanId){
    console.log("APP"+$appPlanId);
    // console.log("frtg"+$scope.userLoged.plan_id);
    // console.log("USER"+$scope.userLoged.plan_id);
    if($scope.userLoged==null){
      $window.location.href = url+"login";
    }else if($scope.userLoged.is_plan==null){
      $window.location.href = url+"login";
    }else if($scope.userLoged.plan_id==0){
      $window.location.href = url +"plan";
    }else if($scope.userLoged.plan_id>=$appPlanId){
      console.log("ok");
      $window.open('//'+$scope.appDetailData.apk_path);
    }
    else{
         Materialize.toast('Not in Your Plan', 4000);
        Materialize.toast("upgarde your plan",5000);
    }

  };




 //login user

  $scope.loginUser = function (){
    
    if($scope.login.email==null){
       Materialize.toast('Email required!', 4000);
    }
    if($scope.login.password==null){
       Materialize.toast('password required!', 4000);
    }



   
    $http.post(url+"api/login-checkapi", { 
      email: $scope.login.email,
      password: $scope.login.password
      }).then(function success(e){
        if(e.data.status==201){
          $scope.userDetailData = e.data.data;
          console.log($scope.userDetailData);
         localStorageService.cookie.set("userDetail",$scope.userDetailData);

            var myData = localStorageService.cookie.get("userDetail");
            console.log(myData.id);
            Materialize.toast(myData.email, 4000);
             // $window.location.href = "http://localhost/elifestyle/public/";

             $('form').submit();

    $http.get(url+"api/user/"+$scope.userLoged.id).then(function(response){

        $scope.editUser = response.data.data;
        console.log($scope.editUser);
        // console.log(JSON.parse(response.data.data));
    
    });

        
        }else if(e.data.status==500){
            $scope.recordLoginErrors(e);
        }else if(e.data.status==501){
           Materialize.toast(e.data.message, 4000);
        }
      });

  };


  $scope.logout = function(){
    localStorageService.cookie.clearAll();
    $window.location.replace(url+"logout");
  }

  $scope.recordLoginErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.email){
      Materialize.toast(error.data.errors.email[0], 4000);
    }
    if(error.data.errors.password){
          Materialize.toast(error.data.errors.password[0], 4000);
        }

  };


  $http.get(url+"api/app-cat").then(function(response){

    $scope.appCatDatas = response.data.data;
    console.log("cat "+ $scope.appCatDatas);
    // console.log(JSON.parse(response.data.data));
  });


 

  $http.get(url+"api/plan").then(function(response){

    $scope.appPlanDatas = response.data.data;
    console.log($scope.appPlanDatas);
    // console.log(JSON.parse(response.data.data));
  });

  $http.get(url+"api/app").then(function(response){

    $scope.appAppDatas = response.data.data;
    console.log($scope.appAppDatas);
    // console.log(JSON.parse(response.data.data));
  });


  $scope.appData = [];
  $scope.appDetailData = [];

  $scope.initAppDetail = function(index, $id) {
    console.log("initUsergroup", $id);
    $scope.appData = $scope.appAppDatas[index];
    $http.get(url+"api/app-detail-last/"+$id).then(function(response){

    $scope.appDetailData = response.data.data;
    console.log($scope.appDetailData);
    console.log($scope.appData);
    // console.log(JSON.parse(response.data.data));
    // $("#app_detail").modal('show');
    
    });

    console.log("appData");
    console.log($scope.appData); 

  };


  $scope.profileSelect = "view";
  
  $scope.editUser = {};

  $scope.changePass = {};


  $scope.inituserUpdate = function(){
    console.log($scope.profileSelect);
    $scope.profileSelect = "edit";

    $http.get(url+"api/user/"+$scope.userLoged.id).then(function(response){

        $scope.editUser = response.data.data;
        console.log($scope.editUser);
        // console.log(JSON.parse(response.data.data));
    
    });


  }

  $scope.changePassword = function(){
    if($scope.changePass.current==null){
         Materialize.toast("current password required", 4000);
    }else if($scope.changePass.newpass==null){
         Materialize.toast("new password required", 4000);
    }else if($scope.changePass.confpass==null){
         Materialize.toast("Re-confirm password required", 4000);
    }else if($scope.changePass.newpass != $scope.changePass.confpass){
          Materialize.toast("new password and Re-confirm password not match try again", 4000);
    }else{
      $http.patch(url+"api/admin/update/user-pass/"+$scope.userLoged.id,{
        currentpass: $scope.changePass.current,
        newpass: $scope.changePass.newpass,
      }).then(function success(e){
        $scope.errors = [];
        console.log("edit "+e.data.message);
        if(e.data.status==200){
            console.log(e.data.data[0]);
            $scope.logout();
            // localStorageService.set("userDetail",e.data.data[0])
            $scope.userLoged = e.data.data[0];
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);

          }else if(e.data.status == 501){
               Materialize.toast(e.data.message, 4000);

          }
      },  function error(error){
        $scope.recordErrors(error);
      });
    }


  };



  $scope.subscribeUserPlan =function($id){
    console.log("fgvh"+$id);
    console.log($scope.userLoged.id);
    console.log($scope.subPlanSelected);
    $http.post(url+"/api/user/subscribe", {
      user_id:$scope.userLoged.id,
      plan_id:$id,
      subscription_id: $scope.subPlanSelected
         }).then(function success(e){
          // $scope.resetForm();
          console.log("status "+e.data.status);
          if(e.data.status==200){
            $window.location.href = url;
          }else if(e.data.status==500){
              $scope.recordErrors(e);
              console.log("errors "+e.data.message);
          }else if(e.data.status == 501){
            // $scope.errors.push(e.data.message);
          }

        }, function error(error){
          // $scope.recordErrors(error);
          console.log(error);
        });
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

  




  //update
    //initialize update action
    $scope.initEdit = function (index){
      $scope.errors = [];
      console.log("clicked edit " +index);
      $scope.index = index;
      // console.log("edit usergroup "+ $scope.usergroupDatas[index]);
      $scope.editUser = $scope.usergroupDatas[index];
    };



    //update the give usergroup
    $scope.updateUser = function () {
      console.log("updateUser");
      $http.patch(url+"api/admin/add/user/"+$scope.editUser.id,{
        fname: $scope.editUser.fname,
        lname: $scope.editUser.lname,
        dob: $scope.editUser.dob,
        contact_no: $scope.editUser.contact_no
      }).then(function success(e){
        $scope.errors = [];
        console.log("edit "+e.data.message);
        if(e.data.status==200){
            $scope.profileSelect = "view";
            console.log(e.data.data[0]);
            // localStorageService.set("userDetail",e.data.data[0])
            $scope.userLoged = e.data.data[0];
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


      $scope.recordErrors = function (error) {
    $scope.errors = [];
    if(error.data.errors.fname){
     Materialize.toast(error.data.errors.fname[0], 4000);
     }
    if(error.data.errors.lname){
     Materialize.toast(error.data.errors.lname[0], 4000);
     }
    if(error.data.errors.dob){
      Materialize.toast(error.data.errors.dob[0], 4000);
    }
    if(error.data.errors.currentpass){
      Materialize.toast(error.data.errors.currentpass[0], 4000);
    }
    if(error.data.errors.password){
      Materialize.toast(error.data.errors.password[0], 4000);
    }
    if(error.data.errors.email){
      Materialize.toast(error.data.errors.email[0], 4000);
    }
    if(error.data.errors.sex){
      Materialize.toast(error.data.errors.sex[0], 4000);
    }
    if(error.data.errors.contact_no){
      Materialize.toast(error.data.errors.contact_no[0], 4000);
    }
  
  };


    // //deleter the usergroup
    // $scope.deleteUsergroup = function (index){
    //   var conf = confirm("Do you really want to delete "+$scope.usergroupDatas[index].group_title+"  ?");
    //   if(conf == true){
    //     $http.delete(url+"api/admin/add/usergroup/"+$scope.usergroupDatas[index].id)
    //     .then(function success(e){
    //       if(e.data.status==200){
    //         $scope.usergroupDatas.splice(index,1);
    //       }else if(e.data.status==500){
    //           // $scope.recordErrors(e);
    //           console.log("errors "+e.data.message);

    //       }else if(e.data.status == 501){
    //         // $scope.errors.push(e.data.message);
    //         console.log("errors "+e.data.message);

    //       }  
    //     });
    //   }
    // }; 




});



/***********************************************************************************************************************************/
