@extends('layouts.elifestyle_plan_layout')
@section('content')

 <main>
    <center>
      <!-- <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" /> -->
      <div class="section"></div>

      <h5 class="indigo-text">Please, login into your account</h5>
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="POST" action="{{ url('/api/login-check')}}" id="f1">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' ng-model='login.email'/>
                <label for='email'>Enter your email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' ng-model='login.password' />
                <label for='password'>Enter your password</label>
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='button' name='btn_login' class='col s12 btn btn-large waves-effect indigo' ng-click="loginUser()" >Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
      <a href="{{ url('register')}}">Create account</a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

 <!--  <script type="text/javascript">
// Check if the localStorage object exists
if(localStorage){
    // Store data
      var value = localStorage.getItem('userDetail');
    // Retrieve data
    alert("Hi, " + value);
} else{
    alert("Sorry, your browser do not support local storage.");
}
</script>
  -->

  @endsection