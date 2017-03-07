<?php
session_start();
include('dbconnection.php');
if($_SESSION['accesslevel']!=1){
  header('location:dashboard.php');
}

include('header.php');

echo "<div class='jumbotron'><h2><i class='fa fa-unlock-alt fa-fw fa-2x'></i>Admin Panel</h2></div>";

include('buttons.php');
?>
<div class='col-sm-offset-2 col-md-4'>
    <table class='table table-hover'>
      <thead>
        <tr>

        </tr>
      </thead>
      <tbody>
        <tr><td><a href="adminusers.php" style="color:#000000">Users</a></td></tr>
        <tr><td><a href="adminorders.php" style="color:#000000">Orders</a></td></tr>
      </tbody>
</table>
</div>
<?php
include('footer.php');
 ?>
