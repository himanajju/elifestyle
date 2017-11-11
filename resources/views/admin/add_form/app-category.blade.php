@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  ng-app="app" ng-controller="appCategoryCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add</li>
        <li class="active">App Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list Appcategory-->
      <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
      <div class="box">
      <div class="box-header with-border">

        <h3 class="box-title">App Category list </h3>

        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="initAppcategory()">
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
            <th>category title</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in appCatDatas">
          <td>[[ $index+1 ]]</td><td>[[ data.title ]]</td>
         <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEdit($index)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteAppcategory($index)" >Delete</button>
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

    <!-- Modal add new Appcategory-->
<div class="modal fade" id="add_new_app_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Appcategory</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/Appcategory')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">Appcategory</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Appcategory" name="title" ng-model="appCatData.title">
  </div>
  <input type="hidden" name="view" value="1">

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addAppcategory()">Add Appcategory</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


    <!-- Modal -->
<div class="modal fade" id="edit_app_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Appcategory</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/Appcategory')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">Appcategory</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Appcategory" name="title" ng-model="editAppcategory.title">
  </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updateAppcategory()">Add Appcategory</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


  </div>
  <!-- /.content-wrapper -->



  @endsection