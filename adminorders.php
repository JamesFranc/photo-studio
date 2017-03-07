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
echo "<div class='jumbotron'><h2><i class='fa fa-unlock-alt fa-fw fa-2x'></i>Admin Panel - Order Administration</h2></div>";
include('deactivatemodal.php');
include('buttons.php');
$userid = "%";
$stmt = $databaseConnection->prepare("SELECT tbl_orders.id, name, tbl_services.price, quantity, photographerid1, tbl_photographers.fname, tbl_photographers.lname, tbl_orders.price AS total, comments, tbl_orders.orderdate, tbl_orders.duedate,
STATUS FROM tbl_orders
LEFT JOIN tbl_services ON tbl_orders.serviceid = tbl_services.id
LEFT JOIN tbl_photographers ON photographerid1 = tbl_photographers.userid
WHERE customerid LIKE ? ORDER BY tbl_orders.orderdate DESC");
$table ="";

if ($stmt->execute([$userid])) {
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  //We get the order number, name of service, price for the order, any comments, and the status (currently an integer)
  //This view is only applicable to CUSTOMERS and ADMINS
      $table.='
        <tr>
        <td id="orderid">'.$row["id"].'</td>
        <td>'.$row["total"].'</td>
        <td>'.$row["orderdate"].'</td>
        <td>'.$row["duedate"].'</td>
        <td>'.$row["fname"].' '.$row["lname"].'</td>
        <td>'.$row["comments"].'</td>
        <td>'.$row["status"].'</td>
        <td><a href="editorder.php?id='.$row['id'].'" class="btn btn-edit" style="text-decoration:none;color:#000000;"/>Edit</a></td>
        <td><a class="btn btn-danger open-confirmDialogOrder"href="#confirm-delete" data-toggle="modal" data-id="'.$row["id"].'" data-target="#confirm-delete">
            Deactivate</a></td>
      </tr>';
  }

  echo "
  <div class='col-md-offset-1 col-md-10'>
  <table class='table table-hover'>
    <thead>
      <tr>
        <th>Order No.</th>
        <th>Order Amount</th>
        <th>Order Date</th>
        <th>Due Date</th>
        <th>Photographer</th>
        <th>Comments</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Deactivate</th>
      </tr>
    </thead>
    <tbody>".$table.
    "</tbody>
  </table>
  </div>
  ";
}

include('footer.php');
 ?>
