<?php
session_start();
include('dbconnection.php');

if($_GET['page']=='user'){
  $userid= $_GET['id'];
  $stmt = $databaseConnection->prepare("UPDATE tbl_users SET accesslevel=0 WHERE userid=?");
  $stmt->execute([$userid]);
  $_SESSION['msg'] ="User ".$userid.", has been deactivated.</br>";
  header('location:adminusers.php');
  exit;
}elseif($_GET['page']=='order'){
  $orderid= $_GET['id'];
  $stmt = $databaseConnection->prepare("UPDATE tbl_orders SET status=0 WHERE id=?");
  $stmt->execute([$orderid]);
  $_SESSION['msg'] ="Order ".$orderid.", has been deactivated.</br>";
  header('location:adminorders.php');
  exit;
}

?>
