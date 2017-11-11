@extends('layouts.elifestyle_plan_layout')
@section('content')

  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
  
        <div class="card-panel">
        <div class="row">
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' ng-model='register.email'/>
                <label for='email'>Enter your email</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='fname' id='fname' ng-model='register.fname'/>
                <label for='fname'>Enter your first name</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='lname' id='lname' ng-model='register.lname'/>
                <label for='lname'>Enter your last name</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                  <p>
                    <input class="with-gap" name="sex1" type="radio" id="MALE" checked ng-model='register.sex' value="male" checked />
                    <label for="MALE">MALE</label>
                  
                    <input class="with-gap" name="sex1" type="radio" id="female" ng-model='register.sex' value="female" />
                    <label for="female">FEMALE</label>
                  
                    <input class="with-gap" name="sex1" type="radio" id="trigender" ng-model='register.sex' value="trigender" />
                    <label for="trigender">TRIGENDER</label>
                  </p>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' ng-model='register.password'/>
                <label for='password'>Enter your password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='confpassword' id='confpassword' ng-model='register.confpassword'/>
                <label for='confpassword'>Re-Enter your password</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='date' name='dob' id='dob' ng-model='register.dob'/>
                <label for='dob'>Enter your Date of Birth</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='number' name='contact_no' id='contact_no' ng-model='register.contact_no'/>
                <label for='contact_no'>Enter your  contact number </label>
              </div>
            </div>


            <br />
            <center>
              <div class='row'><div class="col l6 offset-l3 ">
                <button type='button' name='btn_register' class='col s12 btn btn-large waves-effect indigo' ng-click="registerUser()" >register</button>
              </div></div>
            </center>
     


    </div>

</div>
</div>
</div>

@endsection

    