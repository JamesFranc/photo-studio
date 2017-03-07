<?php
session_start();
include("dbconnection.php");
$errMsg = '';
$email = $_POST["inputEmail"];
$password = $_POST["inputPassword"];
$name = $_POST["inputName"];
$hash = password_hash($password, PASSWORD_DEFAULT);
try {
  $stmt = $databaseConnection->prepare("INSERT INTO tbl_users SET email=?, password=?, name=?, accesslevel='3'");
  $stmt->execute([$email, $hash, $name]);
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
  $_SESSION['hash']=$hash;
  $_SESSION['name']=$name;
  $_SESSION['accesslevel'] = 3;
}else{
  echo "Well that didn't work, fix it <br>";
  exit;
}
?>
