<?php
if($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) != 'neworder.php'&& basename($_SERVER['PHP_SELF']) != 'orders.php' && basename($_SERVER['PHP_SELF']) != 'admin.php' && basename($_SERVER['PHP_SELF']) != 'edituser.php' && basename($_SERVER['PHP_SELF']) != 'user-ar.php' && basename($_SERVER['PHP_SELF']) != 'scheduleentry.php' && basename($_SERVER['PHP_SELF']) != 'scheduleentry.php' && basename($_SERVER['PHP_SELF']) != 'adminusers.php' && basename($_SERVER['PHP_SELF']) != 'editorder.php' && basename($_SERVER['PHP_SELF']) != 'photographeravailability.php') {
//THIS BUTTON BLOCK IS FOR ADMIN USERS ON dashboard.php
echo "
<div class='btn-block btn-group col-md-offset-2'>
        <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
        <a class='btn btn-md btn-default' href='createuser.php'><i class='fa fa-user-plus'></i>&nbsp;New User</a>
        <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
        <a class='btn btn-md btn-default' href='contract.php'><i class='fa fa-briefcase'></i>&nbsp;Contracts</a>
        <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
        <a class='btn btn-md btn-default' href='availabilitytransaction.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Availability</a>
        <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
        <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
</div>";
}elseif($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'neworder.php') {
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='contract.php'><i class='fa fa-briefcase'></i>&nbsp;Contracts</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='availabilitytransaction.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Availability</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'orders.php') {
  //THIS BUTTON BLOCK IS FOR ADMIN USERS ON orders.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
          <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='availabilitytransaction.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Availability</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'admin.php') {
  //THIS BUTTON BLOCK IS FOR ADMIN USERS ON orders.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='createuser.php'><i class='fa fa-user-plus'></i>&nbsp;New User</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='availabilitytransaction.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Availability</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'edituser.php' || $_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'user-ar.php' || $_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'editorder.php' || $_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'photographeravailability.php') {
  //THIS BUTTON BLOCK IS FOR ADMIN USERS ON orders.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-success' href='#' onclick='history.back();'><i class='fa fa-arrow-left'></i>&nbsp;Back</a>
          <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
          <a class='btn btn-md btn-default' href='createuser.php'><i class='fa fa-user-plus'></i>&nbsp;New User</a>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='availabilitytransaction.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Availability</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif ($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'scheduleentry.php') {
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
    <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
    <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
    <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
    <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
    <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif ($_SESSION['accesslevel']==1 && basename($_SERVER['PHP_SELF']) == 'adminusers.php') {
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
    <a class='btn btn-md btn-default' href='admin.php'><i class='fa fa-lock'></i>&nbsp;Admin Panel</a>
    <a class='btn btn-md btn-default' href='createuser.php'><i class='fa fa-user-plus'></i>&nbsp;New User</a>
    <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
    <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
    <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
    <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}

if($_SESSION['accesslevel']==2 && basename($_SERVER['PHP_SELF']) != 'neworder.php'&& basename($_SERVER['PHP_SELF']) != 'orders.php' && basename($_SERVER['PHP_SELF']) != 'scheduleentry.php') {
  //THIS BUTTON BLOCK IS FOR PHOTOGRAPHERS ON dashboard.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
        <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
        <a class='btn btn-md btn-default' href='contract.php'><i class='fa fa-briefcase'></i>&nbsp;Contracts</a>
        <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
        <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
        <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==2 && basename($_SERVER['PHP_SELF']) == 'neworder.php') {
  //THIS BUTTON BLOCK IS FOR PHOTOGRAPHERS ON neworder.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='orders.php'><i class='fa fa-shopping-bag'></i>&nbsp;Orders</a>
          <a class='btn btn-md btn-default' href='contract.php'><i class='fa fa-briefcase'></i>&nbsp;Contracts</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendar-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==2 && basename($_SERVER['PHP_SELF']) == 'orders.php') {
  //THIS BUTTON BLOCK IS FOR PHOTOGRAPHERS ON orders.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='scheduleentry.php'><i class='fa fa-calendary-check-o'></i>&nbsp;Schedule Entry</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif ($_SESSION['accesslevel']==2 && basename($_SERVER['PHP_SELF']) == 'scheduleentry.php') {
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-default' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
          <a class='btn btn-md btn-default' href='contract.php'><i class='fa fa-briefcase'></i>&nbsp;Contracts</a>
          <a class='btn btn-md btn-default' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='weeklyschedule.php'><i class='fa fa-calendar'></i>&nbsp;Schedule</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}

if($_SESSION['accesslevel']==3 && basename($_SERVER['PHP_SELF']) != 'neworder.php'&& basename($_SERVER['PHP_SELF']) != 'orders.php') {
  //THIS BUTTON BLOCK IS FOR CUSTOMERS ON dashboard.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
        <a class='btn btn-md btn-success' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
        <a class='btn btn-md btn-info' href='orders.php'><i class='fa fa-shopping-bag'></i>&nbsp;Your Orders</a>
        <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==3 && basename($_SERVER['PHP_SELF']) == 'neworder.php') {
  //THIS BUTTON BLOCK IS FOR CUSTOMERS ON neworder.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-primary' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-info' href='orders.php'><i class='fa fa-shopping-bag'></i>&nbsp;Your Orders</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}elseif($_SESSION['accesslevel']==3 && basename($_SERVER['PHP_SELF']) == 'orders.php') {
  //THIS BUTTON BLOCK IS FOR CUSTOMERS ON orders.php
  echo "
  <div class='btn-block btn-group col-md-offset-2'>
          <a class='btn btn-md btn-success' href='neworder.php'><i class='fa fa-plus-square-o'></i>&nbsp;New Order</a>
          <a class='btn btn-md btn-info' href='dashboard.php'><i class='fa fa fa-tachometer'></i>&nbsp;Dashboard</a>
          <a class='btn btn-md btn-default' href='index.php?logout=1'><i class='fa fa-sign-out'></i>&nbsp;Log out</a>
  </div>";
}
echo "<div>&nbsp;</div>";
?>
