@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  ng-app="app" ng-controller="app-registerCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">App</li>
        <li class="active">Register</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list Plan-->
      <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
      <div class="box" ng-switch on="selection">
      <div class="box-header with-border">
        <h3 class="box-title">App register </h3>
<div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="selectedPart('app-register')">
  <i class="fa fa-fw  fa-android"></i><i class="fa fa-fw  fa-plus"></i>
</button></span>
      <span><button type="button" class="btn btn-primary" ng-click="selectedPart('app-list')">
  <i class="fa fa-fw fa-reorder"></i>
</button></span>

    </div>

  </div>
      <div ng-switch-when="app-register">
      <div class="box-body">

        @component('alert.alert-danger')
        <ul>
          <li ng-repeat="error in errors">
            [[ error ]]
          </li>
        </ul>
      @endcomponent      
      <form action="{{ url('api/admin/add/app')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <div class="input-group-addon"><i class="fa fa-fw  fa-android"></i></div>
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="title" name="title"  name="title">
      </div>  
      
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="4" placeholder="Enter description..." name="description" name="description"></textarea>
      </div>
    
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-dropbox"></i></div>
          <select class="form-control" name="plan_id"  >
            <option ng-repeat="appCatData in appPlanDatas" value="[[ appCatData.id ]]">[[ appCatData.plan_title ]]</option>
            </select>
        </div>
    
        <label>App Category</label>
          <select class="form-control" name="category_id"  >
            <option ng-repeat="appCatData in appCatDatas" value="[[ appCatData.id ]]">[[ appCatData.title ]]</option>
            </select>
            <label>Upload Logo</label>
            <div>Select an image file: *select only square images<input type="file" id="fileInput" accept="image/*"  name="imgLogo" /></div>
            
  <div class=""><img src="[[ myImage ]]" class="img-thumbnail img-responsive" alt="Responsive image" width="200px" height="200px" /></div>
  
      <input type="hidden" name="view" value="1">
      <div class="box-footer">
        <div class="pull-right">
          <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
          
    </form>
        </div></div>
      </div>

  </div>
  <div ng-switch-when="app-list">
          <div class="box-header with-border">
        <h3 class="box-title">Sort </h3>


        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
              <label>Plan</label>
                <select  name="appPlan" ng-model="sortByPlan">
            <option ng-repeat="appPlanData in appPlanDatas" value="[[ appPlanData.plan_title ]]">[[ appPlanData.plan_title ]]</option>
          </select>
          <label>Category</label>
                <select  name="appPlan" ng-model="sortByCat">
            <option ng-repeat="appCatData in appCatDatas" value="[[ appCatData.title ]]">[[ appCatData.title ]]</option>
          </select>

</span>

    </div>
  </div>

      <div class="box-body table-responsive">

              <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>App Title</th>
            <th>Description</th>
            <th>Plan</th>
            <th>Category</th>
            <th>App Logo</th>
            <th>Active</th>
            <th>Action</th>
            <th>More</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in appRegDatas | filter: sortByPlan | filter: sortByCat ">
          <td>[[ $index+1 ]]</td><td>[[ data.title ]]</td>
          <td>[[ data.description ]]</td>
          <td>[[ data.plan_title ]]</td>
          <td>[[ data.app_category_title ]]</td>
          <td><img src="{{ asset('uploads/[[ data.logo_path ]]')}}" width="100px" height="100px"></td>
          
          <td>[[ data.is_active ]]</td>

         <td>
            <button class="btn btn-success btn-xs" ng-click="initEditAppReg($index)">Edit</button>
            <button class="btn btn-danger btn-xs" ng-click="deleteAppReg($index)" >Delete</button>
        </td>
        <td ng-if="data.app_detail_id!=0"><a href="#" ng-click="initAppDetail($index)">more</a></td>
        <td ng-if="data.app_detail_id==0"><a href="#" ng-click="initaddAppDetail($index)">add app detail</a></td>
       </tr>
          </tbody>
      </table>
      </div>
      </div>
    </div>
      </div>
    </section>
    <!-- /.content -->


    <!-- Modal edit Plan-->
<div class="modal fade" id="edit_app_reg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
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
        <form action="{{ url('api/admin/update/app')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <div class="input-group-addon"><i class="fa fa-fw  fa-android"></i></div>
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="title" name="title" ng-model="editAppReg.title" name="title">
      </div>  
      
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="4" placeholder="Enter description..." name="description" ng-model="editAppReg.description" name="description"></textarea>
      </div>
    
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-fw fa-dropbox"></i></div>
          <select class="form-control" name="plan_id" ng-model="editAppReg.app_plan_id" >
            <option ng-repeat="appCatData in appPlanDatas" value="[[ appCatData.id ]]">[[ appCatData.plan_title ]]</option>
            </select>
        </div>
    
        <label>App Category</label>
          <select class="form-control" name="category_id" ng-model="editAppReg.app_category_id" >
            <option ng-repeat="appCatData in appCatDatas" value="[[ appCatData.id ]]">[[ appCatData.title ]]</option>
            </select>
            <label>Upload Logo</label>
            <div>Select an image file: *select only square images<input type="file" id="fileInput" accept="image/*"  name="imgLogo" /></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Update</button>
      </form>
      </div>
    </div>
  </div>
</div>


    <!-- Modal add new app detail-->
<div class="modal fade" id="add_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add App Detail</h5>
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/Plan')}}"> -->
          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App title" name="app_title" value="[[ editDetail.title ]]" disabled>
  </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App version" name="version" ng-model="editDetail.version">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter google play link" name="version" ng-model="editDetail.apk_path">
  </div>
  
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter app package name like com.elifestle.main" name="app_package_name" ng-model="editDetail.app_package_name">
  </div>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-desktop"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Developer" name="Developer" ng-model="editDetail.developer">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addAppDetail()">Add Detail</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>

    <!-- Modal add new Plan-->
<div class="modal fade" id="app_detail_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">[[ editAppReg.title ]]</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" ng-switch on="selectionEdit">
        <div >
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="addMoreAppDetails(appRegDetail.id)">
  <i class="fa fa-fw  fa-plus"></i>
</button></span>
     
</button></span>

    </div>

       
        <div class="table-responsive" ng-switch-when="app_detail_list">
           
        <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>version</th>
            <th>link</th>
            <th>app package name</th>
            <th>developer</th>
            <th>Active</th>

          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in appDetailsDatas">
          <td>[[ $index+1 ]]</td>
          <td>[[ data.version ]]</td>
          <td><a href="[[ data.apk_path ]]" target="_blank">[[ data.apk_path ]]</a></td>
          <td>[[ data.app_package_name ]]</td>
          <td>[[ data.developer ]]</td>
          <td>[[ data.is_active ]]</td>

         <td>
            <button class="btn btn-success btn-xs" ng-click="selectedPartEdit($index)">Edit</button>

            <button class="btn btn-danger btn-xs" ng-click="deleteAppDetail($index)" >Delete</button>
        </td>

       </tr>
          </tbody>
      </table>
      </div>

      <div ng-switch-when="edit_detail">
        @component('alert.alert-danger')
        <ul>
          <li ng-repeat="error in errors">
            [[ error ]]
          </li>
        </ul>
      @endcomponent 
        <div class="row">
          <div class="col">
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App title" name="app_title" value="[[ editDetail.title]]" disabled>
  </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App version" name="version" ng-model="editDetail.version">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter google play link" name="apk_path" ng-model="editDetail.apk_path">
  </div>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter app package name like com.elifestle.main" name="app_package_name" ng-model="editDetail.app_package_name">
  </div>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-desktop"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Developer" name="Developer" ng-model="editDetail.developer">
  </div>

          </div>
        </div>
        <div class="row">
          <div class="col pull-right">
              <button class="btn btn-primary" ng-click="selectedPartback($index)">Back</button>
              <button class="btn btn-primary" ng-click="updateAppDetail($index)">Update</button>
          </div>
        </div>
      </div>

    <div ng-switch-when="add_detail">
        @component('alert.alert-danger')
        <ul>
          <li ng-repeat="error in errors">
            [[ error ]]
          </li>
        </ul>
      @endcomponent 
        <div class="row">
          <div class="col">
      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App title" name="app_title" value="[[ editAppReg.title]]" disabled>
  </div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-android"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="App version" name="version" ng-model="editAppReg.version">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter google play link" name="version" ng-model="editAppReg.apk_path">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-link"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter app package name like com.elifestle.main" name="app_package_name" ng-model="editDetail.app_package_name">
  </div>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-desktop"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Developer" name="Developer" ng-model="editAppReg.developer">
  </div>

          </div>
        </div>
        <div class="row">
          <div class="col pull-right">
              <button class="btn btn-primary" ng-click="selectedPartback($index)">Back</button>
              <button class="btn btn-primary" ng-click="addAppDetail($index)">Add</button>
          </div>
        </div>
      </div>
    
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
  

  @endsection