@extends('layouts.elifestyle_plan_layout')
@section('content')

  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
  
        <div class="card-panel">
        <div class="row">

        <!--FREE-->
        <div class="col s12 m4 l4">
          <div class="card">
            <div class="ios orange"><span class="card-title "><center><h1 class="ios purple-text"><strong>FREE</strong></h1></center></span></div>
            <div class="card-image">
              <!-- <img src="https://dl2.pushbulletusercontent.com/uLm4LLk0dGQsnbni2laiZVOQiw4r9hFm/free.png"> -->
              
            </div>
            <div class="card-content">
            <ul>
      <li >Free apps  <i class="tiny material-icons">check_circle</i></li>
      <li >Tutor Support : 20 Questions a month</li>
      <li >Library Material : Limited</li>
      <li >Discount Coupons <i class="tiny material-icons">check_circle</i> </li>
      <li >Smart Phone every year <i class="tiny material-icons">cancel</i> </li>
      <li >Free Tablets every year  <i class="tiny material-icons">cancel</i> </li>
      <li >VoIP Calls <i class="tiny material-icons">check_circle</i></li>
      <li >Data Package <i class="tiny material-icons">cancel</i></li>
      <li >Voice Calls: Can Receive</li>
      <li >Video Calls<i class="tiny material-icons">cancel</i></li>
      <li >Quartely Reports<i class="tiny material-icons">cancel</i></li>
      <li >Online Competitions<i class="tiny material-icons">cancel</i></li>

    </ul>
            </div>
            <div class="card-action" ng-if="userLoged.fname==null">
              <a href="{{url('/login')}}" class="modal-trigger">Subscribed</a>
            </div>
          </div>
        </div>

<div class="col s12 m4 l4">
          <div class="card">
            <div class="ios orange"><span class="card-title "><center><h1 class="ios purple-text"><strong>Silver</strong></h1></center></span></div>
            <div class="card-image">
              <!-- <img src="https://dl2.pushbulletusercontent.com/uLm4LLk0dGQsnbni2laiZVOQiw4r9hFm/free.png"> -->
              
            </div>
            <div class="card-content">
            <ul>
      <li >Free apps  <i class="tiny material-icons">check_circle</i></li>
      <li >Tutor Support : 50 Questions a month</li>
      <li >Library Material : Limited</li>
      <li >Discount Coupons <i class="tiny material-icons">check_circle</i> </li>
      <li >Smart Phone every year <i class="tiny material-icons">check_circle</i> </li>
      <li >Free Tablets every year  50% discount </li>
      <li >VoIP Calls <i class="tiny material-icons">check_circle</i></li>
      <li >Data Package <i class="tiny material-icons">check_circle</i></li>
      <li >Voice Calls: Can Receive and make</li>
      <li >Video Calls: Can Receive </li>
      <li >Quartely Reports<i class="tiny material-icons">cancel</i></li>
      <li >Online Competitions<i class="tiny material-icons">cancel</i></li>
    </ul>
            </div>
            <div class="card-action" ng-show="userLoged.fname!=null">
              <a href="#plan" class="modal-trigger" ng-click="subscriPlan(2)">Subscribed</a>
            </div>

            <div class="card-action" ng-show="userLoged.fname==null">
              <a href="{{url('/login')}}" class="modal-trigger">Subscribed</a>
            </div>
          </div>
        </div>
<div class="col s12 m4 l4">
          <div class="card">
            <div class="ios orange"><span class="card-title "><center><h1 class="ios purple-text"><strong>Gold</strong></h1></center></span></div>
            <div class="card-image">
              <!-- <img src="https://dl2.pushbulletusercontent.com/uLm4LLk0dGQsnbni2laiZVOQiw4r9hFm/free.png"> -->
              
            </div>
            <div class="card-content">
            <ul>
      <li >Free apps  <i class="tiny material-icons">check_circle</i></li>
      <li >Tutor Support : 20 Questions a month</li>
      <li >Library Material : Limited</li>
      <li >Discount Coupons <i class="tiny material-icons">check_circle</i> </li>
      <li >Smart Phone every year <i class="tiny material-icons">cancel</i> </li>
      <li >Free Tablets every year  <i class="tiny material-icons">cancel</i> </li>
      <li >VoIP Calls <i class="tiny material-icons">check_circle</i></li>
      <li >Data Package <i class="tiny material-icons">cancel</i></li>
      <li >Voice Calls: Can Receive</li>
      <li >Video Calls<i class="tiny material-icons">cancel</i></li>
      <li >Quartely Reports<i class="tiny material-icons">cancel</i></li>
      <li >Online Competitions<i class="tiny material-icons">cancel</i></li>
    </ul>
            </div>
            <div class="card-action"  ng-show="userLoged.fname!=null">
              <a href="#plan" class="modal-trigger" ng-click="subscriPlan(3)">Subscribed</a>
            </div>

            <div class="card-action" ng-show="userLoged.fname==null">
              <a href="{{url('/login')}}" class="modal-trigger">Subscribed</a>
            </div>
          </div>
        </div>
        
<div class="col s12 m4 l4">
          <div class="card">
            <div class="ios orange"><span class="card-title "><center><h1 class="ios purple-text"><strong>Platinum</strong></h1></center></span></div>
            <div class="card-image">
              <!-- <img src="https://dl2.pushbulletusercontent.com/uLm4LLk0dGQsnbni2laiZVOQiw4r9hFm/free.png"> -->
              
            </div>
            <div class="card-content">
            <ul>
      <li >Free apps  <i class="tiny material-icons">check_circle</i></li>
      <li >Tutor Support : 20 Questions a month</li>
      <li >Library Material : Limited</li>
      <li >Discount Coupons <i class="tiny material-icons">check_circle</i> </li>
      <li >Smart Phone every year <i class="tiny material-icons">cancel</i> </li>
      <li >Free Tablets every year  <i class="tiny material-icons">cancel</i> </li>
      <li >VoIP Calls <i class="tiny material-icons">check_circle</i></li>
      <li >Data Package <i class="tiny material-icons">cancel</i></li>
      <li >Voice Calls: Can Receive</li>
      <li >Video Calls<i class="tiny material-icons">cancel</i></li>
      <li >Quartely Reports<i class="tiny material-icons">cancel</i></li>
      <li >Online Competitions<i class="tiny material-icons">cancel</i></li>
    </ul>
            </div>
            <div class="card-action"  ng-show="userLoged.fname!=null">
              <a href="#plan" class="modal-trigger" ng-click="subscriPlan(4)">Subscribed</a>
            </div>

            <div class="card-action" ng-show="userLoged.fname==null">
              <a href="{{url('/login')}}" class="modal-trigger">Subscribed</a>
            </div>
          </div>
        </div>

    
<!-- Modal Structure -->
<div id="plan" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>[[ planDetail.plan_title ]]</h4>
      <p>Make payment of [[ planDetail.amount | currency ]]</p>
          <label>Subscribe for</label>

    <select class="browser-default" ng-model="subPlanSelected">
      <option value="" disabled selected>Choose your months</option>
      <option ng-repeat="x in subscribeMonths" value="[[ x.id ]]">[[ x.subscription_title ]]</option>
    </select>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"  ng-click="subscribeUserPlan(planDetail.plan_id)">Make payment</a>
    </div>
  </div>
    
<!-- Modal Structure -->
<div id="modal2" class="modal ">
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