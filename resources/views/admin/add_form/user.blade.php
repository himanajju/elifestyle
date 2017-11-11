@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-app="app" ng-controller="userCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add</li>
        <li class="active">User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list usergroup-->
      <div class="row">
      <div class="col">
      <div class="box">
      <div class="box-header with-border">

        <h3 class="box-title">Users list </h3>

        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

      <span><!-- 
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Sort<span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="persentation"><a role="menuitem" tabindex="-1" href="#" ng-model='sortBy'> All</li>
            <li ng-repeat="usergroupData in usergroupDatas" role="persentation" ng-model='sortBy'>
              <a role="menuitem" tabindex="-1" href="#">[[ usergroupData.group_title ]]
              </a></li>
          </ul>
          </div> -->
          <!-- <div class="input-group mb-2 mr-sm-2 mb-sm-0 pull-right"> -->
          <!-- <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div> -->
          <select  name="usergroup" ng-model="sortBy">
            <option ng-repeat="usergroupData in usergroupDatas" value="[[ usergroupData.group_title ]]">[[ usergroupData.group_title ]]</option>
          </select>

      </span>
                  <span><button type="button" class="btn btn-primary" ng-click="initUser()">
  <i class="fa fa-fw fa-user-plus"></i>
</button>
      </span> 

    </div>
  </div>
      <div class="box-body table-responsive">

              <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>Action</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Usergroup</th>
            <th>Contact no</th>
            <th>DOB</th>
            <th>Plan</th>
            <th>Active</th>
            <th>Blocked</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in userDatas | filter: sortBy">
          <td>[[ $index+1 ]]</td>
         <td>
          <button class="btn btn-success btn-xs" ng-click="initEdit($index)">Edit</button>
          <button class="btn btn-danger btn-xs" ng-click="deleteUsergroup($index)" >Delete</button>
          </td>
          <td>[[ data.fname +" "+ data.lname ]]</td>
          <td>[[ data.sex ]]</td>
          <td>[[ data.email]]</td>
          <td>[[ data.group_title ]]</td>
          <td>[[ data.contact_no ]]</td>
          <td>[[ data.dob ]]</td>
          <td ng-if=" data.is_plan == 0 "> FREE </td>
          <td ng-if="data.is_plan != 0"> [[ data.plan_title ]] </td>
          <td ng-if="data.is_active!=0"><span><i class="fa fa-check-circle"></i></span></td>
          <td ng-if="data.is_active==0"><span><i class="fa  fa-remove"></i></span></td>
          <td ng-if="data.is_blocked!=0"><span><i class="fa fa-check-circle"></i></span></td>
          <td ng-if="data.is_blocked==0"><span><i class="fa  fa-remove"></i></span></td>
          <!-- <td>[[ data.is_blocked ]]</td> -->
       </tr>
          </tbody>
      </table>
      </div>
     
      </div>
      </div>
      </div>
      
    </section>
    <!-- /.content -->


 <!-- Modal edit -->
<div class="modal fade" id="edit_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @component('alert.alert-danger')
        <ul>
          <li ng-repeat="error in errors">
            [[ error ]]
          </li>
        </ul>
      @endcomponent       
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/usergroup')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">Usergroup</label>
        
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-envelope-o"></i></div>
          <input type="email" class="form-control" id="inlineFormInputGroup" placeholder="email" name="email" ng-model="editUser.email">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="First name" name="fname" ng-model="editUser.fname">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Last name" name="lname" ng-model="editUser.lname">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
          <select class="form-control" name="usergroup" ng-model="editUser.usergroup_id">
            <option ng-repeat="usergroupData in usergroupDatas" value="[[ usergroupData.id ]]">[[ usergroupData.group_title ]]</option>
          </select>
        </div>
        <div class="form-group">
          <div class="radio">
            <label>
              <input type="radio" name="sex" value="male">Male
            </label>
            <label>
              <input type="radio" name="sex" value="female">Female
            </label>
            <label>
              <input type="radio" name="sex" value="trigender">Trigender
            </label>
          </div>
        </div>

        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
          <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Date Of Birth" name="dob" ng-model="editUser.dob">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Last name" name="lname" ng-model="editUser.lname">
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updateUser()">Add Usergroup</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>



 <!-- Modal add new -->
<div class="modal fade" id="add_new_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @component('alert.alert-danger')
        <ul>
          <li ng-repeat="error in errors">
            [[ error ]]
          </li>
        </ul>
      @endcomponent       
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/usergroup')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">Usergroup</label>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-envelope-o"></i></div>
          <input type="email" class="form-control" id="inlineFormInputGroup" placeholder="email" name="email" ng-model="userData.email">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="First name" name="fname" ng-model="userData.fname">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Last name" name="lname" ng-model="userData.lname">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
          <input type="password" class="form-control" id="inlineFormInputGroup" placeholder="Password" name="password" ng-model="userData.password">
        </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
          <select class="form-control" name="usergroup" ng-model="userData.usergroup_id" >
            <option ng-repeat="usergroupData in usergroupDatas" value="[[ usergroupData.id ]]">[[ usergroupData.group_title ]]</option>
            <!-- <option ng-repeat="usergroupData in usergroupDatas" value="[[ usergroupData.id ]]" ng-if=" $index != 0">[[ usergroupData.group_title ]]</option> -->
          </select>
        </div>
        <div class="form-group">
          <div class="radio">
            <label>
              <input type="radio" name="sex" ng-model="userData.sex" value="male" checked>Male
            </label>
          <label>
              <input type="radio" name="sex" ng-model="userData.sex" value="female">Female
            </label>
           <label>
              <input type="radio" name="sex" ng-model="userData.sex" value="trigender">Trigender
            </label>
          </div>

        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-birthday-cake"></i></div>
          <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Date Of Birth" name="dob" ng-model="userData.dob">
        </div>

        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-dropbox"></i></div>
          <select class="form-control" name="plan" ng-model="userData.plan_id" >
            <option ng-repeat="plan in plans" value="[[ plan.id ]]">[[ plan.plan_title ]]</option>
            </select>
        </div>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-hourglass-1 "></i></div>
          <select class="form-control" name="subscription" ng-model="userData.subscription_id" >
            <option ng-repeat="sub in subscriptionDatas" value="[[ sub.id ]]">[[ sub.subscription_title ]]</option>
            </select>
        </div>
         <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw  fa-phone"></i></div>
          <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Contact no" name="contact_no" ng-model="userData.contact_no">
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addUser()">Add User</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
  </div>
</div>


  </div>
  <!-- /.content-wrapper -->



  @endsection