@extends('layouts.elifestyle_plan_layout')
@section('content')

  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
  
        <div class="card-panel" ng-switch on="profileSelect">
        <div class="row">
          <div class="col l3">
        <a class="btn-floating btn-large waves-effect waves-light red" ng-click="inituserUpdate()"><i class="material-icons">mode_edit</i></a>
      </div>
      <div class="col l3">
          <a class="waves-effect waves-light btn modal-trigger" href="#changePassword">change password</a>

        
    </div>
     <div class="row" ng-switch-when="view">
      <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input type="text" id="email" name="email" class="validate" ng-model="userLoged.email" disabled>
          <label for="email">Enter Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name" type="text" class="validate" ng-model="userLoged.fname" disabled>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" ng-model="userLoged.lname" disabled>
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="dob" type="text" class="validate" ng-model="userLoged.dob" disabled>
          <label for="dob">Date of birth</label>
        </div>
        <div class="input-field col s6">
          <input id="contact_no" type="text" class="validate" ng-model="userLoged.contact_no" disabled>
          <label for="contact_no">Contact no</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input type="text" name="plan_title" id="plan_title" class="validate" ng-model="userLoged.plan_title" disabled>
          <label for="plan_title">Current Plan</label>
      </div>
      </div>
      </div>
    </div>

<div id="changePassword" class="modal modal-fixed-footer">
    <div class="modal-content">
        <div class="input-field col s12">
          <input id="currentPass" type="password" class="validate" ng-model="changePass.current">
          <label for="currentPass">Enter Current Password</label>
        </div>
         <div class="input-field col s12">
          <input id="newpass" type="password" class="validate" ng-model="changePass.newpass">
          <label for="newpass">Enter New Password</label>
        </div>
         <div class="input-field col s12">
          <input id="confpass" type="password" class="validate" ng-model="changePass.confpass">
          <label for="confpass">Re-Enter New Password</label>
        </div>
      </div>
    <div class="modal-footer">

      <a href="#"  class="modal-action modal-close waves-effect waves-green btn-flat " ng-click="changePassword()">Change</a>
    </div>
  </div>


     <div class="row"  ng-switch-when="edit">
      <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input type="text" id="email1" name="email" class="validate" ng-model="editUser.email" disabled>
          <label for="email1">Enter Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name1" type="text" class="validate" ng-model="editUser.fname" >
          <label for="first_name1">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name1" type="text" class="validate" ng-model="editUser.lname" >
          <label for="last_name1">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="dob1" type="text" class="validate" ng-model="editUser.dob" disabled>
          <label for="dob1">Date of birth</label>
        </div>
        <div class="input-field col s6">
          <input id="contact_no1" type="text" class="validate" ng-model="editUser.contact_no" >
          <label for="contact_no1">Contact no</label>
        </div>
      </div>

      </div>
      <div class="row">
        <div class="col">
          <a class="waves-effect waves-light btn" ng-click="updateUser()">submit</a>

        </div>
      </div>
      </div>
    </div>

</div>
</div>
</div>
@endsection