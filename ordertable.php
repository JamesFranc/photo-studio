<?php
// I really just needed to try and implement the dynamic table
// -Jimmy
session_start();
include('dbconnection.php');

if($_SESSION['accesslevel']==3){
  //Query gets all the orders associated with the current user's userid number: CUSTOMER
$userid = $_SESSION['userid'];
$stmt = $databaseConnection->prepare("SELECT tbl_orders.id, name, quantity, tbl_orders.price, comments, tbl_orders.orderdate, tbl_orders.duedate ,status FROM tbl_orders LEFT JOIN tbl_services ON tbl_orders.serviceid=tbl_services.id WHERE customerid=? ORDER BY tbl_orders.orderdate DESC");
}elseif($_SESSION['accesslevel']==2){
  //Query gets all the orders associated with the current user's userid number: PHOTOGRAPHER
  $stmt = $databaseConnection->prepare("SELECT tbl_orders.id, name, tbl_orders.price, comments, status FROM tbl_orders LEFT JOIN tbl_services ON tbl_orders.serviceid=tbl_services.id WHERE photographerid LIKE ?");
  $userid = $_SESSION['userid'];
}else{
  //Query gets all the orders associated with the current user's userid number: WILDCARD = ADMIN
  $userid = "%";
  $stmt = $databaseConnection->prepare("SELECT tbl_orders.id, name, quantity, tbl_photographers.firstname, tbl_photographers.lastname, tbl_orders.price, comments, tbl_orders.orderdate, tbl_orders.duedate ,status FROM tbl_orders LEFT JOIN tbl_services ON tbl_orders.serviceid=tbl_services.id LEFT JOIN tbl_photographers
  ON photographerid = tbl_photographers.id WHERE customerid LIKE ? ORDER BY tbl_orders.orderdate DESC");
}
$table ="";
if ($stmt->execute([$userid]) && $_SESSION['accesslevel']!=2) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //We get the order number, name of service, price for the order, any comments, and the status (currently an integer)
    //This view is only applicable to CUSTOMERS and ADMINS
    switch ($row["status"]) {
      case '1':
        $type="Unsigned";
      break;
      case '2':
          $type="Signed";
      break;
      case '0':
          $type="Inactive";
      break;
      default:
        $type="";
        break;
    }

        $table.='
          <tr>
          <td>'.$row["id"].'</td>
          <td>'.$row["name"].'</td>
          <td>'.$row["quantity"].'</td>
          <td>'.$row["price"].'</td>
          <td>'.$row["orderdate"].'</td>
          <td>'.$row["duedate"].'</td>
          <td>'.$row["firstname"].' '.$row["lastname"].'</td>
          <td>'.$row["comments"].'</td>
          <td>'.$type.'</td>
        </tr>';

    }
    echo "
    <div class='col-md-offset-1 col-md-10'>
    <table class='table table-hover'>
      <thead>
        <tr>
          <th>Order No.</th>
          <th>Service</th>
          <th>Quantity</th>
          <th>Order Amount</th>
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Photographer</th>
          <th>Comments</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>".$table.
      "</tbody>
    </table>
    </div>
    ";
}elseif ($stmt->execute([$userid]) && $_SESSION['accesslevel']==2) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //We get the order number, name of service, price for the order, any comments, and the status (currently an integer)
    //This view is only applicable to PHOTOGRAPHERS
        $table.='
          <tr>
          <td>'.$row["id"].'</td>
          <td>'.$row["name"].'</td>
          <td>'.$row["comments"].'</td>
          <td>'.$row["status"].'</td>
        </tr>';

    }
    echo "
    <div class='col-md-offset-2 col-md-6'>
    <table class='table table-hover'>
      <thead>
        <tr>
          <th>Order No.</th>
          <th>Service</th>
          <th>Comments</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>".$table.
      "</tbody>
    </table>
    </div>
    ";
}


?>
