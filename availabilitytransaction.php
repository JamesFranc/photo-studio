<?php
session_start();
include('header.php');
echo "<div class='jumbotron'><h2><i class='fa fa-calendar-check-o fa-fw fa-2x'></i>Photographer Availability</h2></div>";

include("buttons.php");

include("dbconnection.php");
//------------------------------------------------------------------------
// This is the page for entering hours or whatever the fuck
//------------------------------------------------------------------------

//------------------------------------------------------------------------
//clearing the connection and the return
$databaseConnection=null;
$stmt=null;
//------------------------------------------------------------------------
$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
$stmt = $databaseConnection->prepare("SELECT * FROM tbl_photographers");

//Get the photographers
try {
    $stmt->execute();
} catch(PDOException $ex) {
    echo $ex->getMessage();
}

// $options = '<option>1</option>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     //Set each index of the event to the row retrieved
     $options.='<option name='.$row["userid"].' value='.$row["userid"].'>'.$row["fname"].' '.$row["lname"].'</option>';
}

if (isset($_POST['submit'])) {
    $_SESSION["aphotoid"] = $_POST['photographerSelection'];
    $_SESSION["aeventDate"] = $_POST['eventDate'];

    header('Location: photographeravailability.php');
 }

echo "<div class='col-md-7 col-md-offset-2'>
<h4>
    Schedule Entry Form
</h4>
  <form action='' method='post' name='orderForm'>
	<div class='form-group'>
	<label for='photographer' >Select Photographer</label>
	<select class='form-control' name='photographerSelection'>".$options."
	</select>
	</div>
	<div class='form-group'>
    <div class='form-group'>
      <label for='eventDate' >Date of Event</label>
        <input type='date' class='form-control' name='eventDate'
        id='eventDate' />
    </div>
    <button id='submit' name='submit' class='btn btn-lg btn-success' type='submit'>Submit</button>
  </form>
</div>";

include('footer.php');
?>
