<?php
// $urer_id = $_REQUEST['user_id'];

$myd= $data[0];
// echo $myd['group_title'];
session_start();

$_SESSION['user']=$data[0];
// header("location:www.google.com");
// echo $_SESSION['user']['group_title'];
if($_SESSION['user']['group_title']=="ADMIN")
die('
<script type="text/javascript">
	window.location.replace("/elifestyle/public/admin/dash");
</script>');
else
	die('
<script type="text/javascript">
	window.location.replace("/elifestyle/public/");
</script>');
?>