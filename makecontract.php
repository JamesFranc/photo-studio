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


$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
$stmt = $databaseConnection->prepare("SELECT userid, fname, lname FROM tbl_photographers");
$photographers = array();
if ($stmt->execute()) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $photographers[] = $row;
  }
}



if(!isset($_POST['submit'])){
  $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
  $stmt = $databaseConnection->prepare("SELECT tbl_orders.id, customerid, tbl_customers.fname cfname, tbl_customers.lname clname, tbl_orders.serviceid, tbl_services.price sprice,
    photographerid1, photographerid2, cinitials, pinitials, paymenttype, tbl_orders.comments, tbl_orders.quantity, tbl_customers.phone, tbl_customers.email, tbl_orders.orderdate, tbl_services.name sname, tbl_orders.price oprice
    FROM tbl_orders
    LEFT JOIN tbl_customers ON customerid = tbl_customers.userid
    LEFT JOIN tbl_services ON serviceid = tbl_services.id
    WHERE tbl_orders.id=?");
    try {
    $stmt->execute([$orderid]);
  }catch(PDOException $errMsg) {
    echo 'ERROR: ' . $errMsg->getMessage();
    exit;
  }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }else{
    $cfname = $_POST['cfname'];
    $clname = $_POST['clname'];
    $quantity = $_POST['quantity'];
    $email = $_POST['emailaddress'];
    $price = $_POST['sprice']*$quantity;
    $serviceid = $_POST['serviceRequested'];
    $accesslevel = $_POST['accesslevel'];
    $photo = $_POST['photographerAssigned1'];
    $photo2 = $_POST['photographerAssigned2'];
    $payment = $_POST['payment'];
    $cinitials = $_POST['cinitials'];
    $pinitials = $_POST['pinitials'];
    $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $stmt = $databaseConnection->prepare("UPDATE tbl_orders SET serviceid=?, quantity=?, price=?, photographerid1=?, photographerid2=?, paymenttype=?, cinitials=?, pinitials=?, status=2 WHERE id=?");
    try {
      $stmt->execute([$serviceid,$quantity,$price,$photo,$photo2,$payment,$cinitials,$pinitials,$orderid]);

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
  echo "<div class='jumbotron'><h2><i class='fa fa-quote-left fa-fw fa-2x'></i>Orders - Contract<i class='fa fa-quote-right fa-fw fa-2x'></i></h2></div>";
  include('buttons.php');
  ?>
  <div class="col-md-7 col-md-offset-2">
    <h4>
      Contract
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
      <div class='form-group'>
        <label for="orderdate">Order Date</label>
        <input type="text" class="form-control" name="orderdate" id="orderdate" value="<?php echo $row['orderdate'];?>" readonly>
      </div>
      <?php
      if(empty($row['cinitials'])){
      echo "
        <div class='form-group'>
          <label for='payment'>Payment Type</label>
          <input type='text' class='form-control' name='payment' id='payment' value='' />
        </div>
      <div class='form-group'>
        <label for='photographerAssigned1'>Lead Photographer</label>
          <select class='form-control' name='photographerAssigned1' id='photographerAssigned1'>
            <option></option>";
             // Use simple foreach to generate the photographers
            foreach($photographers as $r => $value) {
              echo '<option value='. $value['userid'].'> '.$value['fname'].' '.$value['lname'].' </option>';
             }

      echo "</select>
      </div>
      <div class='form-group'>
        <label for='photographerAssigned2'>Asst. Photographer</label>
          <select class='form-control' name='photographerAssigned2' id='photographerAssigned2'>
            <option></option>";

            foreach($photographers as $r => $value) {
              echo '<option value='. $value['userid'].'> '.$value['fname'].' '.$value['lname'].' </option>';
             }

      echo "</select>
      </div>
      <div class='form-group'>
        <label for='cinitials'>Customer Initials</label>
          <input type='text' class='form-control' name='cinitials' id='cinitials' value=''>
      </div>
      <div class='form-group'>
        <label for='pinitials'>Photographer Initials</label>
          <input type='text' class='form-control' name='pinitials' id='pinitials' value=''>
      </div>";
      }else{
        echo "

          <div class='form-group'>
            <label for='payment'>Payment Type</label>
            <input type='text' class='form-control' name='payment' id='payment' value='".$row['paymenttype']."' readonly/>
          </div>
        <div class='form-group'>
          <label for='photographerAssigned1'>Lead Photographer</label>
            <select class='form-control' name='photographerAssigned1' id='photographerAssigned1' readonly>";
              foreach($photographers as $r => $value) {
                      if($row['photographerid1'] == $value['userid']){
                      echo "<option value=".$value['userid']."> ".$value['fname']." ".$value['lname']." </option>";
                    }
                  }
        echo "</select>
        </div>
        <div class='form-group'>
          <label for='photographerAssigned2'>Asst. Photographer</label>
            <select class='form-control' name='photographerAssigned2' id='photographerAssigned2' readonly>";
              foreach($photographers as $r => $value) {
                      if($row['photographerid2'] == $value['userid']){
                      echo "<option value=".$value['userid']."> ".$value['fname']." ".$value['lname']." </option>";
                    }
                  }
        echo "</select>
        </div>
        <div class='form-group'>
          <label for='cinitials'>Customer Initials</label>
            <input type='text' class='form-control' name='cinitials' id='cinitials' value='".$row['cinitials']."' readonly>
        </div>
        <div class='form-group'>
          <label for='pinitials'>Photographer Initials</label>
            <input type='text' class='form-control' name='pinitials' id='pinitials' value='".$row['pinitials']."' readonly>
        </div>";
      }
      ?>
        <div class="btn-group">
          <button id="submit" name="submit" class="btn btn-lg btn-primary" type="submit" <?php if(!empty($row['cinitials'])){echo "disabled";} ?>><i class="fa fa-check-square-o"></i>&nbsp;Sign</button>

        </div>
      </form>
    </div>

    <?php
    include('footer.php');
    ?>
