@extends('layouts.elifestyle_layout')
@section('content')




<div ng-repeat="dataCat in appCatDatas" id="tab_[[dataCat.title ]]" class="col s12">
  <div class="row">

     <div class="col s6 m2 l2" ng-repeat="data in appAppDatas | filter : dataCat.title | orderBy : dataCat.created_at">
    <div class="card">
      <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="{{ asset('uploads/[[ data.logo_path ]]')}}">
      </div>
      <div class="card-content">

      <span class="app-card-title card-title activator grey-text text-darken-4">[[ data.title ]]</span>
      <div class="tag green-text" ng-if = "data.plan_id <= userLoged.plan_id" ><small>( [[ data.plan_title ]] )</small></div>
      <div class="tag green-text" ng-if = "userLoged==null" ><small>( [[ data.plan_title ]] )</small></div>
      <div class="tag red-text" ng-if = "data.plan_id > userLoged.plan_id" ><small>( [[ data.plan_title ]] )</small></div>
      
      <span><a class="waves-effect waves-light btn-small btn modal-trigger" href="#preschool" ng-click="initAppDetail($index, data.id)">Install</a></span>
      
      </div>

  </div>
</div> 
</div></div>





   <!-- Modal Structure -->
   <div id="preschool" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>[[appDetailData.title ]]</h4>
      <p>[[ appDetailData.description ]]</p>

      <ul><li>Version :- [[ appDetailData.version ]]</li>
        </ul>
        <p> click agree to download app.</p> 
    </div>
    <div class="modal-footer">

      <a href="#"  class="modal-action modal-close waves-effect waves-green btn-flat" ng-click="checkPlanAuth(appDetailData.id,appDetailData.plan_id)">Agree</a>
      <!-- <a href="{{ url('/plan')}}"  class="modal-action modal-close waves-effect waves-green btn-flat " ng-show="!userLoged.is_plan">Agree</a> -->
    </div>
  </div>






@endsection