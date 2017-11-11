@extends('layouts.admin_web_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  ng-app="app" ng-controller="planCtrl">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Plan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!--list Plan-->
      <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
      <div class="box" ng-switch on="selection">
      <div class="box-header with-border">

        <h3 class="box-title"></h3>

        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="selectedPart('plan')">
  <i class="fa fa-fw fa-dropbox"></i>
</button></span>
      <span><button type="button" class="btn btn-primary" ng-click="selectedPart('subscription')">
  <i class="fa fa-fw fa-hourglass-half"></i>
</button></span>

    </div>
  </div>
  <div ng-switch-when="plan">
      <div class="box-header with-border">
        <h3 class="box-title">Plan list </h3>


        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="initPlan()">
  <i class="fa fa-fw  fa-plus"></i>
</button></span>

    </div>
  </div>

      <div class="box-body">

              <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>Plan title</th>
            <th>Amount per month</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="data in planDatas">
          <td>[[ $index+1 ]]</td><td>[[ data.plan_title ]]</td>
          <td>[[ data.amount | currency ]]</td>
         <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEditPlan($index)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deletePlan($index)" >Delete</button>
                                </td>
       </tr>
          </tbody>
      </table>
      </div>
      </div>


      <div ng-switch-when="subscription">
      <div class="box-header with-border">
        <h3 class="box-title">Subscrption list </h3>


        <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span><button type="button" class="btn btn-primary" ng-click="initSubscription()">
       <i class="fa fa-fw  fa-plus"></i>
      </button></span>

    </div>
  </div>

      <div class="box-body">

              <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>S no.</th>
            <th>Subscription title</th>
            <th>Months</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody >

         <tr ng-repeat="subscriptionMonthData in subscriptionMonthDatas">
          <td>[[ $index+1 ]]</td><td>[[ subscriptionMonthData.subscription_title ]]</td>
          <td>[[ subscriptionMonthData.months ]]</td>
         <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEditSubscription($index)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteSubscription($index)" >Delete</button>
                                </td>
       </tr>
          </tbody>
      </table>
      </div>
      </div>

    </div>
      </div>
      </div>
    </section>
    <!-- /.content -->

    <!-- Modal add new Plan-->
<div class="modal fade" id="add_new_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
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
          <label class="sr-only" for="inlineFormInputGroup">Plan</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw  fa-dropbox"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Plan" name="plan_title" ng-model="planData.plan_title">
  </div>  
  <label class="sr-only" for="inlineFormInputGroup">Amount</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-usd"></i></div>
    <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Amount" name="amount" ng-model="planData.amount">
  </div>
  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addPlan()">Add Plan</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


    <!-- Modal edit Plan-->
<div class="modal fade" id="edit_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
        <!-- <form class="form" method="POST" action="{{ URL('/api/admin/add/Plan')}}"> -->
          <label class="sr-only" for="inlineFormInputGroup">Plan</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw  fa-dropbox"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Plan" name="plan_title" ng-model="editPlan.plan_title">
  </div>  
  <label class="sr-only" for="inlineFormInputGroup">Amount</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-usd"></i></div>
    <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Amount" name="amount" ng-model="editPlan.amount">
  </div>
  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updatePlan()">Update Plan</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>


    <!-- Modal add new Plan-->
<div class="modal fade" id="add_new_subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subscription</h5>
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
          <label class="sr-only" for="inlineFormInputGroup">Subscription</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-dropbox"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Subscription" name="subscription_title" ng-model="subscriptionData.subscription_title">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw  fa-hourglass"></i></div>
    <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Months" name="months" ng-model="subscriptionData.months">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="addSubscription()">Add Subscription</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>

    <!-- Modal add new Plan-->
<div class="modal fade" id="edit_subscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPdate Subscription</h5>
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
          <label class="sr-only" for="inlineFormInputGroup">Subscription</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw fa-dropbox"></i></div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Subscription" name="subscription_title" ng-model="editSubscription.subscription_title">
  </div>

  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon"><i class="fa fa-fw  fa-hourglass"></i></div>
    <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Months" name="months" ng-model="editSubscription.months">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" ng-click="updateSubscription()">Update Subscription</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
</div>

  <!-- /.content-wrapper -->



<!-- <script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

</script>
 -->

  @endsection