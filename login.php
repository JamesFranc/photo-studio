<?php
session_start();

	if(isset($_SESSION['activationmsg'])){
		echo "
		 <div id='message1' class=' alert alert-warning alert-dismissable' style='margin-top:-1000px;overflow: hidden;position: fixed;
	   width: 50%;margin-left:25%;opacity: 0.9;z-index: 1050;transition: all 1s ease;margin-top: 1px;'>
	    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	    <strong>Uh oh!</strong><br>".$_SESSION['activationmsg']."
	  </div>";
		$_SESSION['activationmsg']=null;
		session_destroy();
		$_SESSION = array();
	}
//On page load, check to see if a login has been attempted
if(isset($_POST['submit'])){
	include("dbconnection.php");
	$errMsg = '';

	//username and password sent from the form on this page
	$email = trim($_POST['inputEmail']);
	$password = trim($_POST['inputPassword']);

	if($email == '' || empty($email) || $email == ' '){
		$errMsg .= 'You must enter your email address<br>';
	}
	if($password == '' || empty($password) || $password == ' '){
		$errMsg .= 'You must enter your password<br>';
	}

	//if no errors were encountered with the input continue
	if($errMsg == ''){

		$records = $databaseConnection->prepare("SELECT * FROM tbl_users WHERE email=?");
		$records->execute([$email]);
		$results = $records->fetch(PDO::FETCH_ASSOC);

		//Any results indicate that the email address is in the database
		if(count($results) > 0){
			if(password_verify($password, $results['password'])){
				$id = $results['userid'];
				$_SESSION['email'] = $results['email'];
				$_SESSION['name'] = $results['name'];
				$_SESSION['accesslevel'] = $results['accesslevel'];
				$_SESSION['userid']=$id;

				//We're going to clear out the previous db connection, results and sql statement
				$databaseConnection=null;
				$results = null;
				$sql = null;

				try {
					$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
					$sql = "UPDATE tbl_users SET lastaccess=CURRENT_TIMESTAMP WHERE userid=?";
					//Update the timestamp for this user's last access to the system
					$stmt = $databaseConnection->prepare($sql);
					//$statement->bindParam (":date", strtotime (date ("Y-m-d H:i:s")), PDO::PARAM_STR);
					$stmt->execute([$id]);}
					catch(PDOException $errMsg) {
						echo 'ERROR: ' . $errMsg->getMessage();
					}

					header('location:dashboard.php');
					exit;
				}else{
					$errMsg .= 'Password does not match this email address, please verify your entry<br>';
				}

			}else{
				$errMsg .= 'Email not found<br>';
			}
		}
	}

	//if a user was directed here from a logout button clear the _SESSION and _POST variables
	if($_GET['logout']==1){
		session_unset();
		$_POST[] = array();
	}
	include("header.php");
	?>

	<div class="jumbotron">
		<h2>&nbsp;<i class="fa fa-sign-in fa-2x"></i> Login Page for DB Project</h2>
	</div>
	<?php if (isset($_POST['submit'])){
		echo "<div class='alert alert-danger col-md-8 col-md-offset-2' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<strong>".$errMsg."</strong></div>";
	}?>
	<div class="container col-md-4 col-md-offset-4">
		<form class="form-signin" action="" method="post">
			<h2 class="form-signin-heading">Please sign in</h2>
			<label for="inputEmail" class="sr-only">Email</label>
			<input type="email" id="inputEmail" name="inputEmail" class="form-control" value="<?php echo $_POST['inputEmail'];?>" placeholder="Email" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
			<div>&nbsp;</div>
			<div class="btn-block btn-group col-lg-offset-3" style="padding: 0 !important;margin: 0 !important;">
				<button name="submit" class="btn btn-lg btn-primary" type="submit">Sign in</button>
				<a class="btn btn-lg btn-info" href="createuser.php">Sign Up</a>
			</div>
		</form>

	</div> <!-- /container -->
	<?php include("footer.php"); ?>
