<?php
session_start();
if($_GET['logout']==1){
	session_destroy();
	$_SESSION = array(); // Clears the $_SESSION variable
	header('location:login.php');
}
if($_SESSION['accesslevel'] < 1){
	$_SESSION['activationmsg']= "Sorry but your account seems to be deactivated, please contact our office and we'll be sure to help you out as soon as possible!<br>";
	header('location:login.php');
}

include("header.php");
echo "<div class='jumbotron'><h2><i class='fa fa-tachometer fa-fw fa-2x'></i>Dashboard for DB project</h2></div>";
include("buttons.php");

if(isset($_SESSION['accesslevel'])){
	if($_SESSION['accesslevel']==1 && $_SESSION['welcome'] != -1){
		$_SESSION['welcome']="
		<div class='alert alert-info col-md-offset-2 col-md-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		Hello, ".$_SESSION['name'].", you are logged in as an Administrator.
		</div>";
	}elseif($_SESSION['accesslevel']==2 && $_SESSION['welcome'] != -1){
		$_SESSION['welcome']="
		<div class='alert alert-info col-md-offset-2 col-md-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		Hello, ".$_SESSION['name'].", you are logged in as an Photographer.
		</div>";
	}elseif($_SESSION['accesslevel']==3 && $_SESSION['welcome'] != -1){
		$_SESSION['welcome']="
		<div class='alert alert-info col-md-offset-2 col-md-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		Hello, ".$_SESSION['name'].", thank you for paying us a visit today.
		</div>";
	}
if ($_SESSION['welcome']!=-1){
echo $_SESSION['welcome'];
$_SESSION['welcome']= -1;
}
	if(isset($_SESSION['thankyou'])){
		echo "
		<div class='col-md-2'>&nbsp;</div>
		<div class='row'>
		<div class='alert alert-success col-md-offset-2 col-md-8' role='alert'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		".$_SESSION['thankyou']."
		</div>
		</div>
		";
		$_SESSION['thankyou']=null;
	}
	echo "
	<div class='alert alert-default col-md-8 col-md-offset-2' role='alert'>
	Welcome <strong>".$_SESSION['email']."!</strong> The login script is working!
	</div>";

	include("footer.php");
}else{
	header('location:login.php');
}

?>
