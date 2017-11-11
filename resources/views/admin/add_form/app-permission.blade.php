@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  ng-app="app" ng-controller="appPermissionCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add</li>
        <li class="active">App-permission</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list AppPermission-->
      <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
      <div class="box">
      <div class="box-header with-border">

        <h3 class="box-title">App permissions list </h3>

        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="initAppPermission()">
  <i class="fa fa-fw fa-user-plus"></i>
</button>

      </span>
    </div>
  </div>
      <div class="box-body">

              <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>Permission title</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in appPerDatas">
          <td>[[ $index+1 ]]</td><td>[[ data.permission_title ]]</td>
         <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEdit($index)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteAppPermission($index)" >Delete</button>
                                </td>
       </tr>
          </tbody>
      </table>
      </div>
      </div>
      </div>
      </div>
      
    </section>
    <!-- /.content -->

    <!-- Modal add new AppPermission-->
<div class="modal fade" id="add_new_app_permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add AppPermission</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/AppPermission')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">AppPermission</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="AppPermission" name="permission_title" ng-model="appPerData.permission_title">
  </div>
  <input type="hidden" name="view" value="1">

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addAppPermission()">Add AppPermission</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


    <!-- Modal -->
<div class="modal fade" id="edit_app_permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add AppPermission</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/AppPermission')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">AppPermission</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="AppPermission" name="permission_title" ng-model="editAppPermission.permission_title">
  </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updateAppPermission()">Add AppPermission</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


  </div>

  @endsection