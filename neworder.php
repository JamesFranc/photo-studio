<?php
session_start();
include("dbconnection.php");
if(isset($_POST['question'])){
  $_POST['submit'] = null;
}
//------------------------------------------------------------------------
// This is the new order page
//------------------------------------------------------------------------
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
$stmt = $databaseConnection->prepare("SELECT userid, fname, lname FROM tbl_photographers");
$photographers = array();
if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $photographers[] = $row;
    }
}
// BLOCK BELOW IS TO DISPLAY PHOTOGRAPHERS
// <div class="form-group">
//   <label for="photographerRequested">Photographer Requested</label>
//     <select class="form-control" name="photographerRequested" id="photographerRequested">
//       <option></option>
//       <?php if(isset($_POST['answer'])){
//         foreach($photographers as $row => $value) {
//           if($_POST['photographerRequested']==$value['userid']){
//           echo "<option value=".$value['id']."> ".$value['fname']." ".$value['lname']." </option>";
//          }
//        }
//       }// Use simple foreach to generate the photographers
//       foreach($photographers as $row => $value) {
//         echo "<option value=". $value['userid']."> ".$value['fname']." ".$value['lname']." </option>";
//        }
//       </select>
// </div>
//------------------------------------------------------------------------
//clearing the connection and the return
$databaseConnection=null;
$stmt=null;
//------------------------------------------------------------------------

if(isset($_POST['submit'])){
	  $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);

		//------------------------------------------------------------------------
		// END DUPLICATE EMAIL CHECK BLOCK
		//------------------------------------------------------------------------
    $customerid=$_SESSION['userid'];
    $serviceid=$_POST['serviceRequested'];
    $quantity=$_POST['quantity'];
    foreach($products as $row => $value) {
      if($value['id']==$serviceid){
        $price = $value['price']*$quantity;
      }
     }
     $comments = $_POST['comments'];
     $duedate = $_POST['dateRequested'];

		//------------------------------------------------------------------------
		// BEGIN TRY-INSERT STATEMENT IF DUPLICATE EMAIL IS NOT FOUND
		//------------------------------------------------------------------------
    $stmt = $databaseConnection->prepare("INSERT INTO tbl_orders SET customerid=?, serviceid=?, quantity=?, status='1', price=?, comments=? ,duedate=?, orderdate=CURRENT_TIMESTAMP");

    try {
			$stmt->execute([$customerid, $serviceid, $quantity, $price, $comments, $duedate]);

		} catch(PDOException $errMsg) {
			echo 'ERROR: ' . $errMsg->getMessage();
			exit;
		}
		//------------------------------------------------------------------------
		// END TRY-INSERT STATEMENT IF DUPLICATE EMAIL IS NOT FOUND
		//------------------------------------------------------------------------
    //clearing the connection and the return
    $databaseConnection=null;
    $stmt=null;
    $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $stmt3 = $databaseConnection->prepare("SELECT id FROM tbl_orders WHERE customerid=? ORDER BY orderdate DESC LIMIT 1");
    $stmt3->execute([$customerid]);
    $result = $stmt3->fetchColumn();
		//------------------------------------------------------------------------
		// BEGIN REDIRECT TO WELCOME PAGE INSERT IS SUCCESSFUL
		//------------------------------------------------------------------------
		if($stmt3){
			$_SESSION['thankyou']= "Thank you for your order! Your order number is: ".$result.".<br> You will be contacted soon to finalize your contract.";
			header('location:dashboard.php');
			exit;
		}else{
			echo "Well that didn't work, fix it <br>";
			exit;
		}
	}
//
//

include('header.php');
echo "<div class='jumbotron'><h2><i class='fa fa-plus-square-o fa-fw fa-2x'></i>New Order Form</h2></div>";
include("buttons.php");
?>
<div class="col-md-7 col-md-offset-2">
  <form action='' method='post' name='orderForm'>
    <div class="form-group">
      <label for="name" >Name</label>
        <input type="text" class="form-control" name="name"
        id="name" placeholder="Enter your name" value="<?php echo $_SESSION['name'];?>"/>
    </div>
    <div class="form-group">
      <label for="address">Address of shoot (if known)</label>
        <input type="text" class="form-control" name="address"
        id="address" placeholder="The location of the photo shoot" value="<?php echo $_POST['address']; ?>"/>
    </div>
    <div class="form-group">
      <label for="serviceRequested">Service Requested</label>
        <select class="form-control" name="serviceRequested" id="serviceRequested">
          <?php if(isset($_POST['answer'])){
            foreach($products as $row => $value) {
              if($_POST['servivceRequested']==$value['id']){
              echo "<option value=".$value['id']."> ".$value['name']." </option>";
             }
           }
          }?>
          <option></option>
          <?php // Use simple foreach to generate the available services
          foreach($products as $row => $value) {
            echo "<option value=". $value['id']."> ".$value['name']." </option>";
           }?>
          </select>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity</label>
        <input type="text" class="form-control" name="quantity"
        id="quantity" placeholder="Enter a quantity" value="<?php echo $_POST['quantity']; ?>"/>
    </div>
    <div class="form-group">
      <label for="dateRequested" >Date for service requested</label>
        <input type="date" class="form-control" name="dateRequested"
        id="dateRequested" value="<?php echo $_POST['dateRequested']; ?>" />
    </div>
    <div class="form-group">
      <label for="comments">Comments</label>
        <input type="text" class="form-control" name="comments"
        id="comments" value="<?php echo $_POST['dateRequested']; ?>" />
    </div>
    <button id="submit" name="submit" class="btn btn-lg btn-success" type="submit">Submit</button>
  </form>
</div>
<?php
include('footer.php');
?>
