<?php 
session_start();
  if(isset($_SESSION['user'])){
    if($_SESSION['user']['group_title']!="ADMIN")
    {
      die('
<script type="text/javascript">
  window.location.replace("/elifestyle/public/");
</script>');
    }
  }else{
    die('
<script type="text/javascript">
  window.location.replace("/elifestyle/public/");
</script>');
  }
  
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>e-lifestyle</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/Ionicons/css/ionicons.min.css') }} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/AdminLTE.min.css') }} ">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/skins/_all-skins.min.css') }} ">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }} "></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>

<script type="text/javascript" src="{{ url::asset('angularjs/ng-img-crop.css') }}"></script>
  
<style>
    .cropArea {
      background: #E4E4E4;
      overflow: hidden;
      width:300px;
      height:250px;
    }

    img-crop{width:100%;height:100%;display:block;position:relative;overflow:hidden}img-crop canvas{display:block;position:absolute;top:50%;left:50%;outline:0;-webkit-tap-highlight-color:transparent}

  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


