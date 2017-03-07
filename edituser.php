<?php
session_start();
include('dbconnection.php');

$userid = $_GET['id'];
$stmt = $databaseConnection->prepare("SELECT * from tbl_users WHERE userid=?");
$stmt->execute([$userid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$accesslevel = $row['accesslevel'];
$lastaccess = $row['lastaccess'];

if(!isset($_POST['submit'])){
  $databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);

  //---------------------------------------------------------------------------
  //The following block gets the user data from the appropriate table
  //---------------------------------------------------------------------------
  if($accesslevel==2){
    $stmt2 = $databaseConnection2->prepare("SELECT * from tbl_photographers WHERE userid=?");
  }else{
    $stmt2 = $databaseConnection2->prepare("SELECT * from tbl_customers WHERE userid=?");
  }
  $stmt2->execute([$userid]);
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  //---------------------------------------------------------------------------
}else{
  //---------------------------------------------------------------------------
  //Submit was set by POST, therefore prepare data for update statement
  //---------------------------------------------------------------------------
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
  $accesslevel2 = $_POST["accesslevel"];
  $stmt = null;
  $databaseConnection = null;
  $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
  $stmt = $databaseConnection->prepare("UPDATE tbl_users SET name=?, email=?, accesslevel=? WHERE userid=?");
  try {
    $stmt->execute([$fname,$email,$accesslevel2,$userid]);
  } catch(PDOException $errMsg) {
    echo 'ERROR1: ' . $errMsg->getMessage();
    exit;
  }
  if($accesslevel2==3 && $accesslevel2!=$accesslevel){
    //IF AN ACCOUNT IS BEING UPDATED AND ACCESSLEVEL HAS NOT REMAINED THE SAME
    //BLOCK THAT HANDLES UPDATING A USER WHO WAS ASSIGNED ACCESSLEVEL 3 (CUSTOMER) BY POST
    $databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt2 = $databaseConnection2->prepare("INSERT INTO tbl_customers SET userid=?, fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=?");
    $stmt2 ->execute([$userid,$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone]);
    }catch(PDOException $errMsg) {
      echo 'ERROR2: ' . $errMsg->getMessage();
      exit;
    }
    $databaseConnection3 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt3 = $databaseConnection3->prepare("DELETE FROM tbl_photographers WHERE userid=?");
    $stmt3 ->execute([$userid]);
    }catch(PDOException $errMsg) {
      echo 'ERROR3: ' . $errMsg->getMessage();
      exit;
    }

  }elseif($accesslevel2==2 && $accesslevel2!=$accesslevel){
    //IF AN ACCOUNT IS BEING UPDATED AND ACCESSLEVEL HAS NOT REMAINED THE SAME
    //BLOCK THAT HANDLES UPDATING A USER WHO WAS ASSIGNED ACCESSLEVEL 2 (PHOTOGRAPHER) BY POST
    $databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt2 = $databaseConnection2->prepare("INSERT INTO tbl_photographers SET userid=?, fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=?");
    $stmt2 ->execute([$userid,$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone]);
    }catch(PDOException $errMsg) {
			echo 'ERROR4: ' . $errMsg->getMessage();
			exit;
		}
    $databaseConnection3 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt3 = $databaseConnection3->prepare("DELETE FROM tbl_customers WHERE userid=?");
    $stmt3 ->execute([$userid]);
    }catch(PDOException $errMsg) {
      echo 'ERROR5: ' . $errMsg->getMessage();
      exit;
    }
  }

  if($accesslevel2==3 && $accesslevel2==$accesslevel){
    //IF AN ACCOUNT IS BEING UPDATED AND ACCESSLEVEL HAS REMAINED THE SAME
    //BLOCK THAT HANDLES UPDATING A USER WHO WAS ASSIGNED ACCESSLEVEL 3 (CUSTOMER) BY POST
    $databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt2 = $databaseConnection2->prepare("UPDATE tbl_customers SET fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=? WHERE userid=?");
    $stmt2 ->execute([$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone,$userid]);
    }catch(PDOException $errMsg) {
      echo 'ERROR6: ' . $errMsg->getMessage();
      exit;
    }

  }elseif($accesslevel2==2 && $accesslevel2==$accesslevel){
    //IF AN ACCOUNT IS BEING UPDATED AND ACCESSLEVEL HAS REMAINED THE SAME
    //BLOCK THAT HANDLES UPDATING A USER WHO WAS ASSIGNED ACCESSLEVEL 2 (PHOTOGRAPHER) BY POST
    $databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $databaseConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
    $stmt2 = $databaseConnection2->prepare("UPDATE tbl_photographers SET fname=?, lname=?, address1=?, address2=?, city=?, state=?, zip=?, email=?, phone=? WHERE userid=?");
    $stmt2 ->execute([$fname,$lname,$address1,$address2,$city,$state,$zip,$email,$phone,$userid]);
    }catch(PDOException $errMsg) {
			echo 'ERROR7: ' . $errMsg->getMessage();
			exit;
		}
  }
  $_SESSION['msg']= 'User '.$userid.', '.$fname.' '.$lname.', has been updated!<br>';
  header('location:adminusers.php');
  exit;
  }
include('header.php');
include('deactivatemodal.php');
echo "<div class='jumbotron'><h2><i class='fa fa-user-secret fa-fw fa-2x'></i>Admin Panel - Edit User</h2></div>";
include('buttons.php');
?>
<div class="col-md-7 col-md-offset-2">
<h4>
    Edit User
</h4>
  <form action='' method='post' name='userForm'>
    <input type="text" class="" id="userid" name="userid" value="<?php echo $userid;?>" hidden/>
    <div class="form-group">
      <label for="fname">First name</label>
        <input type="text" class="form-control" name="fname"
        id="fname" placeholder="First name" value="<?php echo $row2['fname'];?>" />
    </div>
    <div class="form-group">
      <label for="lname">Last name</label>
        <input type="text" class="form-control" name="lname"
        id="lname" placeholder="Last name" value="<?php echo $row2['lname'];?>" />
    </div>
    <div class="form-group">
      <label for="address1">Address line 1</label>
        <input type="text" class="form-control" name="address1"
        id="address1" placeholder="line 1" value="<?php echo $row2['address1'];?>" />
    </div>
    <div class="form-group">
      <label for="address2">Address line 2</label>
        <input type="text" class="form-control" name="address2"
        id="address2" placeholder="line 2" value="<?php echo $row2['address2'];?>"/>
    </div>
    <div class="form-group">
      <label for="city">City</label>
        <input type="text" class="form-control" name="city"
        id="city" placeholder="city" value="<?php echo $row2['city'];?>"/>
    </div>
    <div class="form-group">
      <label for="state">State</label>
        <input type="text" class="form-control" name="state"
        id="state" placeholder="state" value="<?php echo $row2['state'];?>" />
    </div>
    <div class="form-group">
      <label for="zip">Zip</label>
        <input type="text" class="form-control" name="zip"
        id="zip" placeholder="zip code" value="<?php echo $row2['zip'];?>"/>
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
        <input type="text" class="form-control" name="email"
        id="email" placeholder="Email Address" value="<?php echo $row2['email'];?>"/>
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone"
        id="phone" placeholder="phone number" value="<?php echo $row2['phone'];?>"/>
    </div>
    <div class="form-group">
      <label for="accesslevel">Access Level:</label><sm>   1 = Admin, 2 = Photographer, 3 = Customer</sm>
        <input type="text" class="form-control" name="accesslevel" id="accesslevel" value="<?php echo $accesslevel;?>">
    </div>
    <div class="form-group">
      <label for="lastaccess">Last Access</label>
        <input type="text" class="form-control" name="lastaccess" id="lastaccess" value="<?php echo $lastaccess;?>" readonly>
    </div>
    <div class="btn-group">
      <button id="submit" name="submit" class="btn btn-lg btn-success" type="submit">Submit</button>
      <a class="btn btn-lg btn-danger open-confirmDialogUser"href="#confirm-delete" data-toggle="modal" data-id="<?php echo $userid?>" data-target="#confirm-delete">
          Deactivate</a>
    </div>
  </form>
</div>

<?php
include('footer.php');
?>
