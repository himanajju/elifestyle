@extends('layouts.elifestyle_plan_layout')
@section('content')

  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
    <div class="row">
<div class="col">

<div class="row">
      <div class="col">
        <div class="card-panel">
        <div class="row">

        <!--FREE-->
        <div class="col s12 m4 l4">
          <div class="card">
            <div class="card-image">
              <img src="https://dl2.pushbulletusercontent.com/uLm4LLk0dGQsnbni2laiZVOQiw4r9hFm/free.png">
              <span class="card-title">FREE</span>
            </div>
            <div class="card-content">
            <ul>
      <li >Limited Apps</li>
      <li >Valid for Only 1 month</li>
    </ul>
            </div>
            <div class="card-action">
              <a href="#modalfree" class="modal-trigger">Subscribed</a>
            </div>
          </div>
        </div>

        <!--GOLD-->
        <div class="col s12 m4 l4">
          <div class="card">
            <div class="card-image">
              <img src="https://dl2.pushbulletusercontent.com/C5ht8s7PaA0Ehcv5RYf08LnngaH4jAxc/GOLD.png">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>
              <ul>
              <li>100 Apps</li>
              <li>SAP tools</li>
              <li>12 Months</li>
              </ul>
              </p>
            </div>
            <div class="card-action">
              <a href="#modal2" class="modal-trigger" >Subscribe</a>
            </div>
          </div>
        </div>

        <!--platinum-->
        <div class="col s12 m4 l4">
          <div class="card">
            <div class="card-image">
              <img src="https://dl2.pushbulletusercontent.com/bZtKL3nWT6mun9RBxlKcJD9uiRR3Xxll/PLATINUM.png">
              <span class="card-title">PLATINUM</span>
            </div>
            <div class="card-content">
            <ul>
          <li>Unlimited Apps</li>
          <li>Validity 2 year</li>
          </ul>
            </div>
            <div class="card-action">
              <a href="#modal1" class="modal-trigger" >Subscribe</a>
            </div>
          </div>
        </div>

      </div>
        </div>
      </div>
    </div>
    
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>PLATINUM</h4>
      <p>Unlimited apps so make payment of $100</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Make payment</a>
    </div>
  </div>
    
<!-- Modal Structure -->
<div id="modal2" class="modal">
    <div class="modal-content">
      <h4>GOLD</h4>
      <p>100 apps so make payment of $50</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Make Payment</a>
    </div>
  </div>
  
    
<!-- Modal Structure input -->
<div id="modalfree" class="modal">
    <div class="modal-content">
      <h4>Sign Up</h4>
      <p>
      <div class="row">
      <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input type="text" id="email" name="email" class="validate">
          <label for="email">Enter Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" name="pwd1" id="pwd1" class="validate" >
          <label for="pwd1">Enter password</label>
      </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" name="pwd2" id="pwd2" class="validate" >
          <label for="pwd2">Re-enter password</label>
      </div>

      
      </div>
      </p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Sign Up</a>
    </div>
  </div>


</div>
</div>
</div>
</div>
@endsection