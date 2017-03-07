<?php
session_start();

$databaseConnection=null;
$results = null;
$sql = null;
$databaseConnection5 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
$stmt = $databaseConnection5->prepare("SELECT * FROM tbl_services");
// initialise an array for the results
$products = array();
if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}
    //------------------------------------------------------------------------
    // END DUPLICATE EMAIL CHECK BLOCK
    //------------------------------------------------------------------------
    $customerid=$_SESSION['userid'];
    $serviceid=$_POST['serviceRequested'];
    $photographer=$_POST['photographerRequested'];
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
    $databaseConnection6 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $stmt = $databaseConnection6->prepare("INSERT INTO tbl_orders SET customerid=?, serviceid=?, photographerid=?, quantity=?, status='1', price=?, comments=?, orderdate=CURRENT_TIMESTAMP ,duedate=?");

    try {
      $stmt->execute([$customerid, $serviceid, $photographer, $quantity, $price, $comments, $duedate]);
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
    $databaseConnection7 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
    $stmt3 = $databaseConnection7->prepare("SELECT id FROM tbl_orders WHERE customerid=? ORDER BY orderdate DESC LIMIT 1");
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

?>
