<?php
session_start();
include('dbconnection.php');

$orderid = $_GET['id'];
$stmt = $databaseConnection->prepare("SELECT * FROM tbl_services");
// initialise an array for the results
$products = array();
if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}

//------------------------------------------------------------------------
//clearing the connection and the return
$databaseConnection=null;
$stmt=null;
//------------------------------------------------------------------------

$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
if(!isset($_POST['submit'])){
$stmt = $databaseConnection->prepare("SELECT tbl_orders.id, customerid, tbl_customers.fname cfname, tbl_customers.lname clname, tbl_orders.serviceid, tbl_services.price sprice,
tbl_photographers.fname, tbl_photographers.lname, tbl_orders.comments, tbl_orders.quantity, tbl_customers.phone, tbl_customers.email, tbl_orders.orderdate, tbl_services.name sname, tbl_orders.price oprice
FROM tbl_orders
LEFT JOIN tbl_customers ON customerid = tbl_customers.userid
LEFT JOIN tbl_services ON serviceid = tbl_services.id
LEFT JOIN tbl_photographers ON photographerid1 = tbl_photographers.userid
WHERE tbl_orders.id=?");
$stmt->execute([$orderid]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $cfname = $_POST['cfname'];
  $clname = $_POST['clname'];
  $quantity = $_POST['quantity'];
  $email = $_POST['emailaddress'];
  $price = $_POST['sprice']*$quantity;
  $serviceid = $_POST['serviceRequested'];
  $accesslevel = $_POST['accesslevel'];
  $stmt = $databaseConnection->prepare("UPDATE tbl_orders SET serviceid=?, quantity=?, price=? WHERE id=?");
  try {
    $stmt->execute([$serviceid,$quantity,$price,$orderid]);
  } catch(PDOException $errMsg) {
    echo 'ERROR: ' . $errMsg->getMessage();
    exit;
  }
  $_SESSION['msg']= 'Order '.$orderid.', has been updated!<br>';
  header('location:adminusers.php');
  exit;
  }
include('header.php');
include('deactivatemodal.php');
echo "<div class='jumbotron'><h2><i class='fa fa-unlock-alt fa-fw fa-2x'></i>Orders - Edit Order</h2></div>";
include('buttons.php');
?>
<div class="col-md-7 col-md-offset-2">
<h4>
    Edit Order
</h4>
  <form action='' method='post' name='orderForm'>
    <input type="hidden" id="sprice" class="form-control" name="sprice" value="<?php echo $row['sprice'];?>" />
    <div class="form-group">
      <label for="id">Order ID</label>
        <input type="text" class="form-control" name="id"
        id="id" placeholder="Order ID" value="<?php echo $row['id'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="customerid">Customer ID</label>
        <input type="text" class="form-control" name="customerid"
        id="id" placeholder="Customer ID" value="<?php echo $row['customerid'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="cfname">Customer First Name</label>
        <input type="text" class="form-control" name="cfname" id="cfname" value="<?php echo $row['cfname'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="clname">Customer Last Name</label>
        <input type="text" class="form-control" name="clname" id="clname" value="<?php echo $row['clname'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="email">Customer Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="phone">Customer Phone No</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row['phone'];?>" readonly/>
    </div>
    <div class="form-group">
      <label for="serviceRequested">Service Requested</label>
        <select class="form-control" name="serviceRequested" id="serviceRequested">
          <?php foreach($products as $r => $value) {
                  if($row['serviceid'] == $value['id']){
                  echo "<option value=".$value['id']."> ".$value['name']." </option>";
                }
              }
          ?>
          <option></option>
          <?php // Use simple foreach to generate the available services
          foreach($products as $r => $value) {
            echo "<option value=". $value['id']."> ".$value['name']." </option>";
           }?>
          </select>
    </div>
    <div class="form-group">
      <label for="quantity">Service Quantity</label>
        <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $row['quantity'];?>">
    </div>
    <div class="form-group">
      <label for="oprice">Order Price</label>
        <input type="text" class="form-control" name="oprice" id="oprice" value="<?php echo $row['oprice'];?>">
    </div>
    <div class="form-group">
      <label for="comments">User Comments</label>
        <input type="text" class="form-control" name="comments" id="comments" value="<?php echo $row['comments'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="orderdate">Order Date</label>
        <input type="text" class="form-control" name="orderdate" id="orderdate" value="<?php echo $row['orderdate'];?>" readonly>
    </div>
    <div class="btn-group">
      <button id="submit" name="submit" class="btn btn-lg btn-primary" type="submit">Submit</button>

    </div>
  </form>
</div>

<?php
include('footer.php');
?>
