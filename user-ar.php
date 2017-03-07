<?php
session_start();
$userid = $_GET['id'];

include('dbconnection.php');
include('header.php');

echo "<div class='jumbotron'><h2><i class='fa fa-users fa-fw fa-2x'></i>Admin Panel - Accounts Receivable</h2></div>";
include('deactivatemodal.php');
include('buttons.php');
$stmt = $databaseConnection->prepare("SELECT * from tbl_orders WHERE customerid = $userid");

if ($stmt->execute()) {
  $total = 0.00;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //We get the order number, name of service, price for the order, any comments, and the status (currently an integer)
    //This view is only applicable to CUSTOMERS and ADMINS
    $total = $total + $row['price'];
    //Status 1: New
    //Status 2: Pending
    $status = "";
    if($row["status"] == 1) {
        $status = "New";
    } elseif($row["status"] == 2) {
        $status = "Contract Signed";
    } else {
        continue;
    }

    $startDate = date("d/m/Y", strtotime($row["orderdate"]));
        $table.='
          <tr>
          <td>'.$startDate.'</td>
          <td>'.$row["duedate"].'</td>
          <td>'.'$'.$row["price"].'</td>
          <td>'.$row["quantity"].'</td>
          <td>'.$row["serviceid"].'</td>
          <td>'.$row["comments"].'</td>
          <td>'.$status.'</td>
        </tr>';
    }
  }


    echo "
    <div class='col-md-offset-1 col-md-10'>
    <table class='table table-hover'>
      <thead>
        <tr>
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Service ID</th>
          <th>Comments</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>".$table."<td style='font-weight:600;'><em>Grand Total</em></td><td></td><td style='font-weight:600;'><em>$".$total."</em></td><td></td><td></td><td></td><td></td>
      </tbody>
    </table>
    </div>
    ";


include('footer.php');
?>
