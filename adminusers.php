<?php
session_start();
if($_SESSION['accesslevel']!=1){
  header('location:dashboard.php');
}
include('dbconnection.php');

include('header.php');

if(isset($_SESSION['msg'])){

  echo "<div id='message1' class=' alert alert-success alert-dismissable' style='margin-top:-1000px;overflow: hidden;position: fixed;
   width: 50%;margin-left:25%;opacity: 0.9;z-index: 1050;transition: all 1s ease;margin-top: 1px;'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
    <strong>Success!</strong> ".$_SESSION['msg']."
  </div>";
  $_SESSION['msg'] = null;
}
echo "<div class='jumbotron'><h2><i class='fa fa-users fa-fw fa-2x'></i>Admin Panel - Users</h2></div>";
include('deactivatemodal.php');
include('buttons.php');
$stmt = $databaseConnection->prepare("SELECT * from tbl_users");

if ($stmt->execute()) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //We get the order number, name of service, price for the order, any comments, and the status (currently an integer)
    //This view is only applicable to CUSTOMERS and ADMINS
    switch ($row["accesslevel"]) {
      case '1':
        $type="Admin";
      break;
      case '2':
          $type="Photographer";
      break;
      case '3':
          $type="Customer";
      break;
      default:
        $type="";
        break;
    }
        $table.='
          <tr>
          <td id="userid" >'.$row["userid"].'</td>
          <td>'.$row["email"].'</td>
          <td>'.$row["name"].'</td>
          <td>'.$row["lastaccess"].'</td>
          <td>'.$type.'</td>
          <td><a href="edituser.php?id='.$row['userid'].'" class="btn btn-edit" style="text-decoration:none;color:#000000;"/>Edit</a></td>
          <td><a class="btn btn-danger open-confirmDialogUser" href="#confirm-delete" data-toggle="modal" data-id="'.$row["userid"].'" data-target="#confirm-delete">
              Deactivate</a></td>
          <td><a class="btn btn-success" href="user-ar.php?id='.$row['userid'].'">AR</a></td>
        </tr>';

    }
  }


    echo "
    <div class='col-md-offset-1 col-md-10'>
    <table class='table table-hover'>
      <thead>
        <tr>
          <th>User ID</th>
          <th>Email</th>
          <th>Name</th>
          <th>Last Access</th>
          <th>Access Level</th>
          <th>Edit</th>
          <th>Deactivate</th>
          <th>Accounts</th>
        </tr>
      </thead>
      <tbody>".$table.
      "</tbody>
    </table>
    </div>
    ";


include('footer.php');
 ?>
