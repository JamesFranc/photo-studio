<?php
//------------------------------------------------------------------------
// This is the user registration page
//------------------------------------------------------------------------

session_start();
if(isset($_POST['submit'])){
	include("dbconnection.php");
	$errMsg = '';
	$email = $_POST["email"];
	$password = $_POST["password"];
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$address1 = $_POST["address1"];
	$address2 = $_POST["address2"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$phone = $_POST["phone"];
	$accesslevel = $_POST["accesslevel"];
	$hash = password_hash($password, PASSWORD_DEFAULT);
//------------------------------------------------------------------------
// This block verifies that the email entered does not already exist in
// the tbl_users table. If the email exists then a dismissable warning is thrown.
//------------------------------------------------------------------------

	$sql = $databaseConnection->prepare("SELECT * FROM tbl_users WHERE email=?");
	$sql->execute([$email]);
	$row = $sql->fetch(PDO::FETCH_ASSOC);

		if ( $email == $row['email'] ) { //If user entered username doesn't equal the database username
			include("header.php");
			echo"<div class='jumbotron'><h2>Create User for DB Project</h2></div>";
			echo "<div class='alert alert-warning col-md-8 col-md-offset-2' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			Duplicate email: <strong>".$email."</strong>, found in the database.</br> Please be sure you haven't registered before</div>";
			include("createform.php");
			include("footer.php");
			exit;
		}
		//------------------------------------------------------------------------
		// END DUPLICATE EMAIL CHECK BLOCK
		//------------------------------------------------------------------------

		//------------------------------------------------------------------------
		// BEGIN TRY-INSERT STATEMENT IF DUPLICATE EMAIL IS NOT FOUND
		//------------------------------------------------------------------------
		try {
			$stmt = $databaseConnection->prepare("INSERT INTO tbl_users SET email=?, password=?, name=?, accesslevel=?");
			$stmt->execute([$email, $hash, $fname, $accesslevel]);
		} catch(PDOException $errMsg) {
			echo 'ERROR: ' . $errMsg->getMessage();
			exit;
		}
		//------------------------------------------------------------------------
		// END TRY-INSERT STATEMENT IF DUPLICATE EMAIL IS NOT FOUND
		//------------------------------------------------------------------------

		//------------------------------------------------------------------------
		// BEGIN REDIRECT TO WELCOME PAGE INSERT IS SUCCESSFUL
		//------------------------------------------------------------------------
		if($stmt){
			$_SESSION['email']=$email;
			$_SESSION['password']=$password;
			$_SESSION['name']=$fname;
			$_SESSION['accesslevel'] = $_POST['accesslevel'];
			try{
			$databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
			$sql2 = $databaseConnection2->prepare("SELECT * FROM tbl_users WHERE email=?");
			$sql2->execute([$email]);
		}catch(PDOException $errMsg) {
			echo 'ERROR: ' . $errMsg->getMessage();
			exit;
		}
			$row = $sql2->fetch(PDO::FETCH_ASSOC);
			$userid = $row['userid'];
			$databaseConnection3 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
			if($_POST['accesslevel']==3){
				try{
			$stmt2 = $databaseConnection3->prepare("INSERT INTO tbl_customers SET userid=?, fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=?, dateadded=CURRENT_TIMESTAMP, lastaccess=CURRENT_TIMESTAMP");
			$stmt2->execute([$userid,$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone]);
		}catch(PDOException $errMsg) {
			echo 'ERROR: ' . $errMsg->getMessage();
			exit;
		}
			header('location:dashboard.php');
			exit;
			}else{
				try{
				$stmt2 = $databaseConnection3->prepare("INSERT INTO tbl_photographers SET userid=?, fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=?, datehired=CURRENT_TIMESTAMP");
				$stmt2->execute([$userid,$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone]);
			}catch(PDOException $errMsg) {
				echo 'ERROR: ' . $errMsg->getMessage();
				exit;
			}
				header('location:dashboard.php');
				exit;
			}
		}else{
			echo "Well that didn't work, fix it <br>";
			exit;
		}
	}
	//------------------------------------------------------------------------
	// END REDIRECT TO WELCOME PAGE INSERT IS SUCCESSFUL
	//------------------------------------------------------------------------
	//------------------------------------------------------------------------
	// BEGIN STANDARD PAGE LOAD
	//------------------------------------------------------------------------
include("header.php");
if($_SESSION['accesslevel']==1){
echo"<div class='jumbotron'><h2><i class='fa fa-user fa-fw fa-2x'></i>Admin Panel - Create User</h2></div>";
}else{
	echo"<div class='jumbotron'><h2><i class='fa fa-user fa-fw fa-2x'></i>Create Account</h2></div>";
}
include('buttons.php');
include("createform.php");
include("footer.php");
//------------------------------------------------------------------------
// END STANDARD PAGE LOAD
//------------------------------------------------------------------------
?>
