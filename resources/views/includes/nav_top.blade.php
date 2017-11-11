<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="{{ URL::asset('/') }}" class="brand-logo" style="margin-left:10px;margin-right:10px;">
        <div style="line-height: 65px;"><i class="" style="font-size: 65px; color: #00EB65;">e</i><span>Lifestyle</span></a></div>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php 
        if(isset($_SESSION['user'])){
          echo "<li><a href='".URL::asset('/profile')."'>Hi, ".$_SESSION['user']['fname']." ".$_SESSION['user']['lname']." !!</a></li>";

        }
        ?>
    <li><a href="{{ URL::asset('/') }}">Home</a></li>
<?php 
        if(isset($_SESSION['user'])){

          if($_SESSION['user']['is_plan']){
            echo "<li><a href='".URL::asset('/currentPlan')."'>Current Plan</li>";
          }else{
            echo "<li><a href='".URL::asset('/plan')."'>Plan</li>";
          }

          echo "<li><a href='#' ng-click='logout()'>Logout</a></li>";

        }else{
          echo "<li><a href='".URL::asset('/plan')."'>Plan</li>";
          echo "<li><a href='".URL::asset('/register')."'>Register</li>";
          echo "<li><a href='".URL::asset('/login')."'>Login</a></li>";

        }
        ?>
        <li><a href="{{URL::asset('/contactus')}}">Contact Us</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <?php 
        if(isset($_SESSION['user'])){
          echo "<li><a href='".URL::asset('/profile')."'>Hi, ".$_SESSION['user']['fname']." ".$_SESSION['user']['lname']." !!</a></li>";

        }
        ?>
        <li><a href="{{ URL::asset('/') }}">Home</a></li>

        <?php 
        if(isset($_SESSION['user'])){
          if($_SESSION['user']['is_plan']){
            echo "<li><a href='".URL::asset('/currentPlan')."'>Current Plan</li>";
          }else{
            echo "<li><a href='".URL::asset('/plan')."'>Plan</li>";
          }

          echo "<li><a href='#' ng-click='logout()'>Logout</a></li>";

        }else{
          echo "<li><a href='".URL::asset('/plan')."'>Plan</li>";
          echo "<li><a href='".URL::asset('/register')."'>Register</li>";
          echo "<li><a href='".URL::asset('/login')."'>Login</a></li>";

        }
        ?>
        <li><a href="{{URL::asset('/contactus')}}">Contact Us</a></li>

      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab" ng-repeat="data in appCatDatas"><a href="#tab_[[data.title ]]
          " ng-click="showApp(index)">[[data.title]]</a></li>
      </ul>
    </div>
  </nav>
  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
  