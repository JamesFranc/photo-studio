<?php
session_start();
include('header.php');
echo "<div class='jumbotron'><h2><i class='fa fa-calendar-check-o fa-fw fa-2x'></i>Schedule Time Entry</h2></div>";

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

if(isset($_POST['submit'])){
  // Establish connection
  $databaseConnection_insert = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);

  // Add the necessary varibles to data
  $photographer=$_POST['photographerSelection'];
  $eventDescription=$_POST['eventDescription'];
  $eventDate=$_POST['eventDate'];
  $timeStart=$_POST['timeStart'];
  $timeEnd=$_POST['timeEnd'];

  $stmt_insert = $databaseConnection_insert->prepare("INSERT INTO tbl_schedule SET photographerid=?, eventdate=?, timestart=?, timeend=?, eventdescription=?");

  // Try to kill it er'ri day boi
  try {
    $stmt_insert->execute([$photographer, $eventDate, $timeStart, $timeEnd, $eventDescription]);
    // echo $stmt .' fuck';
  } catch(PDOException $errMsg) {
    // FUCKING ERROR
    echo 'ERROR: ' . $errMsg->getMessage();
    exit;
  }
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
	<label for='eventDescription' >Description of Event</label>
	  <input type='text' class='form-control' name='eventDescription'
	  id='eventDescription' />
	</div>
    <div class='form-group'>
      <label for='eventDate' >Date of Event</label>
        <input type='date' class='form-control' name='eventDate'
        id='eventDate' />
    </div>
    <div class='form-group'>
      <label for='timeStart' >Start time of Event</label>
        <input type='time' class='form-control' name='timeStart'
        id='timeStart' />
    </div>
    <div class='form-group'>
      <label for='timeEnd' >End Time of Event</label>
        <input type='time' class='form-control' name='timeEnd'
        id='timeEnd' />
    </div>
    <button id='submit' name='submit' class='btn btn-lg btn-success' type='submit'>Submit</button>
  </form>
</div>";

include('footer.php');
?>
