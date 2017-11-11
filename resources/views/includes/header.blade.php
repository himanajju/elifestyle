<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- Compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->
  <link rel="stylesheet" href="{{  URL::asset('material/materialize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular-route.js"></script>
<style type="text/css">
  #map {
        width: 100%;
        height: 400px;
        background-color: grey;
      }
  
</style>
  </head>

  <?php 
session_start();
  //  print_r(isset($data));
  // if(isset($data)){


  //   $_SESSSION['user'] = $data;

  // }

  ?>

  <?php
  
if(isset($_SESSION['user'])){
  // echo $_SESSION['user']['is_plan'];
  // echo isset($_SESSION['user']);
  //    
     }
?>

    <body ng-app="app" ng-controller="mainCtrl">
    