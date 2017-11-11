@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  ng-app="app" ng-controller="appDetailCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add</li>
        <li class="active">App detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list App-->
      <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
      <div class="box">
      <div class="box-header with-border">

        <h3 class="box-title">App Detail </h3>

        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="initApp()">
  <i class="fa fa-fw fa-reorder"></i>
</button>

      </span>
    </div>
  </div>
      <div class="box-body">

        <?php
      $mydata= json_decode($data);
      $appData = $mydata->data;
          
        ?>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App title" name="app_title" value="{{ $appData->title}}" disabled>
  </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App version" name="version" ng-model="appDetailData.version">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter google play link" name="version" ng-model="appDetailData.apk_path">
  </div>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-desktop"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Developer" name="Developer" ng-model="appDetailData.developer">
  </div>
              
      </div>
      <div class="box-footer">
        <div class="pull-right">
        <button type="button" class="btn btn-primary" ng-click="addApp()">Add</button>
        </div>
      </div>
      </div>
      </div>
      </div>
      
    </section>
    <!-- /.content -->

    <!-- Modal add new App-->
<div class="modal fade" id="add_new_app_permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add App</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/App')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">App</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App" name="permission_title" ng-model="appPerData.permission_title">
  </div>
  <input type="hidden" name="view" value="1">

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addApp()">Add App</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Add App</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/App')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">App</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App" name="permission_title" ng-model="editApp.permission_title">
  </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updateApp()">Add App</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


  </div>

  @endsection